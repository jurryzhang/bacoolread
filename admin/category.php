<?php
/**
 * ��̨ϵͳ����С˵��������
 *
 * burn������2016-12-16
 *
 */

//$newLine = "\r\n";

//$startContent = "<?php" . $newLine . "//С˵�������� code-Ӣ�ı���(һ������·������) caption-����������" . $newLine;

$endContent   = "?>";

//include_once '../global.php';

//jieqi_getconfigs('article','sort','jieqiSort');

//$midContent = '';

//foreach($jieqiSort['article'] as $key => $value)
{
	//	$midContent .= '$jieqiTestSort[\'article\'][' . $key . '] = ' . var_export($value,true) . ";\r\n\r\n";
}

$content = $startContent . $midContent . $endContent;

//file_put_contents('../configs/article/testSort.php',$content);

//include_once '../lib/text/textfunction.php';
//
//$res = jieqi_getpinyin('����֮���ʹ���');
//
//var_dump($res);

//jieqi_getconfigs('article','testSort','jieqiTestSort');

//var_dump($jieqiTestSort);

require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/admin/header.php");

$jieqiTpl->setCaching(0);

//С˵Ƶ������
jieqi_getconfigs('article','option','jieqiOption');

foreach($jieqiOption['article']['rgroup']['items'] as $key => $value)
{
	$articleChannel[$key]['id']   = $key;
	
	$articleChannel[$key]['name'] = $value;
}

$jieqiTpl->assign('articleChannel',$articleChannel);

//С˵һ������
jieqi_getconfigs('article','sort','jieqiSort');

foreach($jieqiSort['article'] as $id => $item)
{
	$jieqiSort['article'][$id]['id']   = $id;
	
	foreach($jieqiSort['article'][$id]['types'] as $key => $value)
	{
		$tmp['id']   = $key;
		
		$tmp['name'] = $value;
		
		$types[] = $tmp;
	}
	
	$jieqiSort['article'][$id]['types'] = $types;
	
	unset($types);
}

$jieqiTpl->assign('jieqiSort',$jieqiSort['article']);

$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/category.html";
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");


?>
