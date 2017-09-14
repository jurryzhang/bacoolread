<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午7:08
 *
 * 微信支付的配置文件
 *
 */

$weixinPay['appid']            = 'wxc0bd6366dd8f455e'; //公众账号

$weixinPay['mch_id']           = '1432093202'; //微信支付分配的商户号

$weixinPay['paykey']           = 'xindong13503715559mianfeidushu99';

$weixinPay['device_info']      = 'WEB';//设备号

$weixinPay['sign_type']        = 'MD5';

$weixinPay['body']             = '免费读书网充值中心-充值'; //商品描述

$weixinPay['notify_url']       = 'http://www.mianfeidushu.com/modules/app/weixinPayReturn.php'; //通知地址

$weixinPay['ip']               = '120.55.171.228';//服务器ip

$weixinPay['trade_type']       = 'APP';//交易类型

//这个参数不设置的话，用户可以购买任意值的虚拟货币，按照一元钱100币折算。如果设置了这个参数，则购买金额只能按照里面的设置，对应的也金钱按对应关系折算，如 '1000'=>'10' 是指 1000虚拟币需要10元
$weixinPay['paylimit']         = array('500'=>'500', '1000'=>'1000', '3000'=>'3000', '5000'=>'5000', '10000'=>'10000', '20000'=>'20000', '50000'=>'500');

$weixinPay['moneytype']        = '0';  //0 人民币 1表示美元

$weixinPay['paysilver']        = '0';   //0 表示冲值成金币 1表示银币

$weixinPay['payment_type']     = '1';  // 商品支付类型 1 ＝商品购买 2＝服务购买 3＝网络拍卖 4＝捐赠 5＝邮费补偿 6＝奖金

$weixinPay['unifiedorder_url'] = 'https://api.mch.weixin.qq.com/pay/unifiedorder';//微信支付的统一下单API

$weixinPay['orderquery_url']   = 'https://api.mch.weixin.qq.com/pay/orderquery';//微信支付的查询订单单API

$weixinPay['package']          = 'Sign=WXPay';



?>
