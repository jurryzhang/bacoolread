<?php
define("JIEQI_MODULE_NAME", "article");
require_once("../../global.php");
jieqi_checklogin();
if (empty($_SESSION['jieqiUserId'])) jieqi_printfail("µÇÂ¼ÑéÖ¤Ê§°Ü£¡");
include_once(JIEQI_ROOT_PATH."/header.php");
jieqi_getconfigs("article", "configs");
$article_static_url = empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl'];
$article_dynamic_url = empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl'];
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$page = empty($_REQUEST['page']) ? 1 : intval($_REQUEST['page']);
include_once($jieqiModules['article']['path']."/include/funarticle.php");
include_once($jieqiModules['article']['path']."/class/article.php");
$article_handler =& jieqiarticlehandler::getinstance("JieqiArticleHandler");
$criteria = new criteriacompo(new criteria("posterid", $_SESSION['jieqiUserId']));
$criteria->setsort("lastupdate");
$criteria->setorder("DESC");
$criteria->setlimit($jieqiConfigs['article']['pagenum']);
$criteria->setstart(($page - 1) * $jieqiConfigs['article']['pagenum']);
$article_handler->queryobjects($criteria);
$ebookrows = array();
$k = 0;
while ($v = $article_handler->getobject()) {
	$ebookrows[$k] = jieqi_article_vars($v);
	++$k;
}
$jieqiTpl->assign_by_ref("ebookrows", $ebookrows);
$listrows = $article_handler->getcount($criteria);
include_once(JIEQI_ROOT_PATH."/lib/html/page.php");
$jumppage = new jieqipage($listrows, $jieqiConfigs['article']['pagenum'], $page);
$jumppage->setlink(JIEQI_URL.str_replace('<{$fullflag}>', $fullflag, str_replace('<{$sortid}>', $sortid, $sorturl)));
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setcaching(0);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path']."/templates/ebook.html";
include_once(JIEQI_ROOT_PATH."/footer.php");
?>