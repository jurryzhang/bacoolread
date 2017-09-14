<?php

function jieqi_obook_getochapter($cid)
{
	global $jieqiLang;
	global $ochapter_handler;
	global $jieqiModules;

	if (!isset($jieqiLang['obook']['buy'])) {
		jieqi_loadlang('buy', 'obook');
	}

	if (!is_a($ochapter_handler, 'JieqiOchapterHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/ochapter.php';
		$ochapter_handler = &JieqiOchapterHandler::getInstance('JieqiOchapterHandler');
	}

	$cid = intval($cid);
	$ochapter = $ochapter_handler->get($cid);
	return $ochapter;
}

function jieqi_obook_getobuyinfo($cid, $uid = 0)
{
	global $jieqiLang;
	global $obuyinfo_handler;
	global $jieqiModules;

	if (!isset($jieqiLang['obook']['buy'])) {
		jieqi_loadlang('buy', 'obook');
	}

	if (!is_a($obuyinfo_handler, 'JieqiObuyinfoHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/obuyinfo.php';
		$obuyinfo_handler = &JieqiObuyinfoHandler::getInstance('JieqiObuyinfoHandler');
	}

	$cid = intval($cid);

	if (empty($uid)) {
		$uid = intval($_SESSION['jieqiUserId']);
	}
	else {
		$uid = intval($uid);
	}

	$criteria = new CriteriaCompo(new Criteria('ochapterid', $cid));
	$criteria->add(new Criteria('userid', $uid));
	$criteria->setLimit(1);
	$obuyinfo_handler->queryObjects($criteria);
	$obuyinfo = $obuyinfo_handler->getObject();
	return $obuyinfo;
}

function jieqi_obook_unbuychapters($oid, $ocids = array(), $uid = 0)
{
	global $jieqiLang;
	global $jieqiModules;
	global $query;
	$oid = intval($oid);

	if (!is_array($ocids)) {
		$ocids = array();
	}

	foreach ($ocids as $k => $v) {
		$ocids[$k] = intval($v);
	}

	if (empty($uid)) {
		$uid = intval($_SESSION['jieqiUserId']);
	}
	else {
		$uid = intval($uid);
	}

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	$sql = 'SELECT ochapterid FROM ' . jieqi_dbprefix('obook_obuyinfo') . ' WHERE userid = ' . $uid . ' AND obookid = ' . $oid;

	if (!empty($ocids)) {
		$sql .= ' AND ochapterid IN (' . implode(',', $ocids) . ')';
	}

	$query->execute($sql);
	$buyary = array();

	while ($obuyinfo = $query->getRow()) {
		$buyary[] = $obuyinfo['ochapterid'];
	}

	$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_ochapter') . ' WHERE obookid = ' . $oid . ' AND display = 0';

	if (!empty($ocids)) {
		$sql .= ' AND ochapterid IN (' . implode(',', $ocids) . ')';
	}

	$sql .= ' ORDER BY ochapterid ASC';
	$query->execute($sql);
	$ochapterrows = array();

	while ($ochapter = $query->getRow()) {
		if (!in_array($ochapter['ochapterid'], $buyary)) {
			$ochapterrows[] = $ochapter;
		}
	}

	return $ochapterrows;
}

function jieqi_obook_isautobuy($oid, $uid = 0)
{
	global $jieqiLang;
	global $jieqiModules;
	global $query;
	$oid = intval($oid);

	if (empty($uid)) {
		$uid = intval($_SESSION['jieqiUserId']);
	}
	else {
		$uid = intval($uid);
	}

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_obuy') . ' WHERE userid = ' . $uid . ' AND obookid = ' . $oid . ' LIMIT 0, 1';
	$query->execute($sql);
	$row = $query->getRow();
	if (is_array($row) && (0 < $row['autobuy'])) {
		return true;
	}
	else {
		return false;
	}
}

function jieqi_obook_autobuy($ochapter, &$u)
{
	global $jieqiLang;
	global $jieqiModules;
	global $query;
	global $users_handler;
	global $jieqiLang;
	//global $jieqiSetting;

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	if (!is_a($users_handler, 'JieqiUsersHandler')) {
		include_once JIEQI_ROOT_PATH . '/class/users.php';
		$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
	}

	if (is_a($u, 'JieqiUsers')) {
		$users = &$u;
	}
	else {
		$u = intval($u);

		if ($u <= 0) {
			$u = intval($_SESSION['jieqiUserId']);
		}

		$users = $users_handler->get($u);

		if (!is_object($users)) {
			return false;
		}
	}

	$articleid = intval($ochapter->getVar('articleid', 'n'));
	$obookname = $ochapter->getVar('obookname');
	$chaptername = $ochapter->getVar('chaptername');
	$saleprice = $ochapter->getVar('saleprice', 'n');
	$usermoney = $users->getEmoney();

	if ($saleprice <= $usermoney['emoney']) {
//		if ((0 < $ochapter->getVar('sourceid', 'n')) || defined('JIEQI_CLOUDPAY')) {
//			if (!isset($jieqiSetting)) {
//				jieqi_getconfigs('system', 'setting', 'jieqiSetting');
//			}

/*			if (isset($jieqiSetting['siteid']) && (0 < intval($jieqiSetting['siteid']))) {
				include_once JIEQI_ROOT_PATH . '/include/apiclient.php';
				$jieqiapi = new JieqiApiClient($jieqiSetting);
				$params = array('aid' => intval($ochapter->getVar('sourceid', 'n')), 'cid' => intval($ochapter->getVar('sourcecid', 'n')), 'egold' => intval($ochapter->getVar('saleprice', 'n')), 'caid' => intval($ochapter->getVar('articleid', 'n')), 'ccid' => intval($ochapter->getVar('ochapterid', 'n')), 'cuid' => intval($_SESSION['jieqiUserId']), 'cip' => jieqi_userip());
				$ret = $jieqiapi->api('article/vip_buy', $params);

				if ($ret['ret'] < 0) {
					jieqi_printfail(jieqi_htmlstr($ret['msg']));
				}

				if (!is_array($ret['msg'])) {
					jieqi_printfail($jieqiLang['obook']['jieqiapi_return_formaterror']);
				}

				$result = $ret['msg'];
				if (isset($result['ret']) && ($result['ret'] < 0)) {
					jieqi_printfail(jieqi_htmlstr($result['msg']));
				}

				if (isset($result['saleprice']) && is_numeric($result['saleprice']) && (0 < intval($result['saleprice']))) {
					$saleprice = intval($result['saleprice']);
				}
			} */
//		}

		$ret = $users_handler->payout($users, $saleprice);

		if (!$ret) {
			jieqi_printfail($jieqiLang['obook']['user_payout_failure']);
		}

		$ret = jieqi_obook_buyochapter($ochapter, $users);

		if ($ret) {
			jieqi_obook_upincome(array('obookid' => $ochapter->getVar('obookid', 'n'), 'egold' => $saleprice, 'etype' => 0, 'intype' => 'egold', 'salenum' => 1));

			if (0 < $articleid) {
				include_once $jieqiModules['article']['path'] . '/include/funaction.php';
				$actions = array('actname' => 'buychapter', 'actnum' => 1, 'actegold' => $saleprice, 'actbuy' => 1);
				jieqi_article_actiondo($actions, $articleid);
			}

			return true;
		}
		else {
			$users_handler->payback($users->getVar('uid', 'n'), $saleprice);
			jieqi_printfail($jieqiLang['obook']['add_buyinfo_failure']);
		}
	}
	else {
		jieqi_printfail(sprintf($jieqiLang['obook']['chapter_money_notenough'], $obookname, $chaptername, $saleprice . ' ' . JIEQI_EGOLD_NAME, $usermoney['emoney'] . ' ' . JIEQI_EGOLD_NAME, $jieqiModules['pay']['url'] . '/buyegold.php'));
	}
}

function jieqi_obook_getocontent($ochapter)
{
	global $ocontent_handler;
	global $jieqiModules;
	global $jieqiConfigs;
	global $obook_static_url;
	//global $jieqiSetting;
	global $jieqiLang;

	/*if (0 < $ochapter->getVar('sourceid', 'n')) {
		if (!isset($jieqiSetting)) {
			jieqi_getconfigs('system', 'setting', 'jieqiSetting');
		}

		include_once JIEQI_ROOT_PATH . '/include/apiclient.php';
		$jieqiapi = new JieqiApiClient($jieqiSetting);
		$params = array('aid' => intval($ochapter->getVar('sourceid', 'n')), 'cid' => intval($ochapter->getVar('sourcecid', 'n')), 'caid' => intval($ochapter->getVar('articleid', 'n')), 'ccid' => intval($ochapter->getVar('ochapterid', 'n')), 'cuid' => intval($_SESSION['jieqiUserId']), 'cip' => jieqi_userip());
		$ret = $jieqiapi->api('article/vip_content', $params);

		if ($ret['ret'] < 0) {
			jieqi_printfail(jieqi_htmlstr($ret['msg']));
		}

		if (!is_array($ret['msg'])) {
			jieqi_printfail($jieqiLang['obook']['jieqiapi_return_formaterror']);
		}

		$result = $ret['msg'];
		if (isset($result['ret']) && ($result['ret'] < 0)) {
			jieqi_printfail(jieqi_htmlstr($result['msg']));
		}
		else {
			return $result['content'];
		}
	}
	else {    */     
		$cid = intval($ochapter->getVar('ochapterid', 'n'));

		if (!isset($jieqiConfigs['obook'])) {
			jieqi_getconfigs('obook', 'configs');
		}

		if (!isset($obook_static_url)) {
			$obook_static_url = (empty($jieqiConfigs['obook']['staticurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['staticurl']);
		}

		if (!is_a($ocontent_handler, 'JieqiOcontentHandler')) {
			include_once $jieqiModules['obook']['path'] . '/class/ocontent.php';
			$ocontent_handler = &JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
		}

		$cobj = $ocontent_handler->get($cid, 'ochapterid');

		if (!$cobj) {
			return '';
		}

		if ($jieqiConfigs['obook']['obkimagetype'] == 'txt') {
			return $cobj->getVar('ocontent', 'n');
		}
		else {
			$jieqiConfigs['obook']['obklinewidth'] = isset($jieqiConfigs['obook']['obklinewidth']) ? intval($jieqiConfigs['obook']['obklinewidth']) : 80;

			if ($jieqiConfigs['obook']['obklinewidth'] < 2) {
				$jieqiConfigs['obook']['obklinewidth'] = 80;
			}

			$jieqiConfigs['obook']['obkpictxt'] = isset($jieqiConfigs['obook']['obkpictxt']) ? intval($jieqiConfigs['obook']['obkpictxt']) : 0;
			$jieqiConfigs['obook']['obkpicline'] = isset($jieqiConfigs['obook']['obkpicline']) ? intval($jieqiConfigs['obook']['obkpicline']) : 0;
			$picnum = 1;

			if (0 < $jieqiConfigs['obook']['obkpicline']) {
				include_once JIEQI_ROOT_PATH . '/lib/text/textfunction.php';
				$jieqi_content = $cobj->getVar('ocontent', 'n');

				if (!empty($jieqiConfigs['obook']['obookreadhead'])) {
					$jieqi_content = $jieqiConfigs['obook']['obookreadhead'] . "\r\n" . $jieqi_content;
				}

				if (!empty($jieqiConfigs['obook']['obookreadfoot'])) {
					$jieqi_content .= "\r\n" . $jieqiConfigs['obook']['obookreadfoot'];
				}

				$outary = explode("\n", jieqi_limitwidth($jieqi_content, $jieqiConfigs['obook']['obklinewidth']));
				$picnum = ceil(count($outary) / $jieqiConfigs['obook']['obkpicline']);
			}
			else if (0 < $jieqiConfigs['obook']['obkpictxt']) {
				$jieqi_content = $cobj->getVar('ocontent', 'n');

				if (!empty($jieqiConfigs['obook']['obookreadhead'])) {
					$jieqi_content = $jieqiConfigs['obook']['obookreadhead'] . "\r\n" . $jieqi_content;
				}

				if (!empty($jieqiConfigs['obook']['obookreadfoot'])) {
					$jieqi_content .= "\r\n" . $jieqiConfigs['obook']['obookreadfoot'];
				}

				$picnum = ceil(strlen($jieqi_content) / $jieqiConfigs['obook']['obkpictxt']);
			}

			$picrows = array();
			$i = 1;

			for (; $i <= $picnum; $i++) {
				$picrows[$i] = array('order' => $i, 'url' => $obook_static_url . '/obookimage.php?cid=' . $cid . '&pic=' . $i);
			}

			return $picrows;
		}
	//}
}

function jieqi_obook_buyochapter($ochapter, $users)
{
	global $jieqiLang;
	global $obuyinfo_handler;
	global $osale_handler;
	global $obuy_handler;
	global $obook_handler;
	global $query;
	global $jieqiModules;

	if (!isset($jieqiLang['obook']['buy'])) {
		jieqi_loadlang('buy', 'obook');
	}

	if (!is_a($obuyinfo_handler, 'JieqiObuyinfoHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/obuyinfo.php';
		$obuyinfo_handler = &JieqiObuyinfoHandler::getInstance('JieqiObuyinfoHandler');
	}

	if (!is_a($osale_handler, 'JieqiOsaleHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/osale.php';
		$osale_handler = &JieqiOsaleHandler::getInstance('JieqiOsaleHandler');
	}

	if (!is_a($obuy_handler, 'JieqiOsaleHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/obuy.php';
		$obuy_handler = &JieqiObuyHandler::getInstance('JieqiObuyHandler');
	}

	if (!is_a($obook_handler, 'JieqiObookHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/obook.php';
		$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
	}

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	if (is_numeric($ochapter)) {
		$ochapter = $ochapter_handler->get($ochapter);
	}

	if (is_object($ochapter)) {
		$ochapter = $ochapter->getVars('n');
	}

	if (!is_array($ochapter)) {
		return false;
	}

	$saleprice = $ochapter['saleprice'];
	$salenum = 1;
	$sumprice = $saleprice * $salenum;
	$osale = $osale_handler->create();
	$osale->setVar('siteid', JIEQI_SITE_ID);
	$osale->setVar('buytime', JIEQI_NOW_TIME);
	$osale->setVar('accountid', $users->getVar('uid', 'n'));
	$osale->setVar('account', $users->getVar('name', 'n'));
	$osale->setVar('articleid', $ochapter['articleid']);
	$osale->setVar('obookid', $ochapter['obookid']);
	$osale->setVar('ochapterid', $ochapter['ochapterid']);
	$osale->setVar('obookname', $ochapter['obookname']);
	$osale->setVar('chaptername', $ochapter['chaptername']);
	$osale->setVar('saleprice', $saleprice);
	$osale->setVar('salenum', $salenum);
	$osale->setVar('sumprice', $sumprice);
	$osale->setVar('pricetype', 0);
	$osale->setVar('paytype', 0);
	$osale->setVar('payflag', 0);
	$osale->setVar('paynote', jieqi_userip());
	$osale->setVar('state', 0);
	$osale->setVar('flag', 0);
	$ret = $osale_handler->insert($osale);

	if (!$ret) {
		return false;
	}

	$criteria = new CriteriaCompo(new Criteria('userid', $users->getVar('uid', 'n')));
	$criteria->add(new Criteria('obookid', $ochapter['obookid']));
	$criteria->setLimit(1);
	$obuy_handler->queryObjects($criteria);
	$obuy = $obuy_handler->getObject();

	if (!empty($_REQUEST['autobuy'])) {
		$autobuy = 1;
	}
	else {
		$autobuy = 0;
	}

	if (is_object($obuy)) {
		$obuy->setVar('osaleid', $osale->getVar('osaleid', 'n'));
		$obuy->setVar('lastbuy', JIEQI_NOW_TIME);
		$obuy->setVar('username', $users->getVar('name', 'n'));
		$obuy->setVar('articleid', $ochapter['articleid']);
		$obuy->setVar('ochapterid', $ochapter['ochapterid']);
		$obuy->setVar('obookname', $ochapter['obookname']);
		$obuy->setVar('chaptername', $ochapter['chaptername']);
		$obuy->setVar('chapternum', $obuy->getVar('chapternum', 'n') + 1);
		$obuy->setVar('buynum', $obuy->getVar('salenum', 'n') + $salenum);
		$obuy->setVar('buypay', $obuy->getVar('sumprice', 'n') + $sumprice);

		if (0 < $autobuy) {
			$obuy->setVar('autobuy', $autobuy);
		}
	}
	else {
		$obuy = $obuy_handler->create();
		$obuy->setVar('siteid', JIEQI_SITE_ID);
		$obuy->setVar('osaleid', $osale->getVar('osaleid', 'n'));
		$obuy->setVar('buytime', JIEQI_NOW_TIME);
		$obuy->setVar('lastbuy', JIEQI_NOW_TIME);
		$obuy->setVar('lastread', 0);
		$obuy->setVar('readnum', 0);
		$obuy->setVar('userid', $users->getVar('uid', 'n'));
		$obuy->setVar('username', $users->getVar('name', 'n'));
		$obuy->setVar('articleid', $ochapter['articleid']);
		$obuy->setVar('obookid', $ochapter['obookid']);
		$obuy->setVar('ochapterid', $ochapter['ochapterid']);
		$obuy->setVar('obookname', $ochapter['obookname']);
		$obuy->setVar('chaptername', $ochapter['chaptername']);
		$obuy->setVar('chapternum', 1);
		$obuy->setVar('buynum', $salenum);
		$obuy->setVar('buypay', $sumprice);
		$obuy->setVar('isread', 0);
		$obuy->setVar('isfull', 0);
		$obuy->setVar('autobuy', $autobuy);
		$obuy->setVar('buymode', 0);
		$obuy->setVar('starlevel', 0);
		$obuy->setVar('oflag', 0);
	}

	$ret = $obuy_handler->insert($obuy);

	if (!$ret) {
		return false;
	}

	$obuyinfo = $obuyinfo_handler->create();
	$obuyinfo->setVar('siteid', JIEQI_SITE_ID);
	$obuyinfo->setVar('osaleid', $osale->getVar('osaleid', 'n'));
	$obuyinfo->setVar('buytime', JIEQI_NOW_TIME);
	$obuyinfo->setVar('userid', $users->getVar('uid', 'n'));
	$obuyinfo->setVar('username', $users->getVar('name', 'n'));
	$obuyinfo->setVar('articleid', $ochapter['articleid']);
	$obuyinfo->setVar('obookid', $ochapter['obookid']);
	$obuyinfo->setVar('ochapterid', $ochapter['ochapterid']);
	$obuyinfo->setVar('obookname', $ochapter['obookname']);
	$obuyinfo->setVar('chaptername', $ochapter['chaptername']);
	$obuyinfo->setVar('lastread', 0);
	$obuyinfo->setVar('readnum', 0);
	$obuyinfo->setVar('checkcode', '');
	$obuyinfo->setVar('buyprice', $saleprice);
	$obuyinfo->setVar('buynum', $salenum);
	$obuyinfo->setVar('buypay', $sumprice);
	$obuyinfo->setVar('state', 0);
	$obuyinfo->setVar('flag', 0);
	$ret = $obuyinfo_handler->insert($obuyinfo);

	if (!$ret) {
		return false;
	}

	include_once JIEQI_ROOT_PATH . '/include/funstat.php';
	$lasttime = $ochapter['lastsale'];
	$addorup = jieqi_visit_addorup($lasttime);
	$addnum = 1;
	$upfields = array();
	$upfields['lastsale'] = JIEQI_NOW_TIME;
	$upfields['daysale'] = $addorup['day'] ? $addnum : $ochapter['daysale'] + $addnum;
	$upfields['weeksale'] = $addorup['week'] ? $addnum : $ochapter['weeksale'] + $addnum;
	$upfields['monthsale'] = $addorup['month'] ? $addnum : $ochapter['monthsale'] + $addnum;
	$upfields['allsale'] = $ochapter['allsale'] + $addnum;
	$upfields['normalsale'] = $ochapter['normalsale'] + $addnum;
	$upfields['totalsale'] = $ochapter['totalsale'] + $addnum;

	if ($pricetype == 1) {
		$upfields['sumesilver'] = $ochapter['sumesilver'] + $saleprice;
	}
	else {
		$upfields['sumegold'] = $ochapter['sumegold'] + $saleprice;
	}

	$sql = $query->makeupsql(jieqi_dbprefix('obook_ochapter'), $upfields, 'UPDATE', array('ochapterid' => $ochapter['ochapterid']));
	$query->execute($sql);
	return true;
}

function jieqi_obook_upincome($params)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqiPower;
	global $obook_handler;
	global $ochapter_handler;
	global $jieqiUsersStatus;
	global $jieqiUsersGroup;

	if (!is_a($obook_handler, 'JieqiObookHandler')) {
		include_once $jieqiModules['obook']['path'] . '/class/obook.php';
		$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
	}

	if (!empty($params['obookid'])) {
		$obook = $obook_handler->get(intval($params['obookid']));
	}
	else if (!empty($params['articleid'])) {
		$obook = $obook_handler->get(intval($params['articleid']), 'articleid');

		if (!is_object($obook)) {
			include_once $jieqiModules['obook']['path'] . '/include/actobook.php';
			$obook = jieqi_obook_autocreate(intval($params['articleid']), 0);
		}
	}
	else {
		return false;
	}

	if (is_object($obook)) {
		$params['egold'] = intval($params['egold']);
		$params['salenum'] = intval($params['salenum']);
		include_once JIEQI_ROOT_PATH . '/include/funstat.php';
		$lasttime = $obook->getVar('lastsale', 'n');
		$addorup = jieqi_visit_addorup($lasttime);
		$daysale = ($addorup['day'] ? $params['egold'] : $obook->getVar('daysale', 'n') + $params['egold']);
		$weeksale = ($addorup['week'] ? $params['egold'] : $obook->getVar('weeksale', 'n') + $params['egold']);
		$monthsale = ($addorup['month'] ? $params['egold'] : $obook->getVar('monthsale', 'n') + $params['egold']);
		$allsale = $obook->getVar('sumemoney', 'n') + $params['egold'];
		$obook->setVar('lastsale', JIEQI_NOW_TIME);
		$obook->setVar('daysale', $daysale);
		$obook->setVar('weeksale', $weeksale);
		$obook->setVar('monthsale', $monthsale);
		$obook->setVar('allsale', $allsale);
		$params['egold'] = intval($params['egold']);
		if (isset($params['intype']) && in_array($params['intype'], array('tip', 'hurry', 'besp', 'award', 'agent', 'gift', 'other'))) {
			$obook->setVar('sum' . $params['intype'], $obook->getVar('sum' . $params['intype'], 'n') + $params['egold']);
		}
		else if ($params['etype'] == 1) {
			$obook->setVar('sumesilver', $obook->getVar('sumesilver', 'n') + $params['egold']);
		}
		else {
			$obook->setVar('sumegold', $obook->getVar('sumegold', 'n') + $params['egold']);
		}

		$obook->setVar('sumemoney', $obook->getVar('sumemoney', 'n') + $params['egold']);
		$obook_handler->insert($obook);
		return $obook;
	}
	else {
		return false;
	}
}


?>
