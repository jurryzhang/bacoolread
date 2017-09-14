<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/1
 * Time: 下午8:03
 *
 * 用户注册接口，改为手机号码注册
 *
 * 请求字段：phone        ： 用户名
 *         verify_code  ： 短信验证码
 *         password     ： 密码
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/appConfigs.php';

$errorMessage = '';

if(isset($_REQUEST['phone']))
{
	$phoneNum = trim($_REQUEST['phone']);
}
else
{
	$errorMessage = '手机号不能为空！';
	
	$status       = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['verify_code']))
{
	$verifyCode = trim($_REQUEST['verify_code']);
}
else
{
	$errorMessage = '请输入验证码！';
	
	$status       = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['password']))
{
	$password = encryptPassword(trim($_REQUEST['password']));
}
else
{
	$errorMessage = '请输入密码！';
	
	$status       = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}

$tmp = checkVerfiCode($phoneNum,$verifyCode);

if($tmp == -1)
{
	$errorMessage = '验证码已过期，请重新发送验证码！';
	
	$status       = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}
else if($tmp == -2)
{
	$errorMessage = '请重新发送验证码！';
	
	$status       = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql   =  'SELECT COUNT(*) FROM ' . jieqi_dbprefix('system_users'). " WHERE mobile = '" . $phoneNum ."'";

$result = $query->execute($sql);

if($result)
{
	$userResult = jieqi_query_rowvars($query->getRow());
	
	//检测用户名是否可用
	if($userResult["COUNT(*)"] != 0)
	{
		$errorMessage = '该手机号已被注册，请登录！如果忘记密码，请找回密码！';
		
		$status       = 0;
	}
	else//可以注册
	{
		$sex              = 0;
		
		$faceImg          = DEFAULT_FACE_IMG;
		
		$redate           = time();//注册时间
		
		$groupID          = '3';
		
		$setting['lastip'] = getIP();
		
		$setting['lastlogin'] = date('Y-m-d',time());
		
		$setting['regip'] = getIP();
		
		$setting          = serialize($setting);
		
		$setting          = filterStr($setting);
		
		$experience       = $score = '0';
		
		$lastLogin        = $redate;
		
		$name             = DEFAULT_NICKNAME . weixinPayGetRandChar(10);
		
		$name             = iconv("UTF-8","GBK//IGNORE",$name);
		
		$userName         = $phoneNum;
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('system_users'). "` (`uname`,`name`,`pass`,`groupid`,`regdate`,`setting`,`sex`,`faceImg`,`mobile`,`lastlogin`) VALUES ('" . $userName . "', '" . $name . "', '" . $password . "', '" . $groupID . "', '" . $redate . "', '" . $setting .  "', '" . $sex . "', '" . $faceImg . "', '" . $phoneNum . "', '" . $lastLogin . "')";
		
		$result = $query->execute($sql);
		
		if($result)
		{
			$status = 1;
			
			$userInfo['uid']        = mysql_insert_id();//用户名id
			
			$userInfo['uname']      = $userName;//用户名
			
			$userInfo['name']       = iconv("GBK","UTF-8",$name);//用户昵称
			
			$userInfo['sign']       = '';//签名
			
			$userInfo['phone']      = $phoneNum;
			
			$userInfo['email']      = '';//邮箱
			
			$userInfo['score']      = 0;//积分
			
			$userInfo['egold']      = 0;//金币
			
			$userInfo['isvip']      = 0;//是否是vip
			
			$userInfo['experience'] = 0;//经验值
			
			$userInfo['sex']        = $sex;//性别
			
			$userInfo['faceImg']    = $faceImg;//头像
			
			$userInfo['logintype']  = 'normal';//性别
			
			setcookie("user_id",$userInfo['uid'],time() + 315360000);
			
			setcookie("user_name",$userInfo['uname'],time() + 315360000);
			
			setcookie("user_email",$userInfo['email'],time() + 315360000);
			
			setcookie("user_phone",$userInfo['phone'],time() + 315360000);
		}
		else
		{
			$errorMessage = '注册失败，请重新注册！';
			
			$status       = 0;
		}
	}
}
else
{
	$errorMessage = '注册失败，请重新注册！';
	
	$status       = 0;
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => '注册成功！','result' => $userInfo));
}

return;