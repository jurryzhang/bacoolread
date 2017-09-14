<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/27
 * Time: 下午5:47
 *
 * 编辑热推书专区
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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_hotcommend'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$hotcommend = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('hotcommend',$hotcommend);
		
		$channelArray = array(0 => '精选',1 => '男频', 2 => '女频');
		
		$jieqiTpl->assign('channelList',$channelArray);
		
		$showArray = array(1 => '第一顺序区域',2 => '第二顺序区域', 3 => '第三顺序区域');
		
		$jieqiTpl->assign('showOrder',$showArray);
		
		$jieqiTpl->assign('hotcommend',$hotcommend);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		$title    = trim($_REQUEST['title']);//专题id
		
		$showID   = trim($_REQUEST['showid']);//显示顺序
		
		$booksID  = trim($_REQUEST['booksID']);//专题标题
		
		$channel  = trim($_REQUEST['channelid']);//专题书籍
		
		$sql = 'UPDATE `' . jieqi_dbprefix('app_hotcommend'). "` SET `title` = '" . $title . "' ,`showID` = '" . $showID . "' ,`booksID` = '" . $booksID . "' ,`channel` = '" . $channel . "' WHERE `id` = " . $id;
			
		$row = $query->execute($sql);
			
		if($row)
		{
			$messageContent = '修改热推书专区成功！';
		}
		else
		{
			jieqi_printfail('修改热推书专区失败！');
		}
			
		break;
	}
	case 'add':
	{
		$title    = trim($_REQUEST['title']);//专题id
		
		$showID   = trim($_REQUEST['showid']);//显示顺序
		
		$booksID  = trim($_REQUEST['booksID']);//专题标题
		
		$channel  = trim($_REQUEST['channelid']);//专题书籍
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('app_hotcommend'). "` (`title`,`showID`,`booksID`,`channel`) VALUES ('" . $title . "', '" . $showID . "', '" . $booksID . "', '" . $channel . "')";
			
		$row = $query->execute($sql);
			
		if($row)
		{
			$messageContent = '添加热推书专区成功！';
		}
		else
		{
			jieqi_printfail('添加热推书专区失败！');
		}
			
		break;
	}
	case 'delete':
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_hotcommend'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '删除热推书专区成功！';
		}
		else
		{
			jieqi_printfail('删除热推书专区失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/hotCommendList.php';
	
	$messageTitle = '热推书专区';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editHotCommend.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");