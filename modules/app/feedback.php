<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 上午11:18
 *
 * 小说用户反馈接口
 *
 * 请求字段：user_name  ： 用户名
 *         content    ： 内容
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

if(isset($_REQUEST['user_name']) && $_REQUEST['user_name'])
{
	$userName = trim($_REQUEST['user_name']);
}
else
{
	$userName = '匿名';
}

$userName = iconv('UTF-8','GBK//IGNORE',$userName);

if(isset($_REQUEST['content']))
{
	$content = trim($_REQUEST['content']);
	
	$content = iconv('UTF-8','GBK//IGNORE',$content);
}
else
{
	$errorMessage = '内容不能为空！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}

jieqi_includedb();

$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$errorMessage   = '';

$successMessage = '';

$reList = array();

$time   = time();

//先插入jieqi_article_reviews
$sql = 'INSERT INTO `' . jieqi_dbprefix('app_feedback'). "` (`username`,`content`,`time`) VALUES ('" . $userName . "', '" . $content . "', '" . $time . "')";

$result  = $query->execute($sql);

if($result)
{
	echo json_encode_ex(array('status' => 1,'message' => '提交成功！'));
	
	return;
}
else
{
	$errorMessage = '提交反馈失败，请重试！';
	
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));
	
	return;
}