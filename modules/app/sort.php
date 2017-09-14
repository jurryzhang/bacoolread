<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/29
 * Time: 下午4:49
 *
 * 小说分类接口
 *
 * 存在$sortID，则返回当前分类的书籍列表，否则返回全部分类列表
 *
 * 请求字段：page_num      ： 页码
 *         page_size     ： 一页中包含小说的数量
 *
 *         如果存在下面的字段，则是查看某一分类；
 *         不存在，则是获得分类列表
 *         sort_id       ： 分类ID
 *         sort_order_by ： 分类列表的排序规则。0：最新；1：最热；
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

jieqi_getconfigs('article','sort','jieqiSort');

if(isset($_REQUEST['sort_id']))
{
	$sortID = $_REQUEST['sort_id'];
	
	if(isset($_REQUEST['sort_order_by']))
	{
		$sortOrderBy = $_REQUEST['sort_order_by'] == 0 ? SORT_ORDER_BY_NEW : SORT_ORDER_BY_HOT;
	}
	else
	{
		$sortOrderBy = ARTICLE_SORT_ORDER_BY;
	}
}

if(!isset($sortOrderBy))
{
	$sortOrderBy = ARTICLE_SORT_ORDER_BY;
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

$sortList = array();

$errorMessage = '';

//存在$sortID，则返回当前分类的书籍列表，否则返回全部分类列表
if(isset($sortID))
{
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article') . " WHERE sortid = " . $sortID . "  AND display = 0" . "  ORDER BY ". $sortOrderBy . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
	
	$sortList = getArticleList($query,$sql);
	
	if($sortList == -1)
	{
		$errorMessage = '获取小说列表失败，请重试！';
	}
}
else
{
	foreach($jieqiSort['article'] as $key => $value)
	{
		$tmpSort = getFirstBookFormSort($key);
		
		$tmpSort['sortName']   = iconv('GBK','UTF-8',$value['caption']);
		
		$tmpSort['sortID'] = $key;
		
		$sql = 'SELECT COUNT(*) FROM ' . jieqi_dbprefix('article_article'). " WHERE sortid = " . $key;
		
		$result = $query->execute($sql);
		
		if($result)
		{
			$count = jieqi_query_rowvars($query->getRow());
			
			$tmpSort['articleCount'] = $count['COUNT(*)'];
			
			if($count['COUNT(*)'] != 0)
			{
				$sortList[] = $tmpSort;
			}
		}
		else
		{
			$errorMessage = '获取分类列表失败，请重试！';
		}
	}
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '获取分类成功！','result' => $sortList));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}
