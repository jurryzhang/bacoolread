<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';
if (empty($_REQUEST['rid']) || !is_numeric($_REQUEST['rid'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_loadlang('review', JIEQI_MODULE_NAME);
jieqi_includedb();
$article_query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
$criteria = new CriteriaCompo(new Criteria('r.topicid', $_REQUEST['rid']));
$criteria->setTables(jieqi_dbprefix('article_reviews') . ' r LEFT JOIN ' . jieqi_dbprefix('article_article') . ' a ON r.ownerid=a.articleid');
$article_query->queryObjects($criteria);
$topic = $article_query->getObject();
unset($criteria);

if (!$topic) {
	jieqi_printfail($jieqiLang['article']['review_not_exists']);
}

$ownerid = $topic->getVar('ownerid', 'n');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
jieqi_getconfigs('article', 'action', 'jieqiAction');

if (jieqi_checkpower($jieqiPower['article']['newreview'], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
	$enablepost = 1;
}
else {
	$enablepost = 0;
}

if ($_REQUEST['action'] == 'newpost') {
	if (empty($_POST['pcontent'])) {
		jieqi_printfail($jieqiLang['article']['review_need_pcontent']);
	}
	
	if (!$enablepost) {
		jieqi_printfail($jieqiLang['article']['review_noper_post']);
	}

	if (!empty($jieqiAction['article']['reviewadd']['minscore']) && ($_SESSION['jieqiUserScore'] < intval($jieqiAction['article']['reviewadd']['minscore']))) {
		jieqi_printfail(sprintf($jieqiLang['article']['review_score_limit'], intval($jieqiAction['article']['reviewadd']['minscore'])));
	}
}


include_once JIEQI_ROOT_PATH . '/include/funpost.php';
$addnewreply = 0;
if (!empty($_POST['pcontent']) && $enablepost) {
	$check_errors = array();
	$post_set = array('module' => JIEQI_MODULE_NAME, 'ownerid' => intval($ownerid), 'topicid' => intval($_REQUEST['rid']), 'postid' => 0, 'posttime' => JIEQI_NOW_TIME, 'topictitle' => $_POST['ptitle'], 'posttext' => $_POST['pcontent'], 'attachment' => '', 'isnew' => true, 'istopic' => 0, 'istop' => 0, 'sname' => 'jieqiArticleReviewTime', 'attachfile' => '', 'oldattach' => '', 'checkcode' => $_POST['checkcode']);
	jieqi_post_checkvar($post_set, $jieqiConfigs['article'], $check_errors);

	if (empty($check_errors)) {
		include_once $jieqiModules['article']['path'] . '/class/replies.php';
		$replies_handler = &JieqiRepliesHandler::getInstance('JieqiRepliesHandler');
		$newReply = $replies_handler->create();
		jieqi_post_newset($post_set, $newReply);
		$replies_handler->insert($newReply);
		$addnewreply = 1;
		$_REQUEST['page'] = 'last';
		$taskmodule = 'article';
		$taskname = 'replyadd';
		jieqi_getconfigs('system', 'tasks', 'jieqiTasks');
		if (!empty($jieqiTasks[$taskmodule][$taskname]['score']) && empty($_SESSION['jieqiUserSet']['tasks'][$taskmodule][$taskname])) {
			include_once JIEQI_ROOT_PATH . '/class/users.php';
			$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
			$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
			$userset = unserialize($jieqiUsers->getVar('setting', 'n'));
			$userset['tasks'][$taskmodule][$taskname] = 1;
			$jieqiUsers->setVar('setting', serialize($userset));
			$jieqiUsers->setVar('score', intval($jieqiUsers->getVar('score', 'n')) + intval($jieqiTasks[$taskmodule][$taskname]['score']));
			$jieqiUsers->saveToSession();
			$users_handler->insert($jieqiUsers);
		}
		include_once $jieqiModules['article']['path'] . '/include/funaction.php';
		$actions = array('actname' => 'replyadd', 'actnum' => 1);
		jieqi_article_actiondo($actions, $article);


		
//		jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['reviews_post_success']);
//		include_once $jieqiModules['article']['path'] . '/include/funaction.php';
//		$actions = array('actname' => 'replyadd', 'actnum' => 1);
//		jieqi_article_actiondo($actions, $article);
//		if (!empty($_REQUEST['ajax_request'])) {
//			jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['reviews_post_success']);
//		}
	}
	else {
		jieqi_printfail(implode('<br />', $check_errors));
	}
}

$canedit = jieqi_checkpower($jieqiPower['article']['manageallreview'], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$canedit && !empty($_SESSION['jieqiUserId'])) {
	$tmpvar = $_SESSION['jieqiUserId'];
	if ((0 < $tmpvar) && (($topic->getVar('authorid') == $tmpvar) || ($topic->getVar('posterid') == $tmpvar) || ($topic->getVar('agentid') == $tmpvar))) {
		$canedit = true;
	}
}

if ($canedit && isset($_REQUEST['action']) && isset($_REQUEST['did']) && ($_REQUEST['action'] == 'del') && is_numeric($_REQUEST['did'])) {
	include_once $jieqiModules['article']['path'] . '/class/replies.php';
	$replies_handler = &JieqiRepliesHandler::getInstance('JieqiRepliesHandler');

	if (!empty($jieqiAction['article']['reviewadd']['earnscore'])) {
		$replyobj = $replies_handler->get(intval($_REQUEST['did']));

		if (is_object($replyobj)) {
			include_once JIEQI_ROOT_PATH . '/class/users.php';
			$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
			$users_handler->changeScore(intval($replyobj->getVar('posterid', 'n')), $jieqiAction['article']['reviewadd']['earnscore'], false);
		}
	}

	$replies_handler->delete(intval($_REQUEST['did']));
	$addnewreply = -1;
}

$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/reviewshow.html';
include_once JIEQI_ROOT_PATH . '/header.php';
$jieqiPset = jieqi_get_pageset();
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);
$jieqiTpl->assign('article_static_url', $article_static_url);
$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
$jieqiTpl->assign('ownerid', $topic->getVar('ownerid'));
$jieqiTpl->assign('articleid', $topic->getVar('articleid'));
$jieqiTpl->assign('articlename', $topic->getVar('articlename'));
$jieqiTpl->assign('topicid', $topic->getVar('topicid'));
$jieqiTpl->assign('title', $topic->getVar('title'));

if ($canedit) {
	$jieqiTpl->assign('ismaster', 1);
}
else {
	$jieqiTpl->assign('ismaster', 0);
}

$jieqiTpl->assign('url_articleinfo', jieqi_geturl('article', 'article', $topic->getVar('ownerid'), 'info', $topic->getVar('articlecode', 'n')));
include_once JIEQI_ROOT_PATH . '/class/users.php';
jieqi_getconfigs('system', 'honors');

if (!isset($jieqiConfigs['system'])) {
	jieqi_getconfigs('system', 'configs');
}

if (!empty($jieqiModules['badge']['publish']) && is_file($jieqiModules['badge']['path'] . '/include/badgefunction.php')) {
	include_once $jieqiModules['badge']['path'] . '/include/badgefunction.php';
	$jieqi_use_badge = 1;
	$jieqiTpl->assign('jieqi_use_badge', 1);
}
else {
	$jieqi_use_badge = 0;
	$jieqiTpl->assign('jieqi_use_badge', 0);
}

$criteria = new CriteriaCompo(new Criteria('r.topicid', $_REQUEST['rid']));
$criteria->setTables(jieqi_dbprefix('article_replies') . ' r LEFT JOIN ' . jieqi_dbprefix('system_users') . ' u ON r.posterid=u.uid');
$criteria->setSort('r.postid');
$criteria->setOrder('ASC');
$criteria->setLimit($jieqiPset['rows']);
$jieqiPset['count'] = $article_query->getCount($criteria);
if (isset($_REQUEST['page']) && ($_REQUEST['page'] == 'last')) {
	$_REQUEST['page'] = ceil($jieqiPset['count'] / $jieqiPset['rows']);
	$jieqiPset['page'] = $_REQUEST['page'];
	$jieqiPset['start'] = ($jieqiPset['page'] - 1) * $jieqiPset['rows'];
}

$criteria->setStart($jieqiPset['start']);
$article_query->queryObjects($criteria);
include_once JIEQI_ROOT_PATH . '/lib/text/textconvert.php';
$ts = TextConvert::getInstance('TextConvert');
$replyrows = array();
$k = 0;

while ($review = $article_query->getObject()) {
	$addvars = array('order' => (($jieqiPset['page'] - 1) * $jieqiPset['rows']) + $k + 1);
	$replyrows[$k] = jieqi_post_vars($review, $jieqiConfigs['article'], $addvars, true);
	$k++;
}

$jieqiTpl->assign_by_ref('replyrows', $replyrows);
$jieqiTpl->assign('enablepost', $enablepost);

if (!isset($jieqiConfigs['system'])) {
	jieqi_getconfigs('system', 'configs');
}

$jieqiTpl->assign('postcheckcode', $jieqiConfigs['system']['postcheckcode']);
include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());

if (0 < $addnewreply) {
	$lastinfo = serialize(array('time' => JIEQI_NOW_TIME, 'uid' => intval($_SESSION['jieqiUserId']), 'uname' => strval($_SESSION['jieqiUserName'])));
	$article_query->execute('UPDATE ' . jieqi_dbprefix('article_reviews') . ' SET views=views+1,replies=replies+1,replierid=' . intval($_SESSION['jieqiUserId']) . ',replier=\'' . jieqi_dbslashes(strval($_SESSION['jieqiUserName'])) . '\',replytime=' . JIEQI_NOW_TIME . ',lastinfo=\'' . jieqi_dbslashes($lastinfo) . '\' WHERE topicid=' . $_REQUEST['rid']);
	jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['reviews_post_success']);
}
else if ($addnewreply < 0) {
	$article_query->execute('UPDATE ' . jieqi_dbprefix('article_reviews') . ' SET views=views+1,replies=replies-1 WHERE topicid=' . $_REQUEST['rid']);
}
else {
	include_once JIEQI_ROOT_PATH . '/include/funstat.php';
	jieqi_visit_stat($_REQUEST['rid'], jieqi_dbprefix('article_reviews'), 'views', 'topicid', $article_query);
}

$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/footer.php';

?>
