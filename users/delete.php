<?php
/**
 * $Horde: shout/users/delete.php,v 1.0 2005/07/28 21:38:35 ben Exp $
 *
 * Copyright 2005 Ben Klang <ben@alkaloid.net>
 *
 * See the enclosed file LICENSE for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.php.
 */
@define('SHOUT_BASE', dirname(__FILE__) . '/..');
//require_once 'Horde/Variables.php';

$context = Util::getFormData('context');
$extension = Util::getFormData('extension');

$res = $shout->deleteUser($context, $extension);

if (!$res) {
    echo "Failed!";
    print_r($res);
}
$notification->push("User Deleted.");
$notification->notify();
require SHOUT_TEMPLATES . '/common-footer.inc';