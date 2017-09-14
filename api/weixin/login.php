<?php

define("JIEQI_MODULE_NAME", "system");
define('JIEQI_CHAR_SET', 'utf-8');  //本接口需要转换成utf-8编码输出
define("JIEQI_NEED_SESSION", 1);
require_once ("../../global.php");
include_once ("./config.inc.php");
include_once ("./lang_api.php");
set_include_path(JIEQI_ROOT_PATH . "/lib/");
include_once (JIEQI_ROOT_PATH . "/lib/OpenSDK/Weixin/SNS2.php");
$_SESSION["jieqiUserApi"][$apiName] = $apiConfigs[$apiName];
$_SESSION["jieqiUserApi"][$apiName]["state"] = md5(uniqid(rand(), true));
OpenSDK_Weixin_SNS2::init($apiConfigs[$apiName]["appid"], $apiConfigs[$apiName]["appkey"]);
$url = OpenSDK_Weixin_SNS2::getAuthorizeURL($apiConfigs[$apiName]["callback"], "code", $_SESSION["jieqiUserApi"][$apiName]["state"], $apiConfigs[$apiName]["scope"]);
header("Location: " . jieqi_headstr($url));

?>
