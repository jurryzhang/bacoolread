<?php
/**
 * ΢��֧��-�ύ����
 *
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/21
 * Time: ����10:45
 */

define('JIEQI_MODULE_NAME', "pay");
define('JIEQI_PAY_TYPE', 'weixinpay');
require_once('../../global.php');

jieqi_loadlang("pay", JIEQI_MODULE_NAME);

if(!jieqi_checklogin(true))
{
	jieqi_printfail($jieqiLang['pay']['need_login']);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold'] > 0)
{
	$egold = intval($_REQUEST['egold']);
	
	//����ʵ����Ҫ֧���Ľ��
	if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit']))
	{
		if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$egold]))
		{
			$money = intval($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$egold] * 100);
		}
		else
		{
			jieqi_printfail($jieqiLang['pay']['buy_type_error']);
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
	$paylog->setVar('buyid', $_SESSION['jieqiUserId']);
	$paylog->setVar('buyname', $_SESSION['jieqiUserName']);
	$paylog->setVar('buyinfo', '');
	$paylog->setVar('moneytype', $jieqiPayset[JIEQI_PAY_TYPE]['moneytype']);
	$paylog->setVar('money', $money);
	$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
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
		jieqi_printfail($jieqiLang['pay']['add_paylog_error']);
	}
	else
	{
		$urlvars = array();
		$urlvars['appid']    = $jieqiPayset[JIEQI_PAY_TYPE]['appid']; //�����˺�ID
		
		$jieqiPayset[JIEQI_PAY_TYPE]['body'] = iconv('GB2312','UTF-8',$jieqiPayset[JIEQI_PAY_TYPE]['body']);//��Ʒ����
		
		$urlvars['body'] = $jieqiPayset[JIEQI_PAY_TYPE]['body'];
		
		$urlvars['device_info']    = $jieqiPayset[JIEQI_PAY_TYPE]['device_info']; //�豸��
		
		$urlvars['mch_id']    = $jieqiPayset[JIEQI_PAY_TYPE]['mch_id']; //�����̻���
		
		$urlvars['nonce_str']  = getRandChar(16);//���������
		
		$urlvars['out_trade_no'] = $urlvars['mch_id'].date("YmdHis"). $paylog->getVar('payid'); //��Ʒ�ⲿ���׺ţ�����,ÿ�β��Զ����޸�
		
		$urlvars['total_fee'] = $money;//��۽���λΪ��
		
		//$urlvars['spbill_create_ip'] = $jieqiPayset[JIEQI_PAY_TYPE]['ip'];//�ն�IP����ȡ��������IP
		$urlvars['spbill_create_ip'] = gethostbyname($_ENV['COMPUTERNAME']);//�ն�IP����ȡ��������IP
		
		$urlvars['notify_url'] = $jieqiPayset[JIEQI_PAY_TYPE]['notify_url']; //֪ͨ��ַ
		
		$urlvars['trade_type'] = $jieqiPayset[JIEQI_PAY_TYPE]['trade_type']; //��������
		
		ksort($urlvars);
		
		$sign = toUrlParams($urlvars);
		
		$keyStr = "&key=" . $jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //key
		
		$sign .= $keyStr;
		
		$sign  = strtoupper(md5($sign));
		
		$urlvars['sign'] = $sign;
		
		$dataXML = toXml($urlvars);
		
		$apiUrl = $jieqiPayset[JIEQI_PAY_TYPE]['api_url'];
		
		$startTimeStamp = getMillisecond();//����ʼʱ��
		$response = postXmlCurl($dataXML, $apiUrl);
		
		include_once '../../lib/OpenSDK/WxpayAPI/lib/WxPay.Data.php';
		
		$result = fromXml($response);
		
		checkSign($result,$jieqiPayset[JIEQI_PAY_TYPE]['paykey']);
		
		reportCostTime($apiUrl, $startTimeStamp, $result);//�ϱ����󻨷�ʱ��
		
		file_put_contents('$result.txt',print_r($result,true));
		
		include_once JIEQI_ROOT_PATH . '/header.php';
		
		$jieqiTpl->setCaching(0);
		
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'] . '/templates/weixinpaypay.html';
		
		$jieqiTpl->assign('imgUrl',$result['code_url']);
		
		$jieqiTpl->assign('total_fee',$urlvars['total_fee'] / 100);
		
		$jieqiTpl->assign('out_trade_no',$urlvars['out_trade_no']);
		
		include_once JIEQI_ROOT_PATH . '/footer.php';
	}
}

?>
