<?php
/**
 * 微信支付的配置文件
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/21
 * Time: 上午10:45
 */

$jieqiPayset['weixinpay']['appid']       = 'wxb36c0f7d7456392f'; //公众账号
  
$jieqiPayset['weixinpay']['mch_id']      = '1422332502'; //微信支付分配的商户号

$jieqiPayset['weixinpay']['paykey']      = 'xindong13503715559mianfeidushu99';

$jieqiPayset['weixinpay']['device_info'] = 'WEB'; //设备号

$jieqiPayset['weixinpay']['sign_type']   = 'MD5';

$jieqiPayset['weixinpay']['body']        = '免费读书网充值中心-充值'; //商品描述

$jieqiPayset['weixinpay']['notify_url']  = 'http://www.mianfeidushu.com/modules/pay/weixinpayreturn.php'; //通知地址

$jieqiPayset['weixinpay']['ip']  = '120.55.171.228';//服务器ip

$jieqiPayset['weixinpay']['trade_type']  = 'NATIVE';//交易类型

//这个参数不设置的话，用户可以购买任意值的虚拟货币，按照一元钱100币折算。如果设置了这个参数，则购买金额只能按照里面的设置，对应的也金钱按对应关系折算，如 '1000'=>'10' 是指 1000虚拟币需要10元
$jieqiPayset['weixinpay']['paylimit']    = array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500');

$jieqiPayset['weixinpay']['moneytype']   = '0';  //0 人民币 1表示美元

$jieqiPayset['weixinpay']['paysilver']   ='0';  //0 表示冲值成金币 1表示银币

$jieqiPayset['weixinpay']['payment_type']   = '1';  // 商品支付类型 1 ＝商品购买 2＝服务购买 3＝网络拍卖 4＝捐赠 5＝邮费补偿 6＝奖金

$jieqiPayset['weixinpay']['api_url']        = 'https://api.mch.weixin.qq.com/pay/unifiedorder';//微信支付的统一下单API

$jieqiPayset['weixinpay']['orderquery_url'] = 'https://api.mch.weixin.qq.com/pay/orderquery';//微信支付的查询订单单API

?>
