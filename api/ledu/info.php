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

    $sql="SELECT * FROM " . jieqi_dbprefix('article_article') . " WHERE  articleid= ".$_GET['id'] ." and ledu=1" ;
    $chapter = $query_handler->db->query($sql);
    $upchapter = $query_handler->getobject($chapter);
	if($upchapter){
        $item['id'] = $upchapter->getvar("articleid");
		$item['name'] = $upchapter->getvar("articlename");
		if($upchapter->getvar("typeid") == 8 || $upchapter->getvar("typeid") == 9){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 4 ||$upchapter->getvar("typeid") == 5 ||$upchapter->getvar("typeid") == 6 ||$upchapter->getvar("typeid") == 7 ||$upchapter->getvar("typeid") == 11 ||$upchapter->getvar("typeid") == 48 ||$upchapter->getvar("typeid") == 69){
			$item['class'] = "���";
		}elseif($upchapter->getvar("typeid") == 34){
			$item['class'] = "��Խ";
		}elseif($upchapter->getvar("typeid") == 44 ||$upchapter->getvar("typeid") == 45 ||$upchapter->getvar("typeid") == 47 ||$upchapter->getvar("typeid") == 52 ||$upchapter->getvar("typeid") == 71){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 15 ||$upchapter->getvar("typeid") == 16 ||$upchapter->getvar("typeid") == 17 ||$upchapter->getvar("typeid") == 18 ||$upchapter->getvar("typeid") == 19 ||$upchapter->getvar("typeid") == 22 ||$upchapter->getvar("typeid") == 60 ||$upchapter->getvar("typeid") == 51 ||$upchapter->getvar("typeid") == 72){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 78 ||$upchapter->getvar("typeid") == 64 ||$upchapter->getvar("typeid") == 75 ||$upchapter->getvar("typeid") == 73 || $upchapter->getvar("typeid") == 66 ||$upchapter->getvar("typeid") == 74 ||$upchapter->getvar("typeid") == 77  ||$upchapter->getvar("typeid") == 14 ||$upchapter->getvar("typeid") == 61 ||$upchapter->getvar("typeid") == 79){
			$item['class'] = "����"; 
        }elseif($upchapter->getvar("typeid") == 62){
			$item['class'] = "��ѧ"; 
		}elseif($upchapter->getvar("typeid") == 20 ||$upchapter->getvar("typeid") == 25 ||$upchapter->getvar("typeid") == 26 ||$upchapter->getvar("typeid") == 27 ||$upchapter->getvar("typeid") == 28 ||$upchapter->getvar("typeid") == 29){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 30 ||$upchapter->getvar("typeid") == 31 ||$upchapter->getvar("typeid") == 32 ||$upchapter->getvar("typeid") == 33 ||$upchapter->getvar("typeid") == 50 ||$upchapter->getvar("typeid") == 35 ||$upchapter->getvar("typeid") == 36 ||$upchapter->getvar("typeid") == 70){
			$item['class'] = "�ƻ�";
		}elseif($upchapter->getvar("typeid") == 23 ||$upchapter->getvar("typeid") == 24 ||$upchapter->getvar("typeid") == 59 ||$upchapter->getvar("typeid") == 65 ){
			$item['class'] = "��ʷ";
		}elseif($upchapter->getvar("typeid") == 39 ||$upchapter->getvar("typeid") == 58){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 21 ||$upchapter->getvar("typeid") == 67 || $upchapter->getvar("typeid") == 76){
			$item['class'] = "У԰";
		}elseif($upchapter->getvar("typeid") == 10 ||$upchapter->getvar("typeid") == 12 ||$upchapter->getvar("typeid") == 13 ||$upchapter->getvar("typeid") == 57 ){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 1 ||$upchapter->getvar("typeid") == 2 ||$upchapter->getvar("typeid") == 3 ||$upchapter->getvar("typeid") == 49 ||$upchapter->getvar("typeid") == 55 ||$upchapter->getvar("typeid") == 56 ||$upchapter->getvar("typeid") == 68){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 37 ||$upchapter->getvar("typeid") == 38 ||$upchapter->getvar("typeid") == 54 ){
			$item['class'] = "����";
		}elseif($upchapter->getvar("typeid") == 40 ||$upchapter->getvar("typeid") == 41 ||$upchapter->getvar("typeid") == 42 ||$upchapter->getvar("typeid") == 43 ||$upchapter->getvar("typeid") == 53 ||$upchapter->getvar("typeid") == 63 ){
			$item['class'] = "��Ϸ";
		}else{
			$item['class'] = "";
		}
		
		$item['author'] = $upchapter->getvar("author");
		$item['bookintr'] = jieqi_htmlstr($upchapter->getvar("intro"));
		$item['smallimg'] = jieqi_geturl('article', 'cover', $upchapter->getvar("articleid"), 's', $upchapter->getvar("imgflag"));
		$item['bigimg'] = jieqi_geturl('article', 'cover', $upchapter->getvar("articleid"), 'l', $upchapter->getvar("imgflag"));
		$item['words'] = jieqi_sizeformat($upchapter->getvar("size"));
		$item['tag'] = $upchapter->getvar("poster");
		$item['postdate'] = date('Y-m-d H:i:s' ,$upchapter->getvar("postdate"));
		$item['weekvisit'] = $upchapter->getvar("weekvisit");
		$item['monthvisit'] = $upchapter->getvar("monthvisit");
		$item['allvisit'] = $upchapter->getvar("allvisit");
		if($upchapter->getvar("isvip") > 0){
		   $item['free'] = 0;	
		}else{
		   $item['free'] = 1;	
		}
		if($upchapter->getvar("fullflag") > 1){
			$item['status'] = 1;
		}else{
			$item['status'] = 0;
		}
		
		$item['updatetime'] = $upchapter->getvar("lastupdate");
		$item['group'] = $upchapter->getvar("group");
		$item['keyword'] = str_replace(' ', ';', $upchapter->getvar("keywords"));

        $return = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><data><cname><![CDATA[{$item['class']}]]></cname>
<bookname><![CDATA[{$item['name']}]]></bookname>
<bookid><![CDATA[{$item['id']}]]></bookid>
<bookpic><![CDATA[{$item['smallimg']}]]></bookpic>
<zzjs><![CDATA[{$item['bookintr']}]]></zzjs>
<authorname><![CDATA[{$item['author']}]]></authorname>
<createtime><![CDATA[{$item['postdate']}]]></createtime>
<bksize><![CDATA[{$item['words']}]]></bksize>
<weekvisit><![CDATA[{$item['weekvisit']}]]></weekvisit>
<monthvisit><![CDATA[{$item['monthvisit']}]]></monthvisit>
<allvisit><![CDATA[{$item['allvisit']}]]></allvisit>
<writestatus><![CDATA[{$item['status']}]]></writestatus>
<license><![CDATA[{$item['free']}]]></license>
<channel><![CDATA[{$item['group']}]]></channel>
<keyword><![CDATA[{$item['keyword']}]]></keyword></data>";
		echo $return;
	}else{
		echo "null";
	}
?>