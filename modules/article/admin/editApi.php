<?php
/**
 * Created by PhpStorm.
 * User: muyi
 * Date: 2017/4/7
 * Time: ����11:11
 *
 * ����������
 *
 */


define('api_IMAGE_DIR','E:\\\\files\\\\article\\\\api\\\\image');

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

if(empty($_REQUEST['action']))
{
	$_REQUEST['action'] = 'show';
}

if(isset($_REQUEST['id']))
{
	$id = $_REQUEST['id'];
}
else
{
	$id = -1;
}

$messageContent = '';

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

jieqi_getconfigs("article","configs", "jieqiConfigs");


switch ($_REQUEST['action'])
{
	case 'show':
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_api'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$api = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('api',$api);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		//��Ӻ�����
		$partner  = trim($_REQUEST['partner']);//������
		
		$bookIDs  = trim($_REQUEST['bookIDs']);//��Ȩ���������鼮ID
		
		$url  = trim($_REQUEST['url']);//��������	
		
		if(empty($partner)){
			$errtext='����������Ϊ��';
		}
		
		if(empty($bookIDs)){
			$errtext='��Ȩ�鼮����Ϊ��';
		}
		
		
		
		if (empty($errtext))
		{			
			$sql = 'UPDATE `' . jieqi_dbprefix('article_api'). "` SET `partner` = '" . $partner . " ', `bookIDs` = '" . $bookIDs . "' , `url` = '" . $url .  "' WHERE `id` = " . $id;
		
			$row = $query->execute($sql);
			
			if($row!==false)
			{				
				$messageContent = '�޸ĺ������ɹ���';
			}
			else
			{
				jieqi_printfail('�޸ĺ�����ʧ�ܣ�');
			}
		}else
		{
			$messageContent = $errtext;
		}		
		
		break;
	}
	case 'add':
	{
		//��Ӻ�����
		$partner  = trim($_REQUEST['partner']);//������
		
		$bookIDs  = trim($_REQUEST['bookIDs']);//��Ȩ���������鼮ID
		
		$url  = trim($_REQUEST['url']);//��������		
		$token = md5(time());//��������
		$addtime = time();
		
		if(empty($partner)){
			$errtext='����������Ϊ��';
		}
		
		if(empty($bookIDs)){
			$errtext='��Ȩ�鼮����Ϊ��';
		}
		
		
		if (empty($errtext))
		{
			
			$sql = 'INSERT INTO `' . jieqi_dbprefix('article_api'). "` (`partner`,`bookIDs`,`url`,`token`,`addtime`) VALUES ('" . $partner . "', '" . $bookIDs . "', '"  . $url . "', '" . $token . "', '".$addtime. "')";
			
			$row = $query->execute($sql);
			
			if($row)
			{				
				$messageContent = '��Ӻ������ɹ���';
			}
			else
			{
				jieqi_printfail('��Ӻ�����ʧ�ܣ�');
			}
		}
		else
		{
			$messageContent = $errtext;
		}
		
		break;
	}
	case 'delete':
	{
		
		$sql = 'DELETE FROM `' . jieqi_dbprefix('article_api'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row!==false)
		{
			$messageContent = 'ɾ���������ɹ���';
		}
		else
		{
			jieqi_printfail('ɾ��������ʧ�ܣ�');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/article/admin/api.php';
	
	$messageTitle = '����������';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/editapi.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");