<?php
define("JIEQI_MODULE_NAME", "pay");
require_once('../../global.php');
jieqi_loadlang("pay", JIEQI_MODULE_NAME);

	$state=trim($_GET["state"]);            // 1:充值成功 2:充值失败
	$customerid=trim($_GET["customerid"]);	//商户注册的时候，网关自动分配的商户ID
	$sd51no=trim($_GET["sd51no"]);          //该订单在网关系统的订单号
	$sdcustomno=trim($_GET["sdcustomno"]);  //该订单在商户系统的流水号
	$ordermoney=trim($_GET["ordermoney"]);  //商户订单实际金额单位：（元）
	$cardno=trim($_GET["cardno"]);          //支付类型，为固定值 32
	$mark=trim($_GET["mark"]);              //未启用暂时返回空值
	$sign=trim($_GET["sign"]);              //发送给商户的签名字符串
	$resign=trim($_GET["resign"]);          //发送给商户的签名字符串
	$des=trim($_GET["des"]);                //描述订单支付成功或失败的系统备注
	
	
	//以下只简述三步主要步骤，具体还需根据自己本身系统完成业务步骤  (*具体代码需自己实现*)
	
	//**************************************************************************
	//*第一步
	//* 记录日志（记录接收到的 通知地址 和 参数）  以便日后查证订单，（*必须）
	//**************************************************************************
	//.........
	
	
	//**************************************************************************************************
	//*第二步
	//*验证处理
	//*根据自己需要验证参数（1.验证是否为星启天通知过来的（可做IP限制）[必须] 2.验证参数合法性[可选]）
	//**************************************************************************************************
	 
	//例:
	$key="wxb36c0f7d7456392f";  //key可从星启天网关客服处获取
	$sign2=strtoupper(md5("customerid=".$customerid."&sd51no=".$sd51no."&sdcustomno=".$sdcustomno."&mark=".$mark."&key=".$key));
	$resign2=strtoupper(md5("sign=".$sign."&customerid=".$customerid."&ordermoney=".$ordermoney."&sd51no=".$sd51no."&state=".$state."&key=".$key));
	
	if($sign!=$sign2)
	{
		echo "签名不正确";
		//记录日志
		exit();
	}
		

	
	if($resign!=$resign2)
	{
		echo "签名不正确";
		//记录日志
		exit();
	}
		
	
	
	
	//**************************************************************************
	//*第三步
	//*商户系统业务逻辑处理
	//**************************************************************************
	include_once (JIEQI_ROOT_PATH . "/class/users.php");
	$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
    jieqi_includedb();
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	$sql = "SELECT * FROM " . jieqi_dbprefix("pay_paylog") . " WHERE `note` = {$sdcustomno}";
	$query->execute($sql);
	$row = $query->getRow();
	
	if($state=="1")
	{
		   //$ybnums = $ordermoney *100;
		//当充值成功后同步商户系统订单状态
		//此处编写商户系统处理订单成功流程
		//............
		//............
		//商户在接受到网关通知时，应该打印出<result>1</result>标签，以供接口程序抓取信息，以便于我们获取是否通知成功的信息，否则订单会显示没有通知商户
		    $query2 = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			$sql2 = "UPDATE " . jieqi_dbprefix("pay_paylog") . " SET rettime = ".JIEQI_NOW_TIME.", retserialno = '{$sd51no}', payflag = 1 WHERE note = '{$sdcustomno}'";
			$query2->execute($sql2);
			$buyid = $row["buyid"];
			$egold = $row["egold"];
			$ret = $users_handler->income($buyid, $egold, 0, 100);
		echo "<result>1</result>";
		//记录订单处理日志
	}
	else if($state=="2")
	 {
		//当充值失败后同步商户系统订单状态
		//此处编写商户系统处理订单失败流程
		//............
		//............
		//商户在接受到网关通知时，应该打印出<result>1</result>标签，以供接口程序抓取信息，以便于我们获取是否通知成功的信息，否则订单会显示没有通知商户
		echo "<result>1</result>";
		//记录订单处理日志
	}
	else{
		//异常处理部分（可选）,根据自己系统而定
		echo "<result>0</result>";   //当返回<result>0</result>时星启天网关系统会继续通知
		//记录订单处理日志
	}
?>