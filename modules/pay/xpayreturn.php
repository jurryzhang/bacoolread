<?php 
/**
 * �׸�ͨ-���ش���
 *
 * �׸�ͨ-���ش��� ��http://www.xpay.cn��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: xpayreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'xpay');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

//����XPAYƽ̨���ص���Ϣ
$tid=$_REQUEST["tid"];//   '�̻�Ψһ���׺ţ�
$bid=$_REQUEST["bid"];//     '�̻���վ������
$sid=$_REQUEST["sid"];//     '�׸�ͨ���׳ɹ� ��ˮ��
$prc=$_REQUEST["prc"];//    '֧���Ľ��
$actionCode=$_REQUEST["actioncode"];//    '������
$actionParameter=$_REQUEST["actionparameter"];//    'ҵ�����
$card=$_REQUEST["card"];//    '֧����ʽ
$success=$_REQUEST["success"];//    '�ɹ���־��
$bankcode=$_REQUEST["bankcode"];//   '֧������
$remark1=$_REQUEST["remark1"];//     '��ע��Ϣ
$username=$_REQUEST["username"];//  '�̻���վ֧���û�
$md=$_REQUEST["md"];//               '32λmd5��������
$money=intval($prc * 100);

//ȡ���̻�����
$tid = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻���ţ��ĳ�XPAY���������̻��ı��
$key = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����
     
if ($success=="false") {
     jieqi_printfail($jieqiLang['pay']['pay_return_error']);
}
//'��֤�����Ƿ���ȷ   
$ymd=md5($key . ":" . $bid . "," . $sid . "," . $prc . "," . $actionCode  ."," . $actionParameter . "," . $tid . "," . $card . "," . $success);//  '���ؽ������ݼ���
if($md!=$ymd){  //             '��֤�����Ƿ���ȷ
    jieqi_printfail($jieqiLang['pay']['return_checkcode_error']);
}else{
//�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$paylog=$paylog_handler->get($bid);
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
}
?>