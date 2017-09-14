<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/20
 * Time: 下午4:54
 */

require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/admin/header.php");
include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");

$jieqiTpl->setCaching(0);

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

//一级分类ID
$firstCatagoryID = trim($_REQUEST['firstCategoryID']);

//二级分类的名称
$category = trim($_REQUEST['category']);

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
			
			$jieqiTpl->assign('category',$oldJieqiSort['article'][$firstCatagoryID]['types'][$id]);
			
			$jieqiTpl->assign('firstCatagoryID',$firstCatagoryID);
		}
		
		$jieqiTpl->assign('firstCategory',$oldJieqiSort['article']);
		
		break;
	}
	case 'edit':
	{	
		if($oldJieqiSort['article'][$firstCatagoryID]['types'][$id] == $category && !empty($oldJieqiSort['article'][$firstCatagoryID]['types'][$id]))
		{
			$modifyFlag = false;
		}
		else
		{
			//先判断该一级分类下面是否存在该二级分类，如果不存在则在原来的一级分类中删除该二级分类，同时在该一级分类中添加该二级分类
			if(empty($oldJieqiSort['article'][$firstCatagoryID]['types'][$id]))
			{
				//先在原来的一级分类中删除该二级分类
				foreach($oldJieqiSort['article'] as $sortKey => $sortValue)
				{
					if(!empty($sortValue['types'][$id]))
					{
						unset($oldJieqiSort['article'][$sortKey]['types'][$id]);
						
						break;
					}
				}
			}
			
			$oldJieqiSort['article'][$firstCatagoryID]['types'][$id] = $category;
			
			$modifyFlag = true;
		}
			
		$messageContent = iconv('UTF-8', 'gb2312','修改小说二级分类成功！');
		
		break;
	}
	case 'add':
	{
		$modifyFlag = true;
		
		//获取最大的二级分类id
		$maxCategoryID = 0;
		
		foreach($oldJieqiSort['article'] as $key => $value)
		{
			foreach($value['types'] as $typeKey => $typeValue)
			{
				if($maxCategoryID <= $typeKey)
				{
					$maxCategoryID = $typeKey;
				}
			}
		}
		
		$maxCategoryID++;
		
		$oldJieqiSort['article'][$firstCatagoryID]['types'][$maxCategoryID] = $category;
		
		$messageContent = iconv('UTF-8', 'gb2312','增加小说二级分类成功！');
		
		break;
	}
	case 'delete':
	{
		//查看该分类下面是否是小说
		jieqi_includedb();
		
		$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
		$sql   = "SELECT count(*) FROM `jieqi_article_article` WHERE `typeid`=" . $id;
		
		$res   = $query->execute($sql);
		$articleCount = $query->getRow($res);
		
		if($articleCount['count(*)'] != 0)
		{
			jieqi_printfail(iconv('UTF-8', 'gb2312','该二级分类下面存在小说，请移除该分类下面的小说再进行操作！'));
		}
		
		$modifyFlag = true;
		
		//修改小说二级分类的展示配置文件
		unset($oldJieqiSort['article'][$firstCatagoryID]['types'][$id]);
		
		$messageContent = iconv('UTF-8', 'gb2312','删除小说二级分类成功！');
		
		break;
	}
}

if($modifyFlag)
{
	//修改小说二级分类的展示配置文件
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
	
	$messageTitle = iconv('UTF-8', 'gb2312','小说二级分类');
	
	jieqi_jumppage($jumpurl,$messageTitle,$messageContent);
}

$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/editSecondaryCategory.html";
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");

?>