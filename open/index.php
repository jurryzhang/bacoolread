<?php
    header("Content-Type:text/html;charset=utf-8");
	date_default_timezone_set('Asia/Shanghai');
	define('ISEXIST',true);
    error_reporting(E_ALL);
	require "init.php";
	$control = new Controller();
	$control -> Run();
	ob_get_contents();
?>