<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 上午11:14
 *
 * 意见反馈
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//获取热搜词
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

if($_REQUEST['action'] ==  'delete')
{
	$id = trim($_REQUEST['id']);
	
	$sql = 'DELETE FROM ' . jieqi_dbprefix('app_feedback') . ' WHERE 	id = ' . $id;
	
	$query->execute($sql);
}

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_feedback');

$query->execute($sql);
$hotCommendList = array();

while ($row = $query->getRow())
{
	$tmp = jieqi_query_rowvars($row);
	
	$tmp['time'] = date('Y-m-d h:i:s',$tmp['time']);
	
	$feedbackList[] = $tmp;
}

$jieqiTpl->assign('feedbackList',$feedbackList);

$jieqiTset["jieqi_contents_template"] = "./templates/feedbackList.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");