<?php
define("JIEQI_MODULE_NAME", "pay");
require_once('../../global.php');
jieqi_loadlang("pay", JIEQI_MODULE_NAME);

	$state=trim($_GET["state"]);            // 1:��ֵ�ɹ� 2:��ֵʧ��
	$customerid=trim($_GET["customerid"]);	//�̻�ע���ʱ�������Զ�������̻�ID
	$sd51no=trim($_GET["sd51no"]);          //�ö���������ϵͳ�Ķ�����
	$sdcustomno=trim($_GET["sdcustomno"]);  //�ö������̻�ϵͳ����ˮ��
	$ordermoney=trim($_GET["ordermoney"]);  //�̻�����ʵ�ʽ�λ����Ԫ��
	$cardno=trim($_GET["cardno"]);          //֧�����ͣ�Ϊ�̶�ֵ 32
	$mark=trim($_GET["mark"]);              //δ������ʱ���ؿ�ֵ
	$sign=trim($_GET["sign"]);              //���͸��̻���ǩ���ַ���
	$resign=trim($_GET["resign"]);          //���͸��̻���ǩ���ַ���
	$des=trim($_GET["des"]);                //��������֧���ɹ���ʧ�ܵ�ϵͳ��ע
	
	
	//����ֻ����������Ҫ���裬���廹������Լ�����ϵͳ���ҵ����  (*����������Լ�ʵ��*)
	
	//**************************************************************************
	//*��һ��
	//* ��¼��־����¼���յ��� ֪ͨ��ַ �� ������  �Ա��պ��֤��������*���룩
	//**************************************************************************
	//.........
	
	
	//**************************************************************************************************
	//*�ڶ���
	//*��֤����
	//*�����Լ���Ҫ��֤������1.��֤�Ƿ�Ϊ������֪ͨ�����ģ�����IP���ƣ�[����] 2.��֤�����Ϸ���[��ѡ]��
	//**************************************************************************************************
	 
	//��:
	$key="wxb36c0f7d7456392f";  //key�ɴ����������ؿͷ�����ȡ
	$sign2=strtoupper(md5("customerid=".$customerid."&sd51no=".$sd51no."&sdcustomno=".$sdcustomno."&mark=".$mark."&key=".$key));
	$resign2=strtoupper(md5("sign=".$sign."&customerid=".$customerid."&ordermoney=".$ordermoney."&sd51no=".$sd51no."&state=".$state."&key=".$key));
	
	if($sign!=$sign2)
	{
		echo "ǩ������ȷ";
		//��¼��־
		exit();
	}
		

	
	if($resign!=$resign2)
	{
		echo "ǩ������ȷ";
		//��¼��־
		exit();
	}
		
	
	
	
	//**************************************************************************
	//*������
	//*�̻�ϵͳҵ���߼�����
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
		//����ֵ�ɹ���ͬ���̻�ϵͳ����״̬
		//�˴���д�̻�ϵͳ�������ɹ�����
		//............
		//............
		//�̻��ڽ��ܵ�����֪ͨʱ��Ӧ�ô�ӡ��<result>1</result>��ǩ���Թ��ӿڳ���ץȡ��Ϣ���Ա������ǻ�ȡ�Ƿ�֪ͨ�ɹ�����Ϣ�����򶩵�����ʾû��֪ͨ�̻�
		    $query2 = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			$sql2 = "UPDATE " . jieqi_dbprefix("pay_paylog") . " SET rettime = ".JIEQI_NOW_TIME.", retserialno = '{$sd51no}', payflag = 1 WHERE note = '{$sdcustomno}'";
			$query2->execute($sql2);
			$buyid = $row["buyid"];
			$egold = $row["egold"];
			$ret = $users_handler->income($buyid, $egold, 0, 100);
		echo "<result>1</result>";
		//��¼����������־
	}
	else if($state=="2")
	 {
		//����ֵʧ�ܺ�ͬ���̻�ϵͳ����״̬
		//�˴���д�̻�ϵͳ������ʧ������
		//............
		//............
		//�̻��ڽ��ܵ�����֪ͨʱ��Ӧ�ô�ӡ��<result>1</result>��ǩ���Թ��ӿڳ���ץȡ��Ϣ���Ա������ǻ�ȡ�Ƿ�֪ͨ�ɹ�����Ϣ�����򶩵�����ʾû��֪ͨ�̻�
		echo "<result>1</result>";
		//��¼����������־
	}
	else{
		//�쳣�����֣���ѡ��,�����Լ�ϵͳ����
		echo "<result>0</result>";   //������<result>0</result>ʱ����������ϵͳ�����֪ͨ
		//��¼����������־
	}
?>