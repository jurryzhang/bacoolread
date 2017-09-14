<?php 
/**
 * QQ֧��-�ύ����
 *
 * QQ֧��-�ύ���� (http://www.qq.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: qq.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'qq');
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
		$cpid = $jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�����̱�ʶ
		$service_id = $jieqiPayset[JIEQI_PAY_TYPE]['service_id']; //ҵ�����
		$user_id = $jieqiPayset[JIEQI_PAY_TYPE]['user_id']; //ҵ����غ��루��ѡ������
		$user_type = $jieqiPayset[JIEQI_PAY_TYPE]['user_type']; //ҵ����غ�������ͣ�1��qq����2���Ƹ�ͨ�ʺ�100��cp�Լ��ĺ���
		$pay_type = $jieqiPayset[JIEQI_PAY_TYPE]['pay_type'];  //֧���������ͣ��û���CP����վ��ѡ��1��q��֧��2���Ƹ�֧ͨ��
		$fee = $money; //������service_idΪ���Ȩҵ�����ʱ��CP��������Fee��Ч
		$source = $jieqiPayset[JIEQI_PAY_TYPE]['source']; //������Դ1��cp��վ2���Ƹ��ռ�portal
		$from = $jieqiPayset[JIEQI_PAY_TYPE]['from']; //�ⲿ������Դ������ͳ���ƹ���վ�ԲƸ��ռ���ƹ����ã�
		$time = time(); //CP���ɵ�һ����ǰʱ�����unix timestamp��
		$ret_url = $jieqiPayset[JIEQI_PAY_TYPE]['payreturn']; //�����ɹ�ʱ��������url
		$ret_para = $paylog->getVar('payid'); //�ص�CP��Urlʱ�����ں���Ĳ�������ѡ������
		$key = ''; //����������rsaǩ��

		$post_url = $jieqiPayset[JIEQI_PAY_TYPE]['payurl'];   //�ύ��URL
		$cmd_line=$jieqiPayset[JIEQI_PAY_TYPE]['cmd_line'];  //������֤�����·��

		$post_para='cpid='.$cpid.'&service_id='.$service_id.'&user_id='.$user_id.'&user_type='.$user_type.'&pay_type='.$pay_type.'&fee='.$fee.'&source='.$source.'&from='.$from.'&time='.$time.'&ret_url='.$ret_url.'&ret_para='.$ret_para;

		$cmd =  $cmd_line. ' s "' . $post_para .'"';

		$fp = popen($cmd, "r");
		$sign='';
		while(!feof($fp)){
			$sign .= fgets($fp,1024);
		}
		pclose($fp);
		$sign=trim($sign);

		$post_url.='?'.$post_para.'&key='.$sign;
		
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
			foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $post_url.='&'.urlencode($k).'='.urlencode($v);
		}

		header('Location: '.$post_url);
		exit;
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>