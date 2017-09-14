<?php


function jieqi_article_actiondo($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $article_handler;

	if (is_numeric($article))
	{
		if (!is_a($article_handler, 'JieqiArticleHandler'))
		{
			include_once $jieqiModules['article']['path'] . '/class/article.php';
			$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
		}

		$article = $article_handler->get(intval($article));
	}
	
	file_put_contents('$jieqi_article_actiondo.txt',1);
	
	if (!is_object($article))
	{
		return false;
	}
	
	file_put_contents('$jieqi_article_actiondo1.txt',1);

	if (!isset($jieqiAction['article']))
	{
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}
	
	file_put_contents('$jieqi_article_actiondo2.txt',1);
	
	if (!isset($jieqiAction['article'][$actions['actname']]))
	{
		return false;
	}
	
	file_put_contents('$jieqi_article_actiondo3.txt',1);

	if (empty($actions['actnum']))
	{
		$actions['actnum'] = 1;
	}
	
	file_put_contents('$jieqi_article_actiondo4.txt',1);
	
	if (!isset($actions['flower']))
	{
		$actions['flower'] = 0 < $article->getVar('authorid', 'n') ? intval($article->getVar('authorid', 'n')) : intval($article->getVar('posterid', 'n'));
	}
	
	file_put_contents('$jieqi_article_actiondo5.txt',1);
	
	if (!isset($actions['tname']))
	{
		$actions['tname'] = 0 < $article->getVar('authorid', 'n') ? $article->getVar('author', 'n') : $article->getVar('poster', 'n');
	}
	
	file_put_contents('$jieqi_article_actiondo6.txt',1);
	
	if (!isset($actions['no_earn']) || ($actions['no_earn'] == false))
	{
		file_put_contents('$no_earn.txt',1);
		
		jieqi_article_actionearn($actions, $article);
	}
	
	file_put_contents('$jieqi_article_actiondo7.txt',1);
	
	if (!isset($actions['no_record']) || ($actions['no_record'] == false))
	{
		file_put_contents('$no_record.txt',1);
		
		jieqi_article_actionrecord($actions, $article);
	}
	
	file_put_contents('$jieqi_article_actiondo8.txt',1);
	
	if (!isset($actions['no_message']) || ($actions['no_message'] == false))
	{
		file_put_contents('$no_message.txt',1);
		
		jieqi_article_actionmessage($actions, $article);
	}
}

function jieqi_article_actionearn($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $article_handler;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (0 < $jieqiAction['article'][$actions['actname']]['earnscore']) {
		jieqi_article_actionscore($actions, $article);
	}

	if (0 < $jieqiAction['article'][$actions['actname']]['earncredit']) {
		jieqi_article_actioncredit($actions, $article);
	}

	if (isset($jieqiAction['article'][$actions['actname']]['earnvipvote']) && (0 < $jieqiAction['article'][$actions['actname']]['earnvipvote'])) {
		jieqi_article_actionvipvote($actions, $article);
	}
}

function jieqi_article_actionrecord($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $article_handler;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (!empty($jieqiAction['article'][$actions['actname']]['islog'])) {
		jieqi_article_actionlog($actions, $article);
	}

	if (!empty($jieqiAction['article'][$actions['actname']]['isreview'])) {
		jieqi_article_actionreview($actions, $article);
	}
}

function jieqi_article_actionmessage($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $article_handler;
	global $jieqiLang;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (empty($jieqiLang['article']['action'])) {
		jieqi_loadlang('action', 'article');
	}

	if (!empty($jieqiAction['article'][$actions['actname']]['ismessage'])) {
		$authorid = $article->getVar('authorid', 'n');
		$author = $article->getVar('author', 'n');
		$title = (isset($actions['message_title']) ? $actions['message_title'] : $jieqiLang['article'][$actions['actname'] . '_message_title']);
		$content = (isset($actions['message_content']) ? $actions['message_content'] : $jieqiLang['article'][$actions['actname'] . '_message_content']);
		if ((0 < $authorid) && (0 < strlen($content))) {
			include_once JIEQI_ROOT_PATH . '/include/funmessage.php';
			jieqi_sendmessage($authorid, $author, $title, $content);
		}
	}
}

function jieqi_article_actionscore($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $users_handler;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (empty($jieqiAction['article'][$actions['actname']]['earnscore'])) {
		return false;
	}

	if (!is_a($users_handler, 'JieqiUsersHandler')) {
		include_once JIEQI_ROOT_PATH . '/class/userse.php';
		$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
	}

	$uid = (isset($actions['uid']) ? intval($actions['uid']) : intval($_SESSION['jieqiUserId']));

	if (empty($jieqiAction['article'][$actions['actname']]['paybase'])) {
		$jieqiAction['article'][$actions['actname']]['paybase'] = 1;
	}

	if (0 < $jieqiAction['article'][$actions['actname']]['earnscore']) {
		$earnscore = floor((intval($actions['actnum']) * $jieqiAction['article'][$actions['actname']]['earnscore']) / $jieqiAction['article'][$actions['actname']]['paybase']);
	}
	else {
		$earnscore = 0;
	}

	if ($earnscore != 0) {
		$users_handler->changeScore($uid, $earnscore, true);
	}
}

