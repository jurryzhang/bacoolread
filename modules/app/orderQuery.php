<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/15
 * Time: 下午5:33
 *
 * 用户支付查询接口
 *
 * 请求字段：order_id  ： 订单号
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['order_id']) && $_REQUEST['order_id'] != '')
{
	$userID   = $_COOKIE['user_id'];
	
	$userName = $_COOKIE['user_name'];
	
	$userInfo = checkLogin($userID,$userName);
	
	if($userInfo != -1 && $userInfo != -2)
	{
		$orderID = trim($_REQUEST['order_id']);
		
		include_once($jieqiModules['pay']['path'].'/class/paylog.php');
		
		$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
		
		$paylog         = $paylog_handler->get($orderID);
		
		if(is_object($paylog))
		{
			$payflag = $paylog->getVar('payflag');
			
			if($payflag == 1)
			{
				$status          = 1;
				
				include_once(JIEQI_ROOT_PATH . '/class/users.php');
				
				$users_handler         =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
				
				$userObj               = $users_handler->get($userID);
				
				$result['userbalance'] = $userObj->getVar('egold');
				
				$successMessage  = '恭喜您，本次交易已经完成充值,请检查您的帐户余额！';
			}
			else
			{
				$status       = 0;
				
				$errorMessage = '订单未确认！';
			}
		}
		else
		{
			$status       = 0;
			
			$errorMessage = '对不起，无此交易记录！';
		}
	}
}
else
{
	$status       = 0;
	
	$errorMessage = '订单查询失败，请重试！';
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $successMessage,'result' => $result));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}