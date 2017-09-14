<?php

define('JIEQI_MODULE_NAME', 'system');

if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'login'))
{
	define('JIEQI_NEED_SESSION', 1);
}

require_once 'global.php';

if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'login'))
{
	@session_regenerate_id();
}

jieqi_loadlang('users', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');

if (isset($_REQUEST['action']) && ($_REQUEST['action'] == 'login'))
{
	if ((strlen($_REQUEST['username']) == 0) || (strlen($_REQUEST['password']) == 0))
	{
		jieqi_printfail($jieqiLang['system']['need_userpass']);
	}
	else
	{
		jieqi_useraction('login', $_REQUEST);
	}
}
else
{
	include_once JIEQI_ROOT_PATH . '/header.php';
	
	if (!empty($_REQUEST['jumpurl']) && preg_match('/^(\\/\\w+|' . preg_quote(JIEQI_LOCAL_URL, '/') . ')/i', $_REQUEST['jumpurl']))
	{
		$jieqiTpl->assign('url_login', JIEQI_USER_URL . '/login.php?do=submit&jumpurl=' . urlencode($_REQUEST['jumpurl']));
	}
	else
	{
		if (!empty($_REQUEST['forward']) && preg_match('/^(\\/\\w+|' . preg_quote(JIEQI_LOCAL_URL, '/') . ')/i', $_REQUEST['forward']))
		{
			$jieqiTpl->assign('url_login', JIEQI_USER_URL . '/login.php?do=submit&jumpurl=' . urlencode($_REQUEST['forward']));
		}
		else
		{
			if (!empty($_SERVER['HTTP_REFERER']) && preg_match('/^(\\/\\w+|' . preg_quote(JIEQI_LOCAL_URL, '/') . ')/i', $_SERVER['HTTP_REFERER']) && !preg_match('/(login\\.php|register\\.php)/i', $_SERVER['HTTP_REFERER']))
			{
				$jieqiTpl->assign('url_login', JIEQI_USER_URL . '/login.php?do=submit&jumpurl=' . urlencode($_SERVER['HTTP_REFERER']));
			}
			else
			{
				$jieqiTpl->assign('url_login', JIEQI_USER_URL . '/login.php?do=submit');
			}
		}
	}
	
	$jieqiTpl->assign('url_register', JIEQI_USER_URL . '/register.php');
	$jieqiTpl->assign('url_getpass', JIEQI_USER_URL . '/getpass.php');
	
	if (!empty($jieqiConfigs['system']['checkcodelogin']))
	{
		$jieqiTpl->assign('show_checkcode', 1);
	}
	else
	{
		$jieqiTpl->assign('show_checkcode', 0);
	}
	
	$jieqiTpl->assign('url_checkcode', JIEQI_USER_URL . '/checkcode.php');
	$jieqiTpl->setCaching(0);
	
	$jieqiTset['jieqi_contents_template'] = JIEQI_ROOT_PATH . '/templates/login.html';
	
	include_once JIEQI_ROOT_PATH . '/footer.php';
}

?>
