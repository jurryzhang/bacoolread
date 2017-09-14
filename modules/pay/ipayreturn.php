<?php 
/**
 * �й�����֧��-���ش���
 *
 * �й�����֧��-���ش��� (http://www.ipay.cn)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: ipayreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'ipay');
require_once('../../global.php');
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');
$v_mid = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻���ţ��ĳ�IPAY���������̻��ı��
$key = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

//1-----------����IPAYƽ̨���ص���Ϣ--------------------------------------------------------------------
$v_date=trim($_POST['v_date']);
$v_mid=trim($_POST['v_mid']);
$v_oid=trim($_POST['v_oid']);
$v_amount=trim($_POST['v_amount']);
$v_status=trim($_POST['v_status']);
$v_md5=trim($_POST['v_md5']);
$money=intval($v_amount * 100);


//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
$md5string=md5($v_date.$v_mid.$v_oid.$v_amount.$v_status.$key);

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------
if(($v_status=="20" || $v_status=="00") && ($v_md5==$md5string)){
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$v_oid=intval($v_oid);
	$paylog=$paylog_handler->get($v_oid);
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
}else jieqi_printfail($jieqiLang['pay']['pay_return_error']);
?>