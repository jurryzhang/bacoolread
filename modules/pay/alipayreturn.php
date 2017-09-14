<?php
/**
 * ֧����-���ش���
 *
 * ֧����-���ش��� (http://www.alipay.com)
 *
 * ����ģ�壺��
 *
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: alipayreturn.php 234 2008-11-28 01:53:06Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'alipay');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

$mymerchant_id=$jieqiPayset[JIEQI_PAY_TYPE]['payid']; //�̻����
$key=$jieqiPayset[JIEQI_PAY_TYPE]['paykey']; //��Կ

$logflag = 0; //�Ƿ��¼��־
if($logflag)
{
	ob_start();
	print_r($_REQUEST);
	$log = ob_get_contents();
	ob_end_clean();
	jieqi_writefile(JIEQI_ROOT_PATH.'/cache/alipayrecv.txt',$log,'ab');
}

if(!empty($_GET['notify_id']) && !empty($_GET['buyer_email']) && !empty($_GET['out_trade_no']))
{
	//ֱ�ӷ���ģʽ
	$getvars  = $_GET;
	$showmode = 1;
}
elseif(!empty($_POST['notify_id']) && !empty($_POST['buyer_email']) && !empty($_POST['out_trade_no']))
{
	//�첽����ģʽ
	$getvars  = $_POST;
	$showmode = 0;
	echo 'success';
}
else
{
	echo 'fail';
	exit;
}

//��齻��״̬(�ǲ��Ǹ���ɹ�)
if(strtoupper($getvars['trade_status']) != 'TRADE_SUCCESS')
{
	if($showmode)
	{
		jieqi_printfail($jieqiLang['pay']['pay_return_error'].'<br /><br />RETCODE:'.$getvars['trade_status']);
	}
	else
	{
		exit;
	}
}

//֪ͨУ��
if($logflag)
{
	$checkurl = $jieqiPayset[JIEQI_PAY_TYPE]['notifycheck'] . '?msg_id=' . urlencode($getvars['notify_id']) . '&email=' . urlencode($getvars['buyer_email']) . '&order_no=' . urlencode($getvars['out_trade_no']);
	$checkret = strtolower(file_get_contents($checkurl));//success or failure
	$log      = $checkurl.'['.$checkret.']';
	jieqi_writefile(JIEQI_ROOT_PATH.'/cache/alipaycheck.txt',$log,'ab');
}

//md5У��
ksort($getvars);
reset($getvars);
$signtext   = '';
$signdecode = '';

foreach($getvars as $k=>$v)
{
	if($k != 'sign' && $k != 'sign_type')
	{
		if(!empty($signtext))
		{
			$signtext   .= '&';
			$signdecode .= '&';
		}
		
		$signtext   .= $k . '=' . $v;
		$signdecode .= $k . '=' . urldecode($v);
	}
}

if(strtolower($getvars['sign']) == strtolower(md5($signtext.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'])) || strtolower($getvars['sign']) == strtolower(md5($signdecode.$jieqiPayset[JIEQI_PAY_TYPE]['paykey'])))
{
	if(isset($jieqiModules['pay']['path']))
	{
		$paylog_php = $jieqiModules['pay']['path'].'/class/paylog.php';
	}
	else
	{
		$paylog_php = JIEQI_ROOT_PATH.'/modules/pay/class/paylog.php';
	}
	
	include_once($paylog_php);
	$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid        = intval($getvars['out_trade_no']);
	$paylog         = $paylog_handler->get($orderid);
	
	if(is_object($paylog))
	{
		$buyname = $paylog->getVar('buyname');
		$buyid   = $paylog->getVar('buyid');
		$payflag = $paylog->getVar('payflag');
		$egold   = $paylog->getVar('egold');
		
		if($payflag == 0)
		{
			include_once(JIEQI_ROOT_PATH.'/class/users.php');
		
			$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
			$ret = $users_handler->income($buyid, $egold, $jieqiPayset[JIEQI_PAY_TYPE]['paysilver'], $jieqiPayset[JIEQI_PAY_TYPE]['payscore'][$egold]);
			
			if($ret)
			{
				$note = sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
			}
			else
			{
				$note = sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
			}
			
			$paylog->setVar('rettime', JIEQI_NOW_TIME);
			//$paylog->setVar('money', $money);
			$paylog->setVar('note', $note);
			$paylog->setVar('payflag', 1);
			
			if(!$paylog_handler->insert($paylog))
			{
				if($showmode)
				{
					jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
				}
			}
			else
			{
				if($showmode)
				{
					jieqi_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
				}
			}
		}
		else
		{
			if($showmode)
			{
				jieqi_msgwin($jieqiLang['pay']['already_add_egold']);
			}
		}
	}
	else
	{
		if($showmode)
		{
			jieqi_printfail($jieqiLang['pay']['no_buy_record']);
		}
	}
}
else
{
	if($showmode)
	{
		jieqi_printfail($jieqiLang['pay']['return_checkcode_error']);
	}
}
?>