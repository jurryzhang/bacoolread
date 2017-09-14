<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

function jieqi_excel_addrow($row, $sheet)
{
	static $excel_roworder = 1;
	$k = 1;

	foreach ($row as $v ) {
		$cellcode = jieqi_excel_colcode($k) . $excel_roworder;
		$sheet->setCellValue($cellcode, iconv("GBK", "UTF-8//IGNORE", $v));
		$sheet->getStyle($cellcode)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyle($cellcode)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyle($cellcode)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyle($cellcode)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		if ($excel_roworder == 1) {
			$sheet->getStyle($cellcode)->getFont()->setBold(true);
			$sheet->getStyle($cellcode)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}

		$k++;
	}

	$excel_roworder++;
}

function jieqi_excel_setwidth($row, $sheet)
{
	$k = 1;

	foreach ($row as $v ) {
		$sheet->getColumnDimension(jieqi_excel_colcode($k))->setWidth(intval($v));
		$k++;
	}
}

function jieqi_excel_colcode($k)
{
	$ret = "";
	$k = intval($k);

	if (0 < $k) {
		while (26 < $k) {
			$ret = chr(64 + ($k % 26)) . $ret;
			$k = floor($k / 26);
		}

		$ret = chr(64 + $k) . $ret;
	}

	return $ret;
}

