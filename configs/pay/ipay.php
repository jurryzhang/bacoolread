<?php
//ipay֧����ز���

$jieqiPayset['ipay']['payid']='12345678';  //�̻����

$jieqiPayset['ipay']['paykey']='xxxxxxxx';  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

$jieqiPayset['ipay']['payurl']='http://www.ipay.cn/4.0/bank.shtml';  //�ύ���Է�����ַ

$jieqiPayset['ipay']['payreturn']='http://www.domain.com/modules/pay/ipayreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['ipay']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['ipay']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['ipay']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['ipay']['v_email']='';  //Email

$jieqiPayset['ipay']['v_mobile']='13888888888';  //�ֻ�����

$jieqiPayset['ipay']['addvars']=array();  //���Ӳ���
?>