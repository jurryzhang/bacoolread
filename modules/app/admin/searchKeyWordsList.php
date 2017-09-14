<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: 下午7:11
 *
 * 热搜词设置
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//获取热搜词
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotsearchword');

$query->execute($sql);
$hotSearchList = array();

while ($row = $query->getRow())
{
	$hotSearchList[] = jieqi_query_rowvars($row);
}

$jieqiTpl->assign('hotSearch',$hotSearchList);

$jieqiTset["jieqi_contents_template"] = "./templates/searchKeyWordList.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");