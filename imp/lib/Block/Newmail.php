<?php
/**
 * Block: show list of new mail messages.
 *
 * Copyright 2007-2011 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * @author   Michael Slusarz <slusarz@horde.org>
 * @category Horde
 * @license  http://www.fsf.org/copyleft/gpl.html GPL
 * @package  IMP
 */
class IMP_Block_Newmail extends Horde_Core_Block
{
    /**
     */
    public $updateable = true;

    /**
     */
    public function __construct($app, $params = array())
    {
        parent::__construct($app, $params);

        $this->_name = _("Newest Unseen Messages");
    }

    /**
     */
    protected function _content()
    {
        $inbox = IMP_Mailbox::get('INBOX');

        /* Filter on INBOX display, if requested. */
        if ($GLOBALS['prefs']->getValue('filter_on_display')) {
            $GLOBALS['injector']->getInstance('IMP_Filter')->filter($inbox);
        }

        $query = new Horde_Imap_Client_Search_Query();
        $query->flag(Horde_Imap_Client::FLAG_SEEN, false);
        $ids = $inbox->runSearchQuery($query, Horde_Imap_Client::SORT_SEQUENCE, 1);
        $indices = $ids['INBOX'];

        $html = '<table cellspacing="0" width="100%">';
        $text = _("Go to your Inbox...");
        if (empty($indices)) {
            $html .= '<tr><td><em>' . _("No unread messages") . '</em></td></tr>';
        } else {
            $charset = 'UTF-8';
            $imp_ui = new IMP_Ui_Mailbox($inbox);
            $shown = empty($this->_params['msgs_shown'])
                ? 3
                : $this->_params['msgs_shown'];

            $query = new Horde_Imap_Client_Fetch_Query();
            $query->envelope();

            try {
                $fetch_ret = $GLOBALS['injector']->getInstance('IMP_Factory_Imap')->create()->fetch($inbox, $query, array(
                    'ids' => new Horde_Imap_Client_Ids(array_slice($indices, 0, $shown))
                ));
            } catch (IMP_Imap_Exception $e) {
                $fetch_ret = array();
            }

            reset($fetch_ret);
            while (list($uid, $ob) = each($fetch_ret)) {
                $envelope = $ob->getEnvelope();

                $date = $imp_ui->getDate($envelope->date);
                $from = $imp_ui->getFrom($envelope, array('specialchars' => $charset));
                $subject = $imp_ui->getSubject($envelope->subject, true);

                $html .= '<tr style="cursor:pointer" class="text"><td>' .
                    IMP::generateIMPUrl('message.php', $inbox, $uid)->link() .
                    '<strong>' . $from['from'] . '</strong><br />' .
                    $subject . '</a></td>' .
                    '<td>' . htmlspecialchars($date, ENT_QUOTES, $charset) . '</td></tr>';
            }

            $more_msgs = count($indices) - $shown;
            if ($more_msgs > 0) {
                $text = sprintf(ngettext("%d more unseen message...", "%d more unseen messages...", $more_msgs), $more_msgs);
            }
        }

        return $html .
               '<tr><td colspan="2" style="cursor:pointer" align="right">' . IMP::generateIMPUrl('mailbox.php', $inbox)->link() . $text . '</a></td></tr>' .
               '</table>';
    }

}
