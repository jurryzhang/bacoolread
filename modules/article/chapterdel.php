<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_loadlang("article", JIEQI_MODULE_NAME);

if ($_GET["chaptertype"] == 1) {
	$typename = $jieqiLang["article"]["volume_name"];
}
else {
	$typename = $jieqiLang["article"]["chapter_name"];
}

if (empty($_REQUEST["id"])) {
	jieqi_printfail(sprintf($jieqiLang["article"]["chapter_volume_notexists"], $typename));
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
$chapter = $chapter_handler->get($_REQUEST["id"]);

if (!$chapter) {
	jieqi_printfail(sprintf($jieqiLang["article"]["chapter_volume_notexists"], $typename));
}

include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($chapter->getVar("articleid"));

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$delhischapters = jieqi_checkpower($jieqiPower['article']['delhischapters'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$canedit = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($chapter->getVar("posterid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_delete_chapter"], $typename));
}
if (!$delhischapters){
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_delete_hischapter"], $typename));
}
include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
$ret = jieqi_article_delonechapter($chapter, $article);

if ($ret) {
	jieqi_article_updateinfo($article, "chapterdel");
}

jieqi_jumppage($article_static_url . "/articlemanage.php?id=" . $article->getVar("articleid"), LANG_DO_SUCCESS, sprintf($jieqiLang["article"]["chapter_delete_success"], $typename));

?>