function jieqi_article_actioncredit($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (empty($jieqiAction['article'][$actions['actname']]['earncredit'])) {
		return false;
	}

	$earncredit = 0;

	if (empty($jieqiAction['article'][$actions['actname']]['paybase'])) {
		$jieqiAction['article'][$actions['actname']]['paybase'] = 1;
	}

	if (0 < $jieqiAction['article'][$actions['actname']]['earncredit']) {
		$earncredit = floor((intval($actions['actnum']) * $jieqiAction['article'][$actions['actname']]['earncredit']) / $jieqiAction['article'][$actions['actname']]['paybase']);
	}

	if ($earncredit <= 0) {
		return false;
	}

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	$uid = (isset($actions['uid']) ? intval($actions['uid']) : intval($_SESSION['jieqiUserId']));
	$uname = (isset($actions['uname']) ? $actions['uname'] : $_SESSION['jieqiUserName']);
	$articleid = intval($article->getVar('articleid', 'n'));
	$articlename = $article->getVar('articlename', 'n');
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_othervote') . ' WHERE uid = ' . $uid . ' AND articleid = ' . $articleid . ' LIMIT 0, 1';
	$ret = $query->execute($sql);
	$row = $query->getRow();

	if (is_array($row)) {
		$vars = unserialize($row['vars']);
		$vars[$actions['actname']] = isset($vars[$actions['actname']]) ? $vars[$actions['actname']] + $earncredit : $earncredit;
		$sql = 'UPDATE ' . jieqi_dbprefix('article_othervote') . ' SET shuliang = shuliang + ' . $earncredit;

		if (!empty($actions['actflower'])) {
			$sql .= ', shuliang = shuliang + ' . intval($actions['actflower']);

			if (!empty($actions['actbuy'])) {
				$sql .= ', shuliang = shuliang + ' . intval($actions['actflower']);
			}
		}

		$sql .= ', upnum = upnum + 1, uptime = ' . intval(JIEQI_NOW_TIME) . ', vars = \'' . jieqi_dbslashes(serialize($vars)) . '\' WHERE id = ' . intval($row['id']);
		$ret = $query->execute($sql);
	}
	else {
		$fieldrows = array();
		$fieldrows['articleid'] = $articleid;
		$fieldrows['articlename'] = $articlename;
		$fieldrows['uid'] = $uid;
		$fieldrows['uname'] = $uname;
		$fieldrows['shuliang'] = $earncredit;
		//$fieldrows['payegold'] = 0;
		//$fieldrows['buyegold'] = 0;

		if (!empty($actions['actflower'])) {
			$fieldrows['payflower'] = intval($actions['actflower']);

			if (!empty($actions['actbuy'])) {
				$fieldrows['buyflower'] = intval($actions['actflower']);
			}
		}

		$fieldrows['upnum'] = 1;
		$fieldrows['uptime'] = JIEQI_NOW_TIME;
		$vars = array();
		$vars[$actions['actname']] = $earncredit;
		$fieldrows['vars'] = serialize($vars);
		$sql = $query->makeupsql(jieqi_dbprefix('article_othervote'), $fieldrows, 'INSERT');
		$ret = $query->execute($sql);
	}

	return $ret;
}

function jieqi_article_actionvipvote($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $users_handler;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (empty($jieqiAction['article'][$actions['actname']]['earnvipvote'])) {
		return false;
	}

	if (!is_a($users_handler, 'JieqiUsersHandler')) {
		include_once JIEQI_ROOT_PATH . '/class/userse.php';
		$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
	}

	$uid = (isset($actions['uid']) ? intval($actions['uid']) : intval($_SESSION['jieqiUserId']));

	if (empty($jieqiAction['article'][$actions['actname']]['paybase'])) {
		$jieqiAction['article'][$actions['actname']]['paybase'] = 1;
	}

	if (0 < $jieqiAction['article'][$actions['actname']]['earnvipvote']) {
		$earnvipvote = floor((intval($actions['actnum']) * $jieqiAction['article'][$actions['actname']]['earnvipvote']) / $jieqiAction['article'][$actions['actname']]['paybase']);
	}
	else {
		$earnvipvote = 0;
	}

	if (0 < $earnvipvote) {
		$user = $users_handler->get($uid);

		if (is_object($user)) {
			$userset = unserialize($user->getVar('setting', 'n'));
			$userset['gift']['vipvote'] = intval($userset['gift']['vipvote']) + $earnvipvote;
			$user->setVar('setting', serialize($userset));
			if (!empty($_SESSION['jieqiUserId']) && ($uid == $_SESSION['jieqiUserId'])) {
				$user->saveToSession();
			}

			$users_handler->insert($user);
		}
	}
}

