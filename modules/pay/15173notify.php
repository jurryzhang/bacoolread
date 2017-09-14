<?php 
/**
 * 15173֧��-����У��
 *
 * 15173֧��-����У�� (http://www.15173.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 15173notify.php 234 2008-11-28 01:53:06Z juny $
 */

$paytype_config = trim($_REQUEST['attach']);  //���ݷ��ص�attach����ȷ��������һ�������ļ�
define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', $paytype_config);
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');
//print_r($_REQUEST);
$mymerchant_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
$key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$merchant_id = trim($_REQUEST['bargainor_id']);	//�̻����
$orderid = trim($_REQUEST['sp_billno']);			//���׶������[�̻���վ]
$amount = trim($_REQUEST['total_fee']);				//���׽��
$date = trim($_REQUEST['date']);					//��������
$succeed = trim($_REQUEST['pay_result']);			//���׽����0֧���ɹ���3֧��ʧ�ܣ�4֧������
$mymac = trim($_REQUEST['sign']);               //��ȡ��ȫ���ܴ�
$attach = trim($_REQUEST['attach']);

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
//ע����ȷ�Ĳ�����ƴ��˳��
$text="pay_result=".$succeed."&bargainor_id=".$merchant_id."&sp_billno=".$orderid."&total_fee=" . $amount ."&attach=" . $attach ."&key=".$key;
$mac = md5($text);
//echo $text."<br>";
//echo $mymac." | ".$mac;
//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------

if($merchant_id != $mymerchant_id) jieqi_printfail($jieqiLang['pay']['customer_id_error']);
elseif(strtoupper($succeed) != 0) jieqi_printfail($jieqiLang['pay']['pay_return_error']);
elseif (strtoupper($mac)==strtoupper($mymac)){     	//---------���ǩ����֤�ɹ���
//	exit('Happy!');
	include_once(JIEQI_ROOT_PATH.'/modules/pay/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid=intval($orderid);
	$paylog=$paylog_handler->get($orderid);
	if(is_object($paylog)){
		$buyname=$paylog->getVar('buyname');
		$buyid=$paylog->getVar('buyid');
		$payflag=$paylog->getVar('payflag');
		$egold=$paylog->getVar('egold');
		$money=$paylog->getVar('money');  //��ȡ�û����ѡ��Ľ��
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

            $yuan = intval($amount);
            if($money != $yuan*100)  //ʵ�ʷ��صĽ����û����ѡ��Ľ���
            {
                $temparr = array_flip($jieqiPayset[JIEQI_PAY_TYPE]['paylimit']);
                if(isset($temparr[$yuan])) $egold = intval($temparr[$yuan]);
                else jieqi_printfail($jieqiLang['pay']['pay_return_error']);
            }
			$ret=$users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold], $uservip);
			if($ret) $note=sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
			else $note=sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
			$paylog->setVar('rettime', JIEQI_NOW_TIME);
			$paylog->setVar('money', intval($amount * 100));
			$paylog->setVar('egold', $egold);
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
			else echo "OK";//jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
		}else{
			echo "OK";//jieqi_printfail($jieqiLang['pay']['already_add_egold']);
		}
	}else{
		jieqi_printfail($jieqiLang['pay']['no_buy_record']);
	}
}
?>