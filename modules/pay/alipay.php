<?php
/**
 * ֧����-�ύ����
 *
 * ֧����-�ύ���� (http://www.alipay.com)
 *
 * ����ģ�壺��
 *
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: alipay.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'alipay');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);

if(!jieqi_checklogin(true))
{
	jieqi_printfail($jieqiLang['pay']['need_login']);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold'] > 0)
{
	$_REQUEST['egold'] = intval($_REQUEST['egold']);
	
	if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit']))
	{
		if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']]))
		{
			$money=intval($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']] * 100);
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
	
	if(!$paylog_handler->insert($paylog))
	{
		jieqi_printfail($jieqiLang['pay']['add_paylog_error']);
	}
	else
	{
		$urlvars = array();
		$urlvars['service'] = $jieqiPayset[JIEQI_PAY_TYPE]['service']; //��������
		$urlvars['partner'] = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�����̻���
		//$urlvars['agent']=$jieqiPayset[JIEQI_PAY_TYPE]['agent']; //������id
		$urlvars['return_url'] = $jieqiPayset[JIEQI_PAY_TYPE]['payreturn'];  //ͬ������
		$urlvars['notify_url'] = $jieqiPayset[JIEQI_PAY_TYPE]['notify_url'];  //�첽����
		$urlvars['_input_charset'] = $jieqiPayset[JIEQI_PAY_TYPE]['_input_charset'];  //�ַ�����Ĭ��ΪGBK
		
		$urlvars['subject'] = JIEQI_EGOLD_NAME;  //��Ʒ���ƣ�����
		//$urlvars['body']= $jieqiPayset[JIEQI_PAY_TYPE]['body']; //��Ʒ����
		$urlvars['out_trade_no'] = $paylog->getVar('payid'); //��Ʒ�ⲿ���׺ţ�����,ÿ�β��Զ����޸�
		$urlvars['total_fee'] = $money / 100;          //��Ʒ�ܼ�
		//$price=$total_fee; //��Ʒ����
		//$quantity=1; //��Ʒ����
		$urlvars['payment_type'] = $jieqiPayset[JIEQI_PAY_TYPE]['payment_type']; // ��Ʒ֧������ 1 ����Ʒ���� 2�������� 3���������� 4������ 5���ʷѲ��� 6������
		$urlvars['show_url'] = $jieqiPayset[JIEQI_PAY_TYPE]['show_url'];  //��Ʒ�����վ��˾
		$urlvars['seller_email'] = $jieqiPayset[JIEQI_PAY_TYPE]['seller_email'];   //�������䣬����
		
		ksort($urlvars);
		reset($urlvars);
		$sign  = '';
		$query = '';
		
		foreach($urlvars as $k => $v)
		{
			if(!empty($sign))
			{
				$sign.='&';
			}
			
			$sign .= $k . '=' . $v;
			
			if(!empty($query))
			{
				$query.='&';
			}
			
			$query .= $k . '=' . urlencode($v);
		}
		
		$sign   = md5($sign.$jieqiPayset[JIEQI_PAY_TYPE]['paykey']);
		$query .= '&sign_type=' . $jieqiPayset[JIEQI_PAY_TYPE]['sign_type']. '&sign=' . $sign;
		$query  = $jieqiPayset['alipay']['payurl'].'?'.$query;
		
		header('Location: '.$query);
		/*
		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', sprintf('%0.2f', $money / 100));

		foreach($urlvars as $k=>$v){
			$jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->assign('sign_type', $jieqiPayset[JIEQI_PAY_TYPE]['sign_type']);
		$jieqiTpl->assign('sign', $sign);
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
			foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/alipay.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
		*/
	}
}
else
{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>