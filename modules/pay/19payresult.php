<?php 
/**
 * 19pay֧��-������֤
 *
 * 19pay֧��-������֤ (http://www.19pay.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 19payresult.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', '19pay');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$mymerchant_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
$merchant_key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$version_id = trim($_REQUEST['version_id']);	//�ӿڰ汾
$merchant_id = trim($_REQUEST['merchant_id']);	//�̻����
$verifystring = trim($_REQUEST['verifystring']); //��ȡ��ȫ���ܴ�
$order_date = trim($_REQUEST['order_date']);	//��������
$order_id = trim($_REQUEST['order_id']);		//���׶������[�̻���վ]
$amount = trim($_REQUEST['amount']);			//���׽��
$currency = trim($_REQUEST['currency']);		//��������

$pay_sq = trim($_REQUEST['pay_sq']);		    //19pay��ˮ��
$pay_date = trim($_REQUEST['pay_date']);		//֧��ʱ�� YYYYMMDDHHMMSS
$pc_id = trim($_REQUEST['pc_id']);		        //֧��ͨ��

$result = trim($_REQUEST['result']);			//���׽����"Y"��ʾ�ɹ���"N"��ʾʧ��

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
//ע����ȷ�Ĳ�����ƴ��˳��
$text="version_id=".$version_id."&merchant_id=".$merchant_id."&order_id=".$order_id."&result=".$result."&order_date=".$order_date."&amount=".$amount."&currency=".$currency."&pay_sq=".$pay_sq."&pay_date=".$pay_date."&pc_id=".$pc_id."&merchant_key=".$merchant_key;

$mac = md5($text); 

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------

if($merchant_id != $mymerchant_id) echo 'N';
elseif(strtoupper($result) != 'Y') echo 'N';
elseif (strtoupper($mac)==strtoupper($verifystring)){     	//---------���ǩ����֤�ɹ���
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$order_id=intval($order_id);
	$paylog=$paylog_handler->get($order_id);
	if(is_object($paylog)){
		$buyname=$paylog->getVar('buyname');
		$buyid=$paylog->getVar('buyid');
		$payflag=$paylog->getVar('payflag');
		if($payflag == 0){
			$egold=$paylog->getVar('egold');
			include_once(JIEQI_ROOT_PATH.'/class/users.php');
			$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
			$ret=$users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold]);
			if($ret) $note=sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
			else $note=sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
			$paylog->setVar('rettime', JIEQI_NOW_TIME);
			$paylog->setVar('money', intval($amount * 100));
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			if(!$paylog_handler->insert($paylog)) echo 'N';
		}
		echo 'Y';
	}else{
		echo 'N';
	}
}
?>