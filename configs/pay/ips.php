<?php
//ips֧����ز���

$jieqiPayset['ips']['payid']='123456';  //�̻����

$jieqiPayset['ips']['paykey']='******';  //��Կֵ

$jieqiPayset['ips']['foreignpayid']='12345678';  //�⿨�̻����

$jieqiPayset['ips']['foreignpaykey']='xxxxxxxx';  //�⿨��Կ

$jieqiPayset['ips']['payurl']='https://www.ips.com.cn/ipay/ipayment.asp';  //�ύ���Է�����ַ

$jieqiPayset['ips']['payreturn']='http://www.domain.com/modules/pay/ipsreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['ips']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['ips']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['ips']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['ips']['Lang']='1';  //1 ���� 2 Ӣ��

$jieqiPayset['ips']['RetEncodeType']='2';  //������֤��ʽ 0-�Ͻӿ� 1-MD5WithRSA 2-MD5

$jieqiPayset['ips']['OrderEncodeType']='2';  //�ύ��֤��ʽ 0-�޼��� 1-MD5 2-MD5_all

$jieqiPayset['ips']['Rettype']='0';  //���ط�ʽ 0����ѡ 1��server to server

$jieqiPayset['ips']['addvars']=array();  //���Ӳ���
?>