<?php
/**
 * Created by PhpStorm.
 * User: muyi
 * Date: 2017/4/7
 * Time: ����11:11
 *
 * ��ѡ����
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

//��ȡ���Ѵ�
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
		//��ѡ
		$sort     = trim($_REQUEST['sort']);//����
		
		$title       = trim($_REQUEST['title']);//��ѡ����
		
		$bookID     = trim($_REQUEST['bookID']);//��ѡ�鼮
		
		$desc     = trim($_REQUEST['desc']);//��ѡ����
		
		$oldcoverUrl = trim($_REQUEST['cover']);//����url
		
		//�����޸�ͼƬ
		if (!empty($_FILES['tbookCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['tbookCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['tbookCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('��ѡ�����ʽ���󣬱���Ϊ��*%s���ļ���', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('�Բ������ϴ��þ�ѡ���棨%s������ͼƬ�ļ���', $_FILES['tbookCover']['name']) . '<br />';
			}
			
			if (!empty($errtext))
			{
				jieqi_delfile($_FILES['tbookCover']['tmp_name']);
			}
		}
		
		if (empty($errtext))
		{
			//�����޸�ͼƬ
			if(!empty($_FILES['tbookCover']['name']))
			{
				$imgTag   = time();
				
				//ͼƬ�ķ���·��
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
				//�����޸�ͼƬ
				if(!empty($_FILES['tbookCover']['name']))
				{
					$oldCover = substr($oldcoverUrl , strrpos($oldcoverUrl , '/') + 1);//�ɵķ���ͼƬ
					
					//ɾ���ɵķ���ͼƬ
					jieqi_delfile(tbook_IMAGE_DIR . "\\\\" . $oldCover);
					
					//�ƶ�ͼƬ
					jieqi_copyfile($_FILES['tbookCover']['tmp_name'], tbook_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				}
				
				$messageContent = '�޸ľ�ѡ�ɹ���';
			}
			else
			{
				jieqi_printfail('�޸ľ�ѡʧ�ܣ�');
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
		//��ѡ
		$sort  = trim($_REQUEST['sort']);//��ѡid
		
		$title    = trim($_REQUEST['title']);//��ѡ����
		
		$bookID  = trim($_REQUEST['bookID']);//��ѡ�鼮
		
		$desc  = trim($_REQUEST['desc']);//��ѡ���
		
		$coverUrl = '';//����url
		$addtime = time();
		
		//ɾ�������ļ�
		if (!empty($_FILES['tbookCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['tbookCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['tbookCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('��ѡ�����ʽ���󣬱���Ϊ��*%s���ļ���', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('�Բ������ϴ��þ�ѡ���棨%s������ͼƬ�ļ���', $_FILES['tbookCover']['name']) . '<br />';
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
				//�ƶ�ͼƬ
				jieqi_copyfile($_FILES['tbookCover']['tmp_name'], tbook_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				
				$messageContent = '��Ӿ�ѡ�ɹ���';
			}
			else
			{
				jieqi_printfail('��Ӿ�ѡʧ�ܣ�');
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
		
		$oldCover = substr($tbook['cover'] , strrpos($tbook['cover'] , '/') + 1);//�ɵķ���ͼƬ
		
		//ɾ���ɵķ���ͼƬ
		jieqi_delfile(tbook_IMAGE_DIR . "\\\\" . $oldCover);
		
		$sql = 'DELETE FROM `' . jieqi_dbprefix('article_tbook'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = 'ɾ����ѡ�ɹ���';
		}
		else
		{
			jieqi_printfail('ɾ����ѡʧ�ܣ�');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/article/admin/tbook.php';
	
	$messageTitle = '��ѡ����';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/editTbook.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");