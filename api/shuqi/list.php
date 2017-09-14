<?php
error_reporting(0);
date_default_timezone_set('PRC');
header('Content-type: text/xml');
include 'config.php';
mysql_connect($config['db_host'], $config['db_user'], $config['db_pass']) || exit;
mysql_set_charset('utf8');
mysql_select_db($config['db_name']);
$sql = "SELECT `articleid` FROM `jieqi_article_article` WHERE `shuqi`=1 ORDER BY `lastupdate` DESC";
$query = mysql_query($sql) or exit;
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n<booklist>";
while ($row = mysql_fetch_assoc($query)) {
	echo "\n\t<bookid><![CDATA[{$row[articleid]}]]></bookid>";
}
echo "\n</booklist>";
