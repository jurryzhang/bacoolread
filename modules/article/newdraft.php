<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if ($_POST['isvip'] != 1) {
	$_POST['isvip'] = 0;
}
else {
	$_POST['isvip'] = 1;
}

jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['article']['newdraft'], $jieqiUsersStatus, $jieqiUsersGroup, false);
jieqi_loadlang('draft', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
jieqi_getconfigs('obook', 'power');
$customprice = jieqi_checkpower($jieqiPower['obook']['customprice'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$uptiming = jieqi_checkpower($jieqiPower['article']['uptiming'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$needupaudit = jieqi_checkpower($jieqiPower['article']['needupaudit'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'draft';
}

switch ($_REQUEST['action']) {
case 'newdraft':
	$_POST['chaptername'] = trim($_POST['chaptername']);
	$errtext = '';

	if (strlen($_POST['chaptername']) == 0) {
		$errtext .= $jieqiLang['article']['need_draft_title'] . '<br />';
	}

	if (strlen($_POST['chaptercontent']) == 0) {
		$errtext .= $jieqiLang['article']['need_draft_content'] . '<br />';
	}

	if ($_POST['isvip'] == 1) {
		$_POST['articleid'] = $_POST['obookid'];
	}

	$_POST['articleid'] = intval($_POST['articleid']);

	if (empty($_POST['articleid'])) {
		$errtext .= $jieqiLang['article']['draft_need_articleid'] . '<br />';
	}

	$articlename = '';

	if ($_POST['isvip'] == 1) {
		/*include_once JIEQI_ROOT_PATH . '/modules/obook/class/obook.php';
		$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
		$obook = $obook_handler->get($_POST['articleid']);

		if (!is_object($obook)) {
			$errtext .= $jieqiLang['article']['draft_noe_article'] . '<br />';
		}
		else {
			$articlename = $obook->getVar('obookname', 'n');
		}*/       
		include_once JIEQI_ROOT_PATH . '/modules/article/class/article.php';
		$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
		$article = $article_handler->get($_POST['articleid']);

		if (!is_object($article)) {
			$errtext .= $jieqiLang['article']['draft_noe_article'] . '<br />';
		}
		else {
			$articlename = $article->getVar('articlename', 'n');
		}
	}
	else {
		include_once JIEQI_ROOT_PATH . '/modules/article/class/article.php';
		$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
		$article = $article_handler->get($_POST['articleid']);

		if (!is_object($article)) {
			$errtext .= $jieqiLang['article']['draft_noe_article'] . '<br />';
		}
		else {
			$articlename = $article->getVar('articlename', 'n');
		}
	}

	if ($_POST['autopub'] == 1) {
		$_POST['pubyear'] = intval(trim($_POST['pubyear']));
		$_POST['pubmonth'] = intval(trim($_POST['pubmonth']));
		$_POST['pubday'] = intval(trim($_POST['pubday']));
		$_POST['pubhour'] = intval(trim($_POST['pubhour']));
		$_POST['pubminute'] = intval(trim($_POST['pubminute']));
		$_POST['pubsecond'] = intval(trim($_POST['pubsecond']));
		$pubtime = @mktime($_POST['pubhour'], $_POST['pubminute'], $_POST['pubsecond'], $_POST['pubmonth'], $_POST['pubday'], $_POST['pubyear']);

		if ($pubtime <= JIEQI_NOW_TIME) {
			$errtext .= $jieqiLang['article']['draft_pubtime_low'] . '<br />';
		}
	}

	if (empty($errtext)) {
		if (($jieqiConfigs['article']['authtypeset'] == 2) || (($jieqiConfigs['article']['authtypeset'] == 1) && ($_POST['typeset'] == 1))) {
			include_once JIEQI_ROOT_PATH . '/lib/text/texttypeset.php';
			$texttypeset = new TextTypeset();
			$_POST['chaptercontent'] = $texttypeset->doTypeset($_POST['chaptercontent']);
		}

		include_once $jieqiModules['article']['path'] . '/class/draft.php';
		$draft_handler = &JieqiDraftHandler::getInstance('JieqiDraftHandler');
		$newDraft = $draft_handler->create();
		$draftsize = strlen(str_replace(array(' ', '¡¡', "\r", "\n"), '', $_POST['chaptercontent']));
		$newDraft->setVar('articleid', $_POST['articleid']);
		$newDraft->setVar('articlename', $articlename);

		if (!empty($_SESSION['jieqiUserId'])) {
			$newDraft->setVar('posterid', $_SESSION['jieqiUserId']);
			$newDraft->setVar('poster', $_SESSION['jieqiUserName']);
		}
		else {
			$newDraft->setVar('posterid', 0);
			$newDraft->setVar('poster', '');
		}

		$newDraft->setVar('postdate', JIEQI_NOW_TIME);
		$newDraft->setVar('lastupdate', JIEQI_NOW_TIME);

		if ($_POST['autopub'] == 1) {
			$newDraft->setVar('ispub', 1);
			$newDraft->setVar('pubdate', $pubtime);
		}
		else {
			$newDraft->setVar('pubdate', 0);
		}

		if ($_POST['isvip'] == 1) {
			$newDraft->setVar('isvip', 1);
			$newDraft->setVar('isvip_n', 1);
		}
		else {
			$newDraft->setVar('isvip', 0);
			$newDraft->setVar('isvip_n', 0);
		}		

		$newDraft->setVar('chaptername', $_POST['chaptername']);
		$newDraft->setVar('chaptercontent', $_POST['chaptercontent']);
		$newDraft->setVar('size', $draftsize);
		$newDraft->setVar('note', '');
		$newDraft->setVar('drafttype', $_POST['isvip']);
		$saleprice = -1;
		if ((0 < $customprice) && ($_POST['isvip'] == 1) && is_numeric($_POST['saleprice'])) {
			$saleprice = intval($_POST['saleprice']);

			if ($saleprice < 0) {
				$saleprice = -1;
			}
		}

		$newDraft->setVar('saleprice', $saleprice);
        if (!$needupaudit) {
	   $newDraft->setVar("display", 1);
         } else {
	   $newDraft->setVar("display", 0);
         }
		if (!$draft_handler->insert($newDraft)) {
			jieqi_printfail($jieqiLang['article']['draft_add_failure']);
		}
		else {
			jieqi_jumppage($article_dynamic_url . '/draft.php', LANG_DO_SUCCESS, $jieqiLang['article']['draft_add_success']);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case 'draft':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	$jieqiTpl->assign('article_static_url', $article_static_url);
	$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
	$articlerows = array();
	include_once $jieqiModules['article']['path'] . '/class/article.php';
	$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
	$criteria = new CriteriaCompo(new Criteria('authorid', $_SESSION['jieqiUserId']));
	$criteria->setLimit(100);
	$article_handler->queryObjects($criteria);
	$k = 0;

	while ($v = $article_handler->getObject()) {
		$articlerows[$k]['articleid'] = $v->getVar('articleid');
		$articlerows[$k]['isvip'] = $v->getVar('isvip');
		$articlerows[$k]['articlename'] = $v->getVar('articlename');
		$k++;
	}

	$jieqiTpl->assign_by_ref('articlerows', $articlerows);
	include_once JIEQI_ROOT_PATH . '/modules/obook/class/obook.php';
	$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
	$obook_handler->queryObjects($criteria);
	$obookrows = array();
	$k = 0;

	while ($v = $obook_handler->getObject()) {
		$obookrows[$k]['obookid'] = $v->getVar('obookid');
		$obookrows[$k]['obookname'] = $v->getVar('obookname');
		$obookrows[$k]['articleid'] = $v->getVar('articleid');
		$k++;
	}

	$jieqiTpl->assign_by_ref('obookrows', $obookrows);

	if ($customprice) {
		$jieqiTpl->assign('customprice', 1);
	}
	else {
		$jieqiTpl->assign('customprice', 0);
	}
	if ($uptiming) {
		$jieqiTpl->assign('uptiming', 1);
	}
	else{
		$jieqiTpl->assign('uptiming', 0);
	}
	if (!$needupaudit) {
		$jieqiTpl->assign('needupaudit', 1);
	}
	else {
		$jieqiTpl->assign('needupaudit', 0);
	}
	$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
	$jieqiTpl->assign('authtypeset', intval($jieqiConfigs['article']['authtypeset']));
	$jieqiTpl->assign('authorarea', 1);
	$jieqiTpl->assign('pubyear', date('Y', JIEQI_NOW_TIME));
	$jieqiTpl->assign('pubmonth', date('m', JIEQI_NOW_TIME));
	$jieqiTpl->assign('pubday', date('d', JIEQI_NOW_TIME));
	$jieqiTpl->assign('pubhour', date('H', JIEQI_NOW_TIME));
	$jieqiTpl->assign('pubminute', date('i', JIEQI_NOW_TIME));
	$jieqiTpl->assign('pubsecond', date('s', JIEQI_NOW_TIME));
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/newdraft.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
