<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/4
 * Time: 下午7:32
 *
 * 小说找回密码接口
 *
 * 请求字段：user_phone   ： 手机号码
 *         verify_code  ： 验证码
 *
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['user_phone']))
{
	$userPhone = trim($_REQUEST['user_phone']);
}
else
{
	$errorMessage = '手机号码不能为空！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['verify_code']))
{
	$verifyCode = trim($_REQUEST['verify_code']);
}
else
{
	$errorMessage = '验证码不能为空！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

$uid = checkVerfiCode($userPhone,$verifyCode);

if($uid != 1)
{
	$errorMessage = '请重新发送验证码！';
}
else
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). "  WHERE mobile = '" . $userPhone . "'";
	
	$status = $query->execute($sql);
	
	if($status)
	{
		$tmp = jieqi_query_rowvars($query->getRow());
		
		$result['uid'] = $tmp['uid'];
	}
	else
	{
		$errorMessage = '获取用户信息失败，请重新发送验证码！';
	}
}


if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '验证通过！','result' => $result));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}