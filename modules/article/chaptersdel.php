<?php

file_put_contents('$_REQUEST.txt',print_r($_REQUEST,true));

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");

if (empty($_REQUEST["articleid"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_loadlang("article", JIEQI_MODULE_NAME);

if (empty($_REQUEST["chapterid"])) {
	jieqi_printfail($jieqiLang["article"]["noselect_delete_chapter"]);
}

$_REQUEST["articleid"] = intval($_REQUEST["articleid"]);
include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["articleid"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$delhischapters = jieqi_checkpower($jieqiPower['article']['delhischapters'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$canedit = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail($jieqiLang["article"]["noper_manage_article"]);
}
if (!$delhischapters){
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_delete_hischapter"], $typename));
}
$cids = "";

foreach ($_REQUEST["chapterid"] as $cid ) {
	$cid = intval($cid);

	if ($cid) {
		if ($cids != "") {
			$cids .= ", ";
		}

		$cids .= $cid;
	}
}

if ($cids != "") {
	include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("chapterid", "(" . $cids . ")", "IN"));
	jieqi_article_delchapter($_REQUEST["articleid"], $criteria);
}

jieqi_jumppage($article_static_url . "/articlemanage.php?id=" . $_REQUEST["articleid"], LANG_DO_SUCCESS, $jieqiLang["article"]["chapter_batchdel_success"]);

?>
