<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/21
 * Time: 下午9:50
 */

define('JIEQI_MODULE_NAME', "pay");
define('JIEQI_PAY_TYPE', 'weixinpay');
require_once('../../global.php');

jieqi_getconfigs(JIEQI_MODULE_NAME,JIEQI_PAY_TYPE,'jieqiPayset');

if(isset($_REQUEST["out_trade_no"]) && $_REQUEST["out_trade_no"] != "")
{
	$outTradeNo = $_REQUEST["out_trade_no"];
	
	//参数数组
	$varArray = array();
	
	$varArray['appid']        = $jieqiPayset[JIEQI_PAY_TYPE]['appid'];
	$varArray['mch_id']       = $jieqiPayset[JIEQI_PAY_TYPE]['mch_id'];
	$varArray['out_trade_no'] = $outTradeNo;
	$varArray['nonce_str']    = getRandChar(16);
	
	//按字典序排序参数
	ksort($varArray);
	
	//生成签名
	$sign   = toUrlParams($varArray);
	
	$keyStr = "&key=" . $jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //key
	
	$sign  .= $keyStr;
	
	$sign   = strtoupper(md5($sign));
	
	$varArray['sign'] = $sign;
	
	$dataXML  = toXml($varArray);
	
	$orderURL = $jieqiPayset[JIEQI_PAY_TYPE]['orderquery_url'];
	
	$startTimeStamp = getMillisecond();//请求开始时间
	$response = postXmlCurl($dataXML, $orderURL);
	
	include_once '../../lib/OpenSDK/WxpayAPI/lib/WxPay.Data.php';
	
	$result = fromXml($response);
	
	checkSign($result,$jieqiPayset[JIEQI_PAY_TYPE]['paykey']);
	
	reportCostTime($orderURL,$startTimeStamp,$result);
	
	echo $result['trade_state'];
	
	if($result['trade_state'] == 'SUCCESS')
	{
		include_once($jieqiModules['pay']['path'].'/class/paylog.php');
		
		$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
		
		//获取payID
		$mchIDLength    = strlen($jieqiPayset[JIEQI_PAY_TYPE]['mch_id']);
		
		$dateLength     = 14;
		
		$orderid        = intval(substr(strval($outTradeNo),$mchIDLength + $dateLength));
		
		$paylog         = $paylog_handler->get($orderid);
		
		if(is_object($paylog))
		{
			$buyname = $paylog->getVar('buyname');
			$buyid   = $paylog->getVar('buyid');
			$payflag = $paylog->getVar('payflag');
			$egold   = $paylog->getVar('egold');
			
			if($payflag == 0)
			{
				include_once(JIEQI_ROOT_PATH.'/class/users.php');
				
				$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
				$ret = $users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold]);
				
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
				
				if(!$paylog_handler->insert($paylog))
				{
					if($showmode)
					{
						jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
					}
				}
				else
				{
					if($showmode)
					{
						jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
					}
				}
			}
			else
			{
				if($showmode)
				{
					jieqi_msgwin($jieqiLang['pay']['already_add_egold']);
				}
			}
		}
		else
		{
			if($showmode)
			{
				jieqi_printfail($jieqiLang['pay']['no_buy_record']);
			}
		}
	}
}

?>