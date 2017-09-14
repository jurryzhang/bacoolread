<?php 
/**
 * ��������-���ش���
 *
 * ��������-���ش���
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: tomorrowreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'tomorrow');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$logflag = 0; //�Ƿ��¼��־

//��SP������û���
$USER=$jieqiPayset[JIEQI_PAY_TYPE]['TOUSER'];
//��SP���������
$PASS=$jieqiPayset[JIEQI_PAY_TYPE]['TOPASS'];
//�������ID
$MOUSEID=$jieqiPayset[JIEQI_PAY_TYPE]['MOUSEID'];
//���ʳ�Ա��ID��������ID
$MOUSEPACKAGEID=$jieqiPayset[JIEQI_PAY_TYPE]['MOUSEPACKAGEID'];
//�Ƿ����
$ISIMBALANCE=$jieqiPayset[JIEQI_PAY_TYPE]['ISIMBALANCE'];
//��ʱ�·�ʱ��
$ATTIME=$jieqiPayset[JIEQI_PAY_TYPE]['ATTIME'];
//MT����
$MTTYPE=$jieqiPayset[JIEQI_PAY_TYPE]['MTTYPE'];
//��Ϣ��ʽ 0��ASCII 3��д������ 4�������� 8��UCS2 15��GB�뺺��
$MSGFORMAT=$jieqiPayset[JIEQI_PAY_TYPE]['MSGFORMAT'];
//��ע
$REMARK=$jieqiPayset[JIEQI_PAY_TYPE]['REMARK'];


//**********************************************************

$xml=urldecode($HTTP_RAW_POST_DATA);

if($logflag) jieqi_writefile(JIEQI_ROOT_PATH.'/cache/tomorrowrecv.txt',$xml,'ab');

//���ش���MO�ĳ�������URL
$CLASSID=xml_getvaluebytag($xml, 'CLASSID');
if(empty($CLASSID)) $CLASSID=$jieqiPayset[JIEQI_PAY_TYPE]['payreturn'];
//MOID���linkid
$MOID=xml_getvaluebytag($xml, 'MOID');
//�ֻ�����
$SRCTERMID=xml_getvaluebytag($xml, 'SRCTERMID');
//LINKID
$LINKID=xml_getvaluebytag($xml, 'LINKID');
//��Ϣ����
$MSGCONTENT=xml_getvaluebytag($xml, 'MSGCONTENT');
//Ŀ�ĺ���(�ص��ط��ź�ĺ���)
$DESTTERMID=xml_getvaluebytag($xml, 'DESTTERMID');
//�ظ�ʱ����Ҫ�Ĳ���
//$FROMUSER=xml_getvaluebytag($xml, 'USER');
//$FROMPASS=xml_getvaluebytag($xml, 'PASS');
$CITYID=xml_getvaluebytag($xml, 'CITYID');
$PROVINCEID=xml_getvaluebytag($xml, 'PROVINCEID');
$GATEWAYID=xml_getvaluebytag($xml, 'GATEWAYID');
$SPNUMBER=xml_getvaluebytag($xml, 'SPNUMBER');

$SERVICEID=xml_getvaluebytag($xml, 'SERVICEID'); //����ID

//**********************************************************
//����ǲ��ǽ�ֹ���ֻ�����
if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['denyphone']) && in_array($SRCTERMID, $jieqiPayset[JIEQI_PAY_TYPE]['denyphone'])){
	if($logflag) jieqi_writefile(JIEQI_ROOT_PATH.'/cache/tomorrowbad.txt',$SRCTERMID."\r\n",'ab');
	echo '<RES_MO><ERR_CODE>-1</ERR_CODE></RES_MO>';
	exit;
}

$retcode=0;
$returl='';
$retdata='<RES_MO><ERR_CODE>'.$retcode.'</ERR_CODE></RES_MO>';
echo $retdata;
//***********************************************************
//���֧������
$check_paytype=false;
foreach($jieqiPayset[JIEQI_PAY_TYPE]['paytype'] as $v){
	if($v['serviceid']==$SERVICEID){
		$SMTYPEID=$v['smtypeid'];
		$check_paytype=true;
		$money=$v['money'];
		$egold=$v['egold'];
		$startmsg=$v['startmsg'];
		$message=$v['message'];
		break;
	}
}
//û�ҵ�֧������
if(!$check_paytype){
	$tmpvar='NO SERVICEID='.$SERVICEID;
	if($logflag) jieqi_writefile(JIEQI_ROOT_PATH.'/cache/tomorrowerr.txt',$tmpvar,'ab');
	exit;
}
//������Ϣ
$startmsg=strtolower($startmsg);
$MSGCONTENT=strtolower(base64_decode(trim($MSGCONTENT)));
$flaglen=strlen($startmsg);
if(substr($MSGCONTENT, 0, $flaglen) != $startmsg){
	//��Ϣ��ʽ����(��ʼ��־����)
	if($logflag) jieqi_writefile(JIEQI_ROOT_PATH.'/cache/tomorrowerr.txt',$MSGCONTENT,'ab');
	exit;
}

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
$paylog->setVar('buyinfo', $SRCTERMID);
$paylog->setVar('moneytype', $jieqiPayset[JIEQI_PAY_TYPE]['moneytype']);
$paylog->setVar('money', $money);
$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
$paylog->setVar('egold', $egold);
$paylog->setVar('paytype', JIEQI_PAY_TYPE);
$paylog->setVar('retserialno', '');
$paylog->setVar('retaccount', '');
$paylog->setVar('retinfo', '');
$paylog->setVar('masterid', 0);
$paylog->setVar('mastername', '');
$paylog->setVar('masterinfo', '');
$paylog->setVar('note', $randstr);
$paylog->setVar('payflag', 0);
$paylog_handler->insert($paylog);

$serialno=$paylog->getVar('payid', 'n');

//��������
$MSGCONTENT=str_replace(array('<{$egold}>', '<{$serialno}>', '<{$randpass}>'), array($egold, $serialno, $randstr), $message);
$MSGCONTENT=base64_encode($MSGCONTENT);
$MSGLEN=strlen($MSGCONTENT);
//�Ѿ���¼���ף�������Ϣ
$nowtime=date('YmdHi',time());
$SENDTIME=$nowtime;

$DESTTERMID=$SRCTERMID;
$FEETERMID=$SRCTERMID;
$SRCTERMID=$SRCTERMID;

$returl=$jieqiPayset[JIEQI_PAY_TYPE]['payurl'];
$retdata='<?xml version="1.0" encoding="utf-8"?><ROOT><USER>'.$USER.'</USER><PASS>'.$PASS.'</PASS><MT><MOID>'.$MOID.'</MOID><MSGCONTENT>'.$MSGCONTENT.'</MSGCONTENT><MSGLEN>'.$MSGLEN.'</MSGLEN><SRCTERMID>'.$SRCTERMID.'</SRCTERMID><DESTTERMID>'.$DESTTERMID.'</DESTTERMID><SERVICEID>'.$SERVICEID.'</SERVICEID><FEETERMID>'.$FEETERMID.'</FEETERMID><MSGFORMAT>'.$MSGFORMAT.'</MSGFORMAT><MOUSEID>'.$MOUSEID.'</MOUSEID><MOUSEPACKAGEID>'.$MOUSEPACKAGEID.'</MOUSEPACKAGEID><CITYID>'.$CITYID.'</CITYID><PROVINCEID>'.$PROVINCEID.'</PROVINCEID><GATEWAYID>'.$GATEWAYID.'</GATEWAYID><CLASSID>'.$CLASSID.'</CLASSID><SMTYPEID>'.$SMTYPEID.'</SMTYPEID><ISIMBALANCE>'.$ISIMBALANCE.'</ISIMBALANCE><ATTIME>'.$ATTIME.'</ATTIME><SENDTIME>'.$SENDTIME.'</SENDTIME><MTTYPE>'.$MTTYPE.'</MTTYPE><SPNUMBER>'.$SPNUMBER.'</SPNUMBER><LINKID>'.$LINKID.'</LINKID><REMARK>'.$REMARK.'</REMARK></MT></ROOT>';

if($logflag) jieqi_writefile(JIEQI_ROOT_PATH.'/cache/tomorrowsend.txt',$retdata,'ab');

include_once(JIEQI_ROOT_PATH.'/include/changecode.php');
$retdata=jieqi_gb2utf8($retdata);
$ret=posttohost($returl, $retdata);

if($logflag) jieqi_writefile(JIEQI_ROOT_PATH.'/cache/tomorrowret.txt',$ret,'ab');

function xml_getvaluebytag($source='', $tag=''){
	$ret='';
	if(!empty($tag)){
		$pregstr='/'.jieqi_pregconvert('<'.$tag.'>').'([^\<\>]*)'.jieqi_pregconvert('</'.$tag.'>').'/is';
		$matches=array();
		preg_match($pregstr, $source, $matches);
		if(is_array($matches) && count($matches)>0){
			$ret=$matches[count($matches)-1];
		}
	}
	return $ret;
}

//��ͨ�ַ���ת��Ϊpreg�Ĳ���
function jieqi_pregconvert($str){
	$from=array(' ', '/');
	$to=array('\s', '\/');
	$str=preg_quote($str);
	$str=str_replace($from, $to, $str);
	return $str;
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

//post����
function posttohost($url, $data) {
	$url = parse_url($url);
	if (!$url) return "couldn't parse url";
	if (!isset($url['port'])) $url['port'] = "";
	if (!isset($url['query'])) $url['query'] = "";

	$encoded = "";
	$encoded = rawurlencode($data);

	/*
	while (list($k,$v) = each($data)) {
	$encoded .= ($encoded ? "&" : "");
	$encoded .= rawurlencode($k)."=".rawurlencode($v);
	}
	*/

	$fp = fsockopen($url['host'], $url['port'] ? $url['port'] : 80);
	if (!$fp) return "Failed to open socket to $url[host]";

	$post_data = sprintf("POST %s%s%s HTTP/1.1\n", $url['path'], $url['query'] ? "?" : "", $url['query']);
	$post_data .= "Host: $url[host]\n";
	$post_data .= "Content-type: application/x-www-form-urlencoded\n";
	$post_data .= "Connection: close\n";
	$post_data .= "Cache-Control: no-cache\n";
	$post_data .= "Content-length: " . strlen($encoded) . "\n\n";

	$post_data .= "$encoded\n";
	fwrite($fp, $post_data);

	$header = "";
	while($line = trim(fgets($fp))) {
		$header .= $line;
	}
	//IIS �����ȷ��� 100,����ȡ����ȡ������
	if(preg_match("#^HTTP/1\.1 100 Continue#i",$header)) {
		$header = "";
		while($line = trim(fgets($fp))) {
			$header .= $line;
		}
	}
	if (!preg_match("#^HTTP/1\.. 200#i", $header)){
		fclose($fp);
		return FALSE;
	}

	$dataPos = strpos($header, "Content-Length: ") + 16;
	$dataLength = substr($header, $dataPos, strlen($header) - $dataPos);
	$results = "";
	$curLength = 0;
	$leftLength = $dataLength;
	while($leftLength > 0) {
		if($leftLength > 1024) {
			$read = fread($fp, 1024);
		} else {
			$read = fread($fp, $leftLength);
		}
		if(strlen($read) < 1024) {
			$read = trim($read);
		}
		if(strlen($read) == 0) {
			break;
		}
		$curLength += strlen($read);
		$leftLength = $dataLength - $curLength;
		$results .= $read;
	}
	fclose($fp);

	if(strlen($results) != $dataLength || $dataLength <= 0) {
		return FALSE;
	}
	return $results;
}
?>