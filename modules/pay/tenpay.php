<?php 
/**
 * ��Ѷ�Ƹ�ͨ-�ύ����
 *
 * ��Ѷ�Ƹ�ͨ-�ύ���� (https://www.tenpay.com)
 * 
 * ����ģ�壺/modules/pay/templates/tenpay.html
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: tenpay.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'tenpay');
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
		$amount=$money / 100;
		
		$cmdno=$jieqiPayset[JIEQI_PAY_TYPE]['cmdno'];  //ҵ�����, �Ƹ�֧ͨ��֧���ӿ���  1 
		$date=date('Ymd');
		$bank_type=$jieqiPayset[JIEQI_PAY_TYPE]['bank_type']; //��������:�Ƹ�֧ͨ����0
		$desc=JIEQI_EGOLD_NAME; //��Ʒ����
		$purchaser_id='';  //�û�(��)�ĲƸ�ͨ�ʻ�,����Ϊ��
		if(!empty($_REQUEST['purchaser_id'])) $purchaser_id=$_REQUEST['purchaser_id'];
		$bargainor_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
		$sp_billno=$paylog->getVar('payid'); //�̼ҵĶ�����
		$transaction_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid'].$date.sprintf('%010d', $sp_billno);
		//���׺�(������)�����̻���վ����(����˳���ۼ�)��һ�������Ӧ��Ľ��׺ű�����ͬ����transaction_id Ϊ28λ������ֵ������ǰ10λΪ�̻���վ���(SPID)���ɲƸ�ͨͳһ���䣻֮��8λΪ�������������ڣ���20050415�����10λ�̻���Ҫ��֤һ���ڲ�ͬ�������û�����һ����Ʒ����һ�η��񣩣���ID����ͬ
		$total_fee=$money; //�ܽ���λΪ��
		$fee_type=$jieqiPayset[JIEQI_PAY_TYPE]['fee_type']; //�ֽ�֧�����֣�Ŀǰֻ֧������ң�1 - RMB�����, 2 - USD��Ԫ, 3 - HKD�۱�
		$return_url=$jieqiPayset[JIEQI_PAY_TYPE]['payreturn']; //���ղƸ�ͨ���ؽ����URL(�Ƽ�ʹ��ip)
		$attach=$jieqiPayset[JIEQI_PAY_TYPE]['attach']; //�̼����ݰ���ԭ������
		$text="cmdno=".$cmdno."&date=".$date."&bargainor_id=".$bargainor_id."&transaction_id=".$transaction_id."&sp_billno=".$sp_billno."&total_fee=".$total_fee."&fee_type=".$fee_type."&return_url=".$return_url."&attach=".$attach."&key=".$jieqiPayset[JIEQI_PAY_TYPE]['paykey'];
		$sign=strtoupper(md5($text));
		
		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', sprintf('%0.2f', $money / 100));

		$jieqiTpl->assign('cmdno', $cmdno);
		$jieqiTpl->assign('date', $date);
		$jieqiTpl->assign('bank_type', $bank_type);
		$jieqiTpl->assign('desc', $desc);
		$jieqiTpl->assign('purchaser_id', $purchaser_id);
		$jieqiTpl->assign('bargainor_id', $bargainor_id);
		$jieqiTpl->assign('sp_billno', $sp_billno);
		$jieqiTpl->assign('transaction_id', $transaction_id);
		$jieqiTpl->assign('total_fee', $total_fee);
		$jieqiTpl->assign('fee_type', $fee_type);
		$jieqiTpl->assign('return_url', $return_url);
		$jieqiTpl->assign('attach', $attach);
		$jieqiTpl->assign('sign', $sign);
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
         	foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/tenpay.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>