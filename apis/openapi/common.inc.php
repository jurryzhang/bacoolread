<?php

function jieqi_apis_out($data = array(), $format = "json")
{
	switch ($format) {
	case "json":
	default:
		if (JIEQI_SYSTEM_CHARSET != "utf-8") {
			global $charsetary;
			include_once (JIEQI_ROOT_PATH . "/include/changecode.php");
			$data = jieqi_funtoarray("jieqi_" . $charsetary[JIEQI_SYSTEM_CHARSET] . "2" . $charsetary["utf-8"], $data);
		}

		header("Content-Type:text/html; charset=utf-8");
		echo json_encode($data);
		exit();
		break;
	}
}

function utf82gbk($text){
	if(empty($text)){
		return $text;
	}else{
		return iconv('UTF-8','GBK',$text);
	}
	
	
}

function getbooks($bookIDs){
	$bookID=explode("|",$bookIDs);//获取当前专题的书ID
	$tempID=array();//处理成数组
	foreach ($bookID as $v ) {
			$v = trim($v);
			if (is_numeric($v)) {
				$tempID[] = intval($v);
			}
	}
	return $tempID;
}

//检测权限 edit by muyi
function jieqi_apis_power(){
	$mesg='';
	$content='';
	if(empty($_GET['token'])){
		jieqi_apis_error(5);
	}else{
		//检测token对不对
		$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
		$sql="SELECT * FROM ". jieqi_dbprefix("article_api")." WHERE token ='".$_GET['token']."'";
		$query->execute($sql);
		$res=$query->getRow();
		if($res==false){
			jieqi_apis_error(6);
		}else{
			if(!empty($_GET['aid'])){
				$tempID=getbooks($res['bookIDs']);
				if(!in_array($_GET['aid'],$tempID)){
					jieqi_apis_error(7);
				}
			}
		}
	}
	
	
	
	if(!empty($msg)){
		jieqi_jumppage('http://m.mianfeidushu.com', $msg, $content);
	}
	
	
}



function jieqi_apis_2utf8($data){
	if (JIEQI_SYSTEM_CHARSET != "utf-8") {
			global $charsetary;
			include_once (JIEQI_ROOT_PATH . "/include/changecode.php");
		return $data = jieqi_funtoarray("jieqi_" . $charsetary[JIEQI_SYSTEM_CHARSET] . "2" . $charsetary["utf-8"], $data);
		}
}

function url_encode($str) {  
    if(is_array($str)) {  
        foreach($str as $key=>$value) {  
            $str[urlencode($key)] = url_encode($value);  
        }  
    } else {  
        $str = urlencode($str);  
    }  
      
    return $str;  
}  


function jieqi_apis_error($code = 99)
{
	global $jieqiShares;
	global $apisErrors;

	if (!empty($jieqiShares[$_GET["sid"]]["errortype"])) {
		echo $code;
		exit();
	}
	else {
		if (empty($apisErrors)) {
			include_once ("error.inc.php");
		}

		if (isset($apisErrors[$code])) {
			$ret = array("errorcode" => $code, "errormessage" => $apisErrors[$code]);
		}
		else {
			$ret = array("errorcode" => $code, "errormessage" => "unknown");
		}
		//如果请求是json,返回json数据
		if(strpos($_SERVER['REQUEST_URI'],'/json')>0){
			jieqi_apis_out($ret);
			die;
		}
		//输出XML错误信息
		$tpl='<?xml version="1.0" encoding="UTF-8"?>
				<result>
					<errorno>%s</errorno>
					<errormessage>%s</errormessage>
				</result>';
		$ret=jieqi_apis_2utf8($ret);
		$str=sprintf($tpl,$ret['errorcode'],$ret['errormessage']);
		header("Content-Type:text/xml; charset=utf-8");
		echo $str;
		die;
	}
}


function jieqi_apis_checkparams()
{
	global $jieqiShares;

	if (!isset($jieqiShares)) {
		jieqi_getconfigs("system", "shares", "jieqiShares");
	}

	if (empty($_GET["sid"]) || !is_numeric($_GET["sid"]) || !isset($jieqiShares[$_GET["sid"]]) || empty($jieqiShares[$_GET["sid"]]["apikey"])) {
		jieqi_apis_error(1);
	}
	else {
		$_GET["sid"] = intval($_GET["sid"]);
		define("JIEQI_SHARE_SID", $_GET["sid"]);
	}

	ksort($_GET);
	$sign = "";

	foreach ($_GET as $k => $v ) {
		if (($k != "sign") && (0 < strlen($v))) {
			$sign .= $k . "=" . $v . "&";
		}
	}

	$sign = md5($sign . "key=" . $jieqiShares[$_GET["sid"]]["apikey"]);

	if (strtolower($_GET["sign"]) != $sign) {
		jieqi_apis_error(2);
	}

	return true;
}


?>
