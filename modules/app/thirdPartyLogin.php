<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/18
 * Time: 下午5:18
 *
 * 第三方登录接口
 *
 * 请求字段：openid         ： openid
 *         face_img       ： 头像地址
 *         login_type     ： 登录方式，0：weixinlogin；1：qqlogin；2：weibologin；3：visitorlogin
 *         user_nickname  ： 用户昵称
 *         sex            ： 用户性别
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/appConfigs.php';

if(isset($_REQUEST['openid']) && $_REQUEST['openid'])
{
	$openID = trim($_REQUEST['openid']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取第三方用户信息失败！'));
	
	return;
}

if(isset($_REQUEST['face_img']) && $_REQUEST['face_img'])
{
	$faceImg = trim($_REQUEST['face_img']);
	
	$faceImg = iconv("UTF-8","GBK//IGNORE",$faceImg);
}
else
{
	$faceImg = DEFAULT_FACE_IMG;
}

if(isset($_REQUEST['login_type']))
{
	$loginType = getThirdPartyLoginType(trim($_REQUEST['login_type']));
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取登录方式失败！'));
	
	return;
}

if(isset($_REQUEST['user_nickname']))
{
	$userNickname = trim($_REQUEST['user_nickname']);
	
	$userNickname = iconv("UTF-8","GBK//IGNORE",$userNickname);
}
else
{
	if(trim($_REQUEST['login_type']) != 3)
	{
		$userNickname = DEFAULT_NICKNAME . weixinPayGetRandChar(10);
	}
	else
	{
		$userNickname = DEFAULT_VISITOR_NICKNAME . weixinPayGetRandChar(12);
	}
	
	$userNickname = iconv("UTF-8","GBK//IGNORE",$userNickname);
}

if(isset($_REQUEST['sex']))
{
	$sex = trim($_REQUEST['sex']);
}
else
{
	$sex = '0';
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql   =  'SELECT * FROM ' . jieqi_dbprefix('system_users'). " WHERE uname = '" . $openID ."'";

$result = $query->execute($sql);

if($result)
{
	$userResult = jieqi_query_rowvars($query->getRow());
	
	if(count($userResult) != 0)
	{
		$userInfo['uid']        = $userResult['uid'] ;//用户名id
		
		$userInfo['uname']      = iconv("GBK","UTF-8",$userResult['uname']);//用户名
		
		$userInfo['name']       = iconv("GBK","UTF-8",$userResult['name']);//用户昵称
		
		$userInfo['sign']       = iconv("GBK","UTF-8",$userResult['sign']);//签名
		
		$userInfo['phone']      = $userResult['mobile'];//邮箱
		
		$userInfo['email']      = $userResult['email'];//邮箱
		
		$userInfo['score']      = $userResult['score'];//积分
		
		$userInfo['egold']      = $userResult['egold'];//金币
		
		$userInfo['isvip']      = $userResult['isvip'];//是否是vip
		
		$userInfo['experience'] = $userResult['experience'];//经验值
		
		$userInfo['sex']        = $userResult['sex'];//性别
		
		$userInfo['faceImg']    = $userResult['faceImg'] ? $userResult['faceImg'] : DEFAULT_FACE_IMG;//头像
		
		$userInfo['logintype']  = $userResult['logintype'];//登录方式
		
		if(isset($userResult['uid']) && $userResult['uid'] != 0)
		{
//			$setting = $userResult['setting'];
			
//			unserialize($setting);
			
			$setting['lastip']    = getIP();
			
			$setting['logindate'] = date('Y-m-d',time());
			
			$setting = serialize($setting);
			
			$setting = filterStr($setting);
			
			$sql = 'UPDATE `' . jieqi_dbprefix('system_users') . "` SET `lastlogin` = '" . time() . "' , `setting` = '" . $setting . "' WHERE `uid` = " . $userResult['uid'];
			
			$result = $query->execute($sql);
			
			if($result)
			{
				$status = 1;
				
				setcookie("user_id", $userResult['uid'], time() + 315360000);
				
				setcookie("user_name", $userResult['uname'], time() + 315360000);
				
				setcookie("user_email", $userResult['email'], time() + 315360000);
				
				setcookie("user_phone", $userInfo['phone'], time() + 315360000);
			}
			else
			{
				$errorMessage = '登录失败，请重新登录！';
				
				$status = 0;
			}
		}
	}
	else
	{
		$userName             = $openID;
		
		$name                 = $userNickname;
		
		$password             = DEFAULT_PASSWORD;
		
		$groupID              = '3';
		
		$redate               = time();//注册时间
		
		$setting['regip']     = getIP();
		
		$setting['logindate'] = date('Y-m-d',time());
		
		$setting['lastip']    = getIP();
		
		$setting              = serialize($setting);
		
		$setting              = filterStr($setting);
		
		$faceImg              = $faceImg;
		
		$experience           = $score = '0';
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('system_users'). "` (`uname`,`name`,`pass`,`groupid`,`regdate`,`setting`,`sex`,`faceImg`,`mobile`,`logintype`,`lastlogin`) VALUES ('" . $userName . "', '" . $name . "', '" . $password . "', '" . $groupID . "', '" . $redate . "', '" . $setting .  "', '" . $sex . "', '" . $faceImg . "', '" . $phoneNum . "', '" . $loginType['login_type'] . "', '" . $redate . "')";
		
		$result = $query->execute($sql);
		
		if($result)
		{
			$uid = mysql_insert_id();
			
			$userInfo['uid']        = $uid;//用户名id
			
			$userInfo['uname']      = $openID;//用户名
			
			$userInfo['name']       = iconv("GBK","UTF-8",$userNickname);//用户昵称
			
			$userInfo['sign']       = '';//签名
			
			$userInfo['phone']      = '';//手机
			
			$userInfo['email']      = '';//邮箱
			
			$userInfo['score']      = '0';//积分
			
			$userInfo['egold']      = '0';//金币
			
			$userInfo['isvip']      = '0';//是否是vip
			
			$userInfo['experience'] = '0';//经验值
			
			$userInfo['sex']        = '0';//性别
			
			$userInfo['faceImg']    = $faceImg;//性别
			
			$userInfo['logintype']  = $loginType['login_type'];//登录方式
			
			setcookie("user_id",$uid,time() + 315360000);
			
			setcookie("user_name",$userName,time() + 315360000);
			
			setcookie("user_phone",'',time() + 315360000);
			
			$status = 1;
		}
		else
		{
			$errorMessage = '登录失败，请重新登录！';
			
			$status       = 0;
		}
	}
}
	
if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => '已通过' . $loginType['login_msg'] . '授权，登录成功！','result' => $userInfo));
}

return;