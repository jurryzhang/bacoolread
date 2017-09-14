<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (empty($_REQUEST['id'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checklogin();
jieqi_loadlang('gift', JIEQI_MODULE_NAME);
include_once $jieqiModules['article']['path'] . '/class/article.php';
$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
$article = $article_handler->get($_REQUEST['id']);

if (!$article) {
	jieqi_printfail($jieqiLang['article']['article_not_exists']);
}

include_once JIEQI_ROOT_PATH . '/class/class_users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$users = $users_handler->get($_SESSION['jieqiUserId']);
$userset = unserialize($users->getVar('setting', 'n'));


if(!in_array($_REQUEST['type'],array('flower','egg','vipvote','hurry'))){
	jieqi_printfail($jieqiLang['article']['gift_over_error']);
}

$egoldnums = $users->vars['egold']['value'];
jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
$flowerprice = intval($jieqiConfigs['article']['flower']);
$eggprice = intval($jieqiConfigs['article']['egg']);
include_once JIEQI_ROOT_PATH . '/include/funstat.php';
$addnum = intval($_REQUEST['num']);

//判断类型
if($_GET['type'] == 'flower'){
   $gfuname = 'flower';
   $typeuname = '鲜花';
 }else if($_GET['type'] == 'egg'){
   $gfuname = 'egg';
   $typeuname = '鸡蛋';
}else if($_GET['type'] == 'vipvote'){
   $gfuname = 'vipvote';
   $typeuname = '月票';
}else if($_GET['type'] == 'hurry'){
   $gfuname = 'hurry';
   $typeuname = '催更';
 }  

if($_REQUEST['type'] == 'flower'){
	$gift_type = 'flower';
	$typename = '朵鲜花';
	$last = 'lastflower';
	$allnums = 'allflower';
	$monthnums = 'monthflower';
	$weeknums = 'weekflower';
	$daynums = 'dayflower';
	$lasttime = $article->getVar('lastflower', 'n');
	$addorup = jieqi_visit_addorup($lasttime);
	$day = ($addorup['day'] ? $addnum : $article->getVar('dayflower', 'n') + $addnum);
    $week = ($addorup['week'] ? $addnum : $article->getVar('weekflower', 'n') + $addnum);
    $month = ($addorup['month'] ? $addnum : $article->getVar('monthflower', 'n') + $addnum);
    $all = $article->getVar('allflower', 'n') + $addnum;
	if($flowerprice > 0){
	$pricenums = intval(floor($egoldnums / $flowerprice));
	$buynums = intval(floor($_REQUEST['num'] * $flowerprice));
	}
}else if($_REQUEST['type'] == 'hurry'){
	$gift_type = 'hurry';
	$typename = '小说币';
	$last = 'lastegg';
	$allnums = 'allegg';
	$monthnums = 'monthegg';
	$weeknums = 'weekegg';
	$daynums = 'dayegg';
	$lasttime = $article->getVar('lastegg', 'n');
	$addorup = jieqi_visit_addorup($lasttime);
	$day = ($addorup['day'] ? $addnum : $article->getVar('dayegg', 'n') + $addnum);
    $week = ($addorup['week'] ? $addnum : $article->getVar('weekegg', 'n') + $addnum);
    $month = ($addorup['month'] ? $addnum : $article->getVar('monthegg', 'n') + $addnum);
    $all = $article->getVar('allegg', 'n') + $addnum;
	if($eggprice > 0){
	$pricenums = intval(floor($egoldnums / $eggprice));
	$buynums = intval(floor($_REQUEST['num'] * $eggprice));
	}
}else if($_REQUEST['type'] == 'vipvote'){
	$gift_type = 'vipvote';
	$typename = '张月票';
	$pricenums = intval($userset['gift']['vipvote']);
	$vipvotemoney = intval($userset['gift']['vipvote']);
	$lasttime = $article->getVar('lastvipvote', 'n');
	$addorup = jieqi_visit_addorup($lasttime);
	$dayvipvote = ($addorup['day'] ? $addnum : $article->getVar('dayvipvote', 'n') + $addnum);
    $weekvipvote = ($addorup['week'] ? $addnum : $article->getVar('weekvipvote', 'n') + $addnum);
    $monthvipvote = ($addorup['month'] ? $addnum : $article->getVar('monthvipvote', 'n') + $addnum);
	$previpvote = ($addorup['pre'] ? $addnum : $article->getVar('previpvote', 'n') + $addnum);
    $allvipvote = $article->getVar('allvipvote', 'n') + $addnum;
}

if (!is_object($users)) {
	jieqi_printfail($jieqiLang['article']['user_not_exists']);
}

$userisvip = $users->getVar('isvip', 'n');

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'show';
}

switch ($_REQUEST['action']) {
case 'post':
	$errtext = '';
	jieqi_getconfigs('article', 'action', 'jieqiAction');
	$jieqiAction['article']['flower']['paymin'] = intval($jieqiAction['article']['flower']['paymin']);
	$jieqiAction['article']['egg']['paymin'] = intval($jieqiAction['article']['egg']['paymin']);
	$_REQUEST['num'] = intval(trim($_REQUEST['num']));

	if ($_REQUEST['num'] <= 0) {
		$errtext .= $jieqiLang['article'][''.$gift_type.'_over_zero'] . '<br />';
	}
	else if ($_REQUEST['num'] < $jieqiAction['article'][''.$gift_type.'']['paymin']) {
		$errtext .= sprintf($jieqiLang['article'][''.$gift_type.'_over_min'], $jieqiAction['article'][''.$gift_type.'']['paymin']) . '<br />';
	}
	else if ($pricenums < $_REQUEST['num']) {
		$errtext .= $jieqiLang['article'][''.$gift_type.'_over_emoney'] . '<br />';
	}
	if (empty($errtext)) {
		$time = time();
		 //周月总 鲜花、鸡蛋、月票 开始
		 if($_REQUEST['type'] == 'flower' || $_REQUEST['type'] == 'egg'){
			 $criteria = new CriteriaCompo(new Criteria('articleid', $_REQUEST['id']));
			 $article_handler->updatefields(array($last => JIEQI_NOW_TIME, $daynums => $day, $weeknums => $week, $monthnums => $month, $allnums => $all), $criteria);
		$ret = mysql_query("UPDATE jieqi_system_users SET egold = egold - ".$buynums."  WHERE uid = $_SESSION[jieqiUserId]");
		}else{
			$criteria = new CriteriaCompo(new Criteria('articleid', $_REQUEST['id']));
			 $article_handler->updatefields(array('lastvipvote' => JIEQI_NOW_TIME, 'dayvipvote' => $dayvipvote, 'weekvipvote' => $weekvipvote, 'monthvipvote' => $monthvipvote, 'previpvote' => $previpvote, 'allvipvote' => $allvipvote), $criteria);
		//$ret = mysql_query("UPDATE jieqi_system_users SET vipvote = vipvote - ".$_REQUEST[num]."  WHERE uid = $_SESSION[jieqiUserId]");
		if (is_object($users)) {
		    $userset = unserialize($users->getVar('setting', 'n'));
			$userset['gift']['vipvote'] = intval($userset['gift']['vipvote']) - $_REQUEST[num];
             $users->setVar('setting', serialize($userset));
			 $users->saveToSession();
			 $ret=$users_handler->insert($users);
			 }
		}
		//周月总 鲜花、鸡蛋、月票 结束
		if (!$ret) {
			jieqi_printfail($jieqiLang['article']['user_payout_failure']);
		}

		$tid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
		$tname = (0 < $article->getVar('authorid', 'n') ? $article->getVar('author', 'n') : $article->getVar('poster', 'n'));
		include_once $jieqiModules['obook']['path'] . '/include/funbuy.php';
		jieqi_obook_upincome(array('articleid' => $article->getVar('articleid', 'n'), 'egold' => $_REQUEST['num'], 'etype' => 0, 'intype' => $gift_type, 'salenum' => 0));
		include_once $jieqiModules['article']['path'] . '/include/funaction.php';
		$actions = array('actname' => $gift_type, 'actnum' => $_REQUEST['num'], 'actegold' => $_REQUEST['num'], 'actbuy' => 0, 'tid' => $tid, 'tname' => $tname, 'aname' => $article->getVar('articlename', 'n'));
		jieqi_loadlang('action', 'article');
		$actions['review_title'] = sprintf($jieqiLang['article'][''.$gift_type.'_review_title'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $typename);
		$actions['review_content'] = sprintf($jieqiLang['article'][''.$gift_type.'_review_content'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $typename);
		$actions['message_title'] = sprintf($jieqiLang['article'][''.$gift_type.'_message_title'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $typename);
		$actions['message_content'] = sprintf($jieqiLang['article'][''.$gift_type.'_message_content'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $typename);
		jieqi_article_actiondo($actions, $article);
		jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['tip_save_success']);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case 'show':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	$jieqiTpl->assign('article_static_url', $article_static_url);
	$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
	$jieqiTpl->assign('articleid', $article->getVar('articleid'));
	$jieqiTpl->assign('articlename', $article->getVar('articlename'));
	$jieqiTpl->assign('vipid', $article->getVar('vipid'));
	$jieqiTpl->assign('postdate', date(JIEQI_DATE_FORMAT, $article->getVar('postdate')));
	$jieqiTpl->assign('lastupdate', date(JIEQI_DATE_FORMAT, $article->getVar('lastupdate')));
	$jieqiTpl->assign('authorid', $article->getVar('authorid'));
	$jieqiTpl->assign('author', $article->getVar('author'));
	$jieqiTpl->assign('gift_type', $gift_type);
	//$jieqiTpl->assign('flowermoney', $users->vars['flower']['value']);
	//$jieqiTpl->assign('eggmoney', $users->vars['egg']['value']);
	//$jieqiTpl->assign('vipvotemoney', $userset['gift']['vipvote']);
	$jieqiTpl->assign('vipvotemoney', $vipvotemoney);
	$jieqiTpl->assign('flowerprice', $flowerprice);
	$jieqiTpl->assign('eggprice', $eggprice);
	$jieqiTpl->assign('egoldnums', $egoldnums);
	$jieqiTpl->assign('gfuname', $gfuname);
	$jieqiTpl->assign('typeuname', $typeuname);
	

	if (empty($_REQUEST['ajax_request'])) {
		$jieqiTpl->assign('ajax_request', 0);
	}
	else {
		$jieqiTpl->assign('ajax_request', 1);
	}
	
	$jieqiTpl->setCaching(0);
	$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/gift.html'));
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
