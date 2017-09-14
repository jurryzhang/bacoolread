<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/21
 * Time: 下午12:33
 */

require_once './common/function.php';

define('APP_DIR','E:\\\\files\\\\article\\\\app\\\\mianfeidushu.apk');

define('APP_FILE_NAME','免费读书.apk');

define('APP_FILE_PATH','E:\\\\files\\\\article\\\\app\\\\');

header("Content-type:text/html;charset=utf-8");

//用以解决中文不能显示出来的问题
$file_path = APP_DIR;
$fp        = fopen($file_path,"r");
$file_size = filesize($file_path);

//下载文件需要用到的头
Header("Content-type: application/octet-stream");//通过这句代码客户端浏览器就能知道服务端返回的文件形式

Header("Accept-Ranges: bytes");//返回的文件大小是按照字节进行计算的

Header("Content-Length:" . $file_size);//返回的文件大小

Header("Content-Disposition: attachment; filename= " . APP_FILE_NAME);//告诉浏览器返回的文件的名称

$buffer     = 1024;
$file_count = 0;

//向浏览器返回数据
while(!feof($fp) && $file_count < $file_size)
{
	$file_con    = fread($fp,$buffer);
	$file_count += $buffer;
	
	echo $file_con;
}

fclose($fp);

?>