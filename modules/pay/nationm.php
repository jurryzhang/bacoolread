<?php 
/**
 * ����֧��-�ύ����
 *
 * ����֧��-�ύ���� (http://www.nationm.com.cn)
 * 
 * ����ģ�壺/modules/pay/templates/nationm.html
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: nationm.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'nationm');
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
		$merchantID=$jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�̻���
		$interfaceType='NSTP'; //�ӿ�����,������NSTP
		$orderID=intval($paylog->getVar('payid')); //������
		$merchantURL=$jieqiPayset[JIEQI_PAY_TYPE]['payreturn']; //����������֧ͨ�������Ϣ�ĳ������ƺ͵�ַ
		$submitSURL=$jieqiModules['pay']['url'].'/nationmsuc.php';  //������ͨ�ɹ��ύ֧����Ҫ��ת�ĳ������ƺ͵�ַ
		$submitFURL=$jieqiModules['pay']['url'].'/nationmerr.php';  //������ͨ�ύ֧��ʧ�ܺ�Ҫ��ת�ĳ������ƺ͵�ַ
		$goodsID=$jieqiPayset[JIEQI_PAY_TYPE]['goodsid'];  //��Ʒ����
		$countNumber=$jieqiPayset[JIEQI_PAY_TYPE]['countNumber'];  //��Ʒ����
		$amount=intval($money);  //�����ܽ���λ��
		$currentType=$jieqiPayset[JIEQI_PAY_TYPE]['currentType'];  //���� 000:�����010:��Ԫ020:�۱�
		$noticeType=$jieqiPayset[JIEQI_PAY_TYPE]['noticeType']; //��Ϣ��������
		$key=$jieqiPayset[JIEQI_PAY_TYPE]['sendkey'];  //�ύʱ�����Կ
		$md5Info=strtoupper(md5($merchantID.$interfaceType.$orderID.$goodsID.$countNumber.$amount.$key));

		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', sprintf('%0.2f', $amount / 100));
		
		$jieqiTpl->assign('merchantID', $merchantID);
		$jieqiTpl->assign('interfaceType', $interfaceType);
		$jieqiTpl->assign('orderID', $orderID);
		$jieqiTpl->assign('merchantURL', $merchantURL);
		$jieqiTpl->assign('submitSURL', $submitSURL);
		$jieqiTpl->assign('submitFURL', $submitFURL);
		$jieqiTpl->assign('goodsID', $goodsID);
		$jieqiTpl->assign('countNumber', $countNumber);
		$jieqiTpl->assign('amount', $amount);
		$jieqiTpl->assign('currentType', $currentType);
		$jieqiTpl->assign('noticeType', $noticeType);
		$jieqiTpl->assign('md5Info', $md5Info);
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
         	foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/nationm.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>