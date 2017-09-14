<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/30
 * Time: 上午10:20
 *
 * 小说热搜词接口
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotsearchword');
$hotSearchKeyWordList = array();

$result = $query->execute($sql);

if($result)
{
	$tmpArticleList  = array();
	
	$articleIDArray = array();//存储articleID，用来查找打上记录
	
	while ($row = $query->getRow())
	{
		$tmpBook = jieqi_query_rowvars($row);
		
		$articleIDArray[] = $tmpBook['bookID'];
	}
	
	$hotSearchKeyWordList = getArticleListFromIDArray($articleIDArray);
}
else
{
	$errorMessage = '获取热搜词失败，请重试！';
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => 1,'message' => '获取热搜词成功！','result' => $hotSearchKeyWordList));;
}

return;