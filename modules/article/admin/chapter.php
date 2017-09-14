<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["viewuplog"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("list", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
include_once ($jieqiModules["article"]["path"] . "/include/funchapter.php");
include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/chapterlist.html";
include_once (JIEQI_ROOT_PATH . "/admin/header.php");
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign("article_static_url", $article_static_url);
$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
$criteria = new CriteriaCompo();

if (!empty($_REQUEST["keyword"])) {
	$_REQUEST["keyword"] = trim($_REQUEST["keyword"]);

	if ($_REQUEST["keytype"] == 1) {
		$criteria->add(new Criteria("poster", $_REQUEST["keyword"], "="));
	}
	else {
		$criteria->add(new Criteria("articlename", $_REQUEST["keyword"], "="));
	}
}

if(!empty($_REQUEST["datestart"])&&!empty($_REQUEST["dateend"])){
	//开始时间和结束时间一样结束时间变为今天23:59
	$datestart=$_REQUEST["datestart"];
	$dateend=$_REQUEST["dateend"]." 23:59:59";
	$criteria->add(new Criteria("lastupdate", strtotime($datestart), ">"));
	$criteria->add(new Criteria("lastupdate", strtotime($dateend), "<"));
}


$jieqiTpl->assign("articletitle", $jieqiLang["article"]["chapter_update_list"]);
$jieqiTpl->assign("url_chapter", $article_dynamic_url . "/admin/chapter.php");
$criteria->setSort("chapterid");
$criteria->setOrder("DESC");

function convertUTF8($str)
{
   if(empty($str)) return '';
   return  iconv('gb2312', 'utf-8', $str);
}

//edit by muyi 2017/04/14
//如果点击导出直接按条件导出不做分页处理
if( $_REQUEST["isexport"] >0){
	$chapter_handler->queryObjects($criteria);
	$count=$chapter_handler->getCount($criteria);
    $chapterrows = array();
    $k = 0;
	while ($v = $chapter_handler->getObject()) {
		$chapterrows[$k] = jieqi_article_chaptervars($v);
		$k++;
	}
	include_once (JIEQI_ROOT_PATH . "/lib/excel/PHPExcel.php");
	// 创建 PHPExcel 
	$objPHPExcel = new PHPExcel();
	// 设置文档属性
	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
								 ->setLastModifiedBy("Maarten Balliauw")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");
	// 设置表头
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', '小说名称')
				->setCellValue('B1', '章节名称')
				->setCellValue('C1', '发表者')
				->setCellValue('D1', '字数')
				->setCellValue('E1', '更新日期')
				->setCellValue('F1', '更新时间')
				->setCellValue('G1', '类型');
	//设置数据
	for($i=2;$i<=$count+1;$i++){
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'. $i, convertUTF8($chapterrows[$i-2]['articlename']))
				->setCellValue('B'. $i, convertUTF8($chapterrows[$i-2]['chaptername']))
				->setCellValue('C'. $i, convertUTF8($chapterrows[$i-2]['poster']))
				->setCellValue('D'. $i, convertUTF8(round($chapterrows[$i-2]['size']/2)))
				->setCellValue('E'. $i, convertUTF8(date("Y-m-d",$chapterrows[$i-2]['lastupdate'])))
				->setCellValue('F'. $i, convertUTF8(date("H:i:s",$chapterrows[$i-2]['lastupdate'])))
				->setCellValue('G'. $i, $chaptertype=$chapterrows[$i-2]['chaptertype']>0?"分卷":"章节");
	}
	//设置表格名称
	$objPHPExcel->getActiveSheet()->setTitle('章节更新记录');
	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="章节更新记录-'.date("YmdHis",time()).'.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
							 
}


$criteria->setLimit($jieqiPset["rows"]);
$criteria->setStart($jieqiPset["start"]);
$chapter_handler->queryObjects($criteria);
$chapterrows = array();
$k = 0;

while ($v = $chapter_handler->getObject()) {
	$chapterrows[$k] = jieqi_article_chaptervars($v);
	$k++;
}

$jieqiTpl->assign_by_ref("chapterrows", $chapterrows);
include_once (JIEQI_ROOT_PATH . "/lib/html/page.php");
$jieqiPset["count"] = $chapter_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$pagelink = "";

if (!empty($_REQUEST["keyword"])) {
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}

	$pagelink .= "keyword=" . urlencode($_REQUEST["keyword"]);
	$pagelink .= "&keytype=" . urlencode($_REQUEST["keytype"]);
}

if(!empty($_REQUEST["datestart"])&&!empty($_REQUEST["dateend"])){
	if (empty($pagelink)) {
		$pagelink .= "?";
	}
	else {
		$pagelink .= "&";
	}
	$pagelink .= "datestart=" . urlencode($_REQUEST["datestart"]);
	$pagelink .= "&dateend=" . urlencode($_REQUEST["dateend"]);
	
}


if (empty($pagelink)) {
	$pagelink .= "?page=";
}
else {
	$pagelink .= "&page=";
}
$jieqiTpl->assign('_request', jieqi_funtoarray('jieqi_htmlstr', $_REQUEST));
$jumppage->setlink($article_dynamic_url . "/admin/chapter.php" . $pagelink, false, true);
$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");

?>
