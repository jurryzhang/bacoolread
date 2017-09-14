<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 下午12:35
 *
 * 编辑常见问题；editQuestionAndAnswer
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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_questionandanswer'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$questionAndAnswer = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('questionAndAnswer',$questionAndAnswer);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		$question = trim($_REQUEST['question']);
		
		$answer   = trim($_REQUEST['answer']);
		
		$showID   = trim($_REQUEST['showid']);
		
		$time     = time();
		
		$sql = 'UPDATE `' . jieqi_dbprefix('app_questionandanswer'). "` SET `question` = '" . $question . "', `answer` = '" . $answer . "', `time` = '" . $time . "', `showid` = '" . $showID . "' WHERE `id` = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '修改常见问题成功！';
		}
		else
		{
			jieqi_printfail('修改常见问题失败！');
		}
		
		break;
	}
	case 'add':
	{
		$question = trim($_REQUEST['question']);
		
		$answer   = trim($_REQUEST['answer']);
		
		$showID   = trim($_REQUEST['showid']);
		
		$time     = time();
		
		$sql = 'INSERT INTO `' . jieqi_dbprefix('app_questionandanswer'). "` (`question`,`answer`,`time`,`showid`) VALUES ('" . $question . "', '" . $answer . "', '" . $time . "', '" . $showID ."')";
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '添加常见问题成功！';
		}
		else
		{
			jieqi_printfail('添加常见问题失败！');
		}
		
		break;
	}
	case 'delete':
	{
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_questionandanswer'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '删除常见问题成功！';
		}
		else
		{
			jieqi_printfail('删除常见问题失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl      = JIEQI_URL . '/modules/app/admin/questionAndAnswerList.php';
	
	$messageTitle = '常见问题设置';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editQuestionAndAnswer.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");