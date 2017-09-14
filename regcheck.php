<?php

define('JIEQI_MODULE_NAME', 'system');
require_once 'global.php';
header('Content-Type:text/html;charset=' . JIEQI_CHAR_SET);
include_once JIEQI_ROOT_PATH . '/lib/text/textfunction.php';
include_once JIEQI_ROOT_PATH . '/class/users.php';
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
jieqi_getconfigs('system', 'action', 'jieqiAction');
jieqi_loadlang('users', JIEQI_MODULE_NAME);
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$imageright = sprintf($jieqiLang['system']['register_check_right'], JIEQI_URL);
$imageerror = sprintf($jieqiLang['system']['register_check_error'], JIEQI_URL);

switch ($_GET['item']) {
case 'u':
	$htmlstring = $imageright;

	if (strlen($_GET['username']) == 0)
	{
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['need_username'];
	}
	else if (preg_match('/\\s+|^c:\\con\\con|[%,\\*"\\s\\<\\>\\&]|　||^Guest|^游客|笴/is', $_GET['username']))
	{
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['error_user_format'];
	}
	else
	{
		if (($jieqiConfigs[JIEQI_MODULE_NAME]['usernamelimit'] == 1) && !preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $_GET['username']))
		{
			$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['username_need_engnum'];
		}
		else
		{
			if (!empty($jieqiAction['system']['register']['lenmin']) && (strlen($_GET['username']) < intval($jieqiAction['system']['register']['lenmin'])))
			{
				$htmlstring = $imageerror . sprintf($jieqiLang['system']['username_over_lenmin'], $jieqiAction['system']['register']['lenmin']);
			}
			else
			{
				if (!empty($jieqiAction['system']['register']['lenmax']) && (intval($jieqiAction['system']['register']['lenmax']) < strlen($_GET['username'])))
				{
					$htmlstring = $imageerror . sprintf($jieqiLang['system']['username_over_lenmax'], $jieqiAction['system']['register']['lenmax']);
				}
				else if ($users_handler->getByname($_GET['username'], 2) != false)
				{
					$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['user_has_registered'];
				}
				else if (!empty($jieqiDeny['users']))
				{
					include_once JIEQI_ROOT_PATH . '/include/checker.php';
					$checker = new JieqiChecker();
					$matchwords = $checker->deny_words($_GET['username'], $jieqiDeny['users'], true, true);

					if (is_array($matchwords)) {
						$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['username_check_deny'];
					}
				}
			}
		}
	}

	echo $htmlstring;
	break;

case 'n':
	$htmlstring = $imageright;

	if (strlen($_GET['nickname']) == 0) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['need_nickname'];
	}
	else if (preg_match('/\\s+|^c:\\con\\con|[%,\\*"\\s\\<\\>\\&]|　||^Guest|^游客|笴/is', $_GET['nickname'])) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['error_nick_format'];
	}
	else if ($users_handler->getByname($_GET['nickname'], 3) != false) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['nick_has_used'];
	}
	else if (!empty($jieqiDeny['users'])) {
		include_once JIEQI_ROOT_PATH . '/include/checker.php';
		$checker = new JieqiChecker();
		$matchwords = $checker->deny_words($_GET['nickname'], $jieqiDeny['users'], true, true);

		if (is_array($matchwords)) {
			$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['nickname_check_deny'];
		}
	}

	echo $htmlstring;
	break;

case 'p':
	if (strlen($_GET['password']) == 0) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['need_pass_repass'];
	}
	else {
		$htmlstring = $imageright;
	}

	echo $htmlstring;
	break;

case 'r':
	if ((strlen($_GET['password']) == 0) || (strlen($_GET['repassword']) == 0)) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['need_pass_repass'];
	}
	else if ($_GET['password'] != $_GET['repassword']) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['password_not_equal'];
	}
	else {
		$htmlstring = $imageright;
	}

	echo $htmlstring;
	break;

case 'm':
	if (strlen($_GET['email']) == 0) {
		$htmlstring = $imageerror . $jieqiLang['system']['need_email'];
	}
	else if (!preg_match('/^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+([\\.][a-z0-9-]+)+$/i', $_GET['email'])) {
		$htmlstring = $imageerror . $jieqiLang['system']['error_email_format'];
	}
	else if (0 < $users_handler->getCount(new Criteria('email', $_GET['email'], '='))) {
		$htmlstring = $imageerror . $jieqiLang[JIEQI_MODULE_NAME]['email_has_registered'];
	}
	else {
		$htmlstring = $imageright;
	}

	echo $htmlstring;
	break;

default:
}

exit();

?>
