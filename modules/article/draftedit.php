<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (empty($_REQUEST['id'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST['id'] = intval($_REQUEST['id']);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['article']['newdraft'], $jieqiUsersStatus, $jieqiUsersGroup, false);
jieqi_getconfigs('obook', 'power');
$customprice = jieqi_checkpower($jieqiPower['obook']['customprice'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$uptiming = jieqi_checkpower($jieqiPower['article']['uptiming'], $jieqiUsersStatus, $jieqiUsersGroup, true);
jieqi_loadlang('draft', JIEQI_MODULE_NAME);
include_once $jieqiModules['article']['path'] . '/class/draft.php';
$draft_handler = &JieqiDraftHandler::getInstance('JieqiDraftHandler');
$draft = $draft_handler->get($_REQUEST['id']);

if (!$draft) {
	jieqi_printfail($jieqiLang['article']['draft_not_exists']);
}

if ($draft->getVar('posterid') != $_SESSION['jieqiUserId']) {
	jieqi_printfail($jieqiLang['article']['noper_manage_draft']);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}

switch ($_REQUEST['action']) {
case 'update':
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
		if (($jieqiConfigs['article']['authtypeset'] == 2) || (($jieqiConfigs['article']['authtypeset'] == 1) && ($jieqiConfigs['article']['autotypeset'] == 1) && ($_POST['typeset'] == 1))) {
			include_once JIEQI_ROOT_PATH . '/lib/text/texttypeset.php';
			$texttypeset = new TextTypeset();
			$_POST['chaptercontent'] = $texttypeset->doTypeset($_POST['chaptercontent']);
		}

		$draftsize = strlen(str_replace(array(' ', '¡¡', "\r", "\n"), '', $_POST['chaptercontent']));
		$draft->setVar('articleid', $_POST['articleid']);
		$draft->setVar('articlename', $articlename);
		$draft->setVar('lastupdate', JIEQI_NOW_TIME);
		$draft->setVar('chaptername', $_POST['chaptername']);
		$draft->setVar('chaptercontent', $_POST['chaptercontent']);
		$draft->setVar('size', $draftsize);
		$draft->setVar('drafttype', $_POST['isvip']);
		$saleprice = -1;
		if ((0 < $customprice) && ($_POST['isvip'] == 1) && is_numeric($_POST['saleprice'])) {
			$saleprice = intval($_POST['saleprice']);

			if ($saleprice < 0) {
				$saleprice = -1;
			}
		}

		$draft->setVar('saleprice', $saleprice);
    
		if ($_POST['autopub'] == 1) {
			$draft->setVar('ispub', 1);
			$draft->setVar('pubdate', $pubtime);
		}
		else {
			$draft->setVar('pubdate', 0);
		}
   
		if (!$draft_handler->insert($draft)) {
			jieqi_printfail($jieqiLang['article']['draft_edit_failure']);
		}
		else {
			jieqi_jumppage($article_dynamic_url . '/draft.php', LANG_DO_SUCCESS, $jieqiLang['article']['draft_edit_success']);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case 'edit':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	include_once JIEQI_ROOT_PATH . '/lib/html/formloader.php';
	$articleid = $draft->getVar('articleid');
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

		if ($articleid == $articlerows[$k]['articleid']) {
			$articlerows[$k]['checked'] = 1;
		}
		else {
			$articlerows[$k]['checked'] = 0;
		}

		$k++;
	}

	$jieqiTpl->assign_by_ref('articlerows', $articlerows);
	include_once $jieqiModules['obook']['path'] . '/class/obook.php';
	$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
	$obook_handler->queryObjects($criteria);
	$obookrows = array();
	$k = 0;

	while ($v = $obook_handler->getObject()) {
		$obookrows[$k]['obookid'] = $v->getVar('obookid');
		$obookrows[$k]['obookname'] = $v->getVar('obookname');

		if ($articleid == $obookrows[$k]['obookid']) {
			$obookrows[$k]['checked'] = 1;
		}
		else {
			$obookrows[$k]['checked'] = 0;
		}

		$k++;
	}

	$jieqiTpl->assign_by_ref('obookrows', $obookrows);
	$jieqiTpl->assign('articleid', intval($draft->getVar('articleid')));
	$jieqiTpl->assign('articlename', $draft->getVar('articlename'));
	$jieqiTpl->assign('draftid', $draft->getVar('draftid', 'n'));
	$jieqiTpl->assign('drafttype', $draft->getVar('drafttype'));
	$jieqiTpl->assign('isvip', $draft->getVar('isvip'));
	$jieqiTpl->assign('chaptername', $draft->getVar('chaptername', 'e'));
	$jieqiTpl->assign('chaptercontent', $draft->getVar('chaptercontent', 'e'));
	$jieqiTpl->assign('id', $_REQUEST['id']);
	$jieqiTpl->assign('uptiming', intval($jieqiConfigs['article']['uptiming']));
	$pubdate = intval($draft->getVar('pubdate'));
	$jieqiTpl->assign('pubdate', $pubdate);

	if (0 < $pubdate) {
		$jieqiTpl->assign('pubyear', date('Y', $pubdate));
		$jieqiTpl->assign('pubmonth', date('m', $pubdate));
		$jieqiTpl->assign('pubday', date('d', $pubdate));
		$jieqiTpl->assign('pubhour', date('H', $pubdate));
		$jieqiTpl->assign('pubminute', date('i', $pubdate));
		$jieqiTpl->assign('pubsecond', date('s', $pubdate));
	}
	else {
		$jieqiTpl->assign('pubyear', date('Y', JIEQI_NOW_TIME));
		$jieqiTpl->assign('pubmonth', date('m', JIEQI_NOW_TIME));
		$jieqiTpl->assign('pubday', date('d', JIEQI_NOW_TIME));
	}

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
	$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
	$saleprice = $draft->getVar('saleprice', 'n');

	if ($saleprice < 0) {
		$saleprice = '';
	}

	$jieqiTpl->assign('saleprice', $saleprice);
	$jieqiTpl->assign('authorarea', 1);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/draftedit.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
