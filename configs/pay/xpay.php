<?php
//xpay֧����ز���

$jieqiPayset['xpay']['payid']='12345678';  //�̻����

$jieqiPayset['xpay']['paykey']='xxxxxxxx';  //��Կֵ

$jieqiPayset['xpay']['payurl']='http://pay.xpay.cn/pay.aspx';  //�ύ���Է�����ַ

$jieqiPayset['xpay']['payreturn']='http://www.domain.com/modules/pay/xpayreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['xpay']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['xpay']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['xpay']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['xpay']['pdt']='egold';  //��Ʒ����

$jieqiPayset['xpay']['scard']='bank,unicom,xpay,ebilling,ibank';  //��ͨ��֧����ʽ������ѡ��һ�ֻ����

$jieqiPayset['xpay']['actioncode']='sell';  //������,���ڱ�ʶ����,Ŀǰ֧��sell

$jieqiPayset['xpay']['ver']='2.0';  //�汾��,��ǰϵͳ��ʹ��2.0

$jieqiPayset['xpay']['type']='';  //��Ʒ���ͣ�����Ϊ��

$jieqiPayset['xpay']['lang']='gb2312';  //���ԣ�Ŀǰֻ֧��gb2312

$jieqiPayset['xpay']['remark1']='';  //��ע��Ϣ

$jieqiPayset['xpay']['sitename']='';  //��վ����

$jieqiPayset['xpay']['siteurl']='';  //��վ����

$jieqiPayset['xpay']['addvars']=array();  //���Ӳ���
?>