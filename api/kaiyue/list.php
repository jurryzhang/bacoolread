<?php
$client_id = 4; //合作方ID
set_time_limit(0);
$client_secret = 'C7dzxte6PjFTVYxCzKJtRTasA'; //本站私匙

define('JIEQI_MODULE_NAME', 'article');  //定义程序所属模块
define('JIEQI_CHAR_SET', 'utf-8');  //本接口需要转换成utf-8编码输出
define('JIEQI_CHARSET_CONVERT', 0);  //其他页面不需要转换
require_once ('../../global.php');  //包含通用预处理程序
define('JIEQI_NOCONVERT_CHAR', '1');  //生成的url网址不考虑编码转换的情况
jieqi_includedb();
$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
$pagerows = 50; //每页输出几条记录
$filepath = !empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : !empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/api/baidu_sitemap.php'; //本程序的地址
$indexstyle = 'info'; //默认小说首页，信息页设置成：'info'，目录页设置成：'index'

header("Content-type: text/xml");


$_GET['page'] = (empty($_GET['page']) || intval($_GET['page']) <= 0) ? 0 : intval($_GET['page']);
//$where ="360s=1 and  lastupdate between ".$_GET['begin']." and ".$_GET['end'] . " ORDER BY lastupdate DESC ";

	//输出某一页小说列表
	include_once($jieqiModules['article']['path'] . '/include/funurl.php');
	$sql = "SELECT articleid,articlename FROM " . jieqi_dbprefix('article_article') . " WHERE kaiyue = 1 ";
	$query->execute($sql);
	if($query){
$return_begin="<?xml version=\"1.0\" encoding=\"utf-8\" ?><booklist>";
$return_content;
	while($row = $query->getRow()){
	   $id = $row['articleid'];
	   $name = $row['articlename'];		
           $return_content=   $return_content."<books><bookid><![CDATA[".$id."]]></bookid><bookname><![CDATA[".$name."]]></bookname></books>";	
	}
        $return_end="</booklist>";		
          echo $return_begin. $return_content. $return_end;
}else{
   echo "null" ;
}
?>