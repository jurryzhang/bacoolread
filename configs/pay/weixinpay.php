<?php
/**
 * ΢��֧���������ļ�
 * Created by PhpStorm.
 * User: burn
 * Date: 2016/12/21
 * Time: ����10:45
 */

$jieqiPayset['weixinpay']['appid']       = 'wxb36c0f7d7456392f'; //�����˺�
  
$jieqiPayset['weixinpay']['mch_id']      = '1422332502'; //΢��֧��������̻���

$jieqiPayset['weixinpay']['paykey']      = 'xindong13503715559mianfeidushu99';

$jieqiPayset['weixinpay']['device_info'] = 'WEB'; //�豸��

$jieqiPayset['weixinpay']['sign_type']   = 'MD5';

$jieqiPayset['weixinpay']['body']        = '��Ѷ�������ֵ����-��ֵ'; //��Ʒ����

$jieqiPayset['weixinpay']['notify_url']  = 'http://www.mianfeidushu.com/modules/pay/weixinpayreturn.php'; //֪ͨ��ַ

$jieqiPayset['weixinpay']['ip']  = '120.55.171.228';//������ip

$jieqiPayset['weixinpay']['trade_type']  = 'NATIVE';//��������

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['weixinpay']['paylimit']    = array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500');

$jieqiPayset['weixinpay']['moneytype']   = '0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['weixinpay']['paysilver']   ='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['weixinpay']['payment_type']   = '1';  // ��Ʒ֧������ 1 ����Ʒ���� 2�������� 3���������� 4������ 5���ʷѲ��� 6������

$jieqiPayset['weixinpay']['api_url']        = 'https://api.mch.weixin.qq.com/pay/unifiedorder';//΢��֧����ͳһ�µ�API

$jieqiPayset['weixinpay']['orderquery_url'] = 'https://api.mch.weixin.qq.com/pay/orderquery';//΢��֧���Ĳ�ѯ������API

?>
