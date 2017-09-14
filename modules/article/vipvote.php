<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (empty($_REQUEST['id']))
{
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checklogin();
jieqi_loadlang('vipvote', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "action");
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$users = $users_handler->get($_SESSION['jieqiUserId']);

if (!is_object($users))
{
	jieqi_printfail(LANG_NO_USER);
}else if ($users->getvar( "isvip" ) == 0)
{
	jieqi_printfail( $jieqiLang['article']['need_vip_user'] );
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
include_once JIEQI_ROOT_PATH . '/include/funstat.php';
$userset = unserialize($users->getVar('setting', 'n'));
$thismonth = date("Y-m", JIEQI_NOW_TIME);
$maxvote = $jieqiConfigs['article']['vipvotenums'];

//判断类型
if (isset( $_SESSION['jieqiEgoldMonth']))
{
	$egoldmonth = $_SESSION['jieqiEgoldMonth'];
}
else
{
	$tmpvar     = explode("-", date( "Y-m-d", JIEQI_NOW_TIME ));
	$monthstart = mktime(0, 0, 0, (integer)$tmpvar[1], 1, (integer)$tmpvar[0]);
	$tmpvar     = explode("-", date("Y-m-d", strtotime("+1 month", JIEQI_NOW_TIME )));
	$monthend   = mktime(0, 0, 0, (integer)$tmpvar[1], 1, ( integer )$tmpvar[0]);
	$sql        = "SELECT SUM(egold) as egoldmonth FROM ".jieqi_dbprefix( "article_actlog" )." WHERE tid=".$_SESSION['jieqiUserId']." AND addtime>=".$monthstart." AND addtime<".$monthend;
	$query      = jieqiqueryhandler::getinstance( "JieqiQueryHandler" );
	$query->execute($sql);
	$res        = $query->getobject();
	
	if (is_object($res))
	{
		$egoldmonth = intval( $res->getvar("egoldmonth", "n"));
	}
	else
	{
		$egoldmonth = 0;
	}
	
	$GLOBALS['_SESSION']['jieqiEgoldMonth'] = $egoldmonth;
}

if (0 < $jieqiConfigs['article']['vipvoteegold'])
{
	$vipvote = floor($maxvote + $egoldmonth / intval($jieqiConfigs['article']['vipvoteegold']));

	if ($userset['vipmonth'] != $thismonth && is_object($users))
	{
		$userset['vipvote']  = $vipvote;
		$userset['vipmonth'] = $thismonth;
		$users->setVar('setting', serialize($userset));
		$users->saveToSession();
		$ret = $users_handler->insert($users);
		
		//burn添加，2016-12-9，更改被打赏的作者数据
		$tmpAuthorid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
		
		$authorHandler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
		$tmpAuthor = $authorHandler->get($tmpAuthorid);
		
		$authorSet = unserialize($tmpAuthor->getVar('setting', 'n'));
		
		$authorSet['vipvote']  = $authorSet['vipvote'] + $_REQUEST['num'];
		$authorSet['vipmonth'] = date("Y-m", JIEQI_NOW_TIME);
		
		$tmpAuthor->setVar('setting', serialize($authorSet));
		
		$authorHandler->insert($tmpAuthor);
	}
}

include_once( $jieqiModules['article']['path']."/class/article.php" );
$article_handler =& jieqiarticlehandler::getinstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST['id']);

if (!$article)
{
	jieqi_printfail($jieqiLang['article']['article_not_exists']);
}
else if ($article->getvar( "authorid" ) == 0)
{
	jieqi_printfail($jieqiLang['article']['article_not_self']);
}

$addnum       = intval($_REQUEST['num']);
$lasttime     = $article->getVar('lastvipvote', 'n');
$addorup      = jieqi_visit_addorup($lasttime);
$dayvipvote   = ($addorup['day'] ? $addnum : $article->getVar('dayvipvote', 'n') + $addnum);
$weekvipvote  = ($addorup['week'] ? $addnum : $article->getVar('weekvipvote', 'n') + $addnum);
$monthvipvote = ($addorup['month'] ? $addnum : $article->getVar('monthvipvote', 'n') + $addnum);
$allvipvote = $article->getVar('allvipvote', 'n') + $addnum;

//表格
if (!isset($_REQUEST['action']))
{
	$_REQUEST['action'] = 'show';
}

switch ($_REQUEST['action'])
{
	case 'post':
	{
		$errtext = '';
		$_REQUEST['num'] = intval(trim($_REQUEST['num']));
		
		if ($_REQUEST['num'] <= 0)
		{
			$errtext .= $jieqiLang['article']['vote_over_zero'] . '<br />';
		}
		else if ($userset['vipvote'] < $_REQUEST['num'])
		{
			$errtext .= $jieqiLang['article']['vote_over_emoney'] . '<br />';
		}
		
		if (empty($errtext))
		{
			//周月总 月票 开始
			$criteria = new CriteriaCompo(new Criteria('articleid', $_REQUEST['id']));
			$article_handler->updatefields(array('lastvipvote' => JIEQI_NOW_TIME, 'dayvipvote' => $dayvipvote, 'weekvipvote' => $weekvipvote, 'monthvipvote' => $monthvipvote, 'allvipvote' => $allvipvote), $criteria);
			
			if (is_object($users))
			{
				$userset['vipvote'] = intval($userset['vipvote']) - $_REQUEST['num'];
				$userset['vipmonth'] = date("Y-m", JIEQI_NOW_TIME);
				$users->setVar('setting', serialize($userset));
				$users->saveToSession();
				$ret = $users_handler->insert($users);
				
				//burn添加，2016-12-9，更改被打赏的作者数据
				$tmpAuthorid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
				
				$authorHandler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
				$tmpAuthor = $authorHandler->get($tmpAuthorid);
				
				$authorSet = unserialize($tmpAuthor->getVar('setting', 'n'));
				
				$authorSet['vipvote']  = $authorSet['vipvote'] + $_REQUEST['num'];
				$authorSet['vipmonth'] = date("Y-m", JIEQI_NOW_TIME);
				
				$tmpAuthor->setVar('setting', serialize($authorSet));
				
				$authorHandler->insert($tmpAuthor);
			}
			
			//周月总 月票 结束
			if (!$ret)
			{
				jieqi_printfail($jieqiLang['article']['user_payout_failure']);
			}
			
			$name = '张月票';
			$tid  = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
			$tname = (0 < $article->getVar('authorid', 'n') ? $article->getVar('author', 'n') : $article->getVar('poster', 'n'));
			include_once $jieqiModules['obook']['path'] . '/include/funbuy.php';
			jieqi_obook_upincome(array('articleid' => $article->getVar('articleid', 'n'), 'egold' => 0, 'etype' => 0, 'intype' => 'vipvote', 'salenum' => 0));
			include_once $jieqiModules['article']['path'] . '/include/funaction.php';
			$actions = array('actname' => 'vipvote', 'actnum' => $_REQUEST['num'], 'actegold' => 0, 'actbuy' => 0, 'tid' => $tid, 'tname' => $tname, 'aname' => $article->getVar('articlename', 'n'));
			jieqi_loadlang('action', 'article');
			$actions['review_title'] = sprintf($jieqiLang['article']['vipvote_review_title'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $name);
			
			if(empty($_REQUEST['pcontent']))
			{
				$actions['review_content'] = sprintf($jieqiLang['article']['vipvote_review_content'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $name);
			}
			else
			{
				$actions['review_content'] = $_REQUEST['pcontent'];
			}
			
			$actions['message_title'] = sprintf($jieqiLang['article']['vipvote_message_title'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $name);
			$actions['message_content'] = sprintf($jieqiLang['article']['vipvote_message_content'], $_SESSION['jieqiUserName'], $actions['aname'], $_REQUEST['num'] . $name);
			jieqi_article_actiondo($actions, $article);
			jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['vote_success']);
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
		$jieqiTpl->assign('vipvote', $userset['vipvote']);
		
		if (empty($_REQUEST['ajax_request']))
		{
			$jieqiTpl->assign('ajax_request', 0);
		}
		else
		{
			$jieqiTpl->assign('ajax_request', 1);
		}
		
		$jieqiTpl->setCaching(0);
		//$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/vipvote.html'));
		$jieqiTset['jieqi_page_template'] = $jieqiModules['article']['path'] . '/templates/vipvote.html';
		include_once JIEQI_ROOT_PATH . '/footer.php';
		break;
	}
}
?>
