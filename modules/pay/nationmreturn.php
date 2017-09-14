<?php 
/**
 * ����֧��-���ش���
 *
 * ����֧��-���ش��� (http://www.nationm.com.cn)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: nationmreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'nationm');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

//1-----------���շ��ص���Ϣ--------------------------------------------------------------------
$merchantID=trim($_GET['merchantID']);  //�̻���    
$orderNum=trim($_GET['orderNum']);   //������   
$amount=trim($_GET['amount']);  //�����ܽ��    
$tranDateTime=trim($_GET['tranDateTime']);   //��������ʱ��    
$orderSerialNum=trim($_GET['orderSerialNum']);    //������ˮ���� 
$sucMark=trim($_GET['sucMark']);     //�ɹ�ʧ�ܱ�־ 0 �ɹ�
$comment=trim($_GET['comment']);     //ʧ��ԭ��
$currentType =trim($_GET['currentType']);    //����
$noticeType=trim($_GET['noticeType']);    //��Ϣ��������
$md5Info=trim($_GET['md5Info']);   //MD5��ϢժҪ  

$my_merchantID = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
$key = $jieqiPayset[JIEQI_PAY_TYPE]['receivekey'];  //���յ���Կ
                           
$money=intval($amount);

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
$md5string=strtoupper(md5($merchantID.$orderNum.$amount.$tranDateTime.$sucMark.$noticeType.$key));

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------
if($sucMark=="0" && $md5Info==$md5string){  
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid=intval($orderNum);
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
}else jieqi_printfail($jieqiLang['pay']['pay_return_error']);
?>