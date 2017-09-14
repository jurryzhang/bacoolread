<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午6:55
 *
 * 用户微信支付回调接口
 *
 */


require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/weixinPayConf.php';

$xml = $GLOBALS['HTTP_RAW_POST_DATA'];

$reponse = weixinPayFromXml($xml);//将$xml转换为array

//支付成功
if(isset($reponse["return_code"]) &&
	$reponse["return_code"] == "SUCCESS" &&
	isset($reponse["result_code"]) &&
	$reponse["result_code"] == "SUCCESS")
{
	//参数数组
	$varArray   = array();

	$outTradeNo = $reponse["out_trade_no"];

	include_once '../pay/class/paylog.php';
	
	$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');

	$mchIDLength    = strlen($weixinPay['mch_id']);

	$dateLength     = 14;

	$orderid        = intval(substr(strval($outTradeNo),$mchIDLength + $dateLength));
	
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
			if($money == $reponse["total_fee"])
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
		
		$urlvars['return_code'] = 'SUCCESS';
			
		$urlvars['return_msg']  = 'OK';
	}
	else
	{
		$urlvars['return_code'] = 'FAIL';
		
		$urlvars['return_msg']  = '操作失败';
	}
}
else
{
	$urlvars['return_code'] = 'FAIL';
	
	$urlvars['return_msg']  = '参数格式校验错误';
}

$dataXML = weixinPayToXml($urlvars);

$apiUrl  = $weixinPay['orderquery_url'];

weixinPayPostXmlCurl($dataXML, $apiUrl);//商户处理后同步返回给微信

?>