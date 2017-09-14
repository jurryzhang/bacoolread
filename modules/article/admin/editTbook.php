<?php
/**
 * Created by PhpStorm.
 * User: muyi
 * Date: 2017/4/7
 * Time: 上午11:11
 *
 * 精选设置
 *
 */


define('tbook_IMAGE_DIR','E:\\\\files\\\\article\\\\tbook\\\\image');

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

jieqi_getconfigs("article","configs", "jieqiConfigs");

$typeary = explode(" ", trim($jieqiConfigs["article"]["imagetype"]));

foreach ($typeary as $k => $v )
{
	if (substr($v, 0, 1) != ".")
	{
		$typeary[$k] = "." . $typeary[$k];
	}
}

switch ($_REQUEST['action'])
{
	case 'show':
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_tbook'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$tbook = jieqi_query_rowvars($query->getRow());
		
		
		$jieqiTpl->assign('tbook',$tbook);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		//精选
		$sort     = trim($_REQUEST['sort']);//排序
		
		$title       = trim($_REQUEST['title']);//精选标题
		
		$bookID     = trim($_REQUEST['bookID']);//精选书籍
		
		$desc     = trim($_REQUEST['desc']);//精选描述
		
		$oldcoverUrl = trim($_REQUEST['cover']);//封面url
		
		//重新修改图片
		if (!empty($_FILES['tbookCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['tbookCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['tbookCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('精选封面格式错误，必须为（*%s）文件！', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('对不起，您上传得精选封面（%s）不是图片文件！', $_FILES['tbookCover']['name']) . '<br />';
			}
			
			if (!empty($errtext))
			{
				jieqi_delfile($_FILES['tbookCover']['tmp_name']);
			}
		}
		
		if (empty($errtext))
		{
			//重新修改图片
			if(!empty($_FILES['tbookCover']['name']))
			{
				$imgTag   = time();
				
				//图片的访问路径
				$coverUrl =  dirname($jieqiConfigs['article']['imageurl']) . '/tbook/image/' . $imgTag . $alimage_postfix;
				
				$sql = 'UPDATE `' . jieqi_dbprefix('article_tbook'). "` SET `sort` = " . $sort . " , `title` = '" . $title . "' , `desc` = '" . $desc . "' ,`bookID` = '" . $bookID . "',`cover` = '" . $coverUrl . "' WHERE `id` = " . $id;
			}
			else
			{
				$sql = 'UPDATE `' . jieqi_dbprefix('article_tbook'). "` SET `sort` = " . $sort . " , `title` = '" . $title . "' , `desc` = '" . $desc . "' ,`bookID` = '" . $bookID . "' WHERE `id` = " . $id;
			}
			
			$row = $query->execute($sql);
			
			if($row)
			{
				//重新修改图片
				if(!empty($_FILES['tbookCover']['name']))
				{
					$oldCover = substr($oldcoverUrl , strrpos($oldcoverUrl , '/') + 1);//旧的封面图片
					
					//删除旧的封面图片
					jieqi_delfile(tbook_IMAGE_DIR . "\\\\" . $oldCover);
					
					//移动图片
					jieqi_copyfile($_FILES['tbookCover']['tmp_name'], tbook_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				}
				
				$messageContent = '修改精选成功！';
			}
			else
			{
				jieqi_printfail('修改精选失败！');
			}
			
			jieqi_delfile($_FILES['tbookCover']['tmp_name']);
		}
		else
		{
			$messageContent = $errtext;
		}
		
		
		break;
	}
	case 'add':
	{
		//精选
		$sort  = trim($_REQUEST['sort']);//精选id
		
		$title    = trim($_REQUEST['title']);//精选标题
		
		$bookID  = trim($_REQUEST['bookID']);//精选书籍
		
		$desc  = trim($_REQUEST['desc']);//精选简介
		
		$coverUrl = '';//封面url
		$addtime = time();
		
		//删除缓存文件
		if (!empty($_FILES['tbookCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['tbookCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['tbookCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('精选封面格式错误，必须为（*%s）文件！', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('对不起，您上传得精选封面（%s）不是图片文件！', $_FILES['tbookCover']['name']) . '<br />';
			}
			
			if (!empty($errtext))
			{
				jieqi_delfile($_FILES['tbookCover']['tmp_name']);
			}
		}
		
		if (empty($errtext))
		{
			$imgTag = time();
			
			$coverUrl =  dirname($jieqiConfigs['article']['imageurl']) . '/tbook/image/' . $imgTag . $alimage_postfix;
			
			$sql = 'INSERT INTO `' . jieqi_dbprefix('article_tbook'). "` (`sort`,`title`,`desc`,`bookID`,`cover`,`addtime`) VALUES ('" . $sort . "', '" . $title . "', '"  . $desc . "', '" . $bookID .  "', '" . $coverUrl ."', '".$addtime. "')";
			
			$row = $query->execute($sql);
			
			if($row)
			{
				//移动图片
				jieqi_copyfile($_FILES['tbookCover']['tmp_name'], tbook_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				
				$messageContent = '添加精选成功！';
			}
			else
			{
				jieqi_printfail('添加精选失败！');
			}
			
			jieqi_delfile($_FILES['tbookCover']['tmp_name']);
		}
		else
		{
			$messageContent = $errtext;
		}
		
		break;
	}
	case 'delete':
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('article_tbook'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$tbook = jieqi_query_rowvars($query->getRow());
		
		$oldCover = substr($tbook['cover'] , strrpos($tbook['cover'] , '/') + 1);//旧的封面图片
		
		//删除旧的封面图片
		jieqi_delfile(tbook_IMAGE_DIR . "\\\\" . $oldCover);
		
		$sql = 'DELETE FROM `' . jieqi_dbprefix('article_tbook'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '删除精选成功！';
		}
		else
		{
			jieqi_printfail('删除精选失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/article/admin/tbook.php';
	
	$messageTitle = '精选设置';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/editTbook.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");