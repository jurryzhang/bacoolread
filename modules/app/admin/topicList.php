<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: ����7:11
 *
 * ר���б�
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//��ȡ���Ѵ�
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_topic');

$query->execute($sql);
$topicList = array();

while ($row = $query->getRow())
{
	$topicList[] = jieqi_query_rowvars($row);
}

$jieqiTpl->assign('topicList',$topicList);

$jieqiTset["jieqi_contents_template"] = "./templates/topicList.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");