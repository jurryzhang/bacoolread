<?php 
/**
 * �����ֻ�����-���ش���
 *
 * �����ֻ�����-���ش��� (http://www.ivansms.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: ivansmsreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'ivansms');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$logflag = 0; //�Ƿ��¼��־

$Command=trim($_REQUEST['Command']); //Command = DELIVER ��ʾ�û�����ָ���ύ Command = REPORT ��ʾ�û��Ʒ�״̬����ָ���ύ
//pwd�Ƿַ����ĺ���֮�����Կ�����ں�̨�������Կ�����ǻὫ��Կ��ͬ���ύ��������ͨ���ж���Կ�Ƿ�Ϸ������д���
$Pwd=trim($_REQUEST['pwd']); //�ύMD5���ܺ��������Կ ��ֹ�Ƿ�URL�ύ����
$Usernumber=trim($_REQUEST['usernumber']); //�û������ֻ���
$Spnumber=trim($_REQUEST['spnumber']); //�û�����ָ��
$gatename=trim($_REQUEST['gatename']); //�������ƣ�gatename=mobile��ʾ�ƶ�,gamename=unicom��ʾ��ͨ
$linkid=trim($_REQUEST['linkid']); //��Ӫ��ҵ�����IDlinkid,linkid���ƶ�����ͨ���ɲ��·����������͡�Ψһ���ظ���
$report=intval(trim($_REQUEST['report'])); //�Ʒ�״̬���棬report=1��ʾ�Ʒѳɹ�,������ʾʧ��

//**********************************************************
//��¼��־
if($logflag){
	$tmpvar=print_r($_REQUEST, true);
	jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivansmsrecv.txt',$tmpvar,'ab');
}

//�ַ����ĳ�����,�˴������޸�
if($Usernumber == '13000000000'){
	echo 'Success';
	exit;
}

//��ϢУ��
if(strtolower($Command) != 'report' && $Pwd != md5($Usernumber.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'].$linkid)){
	if($logflag){
		$tmpvar='check error: linkid='.$linkid.'; pwd='.$Pwd.'; check='.md5($Usernumber.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'].$linkid)."\r\n";
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivansmserr.txt',$tmpvar,'ab');
	}
	echo 'error';
	exit;
}

//��ֹ���ֻ�����
if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['denyphone']) && in_array($Usernumber, $jieqiPayset[JIEQI_PAY_TYPE]['denyphone'])){
	if($logflag){
		$tmpvar='phone number denied: Usernumber='.$Usernumber.";\r\n";
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivansmserr.txt',$tmpvar,'ab');
	}
	echo 'error';
	exit;
}

//���֧������
$paytypeid=-1;
foreach($jieqiPayset[JIEQI_PAY_TYPE]['paytype'] as $k=>$v){
	if(strtolower($v['spnumber'])==strtolower($Spnumber)){
		$paytypeid=$k;
		break;
	}
}
if($paytypeid < 0) $paytypeid=0;


//�ַ�����ÿ�μƷ����̻��ж��������ύ������URL.��Ӧ��ͬ��ҵ������  ��һ���ύ�û���������.�ڶ����ύ�Ʒ�״̬���档������Get��ʽ�ύ��
if(strtolower($Command) == 'deliver' && $linkid != ''){
	//��һ���ύ�����û���������.��ʾ�û����Ѷ����ѷ��͡�

	//���������
	$jieqiPayset[JIEQI_PAY_TYPE]['passlen']=intval($jieqiPayset[JIEQI_PAY_TYPE]['passlen']);
	if($jieqiPayset[JIEQI_PAY_TYPE]['passlen']<4 || $jieqiPayset[JIEQI_PAY_TYPE]['passlen']>32) $jieqiPayset[JIEQI_PAY_TYPE]['passlen']=8;
	$jieqiPayset[JIEQI_PAY_TYPE]['passtype']=intval($jieqiPayset[JIEQI_PAY_TYPE]['passtype']);
	if($jieqiPayset[JIEQI_PAY_TYPE]['passtype']<1 || $jieqiPayset[JIEQI_PAY_TYPE]['passtype']>3) $jieqiPayset[JIEQI_PAY_TYPE]['passtype']=3;
	$randstr=jieqi_makerand($jieqiPayset[JIEQI_PAY_TYPE]['passlen'],$jieqiPayset[JIEQI_PAY_TYPE]['passtype']);


	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$paylog= $paylog_handler->create();
	$paylog->setVar('siteid', JIEQI_SITE_ID);
	$paylog->setVar('buytime', JIEQI_NOW_TIME);
	$paylog->setVar('rettime', 0);
	$paylog->setVar('buyid', 0);
	$paylog->setVar('buyname', '');
	$paylog->setVar('buyinfo', $Usernumber);
	$paylog->setVar('moneytype', $jieqiPayset[JIEQI_PAY_TYPE]['moneytype']);
	$paylog->setVar('money', intval($jieqiPayset[JIEQI_PAY_TYPE]['paytype'][$paytypeid]['emoney']));
	$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
	$paylog->setVar('egold', intval($jieqiPayset[JIEQI_PAY_TYPE]['paytype'][$paytypeid]['egold']));
	$paylog->setVar('paytype', JIEQI_PAY_TYPE);
	$paylog->setVar('retserialno', '');
	$paylog->setVar('retaccount', $linkid);
	$paylog->setVar('retinfo', $linkid);
	$paylog->setVar('masterid', 0);
	$paylog->setVar('mastername', '');
	$paylog->setVar('masterinfo', '');
	$paylog->setVar('note', $randstr);
	$paylog->setVar('payflag', -1);
	$paylog_handler->insert($paylog);

	$serialno=$paylog->getVar('payid', 'n');
	
	$retstr=str_replace(array('<{$egold}>', '<{$serialno}>', '<{$randpass}>'), array($jieqiPayset[JIEQI_PAY_TYPE]['paytype'][$paytypeid]['egold'], $serialno, $randstr), $jieqiPayset[JIEQI_PAY_TYPE]['paytype'][$paytypeid]['message']);
	
	if($logflag){
		$tmpvar=$retstr."\r\n";
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivansmsret.txt',$tmpvar,'ab');
	}
	echo $retstr;
	exit;

}elseif(strtolower($Command) == 'report' && $linkid != '' && $report==1){
	//�ڶ����ύ��Ӫ�̷��ص�״̬����.��ʾ�û��Ƿ��ѼƷѳɹ���
	jieqi_includedb();
	$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
	$query->execute("UPDATE ".jieqi_dbprefix('pay_paylog')." SET payflag=0 WHERE retinfo='".jieqi_dbslashes($linkid)."'");

	if($logflag){
		$tmpvar="UPDATE ".jieqi_dbprefix('pay_paylog')." SET payflag=0 WHERE retinfo='".jieqi_dbslashes($linkid)."'\r\n";
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivansmsret1.txt',$tmpvar,'ab');
	}
	
}else{
	if($logflag){
		$tmpvar='command error: linkid='.$linkid.'; Command='.$Command.'; report='.$report;
		jieqi_writefile(JIEQI_ROOT_PATH.'/cache/ivansmserr.txt',$tmpvar,'ab');
	}
	echo 'error';
	exit;
}

//����������� $mode 1-���֣�2-Сд��ĸ, 3-���ֺ�Сд��ĸ
function jieqi_makerand($length = 8, $mode = 1){
	$str1 = '1234567890';
	$str2 = 'abcdefghijklmnopqrstuvwxyz';
	$str3 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$str4 = '_';
	$str5 = '`~!@#$%^&*()-+=\\|{}[];:\'",./?';
	$str = '';
	$mode = intval($mode);
	if (($mode & 1)>0) $str.=$str1;
	if (($mode & 2)>0) $str.=$str2;
	if (($mode & 4)>0) $str.=$str3;
	if (($mode & 8)>0) $str.=$str4;
	if (($mode & 16)>0) $str.=$str5;
	$result = '';
	$l = strlen($str)-1;
	srand((double) microtime() * 1000000);
	for($i = 0;$i < $length; $i++){
		$num = rand(0, $l);
		$result .= $str[$num];
	}
	return $result;
}

?>