<?php 
/**
 * ��Ѷ�Ƹ�ͨ-���ش���
 *
 * ��Ѷ�Ƹ�ͨ-���ش��� (https://www.tenpay.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: tenpayreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'tenpay');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$payid=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$cmdno = trim($_REQUEST['cmdno']); //������� 1
$pay_result = trim($_REQUEST['pay_result']); //֧����������������ֵ���붨�塱, 0���ɹ�
$pay_info = trim($_REQUEST['pay_info']); //֧�������Ϣ��֧���ɹ�ʱΪ��
$date = trim($_REQUEST['date']); //�̻�����
$bargainor_id = trim($_REQUEST['bargainor_id']);  //�����˺ţ��̻�spid��
$transaction_id = trim($_REQUEST['transaction_id']); //�Ƹ�ͨ���׺�(������)
$sp_billno = trim($_REQUEST['sp_billno']); //�̻�ϵͳ�ڲ��Ķ����ţ��˲������ڶ���ʱ�ṩ�� 
$total_fee = trim($_REQUEST['total_fee']); //�����ܽ��Է�Ϊ��λ
$fee_type = trim($_REQUEST['fee_type']); //�ֽ�֧������
$attac = trim($_REQUEST['attac']); //�̼����ݰ���ԭ������
$sign = trim($_REQUEST['sign']); //ǩ��

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
//ע����ȷ�Ĳ�����ƴ��˳��
$text="cmdno=".$cmdno."&pay_result=".$pay_result."&date=".$date."&transaction_id=".$transaction_id."&sp_billno=".$sp_billno."&total_fee=".$total_fee."&fee_type=".$fee_type."&attach=".$attach."&key=".$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; 
$mac = md5($text); 

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------

if($bargainor_id != $jieqiPayset[JIEQI_PAY_TYPE]['payid']) jieqi_printfail($jieqiLang['pay']['customer_id_error']);
elseif($pay_result != '0') jieqi_printfail($jieqiLang['pay']['pay_return_error']);
elseif (strtoupper($mac) != strtoupper($sign)) jieqi_printfail($jieqiLang['pay']['return_checkcode_error']);
else{
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid=intval($sp_billno);
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
			$paylog->setVar('money', intval($amount * 100));
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
			else{
				echo '<meta name="TENCENT_ONELINE_PAYMENT" content="China TENCENT">
<html>
<script language=javascript>
window.location.href=\''.sprintf($jieqiPayset[JIEQI_PAY_TYPE]['payresult'], $orderid, $egold, $buyid, urlencode($buyname)).'\';
</script>
</html>';
			}
		}else{
			jieqi_printfail($jieqiLang['pay']['already_add_egold']);
		}
	}else{
		jieqi_printfail($jieqiLang['pay']['no_buy_record']);
	}
}
?>