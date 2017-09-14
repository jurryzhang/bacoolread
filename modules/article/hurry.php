<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (empty($_REQUEST['id']))
{
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checklogin();
jieqi_loadlang('hurry', JIEQI_MODULE_NAME);
include_once $jieqiModules['article']['path'] . '/class/hurry.php';
$hurry_handler = &JieqiHurryHandler::getInstance('JieqiHurryHandler');
$hurry = $hurry_handler->create();

include_once $jieqiModules['article']['path'] . '/class/article.php';
$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
$article = $article_handler->get($_REQUEST['id']);

if (!$article)
{
	jieqi_printfail($jieqiLang['article']['article_not_exists']);
}

include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$users = $users_handler->get($_SESSION['jieqiUserId']);

if (!is_object($users))
{
	jieqi_printfail($jieqiLang['article']['user_not_exists']);
}

$userisvip = $users->getVar('isvip', 'n');
$syncemoney = ($_REQUEST['action'] == 'post' ? false : true);
$usermoney = $users->getEmoney($syncemoney);

if ($usermoney['emoney'] <= 0)
{
	jieqi_printfail($jieqiLang['article']['user_no_emoney']);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

if (!isset($_REQUEST['action']))
{
	$_REQUEST['action'] = 'show';
}

switch ($_REQUEST['action'])
{
	case 'post':
	{
		$errtext = '';
		jieqi_getconfigs('article', 'action', 'jieqiAction');
		$jieqiAction['article']['hurry']['paymin'] = intval($jieqiAction['article']['hurry']['paymin']);
		$_REQUEST['payegold'] = intval(trim($_REQUEST['payegold']));
		if (empty($_REQUEST['pcontent']))
		{
			jieqi_printfail($jieqiLang['article']['review_need_pcontent']);
		}
		
		if ($_REQUEST['payegold'] <= 0)
		{
			$errtext .= $jieqiLang['article']['payegold_over_zero'] . '<br />';
		}
		else if ($_REQUEST['payegold'] < $jieqiAction['article']['hurry']['paymin'])
		{
			$errtext .= sprintf($jieqiLang['article']['payegold_over_min'], $jieqiAction['article']['hurry']['paymin']) . '<br />';
		}
		else if ($usermoney['emoney'] < $_REQUEST['payegold'])
		{
			$errtext .= $jieqiLang['article']['payegold_over_emoney'] . '<br />';
		}
		
		$_POST['overyear']   = intval(trim($_POST['overyear']));
		$_POST['overmonth']  = intval(trim($_POST['overmonth']));
		$_POST['overday']    = intval(trim($_POST['overday']));
		$_POST['overhour']   = intval(trim($_POST['overhour']));
		$_POST['overminute'] = intval(trim($_POST['overminute']));
		$_POST['oversecond'] = intval(trim($_POST['oversecond']));
		$overtime            = @mktime($_POST['overhour'], $_POST['overminute'], $_POST['oversecond'], $_POST['overmonth'], $_POST['overday'], $_POST['overyear']);
		$time                = JIEQI_NOW_TIME;
		
		if ($overtime <= $time)
		{
			$errtext .= $jieqiLang['article']['hurry_pubtime_low'] . '<br />';
		}
		
		if (empty($errtext))
		{
			$articlename = $article->getVar('articlename');
			$authorid    = $article->getVar('authorid');
			$articleid   = $article->getVar('articleid');
			$uid         = $users->getVar('uid');
			$uname       = $users->getVar('uname');
			
			$hurry->setVar('articleid', $_REQUEST['id']);
			$obid = $_REQUEST['id'];
		
			if($article->getVar('isvip', 'n') > 0)
			{
				$result = mysql_query("select obookid from jieqi_obook_obook where articleid = '$obid'");
				$row    = mysql_fetch_array($result);
				$vipid  = $row['obookid'];
			}
			else
			{
				$vipid = 0;
			}
			
			$hurry->setVar('vipid', $vipid);
			$hurry->setVar('articlename', $articlename);
			$hurry->setVar('authorid', $authorid);
			$hurry->setVar('uid', $uid);
			$hurry->setVar('uname', $uname);
			$hurry->setVar('addtime', JIEQI_NOW_TIME);
			$hurry->setVar('minsize', $_REQUEST['minsize']);
			$hurry->setVar('payegold', $_REQUEST['payegold']);
			//		$hurry->setVar('winegold', $_REQUEST['payegold']);
			$hurry->setVar('overtime', $overtime);
			$acdate = date('Y-m-d H:i:s', $overtime);
			$hurry->setVar('payflag', 0);
			$hurry_handler->insert($hurry);
			
			$ret = $users_handler->payout($users, $_REQUEST['payegold']);
			
			if (!$ret)
			{
				jieqi_printfail($jieqiLang['article']['user_payout_failure']);
			}
			
			$tid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
			
			//burn添加，2016-12-09
			mysql_query("UPDATE jieqi_system_users SET egold = egold + " . $_REQUEST['payegold'] . "  WHERE uid = ".$tid);
			
			mysql_query("UPDATE jieqi_obook_obook SET sumhurry = sumhurry + " . $_REQUEST['payegold'] . ",sumemoney = sumemoney + " . $_REQUEST['payegold'] . "  WHERE articleid = ".$obid);
			
			$tname = (0 < $article->getVar('authorid', 'n') ? $article->getVar('author', 'n') : $article->getVar('poster', 'n'));
			
			include_once $jieqiModules['article']['path'] . '/include/funaction.php';
			$actions = array('actname' => 'hurry', 'actnum' => $_REQUEST['payegold'], 'actegold' => $_REQUEST['payegold'], 'actbuy' => 0,'actdate' => $acdate,'actsize' => $_REQUEST['minsize'], 'tid' => $tid, 'tname' => $tname, 'aname' => $article->getVar('articlename', 'n'));
			jieqi_loadlang('action', 'article');
			$actions['review_title'] = sprintf($jieqiLang['article']['hurry_review_title'], $_SESSION['jieqiUserName'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME,$actions['aname']);
			$actions['review_content'] = sprintf($jieqiLang['article']['hurry_review_content'], $_REQUEST['pcontent'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME , $actions['aname'],$actions['actdate'],$actions['actsize']);
			$actions['message_title'] = sprintf($jieqiLang['article']['hurry_message_title'], $_SESSION['jieqiUserName'],  $_REQUEST['payegold'] . JIEQI_EGOLD_NAME,$actions['aname']);
			$actions['message_content'] = sprintf($jieqiLang['article']['hurry_message_content'], $_SESSION['jieqiUserName'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME , $actions['aname'],$actions['actdate'],$actions['actsize']);
			jieqi_article_actiondo($actions, $article);
			$criteria = new CriteriaCompo(new Criteria('articleid', $article->getVar('articleid', 'n')));
			$reviewsnum = $article->getVar('reviewsnum', 'n') +1;
			$article_handler->updatefields(array('reviewsnum' => $reviewsnum), $criteria);
			jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['hurry_save_success']);
		}
		else
		{
			jieqi_printfail($errtext);
		}
		
		break;
	}
	case 'show':
	default:
	{
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
		$jieqiTpl->assign('useremoney', $usermoney['emoney']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('overyear', date('Y', JIEQI_NOW_TIME));
		$jieqiTpl->assign('overmonth', date('m', JIEQI_NOW_TIME));
		$jieqiTpl->assign('overday', date('d', JIEQI_NOW_TIME));
		$jieqiTpl->assign('overhour', date('H', JIEQI_NOW_TIME));
		$jieqiTpl->assign('overminute', date('i', JIEQI_NOW_TIME));
		$jieqiTpl->assign('oversecond', date('s', JIEQI_NOW_TIME));
		$jieqiTpl->assign('orver', JIEQI_NOW_TIME);
		$jieqiTpl->assign('pubtime', $pubtime);
		
		if (empty($_REQUEST['ajax_request']))
		{
			$jieqiTpl->assign('ajax_request', 0);
		}
		else
		{
			$jieqiTpl->assign('ajax_request', 1);
		}
		
		$jieqiTpl->setCaching(0);
		//$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/hurry.html'));
		$jieqiTset['jieqi_page_template'] = $jieqiModules['article']['path'] . '/templates/hurry.html';
		include_once JIEQI_ROOT_PATH . '/footer.php';
		break;
	}
}

?>
