<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/6
 * Time: 下午2:35
 *
 * 用户购买vip章节接口
 *
 * 请求字段：action      ： showBuyInfo/buyChapter
 *         article_id  ： 小说id
 *         chater_id   ： 当前章节的id
 *         is_ios      ： 0，不是ios设备；1：是ios设备
 *
 *         当action=buyChapter，存在以下字段
 *         price         ： 总价
 *         obook_id      ： 付费书籍id
 *         obook_name    ： 付费书籍名称
 *         ochapter_list ： 付费章节list
 *         ochapter_price_list ： 付费章节价格list
 *         author_id    ： 作者id
 *         auto_buy     ： 自动购买，0：不自动订阅；1：自动订阅；
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

if(isset($_REQUEST['action']))
{
	$action = trim($_REQUEST['action']);
}
else
{
	$action = 'showBuyInfo';
}

if(isset($_REQUEST['article_id']))
{
	$articleID = trim($_REQUEST['article_id']);
}
else
{
	$errorMessage = '获取书籍信息失败，请重试！';
	
	$status       = -1;
}

if(isset($_REQUEST['chapter_id']))
{
	$chapterID = trim($_REQUEST['chapter_id']);
}
else
{
	$errorMessage = '获取章节信息失败，请重试！';
	
	$status       = -2;
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

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$errorMessage   = '';

$successMessage = '';

switch ($action)
{
	case 'showBuyInfo';
	{
		//用户余额
		$userBalance = $userInfo['egold'];
		
		$sql = "SELECT * FROM " . jieqi_dbprefix('article_chapter') ." WHERE articleid = " . $articleID . " AND chapterid >= " . $chapterID . " AND isvip = 1 ORDER BY `chapterid` ASC";
		
		$status = $query->execute($sql);
		
		if($status)
		{
			while ($row = $query->getRow())
			{
				$tmpChapter = jieqi_query_rowvars($row);
				
				$chapterInfo['article']     = filterStr($chapterInfo['articlename']);
				
				$chapterInfo['articleid']   = filterStr($chapterInfo['articleid']);
				
				$chapterInfo['chapterid']   = $tmpChapter['chapterid'];//章节id
				
				$chapterInfo['chapter']     = iconv('GBK','UTF-8',$tmpChapter['chaptername']);//章节名称
				
				$chapterInfo['chapter']     = filterStr($chapterInfo['chapter']);
				
				$chapterInfo['authorid']    = $tmpChapter['posterid'];//作者id
				
				$chapterInfo['saleprice']   = $tmpChapter['saleprice'];//价格
				
				$chapterInfo['chaptername'] = iconv('GBK','UTF-8',$tmpChapter['chaptername']);//章节名
				
				$chapterInfo['chaptername'] = filterStr($chapterInfo['chaptername']);
				
				$chapterList[]              = $chapterInfo;
			}
			
			$userOChapterList = getUserOChapter($articleID);//查找用户购买该书的vip章节信息
			
			$buyList[] = computeVipChapterPrice(0,1,$chapterList,$userOChapterList);
			
			$buyList[] = computeVipChapterPrice(1,30,$chapterList,$userOChapterList);
			
			$buyList[] = computeVipChapterPrice(2,100,$chapterList,$userOChapterList);
			
			$buyList[] = computeVipChapterPrice(3,200,$chapterList,$userOChapterList);
			
			//查看该书的obookid
			$sql = "SELECT * FROM " . jieqi_dbprefix('obook_obook') ." WHERE articleid = " . $articleID;
			
			$status = $query->execute($sql);
			
			if($status)
			{
				$tmp = jieqi_query_rowvars($query->getRow());
				
				$result['obookid']     = $tmp['obookid'];
				
				$result['obookname']   = iconv("GBK","UTF-8",$tmp['obookname']);
				
				$result['userbalance'] = $userBalance;
				
				$result['userbalance'] = $userBalance;
				
				$result['buyinfolist'] = $buyList;
				
				$status                = 1;
			}
			else
			{
				$errorMessage = '获取书籍信息失败，请重试！';
				
				$status       = 0;
			}
		}
		else
		{
			$errorMessage = '计算章节价格错误，请重试！';
			
			$status       = 0;
		}
		
		break;
	}
	case 'buyChapter':
	{
		if(isset($_REQUEST['price']))
		{
			$payEglod = intval(trim($_REQUEST['price']));
			
			//用户余额
			$userBalance = $userInfo['egold'] - $payEglod;
		}
		else
		{
			$errorMessage = '计算章节价格错误，请重试！';
			
			$status       = 0;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
			
			return;
		}
		
		if(isset($_REQUEST['obook_id']))
		{
			$oBookID = intval(trim($_REQUEST['obook_id']));
		}
		else
		{
			$errorMessage = '获取书籍信息失败，请重试！';
			
			$status       = 0;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
			
			return;
		}
		
		if(isset($_REQUEST['obook_name']))
		{
			$oBookName = trim($_REQUEST['obook_name']);
		}
		else
		{
			$errorMessage = '获取书籍信息失败，请重试！';
			
			$status       = 0;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
			
			return;
		}
		
		if(isset($_REQUEST['ochapter_list']))
		{
			$oChapterList = json_decode((trim($_REQUEST['ochapter_list'])),TRUE);
		}
		else
		{
			$errorMessage = '获取章节信息失败，请重试！';
			
			$status       = -2;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
			
			return;
		}
		
		if(isset($_REQUEST['ochapter_price_list']))
		{
			$oChapterPriceList = json_decode((trim($_REQUEST['ochapter_price_list'])),TRUE);
		}
		else
		{
			$errorMessage = '获取章节信息失败，请重试！';
			
			$status       = 0;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
			
			return;
		}
		
		if(isset($_REQUEST['auto_buy']))
		{
			$autoBuy = intval(trim($_REQUEST['auto_buy']));
		}
		else
		{
			$autoBuy = 0;
		}
		
		if(isset($_REQUEST['author_id']))
		{
			$authorID = intval(trim($_REQUEST['author_id']));
		}
		else
		{
			$errorMessage = '获取作者信息失败，请重试！';
			
			$status       = 0;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
			
			return;
		}
		
		if($userInfo['egold'] < $payEglod)
		{
			$errorMessage = USER_LACK_BALANCE_ERROR_MSG;
			
			$status       = USER_LACK_BALANCE_ERROR;
			
			echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
			
			return;
		}
		
		//先给作者打钱
		$status = rechargeForUser($query,$authorID,$payEglod);
		
		if($status)
		{
			//再扣用户的钱
			$status = deductFromUser($query,$userID,$payEglod);
			
			//扣钱成功，添加用户的详细购买信息
			if($status)
			{
				$saleNum   = 1;
				 
				$payNote   = getIp();
				
				$time      = time();
				
				$oBookName = iconv('UTF-8','GBK//IGNORE',$oBookName);
				
				foreach($oChapterList as $oChapterID => $oChapterName)
				{
					$salePrice    = $oChapterPriceList[$oChapterID];
					
					$oChapterName = iconv('UTF-8','GBK//IGNORE',$oChapterName);
					
					$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_osale'). "` (`buytime`,`accountid`,`account`,`articleid`,`obookid`,`ochapterid`,`obookname`,`chaptername`,`saleprice`,`salenum`,`sumprice`,`paynote`) VALUES ('" . $time . "', '" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $oBookID . "', '" . $oChapterID . "', '" . $oBookName . "', '" . $oChapterName . "', '" . $salePrice . "', '" . $saleNum . "', '" . $salePrice . "', '" . $payNote . "')";
					
					$status = $query->execute($sql);
					
					if($status)
					{
						$oSaleIDList[$oChapterID] = mysql_insert_id();
					}
					else
					{
						$errorMessage = '扣费失败，请重试！';
						
						$status       = 0;
						
						//给用户恢复扣除的钱
						rechargeForUser($query,$userID,$payEglod);
						
						//需要扣掉作者收到的钱
						deductFromUser($query,$authorID,$payEglod);
						
						//删除用户的付费记录
						delSaleRecord($query,$oSaleIDList);
						
						echo json_encode_ex(array('status' => $status,'message' => $errorMessage));;
						
						return;
					}
				}
				
				//修改或添加用户的购买记录
				$sql = 'SELECT * FROM `' . jieqi_dbprefix('obook_obuy'). "` WHERE userid = '" . $userID ."' AND articleid = '" . $articleID . "'";
				
				$status = $query->execute($sql);
				
				if($status)
				{
					$tmp          = jieqi_query_rowvars($query->getRow());
					
					$chapterNum   = count($oChapterList);
					
					$salePrice    = end($oChapterPriceList);
					
					$oChapterName = iconv('UTF-8','GBK//IGNORE',end($oChapterList));
					
					if($tmp)
					{
						$oBuyID = $tmp['obuyid'];
						
						$sql = 'UPDATE `' . jieqi_dbprefix('obook_obuy'). "` SET `osaleid` = " . end($oSaleIDList) . " , `lastbuy` = '" . $time . "' , `ochapterid` = '" . array_search(end($oChapterList),$oChapterList) . "' , `chaptername` = '" . $oChapterName . "' , `chapternum` = chapternum + '" . $chapterNum . "' , `buynum` = '" . $saleNum . "' , `buypay` = '" . $salePrice . "', `autobuy` = '" . $autoBuy . "' WHERE obuyid = '" . $tmp['obuyid'] . "'";
						
						$status = $query->execute($sql);
					}
					else
					{
						$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_obuy'). "` (`osaleid`,`buytime`,`lastbuy`,`userid`,`username`,`articleid`,`obookid`,`ochapterid`,`obookname`,`chaptername`,`chapternum`,`buynum`,`buypay`,`autobuy`) VALUES ('" . end($oSaleIDList) . "', '" . $time . "', '" . $time . "', '" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $oBookID . "', '" . $chapterID . "', '" . $oBookName . "', '" . $oChapterName . "', chapternum + '" . $chapterNum . "', '" . $saleNum . "', '" . $saleNum . "', '" . $autoBuy . "')";
						
						$status = $query->execute($sql);
						
						$oBuyID = mysql_insert_id();
					}
					
					if($status)
					{
						foreach($oChapterList as $oChapterID => $oChapterName)
						{
							$buyPrice     = $oChapterPriceList[$oChapterID];
							
							$osaleID      = $oSaleIDList[$oChapterID];
							
							$oChapterName = iconv('UTF-8','GBK//IGNORE',$oChapterName);
							
							$sql = 'INSERT INTO `' . jieqi_dbprefix('obook_obuyinfo'). "` (`osaleid`,`buytime`,`userid`,`username`,`articleid`,`obookid`,`ochapterid`,`obookname`,`chaptername`,`buyprice`,`buynum`,`buypay`) VALUES ('" . $osaleID . "', '" . $time . "', '" . $userID . "', '" . $userName . "', '" . $articleID . "', '" . $oBookID . "', '" . $oChapterID . "', '" . $oBookName . "', '" . $oChapterName . "', '" . $buyPrice . "', '" . $saleNum . "', '" . $buyPrice . "')";
							
							$status = $query->execute($sql);
							
							if($status)
							{
								$obuyInfoIDList[$oChapterID] = mysql_insert_id();
								
								//更新jieqi_obook_obook中的数据
								$sql = 'UPDATE `' . jieqi_dbprefix('obook_obook'). "` SET `sumegold` = sumegold+saleprice" . " , `allsale` = allsale+1" . " , `monthsale` = monthsale+1" . " , `weeksale` = weeksale+1" . " , `daysale` = daysale+1" . " , `totalsale` = totalsale+1" . " , `lastsale` = " . $time .' WHERE obookid = ' . $oBookID;
								
								$status = $query->execute($sql);
								
								//更新jieqi_obook_ochapter中的数据
								$sql = 'UPDATE `' . jieqi_dbprefix('obook_ochapter'). "` SET `sumegold` = sumegold+saleprice" . " , `allsale` = allsale+1" . " , `monthsale` = monthsale+1" . " , `weeksale` = weeksale+1" . " , `daysale` = daysale+1" . " , `totalsale` = totalsale+1" . " , `lastsale` = " . $time . ' WHERE ochapterid = ' . $oChapterID;
								
								$status = $query->execute($sql);
							}
							else
							{
								$errorMessage = '扣费失败，请重试！';
								
								$status       = 0;
								
								//给用户恢复扣除的钱
								rechargeForUser($query,$userID,$payEglod);
								
								//需要扣掉作者收到的钱
								deductFromUser($query,$authorID,$payEglod);
								
								//删除用户的付费记录
								delSaleRecord($query,$oSaleIDList);
								
								delUserBuyRecord($query,$obuyInfoIDList);
								
								echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
								
								return;
							}
						}
						
						$firstChapterID    = $chapterID;
						
						$firstChapterTitle = $oChapterList[$firstChapterID];
							
						$content           = getVipChapterContent($firstChapterID);
						
						if($content == -1)
						{
							$status = 2;//获取章节内容失败
						}
						else
						{
							$status = 1;
						}
						
						$result['articleid']    = $articleID;
						
						$result['article']      = iconv("GBK","UTF-8",$oBookName);
						
						$result['chapterid']    = $firstChapterID;
						
						$result['chaptertitle'] = $firstChapterTitle;
						
						$result['content']      = $content['content'];
						
						$result['size']         = $content['size'];
						
						$result['userbalance']  = $userBalance;//用户余额
						
						$successMessage         = '购买章节成功！';
					}
					else
					{
						$errorMessage = '扣费失败，请重试！';
						
						$status       = 0;
						
						//给用户恢复扣除的钱
						rechargeForUser($query,$userID,$payEglod);
						
						//需要扣掉作者收到的钱
						deductFromUser($query,$authorID,$payEglod);
						
						//删除用户的付费记录
						delSaleRecord($query,$oSaleIDList);
					}
				}
				else
				{
					$errorMessage = '扣费失败，请重试！';
					
					$status       = 0;
					
					//给用户恢复扣除的钱
					rechargeForUser($query,$userID,$payEglod);
					
					//需要扣掉作者收到的钱
					deductFromUser($query,$authorID,$payEglod);
					
					//删除用户的付费记录
					delSaleRecord($query,$oSaleIDList);
				}
			}
			else
			{
				$errorMessage = '扣费失败，请重试！';
				
				$status       = 0;
				
				//需要扣掉作者收到的钱
				deductFromUser($query,$authorID,$payEglod);
			}
		}
		else
		{
			$errorMessage = '扣费失败，请重试！';
			
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