<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("system", "shares", "jieqiShares");
include_once ("config.inc.php");
include_once (JIEQI_ROOT_PATH . "/include/apicommon.php");
include_once (JIEQI_ROOT_PATH . "/apis/include/funapis.php");
include_once ("common.inc.php");
//jieqi_apis_checkparams();
if (!isset($_GET["cid"]) || !is_numeric($_GET["cid"])) {
	jieqi_apis_error(1);
}

$_GET["aid"] = (isset($_GET["aid"]) ? intval($_GET["aid"]) : 0);
$_GET["cid"] = intval($_GET["cid"]);
@set_time_limit(900);
@session_write_close();
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$k = 0;
$sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE chapterid = " . $_GET["cid"] . " LIMIT 0, 1";
$query->execute($sql);
$row = $query->getRow();

if (!is_array($row)) {
	jieqi_apis_error(4);
}

$_GET["aid"] = intval($row["articleid"]);
$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . $_GET["aid"] . " LIMIT 0, 1";
$query->execute($sql);
$article = $query->getRow();
if (!$article || ($article["display"] != 0)) {
	jieqi_apis_error(3);
}

if (!jieqi_apis_isshare($article, JIEQI_SHARE_SID)) {
	jieqi_apis_error(3);
}

include_once ($jieqiModules["article"]["path"] . "/class/package.php");
$ret = array();
$ret["chapterid"] = $row["chapterid"];
$ret["chaptertype"] = $row["chaptertype"];
$ret["chaptername"] = $row["chaptername"];
$ret["isvip"] = $row["isvip"];
$ret["saleprice"] = $row["saleprice"];
$ret["postdate"] = $row["postdate"];
$ret["lastupdate"] = $row["lastupdate"];
$ret["words"] = jieqi_sizeformat($row["size"], "c");
$ret["chapterorder"] = $row["chapterorder"];
$ret["content"] = jieqi_get_achapterc(array("articleid" => $row["articleid"], "chapterid" => $row["chapterid"], "isvip" => $row["isvip"], "chaptertype" => $row["chaptertype"], "display" => $row["display"], "getformat" => "txt"));
jieqi_apis_out($ret);

?>
