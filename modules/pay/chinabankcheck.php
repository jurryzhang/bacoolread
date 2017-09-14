<?php 
/**
 * ��������-����У��
 *
 * ��������-����У�� (http://www.chinabank.com.cn)
 * 
 * ����ģ�壺/modules/pay/templates/chinabank.html
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: chinabankcheck.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'chinabank');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');
$v_mid = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻���ţ��ĳ�IPAY���������̻��ı��
$key = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

$v_oid        = trim($_POST['v_oid']); //�̻����͵�v_oid�������     
$v_pmode      = trim($_POST['v_pmode']);  //֧�����У����繤������    
$v_pstatus    = trim($_POST['v_pstatus']);  //20����ʾ֧���ɹ���30����ʾ֧��ʧ�ܣ�    
$v_pstring    = trim($_POST['v_pstring']);  //֧���ɹ� ֧��ʧ��    
$v_amount     = trim($_POST['v_amount']); //����ʵ��֧�����    
$v_moneytype  = trim($_POST['v_moneytype']); //����ʵ��֧������    
$remark1      = trim($_POST['remark1' ]);     
$remark2      = trim($_POST['remark2' ]);     
$v_md5str     = trim($_POST['v_md5str' ]);      

$money=intval($v_amount * 100);

//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));

if ($v_md5str==$md5string)
{
	//�̻�ϵͳ���߼����������жϽ��ж�֧��״̬�����¶���״̬�ȵȣ�......
	echo "ok";
}else{
	echo "error";
}
?>