<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/3/13
 * Time: 下午4:35
 *
 * 获取小说详情接口
 *
 * 请求字段：article_id ： 书籍id
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['article_id']))
{
	$articleID = $_REQUEST['article_id'];
}
else
{
	$errorMessage = '不存在该小说！';
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " WHERE articleid = " . $articleID;

$bookInfo = getArticleList($query,$sql);

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '获取小说详情成功！','result' => $bookInfo));;
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}