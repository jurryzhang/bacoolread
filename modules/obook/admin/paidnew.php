<?php

define('JIEQI_MODULE_NAME', 'obook');
require_once '../../../global.php';
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['obook']['manageallobook'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
if (empty($_REQUEST['oid']) || !is_numeric($_REQUEST['oid'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
$_REQUEST['oid'] = intval($_REQUEST['oid']);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
jieqi_loadlang('paid', JIEQI_MODULE_NAME);
$obook_static_url = (empty($jieqiConfigs['obook']['staticurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['staticurl']);
$obook_dynamic_url = (empty($jieqiConfigs['obook']['dynamicurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['dynamicurl']);
jieqi_includedb();

jieqi_getconfigs(JIEQI_MODULE_NAME, 'option', 'jieqiOption');
include_once $jieqiModules['obook']['path'] . '/class/obook.php';
$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
$obook = $obook_handler->get($_REQUEST['oid']);
$authorid = (int)$obook->getVar('authorid');
$obookid = (int)$obook->getVar('obookid');
$obookname = $obook->getVar('obookname');
$articleid = $obook->getVar('articleid');
$sumegold = $obook->getVar('sumegold');
$sumemoney = $obook->getVar('sumemoney');
$paidemoney = $obook->getVar('paidemoney');

if(!$authorid){
	jieqi_printfail($jieqiLang['obook']['paid_user_error']);
}

include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$users = $users_handler->get($authorid);
$userid = (int)$users->getVar('uid');
$username = $users->getVar('uname');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

$sql = mysql_query("select * from `jieqi_system_persons` where `uid`=".$authorid." limit 1");
$personsvars = mysql_fetch_array($sql);

$row = mysql_query("select * from `jieqi_obook_paidlog` where `obookid`=".$_REQUEST['oid']." limit 1");
$rows = mysql_fetch_array($row);
if(!$personsvars){
	jieqi_printfail($jieqiLang['obook']['pay_over_persons']);
}
$cpaidemoney = intval(floor($obook->getVar('paidemoney') + $_REQUEST['payemoney']));
$cremainemoney = intval(floor($obook->getVar('sumemoney') - $obook->getVar('paidemoney')));
if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'show';
}

switch ($_REQUEST['action']) {
case 'post':
	$errtext = '';

	if ($_REQUEST['payemoney'] <= 0) {
		$errtext .= $jieqiLang['obook']['payemoney_over_zero'] . '<br />';
	}
	else if ($_REQUEST['payemoney'] > $cremainemoney) {
		$errtext .= $jieqiLang['obook']['payemoney_over_remain']. '<br />';
	}
	else if($_REQUEST['paymoney'] <= 0){
		$errtext .= $jieqiLang['obook']['paymoney_over_zero'] . '<br />';
	}
	if (empty($errtext)) {
		$criteria = new CriteriaCompo(new Criteria('obookid', $_REQUEST['oid']));
		$ret = $obook_handler->updatefields(array('paytime' => JIEQI_NOW_TIME, 'paidemoney' => $cpaidemoney), $criteria);
		/*写入结算记录开始*/
		$remain = intval(floor($cremainemoney - $_REQUEST['payemoney']));
		$summoney = $rows['summoney'] + $_REQUEST['paymoney'];
		$ret1 = mysql_query("insert into `jieqi_obook_paidlog` set `paytime`=".JIEQI_NOW_TIME.", `userid` = '$userid', `username` = '$username', `obookid` = '$obookid', `obookname` = '$obookname', `articleid` = '$articleid', `sumegold` = '$sumegold', `sumemoney` = '$sumemoney', `paidemoney` = '$remain', `payemoney` = '$_REQUEST[payemoney]', `remainemoney` = '$remain', `summoney` = '$summoney', `paymoney` = '$_REQUEST[paymoney]', `paidtype` = '$_REQUEST[paidtype]'");
		/*写入结算记录结算结算*/
		if (!$ret1) {
			jieqi_printfail($jieqiLang['obook']['database_save_error']);
		}
		jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['obook']['paidnew_save_success']);
		if (!$ret) {
			jieqi_printfail($jieqiLang['obook']['database_save_error']);
		}
		jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['obook']['paidnew_save_success']);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case 'show':
default:
	include_once JIEQI_ROOT_PATH . '/admin/header.php';
	$jieqiTpl->assign('obook_static_url', $obook_static_url);
    $jieqiTpl->assign('obook_dynamic_url', $obook_dynamic_url);
	$jieqiTpl->assign('obookid', $obook->getVar('obookid', 'n'));
	$jieqiTpl->assign('obookname', $obook->getVar('obookname', 'n'));
	$jieqiTpl->assign('authorid', $obook->getVar('authorid', 'n'));
	$jieqiTpl->assign('author', $obook->getVar('author', 'n'));
	$jieqiTpl->assign('sumemoney', $obook->getVar('sumemoney', 'n'));
	$jieqiTpl->assign('remainemoney', $cremainemoney);
	$jieqiTpl->assign('paidemoney', $obook->getVar('paidemoney', 'n'));
	$jieqiTpl->assign('personsvars', $personsvars);
	foreach ($jieqiOption['obook'] as $k => $v) {
	$jieqiTpl->assign_by_ref($k, $jieqiOption['obook'][$k]);
	}
	
	$jieqiTpl->setCaching(0);
	$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['obook']['path'] . '/templates/admin/paidnew.html'));
	include_once JIEQI_ROOT_PATH . '/admin/footer.php';
	break;
}

?>
