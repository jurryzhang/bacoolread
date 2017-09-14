<?php

define('JIEQI_MODULE_NAME', 'obook');
require_once '../../../global.php';
$_REQUEST['oid'] = intval($_REQUEST['oid']);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
jieqi_checklogin();
if (empty($_REQUEST['oid']) || !is_numeric($_REQUEST['oid'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['obook']['manageallobook'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['obook']['path'] . '/templates/admin/paidlog.html';
include_once JIEQI_ROOT_PATH . '/admin/header.php';
$jieqiPset = jieqi_get_pageset();
jieqi_getconfigs('obook', 'configs');
$obook_static_url = (empty($jieqiConfigs['obook']['staticurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['staticurl']);
$obook_dynamic_url = (empty($jieqiConfigs['obook']['dynamicurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['dynamicurl']);
$jieqiTpl->assign('obook_static_url', $obook_static_url);
$jieqiTpl->assign('obook_dynamic_url', $obook_dynamic_url);
include_once $jieqiModules['obook']['path'] . '/class/paidlog.php';
$paidlog_handler = &JieqiPaidlogHandler::getInstance('JieqiPaidlogHandler');
$criteria = new CriteriaCompo(new Criteria('obookid', $_REQUEST['oid']));

if (!empty($_REQUEST['oid'])) {
	$criteria->add(new Criteria('obookid', intval($_REQUEST['oid'])));
}
else if (!empty($_REQUEST['aid'])) {
	$criteria->add(new Criteria('articleid', intval($_REQUEST['aid'])));
}
else if (!empty($_REQUEST['oname'])) {
	$criteria->add(new Criteria('obookname', $_REQUEST['oname']));
}
else if (!empty($_REQUEST['aname'])) {
	$criteria->add(new Criteria('obookname', $_REQUEST['aname']));
}

$criteria->setSort('paidid');
$criteria->setOrder('DESC');
$criteria->setLimit($jieqiPset['rows']);
$criteria->setStart($jieqiPset['start']);
$paidlog_handler->queryObjects($criteria);
$paidlogrows = array();
$k = 0;

while ($v = $paidlog_handler->getObject()) {
	$paidlogrows[$k] = jieqi_query_rowvars($v, 's');
	$k++;
}

$jieqiTpl->assign_by_ref('paidrows', $paidlogrows);
include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
$jieqiPset['count'] = $paidlog_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = '';

if (!empty($_REQUEST['oid'])) {
	if (empty($pagelink)) {
		$pagelink .= '?';
	}
	else {
		$pagelink .= '&';
	}

	$pagelink .= 'oid=' . urlencode($_REQUEST['oid']);
}
else if (!empty($_REQUEST['oname'])) {
	if (empty($pagelink)) {
		$pagelink .= '?';
	}
	else {
		$pagelink .= '&';
	}

	$pagelink .= 'oname=' . urlencode($_REQUEST['oname']);
}

if (empty($pagelink)) {
	$pagelink .= '?page=';
}
else {
	$pagelink .= '&page=';
}

$jumppage->setlink($obook_dynamic_url . '/admin/paidlog.php' . $pagelink, false, true);
$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/admin/footer.php';

?>
