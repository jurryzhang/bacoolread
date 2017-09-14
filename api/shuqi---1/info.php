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
$sql = "SELECT `articleid`, `articlename`, `author`, `keywords`, `intro`, `agent`, `lastupdate`, `sortid`, `fullflag`, `imgflag`, `ratenum`, `ratesum` FROM `jieqi_article_article` WHERE `articleid`={$id} AND `shuqi`=1 LIMIT 1";
$query = mysql_query($sql) or exit;
$info = mysql_fetch_assoc($query) or exit;
$sql = "SELECT `title`, `posttime` FROM `jieqi_article_reviews` WHERE `ownerid`={$id} AND `isgood`=1 ORDER BY `topicid` DESC LIMIT 3";
$query = mysql_query($sql) or exit;
$reviewtime = 0;
$reviewlist = array();
while ($row = mysql_fetch_assoc($query)) {
	if ($reviewtime == 0) $reviewtime = $row['posttime'];
	$reviewlist[] = $row['title'];
}
$sortlist = array(1=>'玄幻魔法',2=>'武侠修真',3=>'都市校园',4=>'历史军事',5=>'灵异悬疑',6=>'科幻同人',7=>'现代言情',8=>'古代言情',9=>'幻想言情',10=>'灵异悬疑',11=>'综合其他',12=>'文学出版');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n<bookinfo>";
echo "\n\t<bookid><![CDATA[{$info['articleid']}]]></bookid>";
echo "\n\t<bookname><![CDATA[{$info['articlename']}]]></bookname>";
echo "\n\t<authorname><![CDATA[{$info['author']}]]></authorname>";
echo "\n\t<intro><![CDATA[{$info['intro']}]]></intro>";
echo "\n\t<genre><![CDATA[" . (isset($sortlist[$info['sortid']]) ? $sortlist[$info['sortid']] : '') . "]]></genre>";
echo "\n\t<bookstatus><![CDATA[" . (empty($info['fullflag']) ? '连载' : '全本') . "]]></bookstatus>";
echo "\n\t<keywords><![CDATA[" . str_replace(' ', ',', trim($info['keywords'])) . "]]></keywords>";
echo "\n\t<coverpath><![CDATA[" . (empty($info['imgflag']) ? 'http://www.acoolread.com/modules/article/images/nocover.jpg' : 'http://img.acoolread.com/image/' . floor($id / 1000) . '/' . $id . '/' . $id . 's.jpg') . "]]></coverpath>";
if ($info['agent']) echo "\n\t<editor><![CDATA[{$info['agent']}]]></editor>";
if ($info['ratenum'] > 0) echo "\n\t<score><![CDATA[" . number_format($info['ratesum'] / $info['ratenum'] / 2, 1) . "]]></score>";
if ($reviewtime > 0) echo "\n\t<comment><![CDATA[" . implode('|', $reviewlist) . "]]></comment>\n\t<commentupdatetime><![CDATA[{$reviewtime}]]></commentupdatetime>";
echo "\n\t<lastupdatetime><![CDATA[{$info['lastupdate']}]]></lastupdatetime>";
echo "\n</bookinfo>";
