<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/2
 * Time: 上午10:21
 *
 * 用户退出接口
 *
 */

require_once '../../global.php';
require_once '../../header.php';
require_once './common/function.php';

setcookie("user_id",'',time() - 3600);

setcookie("user_name",'',time() - 3600);

setcookie("user_email",'',time() - 3600);

setcookie("user_email",'',time() - 3600);

//unset($_SESSION);

echo json_encode_ex(array('status' => 1,'message' => '退出成功！'));

return;