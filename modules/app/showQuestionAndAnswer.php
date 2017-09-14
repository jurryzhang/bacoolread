<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 下午2:46
 *
 * 常见问题接口
 *
 */
require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

jieqi_includedb();

$query  = JieqiQueryHandler::getInstance('JieqiQueryHandler');

$sql    = 'SELECT * FROM ' . jieqi_dbprefix('app_questionandanswer') . " ORDER BY `showid` ASC";

$status = $query->execute($sql);

if($status)
{
	while ($row = $query->getRow())
	{
		$tmp                   = jieqi_query_rowvars($row);
		
		$tmpResult['time']     = date('Y-m-d',$tmp['time']);
		
		$tmpResult['question'] = iconv('GBK','UTF-8',$tmp['question']);
		
		$tmpResult['answer']   = iconv('GBK','UTF-8',$tmp['answer']);
		
		$result[]              = $tmpResult;
	}
}
else
{
	$errorMessage = '获取列表失败！';
}

if(!$errorMessage)
{
	echo json_encode_ex(array('status' => 1,'message' => '获取常见问题表成功！','result' => $result));;
	
	return;
}
else
{
	echo json_encode_ex(array('status' => 0,'message' => $errorMessage));;
	
	return;
}