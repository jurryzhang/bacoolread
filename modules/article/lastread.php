<?php
/*
*�����û�����Ķ���Ϣ
*���� muyi
*/
define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_includedb();
//��ȡ����
	$articlename=$_REQUEST['bn'];
	$articlename=iconv("UTF-8","GBK//IGNORE",$articlename);
	//��ȡ�û�ID
	$uid=$_SESSION['jieqiUserId'];	
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	//�����û�����Ķ���Ϣ
	$sql="UPDATE ". jieqi_dbprefix("system_users")." SET lastread ='".$articlename."'  WHERE uid =".$uid;	
	$query->execute($sql);
	
   