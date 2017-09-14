<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 下午12:29
 *
 * 常见问题列表
 *
 */

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

jieqi_includedb();

//获取热搜词
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_questionandanswer');

$query->execute($sql);
$topicList = array();

while ($row = $query->getRow())
{
	$tmp = jieqi_query_rowvars($row);
	
	$tmp['time'] = date('Y-m-d h:i:s',$tmp['time']);
	
	$questionAndAnswerList[] = $tmp;
}

$jieqiTpl->assign('questionAndAnswerList',$questionAndAnswerList);

$jieqiTset["jieqi_contents_template"] = "./templates/questionAndAnswerList.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");