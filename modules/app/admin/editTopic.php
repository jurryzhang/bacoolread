<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/27
 * Time: ����10:15
 *
 * �༭ר��
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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_topic'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$topic = jieqi_query_rowvars($query->getRow());
		
		$jieqiTpl->assign('topic',$topic);
		
		$jieqiTpl->assign('id',$id);
		
		break;
	}
	case 'edit':
	{
		//ר��
		$topicID     = trim($_REQUEST['topicID']);//ר��id
		
		$title       = trim($_REQUEST['title']);//ר�����
		
		$booksID     = trim($_REQUEST['booksID']);//ר���鼮
		
		$summary     = trim($_REQUEST['summary']);//ר����
		
		$oldcoverUrl = trim($_REQUEST['cover']);//����url
		
		//�����޸�ͼƬ
		if (!empty($_FILES['topicCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['topicCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['topicCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('ר������ʽ���󣬱���Ϊ��*%s���ļ���', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('�Բ������ϴ���ר����棨%s������ͼƬ�ļ���', $_FILES['topicCover']['name']) . '<br />';
			}
			
			if (!empty($errtext))
			{
				jieqi_delfile($_FILES['topicCover']['tmp_name']);
			}
		}
		
		if (empty($errtext))
		{
			//�����޸�ͼƬ
			if(!empty($_FILES['topicCover']['name']))
			{
				$imgTag   = time();
				
				//ͼƬ�ķ���·��
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
				//�����޸�ͼƬ
				if(!empty($_FILES['topicCover']['name']))
				{
					$oldCover = substr($oldcoverUrl , strrpos($oldcoverUrl , '/') + 1);//�ɵķ���ͼƬ
					
					//ɾ���ɵķ���ͼƬ
					jieqi_delfile(TOPIC_IMAGE_DIR . "\\\\" . $oldCover);
					
					//�ƶ�ͼƬ
					jieqi_copyfile($_FILES['topicCover']['tmp_name'], TOPIC_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				}
				
				$messageContent = '�޸�ר��ɹ���';
			}
			else
			{
				jieqi_printfail('�޸�ר��ʧ�ܣ�');
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
		//ר��
		$topicID  = trim($_REQUEST['topicID']);//ר��id
		
		$title    = trim($_REQUEST['title']);//ר�����
		
		$booksID  = trim($_REQUEST['booksID']);//ר���鼮
		
		$summary  = trim($_REQUEST['summary']);//ר����
		
		$coverUrl = '';//����url
		
		//ɾ�������ļ�
		if (!empty($_FILES['topicCover']['name']))
		{
			$alimage_postfix = strrchr(trim(strtolower($_FILES['topicCover']['name'])), '.');
			
			if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['topicCover']['name']))
			{
				if (!in_array($alimage_postfix, $typeary))
				{
					$errtext .= sprintf('ר������ʽ���󣬱���Ϊ��*%s���ļ���', $jieqiConfigs['article']['imagetype']) . '<br />';
				}
			}
			else
			{
				$errtext .= sprintf('�Բ������ϴ���ר����棨%s������ͼƬ�ļ���', $_FILES['topicCover']['name']) . '<br />';
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
				//�ƶ�ͼƬ
				jieqi_copyfile($_FILES['topicCover']['tmp_name'], TOPIC_IMAGE_DIR . '/' . $imgTag . $alimage_postfix, 511, true);
				
				$messageContent = '���ר��ɹ���';
			}
			else
			{
				jieqi_printfail('���ר��ʧ�ܣ�');
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
		
		$oldCover = substr($topic['cover'] , strrpos($topic['cover'] , '/') + 1);//�ɵķ���ͼƬ
		
		//ɾ���ɵķ���ͼƬ
		jieqi_delfile(TOPIC_IMAGE_DIR . "\\\\" . $oldCover);
		
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_topic'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			$messageContent = 'ɾ��ר��ɹ���';
		}
		else
		{
			jieqi_printfail('ɾ��ר��ʧ�ܣ�');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/topicList.php';
	
	$messageTitle = 'ר������';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editTopic.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");