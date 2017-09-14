<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/28
 * Time: ����10:08
 *
 * �༭�ֲ�ͼ
 *
 */

define('SLIDE_BANNER_IMAGE_DIR','E:\\\\files\\\\article\\\\slideBanner\\\\image');

define('SLIDE_BANNER_COUNT',5);

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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_slidebanner'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$slideBanner    = jieqi_query_rowvars($query->getRow());
		
		$bookIDArray    = explode('|',$slideBanner['booksID']);
		
		$bookCoverArray = explode('|',$slideBanner['booksCover']);
		
		if(count($bookIDArray) == count($bookCoverArray))
		{
			$bannerList = array();
			
			for($i = 0; $i < count($bookIDArray);$i++)
			{
				$bannerList[] = array('bookID' => $bookIDArray[$i],'bookCover' => $bookCoverArray[$i]);
			}
			
			if(count($bannerList) < SLIDE_BANNER_COUNT)
			{
				for($j = count($bannerList);$j < SLIDE_BANNER_COUNT; $j++)
				{
					$bannerList[$j] = array('bookID' => null,'bookCover' => '');
				}
			}
			
			$channelList = array(0 => '��ѡ',1 => '��Ƶ', 2 => 'ŮƵ');
			
			$jieqiTpl->assign('channelList',$channelList);
			
			$jieqiTpl->assign('bannerList',$bannerList);
			
			$jieqiTpl->assign('channel',$slideBanner['channel']);
			
			$jieqiTpl->assign('id',$id);
		}
		else
		{
			jieqi_printfail('bookID�ͷ��治��Ӧ����ɾ���������ύ��');
		}
		
		break;
	}
	case 'edit':
	{
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_slidebanner'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$oldSlideBanner = jieqi_query_rowvars($query->getRow());
		
		$oldBookID      = explode('|',$oldSlideBanner['booksID']);
		
		$oldCoverUrl    = explode('|',$oldSlideBanner['booksCover']);
		
		$channel        = trim($_REQUEST['channelid']);
		
		$imgPath        = array();//���ͼƬ����ʵ·��
		
		$tmpCoverUrl    = array();//���ͼƬ����ʵ·��
		
		for($i = 0; $i < SLIDE_BANNER_COUNT; $i++)
		{
			if(strlen(trim($_REQUEST['booksID_' . $i])) != 0)
			{
				$oldBookID[$i] = trim($_REQUEST['booksID_' . $i]);
			}
			
			if(strlen($_FILES['booksCover_' . $i]['name']) != 0)
			{
				//ɾ�������ļ�
				$alimage_postfix = strrchr(trim(strtolower($_FILES['booksCover_' . $i]['name'])), '.');
				
				if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['booksCover_' . $i]['name']))
				{
					if (!in_array($alimage_postfix, $typeary))
					{
						$errtext .= sprintf('Ƶ���ֲ�ͼ��ʽ���󣬱���Ϊ��*%s���ļ���', $jieqiConfigs['article']['imagetype']) . '<br />';
					}
				}
				else
				{
					$errtext .= sprintf('�Բ������ϴ���Ƶ���ֲ�ͼ��%s������ͼƬ�ļ���', $_FILES['booksCover_' . $i]['name']) . '<br />';
				}
				
				//ɾ�������ļ�
				if (!empty($errtext))
				{
					jieqi_delfile($_FILES['booksCover_' . $i]['tmp_name']);
				}
				else
				{
					$imgTag[] = $tmpImgPath = md5(time().'booksCover_' . $i . $channel);
					
					$tmp = dirname($jieqiConfigs['article']['imageurl']) . '/slideBanner/image/' . $tmpImgPath . $alimage_postfix;
					
					$tmpCoverUrl[] = array('cover_id' => $i,'cover_url' => $tmp);
					
					$imgPath[] = $_FILES['booksCover_' . $i]['tmp_name'];
				}
			}
		}
		
		//������µķ����ϴ������Ȱ�ԭ����ͼƬ·����¼�£���ɾ��ԭ����ͼƬ
		$delImgArray = array();
		
		//������µķ����ϴ�����ı�ͼƬ�ķ���·��
		foreach($tmpCoverUrl as $key => $value)
		{
			if(count($oldCoverUrl) < $value['cover_id'])
			{
				$oldCoverUrl[] = $value['cover_url'];
			}
			else
			{
				foreach($oldCoverUrl as $kk => $vv)
				{
					if($value['cover_id'] == $kk)
					{
						$delImgArray[] = $vv;
						
						$oldCoverUrl[$kk] = $value['cover_url'];
					}
				}
			}
		}
		
		$booksID    = implode('|',$oldBookID);
		
		$booksCover = implode('|',$oldCoverUrl);
		
		$sql = 'UPDATE `' . jieqi_dbprefix('app_slidebanner'). "` SET `booksID` = '" . $booksID . "' , `booksCover` = '" . $booksCover . "' , `channel` = '" . $channel . "' WHERE `id` = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			for($i = 0;$i < count($imgPath); $i++)
			{
				//�ƶ�ͼƬ
				jieqi_copyfile($imgPath[$i], SLIDE_BANNER_IMAGE_DIR . '/' . $imgTag[$i] . $alimage_postfix, 511, true);
			}
			
			$messageContent = '�޸�Ƶ���ֲ�ͼ�ɹ���';
		}
		else
		{
			jieqi_printfail('�޸�Ƶ���ֲ�ͼʧ�ܣ�');
		}
		
		//ɾ����ͼƬ
		foreach($delImgArray as $item)
		{
			$oldCover = substr($item , strrpos($item , '/') + 1);//�ɵķ���ͼƬ
			
			//ɾ���ɵķ���ͼƬ
			jieqi_delfile(SLIDE_BANNER_IMAGE_DIR . "\\\\" . $oldCover);
		}
		
		//ɾ������ͼƬ
		for($i = 0;$i < count($imgPath); $i++)
		{
			jieqi_delfile($imgPath[$i]);
		}
		
		break;
	}
	case 'add':
	{
		$tmpBookIDArray = array();
		
		$tmpBookCoverArray = array();
		
		$coverUrlArray = array();//����url
		
		$channel = trim($_REQUEST['channelid']);
		
		$imgTag = array();
		
		for($i = 0;$i < SLIDE_BANNER_COUNT; $i++)
		{
			if(trim($_REQUEST['booksID_' . $i]) && !empty($_FILES['booksCover_' . $i]['name']))
			{
				$tmpBookIDArray[] = trim($_REQUEST['booksID_' . $i]);
			
				//ɾ�������ļ�
				$alimage_postfix = strrchr(trim(strtolower($_FILES['booksCover_' . $i]['name'])), '.');
				
				if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['booksCover_' . $i]['name']))
				{
					if (!in_array($alimage_postfix, $typeary))
					{
						$errtext .= sprintf('Ƶ���ֲ�ͼ��ʽ���󣬱���Ϊ��*%s���ļ���', $jieqiConfigs['article']['imagetype']) . '<br />';
					}
				}
				else
				{
					$errtext .= sprintf('�Բ������ϴ���Ƶ���ֲ�ͼ��%s������ͼƬ�ļ���', $_FILES['booksCover_' . $i]['name']) . '<br />';
				}
				
				//�ж��ϴ���ͼƬ�Ƿ���ȷ������ȷ�Ļ���ɾ������ͼƬ
				if (!empty($errtext))
				{
					jieqi_delfile($_FILES['booksCover_' . $i]['tmp_name']);
				}
				else
				{
					$imgTag[$i] = md5(time().'booksCover_' . $i . $channel);
					
					//ͼƬ�ķ���·��
					$coverUrlArray[] =  dirname($jieqiConfigs['article']['imageurl']) . '/slideBanner/image/' . $imgTag[$i] . $alimage_postfix;
				}
			}
		}
		
		$booksID    = implode('|',$tmpBookIDArray);
	
		$booksCover = implode('|',$coverUrlArray);
		
		if ($booksID && $booksCover)
		{
			$sql = 'INSERT INTO `' . jieqi_dbprefix('app_slidebanner'). "` (`booksID`,`booksCover`,`channel`) VALUES ('" . $booksID . "', '" . $booksCover . "', '"  . $channel . "')";
			
			$row = $query->execute($sql);
			
			if($row)
			{
				for($i = 0;$i < SLIDE_BANNER_COUNT; $i++)
				{
					//�ƶ�ͼƬ
					jieqi_copyfile($_FILES['booksCover_' . $i]['tmp_name'], SLIDE_BANNER_IMAGE_DIR . '/' . $imgTag[$i] . $alimage_postfix, 511, true);
					
					
				}
				
				$messageContent = '���Ƶ���ֲ�ͼ�ɹ���';
			}
			else
			{
				jieqi_printfail('���Ƶ���ֲ�ͼʧ�ܣ�');
			}
			
			for($i = 0;$i < SLIDE_BANNER_COUNT; $i++)
			{
				//ɾ��ͼƬ
				jieqi_delfile($_FILES['booksCover_' . $i]['tmp_name']);
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
		$sql = 'SELECT * FROM ' . jieqi_dbprefix('app_slidebanner'). " WHERE id = " . $id;
		
		$query->execute($sql);
		
		$oldSlideBanner = jieqi_query_rowvars($query->getRow());
		
		$oldCoverUrl = explode('|',$oldSlideBanner['booksCover']);
		
		$sql = 'DELETE FROM `' . jieqi_dbprefix('app_slidebanner'). "` WHERE id = " . $id;
		
		$row = $query->execute($sql);
		
		if($row)
		{
			foreach($oldCoverUrl as $item)
			{
				$oldCover = substr($item , strrpos($item , '/') + 1);//�ɵķ���ͼƬ
			
				//ɾ���ɵķ���ͼƬ
				jieqi_delfile(SLIDE_BANNER_IMAGE_DIR . "\\\\" . $oldCover);
			}
			
			$messageContent = 'ɾ��Ƶ���ֲ�ͼ�ɹ���';
		}
		else
		{
			jieqi_printfail('ɾ��Ƶ���ֲ�ͼʧ�ܣ�');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/slideBannerList.php';
	
	$messageTitle = 'Ƶ���ֲ�ͼ����';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editSlideBanner.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");