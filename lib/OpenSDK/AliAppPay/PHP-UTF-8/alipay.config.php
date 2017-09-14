<?php
/* *
 * 配置文件
 * 版本：1.0
 * 日期：2016-06-06
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
*/
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://openhome.alipay.com/platform/keyManage.htm?keyType=partner
$alipay_config['partner']		= '2088521406910985';

//商户的私钥,此处填写原始私钥去头去尾，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1
$alipay_config['private_key']	= 'MIICWwIBAAKBgQDGyE1ZMJxkxkzYcti7MlPv0//ZqIWlE9r1hFfkkZjal/hA7LHuDrY3k7UkysHbvUScucmPtxSt2WY1F1Q3KOElpsu6CUgdnPdGaz+S7sM1K9v/aMd6ihWbMGBRb0GS0E7/6zy2bqVzytE2hLJD4oy7jXnEwTrLvKENcYisGUktGQIDAQABAoGANT8kUPbPfcMMhJJG8eXqS/y6tQAKRIzMAyYfMQ+7JRq+Gg4NH1p7fumnBSL2yLirL1wo3MFK3cK1ORV1rozZufYkGp8iQWrWQ233Sx3/WMurTaAq05O8uJAgPrOnVj5naxLe/R3nzGrJSxuzVHOLIfvdGPUDFgOF7s0LjZXADa0CQQDvFf2/oRgw+hrtvP9g/8bZCxTK2DSwA50x1U/iUx+NcHoX6soRsbzg3Jz7l2/XW5Lqektbu6DXjWgSsaoRIDmLAkEA1NhjNn4UUvR9QJocmR3Y0i4neno4jwmpOiGAoEDFdAwSgD3BayCu11Ksrst3gOU3/g0nyjRbk+U5caV9h1dgawJAEe4xSJTZTpsDN/8rm+eyzwZAufG7CdRLjrgztIKNZDsiPPbzzp3oz2hcMZYq4hjRDNq9GhUZO/Ez8+r1GTG0fwJAR+AGqNksndLIFS+1ppMoq9lAJaDuRoc5qVK07+jPhN+qw7mW/kkcIcReYex9n35ISTdCD4tcvXWzz0fWOwTrnwJASJ9T5zzABSMMc851wMUjdRf1XJloGmRecPLr4jQwduoBOBVyfWUxDA+znjbVvyjvfT62zkPNLL7jWEH2og1PBQ==';

//支付宝的公钥，查看地址：https://openhome.alipay.com/platform/keyManage.htm?keyType=partner
$alipay_config['alipay_public_key']= 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB';

//异步通知接口
$alipay_config['service']= 'mobile.securitypay.pay';
//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('RSA');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
//$alipay_config['cacert']    = getcwd().'/cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';
?>