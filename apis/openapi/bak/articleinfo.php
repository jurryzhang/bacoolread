<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("system", "shares", "jieqiShares");
include_once ("config.inc.php");
include_once (JIEQI_ROOT_PATH . "/include/apicommon.php");
include_once (JIEQI_ROOT_PATH . "/apis/include/funapis.php");
include_once ("common.inc.php");
//jieqi_apis_checkparams();
if (!isset($_GET["aid"]) || !is_numeric($_GET["aid"])) {
	jieqi_apis_error(1);
}

$_GET["aid"] = intval($_GET["aid"]);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . $_GET["aid"] . " LIMIT 0, 1";
$query->execute($sql);
$article = $query->getRow();
if (!$article || ($article["display"] != 0)) {
	jieqi_apis_error(3);
}

if (!jieqi_apis_isshare($article, JIEQI_SHARE_SID)) {
	jieqi_apis_error(3);
}

jieqi_getconfigs("article", "sort", "jieqiSort");
$ret = array();
$ret["articleid"] = $article["articleid"];
$ret["postdate"] = $article["postdate"];
$ret["lastupdate"] = $article["lastupdate"];
$ret["articlename"] = $article["articlename"];
$ret["authorid"] = $article["authorid"];
$ret["author"] = $article["author"];
$ret["keywords"] = $article["keywords"];
$ret["intro"] = $article["intro"];
$ret["notice"] = $article["notice"];
$ret["fullflag"] = $article["fullflag"];
$ret["chapters"] = $article["chapters"];
$ret["words"] = jieqi_sizeformat($article["size"], "c");
$ret["isvip"] = $article["isvip"];
$ret["rgroup"] = $article["rgroup"];
jieqi_getconfigs("article", "sort");
$ret["category"] = (isset($jieqiSort["article"][$article["sortid"]]["caption"]) ? $jieqiSort["article"][$article["sortid"]]["caption"] : "");
$ret["type"] = (isset($jieqiSort["article"][$article["sortid"]]["types"][$article["typeid"]]) ? $jieqiSort["article"][$article["sortid"]]["types"][$article["typeid"]] : "");
$ret["cover"] = "";
$setting = jieqi_unserialize($article["setting"]);

if (isset($setting["cover"])) {
	$ret["cover"] = $setting["cover"];
}
else if (0 < $article["imgflag"]) {
	$ret["cover"] = jieqi_geturl("article", "cover", $article["articleid"], "s", $article["imgflag"]);
}

$article["imgflag"] = intval($article["imgflag"]);
$ret["cover"] = (0 < ($article["imgflag"] & 1) ? jieqi_geturl("article", "cover", $article["articleid"], "s", $article["imgflag"]) : "");
$ret["bigcover"] = (0 < ($article["imgflag"] & 2) ? jieqi_geturl("article", "cover", $article["articleid"], "l", $article["imgflag"]) : "");
$ret["freechapterid"] = $article["lastchapterid"];
$ret["freechapter"] = $article["lastchapter"];
$ret["freevolume"] = $article["lastvolume"];
$ret["freetime"] = (0 < $article["freetime"] ? $article["freetime"] : "");
$ret["vipchapterid"] = $article["vipchapterid"];
$ret["vipchapter"] = $article["vipchapter"];
$ret["vipvolume"] = $article["vipvolume"];
$ret["viptime"] = (0 < $article["viptime"] ? $article["viptime"] : "");
jieqi_apis_out($ret);

?>
