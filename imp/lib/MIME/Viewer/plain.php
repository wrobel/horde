<?php
/**
 * The IMP_Horde_MIME_Viewer_plain class renders out text/plain MIME parts
 * with URLs made into hyperlinks.
 *
 * $Horde: imp/lib/MIME/Viewer/plain.php,v 1.92 2008/10/06 21:19:49 slusarz Exp $
 *
 * Copyright 1999-2008 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * @author  Anil Madhavapeddy <anil@recoil.org>
 * @author  Michael Slusarz <slusarz@horde.org>
 * @package Horde_MIME_Viewer
 */
class IMP_Horde_MIME_Viewer_plain extends Horde_MIME_Viewer_plain
{
    /**
     * TODO
     */
    protected function _renderInline()
    {
        global $conf, $prefs;

        // Trim extra whitespace in the text.
        $text = rtrim($this->_mimepart->getContents());
        if ($text == '') {
            return array(
                'data' => '',
                'status' => array()
            );
        }

        // If requested, scan the message for PGP data.
        if (!empty($conf['utils']['gnupg']) &&
            $prefs->getValue('pgp_scan_body') &&
            preg_match('/-----BEGIN PGP ([^-]+)-----/', $text)) {
            require_once IMP_BASE . '/lib/Crypt/PGP.php';
            $imp_pgp = new IMP_PGP();
            if (($out = $imp_pgp->parseMessageOutput($this->_mimepart, $this->_params['contents']))) {
                return array(
                    'data' => $out,
                    'status' => array()
                );
            }
        }

        // Check for 'flowed' text data.
        if ($this->_mimepart->getContentTypeParameter('format') == 'flowed') {
            $text = $this->_formatFlowed($text, $this->_mimepart->getContentTypeParameter('delsp'));
        } else {
            /* A "From" located at the beginning of a line in the body text
             * will be escaped with a '>' by the IMAP server.  Remove this
             * escape character or else the line will display as being
             * quoted. Flowed conversion would have already taken care of this
             * for us. */
            $text = preg_replace('/(\n+)> ?From(\s+)/', "$1From$2", $text);
        }

        // Build filter stack. Starts with HTML markup and tab expansion.
        require_once 'Horde/Text/Filter.php';
        $filters = array(
            'text2html' => array(
                'parselevel' => TEXT_HTML_MICRO,
                'charset' => $this->_mimepart->getCharset()
            ),
            'tabs2spaces' => array()
        );

        // Highlight quoted parts of an email.
        if ($prefs->getValue('highlight_text')) {
            $show = $prefs->getValue('show_quoteblocks');
            $hideBlocks = ($show == 'hidden') ||
                (($show == 'thread') && (basename(Horde::selfUrl()) == 'thread.php'));
            if (!$hideBlocks && in_array($show, array('list', 'listthread'))) {
                $header = $this->_params['contents']->getHeaderOb();
                $imp_ui = new IMP_UI_Message();
                $list_info = $imp_ui->getListInformation($header);
                $hideBlocks = $list_info['exists'];
            }
            $filters['highlightquotes'] = array('hideBlocks' => $hideBlocks);
        }

        // Highlight simple markup of an email.
        if ($prefs->getValue('highlight_simple_markup')) {
            $filters['simplemarkup'] = array();
        }

        // Dim signatures.
        if ($prefs->getValue('dim_signature')) {
            $filters['dimsignature'] = array();
        }

        // Filter bad language.
        if ($prefs->getValue('filtering')) {
            $filters['words'] = array(
                'words_file' => $conf['msgsettings']['filtering']['words'],
                'replacement' => $conf['msgsettings']['filtering']['replacement']
            );
        }

        // Run filters.
        $text = Text_Filter::filter($text, array_keys($filters), array_values($filters));

        // Wordwrap.
        $text = str_replace(array('  ', "\n "), array(' &nbsp;', "\n&nbsp;"), $text);
        if (!strncmp($text, ' ', 1)) {
            $text = '&nbsp;' . substr($text, 1);
        }

        return array(
            'data' => '<div class="fixed leftAlign">' . "\n" . $text . '</div>',
            'status' => array()
        );
    }
}
