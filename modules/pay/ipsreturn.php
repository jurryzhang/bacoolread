<?php 
/**
 * ��Ѹ֧��-���ش���
 *
 * ��Ѹ֧��-���ش��� (http://www.ipay.cn)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: ipsreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'ips');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$billno=trim($_GET['billno']);  //�������
$amount=trim($_GET['amount']);  //���
$date=trim($_GET['date']);  //����
$succ=trim($_GET['succ']);  //Y-�ɹ� N-ʧ��
$msg=trim($_GET['msg']);  //���ؽ����ʾ
$attach=trim($_GET['attach']);  //���ύһ������
$ipsbillno=trim($_GET['ipsbillno']);  //ips�Ķ�����
$retencodetype=trim($_GET['retencodetype']);  //����У�鷽ʽ  0-�Ͻӿ� 1-MD5WithRSA 2-MD5
$signature=trim($_GET['signature']);  //����ǩ��

$money=intval($amount * 100);
$attachary=explode('|', $attach);
if($attachary[1] == '02'){
	$Mer_code = $jieqiPayset[JIEQI_PAY_TYPE]['foreignpayid']; //�̻����
	$key = $jieqiPayset[JIEQI_PAY_TYPE]['foreignpaykey'];  //��Կֵ
}else{
	$Mer_code = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
	$key = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];  //��Կֵ
}

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
$md5string=strtolower(md5($billno.$amount.$date.$succ.$ipsbillno.$key));

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------
if($succ=='Y' && $signature==$md5string){  
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid=substr($billno,-6);
	if(!empty($attachary[0]) && strlen($attachary[0])>6) $orderid=$attachary[0];
	$orderid=intval($orderid);
	$paylog=$paylog_handler->get($orderid);
	if(is_object($paylog)){
		$buyname=$paylog->getVar('buyname');
		$buyid=$paylog->getVar('buyid');
		$payflag=$paylog->getVar('payflag');
		$egold=$paylog->getVar('egold');
		if($payflag == 0){
			include_once(JIEQI_ROOT_PATH.'/class/users.php');
            $users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
			$ret=$users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold]);
			if($ret) $note=sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
			else $note=sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
			$paylog->setVar('rettime', JIEQI_NOW_TIME);
			$paylog->setVar('money', $money);
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
			else jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
		}else{
			jieqi_printfail($jieqiLang['pay']['already_add_egold']);
		}
	}else jieqi_printfail($jieqiLang['pay']['no_buy_record']);
}else jieqi_printfail(sprintf($jieqiLang['pay']['pay_failure_message'], jieqi_htmlstr($msg)));
?>