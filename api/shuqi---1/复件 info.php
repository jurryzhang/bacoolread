<?php
$client_id = 4; //������ID
$client_secret = 'C7dzxte6PjFTVYxCzKJtRTasA'; //��վ˽��

define('JIEQI_MODULE_NAME', 'article');  //�����������ģ��
define('JIEQI_CHAR_SET', 'utf-8');  //���ӿ���Ҫת����utf-8�������
define('JIEQI_CHARSET_CONVERT', 0);  //����ҳ�治��Ҫת��
require_once ('../../global.php');  //����ͨ��Ԥ�������
define('JIEQI_NOCONVERT_CHAR', '1');  //���ɵ�url��ַ�����Ǳ���ת�������
jieqi_getconfigs("article", "sort", "jieqiSort");
//�������ݿ�
jieqi_includedb();
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");
header("Content-type: text/xml");

    $sql="SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE  articleid= ".$_GET['id'] ." and shuqi=1" ;
    $chapter = $query_handler->db->query($sql);
    $upchapter = $query_handler->getobject($chapter);
	if($upchapter){
        $item['id'] = $upchapter->getvar("articleid");
		$item['name'] = $upchapter->getvar("articlename");
		$item['class'] = $jieqiSort['article'][$upchapter->getvar("sortid")]['types'][$upchapter->getvar("typeid")];
		$item['author'] = $upchapter->getvar("author");
		$item['bookintr'] = $upchapter->getvar("intro");
		$item['smallimg'] = jieqi_geturl('article', 'cover', $upchapter->getvar("articleid"), 's', $upchapter->getvar("imgflag"));
		$item['bigimg'] = jieqi_geturl('article', 'cover', $upchapter->getvar("articleid"), 'l', $upchapter->getvar("imgflag"));
		$item['words'] = jieqi_sizeformat($upchapter->getvar("size"));
		$item['tag'] = $upchapter->getvar("poster");
		$item['keywords'] = str_replace(' ', ',', $upchapter->getvar("keywords"));
		if($upchapter->getvar("isvip") > 0){
		   $item['free'] = 0;	
		}else{
		   $item['free'] = 1;	
		}
		if($upchapter->getvar("fullflag") == 2){
			$item['status'] = 1;
		}else{
			$item['status'] = 0;
		}
		
		$item['updatetime'] = $upchapter->getvar("lastupdate");
		$item['chapters'] = $upchapter->getvar("chapters");
		$item['tags'] = str_replace(' ', ',', $upchapter->getvar("keywords"));
		$item['allvisit'] = $upchapter->getvar("allvisit");
		$item['postdate'] = $upchapter->getvar("postdate");

        $return = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><bookinfo><bookid>{$item['id']}</bookid>
                   <bookname> <![CDATA[" .$item['name']. " ]]></bookname>
				   <authorname> <![CDATA[" .$item['author']. " ]]></authorname>
				   <intro> <![CDATA[" .$item['bookintr']. " ]]></intro>
                   <genre><![CDATA[" .$item['class']. " ]]></genre>
				   <bookstatus>{$item['status']}</bookstatus>
				   <keywords><![CDATA[".$item['keywords']."]]></keywords>
                   <coverpath> <![CDATA[" .$item['smallimg']. " ]]></coverpath>
                   </bookinfo>";
		echo $return;
	}else{
		echo "null";
	}
?>