<?php

define('JIEQI_MODULE_NAME', 'system');
require_once 'global.php';
jieqi_checklogin();
jieqi_loadlang('users', JIEQI_MODULE_NAME);
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
$username = $jieqiUsers->getVar('uname');
$uid = (int)$jieqiUsers->getVar('uid');
if (!$jieqiUsers) {
	jieqi_printfail(LANG_NO_USER);
}

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}
//检测该用户是否填写过资料
$isUser = mysql_query("select * from `jieqi_system_persons` where `uid`={$uid} limit 1");
$rows = mysql_fetch_array($isUser);

switch ($_REQUEST['action']) {
case 'update':
    $errtext = '';
    if($_REQUEST['p_realname'] == ''){
		$errtext .= $jieqiLang['system']['persons_need_realname'] . '<br />';
	}
	else if($rows['denyedit'] > 0){
		$errtext .= $jieqiLang['system']['persons_is_denyedit'] . '<br />';
	}
if (empty($errtext)) {
	$bankcard = preg_replace('/\D/','',$_REQUEST['p_bankcard']);
	if(!$rows['uid']){
		$ret = mysql_query("insert into `jieqi_system_persons` set `uid`=".$uid.", `username`='$username', `realname` = '$_REQUEST[p_realname]', `gender` = '$_REQUEST[p_gender]', `telephone` = '$_REQUEST[p_telephone]', `mobilephone` = '$_REQUEST[p_mobilephone]', `idcardtype` = '$_REQUEST[p_idcardtype]', `idcard` = '$_REQUEST[p_idcard]', `address` = '$_REQUEST[p_address]', `zipcode` = '$_REQUEST[p_zipcode]', `banktype` = '$_REQUEST[p_banktype]', `bankname` = '$_REQUEST[p_bankname]', `bankcard` = '$bankcard', `bankuser` = '$_REQUEST[p_bankuser]', `mynote` = '$_REQUEST[p_mynote]', `qq` = '$_REQUEST[p_qq]', `denyedit` = '1'");
	}else{
		$ret = mysql_query("UPDATE `jieqi_system_persons` set `uid`=".$uid.", `username`='$username', `realname` = '$_REQUEST[p_realname]', `gender` = '$_REQUEST[p_gender]', `telephone` = '$_REQUEST[p_telephone]', `mobilephone` = '$_REQUEST[p_mobilephone]', `idcardtype` = '$_REQUEST[p_idcardtype]', `idcard` = '$_REQUEST[p_idcard]', `address` = '$_REQUEST[p_address]', `zipcode` = '$_REQUEST[p_zipcode]', `banktype` = '$_REQUEST[p_banktype]', `bankname` = '$_REQUEST[p_bankname]', `bankcard` = '$bankcard', `bankuser` = '$_REQUEST[p_bankuser]', `mynote` = '$_REQUEST[p_mynote]', `qq` = '$_REQUEST[p_qq]', `denyedit` = '1' WHERE `uid` = '$uid'");
	}
	if (!$ret) {
			jieqi_printfail($jieqiLang['system']['persons_edit_failure']);
		}	
	$_REQUEST['uid'] = $_SESSION['jieqiUserId'];
	$_REQUEST['jumpurl'] = JIEQI_URL . '/persondetail.php';
	jieqi_useraction('edit', $_REQUEST);
}else{
	jieqi_printfail($errtext);
}
	break;

case 'edit':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	jieqi_getconfigs("article", "configs");
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign('personsvars', $rows);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = JIEQI_ROOT_PATH . '/templates/personedit.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
