<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/4
 * Time: 下午6:05
 *
 * 小说赠送道具接口
 *
 * 请求字段：article_id   ： 小说id
 *         author_id    ： 作者id
 *         type         ： 道具类型；0：鲜花；1：红包；2：美酒；3：香囊；4：钻石；5：超跑；6：皇冠；
 *         num          ： 赠送道具个数
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['author_id']))
{
	$authorID = trim($_REQUEST['author_id']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取作者信息失败！'));
	
	return;
}

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '获取书籍信息失败！'));
	
	return;
}



if(isset($_REQUEST['num']))
{
	$num = trim($_REQUEST['num']);
}
else
{
	$num = 0;
}

//关闭道具，type字段改为type_test

if(isset($_REQUEST['type']))
{
	$type = trim($_REQUEST['type']);
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => '请提交道具类型！'));
	
	return;
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

jieqi_getconfigs('article','configs','jieqiConfigs');

//获取道具单价
$redrosePrice    = intval($jieqiConfigs['article']['redrose']);//红包
$yellowrosePrice = intval($jieqiConfigs['article']['yellowrose']);//美酒
$bluerosePrice   = intval($jieqiConfigs['article']['bluerose']);//香囊
$whiterosePrice  = intval($jieqiConfigs['article']['whiterose']);//钻石
$blackrosePrice  = intval($jieqiConfigs['article']['blackrose']);//超跑
$greenrosePrice  = intval($jieqiConfigs['article']['greenrose']);//皇冠
$flowerPrice     = intval($jieqiConfigs['article']['flower']);//鲜花

switch ($type)
{
	case 0://鲜花
	{
		$message  = sprintf("%s对小说打赏了%s束鲜花",$userInfo['name'],$num);
		
		$payEglod = $num * $flowerPrice;
		
		$field    = 'allflower';
		
		break;
	}
	case 1://红包
	{
		$message  = sprintf("%s对小说打赏了%s个红包",$userInfo['name'],$num);
		
		$payEglod = $num * $redrosePrice;
		
		$field    = 'redrose';
		
		break;
	}
	case 2://美酒
	{
		$message  = sprintf("%s对小说打赏了%s杯美酒",$userInfo['name'],$num);
		
		$payEglod = $num * $yellowrosePrice;
		
		$field    = 'yellowrose';
		
		break;
	}
	case 3://香囊
	{
		$message  = sprintf("%s对小说打赏了%s个香囊",$userInfo['name'],$num);
		
		$payEglod = $num * $bluerosePrice;
		
		$field    = 'bluerose';
		
		break;
	}
	case 4://钻石
	{
		$message  = sprintf("%s对小说打赏了%s颗钻石",$userInfo['name'],$num);
		
		$payEglod = $num * $whiterosePrice;
		
		$field    = 'whiterose';
		
		break;
	}
	case 5://超跑
	{
		$message  = sprintf("%s对小说打赏了%s辆超跑",$userInfo['name'],$num);
		
		$payEglod = $num * $blackrosePrice;
		
		$field    = 'blackrose';
		
		break;
	}
	case 6://皇冠
	{
		$message  = sprintf("%s对小说打赏了%s顶皇冠",$userInfo['name'],$num);
		
		$payEglod = $num * $greenrosePrice;
		
		$field    = 'greenrose';
		
		break;
	}
}

if($userInfo['egold'] < $payEglod)
{
	$errorMessage = USER_LACK_BALANCE_ERROR_MSG;
	
	$status       = USER_LACK_BALANCE_ERROR;
	
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}

$message  = iconv("UTF-8","GBK//IGNORE",$message);

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$errorMessage   = '';

