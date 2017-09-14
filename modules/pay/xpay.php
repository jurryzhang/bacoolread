<?php 
/**
 * �׸�ͨ-�ύ����
 *
 * �׸�ͨ-�ύ���� ��http://www.xpay.cn��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: xpay.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'xpay');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
if(!jieqi_checklogin(true)) jieqi_printfail($jieqiLang['pay']['need_login']);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold']>0){
	$_REQUEST['egold']=intval($_REQUEST['egold']);
	if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'])){
		if(!empty($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']])) $money=intval($jieqiPayset[JIEQI_PAY_TYPE]['paylimit'][$_REQUEST['egold']] * 100);
		else jieqi_printfail($jieqiLang['pay']['buy_type_error']);
	}else{
		$money=intval($_REQUEST['egold']);
	}
	include_once($jieqiModules['pay']['path'].'/class/paylog.php');
	$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$paylog= $paylog_handler->create();
	$paylog->setVar('siteid', JIEQI_SITE_ID);
	$paylog->setVar('buytime', JIEQI_NOW_TIME);
	$paylog->setVar('rettime', 0);
	$paylog->setVar('buyid', $_SESSION['jieqiUserId']);
	$paylog->setVar('buyname', $_SESSION['jieqiUserName']);
	$paylog->setVar('buyinfo', '');
	$paylog->setVar('moneytype', $jieqiPayset[JIEQI_PAY_TYPE]['moneytype']);
	$paylog->setVar('money', $money);
	$paylog->setVar('egoldtype', $jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
	$paylog->setVar('egold', $_REQUEST['egold']);
	$paylog->setVar('paytype', JIEQI_PAY_TYPE);
	$paylog->setVar('retserialno', '');
	$paylog->setVar('retaccount', '');
	$paylog->setVar('retinfo', '');
	$paylog->setVar('masterid', 0);
	$paylog->setVar('mastername', '');
	$paylog->setVar('masterinfo', '');
	$paylog->setVar('note', '');
	$paylog->setVar('payflag', 0);
	if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['add_paylog_error']);
	else{	
	    $tid = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻���ţ��ĳ�XPAY���������̻��ı��
	    $key = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����
	    $pdt = $jieqiPayset[JIEQI_PAY_TYPE]['pdt'];          //��Ʒ����
	    $bid = $paylog->getVar('payid'); //�����ţ������ظ�  
	    //$prc ��������λԪ��С���������λ
		$prc=sprintf('%0.2f', $money / 100);
		//֧����ʽ��Ĭ��ʹ������
		$cardarray=array('bank','unicom',JIEQI_PAY_TYPE,'ebilling','ibank');
		if(empty($card) || !in_array($cardarray, $card)) $card='bank';
		//��ͨ��֧����ʽ������ѡ��һ�ֻ����
		$scard=$jieqiPayset[JIEQI_PAY_TYPE]['scard'];  
		//������,���ڱ�ʶ����,Ŀǰ֧��sell
        $actioncode=$jieqiPayset[JIEQI_PAY_TYPE]['actioncode'];
		//�� actioncode="sell" ,�˲���Ϊ��
		$actionParameter=$jieqiPayset[JIEQI_PAY_TYPE]['actionParameter'];
		//�汾��,��ǰϵͳ��ʹ��2.0
		$ver=$jieqiPayset[JIEQI_PAY_TYPE]['ver'];
		//��Ʒ���ͣ�����Ϊ��
		$type=$jieqiPayset[JIEQI_PAY_TYPE]['type'];
        //���ԣ�Ŀǰֻ֧��gb2312
        $lang=$jieqiPayset[JIEQI_PAY_TYPE]['lang'];
		//֧���ߣ�����Ϊ��
		$username=urlencode($_SESSION['jieqiUserName']);
		//֧���ɹ����ص�ַ,�ĳ����Լ�����վ��ַ
		$url=$jieqiPayset[JIEQI_PAY_TYPE]['payreturn'];
		//��ע��Ϣ
		$remark1=$jieqiPayset[JIEQI_PAY_TYPE]['remark1'];
		//��վ����
		$sitename=$jieqiPayset[JIEQI_PAY_TYPE]['sitename'];
		//��վ����
		$siteurl=$jieqiPayset[JIEQI_PAY_TYPE]['siteurl'];

		//mdΪ�������ݣ�����˳������ϸ񰴴�˳��
		$md=md5($key . ":" . $prc . "," . $bid . "," . $tid . "," . $card . "," . $scard . "," . $actioncode . "," . $actionParameter . "," . $ver);
        //  '����ʱ���뽫http://pay.xpay.cn/pay.aspx�ĳ�http://pay.xpay.cn/testpay.aspx
		$redirect=$jieqiPayset[JIEQI_PAY_TYPE]['payurl']."?prc=" . $prc . "&bid=" . $bid . "&tid=" . $tid . "&card=" . $card . "&scard=" . $scard . "&actioncode=" . $actioncode . "&actionparameter=" . $actionParameter . "&ver=" . $ver . "&md=" . $md . "&username=" . $username . "&pdt=" . $pdt . "&type=" . $type . "&lang=" . $lang . "&remark1=" . $remark1 . "&url=" . $url . "&sitename=" . $sitename . "&siteurl=" . $siteurl . "";
		
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
         	foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $redirect.='&'.urlencode($k).'='.urlencode($v);
         }

        header('Location: ' . $redirect);   
        exit;
	}
}else{
    jieqi_printfail($jieqiLang['pay']['need_buy_type']);	
}

?>