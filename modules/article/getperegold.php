<?php
define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_includedb();

//editd by muyi 2017-4-12
	//��ȡ���鼮ǧ�ּ�,�Ѿ����ù�ǧ��/��,��ǧ�ֶ��ٱ���
	$id=$_GET['id'];
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	$sql="SELECT peregold FROM ". jieqi_dbprefix("article_article")." WHERE articleid =".$id;	
	$query->execute($sql);
	$res=$query->getRow();
   //�����ǰС˵���ù�ǧ�ּ۰�ǧ�ּ���	
	if($res["peregold"]>0){		
		echo 	$res["peregold"];
	}