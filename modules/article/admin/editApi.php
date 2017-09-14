<?php
/**
 * Created by PhpStorm.
 * User: muyi
 * Date: 2017/4/7
 * Time: 上午11:11
 *
 * 合作方设置
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
		//添加合作方
		$partner  = trim($_REQUEST['partner']);//合作方
		
		$bookIDs  = trim($_REQUEST['bookIDs']);//授权给合作方书籍ID
		
		$url  = trim($_REQUEST['url']);//官网链接	
		
		if(empty($partner)){
			$errtext='合作方不能为空';
		}
		
		if(empty($bookIDs)){
			$errtext='授权书籍不能为空';
		}
		
		
		
		if (empty($errtext))
		{			
			$sql = 'UPDATE `' . jieqi_dbprefix('article_api'). "` SET `partner` = '" . $partner . " ', `bookIDs` = '" . $bookIDs . "' , `url` = '" . $url .  "' WHERE `id` = " . $id;
		
			$row = $query->execute($sql);
			
			if($row!==false)
			{				
				$messageContent = '修改合作方成功！';
			}
			else
			{
				jieqi_printfail('修改合作方失败！');
			}
		}else
		{
			$messageContent = $errtext;
		}		
		
		break;
	}
	case 'add':
	{
		//添加合作方
		$partner  = trim($_REQUEST['partner']);//合作方
		
		$bookIDs  = trim($_REQUEST['bookIDs']);//授权给合作方书籍ID
		
		$url  = trim($_REQUEST['url']);//官网连接		
		$token = md5(time());//访问令牌
		$addtime = time();
		
		if(empty($partner)){
			$errtext='合作方不能为空';
		}
		
		if(empty($bookIDs)){
			$errtext='授权书籍不能为空';
		}
		
		
		if (empty($errtext))
		{
			
			$sql = 'INSERT INTO `' . jieqi_dbprefix('article_api'). "` (`partner`,`bookIDs`,`url`,`token`,`addtime`) VALUES ('" . $partner . "', '" . $bookIDs . "', '"  . $url . "', '" . $token . "', '".$addtime. "')";
			
			$row = $query->execute($sql);
			
			if($row)
			{				
				$messageContent = '添加合作方成功！';
			}
			else
			{
				jieqi_printfail('添加合作方失败！');
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
			$messageContent = '删除合作方成功！';
		}
		else
		{
			jieqi_printfail('删除合作方失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/article/admin/api.php';
	
	$messageTitle = '合作方管理';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/editapi.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");