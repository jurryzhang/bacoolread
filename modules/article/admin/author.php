<?php

define('JIEQI_MODULE_NAME', 'system');
require_once '../../../global.php';
include_once JIEQI_ROOT_PATH . '/class/power.php';
$power_handler = &JieqiPowerHandler::getInstance('JieqiPowerHandler');
$power_handler->getSavedVars('system');
jieqi_checkpower($jieqiPower['article']['adminpersondetail'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/admin/author.html';
include_once JIEQI_ROOT_PATH . '/admin/header.php';
$jieqiPset = jieqi_get_pageset();
$criteria = new CriteriaCompo();
$criteria->setSort('uid');
$criteria->setOrder('DESC');
if (isset($_REQUEST['keyword']) && !empty($_REQUEST['keyword'])) {
	switch ($_REQUEST['keytype']) {
	case 'name':
		$criteria->add(new Criteria('name', $_REQUEST['keyword'], '='));
		break;

	case 'email':
		$criteria->add(new Criteria('email', $_REQUEST['keyword'], '='));
		break;

	case 'mobile':
		$criteria->add(new Criteria('mobile', $_REQUEST['keyword'], '='));
		break;

	case 'uname':
	default:
		$criteria->add(new Criteria('uname', $_REQUEST['keyword'], '='));
		break;
	}
}
else {
	if (isset($_REQUEST['groupid']) && !empty($_REQUEST['groupid'])) {
		$criteria->add(new Criteria('groupid', intval($_REQUEST['groupid']), '='));
	}
	else {
		if (isset($_REQUEST['isvip']) && (0 < $_REQUEST['isvip'])) {
			$criteria->add(new Criteria('isvip', 0, '>'));
		}
		else {
			if (isset($_REQUEST['monthly']) && (0 < $_REQUEST['monthly'])) {
				$criteria->add(new Criteria('overtime', JIEQI_NOW_TIME, '>'));
				$criteria->setSort('overtime');
				$criteria->setOrder('ASC');
			}
		}
	}
}

$criteria->setLimit($jieqiPset['rows']);
$criteria->setStart($jieqiPset['start']);
$users_handler->queryObjects($criteria);
$userrows = array();
$k = 0;
include_once JIEQI_ROOT_PATH . '/include/funusers.php';

while ($v = $users_handler->getObject())
{
	$use = jieqi_system_usersvars($v);
	
	$userrows[$k] = $use;
		
	$k++;
}

$jieqiTpl->assign_by_ref('userrows', $userrows);
$grouprows = array();
$i = 0;

foreach ($jieqiGroups as $k => $v) {
	if (1 < $k) {
		$grouprows[$i]['groupid'] = $k;
		$grouprows[$i]['groupname'] = $v;
		$i++;
	}
}

$jieqiTpl->assign_by_ref('grouprows', $grouprows);
$rowcount = $users_handler->getCount($criteria);
$jieqiTpl->assign_by_ref('rowcount', $rowcount);
include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
$jieqiPset['count'] = $rowcount;
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink('', true, true);
$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/admin/footer.php';

?>
