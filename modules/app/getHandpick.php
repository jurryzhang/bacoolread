<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/3/14
 * Time: 上午10:23
 *
 * 小程序获取首页数据
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

$channelID = 0;

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
			$hotCommend['showID']      = $value['showID'];
			
			$hotCommend['title']       = $value['title'];
			
			$hotCommen['channelID']    = $value['channelID'];
			
			$hotCommend['articleList'] = $articleList;
			
			$hotCommendList[] = $hotCommend;
		}
	}
	
	$resultHotCommendList['handpick'] = $hotCommendList;
	
	$bannerList = getSlideBannerArticleList($channelID);
	
	if($bannerList != -1)
	{
		$resultHotCommendList['slidebanner'] = getSlideBannerArticleList($channelID);
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
	echo json_encode_ex(array('status' => 1,'message' => '获取热推书籍成功！','result' => $resultHotCommendList));;
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}