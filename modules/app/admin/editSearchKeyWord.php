<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/26
 * Time: 下午8:20
 *
 * 编辑热搜词设置
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

//获取热搜词
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
			$messageContent = '修改热搜词成功！';
		}
		else
		{
			jieqi_printfail('修改热搜词失败！');
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
			$messageContent = '添加热搜词成功！';
		}
		else
		{
			jieqi_printfail('添加热搜词失败！');
		}
		
		break;
	}
	case 'delete':
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_hotsearchword'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '删除热搜词成功！';
		}
		else
		{
			jieqi_printfail('删除热搜词失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/searchKeyWordsList.php';
	
	$messageTitle = '热搜词设置';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editSearchKeyWord.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");