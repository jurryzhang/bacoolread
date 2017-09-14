<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';
jieqi_checklogin();
jieqi_loadlang('monthly', JIEQI_MODULE_NAME);
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
if (!$jieqiUsers) {
	jieqi_printfail(LANG_NO_USER);
}
jieqi_getconfigs('article', 'option', 'jieqiOption');
$userisvip = $jieqiUsers->getVar('isvip', 'n');
$syncemoney = ($_REQUEST['action'] == 'buy' ? false : true);
$usermoney = $jieqiUsers->getEmoney($syncemoney);

$userdate = date('Y-m-d H:i:s',$jieqiUsers->getVar('overtime'));

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'edit';
}

switch ($_REQUEST['action']) {
case 'post':
	$errtext = '';
	$_REQUEST['buytype'] = intval(trim($_REQUEST['buytype']));
	$buytype = $_REQUEST['buytype'];
	$payegold = intval(trim($jieqiOption['article']['jieqimonthly']['items'][$_REQUEST['buytype']]));
	if(!$_REQUEST['buytype']){
	$errtext .= $jieqiLang['article']['monthly_options_error'] . '<br />';	
	}
	else if($payegold > $usermoney['emoney']){
	$errtext .= $jieqiLang['article']['monthly_over_zero'] . '<br />';	
	}
	//判断时间是否大于0.如果大于0，可能是过期或者未过期。
	if (empty($errtext)) {
      if($jieqiUsers->getVar('overtime') > 0){
		//取用户当前包月时间
		//大于0，判断时间是否大于当前时间，如果是，则未过期，如果小于，则已经过期。
		if($jieqiUsers->getVar('overtime') > JIEQI_NOW_TIME){
			$upovertime = date("Y-m-d H:i:s", strtotime("+$buytype month", strtotime("$userdate")));
		}
	    else {
			$upovertime = date("Y-m-d H:i:s",strtotime("+$buytype month"));

	    }
	  }
	  else {
		    $upovertime = date("Y-m-d H:i:s",strtotime("+$buytype month"));
	  }
	  	$temp=explode(" ",$upovertime);
        $temp1=explode("-",$temp[0]);
		$temp2=explode(":",$temp[1]);
		$overtime = mktime($temp2[0],$temp2[1],$temp2[2],$temp1[1],$temp1[2],$temp1[0]);
		$jieqiUsers->setVar('overtime', $overtime);
		$ret1 = $users_handler->insert($jieqiUsers);

		$ret = $users_handler->payout($jieqiUsers, $payegold);
        if (!$ret) {
			jieqi_printfail($jieqiLang['article']['database_save_error']);
		}
		if (!$ret1) {
			jieqi_printfail($jieqiLang['article']['database_save_error']);
		}
		jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['monthly_save_success']);
	}
	else {
		jieqi_printfail($errtext);
	}
	break;

case 'show':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	$jieqiTpl->assign('emoney', $usermoney['emoney']);
	$jieqiTpl->assign('overtime', $jieqiUsers->getVar('overtime'));
	$jieqiTpl->assign('egoldname', JIEQI_EGOLD_NAME);
	$jieqiTpl->assign('todaydate', $todaydate);
	$jieqiTpl->assign('uid', $jieqiUsers->getVar('uid'));
	
	foreach($jieqiOption['article'] as $k=>$v){
		$jieqiTpl->assign_by_ref($k, $jieqiOption['article'][$k]);
	}

	if (empty($_REQUEST['ajax_request'])) {
		$jieqiTpl->assign('ajax_request', 0);
	}
	else {
		$jieqiTpl->assign('ajax_request', 1);
	}

	$jieqiTpl->setCaching(0);
	
	$jieqiTset['jieqi_page_template'] = $jieqiModules['article']['path'] . '/templates/monthly.html';
	//$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/monthly.html'));
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
?>