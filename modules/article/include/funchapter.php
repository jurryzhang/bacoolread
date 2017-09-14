<?php

function jieqi_article_chaptervars($chapter)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $article_static_url;
	global $article_dynamic_url;
	global $jieqiOption;

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs");
	}

	if (!isset($jieqiOption["article"])) {
		jieqi_getconfigs("article", "option", "jieqiOption");
	}

	if (!isset($article_static_url)) {
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
	}

	if (!isset($article_dynamic_url)) {
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
	}

	$ret = jieqi_query_rowvars($chapter, "s", "article");
	$ret["size_c"] = jieqi_sizeformat($ret["size"], "c");
	$ret["size_k"] = jieqi_sizeformat($ret["size"], "k");
	$ret["size_w"] = jieqi_sizeformat($ret["size"], "w");
	$ret["sumemoney"] = $ret["sumegold"] + $ret["sumesilver"];

	if ($ret["chaptertype"] == 0) {
		$ret["url_chapterread"] = jieqi_geturl("article", "chapter", $ret["chapterid"], $ret["articleid"], $ret["isvip_n"] ,$ret["display_n"]);
		$ret["url_chapteredit"] = $article_static_url . "/chapteredit.php?id=" . $ret["chapterid"] . "&chaptertype=0";
		$ret["url_chapterdelete"] = $article_static_url . "/chapterdel.php?id=" . $ret["chapterid"] . "&chaptertype=0";
		$ret["url_chaptersetfree"] = $article_static_url . "/chapterset.php?id=" . $ret["chapterid"] . "&action=free&chaptertype=0";
		$ret["url_chaptersetvip"] = $article_static_url . "/chapterset.php?id=" . $ret["chapterid"] . "&action=vip&chaptertype=0";
		$ret["url_chaptersethide"] = $article_static_url . "/chapterset.php?id=" . $ret["chapterid"] . "&action=hide&chaptertype=0";
		$ret["url_chaptersetshow"] = $article_static_url . "/chapterset.php?id=" . $ret["chapterid"] . "&action=show&chaptertype=0";
	}
	else {
		$ret["url_chapterread"] = $article_static_url . "/showvolume.php?aid=" . $ret["articleid"] . "&vid=" . $ret["chapterid"];
		$ret["url_chapteredit"] = $article_static_url . "/chapteredit.php?id=" . $ret["chapterid"] . "&chaptertype=1";
		$ret["url_chapterdelete"] = $article_static_url . "/chapterdel.php?id=" . $ret["chapterid"] . "&chaptertype=1";
		$ret["url_chaptersetfree"] = $article_static_url . "/chapterset.php?id=" . $ret["chapterid"] . "&action=free&chaptertype=1";
		$ret["url_chaptersetvip"] = $article_static_url . "/chapterset.php?id=" . $ret["chapterid"] . "&action=vip&chaptertype=1";
	}

	$ret["url_chapter"] = $ret["url_chapterread"];
	$ret["articlesubdir"] = jieqi_getsubdir($ret["articleid"]);
	$ret["url_articleinfo"] = jieqi_geturl("article", "article", $ret["articleid"], "info");
	$ret["url_articleindex"] = jieqi_geturl("article", "article", $ret["articleid"], "index");
	return $ret;
}


?>
