<?php
//��Ǯ19pay֧����ز���

$jieqiPayset['19pay']['payid']='123456';  //�̻����

$jieqiPayset['19pay']['paykey']='******';  //��Կֵ

$jieqiPayset['19pay']['payurl']='http://gs.19pay.com/ordergate/order.do';  //�ύ���Է�����ַ

$jieqiPayset['19pay']['payreturn']='http://www.domain.com/modules/pay/19payreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['19pay']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['19pay']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['19pay']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����


$jieqiPayset['19pay']['currency']='RMB';  //�������� RMBΪ�����

$jieqiPayset['19pay']['version_id']='2.00';  //�ӿڰ汾��

$jieqiPayset['19pay']['addvars']=array();  //���Ӳ���
?>