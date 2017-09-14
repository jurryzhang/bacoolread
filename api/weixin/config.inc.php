<?php
//微信登录接口参数设置
//未申请微信登录接口账号的，请到 http://open.weixin.qq.com/ 提交申请

$apiOrder = 2; //接口序号，请勿修改
$apiName = 'weixin'; //接口名，请勿修改
$apiTitle = '微信'; //接口标题，请勿修改

$apiConfigs[$apiName] = array(); //初始化参数数组，请勿修改

$apiConfigs[$apiName]['appid'] = 'wx49571fba5040eff8';  //应用ID，根据实际申请的值修改

$apiConfigs[$apiName]['appkey'] = '61281af902abec56c88a7337f173f78f';  //接口密钥，根据实际申请的值修改

//$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //登录后返回的本站地址，请勿修改

$apiConfigs[$apiName]['callback'] = 'http://www.mianfeidushu.com/api/weixin/loginback.php';  //登录后返回的本站地址，请勿修改

$apiConfigs[$apiName]['scope'] = 'snsapi_login'; //允许授权哪些api接口，用英文逗号分隔

?>
