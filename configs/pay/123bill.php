<?php
//123bill֧����ز���

$jieqiPayset['123bill']['payid']='123456';  //�̻����

$jieqiPayset['123bill']['paykey']='******';   //��Կֵ


$jieqiPayset['123bill']['payurl']='http://test.118pay.cn/PhonePay.aspx';//�ύ���Է�����ַ

$jieqiPayset['123bill']['payreturn']='http://localhost/jie/jieqicms/modules/pay/123billreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)


//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['123bill']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');
//֧�����ӻ���
//$jieqiPayset['123bill']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['123bill']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['123bill']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['123bill']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�


$jieqiPayset['123bill']['op'] = '1';  //�������ͣ�1-֧����

$jieqiPayset['123bill']['objid'] = '88888';  //������Ʒ����



$jieqiPayset['123bill']['prikeyfile'] = '123bill_prikey.xml';  //˽����Կ�ļ��������������վ�� /configs/pay/ Ŀ¼��

$jieqiPayset['123bill']['pubkeyfile'] = '123bill_pubkey.xml';  //��������Կ�ļ��������������վ�� /configs/pay/ Ŀ¼��


$jieqiPayset['123bill']['addvars']=array();  //���Ӳ���
?>