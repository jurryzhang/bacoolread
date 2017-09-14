<?php 
/**
 * ��������116�绰֧��-�ύ����
 *
 * ��������116�绰֧��-�ύ���� (http://www.116.com.cn)
 * 
 * ����ģ�壺/modules/pay/templates/9zfee.html
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 9zfee.php 326 2009-02-04 00:26:22Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', '9zfee');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_loadlang('9zfee', JIEQI_MODULE_NAME);
if(!jieqi_checklogin(true)) jieqi_printfail($jieqiLang['pay']['need_login']);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

//���շ���
if(isset($_REQUEST['retcode']) && !empty($_REQUEST['sessionid'])){
	switch($_REQUEST['retcode']){
		case '0':
			msg_box(LANG_DO_SUCCESS, sprintf($jieqiLang['pay']['order_submit_success'], $_REQUEST['sessionid'], $jieqiPayset[JIEQI_PAY_TYPE]['phone']));
			exit;
			break;
		case '1':
			print_fail($jieqiLang['pay']['error_rand']);
			break;
		case '2':
			print_fail($jieqiLang['pay']['error_ip']);
			break;
		case '3':
			print_fail($jieqiLang['pay']['error_para_format']);
			break;
		case '4':
			print_fail($jieqiLang['pay']['error_para_num']);
			break;
		case '5':
			print_fail($jieqiLang['pay']['error_md5']);
			break;
		case '6':
			print_fail($jieqiLang['pay']['error_serial_id']);
			break;
		default:
			print_fail($jieqiLang['pay']['error_unknow']);
	}
	exit;
}

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
		$key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ
		$cp_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //CP���
		$prod_id=$jieqiPayset[JIEQI_PAY_TYPE]['prodid'];  //��Ʒ���
		$rand_id=sprintf("%06d", $paylog->getVar('payid')); //����� ���֣��ܳ����32���ַ���Ϊ������������ȥ��cp_id��PRICE������
		//���飺��ȷ����Ч���ڲ��ظ���ǰ���£����ֶ�λ��Ӧ�����٣��Ա��û��绰�������롣
		$pay_id=$jieqiPayset[JIEQI_PAY_TYPE]['pay_id']; //֧����ʽ��  ���֣�ֵΪ1���ܳ�1���ַ���
		$valid_time=$jieqiPayset[JIEQI_PAY_TYPE]['valid_time']; //������Ч�� ���֣��ܳ����5λ��(��λΪСʱ)��������Ч�ڣ����ڶ������ϣ�����֧������Ϊ-1, ���ʾΪ���ö������������ṩ���ÿ��ŵ�cp�����翨����cp�û�һһ��Ӧ��,Ϊ-3,���ʾΪ���¶���,- 4Ϊ����������-5 Ϊ���궩����
		$money_type=$jieqiPayset[JIEQI_PAY_TYPE]['moneytype']; //֧������ ���֣�ֵΪ0���ܳ�1���ַ���
		$price=$money; //֧���ܶ� ֵΪ�����ͣ��ܳ����7λ����λΪ�֡�
		$md5=strtoupper(md5($cp_id.$prod_id.$rand_id.$pay_id.$valid_time.$money_type.$price.$key)); //MD5�� ��cp_id, prod_id, rand_id, pay_id, valid_time, money_type, price��˳�򣬽���7��������valueֵƴ��һ���޼�����ַ��������þ��������ṩ���ܳ׽��˴����ܣ��õ��Ľ����Ϊmd5�롣
		$sessionid=$cp_id.substr(sprintf("%02d", intval($price / 100)), -2).$rand_id; //�����û���¼�����֧����CP���˲���Ϊ�û��ôε�¼��Ӧ��session id�����ڲ���Ҫ�û���¼����֧����CP���˲������ش���

		include_once(JIEQI_ROOT_PATH.'/header.php');
		include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
		$jieqiTpl =& JieqiTpl::getInstance();
		$jieqiTpl->assign('url_pay', $jieqiPayset[JIEQI_PAY_TYPE]['payurl']);
		$jieqiTpl->assign('buyname', $_SESSION['jieqiUserName']);
		$jieqiTpl->assign('egold', $_REQUEST['egold']);
		$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
		$jieqiTpl->assign('money', sprintf('%0.2f', $money / 100));

		$jieqiTpl->assign('cp_id', $cp_id);
		$jieqiTpl->assign('prod_id', $prod_id);
		$jieqiTpl->assign('rand_id', $rand_id);
		$jieqiTpl->assign('pay_id', $pay_id);
		$jieqiTpl->assign('valid_time', $valid_time);
		$jieqiTpl->assign('money_type', $money_type);
		$jieqiTpl->assign('price', $price);
		$jieqiTpl->assign('md5', $md5);
		$jieqiTpl->assign('sessionid', $sessionid);
		if(is_array($jieqiPayset[JIEQI_PAY_TYPE]['addvars'])){
         	foreach($jieqiPayset[JIEQI_PAY_TYPE]['addvars'] as $k=>$v) $jieqiTpl->assign($k, $v);
		}
		$jieqiTpl->setCaching(0);
		$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'].'/templates/9zfee.html';
		include_once(JIEQI_ROOT_PATH.'/footer.php');
	}
}else{
	jieqi_printfail($jieqiLang['pay']['need_buy_type']);
}

?>