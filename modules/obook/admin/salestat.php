<?php

function getObookOChapterSale($bookID)
{
	$sql     = 'SELECT * FROM ' . jieqi_dbprefix('obook_ochapter') . " WHERE articleid = " . $bookID;
	
	$result  = mysql_query($sql);
	
	$sumSale = 0;
	
	if($result)
	{
		while($row = mysql_fetch_array($result))
		{
			$sumSale += $row['sumegold'];
		}
	}
	
	return $sumSale;
}

define('JIEQI_MODULE_NAME', 'obook');
require_once '../../../global.php';
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['obook']['manageallobook'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$obook_static_url = (empty($jieqiConfigs['obook']['staticurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['staticurl']);
$obook_dynamic_url = (empty($jieqiConfigs['obook']['dynamicurl']) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['dynamicurl']);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
$jieqiTset['jieqi_contents_template'] = $jieqiModules['obook']['path'] . '/templates/admin/salestat.html';
include_once JIEQI_ROOT_PATH . '/admin/header.php';
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign('obook_static_url', $obook_static_url);
$jieqiTpl->assign('obook_dynamic_url', $obook_dynamic_url);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'sort');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'publisher');

if (empty($_REQUEST['class']))
{
	$_REQUEST['class'] = 0;
}

$criteria = new CriteriaCompo();

if (2 <= floatval(JIEQI_VERSION))
{
	$criteria->setTables(jieqi_dbprefix('obook_obook') . ' b LEFT JOIN ' . jieqi_dbprefix('system_persons') . ' p ON b.authorid=p.uid');
}
else
{
	$criteria->setTables(jieqi_dbprefix('obook_obook'));
}

if (!empty($_REQUEST['keyword']))
{
	$_REQUEST['keyword'] = trim($_REQUEST['keyword']);

	if ($_REQUEST['keytype'] == 1)
	{
		$criteria->add(new Criteria('author', $_REQUEST['keyword'], '='));
	}
	else if ($_REQUEST['keytype'] == 2)
	{
		$criteria->add(new Criteria('poster', $_REQUEST['keyword'], '='));
	}
	else
	{
		$criteria->add(new Criteria('obookname', $_REQUEST['keyword'], '='));
	}
}

if (!empty($_REQUEST['class']))
{
	$criteria->add(new Criteria('sortid', $_REQUEST['class'], '='));

	$obooktitle = $jieqiSort['obook'][$_REQUEST['class']]['caption'];
}
else if (isset($_REQUEST['publishid']))
{
	$criteria->add(new Criteria('publishid', intval($_REQUEST['publishid']), '='));
}

$jieqiTpl->assign('obooktitle', $obooktitle);

$jieqiTpl->assign('url_salestat', $obook_dynamic_url . '/admin/salestat.php');
$publishrows = array();
$k = 0;

foreach ($jieqiPublisher as $k => $v)
{
	$publishrows[$k]['publishid'] = $k;
	$publishrows[$k]['publisher'] = $v['name'];

	$k++;
}

$jieqiTpl->assign_by_ref('publishrows', $publishrows);
$criteria->setSort('lastupdate');
$criteria->setOrder('DESC');
$criteria->setLimit($jieqiPset['rows']);
$criteria->setStart($jieqiPset['start']);
$query->queryObjects($criteria);
$obookrows = array();
$k = 0;
include_once $jieqiModules['obook']['path'] . '/include/funobook.php';

while ($v = $query->getObject())
{
	$obookrows[$k] = jieqi_obook_obookvars($v);
	
	//burn添加，2017-03-07
	$obookrows[$k]['allsale'] = getObookOChapterSale($obookrows[$k]['articleid']);//订阅
	
	$obookrows[$k]['sumemoney'] = $obookrows[$k]['allsale'] + $obookrows[$k]['sumtip'] + $obookrows[$k]['sumhurry'];//
	
	$obookrows[$k]['remainemoney'] = $obookrows[$k]['sumemoney'] - $obookrows[$k]['paidemoney'];
	
	$k++;
}

$jieqiTpl->assign_by_ref('obookrows', $obookrows);
include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
$jieqiPset['count'] = $query->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = '';

if (!empty($_REQUEST['class']))
{
	if (empty($pagelink))
	{
		$pagelink .= '?';
	}
	else
	{
		$pagelink .= '&';
	}

	$pagelink .= 'class=' . $_REQUEST['class'];
}
else if (isset($_REQUEST['publishid']))
{
	if (empty($pagelink))
	{
		$pagelink .= '?';
	}
	else
	{
		$pagelink .= '&';
	}

	$pagelink .= 'publishid=' . $_REQUEST['publishid'];
}

if (!empty($_REQUEST['keyword']))
{
	if (empty($pagelink))
	{
		$pagelink .= '?';
	}
	else
	{
		$pagelink .= '&';
	}

	$pagelink .= 'keyword=' . $_REQUEST['keyword'];
	$pagelink .= '&keytype=' . $_REQUEST['keytype'];
}

if (empty($pagelink))
{
	$pagelink .= '?page=';
}
else
{
	$pagelink .= '&page=';
}

$jumppage->setlink($obook_dynamic_url . '/admin/salestat.php' . $pagelink, false, true);
$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/admin/footer.php';

?>
