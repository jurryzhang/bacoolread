<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/28
 * Time: 上午10:08
 *
 * 编辑轮播图
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
			
			$channelList = array(0 => '精选',1 => '男频', 2 => '女频');
			
			$jieqiTpl->assign('channelList',$channelList);
			
			$jieqiTpl->assign('bannerList',$bannerList);
			
			$jieqiTpl->assign('channel',$slideBanner['channel']);
			
			$jieqiTpl->assign('id',$id);
		}
		else
		{
			jieqi_printfail('bookID和封面不对应，请删除后重新提交！');
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
		
		$imgPath        = array();//存放图片的真实路径
		
		$tmpCoverUrl    = array();//存放图片的真实路径
		
		for($i = 0; $i < SLIDE_BANNER_COUNT; $i++)
		{
			if(strlen(trim($_REQUEST['booksID_' . $i])) != 0)
			{
				$oldBookID[$i] = trim($_REQUEST['booksID_' . $i]);
			}
			
			if(strlen($_FILES['booksCover_' . $i]['name']) != 0)
			{
				//删除缓存文件
				$alimage_postfix = strrchr(trim(strtolower($_FILES['booksCover_' . $i]['name'])), '.');
				
				if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['booksCover_' . $i]['name']))
				{
					if (!in_array($alimage_postfix, $typeary))
					{
						$errtext .= sprintf('频道轮播图格式错误，必须为（*%s）文件！', $jieqiConfigs['article']['imagetype']) . '<br />';
					}
				}
				else
				{
					$errtext .= sprintf('对不起，您上传得频道轮播图（%s）不是图片文件！', $_FILES['booksCover_' . $i]['name']) . '<br />';
				}
				
				//删除缓存文件
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
		
		//如果有新的封面上传，则先把原来的图片路劲记录下，在删除原来的图片
		$delImgArray = array();
		
		//如果有新的封面上传，则改变图片的访问路径
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
				//移动图片
				jieqi_copyfile($imgPath[$i], SLIDE_BANNER_IMAGE_DIR . '/' . $imgTag[$i] . $alimage_postfix, 511, true);
			}
			
			$messageContent = '修改频道轮播图成功！';
		}
		else
		{
			jieqi_printfail('修改频道轮播图失败！');
		}
		
		//删除旧图片
		foreach($delImgArray as $item)
		{
			$oldCover = substr($item , strrpos($item , '/') + 1);//旧的封面图片
			
			//删除旧的封面图片
			jieqi_delfile(SLIDE_BANNER_IMAGE_DIR . "\\\\" . $oldCover);
		}
		
		//删除缓存图片
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
		
		$coverUrlArray = array();//封面url
		
		$channel = trim($_REQUEST['channelid']);
		
		$imgTag = array();
		
		for($i = 0;$i < SLIDE_BANNER_COUNT; $i++)
		{
			if(trim($_REQUEST['booksID_' . $i]) && !empty($_FILES['booksCover_' . $i]['name']))
			{
				$tmpBookIDArray[] = trim($_REQUEST['booksID_' . $i]);
			
				//删除缓存文件
				$alimage_postfix = strrchr(trim(strtolower($_FILES['booksCover_' . $i]['name'])), '.');
				
				if (preg_match('/\\.(gif|jpg|jpeg|png|bmp)$/i', $_FILES['booksCover_' . $i]['name']))
				{
					if (!in_array($alimage_postfix, $typeary))
					{
						$errtext .= sprintf('频道轮播图格式错误，必须为（*%s）文件！', $jieqiConfigs['article']['imagetype']) . '<br />';
					}
				}
				else
				{
					$errtext .= sprintf('对不起，您上传得频道轮播图（%s）不是图片文件！', $_FILES['booksCover_' . $i]['name']) . '<br />';
				}
				
				//判断上传的图片是否正确，不正确的话，删除错误图片
				if (!empty($errtext))
				{
					jieqi_delfile($_FILES['booksCover_' . $i]['tmp_name']);
				}
				else
				{
					$imgTag[$i] = md5(time().'booksCover_' . $i . $channel);
					
					//图片的访问路劲
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
					//移动图片
					jieqi_copyfile($_FILES['booksCover_' . $i]['tmp_name'], SLIDE_BANNER_IMAGE_DIR . '/' . $imgTag[$i] . $alimage_postfix, 511, true);
					
					
				}
				
				$messageContent = '添加频道轮播图成功！';
			}
			else
			{
				jieqi_printfail('添加频道轮播图失败！');
			}
			
			for($i = 0;$i < SLIDE_BANNER_COUNT; $i++)
			{
				//删除图片
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
				$oldCover = substr($item , strrpos($item , '/') + 1);//旧的封面图片
			
				//删除旧的封面图片
				jieqi_delfile(SLIDE_BANNER_IMAGE_DIR . "\\\\" . $oldCover);
			}
			
			$messageContent = '删除频道轮播图成功！';
		}
		else
		{
			jieqi_printfail('删除频道轮播图失败！');
		}
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/slideBannerList.php';
	
	$messageTitle = '频道轮播图设置';
	
	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/editSlideBanner.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");