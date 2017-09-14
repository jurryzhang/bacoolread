<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午6:56
 *
 * 用户阿里支付回调接口
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/aliPayConf.php';

//支付成功
if(isset($_REQUEST["trade_status"]) &&
	$_REQUEST["trade_status"] == "TRADE_SUCCESS")
{
	//参数数组
	$varArray   = array();

	$outTradeNo = trim($_REQUEST["out_trade_no"]);

	include_once '../pay/class/paylog.php';

	$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');

	$dateLength     = 14;

	$orderid        = intval(substr(strval($outTradeNo),$dateLength));

	$paylog         = $paylog_handler->get($orderid);

	if(is_object($paylog))
	{
		$buyname = $paylog->getVar('buyname');
		$buyid   = $paylog->getVar('buyid');
		$payflag = $paylog->getVar('payflag');
		$egold   = $paylog->getVar('egold');
		$money   = $paylog->getVar('money');
		
		if($payflag == 0)
		{
			if($money == trim($_REQUEST['buyer_pay_amount']))
			{
				include_once(JIEQI_ROOT_PATH . '/class/users.php');
				
				$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
				$ret = $users_handler->income($buyid, $egold, $weixinPay['paysilver'], $weixinPay['payscore'][$egold]);
				
				if($ret)
				{
					$note = sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
				}
				else
				{
					$note = sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
				}
				
				$paylog->setVar('rettime', JIEQI_NOW_TIME);
				$paylog->setVar('note', $note);
				$paylog->setVar('payflag', 1);
				
				$paylog_handler->insert($paylog);
			}
		}
	}
	
	echo 'success';
}
?>