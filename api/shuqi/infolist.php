<?php
error_reporting(0);
date_default_timezone_set('PRC');
header('Content-type: text/xml');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) exit;
include 'config.php';
mysql_connect($config['db_host'], $config['db_user'], $config['db_pass']) || exit;
mysql_set_charset('utf8');
mysql_select_db($config['db_name']);
$sql = "SELECT `chapterid`, `chaptername`, `chaptertype` FROM `jieqi_article_chapter` WHERE `articleid`={$id} ORDER BY `chapterorder`, `chapterid`";
$query = mysql_query($sql) or exit;
$i = 0;
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n<chapterinfo>";
echo "\n\t<bookid><![CDATA[{$id}]]></bookid>";
while ($row = mysql_fetch_assoc($query)) {
	if ($i == 0 && !$row['chaptertype']) {
		echo "\n\t<volume>";
		echo "\n\t\t<volumeid><![CDATA[0]]></volumeid>";
		echo "\n\t\t<volname><![CDATA[正文]]></volname>";
		echo "\n\t\t<chapters>";
	}
	if ($row['chaptertype']) {
		if ($i > 0) echo "\n\t\t</chapters>\n\t</volume>";
		echo "\n\t<volume>";
		echo "\n\t\t<volumeid><![CDATA[{$row[chapterid]}]]></volumeid>";
		echo "\n\t\t<volname><![CDATA[{$row[chaptername]}]]></volname>";
		echo "\n\t\t<chapters>";
	} else {
		echo "\n\t\t\t<chapter>";
		echo "\n\t\t\t\t<chapterid><![CDATA[{$row[chapterid]}]]></chapterid>";
		echo "\n\t\t\t\t<chaptername><![CDATA[{$row[chaptername]}]]></chaptername>";
		echo "\n\t\t\t</chapter>";
	}
	$i++;
}
if ($i > 0) echo "\n\t\t</chapters>\n\t</volume>";
echo "\n</chapterinfo>";
