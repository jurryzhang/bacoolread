<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/10
 * Time: 下午12:49
 *
 * 修改用户密码
 *
 * 请求字段：user_oldpassword ： 用户原始密码
 *         user_password    ： 用户密码
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['user_oldpassword']))
{
	$userOldPassword = trim($_REQUEST['user_oldpassword']);
	
	$userOldPassword = encryptPassword($userOldPassword);
}
else
{
	$errorMessage = '提交的密码不能为空，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['user_password']))
{
	$userPassword = trim($_REQUEST['user_password']);
	
	$userPassword = encryptPassword($userPassword);
}
else
{
	$errorMessage = '提交的密码不能为空，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

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
		jieqi_includedb();
		
		$query  = JieqiQueryHandler::getInstance('JieqiQueryHandler');
		
		$sql    = "SELECT * FROM `" . jieqi_dbprefix('system_users') . "` WHERE uid = '" . $userID . "'";
		
		$result = $query->execute($sql);
		
		if($result)
		{
			$tmp = jieqi_query_rowvars($query->getRow());
			
			if($tmp['pass'] == $userOldPassword)
			{
				$sql    = 'UPDATE ' . jieqi_dbprefix('system_users'). "  SET pass = '" . $userPassword . "' WHERE uid = " . $userID ."";
				
				$result = $query->execute($sql);
				
				if($result)
				{
					$tmp = $userInfo;
					
					$userResult['uid']        = $tmp['uid'];//用户名id
					
					$userResult['uname']      = iconv("GBk","UTF-8",$tmp['uname']);//用户名
					
					$userResult['name']       = iconv("GBk","UTF-8",$tmp['name']);//用户昵称
					
					$userResult['phone']      = $tmp['mobile'];//头像
					
					$userResult['email']      = $tmp['email'];//头像
					
					$userResult['sign']       = iconv("GBk","UTF-8",$tmp['sign']);//签名
					
					$userResult['score']      = $tmp['score'];//积分
					
					$userResult['egold']      = $tmp['egold'];//金币
					
					$userResult['isvip']      = $tmp['isvip'];//是否是vip
					
					$userResult['experience'] = $tmp['experience'];//经验值
					
					$userResult['sex']        = $tmp['sex'];//性别
					
					$userResult['faceImg']    = $tmp['faceImg'];//头像
					
					$status                   = 1;
				}
				else
				{
					$errorMessage = '修改密码失败2，请重试！';
					
					$status       = 0;
				}
			}
			else
			{
				$errorMessage = '原始密码不正确，请重试！';
				
				$status       = 0;
			}
		}
		else
		{
			$errorMessage = '修改密码失败1，请重试！';
			
			$status       = 0;
		}
	}
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '修改用户密码成功！','result' => $userResult));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}
