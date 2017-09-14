<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/29
 * Time: 下午6:29
 *
 * 小说专题接口
 *
 * 请求字段：page_num       ： 页码
 *         page_size      ： 一页中包含小说的数量
 *
 *         如果存在下面的字段，则是查看某一专题；
 *         不存在，则是获得专题列表
 *         topic_id       ： 专题真实id
 *         topic_name     ： 显示id
 *         topic_order_by ： 专题列表的排序规则
 *         books_id       ： 获取专题中的小说列表
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['topic_id']))
{
	$sortID = $_REQUEST['topic_id'];
	
	if(isset($_REQUEST['topic_order_by']))
	{
		$topicOrderBy = $_REQUEST['topic_order_by'];
	}
	else
	{
		$topicOrderBy = TOPIC_SORT_ORDER_BY;
	}
}

if(isset($_REQUEST['books_id']))
{
	$booksID = explode('|',trim($_REQUEST['books_id']));
}

if(!isset($topicOrderBy))
{
	$topicOrderBy = TOPIC_SORT_ORDER_BY;
}

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

$topicList = array();

$errorMessage = '';

//存在$sortID，则返回当前分类的书籍列表，否则返回全部分类列表
if(isset($booksID))
{
	$topicList = getArticleListFromIDArray($booksID);
	
	if($topicList == -1)
	{
		$errorMessage = '获取小说列表失败，请重试！';
	}
}
else
{
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_topic') . " ORDER BY " . $topicOrderBy . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
	
	$res = $query->execute($sql);
	
	if($res)
	{
		while ($row = $query->getRow())
		{
			$tmp = jieqi_query_rowvars($row);
			
			$tmpTopic['id']      = $tmp['id'];
			
			$tmpTopic['topicID'] = $tmp['topicID'];
			
			$tmpTopic['title']   = iconv('GBK','UTF-8',$tmp['title']);
			
			$tmpTopic['summary'] = iconv('GBK','UTF-8',$tmp['summary']);
			
			$tmpTopic['booksID'] = $tmp['booksID'];
			
			$tmpTopic['cover']   = $tmp['cover'];
			
			$topicList[] = $tmpTopic;
		}
	}
	else
	{
		$errorMessage = '获取专题列表失败，请重试！';
	}
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '获取专题列表成功！','result' => $topicList));;
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}