<?php
function jieqi_zendoptimizerver()
{
	ob_start();
	phpinfo();
	$phpinfo = ob_get_contents();
	ob_end_clean();
	preg_match('Zend(s&nbsp;)Optimizer(s&nbsp;)v([.d]),is', $phpinfo, $matches);

	if (!empty($matches[3])) 
	{
		return $matches[3];
	}
	else 
	{
		return '';
	}
}


define('JIEQI_MODULE_NAME', 'system');
require_once ('../global.php');
include_once (JIEQI_ROOT_PATH . '/class/power.php');
$power_handler = &JieqiPowerHandler::getInstance('JieqiPowerHandler');
$power_handler->getSavedVars('system');
jieqi_checkpower($jieqiPower['system']['adminpanel'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once (JIEQI_ROOT_PATH . '/admin/header.php');
$siteurl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$siteurl = dirname(dirname($siteurl));
$siteip = @gethostbyname($_SERVER['SERVER_NAME']);
$jieqi_license_domain = '';
$matchs = array();

if (1.6 == floatval(JIEQI_VERSION)) {
	$jieqi_license_ary = jieqi_funtoarray('base64_decode', explode('@', JIEQI_LICENSE_KEY));
}
else {
	$jieqi_license_ary = explode('@', base64_decode(JIEQI_LICENSE_KEY));
}

if (!empty($jieqi_license_ary[1]) && preg_match('^(httphttps)[^](' . $jieqi_license_ary[1] . ')i', JIEQI_LOCAL_HOST, $matchs)) {
	$jieqi_license_domain = $jieqi_license_ary[1];
}



$jieqiTpl->display(JIEQI_ROOT_PATH . '/templates/admin/default.html');

?>

