<?php
define('JIEQI_MODULE_NAME', 'article');
require_once ('../../global.php');
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
if (isset($_REQUEST['id'])) {
	$_REQUEST['id'] = intval($_REQUEST['id']);
}
if ((empty($_REQUEST['id']) || !is_numeric($_REQUEST['id']))) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
include_once (JIEQI_ROOT_PATH . '/header.php');

$jieqiTpl->assign('articleid', $_REQUEST['id']);
	//µÀ¾ß
	$jieqiTpl->assign('redroses', intval($jieqiConfigs['article']['redrose']));
	$jieqiTpl->assign('yellowroses', intval($jieqiConfigs['article']['yellowrose']));
	$jieqiTpl->assign('blueroses', intval($jieqiConfigs['article']['bluerose']));
	$jieqiTpl->assign('whiteroses', intval($jieqiConfigs['article']['whiterose']));
	$jieqiTpl->assign('blackroses', intval($jieqiConfigs['article']['blackrose']));
    $jieqiTpl->assign('greenroses', intval($jieqiConfigs['article']['greenrose']));
    $jieqiTpl->assign('eglodname', JIEQI_EGOLD_NAME);
$jieqiTpl->setCaching(0);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/addreward.html';
include_once (JIEQI_ROOT_PATH . '/footer.php');

