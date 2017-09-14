<?php
define('JIEQI_MODULE_NAME', 'system');
require_once 'global.php';
jieqi_checklogin();
jieqi_loadlang('users', JIEQI_MODULE_NAME);
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
$uid = (int)$jieqiUsers->getVar('uid');
if (!$jieqiUsers) {
	jieqi_printfail(LANG_NO_USER);
}

$isUser = mysql_query("select * from `jieqi_system_persons` where `uid`=".$uid." limit 1");
    $rows = mysql_fetch_array($isUser);
	if(!$rows['uid']){
		header("location:../personedit.php");
	}
	else if($rows['telephone'] == '' && $rows['mobilephone'] == ''){
		header("location:../personedit.php");
	}
	include_once JIEQI_ROOT_PATH . '/header.php';
	jieqi_getconfigs("article", "configs");
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign('personsvars', $rows);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = JIEQI_ROOT_PATH . '/templates/persondetail.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';



?>
