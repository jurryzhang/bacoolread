<?php
file_put_contents('$_REQUEST.txt',print_r($_REQUEST,true));
ini_set("max_execution_time",18000);
define("JIEQI_USE_GZIP", "0");
@ignore_user_abort(true);
@set_time_limit(0);
define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_loadlang("article", JIEQI_MODULE_NAME);
if (empty($_REQUEST["articleid"]) || !in_array($_REQUEST["act"], array("vip", "free"))) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

if (empty($_REQUEST["chapterid"])) {
	jieqi_printfail($jieqiLang["article"]["noselect_delete_chapter"]);
}

$_REQUEST["articleid"] = intval($_REQUEST["articleid"]);

//jieqi_checkpost();

include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["articleid"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

if ((floatval(JIEQI_VERSION) < 2.1) || (intval($article->getVar("issign", "n")) < 10)) {
	jieqi_printfail($jieqiLang["article"]["set_chapter_notsupport"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$ismanager && in_array($_POST["act"], array("free", "vip"))) {
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_set_chapter"], $typename));
}

$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_edit_chapter"], $typename));
}
$cids = "";

include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
foreach ($_REQUEST["chapterid"] as $cid ) {
	$cid = intval($cid);

	if ($cid) {
		include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
        $chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
        $chapter = $chapter_handler->get($cid);
		
		if (!$chapter) {
	        jieqi_printfail($jieqiLang["article"]["set_chapter_notexists"]);
        }
		
		if ($chapter->getVar("chaptertype", "n") != 0) {
	        jieqi_printfail($jieqiLang["article"]["set_volume_notallow"]);
        }
		
		
		$ret = jieqi_article_chapterset($chapter, $article, $_POST["act"]);

        if ($ret) {
        	jieqi_includedb();
			$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
        	$sql2 = "SELECT  chapterid,chaptername FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid=".$articleid." AND isvip=0 ORDER BY chapterid DESC LIMIT 1";
				$res2 = $query->execute($sql2);

				$sql = "UPDATE  " . jieqi_dbprefix("obook_obook") . " SET lastchapter = ".$res2['chaptername']." , lastchapterid=" .intval($res2['chapterid']) ". WHERE articleid = " . intval($articleid);
				$query->execute($sql);
				//更新最新免费章节
				
				$sql3 = "UPDATE  ". jieqi_dbprefix("article_article") . " SET lastchapter = ".$res2['chaptername']." , lastchapterid=" .intval($res2['chapterid']);
				$query->execute($sql3);
	        jieqi_article_updateinfo($article, "chapteredit");
        }
	}
	echo sprintf($jieqiLang["article"]["chapter_set_edit"], jieqi_htmlstr($chapter->getVar("chaptername")));
	ob_flush();
	flush();
}

jieqi_jumppage($article_static_url . "/chaptersdel.php?id=" . $article->getVar("articleid"), LANG_DO_SUCCESS, $jieqiLang["article"]["chapter_set_success"]);

?>
