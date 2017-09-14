<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/2/6
 * Time: 上午9:02
 *
 * 请求字段：is_ios     ： 0，不是ios设备；1：是ios设备
*          page_num   ： 页码
 *         page_size  ： 一页中包含小说的数量
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

//if(isset($_REQUEST['is_ios']))
//{
//	$isIos = trim($_REQUEST['is_ios']);
//}
//else
//{
//	$isIos = 0;
//}

if(isset($_REQUEST['page_num']))
{
	$pageNum = $_REQUEST['page_num'];
}
else
{
	$pageNum = DEFAULT_START_PAGE_NUM;
}

if(isset($_REQUEST['page_size']))
{
	$pageSize = $_REQUEST['page_size'];
}
else
{
	$pageSize = DEFAULT_PAGE_SIZE;
}

$userID   = $_COOKIE['user_id'];

$userName = $_COOKIE['user_name'];

$userInfo = checkLogin($userID,$userName);

switch ($userInfo)
{
	case -1://查询失败
	{
		$errorMessage = USER_QUERY_ERROR_MSG;
		
		$status       = USER_QUERY_ERROR;
		
		break;
	}
	case -2://没有该用户
	{
		$errorMessage = USER_LOGIN_ERROR_MSG;
		
		$status       = USER_LOGIN_ERROR;
		
		break;
	}
	default :
	{
		break;
	}
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$errorMessage   = '';

$successMessage = '';

//if($isIos)
//{
//	$sql = 'SELECT * FROM ' . jieqi_dbprefix('pay_paylog') . " WHERE buyid = '" . $userInfo['uid'] . "' AND payflag != 2 AND isios = 1" . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;;
//}
//else
//{
//	$sql = 'SELECT * FROM ' . jieqi_dbprefix('pay_paylog') . " WHERE buyid = '" . $userInfo['uid'] . "' AND payflag != 2 AND isios != 1" . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;;
//}

$sql = 'SELECT * FROM ' . jieqi_dbprefix('pay_paylog') . " WHERE buyid = '" . $userInfo['uid'] . "' AND payflag != 2 ORDER BY `buytime` DESC  LIMIT " . $pageNum * $pageSize . " , " . $pageSize;;

$status = $query->execute($sql);

if($status)
{
	while ($row = $query->getRow())
	{
		$tmpPayLog          = jieqi_query_rowvars($row);
		
		$payLog['payid']    = $tmpPayLog['buytime'] . $userResult['payid'];
		
		$payLog['status']   = $tmpPayLog['payflag'];
		
		$payLog['egold']    = $tmpPayLog['egold'];
		
		$payLog['paytime']  = date('Y-m-d H:i:s',$tmpPayLog['buytime']);
		
		$result[]           = $payLog;
	}
	
	if(empty($result))
	{
		$result = array();
	}
	
	$status         = 1;
	
	$successMessage = '获取充值记录成功';
}
else
{
	$status       = 0;
	
	$errorMessage = '获取充值记录失败';
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $successMessage,'result' => $result));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
	
	return;
}