function jieqi_article_actionlog($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (empty($jieqiAction['article'][$actions['actname']]['islog'])) {
		return false;
	}

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	$uid = (isset($actions['uid']) ? intval($actions['uid']) : intval($_SESSION['jieqiUserId']));
	$uname = (isset($actions['uname']) ? $actions['uname'] : $_SESSION['jieqiUserName']);
	$articleid = intval($article->getVar('articleid', 'n'));
	$articlename = $article->getVar('articlename', 'n');
	$fieldrows = array();
	$fieldrows['articleid'] = $articleid;
	$fieldrows['articlename'] = $articlename;
	$fieldrows['uid'] = $uid;
	$fieldrows['uname'] = $uname;
	$fieldrows['tid'] = isset($actions['tid']) ? intval($actions['tid']) : 0;
	$fieldrows['tname'] = isset($actions['tname']) ? $actions['tname'] : '';
	$fieldrows['linkid'] = isset($actions['linkid']) ? intval($actions['linkid']) : 0;
	$fieldrows['acttype'] = isset($actions['acttype']) ? intval($actions['acttype']) : 0;
	$fieldrows['addtime'] = JIEQI_NOW_TIME;
	$fieldrows['actname'] = $actions['actname'];
	$fieldrows['actnum'] = intval($actions['actnum']);
	$fieldrows['islog'] = empty($jieqiAction['article'][$actions['actname']]['islog']) ? 0 : intval($jieqiAction['article'][$actions['actname']]['islog']);
	$fieldrows['isvip'] = empty($jieqiAction['article'][$actions['actname']]['isvip']) ? 0 : intval($jieqiAction['article'][$actions['actname']]['isvip']);

	if (empty($jieqiAction['article'][$actions['actname']]['paybase'])) {
		$jieqiAction['article'][$actions['actname']]['paybase'] = 1;
	}

	if (0 < $jieqiAction['article'][$actions['actname']]['earncredit']) {
		$earncredit = floor((intval($actions['actnum']) * $jieqiAction['article'][$actions['actname']]['earncredit']) / $jieqiAction['article'][$actions['actname']]['paybase']);
	}
	else {
		$earncredit = 0;
	}

	$fieldrows['credit'] = $earncredit;

	if (0 < $jieqiAction['article'][$actions['actname']]['earnscore']) {
		$earnscore = floor((intval($actions['actnum']) * $jieqiAction['article'][$actions['actname']]['earnscore']) / $jieqiAction['article'][$actions['actname']]['paybase']);
	}
	else {
		$earnscore = 0;
	}

	$fieldrows['score'] = $earnscore;
	$fieldrows['egold'] = empty($actions['actegold']) ? 0 : intval($actions['actegold']);
	$sql = $query->makeupsql(jieqi_dbprefix('article_actlog'), $fieldrows, 'INSERT');
	$ret = $query->execute($sql);
	return $ret;
}

function jieqi_article_autoreview($articleid, $title, $content)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	include_once JIEQI_ROOT_PATH . '/include/funpost.php';
	$check_errors = array();
	$post_set = array('module' => 'article', 'ownerid' => intval($articleid), 'topicid' => 0, 'postid' => 0, 'posttime' => JIEQI_NOW_TIME, 'topictitle' => $title, 'posttext' => $content, 'attachment' => '', 'emptytitle' => true, 'isnew' => true, 'istopic' => 1, 'istop' => 0, 'sname' => 'jieqiArticleReviewTime', 'attachfile' => '', 'oldattach' => '', 'checkcode' => false);
	include_once $jieqiModules['article']['path'] . '/class/reviews.php';
	$reviews_handler = &JieqiReviewsHandler::getInstance('JieqiReviewsHandler');
	$newReview = $reviews_handler->create();
	jieqi_topic_newset($post_set, $newReview);
	$reviews_handler->insert($newReview);
	$post_set['topicid'] = $newReview->getVar('topicid', 'n');
	include_once $jieqiModules['article']['path'] . '/class/replies.php';
	$replies_handler = &JieqiRepliesHandler::getInstance('JieqiRepliesHandler');
	$newReply = $replies_handler->create();
	jieqi_post_newset($post_set, $newReply);
	$replies_handler->insert($newReply);
	return true;
}

function jieqi_article_actionreview($actions, $article)
{
	global $jieqiModules;
	global $jieqiAction;
	global $query;
	global $jieqiLang;

	if (empty($jieqiLang['article']['action'])) {
		jieqi_loadlang('action', 'article');
	}

	if (!isset($jieqiAction['article'])) {
		jieqi_getconfigs('article', 'action', 'jieqiAction');
	}

	if (!isset($jieqiAction['article'][$actions['actname']])) {
		return false;
	}

	if (empty($jieqiAction['article'][$actions['actname']]['isreview'])) {
		return false;
	}

	$articleid = $article->getVar('articleid', 'n');
	$title = (isset($actions['review_title']) ? $actions['review_title'] : $jieqiLang['article'][$actions['actname'] . '_review_title']);
	$content = (isset($actions['review_content']) ? $actions['review_content'] : $jieqiLang['article'][$actions['actname'] . '_review_content']);

	if (0 < strlen($content)) {
		return jieqi_article_autoreview($articleid, $title, $content);
	}
	else {
		return true;
	}
}


?>
