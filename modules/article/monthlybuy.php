<?php
define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'show';
}
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['article']['mouthlybuy'], $jieqiUsersStatus, $jieqiUsersGroup, false); //验证权限
//载入配置
jieqi_loadlang('monthlys', JIEQI_MODULE_NAME);
jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
jieqi_getconfigs("article", "option", "jieqiOption");
jieqi_getconfigs('obook', 'power');

$customprice = jieqi_checkpower($jieqiPower['obook']['customprice'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);
	if($_GET['id'] == '1'){
      $gfuname = $jieqiConfigs['article']['vip'];
    }else if($_GET['id'] == '2'){
      $gfuname = $jieqiConfigs['article']['monthlys'];
      $size = $jieqiConfigs['article']['monthlysize'];
    }else if($_GET['id'] == '3'){
      $gfuname = $jieqiConfigs['article']['qianyue'];
    }else if($_GET['id'] == '4'){
      $gfuname = $jieqiConfigs['article']['jings'];
      $size = $jieqiConfigs['article']['jingsize'];
    }else if($_GET['id'] == '5'){
      $gfuname = $jieqiConfigs['article']['fengmian'];
      $size = $jieqiConfigs['article']['fengmiansize'];
    }else if($_GET['id'] == '6'){
      $gfuname = $jieqiConfigs['article']['vipbook'];
      $size = $jieqiConfigs['article']['vipsize'];
    } 
$id = $_GET['id'];
switch ($_REQUEST['action']) {
case 'post':
          include_once JIEQI_ROOT_PATH . '/modules/article/class/article.php';
	      $article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
	      $article = $article_handler->get($_POST['articleid']);
		if (!is_object($article)) {
			$errtext .= $jieqiLang['article']['draft_noe_article'] . '<br />';
		}
		else {
			$articlename = $article->getVar('articlename', 'n');
		}		  

    if (empty($errtext)) {
		include_once $jieqiModules['article']['path'] . '/class/monthlybuy.php';
        $monthlys_handler = &JieqiMonthlybuyHandler::getInstance('JieqiMonthlybuyHandler');
        $monthlys = $monthlys_handler->create();
		$monthlys->setVar('bookid', $_POST['articleid']);
		$monthlys->setVar('bookname', $articlename);
		$monthlys->setVar('date', JIEQI_NOW_TIME);
		$monthlys->setVar('userid',  $_SESSION['jieqiUserId']);
		$monthlys->setVar('username', $_SESSION['jieqiUserName']);
		$monthlys->setVar('text', $_POST['text']);
		$monthlys->setVar('pc', $_POST['pc']);
		$monthlys->setVar('type', $_POST['type']);
		
//		$monthlys_handler->insert($monthlys);
//		jieqi_jumppage($article_dynamic_url . '/monthlybuy.php?id='.$_GET['id'].'', LANG_DO_SUCCESS, $jieqiLang['article']['article_not_yes']);
		if (!$monthlys_handler->insert($monthlys)) {
			jieqi_printfail($jieqiLang['article']['article_not_no']);
		}
		else {
			jieqi_jumppage($article_dynamic_url . '/monthlybuy.php?id='.$_POST['type'].'', LANG_DO_SUCCESS, $jieqiLang['article']['article_not_yes']);
		}
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
		$articlerows[$k]['issign'] = $v->getVar('issign');
		$articlerows[$k]['articlename'] = $v->getVar('articlename');
		$articlerows[$k]['size'] = $v->getVar('size');
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
		$obookrows[$k]['size'] = $v->getVar('size');
		$k++;
	}

	$jieqiTpl->assign_by_ref('obookrows', $obookrows);
	include_once $jieqiModules['article']['path'] . '/class/monthlybuy.php';
    $monthly_handler = &JieqiMonthlybuyHandler::getInstance('JieqiMonthlybuyHandler');
	$criteria = new CriteriaCompo(new Criteria('userid', $_SESSION['jieqiUserId']));
	$criteria->setLimit(100);
	$monthly_handler->queryObjects($criteria);
	$k = 0;

	while ($v = $monthly_handler->getObject()) {
		$monthlyrows[$k]['bookid'] = $v->getVar('bookid');
		$monthlyrows[$k]['bookname'] = $v->getVar('bookname');
		$monthlyrows[$k]['text'] = $v->getVar('text');
		$monthlyrows[$k]['texts'] = $v->getVar('texts');
		$monthlyrows[$k]['date'] = $v->getVar('date');
		$monthlyrows[$k]['typeid'] = $v->getVar('typeid');
		$monthlyrows[$k]['type'] = $v->getVar('type');
		$monthlyrows[$k]['types'] = $jieqiOption['article']['mouthlybuy']['items'][$v->getVar('type')];
		$k++;
	}

	$jieqiTpl->assign_by_ref('monthlyrows', $monthlyrows);
	$jieqiTpl->assign_by_ref('_request', jieqi_funtoarray('jieqi_htmlstr', $_REQUEST));
    include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
    $jieqiPset['count'] = $monthly_handler->getCount($criteria);
    $jumppage = new JieqiPage($jieqiPset);
    $jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
	$jieqiTpl->assign('gfuname', $gfuname);
    $mouthlybuyname = $jieqiOption['article']['mouthlybuy']['items'][$id];
	$jieqiTpl->assign('sizes', $size);
    $jieqiTpl->assign('mouthlybuyname', $mouthlybuyname);
	$jieqiTpl->assign('tid', $_GET['id']);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/monthlybuy.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}
?>