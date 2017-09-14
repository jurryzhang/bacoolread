<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/31
 * Time: 上午10:34
 *
 * 小说排行榜接口
 *
 * 四个排行榜：推荐，最新，订阅，点击
 *
 * 请求字段：
 *         如果是分类请求
 *         ranking_list_id  ： 排行榜id，0：推荐；1：点击；2：热销；3：最新；
 *         page_num         ： 页码
 *         page_size        ： 一页中包含小说的数量
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['ranking_list_id']))
{
	$rankingListID = $_REQUEST['ranking_list_id'];
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

$sql          = '';

$errorMessage = '';

$rankingList  = array();

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

if(isset($rankingListID))
{
	switch ($rankingListID)
	{
		case 0:
		{
			$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " ORDER BY ". RANKING_LIST_ORDER_BY_0 . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
			
			$rankingList['rankingListID'] = '0';
			
			$rankingList['title'] = RANKING_LIST_TITLE_0;
			
			break;
		}
		case 1:
		{
			$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " ORDER BY ". RANKING_LIST_ORDER_BY_1 . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
			
			$rankingList['rankingListID'] = '1';
			
			$rankingList['title'] = RANKING_LIST_TITLE_1;
			
			break;
		}
		case 2:
		{
			$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " ORDER BY ". RANKING_LIST_ORDER_BY_2 . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
			
			$rankingList['rankingListID'] = '2';
			
			$rankingList['title'] = RANKING_LIST_TITLE_2;
			
			break;
		}
		case 3:
		{
			$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " ORDER BY ". RANKING_LIST_ORDER_BY_3 . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
			
			$rankingList['rankingListID'] = '3';
			
			$rankingList['title'] = RANKING_LIST_TITLE_3;
			
			break;
		}
	}
	
	$rankingList['articleList'] = getArticleList($query,$sql);
	
}
else
{
	for($i = 0; $i < 4;$i++)
	{
		switch ($i)
		{
			case 0:
			{
				$orderBy      = RANKING_LIST_ORDER_BY_0;
				
				$rankingTitle = RANKING_LIST_TITLE_0;
				
				break;
			}
			case 1:
			{
				$orderBy      = RANKING_LIST_ORDER_BY_1;
				
				$rankingTitle = RANKING_LIST_TITLE_1;
				
				break;
			}
			case 2:
			{
				$orderBy      = RANKING_LIST_ORDER_BY_2;
				
				$rankingTitle = RANKING_LIST_TITLE_2;
				
				break;
			}
			case 3:
			{
				$orderBy      = RANKING_LIST_ORDER_BY_3;
				
				$rankingTitle = RANKING_LIST_TITLE_3;
				
				break;
			}
		}
		
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article'). " ORDER BY ". $orderBy . " LIMIT 0, 5";
		
		$ranking['rankingListID'] = $i;
		
		$ranking['title']         = $rankingTitle;
		
		$ranking['articleList']   = getArticleList($query,$sql);
		
		$rankingList[]            = $ranking;
	}
}

if($searchList == -1)
{
	$errorMessage = '获取排行榜失败，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => 1,'message' => '获取信息成功！','result' => $rankingList));;
}

return;