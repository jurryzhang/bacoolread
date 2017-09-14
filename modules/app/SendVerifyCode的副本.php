<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/4
 * Time: 下午7:49
 *
 * 小说发送验证码接口---邮箱
 *
 * 请求字段：user_name  ： 用户名
 *         email      ： 绑定的邮箱
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

define("EMAIL_SUBJECT",'找回密码');

define("EMAIL_CATENAME",'邮件设置');

if(isset($_REQUEST['user_name']))
{
	$userName = trim($_REQUEST['user_name']);
}
else
{
	$errorMessage = '用户名不能为空';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['email']))
{
	$email    = trim($_REQUEST['email']);
	
	$userInfo = checkUserInfoWithUserName($userName,$email);
	
	if($userInfo == -1)
	{
		$errorMessage = '不存在用户，请重试！';
		
		echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
		
		return;
	}
	elseif($userInfo == -2)
	{
		$errorMessage = '绑定邮箱填写错误，请重试！';
		
		echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
		
		return;
	}
}
else
{
	$errorMessage = '邮箱不能为空';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

$emailConf = getTmailConf();

if($emailConf == -1)
{
	echo json_encode_ex(array('status' => 0,'message' => '获取邮箱配置失败！'));
	
	return;
}

/*
 * 发送验证码
 */
require_once './class/phpmailer/class.phpmailer.php';

$mail        = new PHPMailer();

$code        = mt_rand(1000,9999);

$mailcontent = sprintf($emailConf['body'],$code);

$mail->isSMTP();

//配置发送邮件服务
$mail->Host     = $emailConf['host'];//smtp服务器

$mail->Port     = $emailConf['port'];//端口

$mail->SMTPAuth = $emailConf['auth'] == '1'? true : false;//启用SMTP验证功能

$mail->Username = $emailConf['user'];//用户名

$mail->Password = $emailConf['pwd'];//密码

$mail->From     = $emailConf['user'];//发件人

$mail->FromName = "免费读书管理员";//发件人名称

$mail->CharSet  = "utf8";

$mail->Encoding = "base64";

//接收邮件方
$mail->AddAddress($email,"");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")

$code = mt_rand(1000,9999);

$mail->MsgHTML(sprintf('<div><h3>免费读书管理中心</h3><p>系统发信，请勿回复。你的验证码是：%s</p></div>',$code));

$mail->IsHTML(true);

$mail->Subject = EMAIL_SUBJECT;

$mail->AltBody = "This is the body in plain text for non-HTML mail clients";    //邮件正文不支持HTML的备用显示

$status = $mail->send();

if($status)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$time = time();
	
	$sql = 'DELETE FROM ' . jieqi_dbprefix('app_verifycode'). " WHERE uid = '" . $userInfo['uid'] . "'";
	
	$query->execute($sql);
	
	$sql = 'INSERT INTO ' . jieqi_dbprefix('app_verifycode'). " (`uname`,`uid`,`email`,`verifyCode`,`sendTime`) VALUES ('" . $userName . "', '" . $userInfo['uid'] . "', '" . $email . "', '" . $code . "', '" . $time . "')";
	
	$status = $query->execute($sql);
	
	if($status)
	{
		echo json_encode_ex(array('status' => 1,'message' => '验证码发送成功！','result' => $userInfo['uid']));
		
		return;
	}
	else
	{
		echo json_encode_ex(array('status' => 0,'message' => '验证码发送失败！'));
		
		return;
	}
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '验证码发送失败！'));

	return;
}
