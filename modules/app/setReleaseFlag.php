<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/2/8
 * Time: 上午10:17
 *
 * 设置开关接口，只针对ios设备
 */

include_once './common/function.php';

$flag = 1;//0：只有苹果支付，1：包含微信支付，支付宝支付和苹果支付

echo json_encode_ex(array('status' => 1, 'result' => $flag));

return;