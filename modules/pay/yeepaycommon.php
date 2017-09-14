<?php
/**
 * �ױ�֧��-��������
 *
 * �ױ�֧��-�������� �� http://www.yeepay.com��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: yeepaycommon.php 300 2008-12-26 04:36:06Z juny $
 */

function hmac ($key, $data)
{
// RFC 2104 HMAC implementation for php.
// Creates an md5 HMAC.
// Eliminates the need to install mhash to compute a HMAC
// Hacked by Lance Rushing(NOTE: Hacked means written)

//��Ҫ���û���֧��iconv���������Ĳ���������������
if(function_exists('iconv')){
	$key = iconv("GB2312","UTF-8",$key);
	$data = iconv("GB2312","UTF-8",$data);
}else{
	include_once(JIEQI_ROOT_PATH.'/include/changecode.php');
	$key = jieqi_gb2utf8($key);
	$data = jieqi_gb2utf8($data);
}

$b = 64; // byte length for md5
if (strlen($key) > $b) {
$key = pack("H*",md5($key));
}
$key = str_pad($key, $b, chr(0x00));
$ipad = str_pad('', $b, chr(0x36));
$opad = str_pad('', $b, chr(0x5c));
$k_ipad = $key ^ $ipad ;
$k_opad = $key ^ $opad;

return md5($k_opad . pack("H*",md5($k_ipad . $data)));
}

function getReqHmacString($orderId,$amount,$cur,$productId,$productCat,$productDesc,$sMctProperties,$frpId,$needResponse)
{
//	$args = func_get_args();
//	print_r($args);
  
  global $nodeAuthorizationURL;
  global $messageType; 
  global $addressFlag;
  global $merchantId;
  global $merchantCallbackURL;
  global $keyValue;
      
//echo 	$nodeAuthorizationURL.' | '.$messageType.' | '.$addressFlag.' | '.$merchantId;
  #���м��ܴ�����һ����������˳�����
  #ȡ�ü���ǰ���ַ���
  #������Ϣ����
  $sbOld="";
  $sbOld = $sbOld.$messageType;
  #�����̼�ID
  $sbOld = $sbOld.$merchantId;
  #���붨����ID
  $sbOld = $sbOld.$orderId;     
  #������
  $sbOld = $sbOld.$amount;
  #������ҵ�λ
  $sbOld = $sbOld.$cur;
  #�����ƷID
  $sbOld = $sbOld.$productId;
  #�����Ʒ����
  $sbOld = $sbOld.$productCat;
  #�����Ʒ����
  $sbOld = $sbOld.$productDesc;
  #�����̼һر�URL
  $sbOld = $sbOld.$merchantCallbackURL;
  #�����ͻ���ַ��ʶ
  $sbOld = $sbOld.$addressFlag;
  #�����̼���չ��Ϣ
  $sbOld = $sbOld.$sMctProperties;
  #��������IDѡ��
  $sbOld = $sbOld.$frpId;
  #�����Ƿ���Ҫ�ص�����
  $sbOld = $sbOld.$needResponse;
	 	
  
  return hmac($keyValue,$sbOld);
  
  
} 

function getCallbackHmacString($sCmd,$sErrorCode,$sTrxId,$orderId,$amount,$cur,$productId,$userId,$MP,$bType){
//    echo "<hr>";
//	$args = func_get_args();
//	print_r($args);
  
    global $keyValue;
    global $merchantId;
//  echo "��Կ���̼�ID: ".$keyValue.' | '.$merchantId;
	#ȡ�ü���ǰ���ַ���
	$sbOld = "";
	#�����̼�ID
	$sbOld = $sbOld.$merchantId;
	#������Ϣ����
	$sbOld = $sbOld.$sCmd;
	#����ҵ�񷵻���
	$sbOld = $sbOld.$sErrorCode;
	#���뽻��ID
	$sbOld = $sbOld.$sTrxId;
	#���뽻�׽��
	$sbOld = $sbOld.$amount;
	#������ҵ�λ
	$sbOld = $sbOld.$cur;
	#�����ƷId
	$sbOld = $sbOld.$productId;
	#���붩��ID
	$sbOld = $sbOld.$orderId;
	#�����û�ID
	$sbOld = $sbOld.$userId;
	#�����̼���չ��Ϣ
	$sbOld = $sbOld.$MP;
	#���뽻�׽����������
	$sbOld = $sbOld.$bType;

    return hmac($keyValue,$sbOld);
	
}

#ȡ�÷��ش��е����в���
function getCallBackValue(&$sCmd,&$sErrorCode,&$sTrxId,&$amount,&$cur,&$productId,&$orderId,&$userId,&$MP,&$bType,&$svrHmac){  
	$sCmd = $_REQUEST['r0_Cmd'];
	$sErrorCode = $_REQUEST['r1_Code'];
	$sTrxId = $_REQUEST['r2_TrxId'];
	$amount = $_REQUEST['r3_Amt'];
	$cur = $_REQUEST['r4_Cur'];
	$productId = $_REQUEST['r5_Pid'];
	$orderId = $_REQUEST['r6_Order'];
	$userId = $_REQUEST['r7_Uid'];
	$MP = $_REQUEST['r8_MP'];
	$bType = $_REQUEST['r9_BType']; 
	$svrHmac = $_REQUEST['hmac'];
	return NULL;
}

function CheckHmac($sCmd,$sErrorCode,$sTrxId,$orderId,$amount,$cur,$productId,$userId,$MP,$bType,$svrHmac){
//    $args = func_get_args();
//	print_r($args);
//echo "<br>";
//echo $svrHmac."<br>";
//echo getCallbackHmacString($sCmd,$sErrorCode,$sTrxId,$orderId,$amount,$cur,$productId,$userId,$MP,$bType);
	if($svrHmac==getCallbackHmacString($sCmd,$sErrorCode,$sTrxId,$orderId,$amount,$cur,$productId,$userId,$MP,$bType))
		return true;
	else
		return false;
}

?> 