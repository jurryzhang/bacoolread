<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/10
 * Time: 上午11:49
 *
 * 修改用户信息接口
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

$userID   = $_COOKIE['user_id'];

$userName = $_COOKIE['user_name'];

$userInfo = checkLogin($userID,$userName);

switch ($userInfo)
{
	case -1:
	{
		$errorMessage = USER_QUERY_ERROR_MSG;
		
		$status       = USER_QUERY_ERROR;
		
		break;
	}
	case -2:
	{
		$errorMessage = USER_LOGIN_ERROR_MSG;
		
		$status       = USER_LOGIN_ERROR;
		
		break;
	}
	default :
	{
		$status     = 1;
		
		$userResult['uid']        = $userInfo['uid'];//用户名id
		
		$userResult['uname']      = $userInfo['uname'];//用户名
		
		$userResult['name']       = $userInfo['name'];//用户昵称
		
		$userResult['phone']      = $userInfo['mobile'];//头像
		
		$userResult['email']      = $userInfo['email'];//头像
		
		$userResult['sign']       = $userInfo['sign'];//签名
		
		$userResult['score']      = $userInfo['score'];//积分
		
		$userResult['egold']      = $userInfo['egold'];//金币
		
		$userResult['isvip']      = $userInfo['isvip'];//是否是vip
		
		$userResult['experience'] = $userInfo['experience'];//经验值
		
		$userResult['sex']        = $userInfo['sex'];//性别
		
		$userResult['faceImg']    = $userInfo['faceImg'];//头像
	}
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => '注册成功！','result' => $userResult));
}

return;