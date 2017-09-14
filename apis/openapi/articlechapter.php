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

if (isset($_GET["ocid"])) {
	$_GET["ocid"] = intval($_GET["ocid"]);
}
else {
	$_GET["ocid"] = 0;
}

@set_time_limit(900);
@session_write_close();
jieqi_includedb();
jieqi_apis_power();
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

$chapters = array();
$chapterorder = 0;

if (!empty($_GET["ocid"])) {
	$sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE chapterid = " . $_GET["ocid"] . " LIMIT 0, 1";
	$query->execute($sql);

	if ($row = $query->getRow()) {
		$chapterorder = $row["chapterorder"];
	}
	else {
		jieqi_apis_error(3);
	}
}

$sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . $_GET["aid"];

if (0 < $chapterorder) {
	$sql .= " AND chapterorder > $chapterorder";
}

$sql .= " ORDER BY chapterorder ASC";
$query->execute($sql);
$k = 0;

while ($row = $query->getRow()) {
	$chapters[$k]["chapterid"] = $row["chapterid"];
	$chapters[$k]["chaptertype"] = $row["chaptertype"];
	$chapters[$k]["chaptername"] = $row["chaptername"];
	$chapters[$k]["isvip"] = $row["isvip"];
	$chapters[$k]["saleprice"] = $row["saleprice"];
	$chapters[$k]["postdate"] = $row["postdate"];
	$chapters[$k]["lastupdate"] = $row["lastupdate"];
	$chapters[$k]["order"] = $row["chapterorder"];
	$chapters[$k]["words"] = jieqi_sizeformat($row["size"], "c");
	$k++;
}

//如果请求是json,返回json数据
if(strpos($_SERVER['REQUEST_URI'],'/json')>0){
	jieqi_apis_out($chapters);
	die;
}

//jieqi_apis_out($chapters); 输出json;
//输出xml edit by muyi
//取出数据转utf8编码
$chapters=jieqi_apis_2utf8($chapters);
//
$tpl=array(
	"list" => '<?xml version="1.0" encoding="UTF-8"?>
				<result>
					%s
				</result>',
	"item" =>'<item>
				<chapterid>%s</chapterid>
				<chaptername>%s</chaptername>
				<chaptertype>%s</chaptertype>
				<wordcount>%s</wordcount>
				<lastupdate>%s</lastupdate>
				<order>%s</order>
				<vip>%s</vip>
			  </item>'	
);
$item='';
$list='';
for($i=0;$i<count($chapters);$i++){
	$item.=sprintf($tpl['item'],$chapters[$i]['chapterid'],$chapters[$i]['chaptername'],$chapters[$i]['chaptertype'],$chapters[$i]['words'],$chapters[$i]['lastupdate'],$chapters[$i]['order'],$chapters[$i]['isvip']);	
}
$list=sprintf($tpl['list'],$item);
header("Content-Type:text/xml; charset=utf-8");
echo $list;

?>
