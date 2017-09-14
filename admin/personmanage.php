<?php

define('JIEQI_MODULE_NAME', 'system');
require_once '../global.php';
include_once JIEQI_ROOT_PATH . '/class/power.php';
$power_handler = &JieqiPowerHandler::getInstance('JieqiPowerHandler');
$power_handler->getSavedVars('system');
jieqi_checkpower($jieqiPower['system']['adminuser'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);

if (empty($_REQUEST['id'])) {
	jieqi_printfail(LANG_NO_USER);
}

jieqi_loadlang('users', JIEQI_MODULE_NAME);
$_REQUEST['id'] = intval($_REQUEST['id']);
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$user = $users_handler->get($_REQUEST['id']);
$uid = (int)$user->getVar('uid');
$username = $user->getVar('uname');
if (!is_object($user)) {
	jieqi_printfail(LANG_NO_USER);
}

$isUser = mysql_query("select * from `jieqi_system_persons` where `uid`='$uid'");
    $rows = mysql_fetch_array($isUser);
if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}

switch ($_REQUEST['action']) {
case 'update':
    $ret = mysql_query("UPDATE `jieqi_system_persons` set `uid`=".$uid.", `username`='$username', `realname` = '$_REQUEST[p_realname]', `gender` = '$_REQUEST[p_gender]', `telephone` = '$_REQUEST[p_telephone]', `mobilephone` = '$_REQUEST[p_mobilephone]', `idcardtype` = '$_REQUEST[p_idcardtype]', `idcard` = '$_REQUEST[p_idcard]', `address` = '$_REQUEST[p_address]', `zipcode` = '$_REQUEST[p_zipcode]', `banktype` = '$_REQUEST[p_banktype]', `bankname` = '$_REQUEST[p_bankname]', `bankcard` = '$_REQUEST[p_bankcard]', `bankuser` = '$_REQUEST[p_bankuser]', `mynote` = '$_REQUEST[p_mynote]', `divided` = '$_REQUEST[p_divided]', `denyedit` = '$_REQUEST[denyedit]'  WHERE `uid` = '$uid'");
	$_REQUEST['uid'] = $user->getVar('uid');
	$_REQUEST['jumpurl'] = JIEQI_URL . '/admin/users.php';
    jieqi_useraction('edit', $_REQUEST);
	break;

case 'edit':
default:
	include_once JIEQI_ROOT_PATH . '/admin/header.php';
	$jieqiTpl->assign('personsvars', $rows);
	$jieqiTpl->assign('uid', $uid);
	$jieqiTpl->assign('denyedit', $rows['denyedit']);
	$jieqiTpl->assign('egold', $user->getVar('egold', 'e'));
	$uservals = $user->getVars('e');
	$uservals['setting'] = unserialize($user->getVar('setting', 'n'));
	$jieqiTpl->assign_by_ref('uservals', $uservals);
	$jieqiTpl->assign_by_ref('grouprows', $jieqiGroups);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = JIEQI_ROOT_PATH . '/templates/admin/personmanage.html';
	include_once JIEQI_ROOT_PATH . '/admin/footer.php';
	break;
}

?>