$successMessage = '';

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
		//为小说赠送道具
		$sql = 'UPDATE ' . jieqi_dbprefix('obook_obook') . " SET sumgift = sumgift + '" . $payEglod . "' , sumemoney = sumemoney + '" . $payEglod . "' WHERE articleid = '" . $articleID . "'";
		
		$status = $query->execute($sql);
		
		if($status)
		{
			//为小说赠送道具
			$sql = 'UPDATE ' . jieqi_dbprefix('article_article') . " SET " . $field . " = " . $field ." + " . $num . " WHERE articleid = '" . $articleID . "'";
			
			$status = $query->execute($sql);
			
			if($status)
			{
				$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_article') . " WHERE articleid = '" . $articleID . "'";
				
				$status = $query->execute($sql);
				
				$tmp    = jieqi_query_rowvars($query->getRow());
				
				$propsSum = intval($tmp['allflower']) + intval($tmp['redrose']) + intval($tmp['yellowrose']) + intval($tmp['bluerose']) + intval($tmp['whiterose']) + intval($tmp['blackrose']) + intval($tmp['greenrose']);
				
				$result['userbalance'] = $userInfo['egold'] - $payEglod;
				
				$result['sum']  = $propsSum ? $propsSum : 0;
				
				/**
				 * 添加用户的送道具行为记录，2017-03-02
				 */
				//获取作者信息
				$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_users'). ' WHERE uid=' . $authorID . ' LIMIT 1';
				
				$authorResult = mysql_query($sql);
				
				$authorInfo   = mysql_fetch_row($authorResult);
				
				$credit       = $num * 50;
				
				$score        = $num * 100;
				
				if($field == 'allflower')
				{
					$field = 'flower';
				}
				
				$addTime  = time();
				
				$bookName = $tmp['articlename'];
				
				//添加用户的催更行为记录，
				$sql = 'INSERT INTO `' . jieqi_dbprefix('article_actlog'). "` (`articleid`,`articlename`,`uid`,`uname`,`tid`,`tname`,`addtime`,`actname`,`actnum`,`islog`,`isvip`,`credit`,`score`,`egold`) VALUES ('" . $articleID . "', '" . $bookName . "', '" . $userID . "', '" . $userName . "', '" . $authorID . "', '" . $authorInfo[2] . "', '"  . $addTime . "', '" . $field . "', '" . $num . "', '" . 1  . "', '" . $userInfo['isvip'] . "', '" . $credit . "', '" . $score . "', '" . $payEglod . "')";
				
				$status = $query->execute($sql);
				
				/**
				 * 添加用户的送道具行为记录完毕，2017-03-02
				 */
				
				$fromName       = iconv('UTF-8',"GBK//IGNORE",$userInfo['name']);
				
				//发送消息
				$status         = sendMessage($message,$articleID,$userID,$fromName);
				
				$successMessage = '给小说赠送道具成功！';
				
				$status         = 1;
			}
			else
			{
				//赠送道具失败
				//为小说减去赠送道具
				$sql = 'UPDATE ' . jieqi_dbprefix('obook_obook') . " SET sumgift = sumgift - '" . $payEglod . "' , sumemoney = sumemoney - '" . $payEglod . "' WHERE articleid = '" . $articleID . "'";
				
				$status = $query->execute($sql);
				
				//给用户的加钱
				$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $payEglod . " WHERE uid = '" . $userID . "'";
				
				$status = $query->execute($sql);
				
				//减去给作者的赏钱
				$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $authorID . "'";
				
				$status = $query->execute($sql);
				
				$errorMessage = '给小说赠送道具失败，请重试！';
				
				$status       = 0;
			}
		}
		else
		{
			//打赏失败，扣除给作者打赏的钱
			$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - '" . $payEglod . "' WHERE uid = '" . $authorID . "'";
			
			$query->execute($sql);
			
			//打赏失败，把打赏的钱还给用户
			$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold + " . $payEglod . " WHERE uid = '" . $userID . "'";
			
			$query->execute($sql);
			
			$errorMessage = '给小说赠送道具失败，请重试！';
			
			$status       = 0;
		}
	}
	else
	{
		//打赏失败，扣除给作者打赏的钱
		$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . " SET egold = egold - " . $payEglod . " WHERE uid = '" . $authorID . "'";
		
		$query->execute($sql);
		
		$errorMessage = '给小说赠送道具失败，请重试！';
		
		$status       = 0;
	}
}
else
{
	$errorMessage = '给小说赠送道具失败，请重试！';
	
	$status       = 0;
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

