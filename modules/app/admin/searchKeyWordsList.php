<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: ����7:11
 *
 * ���Ѵ�����
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//��ȡ���Ѵ�
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