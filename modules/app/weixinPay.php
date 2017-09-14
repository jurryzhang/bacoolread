<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午5:50
 *
 * 用户微信支付接口
 *
 * 请求字段：egold  ：  金币数
 *
 */

define('JIEQI_MODULE_NAME', "pay");
define('JIEQI_PAY_TYPE', 'weixinpay');

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/weixinPayConf.php';

jieqi_loadlang('pay', JIEQI_MODULE_NAME);

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
		//关闭支付，egold字段改为egold_type
		
		if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold'] > 0)
		{
			$egold = intval($_REQUEST['egold']);
			
			//计算实际需要支付的金额
			if(!empty($weixinPay['paylimit']))
			{
				if(!empty($weixinPay['paylimit'][$egold]))
				{
					$money = intval($weixinPay['paylimit'][$egold]);
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
			$paylog->setVar('siteid', JIEQI_SITE_ID);
			$paylog->setVar('buytime', JIEQI_NOW_TIME);
			$paylog->setVar('rettime', 0);
			$paylog->setVar('buyid', $userID);
			$paylog->setVar('buyname', $userName);
			$paylog->setVar('buyinfo', '');
			$paylog->setVar('moneytype', $weixinPay['moneytype']);
			$paylog->setVar('money', $money);
			
//			$paylog->setVar('money', 1);//测试
			
			$paylog->setVar('egoldtype', $weixinPay['paysilver']);
			$paylog->setVar('egold', $egold);
			$paylog->setVar('paytype', JIEQI_PAY_TYPE);
			$paylog->setVar('retserialno', '');
			$paylog->setVar('retaccount', '');
			$paylog->setVar('retinfo', '');
			$paylog->setVar('masterid', 0);
			$paylog->setVar('mastername', '');
			$paylog->setVar('masterinfo', '');
			$paylog->setVar('note', '');
			$paylog->setVar('payflag', 0);
			
			if(!$paylog_handler->insert($paylog))
			{
				$errorMessage = $jieqiLang['pay']['add_paylog_error'];
			}
			else
			{
				$urlvars                     = array();
				
				//应用ID
				$urlvars['appid']            = $weixinPay['appid'];
				
				//商户号
				$urlvars['mch_id']           = $weixinPay['mch_id'];
				
				//设备号
				$urlvars['device_info']      = $weixinPay['device_info'];
				
				//商品描述
				$urlvars['body']             = $weixinPay['body'];
				
				//随机数生成
				$urlvars['nonce_str']        = weixinPayGetRandChar(16);
				
				//商品外部交易号，必填,每次测试都须修改
				$urlvars['out_trade_no']     = $urlvars['mch_id'] . date("YmdHis") . $paylog->getVar('payid');
				
				//标价金额，单位为分
				$urlvars['total_fee']        = $money;
				
//				$urlvars['total_fee']        = 1;//测试
				
				//终端IP，获取服务器的IP
				$urlvars['spbill_create_ip'] = $weixinPay['ip'];
				
				//通知地址
				$urlvars['notify_url']       = $weixinPay['notify_url'];
				
				//交易类型
				$urlvars['trade_type']       = $weixinPay['trade_type'];
				
				ksort($urlvars);
				
				$sign    = weixinPayToUrlParams($urlvars);
				
				$keyStr  = "&key=" . $weixinPay['paykey']; //key
				
				$sign   .= $keyStr;
				
				$sign    = strtoupper(md5($sign));
				
				$urlvars['sign'] = $sign;
				
				$dataXML = weixinPayToXml($urlvars);
				
				$apiUrl  = $weixinPay['unifiedorder_url'];
				
				$startTimeStamp = weixinPayGetMillisecond();//请求开始时间
				$response       = weixinPayPostXmlCurl($dataXML, $apiUrl);
				
				include_once '../../lib/OpenSDK/WxpayAPI/lib/WxPay.Data.php';
				
				$result = weixinPayFromXml($response);//将$response转换为array
				
				if($result['return_code'] == 'FAIL')
				{
					$errorMessage = '签名错误';
					
					echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
					
					return;
				}
				else if($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS')
				{
					$signUrlVars['appid']     = $result['appid'];//应用ID
					
					$signUrlVars['partnerid'] = $weixinPay['mch_id'];//微信支付分配的商户号
					
					$signUrlVars['prepayid']  = $result['prepay_id'];//预支付交易会话标识
					
					$signUrlVars['noncestr']  = $result['nonce_str'];//随机字符串
					
					$signUrlVars['timestamp'] = substr($startTimeStamp,0,10);//应用ID
					
					$signUrlVars['package']   = $weixinPay['package'];
					
					//生成签名
					ksort($signUrlVars);
					
					$resSignStr   = weixinPayToUrlParams($signUrlVars);
					
					$keyStr       = "&key=" . $weixinPay['paykey']; //key
					
					$resSignStr  .= $keyStr;
					
					$resSign = strtoupper(md5($resSignStr));
					
					$signUrlVars['sign']  = $resSign;
					
					$signUrlVars['payid']     = $paylog->getVar('payid');
				}
			}
		}
		else
		{
			$errorMessage = '微信支付失败，请重试！';
			
			$status       = 0;
		}
		
		break;
	}
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 1,'result' => $signUrlVars));
	
	return;
}
?>