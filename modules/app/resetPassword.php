<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/4
 * Time: 下午7:34
 *
 * 小说重新设置密码接口
 *
 * 请求字段：password  ： 密码
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_COOKIE['user_id']))
{
	$userID = trim($_COOKIE['user_id']);
}
else
{
	$errorMessage = '获得用户信息失败，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['password']))
{
	$password = trim($_REQUEST['password']);
	
	$password = encryptPassword($password);
}
else
{
	$errorMessage = '密码不能为空！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql   = 'UPDATE ' . jieqi_dbprefix('system_users'). " SET pass = '" . $password . "'  WHERE uid = '" . $userID . "'";

$status = $query->execute($sql);

if(!$status)
{
	$errorMessage = '修改密码失败！';
}
else
{
	setcookie("user_id",'',time() - 3600);
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '修改成功，请登录！'));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}