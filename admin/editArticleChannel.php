<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/19
 * Time: 下午6:22
 */

require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/admin/header.php");

$jieqiTpl->setCaching(0);

//获取小说频道分类的显示设置
jieqi_getconfigs('article','option','jieqiOption');

$oldJieqiOption = $jieqiOption;

//获取小说的过滤配置
jieqi_getconfigs('article','filter','jieqiFilter');

$oldJieqiFilter = $jieqiFilter;

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
	$id      = 0;
	
	$channel = '';
}

$newLine          = "\r\n";

$startContent     = "<?php" . $newLine . $newLine;

$endContent       = "?>";

$midOptionContent = '';

$midFilterContent = '';

$modifyFlag       = false;//是否需要修改配置

$messageContent   = '';

switch ($_REQUEST['action'])
{
	case 'show':
	{
		if($id != 0)
		{
			$jieqiTpl->assign('id',$_REQUEST['id']);
			
			$jieqiTpl->assign('channel',$oldJieqiOption['article']['rgroup']['items'][$_REQUEST['id']]);
		}
		
		break;
	}
	case 'edit':
	{
		$oldChannel = $oldJieqiOption['article']['rgroup']['items'][$id];
		
		if($oldChannel != trim($_REQUEST['channel']))
		{
			$modifyFlag = true;
			
			//修改小说频道分类的展示配置
			$oldJieqiOption['article']['rgroup']['items'][$id] = trim($_REQUEST['channel']);
			
			//修改小说频道分类的过滤配置
			$oldJieqiFilter['article']['rgroup'][$id]['caption'] = trim($_REQUEST['channel']);
		}
		
		$messageContent = iconv('UTF-8', 'gb2312','修改小说频道成功！');
		
		break;
	}
	case 'add':
	{
		$modifyFlag = true;
		
		$optionItem = trim($_REQUEST['channel']);
		
		$oldJieqiOption['article']['rgroup']['items'][] = $optionItem;
		
		$newKey = array_search($optionItem,$oldJieqiOption['article']['rgroup']['items']);
		
		$newFilter = array('caption' => $optionItem,'rgroup' => $newKey);
		
		$oldJieqiFilter['article']['rgroup'][] = $newFilter;
		
		$messageContent = iconv('UTF-8', 'gb2312','增加小说频道成功！');
		
		break;
	}
	case 'delete':
	{
		jieqi_getconfigs('article','sort','jieqiSort');
		
		foreach($jieqiSort['article'] as $key => $value)
		{
			if(intval($value['group']) == $id)
			{
				jieqi_printfail(iconv('UTF-8', 'gb2312','该频道下面存在小说分类，请移除该频道下面的小说分类再进行操作！'));
			}
		}
		
		$modifyFlag = true;
		
		//修改小说频道分类的展示配置文件
		unset($oldJieqiOption['article']['rgroup']['items'][$id]);
		
		//修改小说频道分类的过滤配置文件
		unset($oldJieqiFilter['article']['rgroup'][$id]);
		
		$messageContent = iconv('UTF-8', 'gb2312','删除小说频道成功！');
		
		break;
	}
}

if($modifyFlag)
{
	//修改小说频道分类的展示配置文件
	foreach($oldJieqiOption['article'] as $optionKey => $optionValue)
	{
		$midOptionContent .= '$jieqiOption[\'article\'][\'' . $optionKey . '\'] = ' . var_export($optionValue,true) . ";\r\n\r\n";
	}
	
	$contentOption = $startContent . $midOptionContent . $endContent;
	
	iconv('utf8','gb2312', $contentOption);
	
	file_put_contents('../configs/article/option.php',$contentOption);
	
	//修改小说频道分类的过滤配置文件
	foreach($oldJieqiFilter['article'] as $filterKey => $filterValue)
	{
		$midFilterContent .= '$jieqiFilter[\'article\'][\'' . $filterKey . '\'] = ' . var_export($filterValue,true) . ";\r\n\r\n";;
	}
	
	$contentFilter = $startContent . $midFilterContent . $endContent;
	
	iconv('utf8','gb2312', $contentFilter);
	
	file_put_contents('../configs/article/filter.php',$contentFilter);
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/admin/category.php';
	
	$messageTitle = iconv('UTF-8', 'gb2312','小说频道分类');
	
	jieqi_jumppage($jumpurl,$messageTitle,$messageContent);
}

$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/editArticleChannel.html";
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");

?>