<?php
//֧����alipay֧����ز���

$jieqiPayset['alipay']['payid']='2088521406910985';  //�������ID

$jieqiPayset['alipay']['paykey']='j9hiyr44493gu2wf3gfrn5asnjeifh3h';  //��Կֵ

$jieqiPayset['alipay']['payurl']='https://www.alipay.com/cooperate/gateway.do';  //�ύ���Է�����ַ  

$jieqiPayset['alipay']['payreturn']='http://www.mianfeidushu.com/modules/pay/alipayreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['alipay']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500');

$jieqiPayset['alipay']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['alipay']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['alipay']['service']='create_direct_pay_by_user';  //��������
$jieqiPayset['alipay']['agent']='';  //������id
$jieqiPayset['alipay']['_input_charset']='GBK';  //�ַ���
$jieqiPayset['alipay']['body']='�������';  //��Ʒ����
$jieqiPayset['alipay']['payment_type']='1';  // ��Ʒ֧������ 1 ����Ʒ���� 2�������� 3���������� 4������ 5���ʷѲ��� 6������
$jieqiPayset['alipay']['show_url']='http://www.mianfeidushu.com';  //��Ʒ�����վ��˾
$jieqiPayset['alipay']['seller_email']='2308810010@qq.com';  //�������䣬����
$jieqiPayset['alipay']['sign_type']='MD5';  //ǩ����ʽ

$jieqiPayset['alipay']['notify_url']='http://www.mianfeidushu.com/modules/pay/alipayreturn.php'; //�첽������Ϣ
$jieqiPayset['alipay']['notifycheck']='http://notify.alipay.com/trade/notify_query.do';  //֪ͨ��֤��ַ

$jieqiPayset['alipay']['addvars']=array();  //���Ӳ���
?>
