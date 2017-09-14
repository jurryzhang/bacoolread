<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/3
 * Time: 下午3:20
 *
 * 小说打赏和催更接口
 *
 * 请求字段：action       ： doTip/doHurry(打赏和催更)
 *         article_id   ： 小说id
 *         author_id    ： 作者id
 *         payegold     ： 支付金币
 *
 *         当action=doHurry时，需要以下字段
 *         word_sum     ： 催更字数
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['action']))
{
	$action = trim($_REQUEST['action']);
}
else
{
	$action = 'doTip';
}

if(isset($_REQUEST['author_id']))
{
	$authorID = trim($_REQUEST['author_id']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取信息失败！'));
	
	return;
}

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取信息失败！'));
	
	return;
}

if(isset($_REQUEST['payegold']))
{
	$payEglod = trim($_REQUEST['payegold']);
}
else
{
	$payEglod = 0;
}

if(isset($_REQUEST['word_sum']))
{
	$wordSum = trim($_REQUEST['word_sum']);
}
else
{
	$wordSum = 3000;
}

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
else
{
	if($userInfo['egold'] < $payEglod)
	{
		$errorMessage = USER_LACK_BALANCE_ERROR_MSG;
		
		$status       = USER_LACK_BALANCE_ERROR;
		
		echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
		
		return;
	}
}

//用户余额
$userBalance = $userInfo['egold'] - $payEglod;

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$errorMessage   = '';

$successMessage = '';

