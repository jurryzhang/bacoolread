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

		jieqi_apis_out($ret);
		exit();
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
