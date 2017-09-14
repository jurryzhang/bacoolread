<?php 
/**
 * ��Ǯ�����еڶ���-���ش���
 *
 * ��Ǯ�����еڶ���-���ش��� (http://www.99billv2.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 99cardreturnv2.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', '99cardv2');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$parmary=array();
//��ȡ�����������˻���
$parmary['merchantAcctId']=trim($_REQUEST['merchantAcctId']);

//��ȡ���ذ汾.�̶�ֵ
///������汾�Ź̶�Ϊv2.0
$parmary['version']=trim($_REQUEST['version']);

//��ȡ��������.�̶�ѡ��ֵ��
///ֻ��ѡ��1��2
///1�������ģ�2����Ӣ��
$parmary['language']=trim($_REQUEST['language']);

//��ȡ֧����ʽ
///ֵΪ��20 ��22
///20���������п���ֱ��֧����22�����Ǯ�˻����������֧��
$parmary['payType']=trim($_REQUEST['payType']);

//�����п����
///���ͨ�������п�ֱ��֧��ʱ����
$parmary['cardNumber']=trim($_REQUEST['cardNumber']);

//��ȡ�����п�����
///���ͨ�������п�ֱ��֧��ʱ����
$parmary['cardPwd']=trim($_REQUEST['cardPwd']);

//��ȡ�̻�������
$parmary['orderId']=trim($_REQUEST['orderId']);

//��ȡԭʼ�������
///�����ύ����Ǯʱ�Ľ���λΪ�֡�
///�ȷ�2 ������0.02Ԫ
$parmary['orderAmount']=trim($_REQUEST['orderAmount']);

//��ȡ��Ǯ���׺�
///��ȡ�ý����ڿ�Ǯ�Ľ��׺�
$parmary['dealId']=trim($_REQUEST['dealId']);

//��ȡ�̻��ύ����ʱ��ʱ��
///14λ���֡���[4λ]��[2λ]��[2λ]ʱ[2λ]��[2λ]��[2λ]
///�磺20080101010101
$parmary['orderTime']=trim($_REQUEST['orderTime']);

//��ȡ��չ�ֶ�1
///���̻��ύ����ʱ����չ�ֶ�1����һ��
$parmary['ext1']=trim($_REQUEST['ext1']);

//��ȡ��չ�ֶ�2
///���̻��ύ����ʱ����չ�ֶ�2����һ��
$parmary['ext2']=trim($_REQUEST['ext2']);

//��ȡʵ��֧�����
///��λΪ��
///�ȷ� 2 ������0.02Ԫ
$parmary['payAmount']=trim($_REQUEST['payAmount']);

//��ȡ��Ǯ����ʱ��
$parmary['billOrderTime']=trim($_REQUEST['billOrderTime']);

//��ȡ������
///10����֧���ɹ��� 11����֧��ʧ��
$parmary['payResult']=trim($_REQUEST['payResult']);

//��ȡǩ������
///1����MD5ǩ��
///��ǰ�汾�̶�Ϊ1
$parmary['signType']=trim($_REQUEST['signType']);

//��ȡ����ǩ����
$signMsg=trim($_REQUEST['signMsg']);


//2-----------���¼���md5��ֵ---------------------------------------------------------------------------

$txtmac='';
foreach($parmary as $k => $v){
	if($v != ''){
		if($txtmac != '') $txtmac .= '&';
		$txtmac .= $k.'='.$v;
	}
}
if($txtmac != '') $txtmac .= '&';
$txtmac .= 'key='.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'];
$mysignMsg = strtoupper(md5($txtmac));

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------

if($jieqiPayset[JIEQI_PAY_TYPE]['payid'] != $parmary['merchantAcctId']) jieqi_printfail($jieqiLang['pay']['customer_id_error']);
elseif($parmary['payResult'] != '10') jieqi_printfail($jieqiLang['pay']['pay_return_error']);
elseif (strtoupper($signMsg)==strtoupper($mysignMsg)){
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid=intval($parmary['orderId']);
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
			else jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
		}else{
			jieqi_printfail($jieqiLang['pay']['already_add_egold']);
		}
	}else{
		jieqi_printfail($jieqiLang['pay']['no_buy_record']);
	}
}
?>