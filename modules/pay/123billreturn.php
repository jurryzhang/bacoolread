<?php 
/**
 * �׳�֧��-���ش���
 *
 * �׳�֧��-���ش��� (http://www.123bill.cn)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: 123billreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', '123bill');
require_once('../../global.php');

require_once("123bill/keyfile.php");
require_once("123bill/sign.php");

jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$myunitid=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
//$key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ

//1-----------���ջص���Ϣ--------------------------------------------------------------------
$unitid = trim($_REQUEST['unitid']);	//�̻����
$paycode = trim($_REQUEST['paycode']);	//֧�������0-δ֧����1-��֧����2-���� 3-֧��ƽ̨�ܾ���

$mesg = trim($_REQUEST['mesg']);		//��ʾ��֧�����������Ϣ
$transid = trim($_REQUEST['transid']);	//������ˮ�ţ�������վ���ɣ���վ��Ψһ��
$signData = trim($_REQUEST['sign']);	//֧��ƽ̨��ǩ��
$retcode = trim($_REQUEST['retcode']); 
/*
retcode       ��0 ���ɹ����޴���
			  ��1���������ȱ�ٹؼ��ֶ�
			  ��2���������ݲ��Ϸ�
			  ��3������ǩ��ʧ�ܣ��̼�unitidʧЧ���ڡ������֧��ƽ̨��ϵ��������
			  ��4���Ƿ�ǩ�����ݡ���֤ʧ�ܣ���Ч���
			  ��5����������֤ǩ���쳣
			  ��7��֧����ˮ�Ų���ʧ�ܣ��п����ǽ��ױ����ظ��ύ��
			  ��6������֧��ʧ�ܡ�
			  ��8��֧����ʧЧ
			  ��9��֧��������С��0.01Ԫ
			  ��10���������쳣������ҳ��ʧ�ܡ�
			  ��11��Ŀǰ�ͻ����ڵ���û�п�֧ͨ������
			  ��12���Ѿ�֧����
			  ��13���Ѿ�������
			  ��14�����׼�¼������
          	  ��15������ʧ��
			  ��16�����󱻾ܾ�
			  ��17����ԿΪ����
			  ��255��δ���������ο�Mesg���ݡ�

֧��ƽ̨�����Ѿ�֧����retcode=12������֧������ɹ���paycode=1 ��retcode=0����ֻ��ʾ֧��ƽ̨����ö���������֧��״̬
*/

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------

if($unitid != $myunitid) jieqi_printfail($jieqiLang['pay']['customer_id_error']);
if($retcode == 12 || ($paycode == 1 && $retcode == 0)){
	$query_string = $_SERVER['QUERY_STRING'];
	$pos = strpos($query_string, "&sign=");
	if ($pos == false) jieqi_printfail($jieqiLang['pay']['return_checkcode_error']);
	else $param = substr($query_string, 0, $pos);


	$filename = JIEQI_ROOT_PATH.'/configs/pay/'.$jieqiPayset[JIEQI_PAY_TYPE]['pubkeyfile'];
	$xmlKey = new KeyFile($filename);
	$xmlKey->getPublicKey($modulus, $exp);
	$sign = new Sign();
	$sign->setPublicKeyFromXML($exp, $modulus);
	if (!$sign->VerifySign($param, $signData)) jieqi_printfail($jieqiLang['pay']['return_checkcode_error']);
	else{
		include_once($jieqiModules['pay']['path'].'/class/paylog.php');
		$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
		$orderid=intval($transid);
		$paylog=$paylog_handler->get($orderid);
		if(is_object($paylog)){
			$buyname=$paylog->getVar('buyname');
			$buyid=$paylog->getVar('buyid');
			$payflag=$paylog->getVar('payflag');
			$egold=$paylog->getVar('egold');
			if($payflag == 0){
				include_once(JIEQI_ROOT_PATH.'/class/users.php');
				$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
				$ret=$users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold]);
				if($ret) $note=sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
				else $note=sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
				$paylog->setVar('rettime', JIEQI_NOW_TIME);
				$paylog->setVar('money', intval($amount * 100));
				$paylog->setVar('note', $note);
				$paylog->setVar('payflag', 1);
				if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
				else jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
			}else{
				jieqi_printfail($jieqiLang['pay']['already_add_egold']);
			}
		}else{
			jieqi_printfail($jieqiLang['pay']['no_buy_record']);
		}
	}
}else{
	jieqi_printfail($jieqiLang['pay']['pay_return_error'].'<br />'.$mesg);
}
?>