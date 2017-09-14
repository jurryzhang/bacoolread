<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/2
 * Time: 下午4:44
 *
 * 小说书架接口
 *
 * 请求字段：is_ios     ： 0，不是ios设备；1：是ios设备
 *
 *         如果存在下面的字段，则是将该小说放到书架上；
 *         不存在则是查看整个书架
 *         article_id   ： 小说id
 *         article_name ： 小说名
 *         chapter_id   ： 章节id
 *         chapter_name ： 章节名称
 *
 *         如果存在下面的字段，则是将从书架上删除该小说；
 *         bookcase_id  ： 书架id
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

$errorMessage   = '';

$successMessage = '';

$userID   = $_COOKIE['user_id'];

$userName = $_COOKIE['user_name'];

$userInfo = checkLogin($userID,$userName);

switch ($userInfo)
{
	case -1://查询失败
	{
		$errorMessage = USER_QUERY_ERROR_MSG;
		
		$status       = USER_QUERY_ERROR;
		
		break;
	}
	case -2://没有该用户
	{
		$errorMessage = USER_LOGIN_ERROR_MSG;

		$status       = USER_LOGIN_ERROR;
		
		break;
	}
	default :
	{
		break;
	}
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}

if(isset($_REQUEST['bookcase_id']))
{
	$bookcaseID = trim($_REQUEST['bookcase_id']);
}

if(isset($_REQUEST['article_name']))
{
	$articleName = trim($_REQUEST['article_name']);
	
	$articleName = iconv('UTF-8','GBK//IGNORE',$articleName);
}

if(isset($_REQUEST['chapter_id']))
{
	$chapterID = trim($_REQUEST['chapter_id']);
}
else
{
	$chapterID = 0;
}

if(isset($_REQUEST['chapter_name']))
{
	$chapterName = trim($_REQUEST['chapter_name']);
}
else
{
	$chapterName = '';
}

if(isset($_REQUEST['bookcase_id']))
{
	$bookCaseID = trim($_REQUEST['bookcase_id']);
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

if(isset($bookCaseID))
{
	$sql = "DELETE FROM `" . jieqi_dbprefix('article_bookcase') . "` WHERE caseid = '" . $bookCaseID . "'";
	
	$status = $status = $query->execute($sql);
	
	if(!$status)
	{
		$errorMessage = '删除失败，请重试！';
		
		$status       = 0;
	}
	else
	{
		$sql    = 'SELECT * FROM ' . jieqi_dbprefix('article_bookcase') . " WHERE userid = '" . $userID . "' AND username = '" . $userName . "' ORDER BY `lastvisit` DESC";
		
		$status = $status = $query->execute($sql);
		
		if($status)
		{
			$bookIDArray = array();
			
			while ($row = $query->getRow())
			{
				$bookCase = jieqi_query_rowvars($row);
				
				$bookIDArray[] = $bookCase['articleid'];
				
				$bookCaseList[$bookCase['caseid']] = $bookCase['articleid'];
			}
			
			//获取书架书籍列表
			$articleList  = getArticleListFromIDArray($bookIDArray);
			
			//添加bookcaseid字段
			$bookCaseList = addBookCaseIDInArticleList($bookCaseList,$articleList);
			
			$successMessage = '删除小说成功！';
			
			$status         = 1;
		}
		else
		{
			$errorMessage = '删除小说成功，请求书架失败，请重试！';
			
			$status       = 0;
		}
	}
}
else
{
	//存在$articleID，则是加入到书架，否则是查看书架
	if(isset($articleID))
	{
		$bookCaseStatus = checkAticleInBookCase($articleID);
		
		switch ($bookCaseStatus)
		{
			case -2://查询失败，不能添加到书架
			{
				$errorMessage = '查询失败，不能添加到书架！';
				
				$status       = 0;
				
				break;
			}
			case -1://请先登录
			{
				$errorMessage = USER_LOGIN_ERROR_MSG;
				
				$status       = USER_LOGIN_ERROR;
				
				break;
			}
			case 0://存在该书，不要重复添加
			{
				$errorMessage = '存在该书，不要重复添加！';
				
				$status       = 0;
				
				break;
			}
			case 1:
			{
				$time = time();
				
				$sql = 'INSERT INTO `' . jieqi_dbprefix('article_bookcase'). "` (`userid`,`username`,`articleid`,`articlename`,`chapterid`,`chaptername`,`joindate`,`lastvisit`) VALUES ('" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $articleName . "', '" . $chapterID . "', '" . $chapterName . "', '" . $time . "', '" . $time . "')";
				
				$status = $query->execute($sql);
				
				if(!$status)
				{
					$errorMessage = '添加书架失败，请重试！';

					$status       = 0;
				}
				else
				{
					$resBookcaseID    = mysql_insert_id();
					
					$userOChapterList = getUserOChapter($articleID);//查找用户购买该书的vip章节信息
					
					$sql = "SELECT * FROM " . jieqi_dbprefix('article_chapter') ." WHERE articleid =  '" . $articleID . "' ORDER BY `chapterid` ASC";
					
					$status = $query->execute($sql);
					
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
					
					$bookCaseList['bookcaseid']  = $resBookcaseID;
					
					$bookCaseList['chapterlist'] = $chapterList;
					
					$successMessage = '添加书架成功！';
					
					$status         = 1;
				}
				
				break;
			}
		}
	}
	else
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_bookcase') . " WHERE userid = '" . $userID . "' ORDER BY `lastvisit` DESC";
		
		$status = $status = $query->execute($sql);
		
		if($status)
		{
			$bookIDArray = array();
			
			while ($row = $query->getRow())
			{
				$bookCase = jieqi_query_rowvars($row);
				
				$bookIDArray[] = $bookCase['articleid'];
				
				$bookCaseList[$bookCase['caseid']] = $bookCase['articleid'];
			}
			
			//获取书架书籍列表
			$articleList  = getArticleListFromIDArray($bookIDArray);
			
			//添加bookcaseid字段
			$bookCaseList = addBookCaseIDInArticleList($bookCaseList,$articleList);
			
			$successMessage = '获取书架成功！';
			
			$status         = 1;
		}
		else
		{
			$errorMessage = '请求书架失败，请重试！';
			
			$status       = 0;
		}
	}
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
}
else
{
	if(empty($bookCaseList))
	{
		echo json_encode_ex(array('status' => $status,'message' => $successMessage));
	}
	else
	{
		echo json_encode_ex(array('status' => $status,'message' => $successMessage,'result' => $bookCaseList));
	}
}