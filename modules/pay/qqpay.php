<?php
define("JIEQI_MODULE_NAME", "pay");
require_once('../../global.php');
jieqi_checklogin();
jieqi_loadlang("pay", "pay");

        $curDateTime = date("YmdHis");
        $randNum = rand(1000, 9999);
		$mch_vno = $curDateTime . $randNum;//生成订单号
		$item['customerid'] = " "; //商户号
		$item['key'] = " ";//秘钥
		$item['sdcustomno'] = $mch_vno;//订单在商户系统中的流水号
		$item['orderAmount'] = $_POST['egold'];//订单支付金额；单位:分(人民币)
		$item['cardno'] = "36";//固定值32为（微信）  36为（手机QQ）
		$item['noticeurl'] = "".JIEQI_URL."/modules/pay/qqpayreturn.php";
		//在网关返回信息时通知商户的地址，该地址不能带任何参数，否则异步通知会不成功
        $item['backurl'] = "".JIEQI_URL."/userdetail.php";//在网关返回信息时回调商户的地址 ,可带参数（付款成功后原地址返回）
        $item['mark'] = JIEQI_NOW_TIME;//(*商户自定义信息，不能包含中文字符，因为可能编码不一致导致MD5加密结果不一致)
        $item['remarks'] = JIEQI_EGOLD_NAME;//商品名称
	
		$customerid=$item['customerid'];
		$sdcustomno=$item['sdcustomno'];
		$orderAmount=$item['orderAmount'];
		$cardno=$item['cardno'];
		$noticeurl=$item['noticeurl'];
		$backurl=$item['backurl'];
		$key=$item['key'];
		$mark=$item['mark'];
		$Md5str='customerid='.$customerid.'&sdcustomno='.$sdcustomno.'&orderAmount='.$orderAmount.'&cardno='.$cardno.'&noticeurl='.$noticeurl.'&backurl='.$backurl.$key;
		$sign=strtoupper(md5($Md5str));
		
		$gourl='http://www.zhifuka.net/gateway/QQpay/QQpay.asp?customerid='.$customerid.'&sdcustomno='.$sdcustomno.'&orderAmount='.$orderAmount.'&cardno='.$cardno.'&noticeurl='.$noticeurl.'&backurl='.$backurl .'&sign='.$sign.'&mark='.$mark;
		echo "<script language=\"javascript\">";
		echo "document.location=\"".$gourl."\"";
		echo "</script>";
	    
		include_once ($jieqiModules["pay"]["path"] . "/class/paylog.php");
        $paylog_handler = JieqiPaylogHandler::getInstance("JieqiPaylogHandler");
        $paylog = $paylog_handler->create();
        $paylog->setVar("siteid", JIEQI_SITE_ID);
        $paylog->setVar("buytime", JIEQI_NOW_TIME);
        $paylog->setVar("rettime", 0);
        $paylog->setVar("buyid", $_SESSION["jieqiUserId"]);
        $paylog->setVar("buyname", $_SESSION["jieqiUserName"]);

        if (!isset($buyinfo)) {
           $buyinfo = "";
        }

        $paylog->setVar("buyinfo", $buyinfo);
        $paylog->setVar("moneytype", 0);
        $paylog->setVar("money", $_POST["egold"]);
        $paylog->setVar("egoldtype", 0);
        $paylog->setVar("egold", $_POST["egold"]);
        $paylog->setVar("paytype", "mqq");
        $paylog->setVar("retserialno", "");
        $paylog->setVar("retaccount", "");
        $paylog->setVar("retinfo", "");
        $paylog->setVar("masterid", 0);
        $paylog->setVar("mastername", "");
        $paylog->setVar("masterinfo", "");
        $paylog->setVar("note", $item['sdcustomno']);
        $paylog->setVar("payflag", 0);

        if (!$paylog_handler->insert($paylog)) {
	      jieqi_printfail($jieqiLang["pay"]["add_paylog_error"]);
        }
?>
