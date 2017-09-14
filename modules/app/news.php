<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/31
 * Time: 上午11:36
 *
 * 小说广播接口
 *
 * 请求字段：page_num   ： 页码
 *         page_size  ： 一页中包含小说的数量
 *
 *         如果存在下面的字段，则是查看相应的新闻；
 *         不存在，则是获得新闻列表
 *         news_id    ： 存在的话就请求相应的新闻，否则的话就是获取新闻列表
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';
require_once './common/appConfigs.php';

if(isset($_REQUEST['news_id']))
{
	$newsID = $_REQUEST['news_id'];
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql   = '';

$errorMessage = '';

$newsList = array();

if(isset($newsID))
{
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('news_content'). " WHERE newsid = " . $newsID;
	
	$result = $query->execute($sql);
	
	if($result)
	{
		$tmp = jieqi_query_rowvars($query->getRow());
		
		$tmpNews['newsID']      = $newsID;
		
		$tmp['newscontent']     = iconv('GBK','UTF-8',$tmp['newscontent']);
		
		$newsContent            = html_entity_decode($tmp['newscontent']);
		
		$newsContent            = filterStr($newsContent);
		
		$tmpNews['newsContent'] = $newsContent;
		 
		$newsList               = $tmpNews;
	}
	else
	{
		$errorMessage = '查看新闻失败，请重试！';
	}
}
else
{
	$sql = 'SELECT * FROM ' . jieqi_dbprefix('news_topic'). " WHERE firstid = " . DEFAULT_NEWS_CATEGORY_ID . " AND newsstatus = 1 " . " ORDER BY `newsputtop` DESC ";
	
	$result = $query->execute($sql);

	if($result)
	{
		while ($row = $query->getRow())
		{
			$tmp = jieqi_query_rowvars($row);
			
			$tmpNews['newsID']    = $tmp['newsid'];
			
			$tmpNews['newsTitle'] = $tmp['newstitle'] ? iconv('GBK','UTF-8',$tmp['newstitle']) : '';
			
			$newsList[] = $tmpNews;
		}
	}
	else
	{
		$errorMessage = '查看新闻列表失败，请重试！';
	}
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
}
else
{
	echo json_encode_ex(array('status' => 1,'message' => '获取信息成功！','result' => $newsList));;
}

return;