<?php
define('JIEQI_MODULE_NAME', 'article');  //定义程序所属模块
include_once '../../global.php';
//$conn=mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die('链接失败');mysql_select_db(JIEQI_DB_NAME, $conn);@mysql_query("SET names gbk");//SQL连接


//输出全部关键词
/*
$query = mysql_query("select * from jieqi_article_tag order by addtime asc"); 

while($row=mysql_fetch_array($query)){
	 $arr[]=array(
	'tagid' => $row['tagid'],
	'caption' => $row['tagname']
	);

} 
$result=$arr;
*/
jieqi_includedb();
$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');

$map_cids = array();
$sql = "SELECT * FROM " . jieqi_dbprefix("article_tag") . " order by addtime asc";
$query->execute($sql);
$k = 1;
				while ($row = $query->getRow()) {
					$map_cids[$k] = array("caption" => $row['tagname']);
					$old_chapters[$k] = $row;
					$k++;
				}


var_dump($map_cids);
?>