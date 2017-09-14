<?php 
/**
 * ��Ǯ֧��-���ش���
 *
 * ��Ǯ֧��-���ش��� (http://www.99bill.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 99billreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', '99bill');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$mymerchant_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
$key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$merchant_id = trim($_REQUEST['merchant_id']);	//�̻����
$orderid = trim($_REQUEST['orderid']);			//���׶������[�̻���վ]
$amount = trim($_REQUEST['amount']);				//���׽��
$date = trim($_REQUEST['date']);					//��������
$succeed = trim($_REQUEST['succeed']);			//���׽����"Y"��ʾ�ɹ���"N"��ʾʧ��
$mymac = trim($_REQUEST['mac']);               //��ȡ��ȫ���ܴ�
$merchant_param = trim($_REQUEST['merchant_param']); //��ȡ�̻�˽�в���
$couponid = trim($_REQUEST['couponid']);		///��ȡ�Ż�ȯ����
$couponvalue = trim($_REQUEST['couponvalue']);		///��ȡ�Ż�ȯ���

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
//ע����ȷ�Ĳ�����ƴ��˳��
$text = "merchant_id=".$merchant_id."&orderid=".$orderid."&amount=".$amount."&date=".$date."&succeed=".$succeed."&merchant_key=".$key;
$mac = md5($text);

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------

if($merchant_id != $mymerchant_id) jieqi_printfail($jieqiLang['pay']['customer_id_error']);
elseif(strtoupper($succeed) != 'Y') jieqi_printfail($jieqiLang['pay']['pay_return_error']);
elseif (strtoupper($mac)==strtoupper($mymac)){     	//---------���ǩ����֤�ɹ���
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
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
			$uservip=1; //Ĭ�ϵ�vip�ȼ�

			//ͳ���û��ܵĹ�������ң�ȷ��vip�ȼ�
			/*
			jieqi_getconfigs('system', 'vips', 'jieqiVips');
			if(!empty($jieqiVips)){
				$sql="SELECT SUM(saleprice) as sumegold FROM ".jieqi_dbprefix('obook_osale')." WHERE accountid=".$buyid;
				$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
				$query->execute($sql);
				$res=$query->getObject();
				if(is_object($res)) $sumegold=intval($res->getVar('sumegold', 'n'));
				else $sumegold=0;
				$sumegold+=$egold;
				foreach($jieqiVips as $k=>$v){
					$k=intval($k);
					if($sumegold >= $v['minegold'] && $k > $uservip) $uservip = $k;
				}
			}
			*/


			$ret=$users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold], $uservip);
			if($ret) $note=sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
			else $note=sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
			$paylog->setVar('rettime', JIEQI_NOW_TIME);
			$paylog->setVar('money', intval($amount * 100));
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
			else jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
		}else{
			jieqi_printfail($jieqiLang['pay']['already_add_egold']);
		}
	}else{
		jieqi_printfail($jieqiLang['pay']['no_buy_record']);
	}
}
?>