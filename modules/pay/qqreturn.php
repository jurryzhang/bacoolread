<?php 
/**
 * QQ֧��-���ش���
 *
 * QQ֧��-���ش��� (http://www.qq.com)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: qqreturn.php 286 2008-12-23 03:04:17Z juny $
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'qq');
require_once('../../global.php');
jieqi_loadlang('pay', JIEQI_MODULE_NAME);
jieqi_loadlang('qq', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');

//**************************
$mycpid = $jieqiPayset[JIEQI_PAY_TYPE]['payid'];  //�����̱�ʶ
$myservice_id = $jieqiPayset[JIEQI_PAY_TYPE]['service_id']; //ҵ�����
$ret_code = $_REQUEST['ret_code'];  //�����룬0Ϊ�ɹ�������Ϊʧ��
$err_msg = $_REQUEST['err_msg'];  //����������ret_codeΪ0ʱ���ֶ�ΪOK������ʱ��Ϊ�����������
$cpid = $_REQUEST['cpid'];  //Ψһ��ʶһ��CP���ַ���
$service_id = $_REQUEST['service_id'];  //ҵ�����
$user_id = $_REQUEST['user_id'];  //ҵ����غ���(QQ����)
$time = $_REQUEST['time'];  //��ǰʱ���
$ret_para = $_REQUEST['ret_para'];  //CP��������ret_para��ԭ������
$bill_no = $_REQUEST['bill_no'];  //֧���ʵ���ע�⣺�Ƹ��ռ䷵�ص��˵�����Զ�����ظ���CP���յ�Ӧ������Դ˽��м�飬������ܻᷢ���û���һ��Ǯʹ�ö�η�������
$key = $_REQUEST['key'];  //����������rsaǩ��


if($cpid != $mycpid) my_printfail($jieqiLang['pay']['error_cpid']);
elseif($service_id != $myservice_id) my_printfail($jieqiLang['pay']['error_service_id']);
elseif($ret_code != '0') my_printfail(sprintf($jieqiLang['pay']['error_ret_code'], $ret_code, $err_msg));
elseif(!is_numeric($ret_para)) my_printfail($jieqiLang['pay']['error_serial_id']);

//rsaУ��
$post_url = $jieqiPayset[JIEQI_PAY_TYPE]['payurl'];   //�ύ��URL
$cmd_line=$jieqiPayset[JIEQI_PAY_TYPE]['cmd_line'];  //������֤�����·��

$url_para='ret_code='.$ret_code.'&err_msg='.$err_msg.'&cpid='.$cpid.'&service_id='.$service_id.'&user_id='.$user_id.'&time='.$time.'&ret_para='.$ret_para.'&bill_no='.$bill_no;

$cmd =  $cmd_line. ' v "' . $url_para .'" "'.$key.'"';

$fp = popen($cmd, "r");
$sign='';
while(!feof($fp)){
	$sign .= fgets($fp,1024);
}
pclose($fp);
$sign=trim($sign);

if($sign != '0') my_printfail($jieqiLang['pay']['return_checkcode_error']);


include_once($jieqiModules['pay']['path'].'/class/paylog.php');
$paylog_handler=JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
$ret_para=intval($ret_para);
$paylog=$paylog_handler->get($ret_para);
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
		//$paylog->setVar('money', $money);
		$paylog->setVar('note', $note);
		$paylog->setVar('payflag', 1);
		if(!$paylog_handler->insert($paylog)) my_printfail($jieqiLang['pay']['save_paylog_failure']);
		else{
			echo '<meta name="TENCENT_ONELINE_PAYMENT" content="China TENCENT">';
			my_msgwin(LANG_DO_SUCCESS,sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
			echo '<meta name="TENCENT_ONELINE_PAYMENT_END" content="China TENCENT">';
			exit;
		}
	}else{
		my_printfail($jieqiLang['pay']['already_add_egold']);
	}
}else my_printfail($jieqiLang['pay']['no_buy_record']);



// ��ʾ����
function my_printfail($msg){
	echo '<meta name="TENCENT_ONELINE_PAYMENT" content="China TENCENT">';
	my_msgwin($jieqiLang['pay']['error_title'], sprintf($jieqiLang['pay']['error_content'], $msg));
	echo '<meta name="TENCENT_ONELINE_PAYMENT_END" content="China TENCENT">';
	exit;
}

// ��ʾ��Ϣ��(����ҳ��)
function my_msgwin($title, $content, $icon=''){
	include_once(JIEQI_ROOT_PATH.'/lib/template/template.php');
	$title=jieqi_htmlstr($title);
	$jieqiTpl =& JieqiTpl::getInstance();
	$jieqiTpl->assign(array('jieqi_themeurl' => JIEQI_URL.'/themes/'.JIEQI_THEME_SET.'/', 'jieqi_themecss'=> JIEQI_URL.'/themes/'.JIEQI_THEME_SET.'/style.css',  'pagetitle' => $title, 'title' => $title, 'content' => $content, 'copyright' => $jieqiLang['pay']['copy_right'].'&copy; <a href="'.JIEQI_URL.'/">'.JIEQI_SITE_NAME.'</a>'));
	$jieqiTpl->setCaching(0);
	$jieqiTpl->display('msgwin.html');
	jieqi_freeresource();
}
?>