<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/20
 * Time: 下午1:32
 */

require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/admin/header.php");

include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");

$jieqiTpl->setCaching(0);

//获取小说频道的显示设置
jieqi_getconfigs('article','option','jieqiOption');

//获取小说分类
jieqi_getconfigs('article','sort','jieqiSort');

$oldJieqiSort = $jieqiSort;

if(empty($_REQUEST['action']))
{
	$_REQUEST['action'] = 'show';
}

if(!empty($_REQUEST['id']))
{
	$id = $_REQUEST['id'];
}
else
{
	$id = 0;
}

//分类的名称
$category = trim($_REQUEST['category']);

//所属频道
$rgroupid = trim($_REQUEST['rgroupid']);

$newLine        = "\r\n";

$startContent   = "<?php " . $newLine . iconv('UTF-8', 'gb2312','//小说分类设置 code-英文编码(一般用于路径变量) caption-分类中文名') . $newLine . $newLine;

$endContent     = "?>";

$midSortContent = '';

$modifyFlag     = false;//是否需要修改配置

$messageContent = '';

switch ($_REQUEST['action'])
{
	case 'show':
	{
		if($id != 0)
		{
			$jieqiTpl->assign('id',$id);
			
			$jieqiTpl->assign('category',$oldJieqiSort['article'][$id]['caption']);
			
			$jieqiTpl->assign('rgroupid',$oldJieqiSort['article'][$id]['group']);
		}
		
		$jieqiTpl->assign('rgroup',$jieqiOption['article']['rgroup']);
		
		break;
	}
	case 'edit':
	{
		$oldCategory = $oldJieqiSort['article'][$id]['caption'];
		
		$oldGroupID  = $oldJieqiSort['article'][$id]['group'];
		
		if($oldCategory != $category || $oldGroupID != $rgroupid)
		{
			$code = jieqi_getpinyin($category);
			
			$oldJieqiSort['article'][$id]['code']    = $code;
			
			$oldJieqiSort['article'][$id]['caption'] = $category;
			
			$oldJieqiSort['article'][$id]['group']   = $rgroupid;
			
			$modifyFlag = true;
		}
		
		$messageContent = iconv('UTF-8', 'gb2312','修改小说一级分类成功！');
		
		break;
	}
	case 'add':
	{
		$modifyFlag      = true;
		
		$sort['code']    = jieqi_getpinyin($category);
		
		$sort['caption'] = $category;
		
		$sort['group']   = $rgroupid;
		
		$sort['types']   = array_map();
		
		$oldJieqiSort['article'][] = $sort;
		
		$messageContent = iconv('UTF-8', 'gb2312','增加小说一级分类成功！');
		
		break;
	}
	case 'delete':
	{
		if(!empty($oldJieqiSort['article'][$id]['types']))
		{
			jieqi_printfail(iconv('UTF-8', 'gb2312','该一级分类下面存在二级分类，请移除该分类下面的小说分类再进行操作！'));
		}
		else
		{
			//查看该分类下面是否是小说
			jieqi_includedb();
			
			$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			$sql   = "SELECT count(*) FROM `jieqi_article_article` WHERE `sortid`=" . $id;
			
			$res   = $query->execute($sql);
			$articleCount = $query->getRow($res);
			
			if($articleCount['count(*)'] != 0)
			{
				jieqi_printfail(iconv('UTF-8', 'gb2312','该一级分类下面存在小说，请移除该分类下面的小说再进行操作！'));
			}
		}
		
		$modifyFlag = true;
		
		//修改小说一级分类的展示配置文件
		unset($oldJieqiSort['article'][$id]);
		
		$messageContent = iconv('UTF-8', 'gb2312','删除小说一级分类成功！');
		
		break;
	}
}

if($modifyFlag)
{
	//修改小说一级分类的展示配置文件
	foreach($oldJieqiSort['article'] as $sortKey => $sortValue)
	{
		$midSortContent .= '$jieqiSort[\'article\'][' . $sortKey . '] = ' . var_export($sortValue,true) . ";\r\n\r\n";
	}
	
	$contentSort = $startContent . $midSortContent . $endContent;
	
	iconv('utf8','gb2312', $contentSort);
	
	file_put_contents('../configs/article/sort.php',$contentSort);
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/admin/category.php';
	
	$messageTitle = iconv('UTF-8', 'gb2312','小说一级分类');
	
	jieqi_jumppage($jumpurl,$messageTitle,$messageContent);
}

$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/editArticleCategory.html";
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");

?>