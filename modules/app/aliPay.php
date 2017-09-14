<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午5:50
 *
 * 用户阿里支付接口
 *
 * 请求字段：egold  ：  金币数
 *         is_ios ： 0，不是ios设备；1：是ios设备
 *
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'alipay');

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/aliPayConf.php';

//if(isset($_REQUEST['is_ios']))
//{
//	$isIos = trim($_REQUEST['is_ios']);
//}
//else
//{
//	$isIos = 0;
//}

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

//关闭支付，字段改为egold_type
if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold'] > 0)
{
	include_once './common/aliPayConf.php';
	
	$_REQUEST['egold'] = intval($_REQUEST['egold']);
	
	if(!empty($aliPay['paylimit']))
	{
		if(!empty($aliPay['paylimit'][$_REQUEST['egold']]))
		{
			$money = intval($aliPay['paylimit'][$_REQUEST['egold']]);
		}
		else
		{
			$errorMessage = $jieqiLang['pay']['buy_type_error'];
		}
	}
	else
	{
		$money = intval($_REQUEST['egold']);
	}
	
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	
	$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	
	$paylog = $paylog_handler->create();
	
	$buytime = JIEQI_NOW_TIME;
	
	$paylog->setVar('siteid', JIEQI_SITE_ID);
	$paylog->setVar('buytime', $buytime);
	$paylog->setVar('rettime', 0);
	$paylog->setVar('buyid', $userID);
	$paylog->setVar('buyname', $userName);
	$paylog->setVar('buyinfo', '');
	$paylog->setVar('moneytype', $aliPay['moneytype']);
	$paylog->setVar('money', $money);
//	$paylog->setVar('money', '0.01');
	$paylog->setVar('egoldtype', $aliPay['paysilver']);
	$paylog->setVar('egold', $_REQUEST['egold']);
	$paylog->setVar('paytype', JIEQI_PAY_TYPE);
	$paylog->setVar('retserialno', '');
	$paylog->setVar('retaccount', '');
	$paylog->setVar('retinfo', '');
	$paylog->setVar('masterid', 0);
	$paylog->setVar('mastername', '');
	$paylog->setVar('masterinfo', '');
	$paylog->setVar('note', '');
	$paylog->setVar('payflag', 0);
//	$paylog->setVar('isios', $isIos);
	
	if(!$paylog_handler->insert($paylog))
	{
		$errorMessage = $jieqiLang['pay']['add_paylog_error'];
	}
	else
	{
		$privateKay                    = $aliPay['payprivatekey'];
		
		//公共参数
		$sysParams['app_id']           = $aliPay['appid'];
		
		$sysParams['charset']          = $aliPay['_input_charset'];
		
		$sysParams['method']           = $aliPay['method'];
		
		$sysParams['notify_url']       = $aliPay['notify_url'];
		
		$sysParams['sign_type']        = $aliPay['sign_type'];
		
		$sysParams['timestamp']        = date("Y-m-d H:i:s",$buytime);
		
		$sysParams['version']          = '1.0';
		
		//业务参数
		$bizContent['timeout_express'] = '90m';
		
		$bizContent['product_code']    = "QUICK_MSECURITY_PAY";
		
//		$bizContent['total_amount']    = 0.01;//$money;
		
		$bizContent['total_amount']    = $money;
		
		$bizContent['subject']         = $aliPay['subject'];
		
		$bizContent['body']            = $aliPay['body'];
		
		$bizContent['out_trade_no']    = date("YmdHis",$buytime) . $paylog->getVar('payid');
		
		$bizContent                    = json_encode_ex($bizContent);
		
		$sysParams['biz_content']      = $bizContent;
		
		$result['sign']                = getSign($sysParams,$privateKay);
		
		$result['payid']               = $paylog->getVar('payid');
	}
}
else
{
//	$errorMessage = $jieqiLang['pay']['need_buy_type'];
	
	$errorMessage = '支付失败，请重试！';
	
	$status       = 0;
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '支付成功！','result' => $result));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}