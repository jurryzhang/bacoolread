<?php

define('JIEQI_MODULE_NAME', 'obook');
require_once '../../../global.php';

jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['obook']['manageallobook'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$obook_static_url = (empty($jieqiConfigs['obook']['staticurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['staticurl']);
$obook_dynamic_url = (empty($jieqiConfigs['obook']['dynamicurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['dynamicurl']);

//burnÐÞ¸Ä£¬2016-12-09
jieqi_getconfigs('admin', 'setting', 'jieqiSetting');

if (empty($jieqiSetting['siteid'])) {
	jieqi_printfail($jieqiLang['article']['sync_jieqi_nojoin']);
}


include_once JIEQI_ROOT_PATH . '/include/apiclient.php';
$jieqiapi = new JieqiApiClient($jieqiSetting);
$params = array('month' => 0);
$ret = $jieqiapi->api('obook/get_sitereport', $params);

if ($ret['ret'] < 0) {
	jieqi_printfail(jieqi_htmlstr($ret['msg']));
}

if (!is_array($ret['msg'])) {
	jieqi_printfail('error return data format');
}

$saleformrows = jieqi_funtoarray('jieqi_htmlstr', $ret['msg']);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['obook']['path'] . '/templates/admin/saleform.html';
include_once JIEQI_ROOT_PATH . '/admin/header.php';
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign('obook_static_url', $obook_static_url);
$jieqiTpl->assign('obook_dynamic_url', $obook_dynamic_url);
$jieqiTpl->assign_by_ref('saleformrows', $saleformrows);
$jieqiTpl->assign('_request', jieqi_funtoarray('jieqi_htmlstr', $_REQUEST));
$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/admin/footer.php';

?>
