<?php
define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_includedb();

//editd by muyi 2017-4-12
	//获取该书籍千字价,已经设置过千字/币,按千字多少币算
	$id=$_GET['id'];
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	$sql="SELECT peregold FROM ". jieqi_dbprefix("article_article")." WHERE articleid =".$id;	
	$query->execute($sql);
	$res=$query->getRow();
   //如果当前小说设置过千字价按千字价算	
	if($res["peregold"]>0){		
		echo 	$res["peregold"];
	}