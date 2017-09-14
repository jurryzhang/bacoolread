<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/2/5
 * Time: 上午10:25
 *
 * 用户apple支付接口
 *
 * 请求字段：egold        ： 人民币
 *         receipt-data ： 苹果返回的transactionReceipt
 *         is_sandbox   ： 0:非沙盒；1：沙盒
 *
 */

define('JIEQI_MODULE_NAME', 'pay');
define('JIEQI_PAY_TYPE', 'appsatorepay');

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

$userAgent = trim($_SERVER['HTTP_USER_AGENT']);

$agentTpl  = 'FreeReading/1.0.7';

//苹果设备
if(strpos($userAgent, $agentTpl) !== false && strpos($userAgent, 'iOS') !== false)
{
	jieqi_includedb();
	
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	
	$sql   =  'SELECT COUNT(*) FROM ' . jieqi_dbprefix('pay_paylog'). " WHERE receiptdata = '" . $_REQUEST['receipt-data'] ."'";
	
	$result = $query->execute($sql);
	
	if($result)
	{
		$payLogDataCount = jieqi_query_rowvars($query->getRow());
		
		if($payLogDataCount['COUNT(*)'] == 0)
		{
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
			
			if(isset($_REQUEST['is_sandbox']))
			{
				$isSandBox = trim($_REQUEST['is_sandbox']);
			}
			else
			{
				$isSandBox = 0;
			}
			
			//关闭支付，egold字段改为egold_type
			
			if(isset($_REQUEST['egold']) && is_numeric($_REQUEST['egold']) && $_REQUEST['egold'] > 0)
			{
				$_REQUEST['egold'] = intval($_REQUEST['egold']);
				
				$money = $_REQUEST['egold'];
				
				$egold = $money * 100;
				
				include_once($jieqiModules['pay']['path'].'/class/paylog.php');
				
				$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
				
				$paylog  = $paylog_handler->create();
				
				$buytime = JIEQI_NOW_TIME;
				
				$paylog->setVar('siteid', JIEQI_SITE_ID);
				$paylog->setVar('buytime', $buytime);
				$paylog->setVar('rettime', 0);
				$paylog->setVar('buyid', $userID);
				$paylog->setVar('buyname', $userName);
				$paylog->setVar('buyinfo', '');
				$paylog->setVar('moneytype', 0);
				$paylog->setVar('money', $money);
				$paylog->setVar('egoldtype', 0);
				$paylog->setVar('egold', $egold);
				$paylog->setVar('paytype', JIEQI_PAY_TYPE);
				$paylog->setVar('retserialno', '');
				$paylog->setVar('retaccount', '');
				$paylog->setVar('retinfo', '');
				$paylog->setVar('masterid', 0);
				$paylog->setVar('mastername', '');
				$paylog->setVar('masterinfo', '');
				$paylog->setVar('note', '');
				$paylog->setVar('payflag', 0);
				$paylog->setVar('isios', 1);
				$paylog->setVar('receiptdata',$_REQUEST['receipt-data']);
				
				if(!$paylog_handler->insert($paylog))
				{
					$status       = 0;
					
					$errorMessage = $jieqiLang['pay']['add_paylog_error'];
				}
				else
				{
					//用户发来的参数
					$receipt_data = $_REQUEST['receipt-data'];
					
					$payID = $paylog->getVar('payid');
					
					//验证参数
					if (strlen($receipt_data) < 20)
					{
						$status       = 0;
						
						$errorMessage = '非法参数';
						
						echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
						
						return;
					}
					else
					{
						//请求验证
						$html = getReceiptData($receipt_data,$isSandBox,$money);
						
						//购买成功
						if($html['errNo'] == 0)
						{
							$paylog  = $paylog_handler->get($payID);
							$buyname = $paylog->getVar('buyname');
							$buyid   = $paylog->getVar('buyid');
							$egold   = $paylog->getVar('egold');
							$money   = $paylog->getVar('money');
							
							include_once(JIEQI_ROOT_PATH . '/class/users.php');
							
							$users_handler         =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
							
							$ret = $users_handler->income($buyid, $egold, 0, 0);
							
							if($ret)
							{
								$note = sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
							}
							else
							{
								$note = sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
							}
							
							$paylog->setVar('rettime', JIEQI_NOW_TIME);
							$paylog->setVar('note', $note);
							$paylog->setVar('payflag', 1);
							
							$paylog->setVar('payflag', 1);
							
							$paylog_handler->insert($paylog);
							
							$userObj               = $users_handler->get($buyid);
							
							$resultList['userbalance'] = $userObj->getVar('egold');
							
							$status                = 1;
						}
						else
						{
							$errorMessage = '购买失败';
							
							$status       = 0;
						}
					}
				}
			}
			else
			{
				$errorMessage = '支付失败，请重试！';
				
				$status       = 0;
			}
		}
		else
		{
			$errorMessage = '支付失败，请重试！';
			
			$status       = 0;
		}
	}
	else
	{
		$errorMessage = '支付失败，请重试！';
		
		$status       = 0;
	}
}
else
{
	$errorMessage = '支付失败，请重试！';

	$status       = 0;
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => $status,'message' => '支付成功','result' => $resultList));
	
	return;
}
else
{
	echo json_encode_ex(array('status' => $status,'message' => $errorMessage));
	
	return;
}