switch ($action)
{
	case 'doTip':
	{
		$status = checkOBookInfo($articleID);
		
		if($status == 1)
		{
			//先给作者打钱
			$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $payEglod . " WHERE uid = '" . $authorID . "'";
			
			$status = $query->execute($sql);
			
			if($status)
			{
				//扣除用户的钱
				$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $userID . "'";
				
				$status = $query->execute($sql);
				
				if($status)
				{
					//为小说打赏
					$sql = 'UPDATE ' . jieqi_dbprefix('obook_obook') . " SET sumtip = sumtip + '" . $payEglod . "' , sumemoney = sumemoney + '" . $payEglod . "' WHERE articleid = '" . $articleID . "'";
					
					$status = $query->execute($sql);
					
					if($status)
					{
						$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_obook') . " WHERE articleid = '" . $articleID . "'";
						
						$status = $query->execute($sql);
						
						$tmp    = jieqi_query_rowvars($query->getRow());
						
						$result['type'] = 'tip';//类型打赏
						
						$result['sum']  = $tmp['sumegold'] + $tmp['sumtip'] ? $tmp['sumegold'] + $tmp['sumtip'] : 0; //打赏总数
						
						$result['userbalance'] = $userBalance;
						
						/**
						 * 添加用户的打赏行为记录，2017-03-02
						 */
						//获取作者信息
						$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). ' WHERE uid=' . $authorID . ' LIMIT 1';
						
						$authorResult = mysql_query($sql);
						
						$authorInfo   = mysql_fetch_row($authorResult);
						
						$addTime      = time();
						
						$credit       = $payEglod * 10;
						
						$score        = $payEglod * 80;
						
						$bookName     = $tmp['obookname'];
						
						//添加用户的打赏行为记录，
						$sql = 'INSERT INTO `' . jieqi_dbprefix('article_actlog'). "` (`articleid`,`articlename`,`uid`,`uname`,`tid`,`tname`,`addtime`,`actname`,`actnum`,`islog`,`isvip`,`credit`,`score`,`egold`) VALUES ('" . $articleID . "', '" . $bookName . "', '" . $userID . "', '" . $userName . "', '" . $authorID . "', '" . $authorInfo[2] . "', '" . $addTime . "', '" . 'tip' . "', '" . $payEglod . "', '" . 1  . "', '" . $userInfo['isvip'] . "', '" . $credit . "', '" . $score . "', '" . $payEglod . "')";
						
						$status = $query->execute($sql);
						
						/**
						 * 添加用户的打赏行为记录完毕，2017-03-02
						 */
						
						//发送消息
						$message  = $userInfo['name'] . '打赏' . $payEglod . VIRLUAL_MONEY . "，感谢您的努力，希望后续更加精彩！";
						
						$message  = iconv('UTF-8',"GBK//IGNORE",$message);
						
						$fromName = iconv('UTF-8',"GBK//IGNORE",$userInfo['name']);
						
						$status  = sendMessage($message,$articleID,$userID,$fromName);
						
						$successMessage = '打赏小说成功！';
						
						$status         = 1;
						
					}
					else
					{
						//打赏失败，扣除给作者打赏的钱
						$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - '" . $payEglod . "' WHERE uid = '" . $authorID . "'";
						
						$query->execute($sql);
						
						//打赏失败，把打赏的钱还给用户
						$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $payEglod . " WHERE uid = '" . $userID . "'";
						
						$query->execute($sql);
						
						$errorMessage = '打赏小说失败，请重试！';
						
						$status       = 0;
					}
				}
				else
				{
					//打赏失败，扣除给作者打赏的钱
					$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $authorID . "'";
					
					$query->execute($sql);
					
					$errorMessage = '打赏小说失败，请重试！';
					
					$status       = 0;
				}
			}
			else
			{
				$errorMessage = '打赏小说失败，请重试！';
				
				$status       = 0;
			}
		}
		else
		{
			$errorMessage = '打赏小说失败，请重试！';
			
			$status       = 0;
		}
		
		break;
	}
	case 'doHurry':
	{
		$status = checkOBookInfo($articleID);
		
		//关闭催更，$status = 0;
		
		if($status == 1)
		{
			//先给作者打钱
			$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $payEglod . " WHERE uid = '" . $authorID . "'";
			
			$status = $query->execute($sql);
			
			if($status)
			{
				//扣除用户的钱
				$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $userID . "'";
				
				$status = $query->execute($sql);
				
				if($status)
				{
					//为小说催更
					$sql = 'UPDATE ' . jieqi_dbprefix('obook_obook') . " SET sumhurry = sumhurry + " . $payEglod . " , sumemoney = sumemoney + " . $payEglod . "  WHERE articleid = '" . $articleID . "'";
					
					$status = $query->execute($sql);
					
					if($status)
					{
						$sql = 'SELECT * FROM ' . jieqi_dbprefix('obook_obook') . " WHERE articleid = '" . $articleID . "'";
						
						$status = $query->execute($sql);
						
						$tmp    = jieqi_query_rowvars($query->getRow());
						
						$result['type'] = 'hurry';//类型打赏
						
						$result['sum']  = $tmp['sumhurry']? $tmp['sumhurry'] : 0;
						
						$result['userbalance'] = $userBalance;
						
						$obookid = $tmp['obookid'];
						
						$addTime  = time();
						
						$overTime = strtotime("+1 month");
						
						$bookName = $tmp['obookname'];
						
						$payFlag  = 0;
						
						$sql = 'INSERT INTO `' . jieqi_dbprefix('article_hurry'). "` (`articleid`,`vipid`,`articlename`,`uid`,`uname`,`payegold`,`minsize`,`addtime`,`overtime`,`payflag`) VALUES ('" . $articleID . "', '" . $obookid . "', '" . $bookName . "', '" . $userID . "', '" . $userName . "', '" . $payEglod . "', '" . $wordSum . "', '" . $addTime . "', '" . $overTime . "', '" . $payFlag. "')";
						
						$status = $query->execute($sql);
						
						/**
						 * 添加用户的催更行为记录，2017-03-02
						 */
						//获取作者信息
						$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). ' WHERE uid=' . $authorID . ' LIMIT 1';
						
						$authorResult = mysql_query($sql);
						
						$authorInfo   = mysql_fetch_row($authorResult);
						
						$credit       = $payEglod * 50;
						
						$score        = $payEglod * 100;
						
						//添加用户的催更行为记录，
						$sql = 'INSERT INTO `' . jieqi_dbprefix('article_actlog'). "` (`articleid`,`articlename`,`uid`,`uname`,`tid`,`tname`,`addtime`,`actname`,`actnum`,`islog`,`isvip`,`credit`,`score`,`egold`) VALUES ('" . $articleID . "', '" . $bookName . "', '" . $userID . "', '" . $userName . "', '" . $authorID . "', '" . $authorInfo[2] . "', '"  . $addTime . "', '" . 'hurry' . "', '" . $payEglod . "', '" . 1  . "', '" . $userInfo['isvip'] . "', '" . $credit . "', '" . $score . "', '" . $payEglod . "')";
						
						$status = $query->execute($sql);
						
						/**
						 * 添加用户的催更行为记录完毕，2017-03-02
						 */
						
						$bookName = iconv('GBK','UTF-8',$bookName);
						
						//发送消息
						$message = $userInfo['name']  . '支付了' . $payEglod . VIRLUAL_MONEY . "，催促" . $bookName . "尽快更新，" . "要求在" . date('Y-m-d  h:i:s',$overTime) . "前，更新" .  $wordSum . "以上！";
						
						$message  = iconv('UTF-8',"GBK//IGNORE",$message);
						
						$fromName = iconv('UTF-8',"GBK//IGNORE",$userInfo['name']);
						
						$status   = sendMessage($message,$articleID,$userID,$fromName);
						
						$successMessage = '催更小说成功！';
						
						$status         = 1;
					}
					else
					{
						//催更失败，扣除给作者催更的钱
						$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $authorID . "'";
						
						$query->execute($sql);
						
						//催更失败，把打赏的钱还给用户
						$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $payEglod . " WHERE uid = '" . $userID . "'";
						
						$query->execute($sql);
						
						$errorMessage = '催更小说失败，请重试！';
						
						$status       = 0;
					}
				}
				else
				{
					//催更失败，扣除给作者催更的钱
					$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $authorID . "'";
					
					$query->execute($sql);
					
					$errorMessage = '催更小说失败，请重试！';
					
					$status       = 0;
				}
			}
			else
			{
				$errorMessage = '催更小说失败，请重试！';
				
				$status       = 0;
			}
		}
		else
		{
			$errorMessage = '催更小说失败，请重试！';
			
			$status       = 0;
		}
		
		break;
	}
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => $successMessage,'result' => $result));;
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
	
	return;
}

return;