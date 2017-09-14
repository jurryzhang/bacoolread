<?php 
/**
 * �ױ�֧��-�ύ����
 *
 * �ױ�֧��-�ύ���� �� http://www.yeepay.com��
 * 
 * ����ģ�壺/modules/pay/templates/yeepay
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: yeepay.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'yeepay');
require_once('../../global.php');
require_once('yeepaycommon.php'); //�ױ�֧���ӿڹ�������
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
if(!jieqi_checklogin(true)) jieqi_printfail($jieqiLang['pay']['need_login']);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold']>0){
	$_REQUEST['egold']=intval($_REQUEST['egold']);
	if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'])){
		if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']])) $money=intval($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']] * 100);
		else jieqi_printfail($jieqiLang['pay']['buy_type_error']);
	}else{
		$money=$_REQUEST['egold'];
	}
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$paylog= $paylog_handler->create();
	$paylog->setVar('siteid', JIEQI_SITE_ID);
	$paylog->setVar('buytime', JIEQI_NOW_TIME);
	$paylog->setVar('rettime', 0);
	$paylog->setVar('buyid', $_SESSION['jieqiUserId']);
	$paylog->setVar('buyname', $_SESSION['jieqiUserName']);
	$paylog->setVar('buyinfo', '');
	$paylog->setVar('moneytype', $jieqiPayset[JIEQI_PAY_TYPE]['moneytype']);
	$paylog->setVar('money', $money);
	$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
	$paylog->setVar('egold', $_REQUEST['egold']);
	$paytype=JIEQI_PAY_TYPE;
	if(isset($_POST['pd_FrpId'])) $_POST['pd_FrpId']=trim($_POST['pd_FrpId']);
	if(!empty($_POST['pd_FrpId']) && isset($jieqiPayset[JIEQI_PAY_TYPE]['paytype'][$_POST['pd_FrpId']])) $paytype=$jieqiPayset[JIEQI_PAY_TYPE]['paytype'][$_POST['pd_FrpId']];
	$paylog->setVar('paytype', $paytype);
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
		$amount=$money / 100;
		$merchantId = $jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�̻����
		$orderId = $paylog->getVar('payid');     //�������[�̻���վ]
		$cur = $jieqiPayset[JIEQI_PAY_TYPE]['cur'];    //���ҵ�λCNY
		$productId = empty($jieqiPayset[JIEQI_PAY_TYPE]['productId']) ? JIEQI_EGOLD_NAME : $jieqiPayset[JIEQI_PAY_TYPE]['productId'];    //��Ʒ����
		$productCat = $jieqiPayset[JIEQI_PAY_TYPE]['productCat'];    //���ҵ�λCNY
		$productDesc = $jieqiPayset[JIEQI_PAY_TYPE]['productDesc'];    //���ҵ�λCNY
		$sMctProperties = $jieqiPayset[JIEQI_PAY_TYPE]['sMctProperties'];    //���ҵ�λCNY
		$frpId = trim($_POST['pd_FrpId']) != '' ? trim($_POST['pd_FrpId']) : $jieqiPayset[JIEQI_PAY_TYPE]['frpId'];    //���ҵ�λCNY
		$needResponse = $jieqiPayset[JIEQI_PAY_TYPE]['needResponse'];    //���ҵ�λCNY
		$nodeAuthorizationURL = $jieqiPayset[JIEQI_PAY_TYPE]['payurl'];    //���ҵ�λCNY
		$merchantCallbackURL = $jieqiPayset[JIEQI_PAY_TYPE]['payreturn'];    //���ҵ�λCNY
		$messageType = $jieqiPayset[JIEQI_PAY_TYPE]['messageType'];    //���ҵ�λCNY
		$addressFlag = $jieqiPayset[JIEQI_PAY_TYPE]['addressFlag'];    //���ҵ�λCNY

		$merchant_url = $jieqiPayset[JIEQI_PAY_TYPE]['payreturn'];   //�̼ҽ���֧�������URL
		$commodity_info = urlencode(JIEQI_EGOLD_NAME);
		$pname = urlencode($_SESSION['jieqiUserName']);
		$keyValue = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];
		
		$mac = getReqHmacString($orderId,$amount,$cur,$productId,$productCat,$productDesc,$sMctProperties,$frpId,$needResponse);; //�Բ���������˽Կ����ȡ��ֵ

		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', sprintf('%0.2f', $money / 100));

		$jieqiTpl->assign('merchant_id', $merchantId);
		$jieqiTpl->assign('orderid', $orderId);
		$jieqiTpl->assign('amount', $amount);
		$jieqiTpl->assign('cur', $cur);
		$jieqiTpl->assign('merchant_url', $merchant_url);
		$jieqiTpl->assign('commodity_info', $commodity_info);
		$jieqiTpl->assign('productId', $productId);
		$jieqiTpl->assign('productCat', $productCat);
		$jieqiTpl->assign('productDesc', $productDesc);
		$jieqiTpl->assign('sMctProperties', $sMctProperties);
		$jieqiTpl->assign('frpId', $frpId);
		$jieqiTpl->assign('needResponse', $needResponse);
		$jieqiTpl->assign('nodeAuthorizationURL', $nodeAuthorizationURL);
		$jieqiTpl->assign('merchantCallbackURL', $merchantCallbackURL);
		$jieqiTpl->assign('messageType', $messageType);
		$jieqiTpl->assign('addressFlag', $addressFlag);
		$jieqiTpl->assign('mac', $mac);
		if(isset($jieqiPayset[JIEQI_PAY_TYPE]['payfrom'])){
			$jieqiTpl->assign('fromselect', 1);
			$fromrows=array();
			foreach($jieqiPayset[JIEQI_PAY_TYPE]['payfrom'] as $k=>$v){
				$fromrows[]=array('id'=>$k, 'name'=>$v);
			}
			$jieqiTpl->assign_by_ref('fromrows', $fromrows);
		}
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
         	foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/yeepay.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>