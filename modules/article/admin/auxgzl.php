<?php
define('JIEQI_MODULE_NAME', 'system');

require_once '../../../global.php';
$conn = mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die('����ʧ��');
mysql_select_db(JIEQI_DB_NAME, $conn);
@mysql_query("SET names gbk");
include_once JIEQI_ROOT_PATH . '/class/power.php';
$power_handler = &JieqiPowerHandler::getInstance('JieqiPowerHandler');
$power_handler->getSavedVars('system');
jieqi_checkpower($jieqiPower['article']['adminpersondetail'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');

$uid    = $_REQUEST['id'];
$action = $_POST['action'];

//burn��ӣ�2016-12-05
$dbTable = 'jieqi_system_persons';//ԭ��Ϊ$dbTable = 'jieqi_article_author';

if ($action)
{
	$realname    = trim($_POST['p_realname']);
	$telephone   = trim($_POST['p_telephone']);
	$mobilephone = trim($_POST['p_mobilephone']);
	$idcardtype  = trim($_POST['p_idcardtype']) == '1'? '���֤' : '����';
	$idcard      = trim($_POST['p_idcard']);
	$address     = trim($_POST['p_address']);
	$zipcode     = trim($_POST['p_zipcode']);
	$banktype    = trim($_POST['p_banktype']);
	$bankname    = trim($_POST['p_bankname']);
	$bankcard    = trim($_POST['p_bankcard']);
	$bankuser    = trim($_POST['p_bankuser']);
	
	//$uid = $_SESSION['jieqiUserId'] ? $_SESSION['jieqiUserId'] : '';
	
	//burn��ӣ�2016-12-05
	$dbTable = 'jieqi_system_persons';//ԭ��Ϊ$dbTable = 'jieqi_article_author';
	
	$sql     = "select `uid` from `" . $dbTable . "` where `uid`='$uid' limit 1";
	
	//��������Ƿ���дʵ������
	$isAuthor = mysql_query($sql);
	$result   = mysql_fetch_object($isAuthor);
	
	if(!$result->uid)
	{
		$sql = "INSERT INTO `" . $dbTable . "` (`realname`,`telephone,`mobilephone`,`idcardtype,`idcard,address`,`zipcode`,`banktype`,`bankname`,`bankcard`,`bankuser`)VALUES($realname','$telephone','$mobilephone','$idcardtype','$idcard','$address','$zipcode','$banktype','$bankname','$bankcard','$bankuser')";
		
		$flag = mysql_query($sql);
		
		if($flag)
		{
			jieqi_jumppage('/modules/article/admin/auzl.php?id='.$uid.'', '������ӳɹ���', '<font color="blue">������ת�����Ժ�...</font>');exit;
		}
		else
		{
			jieqi_jumppage('/modules/article/admin/auzl.php?id='.$uid.'', '�������ʧ�ܣ�����ϵ����Ա��', '<font color=blue">������ת�����Ժ�...</font>');
		}
	}
	else
	{
		$sql = "UPDATE `" . $dbTable . "` SET `realname`='$realname', `telephone`='$telephone', `mobilephone`='$mobilephone', `idcardtype`='$idcardtype', `idcard`='$idcard', `address`='$address', `zipcode`='$zipcode', `banktype`='$banktype', `bankname`='$bankname', `bankcard`='$bankcard', `bankuser`='$bankuser' WHERE `uid`='$uid'";
		
		$flag = mysql_query($sql);
		
		if($flag)
		{
			jieqi_jumppage('/modules/article/admin/auzl.php?id='.$uid.'', '������ӳɹ���', '<font color="blue">������ת�����Ժ�...</font>');exit;
		}
		else
		{
			jieqi_jumppage('/modules/article/admin/auzl.php?id='.$uid.'', '�������ʧ�ܣ�����ϵ����Ա��', '<font color=blue">������ת�����Ժ�...</font>');
		}
	}
}

include_once JIEQI_ROOT_PATH . '/admin/header.php';

//��ȡ����ʵ����¼
$result1 = mysql_query("select * from `". $dbTable . "` where `uid`=$uid");

$userAuthor = mysql_fetch_object($result1);

$jieqiTpl->assign('uid',$uid);
$jieqiTpl->assign('username',$userAuthor->username);
$jieqiTpl->assign('realname',$userAuthor->realname);
$jieqiTpl->assign('telephone',$userAuthor->telephone);
$jieqiTpl->assign('mobilephone',$userAuthor->mobilephone);
$jieqiTpl->assign('idcardtype',$userAuthor->idcardtype == '���֤' ? 1 : 2);
$jieqiTpl->assign('idcard',$userAuthor->idcard);
$jieqiTpl->assign('address',$userAuthor->address);
$jieqiTpl->assign('zipcode',$userAuthor->zipcode);
$jieqiTpl->assign('banktype',$userAuthor->banktype);
$jieqiTpl->assign('bankname',$userAuthor->bankname);
$jieqiTpl->assign('bankcard',$userAuthor->bankcard);
$jieqiTpl->assign('bankuser',$userAuthor->bankuser);
$jieqiTpl->setCaching(0);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/admin/auxgzl.html';
include_once JIEQI_ROOT_PATH . '/admin/footer.php';
?>