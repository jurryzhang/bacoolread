<?php
if(!defined('ISEXIST'))exit("请从入口文件运行程序");

define('ROOT_PATH',dirname(str_replace('\\','/',__FILE__)));
define('INCLUDE_DIR',dirname(str_replace('\\','/',__FILE__))."/include");
define('JIEQI_PATH',dirname(dirname(str_replace('\\','/',__FILE__))));
require_once ROOT_PATH.'/include/include.php';
require_once ROOT_PATH.'/configs/config.php';
require_once JIEQI_PATH.'/global.php';
include_once JIEQI_PATH.'/modules/article/include/repack.php';
include_once JIEQI_PATH.'/lib/text/textfunction.php';
include_once JIEQI_PATH.'/lib/text/texttypeset.php';
include_once JIEQI_PATH.'/modules/article/class/package.php';


$_Pageurl = explode("index.php", 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]);
define('HTTPURL',$_Pageurl[0]);

$C = array(
    'URL_MODE'=>URL_MODE,
    'DEFAULT'=>'Index',
    'DEFAULT_ACTION'=>'index'
);
?>