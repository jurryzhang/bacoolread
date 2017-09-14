<?php
/**
 * Created by PhpStorm.
 * User: burn
 * Date: 2017/1/8
 * Time: 下午7:04
 *
 * 阿里支付配置
 *
 */

//$aliPay['service']           = 'mobile.securitypay.pay';//接口名称

$aliPay['service']           = 'alipay.trade.app.pay';//接口名称

$aliPay['partner']           = '2088521406910985';//合作者身份ID

$aliPay['payment_type']      = '0';//支付类型,默认值为：1（商品购买）

$aliPay['seller_id']        = '2308810010@qq.com';//卖家支付宝账号

$aliPay['appid']           = '2017011004971362';

$aliPay['payprivatekey']   = 'MIICXAIBAAKBgQDomgpxNEEiKpOWAWaUJBux4XpOPgBozMnj3V7QVQb6PM2LsW/EEQjhj8Fftwe3kZcY3ehLEudYQY3rEgR5xq2xUCyDtVkzUBqXAO38qEQkgFmbBJNSrBDGfntWrXt8dMjSEdmVcdvIjmYWlBpIMEDNNsYgEnDfim/t6My/Jl0E4QIDAQABAoGAJNN+o72qMkabZzyBiSLOX7NbMdgPKIiDzlfWExXjLOtDf8Jv95La3RttekH4LtAWJBG+HWS4y/hVB8qqer1B8muABNNcW6zLzbsSNojx1sUxBDcguAA1YBForR7jiGwc1D7TlIbjshwpkhL+TQM6lVvu3GsJT5WtMh7jz4QZECECQQD3rgbrX+HojZ/dYC86gk5tw7zl4/5mv5REPio7aL6JgFTrh23mmvvVj4PRmupbGyJSOk45KCr/MdXB9NVHtSA/AkEA8GpYyF2cLrfue2OGGOAKy+3dISEKbaWq2xWJa/A3tdyDkq+hEXcN3EaHypSu6t5mPdrDMikPXPAigxH7cE6S3wJBANkkwLpBEL0i1UJvnlhsf7gqAIWIcrTAR4vg+IOnXE0OruTjkg24WQutzALLD6YaTufKaGQh/DhKB78JGKfKe18CQFfW81NZ6HulVmwcw90I1skFwpqdINtJAXEEoG4gmapHxIbuxpHEBvtpham9w18rHP4SlOkZ2XQihOmQw2aYPs8CQA9YpyD4IumrtLHAsUt5egv7VjaZoTTvvhdrQB9XS8dA1FJ51LvqchU0LywodTqm17eo9vH1gv2oCaI6lMTjXM4=';
	
	//$aliPay['payprivatekey']   = 'MIICXAIBAAKBgQCwWMbK6UXmNEs6pkrZD0NnpiBWSGzoPeU0FlJXg7szXzmRBbDeVgDSF1a/RgW5Aqr9BOr7J6CQ/czuCFtTIKcMprjqFFXxKqDe3Npaa4rV3xs089UgnGLytfvqgybUtd73cXEp6XyniXAKMv2nJ3KEb8we265gCe2Z8cWcRz/zfwIDAQABAoGAGRFFkOqACS091GR3F0vYJQ+0YQ+Ci7Dgt/rEUbRkE/VhVYAdmD1ZeIPgzOfDQH1kmPrt/C2x4WpyixOdB8AIfsNCELmZUPUweGE5XJFv8dAw4C8kkAlBLW79AhYodsoM5AHKQkzyKX2uIHTjTkPjoL7TdyKJ13/AnuAp5zQ8TmECQQDnu5Lxp31MxyCWcjUkJlu68oyx0c9Up1gpIAu2u4t897+3qk/6zYBypwnkkZ2yPEQyclEuUwCAxc8TV2Mz2f4rAkEAwtBiWzu8yJjZKJIx89ckgtWolkzD/C9+aBQ6mnIvUoXiIq/EFJfkl7rfd8IENDK3UuOWVUkSHADPIla3wMDJ/QJBANo3Bk7NW+667PL/JQ+fl23aDac9XbHny9seNCmlPds2KbE4jgwtDDHrHiPBA/DdU5L1l4C55JVesHsUJXSkaPUCQAtE4Jukbfwwk0c8hbU0OcFzuIfRMvkQikBdAzLR7hjY88bL4gzK6Ic6YRjdWT7nvCEIVzbhvjFufoze9UwqGsUCQB4SS9Sz0aNysr3xFb7A5MgiHJvd4q6ztonfxQvlzGbKfN6r0UUAWtJtQKK7SUwVCV5O+bqmaaH83zIgHVTpb2E=';
	
	//$aliPay['payprivatekey']   = 'MIICXAIBAAKBgQDVYKZNcrYiFpQGfbmikPhxJ99NP6T14MRixZ0247Fu6F2aA5lP6klMfAbcpUyh8b93nu9O6TzlGfLmZojJI3l5Wez7+w2FK/bj0CDak+bIg3C8KB9dQcyBQP6/SwPu2QtVfWWDQR0+Uw+x4pPTRtVwVptiDB+fSmfcIPgukXvu8QIDAQABAoGALnod3zLET0qBtaQ/AhT3uJYJwqbBRLlPrYADzYftBw5gDQMJqumKS7mcOQVcWs3weZrJ33NYS0LKsLrWwpESjSE93MLGx0jXLmP+ssSisz0APlHjx8tJHhMsmjdpH6G/dl8G7OERtk8Ls2GuHfd+q6pi48I+os0E+8OFz3tzR90CQQD2jcRhSPzkFZV6ZxyYuEmGDQWW/qbk89vx4ROUoW6+4pjS65gqxYhdq88zD8x1nB9n8skYkr3rjpUo6jimOo1bAkEA3Y18RjlZiPz0ifbPTIT0mkxuBhHsRPp6zTGfqTKU2n5ijzriSDR2+wn+0P0Q2Vqv+oCszSE5m/hFJgslHXkqowJAcqf41DkKCdOTwOlkngzNfD5gBBkGaeCRvwkpfuwXwUNFSIjxKarUwKLeZ2OIdIUXAdMg+4F6OqoC6ZUKpRsDkwJBAJweSBUf8nSycwsI7Ripk8dq1hjW5lvQ+VnAfxZ2Oygf6Qmu36cruS+64mGYAhh3bAwkQiAmKnc6oldlgRjcuesCQDRoNvxqYpDO0422LyiHEGS+SAxFdINbMZHVtmKOuCoh7C10pIkvCHPAuRFJhHut/VBz+USYL8Gdy6X19HjRUsE=';//请填写开发者私钥去头去尾去回车，一行字符串

