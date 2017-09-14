<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/21
 * Time: 上午11:22
 */

define('APP_DIR','E:\\\\files\\\\article\\\\app\\\\mianfeidushu.apk');

define('APP_VERSION_FILE','appVersion.txt');

define('APP_ROOT_URL','http://img.mianfeidushu.com');

define('APP_MAX_SIZE','102400000');//100M

define('APP_MIN_SIZE','0');

require_once("../../../global.php");

if (empty($_FILES['apk_file']['name']))
{
	echo __LINE__;
	
	exit;
}

if ($_FILES['apk_file']['size'] > APP_MAX_SIZE || $_FILES['apk_file']['size'] < APP_MIN_SIZE)
{
	jieqi_delfile($_FILES['apk_file']['tmp_name']);
	
	echo __LINE__;
	
	exit;
}

$typeary    = array('.apk');

$apkPostfix = strrchr(trim(strtolower($_FILES['apk_file']['name'])), '.');

if (!preg_match('/\.(apk)$/i', $_FILES['apk_file']['name']))
{
	jieqi_delfile($_FILES['apk_file']['tmp_name']);
	
	echo __LINE__;
	
	exit;
}

//删除旧的apk
jieqi_delfile(APP_DIR);

//移动apk
jieqi_copyfile($_FILES['apk_file']['tmp_name'], APP_DIR, 511, true);

//删除新的apk缓存
jieqi_delfile($_FILES['apk_file']['tmp_name']);

echo 1;
?>