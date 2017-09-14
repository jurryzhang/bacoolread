<?php 
/**
 * �����ֻ���Ѷ-���ش���
 *
 * �����ֻ���Ѷ-���ش��� (http://www.ivansms.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: ivancallreturn.php 234 2008-11-28 01:53:06Z juny $
 */

//�ֻ���绰��������֤�룬�û�����ҳ��������֤��

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'ivancall');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$logflag = 0; //�Ƿ��¼��־

//ret.php?calling=13912345678&called=-1-2-5-9-0467422&stime=2008-05-22%2014:35:36&etime=2008-05-22%2014:40:39&fee=500

$calling=trim($_REQUEST['calling']); //�û������ֻ���
$fee=intval(trim($_REQUEST['fee'])); //֧�����֣�
$stime=trim($_REQUEST['stime']); //ͨ����ʼʱ��
$etime=trim($_REQUEST['etime']); //ͨ������ʱ��
$called=trim($_REQUEST['called']); //δ֪����

$pwd=trim($_REQUEST['pwd']); //�ύMD5���ܺ��������Կ ��ֹ�Ƿ�URL�ύ����


//**********************************************************
//��¼��־
if($logflag){
	$tmpvar=print_r($_REQUEST, true);
	jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivancallrecv.txt',$tmpvar,'ab');
}

//�ַ����ĳ�����,�˴������޸�
if($calling == '13000000000'){
	echo 'OK';
	exit;
}

//��ϢУ��
if(strtolower($pwd) != md5($calling.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'])){
	if($logflag){
		$tmpvar='check error: called='.$called.'; pwd='.$pwd.'; check='.md5($calling.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'].$called)."\r\n";
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivancallerr.txt',$tmpvar,'ab');
	}
	echo 'dberror';
	exit;
}

//��ֹ���ֻ�����
if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['denyphone']) && in_array($calling, $jieqiPayset[JIEQI_PAY_TYPE]['denyphone'])){
	if($logflag){
		$tmpvar='phone number denied: Usernumber='.$calling.";\r\n";
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivancallerr.txt',$tmpvar,'ab');
	}
	echo 'OK';
	exit;
}


//����֧�������������
if(!isset($jieqiPayset[JIEQI_PAY_TYPE]['egoldrate'])) $jieqiPayset[JIEQI_PAY_TYPE]['egoldrate']=0;
$egold = ceil($fee * $jieqiPayset[JIEQI_PAY_TYPE]['egoldrate']);
$note = $stime.' '.$etime;

include_once(JIEQI_ROOT_PATH.'/modules/pay/class/paylog.php');
$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');

$criteria=new CriteriaCompo();
$criteria->add(new Criteria('buyinfo', $phone));
$criteria->add(new Criteria('note', $note));
$criteria->add(new Criteria('paytype', JIEQI_PAY_TYPE));
$paylog_handler->queryObjects($criteria);
$paylog = $paylog_handler->getObject();
if(is_object($paylog)){
	echo 'OK';
	exit;
}

$paylog= $paylog_handler->create();
$paylog->setVar('siteid', JIEQI_SITE_ID);
$paylog->setVar('buytime', JIEQI_NOW_TIME);
$paylog->setVar('rettime', 0);
$paylog->setVar('buyid', 0);
$paylog->setVar('buyname', '');
$paylog->setVar('buyinfo', $calling);
$paylog->setVar('moneytype', $jieqiPayset[JIEQI_PAY_TYPE]['moneytype']);
$paylog->setVar('money', $fee);
$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
$paylog->setVar('egold', $egold);
$paylog->setVar('paytype', JIEQI_PAY_TYPE);
$paylog->setVar('retserialno', '');
$paylog->setVar('retaccount', $called);
$paylog->setVar('retinfo', $called);
$paylog->setVar('masterid', 0);
$paylog->setVar('mastername', '');
$paylog->setVar('masterinfo', '');
$paylog->setVar('note', $note);
$paylog->setVar('payflag', -2);
$paylog_handler->insert($paylog);

$serialno=$paylog->getVar('payid', 'n');
$retstr='serialno:'.$serialno.' egold:'.$egold.' called:'.$called;
if($logflag){
	$tmpvar=$retstr."\r\n";
	jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivancallret.txt',$tmpvar,'ab');
}
echo 'OK';
exit;

?>