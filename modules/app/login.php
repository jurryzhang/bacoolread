<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/1
 * Time: 下午5:26
 *
 * 用户登录接口
 *
 * 请求字段：user_name  ： 用户名
 *         password   ： 密码
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

$errorMessage = '';

if(isset($_REQUEST['user_name']))
{
	$userName = trim($_REQUEST['user_name']);
}
else
{
	$errorMessage = '用户名不能为空！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['password']))
{
	$password = encryptPassword(trim($_REQUEST['password']));
}
else
{
	$errorMessage = '密码不能为空！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql   =  'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE uname = '" . $userName . "' AND pass = '" . $password . "'";

$result = $query->execute($sql);

if($result)
{
	$userResult = jieqi_query_rowvars($query->getRow());
	
	$userInfo['uid']        = $userResult['uid'] ;//用户名id
	
	$userInfo['uname']      = iconv("GBK","UTF-8",$userResult['uname']);//用户名
	
	$userInfo['name']       = iconv("GBK","UTF-8",$userResult['name']);//用户昵称
	
	$userInfo['sign']       = iconv("GBK","UTF-8",$userResult['sign']);//签名
	
	$userInfo['phone']      = $userResult['mobile'];//手机
	
	$userInfo['email']      = $userResult['email'];//邮箱
	
	$userInfo['score']      = $userResult['score'];//积分
	 
	$userInfo['egold']      = $userResult['egold'];//金币
	
	$userInfo['isvip']      = $userResult['isvip'];//是否是vip
	
	$userInfo['experience'] = $userResult['experience'];//经验值
	
	$userInfo['sex']        = $userResult['sex'];//性别
	
	$userInfo['faceImg']    = $userResult['faceImg'] ? $userResult['faceImg'] : DEFAULT_FACE_IMG;//头像
	
	$userInfo['logintype']  = 'normal';//性别
	
	if(isset($userResult['uid']) && $userResult['uid'] != 0)
	{
//		$setting = $userResult['setting'];
//
//        unserialize($setting);
		
		$setting['lastip'] = getIP();
		
		$setting['logindate'] = date('Y-m-d',time());
		
		$setting = serialize($setting);
		
		$setting = filterStr($setting);
		
		$sql = 'UPDATE `' . jieqi_dbprefix('system_users'). "` SET `lastlogin` = '" . time() . "' , `setting` = '" . $setting . "' WHERE `uid` = " . $userResult['uid'];
		
		$result = $query->execute($sql);
		
		if($result)
		{
			setcookie("user_id",$userResult['uid'],time() + 315360000);
			
			setcookie("user_name",$userResult['uname'],time() + 315360000);
			
			setcookie("user_email",$userResult['email'],time() + 315360000);
			
			setcookie("user_phone",$userInfo['phone'],time() + 315360000);
		}
		else
		{
			$errorMessage = '登录失败，请重新登录！';
		}
	}
	else
	{
		$errorMessage = '用户名和密码出错，请重试！';
	}
}
else
{
	$errorMessage = '查询失败，请重试！';
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => 1,'message' => '登录成功！','result' => $userInfo));
}

return;