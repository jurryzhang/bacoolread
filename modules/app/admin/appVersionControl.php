<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 下午3:45
 *
 * app版本控制
 *
 */
define('APP_DIR','E:\\\\files\\\\article\\\\app\\\\mianfeidushu.apk');

define('APP_VERSION_FILE','appVersion.txt');

define('APP_ROOT_URL','http://img.mianfeidushu.com');

require_once '../../../global.php';
require_once '../../../admin/header.php';

$jieqiTpl->setCaching(0);

if(empty($_REQUEST['action']))
{
	$_REQUEST['action'] = 'show';
}

$messageContent = '';

switch ($_REQUEST['action'])
{
	case 'show':
	{
		$version = file_get_contents(APP_VERSION_FILE);
		
		$jieqiTpl->assign('version',$version);
		
		break;
	}
	case 'edit':
	{
		$version = trim($_REQUEST['version']);
		
		file_put_contents(APP_VERSION_FILE,$version);
		
		break;
	}
}

if($_REQUEST['action'] != 'show')
{
	$jumpurl = JIEQI_URL . '/modules/app/admin/appVersionControl.php';

	$messageTitle = 'APP版本控制';

	jieqi_jumppage($jumpurl, $messageTitle, $messageContent);
}

$jieqiTset["jieqi_contents_template"] = "./templates/appVersionControl.html";

include_once (JIEQI_ROOT_PATH . "/admin/footer.php");