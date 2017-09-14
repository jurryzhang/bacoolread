<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/29
 * Time: 下午9:01
 *
 * 小说热推书接口
 *
 * 请求字段：page_num       ： 页码
 *         page_size      ： 一页中包含小说的数量
 *         channel_id     ： 频道id，0：首页；1：男频；2：女频
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['channel_id']))
{
	$channelID = $_REQUEST['channel_id'];
}
else
{
	$channelID = 0;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$hotCommendList = array();

$errorMessage = '';

$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotcommend') . " WHERE channel = " . $channelID .  " ORDER BY `showID` ASC ";

$res = $query->execute($sql);

if($res)
{
	while ($row = $query->getRow())
	{
		$tmp = jieqi_query_rowvars($row);
		
		$tmpHotCommend['id']        = $tmp['id'];
		
		$tmpHotCommend['showID']    = $tmp['showID'];
		
		$tmpHotCommend['title']     = iconv('GBK','UTF-8',$tmp['title']);
		
		$tmpHotCommend['booksID']   = $tmp['booksID'];
		
		$tmpHotCommend['channelID'] = $channelID;
		
		$tmpHotCommendList[$tmpHotCommend['showID']] = $tmpHotCommend;
	}
	
	foreach($tmpHotCommendList as $key => $value)
	{
		$booksID = explode('|',$value['booksID']);
		
		$articleList = getArticleListFromIDArray($booksID);
		
		if($articleList == -1)
		{
			$errorMessage = '获取热推书籍失败，请重试！';
		}
		else
		{
			$hotCommendList[$key]['showID']      = $value['showID'];
			
			$hotCommendList[$key]['title']       = $value['title'];
			
			$hotCommendList[$key]['channelID']   = $value['channelID'];
			
			$hotCommendList[$key]['articleList'] = $articleList;
		}
	}
	
	$bannerList = getSlideBannerArticleList($channelID);
	
	if($bannerList != -1)
	{
		$hotCommendList[0]['showID']      = 0;
		
		$hotCommendList[0]['title']       = 'slideBanner';
		
		$hotCommendList[0]['channelID']   = $channelID;
		
		$hotCommendList[0]['articleList'] = getSlideBannerArticleList($channelID);
	}
	else
	{
		$errorMessage = '获取频道轮播图失败，请重试！';
	}
}
else
{
	$errorMessage = '获取热推书籍失败，请重试！';
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '获取热推书籍成功！','result' => $hotCommendList));;
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}