<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/27
 * Time: ����5:47
 *
 * �༭������ר��
 *
 */

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

//��ȡ���Ѵ�
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

switch ($_REQUEST['action'])
{
	case 'show':
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotcommend'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$hotcommend = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('hotcommend',$hotcommend);
		
		$channelArray = array(0 => '��ѡ',1 => '��Ƶ', 2 => 'ŮƵ');
		
		$jieqiTpl->assign('channelList',$channelArray);
		
		$showArray = array(1 => '��һ˳������',2 => '�ڶ�˳������', 3 => '����˳������');
		
		$jieqiTpl->assign('showOrder',$showArray);
		
		$jieqiTpl->assign('hotcommend',$hotcommend);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		$title    = trim($_REQUEST['title']);//ר��id
		
		$showID   = trim($_REQUEST['showid']);//��ʾ˳��
		
		$booksID  = trim($_REQUEST['booksID']);//ר�����
		
		$channel  = trim($_REQUEST['channelid']);//ר���鼮
		
		$sql = 'UPDATE `' . jieqi_dbprefix('app_hotcommend'). "` SET `title` = '" . $title . "' ,`showID` = '" . $showID . "' ,`booksID` = '" . $booksID . "' ,`channel` = '" . $channel . "' WHERE `id` = " . $id;
			
		$row = $query->execute($sql);
			
		if($row)
		{
			$messageContent = '�޸�������ר���ɹ���';
		}
		else
		{
			jieqi_printfail('�޸�������ר��ʧ�ܣ�');
		}
			
		break;
	}
	case 'add':
	{
		$title    = trim($_REQUEST['title']);//ר��id
		
		$showID   = trim($_REQUEST['showid']);//��ʾ˳��
		
		$booksID  = trim($_REQUEST['booksID']);//ר�����
		
		$channel  = trim($_REQUEST['channelid']);//ר���鼮
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('app_hotcommend'). "` (`title`,`showID`,`booksID`,`channel`) VALUES ('" . $title . "', '" . $showID . "', '" . $booksID . "', '" . $channel . "')";
			
		$row = $query->execute($sql);
			
		if($row)
		{
			$messageContent = '���������ר���ɹ���';
		}
		else
		{
			jieqi_printfail('���������ר��ʧ�ܣ�');
		}
			
		break;
	}
	case 'delete':
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_hotcommend'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = 'ɾ��������ר���ɹ���';
		}
		else
		{
			jieqi_printfail('ɾ��������ר��ʧ�ܣ�');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/hotCommendList.php';
	
	$messageTitle = '������ר��';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editHotCommend.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");