<?php
$client_id = 4; //合作方ID
$client_secret = 'C7dzxte6PjFTVYxCzKJtRTasA'; //本站私匙
$sign='C7dzxte6PjFTVYxCzKJtRTasA';

define('JIEQI_MODULE_NAME', 'article');  //定义程序所属模块
define('JIEQI_CHAR_SET', 'utf-8');  //本接口需要转换成utf-8编码输出
define('JIEQI_CHARSET_CONVERT', 0);  //其他页面不需要转换
require_once ('../../global.php');  //包含通用预处理程序
define('JIEQI_NOCONVERT_CHAR', '1');  //生成的url网址不考虑编码转换的情况
//载入数据库
jieqi_includedb();
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");

header("Content-type: text/xml");
    $chapter = $query_handler->db->query("SELECT * FROM " . jieqi_dbprefix('article_chapter') . " WHERE chapterid ={$_GET['cid']} and articleid= ".$_GET['id']);
    $upchapter = $query_handler->getobject($chapter);
    $item['id'] = $upchapter->getvar("articleid");
    $item['size'] = jieqi_sizeformat($upchapter->getvar("size"));
    $item['saleprice'] = $upchapter->getvar("saleprice");
    $item['isvip'] = $upchapter->getvar("isvip"); 
    $item['cid'] = $upchapter->getvar("chapterid");
    $item['chaptername'] = $upchapter->getvar("chaptername");
    $item['lastupdate'] = $upchapter->getvar("lastupdate");

if($upchapter->getvar("isvip") == 0){
  		$g=floor($item['id']/1000);
		$txtpath='../../files/article/txt/'.$g.'/'.$item['id'].'/'.$item['cid'].'.txt';
		if (file_exists($txtpath)){
			$txtpath='../../files/article/txt/'.$g.'/'.$item['id'].'/'.$item['cid'].'.txt';
		}else{
			$txtpath='';
		}
      $txt=file_get_contents($txtpath);
		$txtcontent=$txt;
//$txtcontent="<p>".trim($txtcontent);
	$txtcontent=str_replace("    ","\n",$txtcontent);
	$order=array("\r\n","\r","\t"); 
//$txtcontent.="</p>\n";  
	$replace='  ';
        $txtcontent=str_replace($order,$replace,$txtcontent);
}else{
	$ocontent = $query_handler->db->query("SELECT * FROM " . jieqi_dbprefix('obook_ocontent') . " WHERE  ochapterid = ".$_GET['cid']);
	$upocontent = $query_handler->getobject($ocontent);	
	$txt = $upocontent->getvar("ocontent");
		$txtcontent=$txt;
//$txtcontent="<p>".trim($txtcontent);
		$txtcontent=str_replace('<br />',"\n",$txtcontent);
		//$txtcontent=str_replace('&nbsp;&nbsp;&nbsp;&nbsp;',"    ",$txtcontent);
//$txtcontent.="</p>\n";  
	    $order=array("\r\n","\r","\t");   
	    $replace='  ';
            $txtcontent=str_replace($order,$replace,$txtcontent);
}
$item['txtcontent']=$txtcontent;

	
$return = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><contentinfo>
                   <bookid><![CDATA[{$_GET['id']}]]></bookid>
                   <chapterid><![CDATA[{$_GET['cid']}]]></chapterid>
                   <content> <![CDATA[".$txtcontent."]]></content>
                   </contentinfo>";
echo $return;
?>