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
jieqi_apis_power();
//获取令牌对应的书籍列表
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql="SELECT * FROM ". jieqi_dbprefix("article_api")." WHERE token ='".$_GET['token']."'";
$query->execute($sql);
$res=$query->getRow();
$tempID=getbooks($res['bookIDs']);
$bookID=implode(",",$tempID);

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
	$sql = "SELECT articleid, articlename, lastupdate FROM " . jieqi_dbprefix("article_article") . " WHERE articleid in ($bookID) AND display = 0 AND siteid = 0 ";
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
	$ret[] = array(
	"articleid" => $row["articleid"],
	"articlename" => $row["articlename"],
	"lastupdate" => $row["lastupdate"]
	);
}

//如果请求是json,返回json数据
if(strpos($_SERVER['REQUEST_URI'],'/json')>0){
	jieqi_apis_out($ret);
	die;
}
//jieqi_apis_out($ret);输出json数据
//输出xml edit by muyi
//取出数据转utf8编码
$ret=jieqi_apis_2utf8($ret);
//
$tpl=array(
	"list" => '<?xml version="1.0" encoding="UTF-8"?>
				<result>
					%s
				</result>',
	"item" =>'<item>
				<id>%s</id>
				<bookname>%s</bookname>
				<lastupdate>%s</lastupdate>
			  </item>'	
);
$item='';
$list='';
for($i=0;$i<count($ret);$i++){
	$item.=sprintf($tpl['item'],$ret[$i]['articleid'],$ret[$i]['articlename'],$ret[$i]['lastupdate']);	
}
$list=sprintf($tpl['list'],$item);
header("Content-Type:text/xml; charset=utf-8");
echo $list;

?>
