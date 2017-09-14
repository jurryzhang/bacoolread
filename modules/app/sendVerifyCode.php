<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/4
 * Time: 下午7:49
 *
 * 小说发送验证码接口
 *
 * 请求字段：user_phone  ： 手机号码
 *         type        ： 0：注册；1：找回密码
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['user_phone']))
{
	$phoneNum = trim($_REQUEST['user_phone']);
}
else
{
	$errorMessage = '手机不能为空';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['type']))
{
	$type = trim($_REQUEST['type']);
}
else
{
	$errorMessage = '查询类型不能为空';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql   =  'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE mobile = '" . $phoneNum ."'";

$result = $query->execute($sql);

if($result)
{
	$tmp = jieqi_query_rowvars($query->getRow());
	
	if($type == 0)//注册
	{
		if(count($tmp) != 0)
		{
			$errorMessage = '该手机号已存在，请登录！如果忘记密码，请找回密码！';
			
			echo json_encode_ex(array('status' => 0, 'message' => $errorMessage));
			
			return;
		}
		else
		{
			setcookie('user_id', $tmp['uid'], time() + 315360000);
		}
	}
	else//找回密码
	{
		if(count($tmp) == 0)
		{
			$errorMessage = '该手机号不存在，请重试！';
			
			echo json_encode_ex(array('status' => 0, 'message' => $errorMessage));
			
			return;
		}
		else
		{
			setcookie('user_id', $tmp['uid'], time() + 315360000);
		}
	}
}
else
{
	$errorMessage = '检测手机号码失败，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

/*
 * 发送验证码
 */
//获取阿里大于的配置文件
include 'common/aLiDaYuConf.php';

include '../../lib/OpenSDK/ALiDaYu/TopSdk.php';

date_default_timezone_set('Asia/Shanghai');

$c            = new TopClient;
$c->appkey    = $aLiDaYu['key'];
$c->secretKey = $aLiDaYu['Secret'];

$req          = new AlibabaAliqinFcSmsNumSendRequest;

$req->setSmsType($aLiDaYu['sms_type']);
$req->setSmsFreeSignName($aLiDaYu['sms_free_sign_name']);

$code = rand(1000,9999);

$smsParam = array('code' => $code,'product' => $aLiDaYu['sms_free_sign_name']);

$smsParam = json_encode_ex($smsParam);

$req->setSmsParam($smsParam);
$req->setRecNum($phoneNum);
$req->setSmsTemplateCode($aLiDaYu['sms_template_code']);
$resp = $c->execute($req);

if(isset($resp->result))
{
	if(current($resp->result->success) == 'true')
	{
		jieqi_includedb();
		
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
		
		$time = time();
		
		$sql = 'DELETE FROM ' . jieqi_dbprefix('app_verifycode'). " WHERE phone = '" . $phoneNum . "'";
		
		$query->execute($sql);
		
		$sql = 'INSERT INTO ' . jieqi_dbprefix('app_verifycode'). " (`phone`,`verifyCode`,`sendTime`) VALUES ('" . $phoneNum . "', '" . $code . "', '" . $time . "')";
		
		$status = $query->execute($sql);
		
		echo json_encode_ex(array('status' => 1,'message' => '验证码发送成功！'));
	}
	else
	{
		echo json_encode_ex(array('status' => 0,'message' => '验证码发送失败！'));
	}
}
else if(isset($resp->sub_msg))
{
	echo json_encode_ex(array('status' => 0,'message' => current($resp->sub_msg)));
}

return;
