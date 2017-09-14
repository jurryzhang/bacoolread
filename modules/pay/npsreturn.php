<?php 
/**
 * nps֧��-���ش���
 *
 * nps֧��-���ش��� (http://www.nps.cn)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: npsreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'nps');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_loadlang('nps', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');
$v_mid = $jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻���ţ��ĳ�IPAY���������̻��ı��
$key = $jieqiPayset[JIEQI_PAY_TYPE]['paykey'];  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

//1-----------���շ��ص���Ϣ--------------------------------------------------------------------
$m_id		= 	$_POST['m_id'];					//�̼Һ�
$m_orderid	= 	$_POST['m_orderid'];			//�̼Ҷ�����
$m_oamount	= 	$_POST['m_oamount'];			//֧�����
$m_ocurrency= 	$_POST['m_ocurrency'];			//����
$m_language	= 	$_POST['m_language'];			//����ѡ��
$s_name		= 	$_POST['s_name'];				//����������
$s_addr		= 	$_POST['s_addr'];				//������סַ
$s_postcode	= 	$_POST['s_postcode'];			//��������
$s_tel		= 	$_POST['s_tel'];				//��������ϵ�绰
$s_eml		= 	$_POST['s_eml'];				//�������ʼ���ַ
$s_name		= 	$_POST['r_name'];				//����������
$r_addr		= 	$_POST['r_addr'];				//�ջ���סַ
$r_postcode	= 	$_POST['r_postcode'];			//�ջ�����������
$r_tel		= 	$_POST['r_tel'];				//�ջ�����ϵ�绰
$r_eml		= 	$_POST['r_eml'];				//�ջ��˵��ӵ�ַ
$m_ocomment	= 	$_POST['m_ocomment'];			//��ע
$State		=	$_POST['m_status'];				//֧��״̬2�ɹ�,3ʧ��
$modate		=	$_POST['modate'];				//��������
//��������ļ���
$OrderInfo	=	$_POST['OrderMessage'];			//����������Ϣ
$signMsg 	=	$_POST['Digest'];				//�ܳ�
//�����µ�md5������֤
$newmd5info	=	$_POST['newmd5info'];



//2-----------���¼���md5��ֵ---------------------------------------------------------------------------
//���ǩ��
$digest = strtoupper(md5($OrderInfo.$key));

//�µ�����md5����
$newtext = $m_id.$m_orderid.$m_oamount.$key.$State;
$newMd5digest = strtoupper(md5($newtext));

//3-----------�жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���----------------------------
if ($digest == $signMsg){
	$OrderInfo = HexToStr($OrderInfo);
	if ($newmd5info == $newMd5digest){
		if ($State == 2){
			include_once($jieqiModules['pay']['path'].'/class/paylog.php');
			$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
			$m_orderid=intval($m_orderid);
			$paylog=$paylog_handler->get($m_orderid);
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
					$paylog->setVar('money', intval($m_oamount * 100));
					$paylog->setVar('note', $note);
					$paylog->setVar('payflag', 1);
					if(!$paylog_handler->insert($paylog)) jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
					else jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
				}else{
					jieqi_printfail($jieqiLang['pay']['already_add_egold']);
				}
			}else jieqi_printfail($jieqiLang['pay']['no_buy_record']);
		}else{
			jieqi_printfail($jieqiLang['pay']['return_state_failure']);
		}
	}else{
		jieqi_printfail($jieqiLang['pay']['key_check_failure']);
	}
}else{
	jieqi_printfail($jieqiLang['pay']['sign_check_failure']);
}

// ������������
function StrToHex($string)
{
	$hex="";
	for ($i=0;$i<strlen($string);$i++)
	$hex.=dechex(ord($string[$i]));
	$hex=strtoupper($hex);
	return $hex;
}
?>