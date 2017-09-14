<?php
$client_id = 4; //合作方ID
$client_secret = 'C7dzxte6PjFTVYxCzKJtRTasA'; //本站私匙

define('JIEQI_MODULE_NAME', 'article');  //定义程序所属模块
define('JIEQI_CHAR_SET', 'utf-8');  //本接口需要转换成utf-8编码输出
define('JIEQI_CHARSET_CONVERT', 0);  //其他页面不需要转换
require_once ('../../global.php');  //包含通用预处理程序
define('JIEQI_NOCONVERT_CHAR', '1');  //生成的url网址不考虑编码转换的情况
jieqi_getconfigs("article", "sort", "jieqiSort");
//载入数据库
jieqi_includedb();
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");
header("Content-type: text/xml");

    $sql="SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE  articleid= ".$_GET['id'] ." and kaiyue=1" ;
    $chapter = $query_handler->db->query($sql);
    $upchapter = $query_handler->getobject($chapter);
	if($upchapter){
        $item['id'] = $upchapter->getvar("articleid");
		$item['name'] = $upchapter->getvar("articlename");
		$item['class'] = $jieqiSort['article'][$upchapter->getvar("sortid")]['caption'];
		$item['author'] = $upchapter->getvar("author");
		$item['bookintr'] = $upchapter->getvar("intro");
		$item['smallimg'] = jieqi_geturl('article', 'cover', $upchapter->getvar("articleid"), 's', $upchapter->getvar("imgflag"));
		$item['bigimg'] = jieqi_geturl('article', 'cover', $upchapter->getvar("articleid"), 'l', $upchapter->getvar("imgflag"));
		$item['words'] = jieqi_sizeformat($upchapter->getvar("size"));
		$item['tag'] = $upchapter->getvar("poster");
		if($upchapter->getvar("isvip") > 0){
		   $item['free'] = 0;	
		}else{
		   $item['free'] = 1;	
		}
		if($upchapter->getvar("fullflag") == 1){
			$item['status'] = 1;
		}else{
			$item['status'] = 0;
		}
		
		$item['updatetime'] = $upchapter->getvar("lastupdate");
		$item['chapters'] = $upchapter->getvar("chapters");
		$item['tags'] = str_replace(' ', ',', $upchapter->getvar("keywords"));
		$item['allvisit'] = $upchapter->getvar("allvisit");
		$item['postdate'] = $upchapter->getvar("postdate");

        $return = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><data>
                   <bookname> <![CDATA[" .$item['name']. " ]]></bookname>
				   <bookid> <![CDATA[" .$item['id']. " ]]></bookid>
				   <bookpic> <![CDATA[" .$item['smallimg']. " ]]></bookpic>
				   <intro> <![CDATA[" .$item['bookintr']. " ]]></intro>
				   <authorname> <![CDATA[" .$item['author']. " ]]></authorname>
				   <allsize> <![CDATA[" .$item['words']. " ]]></allsize>
                   <fullflag> <![CDATA[" .$item['status']. " ]]></fullflag>
				   <category><![CDATA[" .$item['class']. " ]]></category>
                  </data>";
		echo $return;
	}else{
		echo "null";
	}
?>