<?php 
/**
 * �׳�֧��-�ύ����
 *
 * �׳�֧��-�ύ���� (http://www.123bill.cn)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 123bill.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', '123bill');
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
		require_once("123bill/keyfile.php");
		require_once("123bill/sign.php");
		/*����֧�����ݷ���������op(֧���������� 1��ʾ֧��)��unitid(�̻�ID)��transid(������ˮ�ţ����̼Ҷ��壬�����ظ�)��objid(��ƷID)��money(��Ʒ���)��retweb(ƽ̨���ص�URL��ַ)*/
		$amount=$money / 100;
		$unitid = $jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�̻����
		$op = $jieqiPayset[JIEQI_PAY_TYPE]['op']; //�������ͣ�1-֧����
		$transid = $paylog->getVar('payid');     //�������[�̻���վ]
		$objid = $jieqiPayset[JIEQI_PAY_TYPE]['objid'];  //������Ʒ����
		$money = $amount;  //���׽��
		$retweb = $jieqiPayset[JIEQI_PAY_TYPE]['payreturn'];   //�̼ҽ���֧�������URL

		$param="op=".$op."&unitid=".$unitid."&transid=".$transid."&objid=".$objid."&money=".$money."&retweb=".$retweb;

		// Using My Private Key File (here 100001 is a Test ID)
		//�̻�֤��(˽Կ)��ַ����ʾ��Ϊ������Կ����ʽ��Կ��Ҫ���Է���ƽ̨���أ�
		$filename = JIEQI_ROOT_PATH.'/configs/pay/'.$jieqiPayset[JIEQI_PAY_TYPE]['prikeyfile'];
		$xmlKey = new KeyFile($filename);
    	$xmlKey->getCRTPrivateKey($modulus, $p, $q, $dp, $dq, $invq);

   	 	$sign = new Sign();    
   	 	$sign->setCRTPrivateKeyFromXML($modulus, $p, $q, $dp, $dq, $invq);
   		$signData = $sign->getSign($param);


		//������POST��֧�����ص�ַ(��ʽ����ʱ��ַ��Ϊhttp://pay.118pay.cn/PhonePay.aspx?)
		$reqURL = $jieqiPayset[JIEQI_PAY_TYPE]['payurl']."?" . $param . "&sign=" . $signData;
		
		// let client redirect to 118PAY Gateway with params & sign
		//echo $reqURL;exit;
	
		header("Location: $reqURL");
		exit;
/*
		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', sprintf('%0.2f', $money / 100));

		$jieqiTpl->assign('unitid', $unitid);
		$jieqiTpl->assign('op', $op);
		$jieqiTpl->assign('transid', $transid);
		$jieqiTpl->assign('objid', $objid);
		$jieqiTpl->assign('money', $money);
		$jieqiTpl->assign('retweb', $retweb);
		$jieqiTpl->assign('sign', $signData);
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
			foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/123bill.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
*/
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>