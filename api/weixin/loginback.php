<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if( $_SERVER['SERVER_NAME'] == 'www.mianfeidushu.com' && strpos($user_agent, 'MicroMessenger') != false )
{
	header("location:http://m.mianfeidushu.com/api/weixin/loginback.php?code=".$_GET['code']."&state=".$_GET['state']);
	exit;
}

define("JIEQI_MODULE_NAME", "system");
define("JIEQI_NEED_SESSION", 1);
require_once ("../../global.php");
include_once ("./config.inc.php");
include_once ("./lang_api.php");
define('JIEQI_CHAR_SET', 'utf-8');  //本接口需要转换成utf-8编码输出
define('JIEQI_CHARSET_CONVERT', 0);

if($_GET['state']!=$_SESSION["jieqiUserApi"][$apiName]["state"])
{
	exit("5001");
}

//$AppID = 'wx1e97c03a475cc715';
//$AppSecret = 'ffe94b82e2a5ac22e228174e6de455f5';
$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$apiConfigs[$apiName]["appid"].'&secret='.$apiConfigs[$apiName]["appkey"].'&code='.$_GET['code'].'&grant_type=authorization_code';

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $url);
$json =  curl_exec($ch);
curl_close($ch);

$arr = json_decode($json,1);

//得到 access_token 与 openid
//print_r($arr);

// exit;
$_SESSION["jieqiUserApi"][$apiName]["access_token"] = $arr['access_token'];
$_SESSION["jieqiUserApi"][$apiName]["expire_in"] = JIEQI_NOW_TIME + $arr['expire_in'];
$_SESSION["jieqiUserApi"][$apiName]["refresh_token"] = $arr['refresh_token'];
$_SESSION["jieqiUserApi"][$apiName]["openid"] = $arr['openid'];

$url ='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
//exit($url);
$ch  = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $url);
$json =  curl_exec($ch);
curl_close($ch);
$arr = json_decode($json,1);

//得到用户资料
//print_r($arr);
//var_dump($arr['openid']);

//print_r($_SESSION["jieqiUserApi"][$apiName]["access_token"]);

$_SESSION["jieqiUserApi"][$apiName]["unionid"] = $arr['unionid'];
$_SESSION["jieqiUserApi"][$apiName]["openkey"] = "";

$apiField = jieqi_dbslashes($apiName) . "id";
//print_r($apiField);

$apiOrder = intval($apiOrder);

jieqi_includedb();

$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$sql   = "SELECT * FROM " . jieqi_dbprefix("system_userapi") . " WHERE $apiField = '" . jieqi_dbslashes($_SESSION["jieqiUserApi"][$apiName]["unionid"]) . "' LIMIT 0, 1";

$query->execute($sql);

$row = $query->getRow();

//$userbind = false;

if (is_array($row) && !empty($row["uid"]))
{
	include_once (JIEQI_ROOT_PATH . "/class/users.php");

	$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

	$jieqiUsers = $users_handler->get($row["uid"]);
	
	if (!is_object($jieqiUsers))
	{
		$flagnum = pow(2, $apiOrder - 1);
		$flagstr = str_repeat("1", 30);
		$flagstr[30 - $apiOrder] = "0";
		
		if ($row["apiflag"] == $flagnum)
		{
			$sql = "DELETE FROM " . jieqi_dbprefix("system_userapi") . " WHERE $apiField = '" . jieqi_dbslashes($_SESSION["jieqiUserApi"][$apiName]["unionid"]) . "'";
		}
		else
		{
			$sql = "UPDATE " . jieqi_dbprefix("system_userapi") . " SET apiflag = apiflag & " . bindec($flagstr) . " WHERE $apiField = '" . jieqi_dbslashes($_SESSION["jieqiUserApi"][$apiName]["unionid"]) . "'";
		}
		
		$query->execute($sql);
	}
	else
	{
		$apidata = jieqi_unserialize($row["apidata"]);
		
		if (!is_array($apidata))
		{
			$apidata = array();
		}
		
		$apidata[$apiName] = array("expire_in" => $_SESSION["jieqiUserApi"][$apiName]["expire_in"], "access_token" => $_SESSION["jieqiUserApi"][$apiName]["access_token"], "openid" => $_SESSION["jieqiUserApi"][$apiName]["openid"], "openkey" => $_SESSION["jieqiUserApi"][$apiName]["openkey"], "unionid" => $_SESSION["jieqiUserApi"][$apiName]["unionid"]);
		$sql = "UPDATE " . jieqi_dbprefix("system_userapi") . " SET apidata = '" . jieqi_dbslashes(serialize($apidata)) . "' WHERE $apiField = '" . jieqi_dbslashes($_SESSION["jieqiUserApi"][$apiName]["unionid"]) . "'";
		$query->execute($sql);
		include_once (JIEQI_ROOT_PATH . "/include/checklogin.php");
		jieqi_loginprocess($jieqiUsers);
		
		if (defined("JIEQI_USER_INTERFACE") && preg_match("/^\w+$/is", JIEQI_USER_INTERFACE))
		{
			include_once (JIEQI_ROOT_PATH . "/include/funuser_" . JIEQI_USER_INTERFACE . ".php");
		}
		else
		{
			include_once (JIEQI_ROOT_PATH . "/include/funuser.php");
		}
		
		$ucsyncode = "";
		
		if (function_exists("uc_get_user"))
		{
			if ($data = uc_get_user($jieqiUsers->getVar("uname", "n")))
			{
				$email     = $data[2];
				$username  = $data[1];
				$uid       = $data[0];
				$ucsyncode = uc_user_synlogin($uid);
			}
		}
		
		if (empty($_SESSION["jieqiUserApi"][$apiName]["jumpurl"]))
		{
			$_SESSION["jieqiUserApi"][$apiName]["jumpurl"] = JIEQI_URL . "/";
		}
		
		if (defined("JIEQI_WAP_PAGE"))
		{
			jieqi_wapgourl($_SESSION["jieqiUserApi"][$apiName]["jumpurl"]);
		}
		else if ($_REQUEST["jumphide"])
		{
			jieqi_jumppage($_SESSION["jieqiUserApi"][$apiName]["jumpurl"], "", $ucsyncode, true);
		}
		else
		{
			jieqi_jumppage($_SESSION["jieqiUserApi"][$apiName]["jumpurl"], $jieqiLang["system"]["login_title"], sprintf($jieqiLang["system"]["api_login_success"], $jieqiUsers->getVar("name", "n")) . $ucsyncode);
		}
		
		$userbind = true;
		
		exit();
	}
}

if (!$userbind)
{
	header("Location: " . jieqi_headstr(JIEQI_USER_URL . "/api/" . $apiName . "/bind.php"));
}

?>
