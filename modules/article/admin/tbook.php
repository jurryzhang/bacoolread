<?php
/**
 * Created by PhpStorm.
 * User: muyi
 * Date: 2017/4/7
 * Time: 上午11:11
 *
 * 精选列表
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//获取热搜词
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_tbook');

$query->execute($sql);
$tbooklist = array();

while ($row = $query->getRow())
{
	$tbooklist[] = jieqi_query_rowvars($row);
}

$jieqiTpl->assign('tbooklist',$tbooklist);

$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/tbook.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");