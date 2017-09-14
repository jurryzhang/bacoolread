<?php
$siteurl = 'http://www.jieqi.com'; //请设置跳转到的网站
//$siteurl = ''; //请设置跳转到的网站
if (isset($_SERVER['HTTP_X_REWRITE_URL']))
{
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
}
elseif (isset($_SERVER['HTTP_REQUEST_URI']))
{
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_REQUEST_URI'];
}

if(isset($_SERVER['REQUEST_URI']))
{
	$pageurl = $_SERVER['REQUEST_URI'];
}
else
{
	$pageurl = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];

	if(isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
	{
		$pageurl .= '?'.$_SERVER['QUERY_STRING'];
	}
	elseif(isset($_SERVER['argv'][0]) && strlen($_SERVER['argv'][0]) > 0)
	{
		$pageurl .= '?'.$_SERVER['argv'][0];
	}
}

header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$siteurl.$pageurl);
exit;
?>