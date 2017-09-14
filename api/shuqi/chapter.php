<?php
error_reporting(0);
date_default_timezone_set('PRC');
header('Content-type: text/xml');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
if ($id <= 0 || $cid <= 0) exit;
include 'config.php';
$txt = $config['txt_path'] . '/' . floor($id / 1000) . '/' . $id . '/' . $cid . '.txt';
if (is_file($txt)) {
	$content = mb_convert_encoding(file_get_contents($txt), 'UTF-8', 'GBK');
} else {
	mysql_connect($config['db_host'], $config['db_user'], $config['db_pass']) || exit;
	mysql_set_charset('utf8');
	mysql_select_db($config['db_name']);
	$sql = "SELECT `ocontent` FROM `jieqi_obook_ocontent` WHERE `ochapterid`={$cid} LIMIT 1";
	$query = mysql_query($sql) or exit;
	$chapter = mysql_fetch_assoc($query) or exit;
	$content = $chapter['ocontent'];
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n<contentinfo>";
echo "\n\t<bookid><![CDATA[{$id}]]></bookid>";
echo "\n\t<chapterid><![CDATA[{$cid}]]></chapterid>";
echo "\n\t<content><![CDATA[{$content}]]></content>";
echo "\n</contentinfo>";
