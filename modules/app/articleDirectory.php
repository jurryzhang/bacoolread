<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/7
 * Time: 上午10:16
 *
 * 获取小说章节目录接口
 *
 * 请求字段：article_id  ： 小说id
 *         is_request  ： 是否强制请求数据，0，不请求；1：请求
 *         is_ios      ： 0，不是ios设备；1：是ios设备
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

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取书籍信息失败，请重试！'));
	
	return;
}

if(isset($_REQUEST['is_request']))
{
	$request = intval(trim($_REQUEST['is_request']));
}
else
{
	$request = 0;
}

$userID   = $_COOKIE['user_id'];

$userName = $_COOKIE['user_name'];

$userInfo = checkLogin($userID,$userName);

switch ($userInfo)
{
	case -1://查询失败
	case -2://没有该用户
	{
		break;
	}
	default :
	{
		$userOChapterList = getUserOChapter($articleID);//查找用户购买该书的vip章节信息
		
		break;
	}
}
	
if($errorMessage)
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$errorMessage   = '';

$successMessage = '';

$sql = "SELECT * FROM " . jieqi_dbprefix('article_chapter') ." WHERE articleid =  '" . $articleID . "' ORDER BY `chapterorder` ASC";

$status = $query->execute($sql);

$chapterList = array();

if($status)
{
	while ($row = $query->getRow())
	{
		$tmpChapter = jieqi_query_rowvars($row);
		
		$chapter['articleid'] = $articleID;
		
		$chapter['chapterid'] = $tmpChapter['chapterid'];
		
		$chapterName          = iconv("GBK","UTF-8",$tmpChapter['chaptername']);
		
		$chapterName          = filterStr($chapterName);
		
		$chapter['chapter']   = $chapterName;
		
		$chapter['size']      = $tmpChapter['size'];
		
		$chapter['isvip']     = $tmpChapter['isvip'];
		
		$chapter['summary']   = iconv("GBK","UTF-8",$tmpChapter['summary']);
		
		$chapter['summary']   = trim(filterStr($chapter['summary']));
		
		if($chapter['isvip'] == '0')
		{
			$chapter['isbuy'] = 1;
		}
		else
		{
			if($userOChapterList[$chapter['chapterid']])
			{
				$chapter['isbuy'] = 1;
			}
			else
			{
				$chapter['isbuy'] = 0;
			}
		}
		
		$chapterList[] = $chapter;
	}
	
	$successMessage = '获取章节列表成功！';
	
	if($request == 0)
	{
		if(file_exists(CACHE_FILE_PATH . $userID . $articleID . '$chapterList.php'))
		{
			include(CACHE_FILE_PATH . $userID . $articleID . '$chapterList.php');
			
			if($tmpChapterList != $chapterList)
			{
				cacheFile($chapterList,'$tmpChapterList',$articleID . '$chapterList');
				
				$result = $chapterList;
				
				$status = 1;//更新书架
			}
			else
			{
				$status = 2;//不更新书架
			}
		}
		else
		{
			cacheFile($chapterList,'$tmpChapterList',$articleID . '$chapterList');
			
			$result = $chapterList;
			
			$status = 1;
		}
	}
	else
	{
		cacheFile($chapterList,'$tmpChapterList',$articleID . '$chapterList');
		
		$result = $chapterList;
		
		$status = 1;
	}
}
else
{
	$errorMessage = '获取章节列表失败，请重试！';
}

if(!$errorMessage)
{
	if($status == 1)
	{
		echo json_encode_ex(array('status' => 1,'message' => $successMessage,'result' => $result));
		
		return;
	}
	else if($status == 2)
	{
		echo json_encode_ex(array('status' => 2,'message' => $successMessage));
		
		return;
	}
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}