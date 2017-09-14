<?php 
/**
 * ��Ѹ֧��-�ύ����
 *
 * ��Ѹ֧��-�ύ���� (http://www.ipay.cn)
 * 
 * ����ģ�壺/modules/pay/templates/ips.html
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: ips.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'ips');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
if(!jieqi_checklogin(true)) jieqi_printfail($jieqiLang['pay']['need_login']);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold']>0){
	$_REQUEST['egold']=intval($_REQUEST['egold']);
	if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'])){
		if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']])) $money=intval($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']] * 100);
		else jieqi_printfail($jieqiLang['pay']['buy_type_error']);
	}else{
		$money=intval($_REQUEST['egold']);
	}
	if(!empty($_REQUEST['moneytype'])) $_REQUEST['moneytype']=intval($_REQUEST['moneytype']);
	else $_REQUEST['moneytype']=0;
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$paylog= $paylog_handler->create();
	$paylog->setVar('siteid', JIEQI_SITE_ID);
	$paylog->setVar('buytime', JIEQI_NOW_TIME);
	$paylog->setVar('rettime', 0);
	$paylog->setVar('buyid', $_SESSION['jieqiUserId']);
	$paylog->setVar('buyname', $_SESSION['jieqiUserName']);
	$paylog->setVar('buyinfo', '');
	$paylog->setVar('moneytype', $_REQUEST['moneytype']);
	$paylog->setVar('money', $money);
	$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
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
	if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['add_paylog_error']);
	else{
		if($_REQUEST['moneytype'] == 1){ 
			$Currency="02";	
			$cardinfo=$jieqiLang['pay']['card_foreign'];
			$Mer_code=$jieqiPayset[JIEQI_PAY_TYPE]['foreignpayid'];  //�⿨�̻����
			$key=$jieqiPayset[JIEQI_PAY_TYPE]['foreignpaykey']; //�⿨��Կ
		}else{
			$Currency="01";	
			$cardinfo=$jieqiLang['pay']['card_local'];
			$Mer_code=$jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�̻����
			$key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ
		}
		$orderid=intval($paylog->getVar('payid'));
		$insertid=$orderid;
		if(strlen($orderid)>6) $orderid=substr($orderid, -6);
		else $orderid=sprintf("%06d",$orderid);
		$Billno=$Mer_code.$orderid; //�����ţ�6λ�̻��ż������̻����������6λ���ֱ�ţ�һ���ڲ����ظ�
		$Amount=sprintf('%0.2f', $money / 100);  //���
		$Date=date("Ymd");
		$Merchanturl=$jieqiPayset[JIEQI_PAY_TYPE]['payreturn']; //����URL
		$Lang=$jieqiPayset[JIEQI_PAY_TYPE]['Lang']; //1 ���� 2 Ӣ��
		$Attach=$insertid.'|'.$Currency; //ԭֵ���صĶ���������У�飬�����ύ����������ˮ��|�������01����� 02��Ԫ
		$RetEncodeType=$jieqiPayset[JIEQI_PAY_TYPE]['RetEncodeType']; //������֤��ʽ 0-�Ͻӿ� 1-MD5WithRSA 2-MD5
		$OrderEncodeType=$jieqiPayset[JIEQI_PAY_TYPE]['OrderEncodeType']; //�ύ��֤��ʽ 0-�޼��� 1-MD5 2-MD5_all
		$Rettype=$jieqiPayset[JIEQI_PAY_TYPE]['Rettype']; //���ط�ʽ 0����ѡ 1��server to server
		$SignMD5=md5($Billno.$Amount.$Date.$key);  //$OrderEncodeType=1���
		$Signmd5_all=md5($Billno.$Amount.$Date.$Currency.$Lang.$key); //$OrderEncodeType=2���

		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', $Amount);
		
		$jieqiTpl->assign('Mer_code', $Mer_code);
		$jieqiTpl->assign('Billno', $Billno);
		$jieqiTpl->assign('Amount', $Amount);
		$jieqiTpl->assign('Date', $Date);
		$jieqiTpl->assign('Currency', $Currency);
		$jieqiTpl->assign('Merchanturl', $Merchanturl);
		$jieqiTpl->assign('Lang', $Lang);
		$jieqiTpl->assign('Attach', $Attach);
		$jieqiTpl->assign('RetEncodeType', $RetEncodeType);
		$jieqiTpl->assign('OrderEncodeType', $OrderEncodeType);
		$jieqiTpl->assign('Rettype', $Rettype);
		$jieqiTpl->assign('SignMD5', $SignMD5);
		$jieqiTpl->assign('Signmd5_all', $Signmd5_all);
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
         	foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/ips.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>