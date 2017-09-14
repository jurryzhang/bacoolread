<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: ����8:20
 *
 * �༭���Ѵ�����
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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotsearchword'). " WHERE id = " . $id;
		
		$query->execute($sql);
		$hurryrows = array();
		$k = 0;
		
		$hotSearchWord = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('hotSearchWord',$hotSearchWord);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		$bookName = trim($_REQUEST['bookName']);
		
		$bookID   = trim($_REQUEST['bookID']);
	
		$sql = 'UPDATE `' . jieqi_dbprefix('app_hotsearchword'). "` SET `bookID` = " . $bookID . ", `bookName` = '" . $bookName . "' WHERE `id` = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '�޸����Ѵʳɹ���';
		}
		else
		{
			jieqi_printfail('�޸����Ѵ�ʧ�ܣ�');
		}
		
		break;
	}
	case 'add':
	{
		$bookName = trim($_REQUEST['bookName']);
		
		$bookID   = trim($_REQUEST['bookID']);
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('app_hotsearchword'). "` (`bookName`,`bookID`) VALUES ('" . $bookName . "', " . $bookID . ")";
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '������Ѵʳɹ���';
		}
		else
		{
			jieqi_printfail('������Ѵ�ʧ�ܣ�');
		}
		
		break;
	}
	case 'delete':
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_hotsearchword'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = 'ɾ�����Ѵʳɹ���';
		}
		else
		{
			jieqi_printfail('ɾ�����Ѵ�ʧ�ܣ�');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/searchKeyWordsList.php';
	
	$messageTitle = '���Ѵ�����';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editSearchKeyWord.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");