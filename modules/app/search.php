<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/28
 * Time: 下午5:40
 *
 * 小说搜索接口
 *
 * 请求字段：search_key ： 搜索关键字
 *         page_num   ： 页码
 *         page_size  ： 一页中包含小说的数量
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

$searchKey = trim($_REQUEST['search_key']);
	
$searchKey = iconv('UTF-8','GBK//IGNORE',$searchKey);

if(isset($_REQUEST['page_num']))
{
	$pageNum = $_REQUEST['page_num'];
}
else
{
	$pageNum = DEFAULT_START_PAGE_NUM;
}

if(isset($_REQUEST['page_size']))
{
	$pageSize = $_REQUEST['page_size'];
}
else
{
	$pageSize = DEFAULT_PAGE_SIZE;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " WHERE articlename LIKE '%" . $searchKey . "%' OR author LIKE '%" . $searchKey . "%' ORDER BY ". ARTICLE_SORT_ORDER_BY . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;

$searchList = getArticleList($query,$sql);

$errorMessage = '';

if($searchList == -1)
{
	$errorMessage = '获取搜索列表失败，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => 1,'message' => '获取信息成功！','result' => $searchList));;
}

return;

