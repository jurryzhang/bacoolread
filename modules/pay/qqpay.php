<?php
define("JIEQI_MODULE_NAME", "pay");
require_once('../../global.php');
jieqi_checklogin();
jieqi_loadlang("pay", "pay");

        $curDateTime = date("YmdHis");
        $randNum = rand(1000, 9999);
		$mch_vno = $curDateTime . $randNum;//���ɶ�����
		$item['customerid'] = " "; //�̻���
		$item['key'] = " ";//��Կ
		$item['sdcustomno'] = $mch_vno;//�������̻�ϵͳ�е���ˮ��
		$item['orderAmount'] = $_POST['egold'];//����֧������λ:��(�����)
		$item['cardno'] = "36";//�̶�ֵ32Ϊ��΢�ţ�  36Ϊ���ֻ�QQ��
		$item['noticeurl'] = "".JIEQI_URL."/modules/pay/qqpayreturn.php";
		//�����ط�����Ϣʱ֪ͨ�̻��ĵ�ַ���õ�ַ���ܴ��κβ����������첽֪ͨ�᲻�ɹ�
        $item['backurl'] = "".JIEQI_URL."/userdetail.php";//�����ط�����Ϣʱ�ص��̻��ĵ�ַ ,�ɴ�����������ɹ���ԭ��ַ���أ�
        $item['mark'] = JIEQI_NOW_TIME;//(*�̻��Զ�����Ϣ�����ܰ��������ַ�����Ϊ���ܱ��벻һ�µ���MD5���ܽ����һ��)
        $item['remarks'] = JIEQI_EGOLD_NAME;//��Ʒ����
	
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