$aliPay['paypublickey']   = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDI6d306Q8fIfCOaTXyiUeJHkrIvYISRcc73s3vF1ZT7XN8RNPwJxo8pWaJMmvyTn9N4HQ632qJBVHf8sxHi/fEsraprwCtzvzQETrNRwVxLO5jVmRGi60j8Ue1efIlzPXV9je9mkjzOmdssymZkh2QhUrCmZYI/FCEa3/cNMW0QIDAQAB';  //支付宝公钥

$aliPay['paygatewayurl']  = 'https://openapi.alipay.com/gateway.do';//提交到对方的网址

$aliPay['payreturn']      = 'http://www.mianfeidushu.com/modules/app/aliPayReturn.php';  //接收返回的地址 (www.domain.com 是指你的网址)

//这个参数不设置的话，用户可以购买任意值的虚拟货币，按照一元钱100币折算。如果设置了这个参数，则购买金额只能按照里面的设置，对应的也金钱按对应关系折算，如 '1000'=>'10' 是指 1000虚拟币需要10元
$aliPay['paylimit']       = array('500'=>'5', '1000'=>'10', '3000'=>'30', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500');

$aliPay['moneytype']      = '0';  //0 人民币 1表示美元

$aliPay['paysilver']      = '0';  //0 表示冲值成金币 1表示银币

//$aliPay['service']        = 'create_direct_pay_by_user';  //交易类型

$aliPay['agent']          = '';  //代理商id

$aliPay['_input_charset'] = 'utf-8';  //字符集

$aliPay['body']           = '虚拟货币充值';  //商品描述

//$aliPay['body']           = 'xunihuobi';  //商品描述

$aliPay['subject']        = '小说币';  //商品描述

$aliPay['payment_type']   = '1';  // 商品支付类型 1 ＝商品购买 2＝服务购买 3＝网络拍卖 4＝捐赠 5＝邮费补偿 6＝奖金

$aliPay['show_url']       = 'http://www.mianfeidushu.com';  //商品相关网站公司

$aliPay['seller_email']   = '2308810010@qq.com';  //卖家邮箱，必填

$aliPay['sign_type']      = 'RSA';  //签名方式

$aliPay['notify_url']     = 'http://www.mianfeidushu.com/modules/app/aliPayReturn.php'; //异步返回信息

$aliPay['notifycheck']    = 'http://notify.alipay.com/trade/notify_query.do';  //通知验证地址

$aliPay['method']         = 'alipay.trade.app.pay';  //通知验证地址

$aliPay['addvars'] = array();  //附加参数
?>