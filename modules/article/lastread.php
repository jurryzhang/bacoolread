<?php
/*
*更新用户最后阅读信息
*创建 muyi
*/
define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_includedb();
//获取书名
	$articlename=$_REQUEST['bn'];
	$articlename=iconv("UTF-8","GBK//IGNORE",$articlename);
	//获取用户ID
	$uid=$_SESSION['jieqiUserId'];	
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	//更新用户最后阅读信息
	$sql="UPDATE ". jieqi_dbprefix("system_users")." SET lastread ='".$articlename."'  WHERE uid =".$uid;	
	$query->execute($sql);
	
   