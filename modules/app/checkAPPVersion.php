<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/11
 * Time: 下午3:43
 *
 * 检测app版本接口
 *
 */
require_once './common/function.php';

$version = file_get_contents('admin/appVersion.txt');

$appUrl  = 'http://www.mianfeidushu.com/modules/app/appVersion.php';

$result['version'] = $version;

$result['appUrl']  = $appUrl;

echo json_encode_ex(array('status' => 1,'message' => '获取信息成功','result' => $result));;

return;