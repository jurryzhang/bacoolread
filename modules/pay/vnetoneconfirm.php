<?php 
/**
 * ��ӯһ��ͨ-��ֵȷ��
 *
 * ��ӯһ��ͨ-��ֵȷ�� ��http://www.vnetone.com��
 * 
 * ����ģ�壺/modules/pay/templates/vnetone.html
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: vnetoneconfirm.php 312 2008-12-29 05:30:54Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'vnetone');
require_once('../../global.php');
jieqi_checklogin();
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_loadlang('vnetone', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold']>0){
	$_REQUEST['egold']=intval($_REQUEST['egold']);
	if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'])){
		if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']])) $money=intval($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']]);
		else jieqi_printfail($jieqiLang['pay']['buy_type_error']);
	}else{
		$money=round(intval($_REQUEST['egold']) / 100);
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
		//$money=round($money / 100);
		$orderid = $paylog->getVar('payid');     //�������[�̻���վ]
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('spid', $jieqiPayset[JIEQI_PAY_TYPE]['payid']);
		$jieqiTpl->assign('spname', rawurlencode(JIEQI_SITE_NAME));
		$jieqiTpl->assign('spoid', $orderid); //������
		$spreq = 'http://'.JIEQI_LOCAL_HOST.jieqi_addurlvars(array(),false,false);
		$jieqiTpl->assign('spreq', $spreq);
		$jieqiTpl->assign('sprec', $jieqiPayset[JIEQI_PAY_TYPE]['payreturn']);
		$jieqiTpl->assign('userid', $_SESSION['jieqiUserId']);
		$jieqiTpl->assign('userip', jieqi_userip());

		$post_key=$orderid.$spreq.$jieqiPayset[JIEQI_PAY_TYPE]['payreturn'].$jieqiPayset[JIEQI_PAY_TYPE]['payid'].$jieqiPayset[JIEQI_PAY_TYPE]['paykey'].$jieqiPayset[JIEQI_PAY_TYPE]['version'].$money;//
		// '��վ��������+ �����ַ+ ���յ�ַ + 5λspid+ 18λSP����+֧���İ汾��+֧�����
		////'LCase�����ǽ��ַ�ת��ΪСд; Ucase�����ǽ��ַ�ת��Ϊ��д
		//'ȫ����Ѷ֧������ȫ����Ѷ�绰֧���ӿڶ�MD5ֵֻ�ϴ�д�ַ���������Сд��MD5ֵ��ת��Ϊ��д
		$md5password=strtoupper(md5($post_key)); // '��MD5 32 Ȼ��ת��д
		$jieqiTpl->assign('spmd5', $md5password);

		$jieqiTpl->assign('spcustom', rawurlencode(JIEQI_EGOLD_NAME));
		$jieqiTpl->assign('spversion', $jieqiPayset[JIEQI_PAY_TYPE]['version']);
		$jieqiTpl->assign('money', $money);
		$jieqiTpl->assign('urlcode', JIEQI_SYSTEM_CHARSET);

		$jieqiTpl->setCaching(0);
		$jieqiTpl->display($jieqiModules['pay']['path'].'/templates/vnetone.html');
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}




?>