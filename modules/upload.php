<?php

//var_dump($_POST);
//die();
$phpsir_debug = 0; 
define("JIEQI_MODULE_NAME", "article");
require_once("../../global.php");
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "ebook", "jieqiConfigs");
$time = microtime(true);
set_time_limit(3600);

if (empty($_POST['type'])) exit;
if (empty($_POST['userid'])) exit;
if (empty($_POST['token'])) exit;
$data = unserialize(base64_decode(str_pad(strtr($_POST['token'], '-_', '+/'), strlen($_POST['token']) % 4, '=', STR_PAD_RIGHT)));
if (empty($data)) { echo __LINE__; exit;}
$sign = array_pop($data);
if ($sign !== md5('mc_' . serialize($data))) { echo __LINE__; exit;}
if ($data['userid'] != $_POST['userid']) { echo __LINE__; exit;}
if ($data['ip'] !== $_SERVER['REMOTE_ADDR']) { echo __LINE__; exit;}
if ($data['time'] < $time - 3600) { echo __LINE__; exit;}
$type = strtolower(trim($_POST['type']));
if (!in_array($type, array('cover', 'ebook')))  { echo __LINE__; exit;}
if (empty($_FILES[$type]['name'])) { echo __LINE__; exit;}
jieqi_includedb();
$query_handler = jieqiqueryhandler::getinstance("JieqiQueryHandler");
$query = $query_handler->db->query("SELECT * FROM ".jieqi_dbprefix("article_upload")." WHERE type='$type' AND sign='$sign'");
$upinfo = $query_handler->getobject($query);
if (!empty($upinfo) && $upinfo->getvar("status"))  { echo __LINE__; exit;}
if ($type === 'cover') {
	if (!preg_match('/\.(jpg|jpeg|gif|png)$/i', $_FILES['cover']['name']))  { echo __LINE__; exit;}
	$image = file_get_contents($_FILES['cover']['tmp_name']);
	//var_dump($_FILES); 
	jieqi_delfile($_FILES['cover']['tmp_name']);
		if (empty($image))  { echo __LINE__; exit;}
		$im = imagecreatefromstring($image);
	if (!is_resource($im))  { echo __LINE__; exit;}
	ob_start();
	imagejpeg($im);
	$data =ob_get_contents();
	ob_end_clean();


	imagedestroy($im);
	
} else if ($type === 'ebook') {
	//echo __LINE__;
	if (!preg_match('/\.(txt|text)$/i', $_FILES['ebook']['name']))  { echo __LINE__; exit;}
	if ($_FILES['ebook']['size'] > $jieqiConfigs['article']['maxsize'] * 1024 || $_FILES['ebook']['size'] < $jieqiConfigs['article']['minsize'] * 1024)  { echo __LINE__; exit;}
	$content = file_get_contents($_FILES['ebook']['tmp_name']);
	jieqi_delfile($_FILES['ebook']['tmp_name']);
	if (empty($content))  { echo __LINE__; exit;}
	include_once($jieqiModules['article']['path']."/class/ebook.php");
	$data = readList($content);
	if (empty($data))  { echo __LINE__; exit;}
}

//var_dump($upinfo);
if (empty($upinfo)) {
 // echo __LINE__;
	$query = $query_handler->db->query("INSERT INTO ".jieqi_dbprefix("article_upload")." (id, type, sign, uptime, status) VALUES (NULL, '$type', '$sign', '".time()."', '0')");
	if (empty($query))  { echo __LINE__; exit;}
	$id = $query_handler->db->getinsertid();
} else {
		 // echo __LINE__;

	$id = $upinfo->getvar("id");
	$query = $query_handler->db->query("UPDATE ".jieqi_dbprefix("article_upload")." SET uptime='".time()."' WHERE id='$id'");
	if (empty($query))  { echo __LINE__; exit;}
}
$datapath = jieqi_uploadpath($jieqiConfigs['article']['uploaddir'], "article")."/".floor($id/1000);
jieqi_checkdir($datapath, true);
jieqi_writefile($datapath."/$id.tmp", serialize($data));
echo $id;
?>