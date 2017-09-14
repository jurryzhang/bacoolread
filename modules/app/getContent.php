<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午2:24
 *
 * 获取小说章节内容接口
 *
 * 请求字段：article_id ： 小说id
 *         chapter_id ： 章节id
 *         is_ios     ： 0，不是ios设备；1：是ios设备
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

//if(isset($_REQUEST['is_ios']))
//{
//	$isIos = trim($_REQUEST['is_ios']);
//}
//else
//{
//	$isIos = 0;
//}

$status = 0;

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}
else
{
	$status = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => '获取书籍信息失败，请重试！'));
	
	return;
}

if(isset($_REQUEST['chapter_id']))
{
	$chapterID = trim($_REQUEST['chapter_id']);
}
else
{
	$status = 0;
	
	echo json_encode_ex(array('status' => $status,'message' => '获取章节内容信息失败，请重试！'));
	
	return;
}

if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != '' && isset($_COOKIE['user_name']) && $_COOKIE['user_name'] != '')
{
	$isLogin  = true;
	
	$userID   = $_COOKIE['user_id'];
	
	$userName = $_COOKIE['user_name'];
	
	$userInfo = checkLogin($userID,$userName);
}
else
{
	$isLogin  = false;
}

$errorMessage   = '';

$successMessage = '';

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql = "SELECT * FROM " . jieqi_dbprefix('article_chapter') ." WHERE articleid =  '" . $articleID . "' AND chapterid  = '" . $chapterID . "'";

$status = $query->execute($sql);

if($status)
{
	$tmp = jieqi_query_rowvars($query->getRow());
	
	if($tmp['isvip'] == '1' && !$isLogin)
	{
		$status       = -2;
		
		$errorMessage = 'vip章节需要购买后才可以阅读！';
	}
	else if($tmp['isvip'] == '1' && $isLogin)
	{
		$userOChapterList = getUserOChapter($articleID);//查找用户购买该书的vip章节信息
		
		if($userOChapterList[$chapterID])//已购买该章节
		{
			$content = getVipChapterContent($chapterID);
			
			$chapter['articleid']    = $articleID;
			
			$articleName             = iconv("GBK","UTF-8",$tmp['articlename']);
			
			$chapter['article']      = trim(filterStr($articleName));
			
			$chapter['chapterid']    = $tmp['chapterid'];
			
			$chapterName             = iconv("GBK","UTF-8",$tmp['chaptername']);
			
			$chapter['chaptertitle'] = trim(filterStr($chapterName));
			
			$chapter['size']         = $content['size'];
			
			$summary                 = iconv("GBK","UTF-8",$tmp['summary']);
			
			$chapter['summary']      = trim(filterStr($summary));
			
			$chapter['content']      = $content['content'];
			
			$result                  = $chapter;
			
			$status                  = 1;
			
			$successMessage          = '获取章节内容成功';
		}
		else
		{
			$autoBuyStatus = checkUserAutoBuyInfo($articleID);
			
			switch ($autoBuyStatus)
			{
				case 1://自动购买
				{
					$userBalance = intval($userInfo['egold']) -  intval($tmp['saleprice']);
					
					if($userBalance >= 0)
					{
						$autoBuyStatus = autoBuyOChapter($articleID,$tmp['articlename'],$tmp['chapterid'],$tmp['chaptername'],$tmp['saleprice'],$tmp['posterid'],is);
						
						switch ($autoBuyStatus)
						{
							case 1 :
							{
								$content = getVipChapterContent($chapterID);
								
								$chapter['articleid']    = $articleID;
								
								$articleName             = iconv("GBK","UTF-8",$tmp['articlename']);
								
								$chapter['article']      = trim(filterStr($articleName));
								
								$chapter['chapterid']    = $tmp['chapterid'];
								
								$chapterName             = iconv("GBK","UTF-8",$tmp['chaptername']);
								
								$chapter['chaptertitle'] = trim(filterStr($chapterName));
								
								$chapter['size']         = $content['size'];
								
								$summary                 = iconv("GBK","UTF-8",$tmp['summary']);
								
								$chapter['summary']      = trim(filterStr($summary));
								
								$chapter['content']      = $content['content'];
								
								$chapter['userbalance']  = intval($userInfo['egold']) -  intval($tmp['saleprice']);
								
								$result                  = $chapter;
								
								$status                  = 1;
								
								$successMessage          = '自动购买章节成功';
								
								break;
							}
							case 0:
							{
								$status       = -1;
								
								$errorMessage = '用户信息获取失败，请重试！';
								
								break;
							}
							case -1:
							{
								$status       = USER_LACK_BALANCE_ERROR;
								
								$errorMessage = USER_LACK_BALANCE_ERROR_MSG;
								
								break;
							}
						}
					}
					else
					{
						$status       = USER_LACK_BALANCE_ERROR;
						
						$errorMessage = USER_LACK_BALANCE_ERROR_MSG;
					}
					
					break;
				}
				default ://不是自动购买
				{
					$status       = -2;
					
					$errorMessage = 'vip章节需要购买后才可以阅读！';
					
					break;
				}
			}
		}
	}
	else if($tmp['isvip'] == '0')
	{
		$content = getArticleFreeContent($articleID,$chapterID);
		
		$chapter['articleid']    = $articleID;
		
		$articleName             = iconv("GBK","UTF-8",$tmp['articlename']);
		
		$chapter['article']      = trim(filterStr($articleName));
		
		$chapter['chapterid']    = $tmp['chapterid'];
		
		$chapterName             = iconv("GBK","UTF-8",$tmp['chaptername']);
		
		$chapter['chaptertitle'] = trim(filterStr($chapterName));
		
		$chapter['size']         = $content['size'];
		
		$summary                 = iconv("GBK","UTF-8",$tmp['summary']);
		
		$chapter['summary']      = trim(filterStr($summary));
		
		$chapter['content']      = $content['content'];
		
		$result                  = $chapter;
		
		$status                  = 1;
		
		$successMessage          = '获取章节成功';
	}
}
else
{
	$status       = 0;
	
	$errorMessage = '获取章节内容信息失败，请重试！';
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $successMessage,'reslut' => $result));
	
	return;
}