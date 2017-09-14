<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/2
 * Time: 下午8:13
 *
 * 小说评论接口
 *
 * 请求字段：action       ： getReplyList/addReply
 *         article_id   ： 小说id
 *         page_num     ： 页码
 *         page_size    ： 一页中包含小说的数量
 *
 *         如果存在下面的字段，则是将添加评论；
 *         from_id      ： 发送消息的id
 *         from_name    ： 发送消息的名称
 *         content      ： 消息内容
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}

if(isset($_REQUEST['action']))
{
	$action = trim($_REQUEST['action']);
}
else
{
	$action = 'getReplyList';
}

if(isset($_REQUEST['from_id']))
{
	$fromID = trim($_REQUEST['from_id']);
}
else
{
	$fromID = $_COOKIE['user_id'];
}

if(isset($_REQUEST['from_name']))
{
	$fromName = trim($_REQUEST['from_name']);
}
else
{
	$fromName = $_COOKIE['user_name'];
}

$userInfo = checkLogin($fromID,$fromName);

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
		$fromID   = $userInfo['uid'];
		
		$fromName = $userInfo['name'];
		
		break;
	}
}

if(isset($_REQUEST['content']))
{
	$content = iconv('UTF-8','GBK//IGNORE',trim($_REQUEST['content']));
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

$errorMessage   = '';

$successMessage = '';

$reList = array();

if($action == 'getReplyList')
{
	$sql   =  'SELECT COUNT(*) FROM ' . jieqi_dbprefix('article_replies'). " WHERE ownerid = '" . $articleID . "'";
	
	$result = $query->execute($sql);
	
	if($result)
	{
		$tmpReplyCount = jieqi_query_rowvars($row = $query->getRow());
		
		$repliesCount = $tmpReplyCount['COUNT(*)'];
		
		$sql   =  'SELECT * FROM ' . jieqi_dbprefix('article_replies'). " WHERE ownerid = '" . $articleID . "' ORDER BY `posttime` DESC" . " LIMIT " . $pageNum * $pageSize . " , " . $pageSize;
		
		$result = $query->execute($sql);
		
		if($result)
		{
			while ($row = $query->getRow())
			{
				$tmpReply = jieqi_query_rowvars($row);
				
				$reply['fromid']   = $tmpReply['posterid'] ? $tmpReply['posterid'] : '';
				
				$reply['fromname'] = $tmpReply['poster'] ? $tmpReply['poster'] : '';
				
				$reply['fromname'] = iconv("GBK","UTF-8",$reply['fromname']);
				
				$reply['posttime'] = date('Y-m-d',$tmpReply['posttime']);
				
				$reply['content']  = iconv('GBK','UTF-8',$tmpReply['subject']);
				
				$reply['content']  = filterStr($reply['content']);
				
				$reply['postip']   = $tmpReply['posterip'];
				
				$tmpReList[] = $reply;
			}
			
			foreach($tmpReList as $key => $value)
			{
				$tmpReList[$key]['faceimg'] = getUserFaceImg($value['fromid']);
			}
			
			$reList['repliescount'] = $repliesCount;
			
			$reList['replies']      = $tmpReList ? $tmpReList : array();
			
			$successMessage = '获取评论成功！';
			
			$status         = 1;
		}
		else
		{
			$errorMessage = '获取评论失败！';
			
			$status         = 0;
		}
	}
	else
	{
		$errorMessage = '获取评论失败！';
		
		$status         = 0;
	}
}
else if($action == 'addReply')
{
	if($errorMessage)
	{
		echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
		
		return;
	}
	
	if(isset($content))
	{
		$time = time();
		
		$ip   = getIp();
		
		$size = strlen($content);
		
		$tmpLastInfo['time']  = $time;
		
		$tmpLastInfo['uid']   = $fromID;
		
		$tmpLastInfo['uname'] = $fromName;
		
		$fromName = iconv('UTF-8','GBK//IGNORE',$fromName);
		
		$lastInfo = serialize($tmpLastInfo);
		
		$status   = queryReplyInterval($query,$time,$fromID);
		
		switch ($status)
		{
			case 1:
			{
				break;
			}
			case -1:
			{
				$errorMessage = '时间间隔小于120秒！';
				
				$status       = 0;
				
				echo json_encode_ex(array('status' => $status,'message' => $errorMessage));

				return;
			}
			case -2:
			{
				$errorMessage = '获取评论失败，请重试！';
				
				$status       = 0;
				
				echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
				
				return;
			}
		}
		
		//先插入jieqi_article_reviews
		$sql = 'INSERT INTO `' . jieqi_dbprefix('article_reviews'). "` (`ownerid`,`title`,`posterid`,`poster`,`posttime`,`replier`,`replytime`,`lastinfo`) VALUES ('" . $articleID . "', '" . $content . "', '" . $fromID . "', '" . $fromName . "', '" . $time . "', '" . $fromName . "', '" . $time . "', '" . $lastInfo . "')";
		
		$result  = $query->execute($sql);
		
		$topicid = mysql_insert_id();//用户名id
		
		if($result)
		{
			$isTopic = 1;
			
			$sql = 'INSERT INTO `' . jieqi_dbprefix('article_replies'). "` (`topicid`,`istopic`,`posterid`,`poster`,`posterip`,`ownerid`,`posttime`,`edittime`,`subject`,`posttext`,`size`) VALUES ('" . $topicid . "', '" . $isTopic . "', '" . $fromID . "', '" . $fromName . "', '" . $ip . "', '" . $articleID . "', '" . $time . "', '" . $time . "', '" . $content . "', '" . $content . "', '" . $size . "')";
			
			$result = $query->execute($sql);
			
			if(!$result)
			{
				$errorMessage = '添加评论失败！';
				
				$status       = 0;
			}
			else
			{
				$successMessage = '添加评论成功！';
				
				$status         = 1;
				
				$sql   = 'UPDATE ' . jieqi_dbprefix('article_article'). " SET reviewsnum = reviewsnum + 1 WHERE articleid = '" . $articleID . "'";
				$query->execute($sql);
			}
		}
		else
		{
			$errorMessage = '添加评论失败！';
			
			$status       = 0;
		}
	}
	else
	{
		$errorMessage = '评论不能为空！';
		
		$status       = 0;
	}
}

if($errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
}
else
{
	if($action != 'addReply')
	{
		echo json_encode_ex(array('status' => $status,'message' => $successMessage,'result' => $reList));
	}
	else
	{
		echo json_encode_ex(array('status' => $status,'message' => $successMessage));
	}
	
}

return;