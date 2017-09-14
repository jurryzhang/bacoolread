<?php
	define("JIEQI_MODULE_NAME", "article");
	require_once ("../../global.php");
	include_once ("config.inc.php");
	include_once (JIEQI_ROOT_PATH . "/include/apicommon.php");
	include_once (JIEQI_ROOT_PATH . "/apis/include/funapis.php");
	include_once ("common.inc.php");
	jieqi_getconfigs("article", "sort", "jieqiSort");
	jieqi_includedb();
	jieqi_apis_power();
	
	$ret=array();
	foreach($jieqiSort["article"] as $v){
		$ret[]=$v['caption'];
	}
	
	if(strpos($_SERVER['REQUEST_URI'],'/json')>0){
		jieqi_apis_out($ret);
		die;
	}
	
	$ret=jieqi_apis_2utf8($ret);
	$tpl='<?xml version="1.0" encoding="UTF-8"?>
				<result>
					%s
				</result>';
	$str='';
	for($i=0;$i<count($ret);$i++){
		$str.='<category>'.$ret[$i].'</category>';
	}
	header("Content-Type:text/xml; charset=utf-8");
	$cat=sprintf($tpl,$str);
	echo $cat;