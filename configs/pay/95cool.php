<?php
//���95cool֧����ز���

$jieqiPayset['95cool']['payid']='123456';  //�̻����

$jieqiPayset['95cool']['paykey']='******';  //��Կֵ

$jieqiPayset['95cool']['payurl']='http://pay.95cool.com/coolbi/ordergate_zy.jsp';  //�ύ���Է�����ַ

$jieqiPayset['95cool']['payreturn']='http://www.domain.com/modules/pay/95coolreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['95cool']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['95cool']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['95cool']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['95cool']['addvars']=array();  //���Ӳ���
?>