define("JIEQI_MODULE_NAME", "obook");
require_once ("../../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_getconfigs("article", "configs");
jieqi_getconfigs("obook", "configs");
jieqi_getconfigs("article", "sort");
jieqi_getconfigs("system", "sites", "jieqiSites");
jieqi_getconfigs("article", "option", "jieqiOption");
jieqi_getconfigs("obook", "export", "jieqiExport");

if (empty($_POST["act"]) || ($_POST["act"] != "make")) {
	$jieqiTset["jieqi_contents_template"] = $jieqiModules["obook"]["path"] . "/templates/admin/mreport.html";
	include_once (JIEQI_ROOT_PATH . "/admin/header.php");
	$obook_static_url = (empty($jieqiConfigs["obook"]["staticurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["staticurl"]);
$obook_dynamic_url = (empty($jieqiConfigs["obook"]["dynamicurl"]) ? $jieqiModules["obook"]["url"] : $jieqiConfigs["obook"]["dynamicurl"]);
$jieqiTpl->assign("obook_static_url", $obook_static_url);
$jieqiTpl->assign("obook_dynamic_url", $obook_dynamic_url);

	if (2 <= floatval(JIEQI_VERSION)) {
		$customsites = array();

		foreach ($jieqiSites as $k => $v ) {
			if (!empty($v["custom"])) {
				$customsites[$k] = $v;
			}
		}

		$jieqiTpl->assign("customsites", jieqi_funtoarray("jieqi_htmlstr", $customsites));
		$jieqiTpl->assign("customsitenum", count($customsites));
		$jieqiTpl->assign("jieqisites", jieqi_funtoarray("jieqi_htmlstr", $jieqiSites));
	}
	$date = date('Y年m月d日 H时',time());
    $dyear = date('Y',time());//今年
	$emonth = date('m',time());//本月
	if($emonth == 1){
	$dmonth = 12;
	}else{
	$dmonth = $emonth - 1;	
	}
	$rmonthrows = array(); 
	$q = 0; 
	for ($a = 0; $a < 12; $a++) { 
	$rmonthrows[$q]=$a+1; 
	$q++; 
	} 
    foreach ($rmonthrows as $k => $v ) {
				$rmonthrows[$k] = $v;
		}
	$jieqiTpl->assign("rmonthrows", jieqi_funtoarray("jieqi_htmlstr", $rmonthrows));
	
	$ryearrows = array(); 
	$j = 0; 
	for ($i = $dyear - 10; $i < $dyear; $i++) { 
	$ryearrows[$j]=$i+1; 
	$j++; 
	} 
    foreach ($ryearrows as $k => $v ) {
				$ryearrows[$k] = $v;
		}
	$jieqiTpl->assign("ryearrows", jieqi_funtoarray("jieqi_htmlstr", $ryearrows));
	
$jieqiPset = jieqi_get_pageset();	
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
$slimit = "1";
	
if (!empty($_REQUEST["obookname"])) {
	$slimit .= " AND obookname =  '" . jieqi_dbslashes($_REQUEST["obookname"]) . "'";
}	

if (!empty($_REQUEST["author"])) {
	$slimit .= " AND author =  '" . jieqi_dbslashes($_REQUEST["author"]) . "'";
}	

if (!empty($_REQUEST["reportmonth"])) {
	$slimit .= " AND data = " . intval($_REQUEST["reportmonth"]);
}


$sql = "SELECT * FROM " . jieqi_dbprefix("obook_mreport") . " WHERE $slimit ORDER BY id DESC LIMIT {$jieqiPset["start"]},{$jieqiPset["rows"]}";
$query->execute($sql);
$mreportrows = array();
$k = 0;
while ($row = $query->getRow()) {
	$mreportrows[$k] = jieqi_query_rowvars($row);
//var_dump($row);
	$k++;
}

	$jieqiTpl->assign_by_ref("mreportrows", $mreportrows);
	$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
	include_once (JIEQI_ROOT_PATH . "/lib/html/page.php");
	$sql = "SELECT count(*) AS cot, sum(sumgold) as sumegold, sum(sumtip) as sumtip, sum(sumgift) as sumgift, sum(sumemoney) as sumemoney FROM " . jieqi_dbprefix("obook_mreport") . " WHERE $slimit";
	$query->execute($sql);
	$row = $query->getRow();
	$jieqiTpl->assign("mreportstat", jieqi_funtoarray("jieqi_htmlstr", $row));
	$jieqiPset["count"] = intval($row["cot"]);
	$jumppage = new JieqiPage($jieqiPset);
	$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
	
	
	$jieqiTpl->assign("dyear", $dyear);
	$jieqiTpl->assign("dmonth", $dmonth);
	$jieqiTpl->setCaching(0);
	include_once (JIEQI_ROOT_PATH . "/admin/footer.php");
}
else {
	jieqi_checkpost();
	jieqi_includedb();
	$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	$where = "";
//	$badparm = false;

//if (!empty($_REQUEST["sites"])) {
//	$where .= " AND siteid =  " . intval($_POST["sites"]);
//}	


	if (!empty($_POST["sites"])) {
		if ($where != "") {
			$where .= " AND";
    	}

		$where .= " siteid = " . intval($_POST["sites"]);
	}

	if (!empty($_POST["ryear"]) && !empty($_POST["rmonth"])) {
		$data = $_POST["ryear"].$_POST["rmonth"];
		if ($where != "") {
			$where .= " AND";
		}

		$where .= " data = " .$data;
	}


//	if ($badparm) {
//		jieqi_printfail(LANG_ERROR_PARAMETER);
//	}

	if (empty($where)) {
		$where = "1";
	}

	$sql = "SELECT * FROM " . jieqi_dbprefix("obook_mreport") . " WHERE $where ORDER BY id asc";
	$query->execute($sql);
	include_once (JIEQI_ROOT_PATH . "/header.php");
	include_once (JIEQI_ROOT_PATH . "/lib/excel/PHPExcel.php");
	include_once (JIEQI_ROOT_PATH . "/lib/excel/PHPExcel/Writer/Excel5.php");
	$objExcel = new PHPExcel();
	$objWriter = new PHPExcel_Writer_Excel5($objExcel);
	$objProps = $objExcel->getProperties();
	$objProps->setCreator("JIEQI CMS");
	$objProps->setLastModifiedBy("JIEQI CMS");
	$objProps->setTitle("Article");
	$objProps->setSubject("Book");
	$objProps->setDescription("");
	$objProps->setKeywords("");
	$objProps->setCategory("");
	$objExcel->setActiveSheetIndex(0);
	$objActSheet = $objExcel->getActiveSheet();
	$objActSheet->setTitle("Sheet1");
	$titlefields = array();
	$titlewidth = array();

	foreach ($jieqiExport["obook"] as $k => $v ) {
		if (0 < $v["display"]) {
			$titlefields[$k] = $v["caption"];
			$titlewidth[$k] = $v["width"];
		}
	}

	if (empty($titlefields)) {
		jieqi_printfail(LANG_ERROR_PARAMETER);
	}

	$line = array_values($titlefields);
	jieqi_excel_addrow($line, $objActSheet);
	jieqi_excel_setwidth($titlewidth, $objActSheet);

	while ($row = $query->getRow()) {
		$row = jieqi_query_rowvars($row);
		$line = array();

		foreach ($titlefields as $k => $v ) {
			$line[] = (isset($row[$k]) ? $row[$k] : "");

		}

		jieqi_excel_addrow($line, $objActSheet);
	}

	$outputFileName = "obook_" . date("Ymd") . ".xls";
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition:attachment;filename=\"" . jieqi_headstr($outputFileName) . "\"");
	header("Content-Transfer-Encoding: binary");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Pragma: no-cache");
	header("content-Type:application/vnd.ms-excel;charset=gbk");
	$objWriter->save("php://output");
}

?>
