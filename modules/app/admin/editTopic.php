<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/27
 * Time: 上午10:15
 *
 * 编辑专题
 *
 */

define('TOPIC_IMAGE_DIR','E:\\\\files\\\\article\\\\topic\\\\image');

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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_topic'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$topic = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('topic',$topic);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		//专题
		$topicID     = trim($_REQUEST['topicID']);//专题id
		
		$title       = trim($_REQUEST['title']);//专题标题
		
		$booksID     = trim($_REQUEST['booksID']);//专题书籍
		
		$summary     = trim($_REQUEST['summary']);//专题简介
		
		$oldcoverUrl = trim($_REQUEST['cover']);//封面url
		
		//重新修改图片
		if (!empty($_FILES['topicCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['topicCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['topicCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('专题封面格式错误，必须为（*%s）文件！', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('对不起，您上传得专题封面（%s）不是图片文件！', $_FILES['topicCover']['name']) . '<br />';
			}
			
			if (!empty($errtext))
			{
				jieqi_delfile($_FILES['topicCover']['tmp_name']);
			}
		}
		
		if (empty($errtext))
		{
			//重新修改图片
			if(!empty($_FILES['topicCover']['name']))
			{
				$imgTag   = time();
				
				//图片的访问路径
				$coverUrl =  dirname($jieqiConfigs['article']['imageurl']) . '/topic/image/' . $imgTag . $alimage_postfix;
				
				$sql = 'UPDATE `' . jieqi_dbprefix('app_topic'). "` SET `topicID` = " . $topicID . " , `title` = '" . $title . "' , `summary` = '" . $summary . "' ,`booksID` = '" . $booksID . "',`cover` = '" . $coverUrl . "' WHERE `id` = " . $id;
			}
			else
			{
				$sql = 'UPDATE `' . jieqi_dbprefix('app_topic'). "` SET `topicID` = " . $topicID . " , `title` = '" . $title . "' , `summary` = '" . $summary . "' ,`booksID` = '" . $booksID . "' WHERE `id` = " . $id;
			}
			
			$row = $query->execute($sql);
			
			if($row)
			{
				//重新修改图片
				if(!empty($_FILES['topicCover']['name']))
				{
					$oldCover = substr($oldcoverUrl , strrpos($oldcoverUrl , '/') + 1);//旧的封面图片
					
					//删除旧的封面图片
					jieqi_delfile(TOPIC_IMAGE_DIR . "\\\\" . $oldCover);
					
					//移动图片
					jieqi_copyfile($_FILES['topicCover']['tmp_name'], TOPIC_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				}
				
				$messageContent = '修改专题成功！';
			}
			else
			{
				jieqi_printfail('修改专题失败！');
			}
			
			jieqi_delfile($_FILES['topicCover']['tmp_name']);
		}
		else
		{
			$messageContent = $errtext;
		}
		
		
		break;
	}
	case 'add':
	{
		//专题
		$topicID  = trim($_REQUEST['topicID']);//专题id
		
		$title    = trim($_REQUEST['title']);//专题标题
		
		$booksID  = trim($_REQUEST['booksID']);//专题书籍
		
		$summary  = trim($_REQUEST['summary']);//专题简介
		
		$coverUrl = '';//封面url
		
		//删除缓存文件
		if (!empty($_FILES['topicCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['topicCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['topicCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('专题封面格式错误，必须为（*%s）文件！', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('对不起，您上传得专题封面（%s）不是图片文件！', $_FILES['topicCover']['name']) . '<br />';
			}
			
			if (!empty($errtext))
			{
				jieqi_delfile($_FILES['topicCover']['tmp_name']);
			}
		}
		
		if (empty($errtext))
		{
			$imgTag = time();
			
			$coverUrl =  dirname($jieqiConfigs['article']['imageurl']) . '/topic/image/' . $imgTag . $alimage_postfix;
			
			$sql = 'INSERT INTO `' . jieqi_dbprefix('app_topic'). "` (`topicID`,`title`,`summary`,`booksID`,`cover`) VALUES ('" . $topicID . "', '" . $title . "', '"  . $summary . "', '" . $booksID .  "', '" . $coverUrl . "')";
			
			$row = $query->execute($sql);
			
			if($row)
			{
				//移动图片
				jieqi_copyfile($_FILES['topicCover']['tmp_name'], TOPIC_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				
				$messageContent = '添加专题成功！';
			}
			else
			{
				jieqi_printfail('添加专题失败！');
			}
			
			jieqi_delfile($_FILES['topicCover']['tmp_name']);
		}
		else
		{
			$messageContent = $errtext;
		}
		
		break;
	}
	case 'delete':
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_topic'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$topic = jieqi_query_rowvars($query->getRow());
		
		$oldCover = substr($topic['cover'] , strrpos($topic['cover'] , '/') + 1);//旧的封面图片
		
		//删除旧的封面图片
		jieqi_delfile(TOPIC_IMAGE_DIR . "\\\\" . $oldCover);
		
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_topic'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = '删除专题成功！';
		}
		else
		{
			jieqi_printfail('删除专题失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/topicList.php';
	
	$messageTitle = '专题设置';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editTopic.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");