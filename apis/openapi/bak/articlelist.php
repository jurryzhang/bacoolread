<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_getconfigs("system", "shares", "jieqiShares");
include_once ("config.inc.php");
include_once (JIEQI_ROOT_PATH . "/include/apicommon.php");
include_once (JIEQI_ROOT_PATH . "/apis/include/funapis.php");
include_once ("common.inc.php");
//jieqi_apis_checkparams();
@set_time_limit(900);
@session_write_close();
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$uptime = 0;
if (!empty($_REQUEST["uptime"]) && is_numeric($_REQUEST["uptime"]) && (4 <= strlen($_REQUEST["uptime"]))) {
	$uptime = mktime(intval(substr($_REQUEST["uptime"], 8, 2)), intval(substr($_REQUEST["uptime"], 10, 2)), intval(substr($_REQUEST["uptime"], 12, 2)), intval(substr($_REQUEST["uptime"], 4, 2)), intval(substr($_REQUEST["uptime"], 6, 2)), intval(substr($_REQUEST["uptime"], 0, 4)));
}

$endtime = 0;
if (!empty($_REQUEST["endtime"]) && is_numeric($_REQUEST["endtime"]) && (4 <= strlen($_REQUEST["endtime"]))) {
	$endtime = mktime(intval(substr($_REQUEST["endtime"], 8, 2)), intval(substr($_REQUEST["endtime"], 10, 2)), intval(substr($_REQUEST["endtime"], 12, 2)), intval(substr($_REQUEST["endtime"], 4, 2)), intval(substr($_REQUEST["endtime"], 6, 2)), intval(substr($_REQUEST["endtime"], 0, 4)));
}

$table_prefix = "";
$sharemode = (defined("JIEQI_SHARE_MODE") ? JIEQI_SHARE_MODE : 1);

switch ($sharemode) {
case 1:
	$sql = "SELECT articleid, articlename, lastupdate FROM " . jieqi_dbprefix("article_article") . " WHERE display = 0 AND siteid = 0 AND mianfeidushu = 1";
	break;

}

if (!empty($apisConfigs["sortexclude"])) {
	foreach ($apisConfigs["sortexclude"] as $k => $v ) {
		$apisConfigs["sortexclude"][$k] = intval($v);
	}

	$sql .= " AND {$table_prefix}sortid NOT IN (" . implode(", ", $apisConfigs["sortexclude"]) . ")";
}

if (0 < $uptime) {
	$sql .= " AND {$table_prefix}lastupdate >= $uptime";
}

if (0 < $endtime) {
	$sql .= " AND {$table_prefix}lastupdate < $endtime";
}

if (!empty($jieqiShares[JIEQI_SHARE_SID]["pagerows"])) {
	$jieqiShares[JIEQI_SHARE_SID]["pagerows"] = intval($jieqiShares[JIEQI_SHARE_SID]["pagerows"]);

	if ($jieqiShares[JIEQI_SHARE_SID]["pagerows"] < 1) {
		$jieqiShares[JIEQI_SHARE_SID]["pagerows"] = 100;
	}

	if (isset($_REQUEST["page"])) {
		$_REQUEST["page"] = intval($_REQUEST["page"]);
	}

	if ($_REQUEST["page"] < 1) {
		$_REQUEST["page"] = 1;
	}

	$start = ($_REQUEST["page"] - 1) * $jieqiShares[JIEQI_SHARE_SID]["pagerows"];
	$sql .= " LIMIT $start, {$jieqiShares[JIEQI_SHARE_SID]["pagerows"]}";
}

$query->execute($sql);
$ret = array();

while ($row = $query->getRow()) {
	$ret[] = array("articleid" => $row["articleid"], "articlename" => $row["articlename"], "lastupdate" => $row["lastupdate"]);
}

jieqi_apis_out($ret);

?>
