<?php
$client_id = 4; //������ID
$client_secret = 'C7dzxte6PjFTVYxCzKJtRTasA'; //��վ˽��
$sign='C7dzxte6PjFTVYxCzKJtRTasA';

define('JIEQI_MODULE_NAME', 'article');  //�����������ģ��
define('JIEQI_CHAR_SET', 'utf-8');  //���ӿ���Ҫת����utf-8�������
define('JIEQI_CHARSET_CONVERT', 0);  //����ҳ�治��Ҫת��
require_once ('../../global.php');  //����ͨ��Ԥ�������
define('JIEQI_NOCONVERT_CHAR', '1');  //���ɵ�url��ַ�����Ǳ���ת�������
//�������ݿ�
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
	$txtcontent=str_replace("    ","<p></p>",$txtcontent);
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
		$txtcontent=str_replace('<br />',"",$txtcontent);
		$txtcontent=str_replace('&nbsp;&nbsp;&nbsp;&nbsp;',"<p></p>",$txtcontent);
//$txtcontent.="</p>\n";  
	    $order=array("\r\n","\r","\t");   
	    $replace='  ';
            $txtcontent=str_replace($order,$replace,$txtcontent);
}
$item['txtcontent']=$txtcontent;

	
$return = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
                   <content> <![CDATA[".$txtcontent."]]></content>
                   ";
echo $return;
?>