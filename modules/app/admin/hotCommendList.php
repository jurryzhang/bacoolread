<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: ����7:14
 *
 * ����������
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//��ȡ���Ѵ�
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotcommend');

$query->execute($sql);
$hotCommendList = array();

while ($row = $query->getRow())
{
	$hotCommendList[] = jieqi_query_rowvars($row);
}

$jieqiTpl->assign('hotCommendList',$hotCommendList);

$jieqiTset["jieqi_contents_template"] = "./templates/hotCommendList.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");
