<?php
$client_id = 4; //������ID
set_time_limit(0);
$client_secret = 'C7dzxte6PjFTVYxCzKJtRTasA'; //��վ˽��

define('JIEQI_MODULE_NAME', 'article');  //�����������ģ��
define('JIEQI_CHAR_SET', 'utf-8');  //���ӿ���Ҫת����utf-8�������
define('JIEQI_CHARSET_CONVERT', 0);  //����ҳ�治��Ҫת��
require_once ('../../global.php');  //����ͨ��Ԥ�������
define('JIEQI_NOCONVERT_CHAR', '1');  //���ɵ�url��ַ�����Ǳ���ת�������
jieqi_includedb();
$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
$pagerows = 50; //ÿҳ���������¼
$filepath = !empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : !empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/api/baidu_sitemap.php'; //������ĵ�ַ
$indexstyle = 'info'; //Ĭ��С˵��ҳ����Ϣҳ���óɣ�'info'��Ŀ¼ҳ���óɣ�'index'

header("Content-type: text/xml");


$_GET['page'] = (empty($_GET['page']) || intval($_GET['page']) <= 0) ? 0 : intval($_GET['page']);
//$where ="360s=1 and  lastupdate between ".$_GET['begin']." and ".$_GET['end'] . " ORDER BY lastupdate DESC ";

	//���ĳһҳС˵�б�
	include_once($jieqiModules['article']['path'] . '/include/funurl.php');
	$sql = "SELECT articleid,articlename FROM " . jieqi_dbprefix('article_article') . " WHERE yueduxing = 1 ";
	$query->execute($sql);
	if($query){
$return_begin="<?xml version=\"1.0\" encoding=\"utf-8\" ?><result language=\"zh_CN\" version=\"1.0\">";
$return_content;
	while($row = $query->getRow()){
	   $id = $row['articleid'];
	   $name = $row['articlename'];		
           $return_content=   $return_content."<item><id><![CDATA[".$id."]]></id><bookname><![CDATA[".$name."]]></bookname></item>";	
	}
        $return_end="</result>";		
          echo $return_begin. $return_content. $return_end;
}else{
   echo "null" ;
}
?>