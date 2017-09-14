<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/17
 * Time: 下午12:41
 *
 * 请求字段：user_phone ： 用户手机号
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
	$errorMessage = '提交的手机号码不能为空，请重试！';
	
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
		
		$sql    = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE  mobile = '" . $userPhone . "'";
		
		$result = $query->execute($sql);
		
		if($result)
		{
			$tmp = jieqi_query_rowvars($query->getRow());
			
			if(count($tmp) != 0)
			{
				$errorMessage = '该手机号码已存在，请重试！';
				
				$status       = 0;
			}
			else
			{
				$sql    = 'UPDATE ' . jieqi_dbprefix('system_users'). "  SET mobile = '" . $userPhone . "' WHERE uid = " . $userID ."";
				
				$result = $query->execute($sql);
				
				if($result)
				{
					$tmp = checkLogin($userID,$userName);
					
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
					$errorMessage = '修改手机号码失败，请重试！';
					
					$status       = 0;
				}
			}
		}
		else
		{
			$errorMessage = '修改手机号码失败，请重试！';
			
			$status       = 0;
		}
	}
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => '修改用户邮箱成功！','result' => $userResult));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}
