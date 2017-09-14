<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (empty($_REQUEST['id']))
{
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checklogin();
jieqi_loadlang('tip', JIEQI_MODULE_NAME);
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

$userisvip  = $users->getVar('isvip', 'n');
$syncemoney = ($_REQUEST['action'] == 'post' ? false : true);
$usermoney  = $users->getEmoney($syncemoney);

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
		$jieqiAction['article']['tip']['paymin'] = intval($jieqiAction['article']['tip']['paymin']);
		$_REQUEST['payegold'] = intval(trim($_REQUEST['payegold']));
		
		if ($_REQUEST['payegold'] <= 0)
		{
			$errtext .= $jieqiLang['article']['payegold_over_zero'] . '<br />';
		}
		
		if (empty($_REQUEST['pcontent']))
		{
			jieqi_printfail($jieqiLang['article']['review_need_pcontent']);
		}
		else if ($_REQUEST['payegold'] < $jieqiAction['article']['tip']['paymin'])
		{
			$errtext .= sprintf($jieqiLang['article']['payegold_over_min'], $jieqiAction['article']['tip']['paymin']) . '<br />';
		}
		else if ($usermoney['emoney'] < $_REQUEST['payegold'])
		{
			$errtext .= $jieqiLang['article']['payegold_over_emoney'] . '<br />';
		}
		
		if (empty($errtext))
		{
			$ret = $users_handler->payout($users, $_REQUEST['payegold']);
			
			//打赏送月票开始
			$tipnums = $jieqiConfigs['article']['vipvoteegold'];
			$vipvote = intval(floor($_REQUEST['payegold'] / $tipnums));
			
			if($vipvote > 0)
			{
				if (is_object($users))
				{
					$userset             = unserialize($users->getVar('setting', 'n'));
					$userset['vipvote']  = $userset['vipvote'] + $vipvote;
					$userset['vipmonth'] = date( "Y-m", JIEQI_NOW_TIME );
					$users->setVar('setting', serialize($userset));
					$users->saveToSession();
					$users_handler->insert($users);
					
					//burn添加，2016-12-9，更改被打赏的作者数据
					$tmpAuthorid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
					
					$authorHandler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
					$tmpAuthor = $authorHandler->get($tmpAuthorid);
					
					$authorSet = unserialize($tmpAuthor->getVar('setting', 'n'));
					
					$authorSet['vipvote']  = $authorSet['vipvote'] + $vipvote;
					$authorSet['vipmonth'] = date("Y-m", JIEQI_NOW_TIME);
					
					$tmpAuthor->setVar('setting', serialize($authorSet));
					
					$authorHandler->insert($tmpAuthor);
				}
			}
			
			//打赏送月票结束
			if (!$ret)
			{
				jieqi_printfail($jieqiLang['article']['user_payout_failure']);
			}
			
			$tid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
			
			mysql_query("UPDATE jieqi_system_users SET egold = egold + ".$_REQUEST['payegold']."  WHERE uid = ".$tid);
			
			$tname = (0 < $article->getVar('authorid', 'n') ? $article->getVar('author', 'n') : $article->getVar('poster', 'n'));
			
			include_once $jieqiModules['obook']['path'] . '/include/funbuy.php';
			jieqi_obook_upincome(array('articleid' => $article->getVar('articleid', 'n'), 'egold' => $_REQUEST['payegold'], 'etype' => 0, 'intype' => 'tip', 'salenum' => 0));
			
			include_once $jieqiModules['article']['path'] . '/include/funaction.php';
			$actions = array('actname' => 'tip', 'actnum' => $_REQUEST['payegold'], 'actegold' => $_REQUEST['payegold'], 'actbuy' => 0, 'tid' => $tid, 'tname' => $tname, 'aname' => $article->getVar('articlename', 'n'));
			
			jieqi_loadlang('action', 'article');
			$actions['review_title'] = sprintf($jieqiLang['article']['tip_review_title'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME);
			$actions['review_content'] = sprintf($jieqiLang['article']['tip_review_content'], $_REQUEST['pcontent'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME);
			$actions['message_title'] = sprintf($jieqiLang['article']['tip_message_title'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME);
			$actions['message_content'] = sprintf($jieqiLang['article']['tip_message_content'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['payegold'] . JIEQI_EGOLD_NAME);
			
			jieqi_article_actiondo($actions, $article);
			
			$criteria = new CriteriaCompo(new Criteria('articleid', $article->getVar('articleid', 'n')));
			$reviewsnum = $article->getVar('reviewsnum', 'n') +1;
			$article_handler->updatefields(array('reviewsnum' => $reviewsnum), $criteria);
			jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['tip_save_success']);
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
		
		if (empty($_REQUEST['ajax_request']))
		{
			$jieqiTpl->assign('ajax_request', 0);
		}
		else
		{
			$jieqiTpl->assign('ajax_request', 1);
		}
		
		$jieqiTpl->setCaching(0);
		//$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/tip.html'));
		$jieqiTset['jieqi_page_template'] = $jieqiModules['article']['path'] . '/templates/tip.html';
		include_once JIEQI_ROOT_PATH . '/footer.php';
		break;
	}
}

?>
