<?php 
/**
 * ��ӯһ��ͨ-���ش���
 *
 * ��ӯһ��ͨ-���ش��� ��http://www.vnetone.com��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: vnetonereturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'vnetone');
require_once('../../global.php');
//jieqi_checklogin();
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$spid=$jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�̻�SP���� 5λ
$sppwd=$jieqiPayset[JIEQI_PAY_TYPE]['paykey'];//�̻�SP��Կ 18λ
$rtmd5=$_GET['v1'];//'V�ҷ�����MD5 
$trka=$_GET['v2'];// 'V�Һ���15λ
$rtmi=$_GET['v3'];//'V������6λ ������Ϊ�� ��V��û�����룩
$rtmz=$_GET['v4'];//'��ֵ 1-999 ������ֵ
$rtlx=$_GET['v5'];//'��������1��2��3 ��  1:��ʽ�� 2�����Կ� 3 ��������
$rtoid=$_GET['v6'];//ӯ���������Ķ���
$rtcoid=$_GET['v7'];//�ͻ��˶���
$rtuserid=$_GET['v8'];//�û�ID
$rtcustom=$_GET['v9'];//�̻��Զ����ֶ�
$rtflag=$_GET['v10'];//'����״̬. 1Ϊ�������ͻ��� 2Ϊ�������ͻ���

$get_key=strtoupper(md5($trka.$rtmi.$rtoid.$spid.$sppwd.$rtcoid.$rtflag.$rtmz));
//'��+��+vpay�Ķ��� + 5λspid+ 18λSP����+�ͻ�����+rtflag��������1��2+֧�����

if($rtflag != 1 && $rtflag != 2){
	jieqi_printfail(sprintf($jieqiLang['pay']['pay_failure_message'],''));
}elseif($rtmd5 != $get_key){
	jieqi_printfail($jieqiLang['pay']['return_checkcode_error']);
}else{
	header("Data-Received:ok_vpay8");  //���û��ӵ�ɹ����ʹ���Ϣ��ӯ��������������ȥ���˾䡣
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid=intval($rtcoid);
	$paylog=$paylog_handler->get($orderid);
	if(is_object($paylog)){
		$buyname=$paylog->getVar('buyname');
		$buyid=$paylog->getVar('buyid');
		$payflag=$paylog->getVar('payflag');
		$egold=$paylog->getVar('egold');
		
		//���ܷ��صĽ����ύ�Ĳ�ͬ
		$moneyary=array_flip($jieqiPayset[JIEQI_PAY_TYPE]['paylimit']);
		if(isset($moneyary[$rtmz])) $egold = $moneyary[$rtmz];
		
		if($payflag == 0){
			include_once(JIEQI_ROOT_PATH.'/class/users.php');
			$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
			$uservip=1; //Ĭ�ϵ�vip�ȼ�
			$ret=$users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold], $uservip);
			if($ret) $note=sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
			else $note=sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
			$paylog->setVar('rettime', JIEQI_NOW_TIME);
			$paylog->setVar('retserialno', $rtoid);
			$paylog->setVar('retaccount', $trka);
			$paylog->setVar('retinfo', $rtmi);
			$paylog->setVar('egold', $egold);
			$paylog->setVar('money', $rtmz);
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
			else jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
		}else{
			jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
		}
	}else{
		jieqi_printfail($jieqiLang['pay']['no_buy_record']);
	}
}

?>