<?php
//nps֧����ز���

$jieqiPayset['nps']['payid']='123456';  //�̻����

$jieqiPayset['nps']['paykey']='******';  //��Կֵ

$jieqiPayset['nps']['payurl']='https://payment.nps.cn/PHPReceiveMerchantAction.do';  //�ύ���Է�����ַ

$jieqiPayset['nps']['payreturn']='http://www.domain.com/modules/pay/npsreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['nps']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['nps']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['nps']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['nps']['MOCurrency']='1';  //1 �����

$jieqiPayset['nps']['M_Language']='1';  //1 ����

$jieqiPayset['nps']['S_Name']='';  //Ĭ������������

$jieqiPayset['nps']['S_Address']='';  //Ĭ��������סַ

$jieqiPayset['nps']['_PostCode']='';  //�ʱ�

$jieqiPayset['nps']['S_Telephone']='';  //�绰

$jieqiPayset['nps']['S_Email']='';  //Email

$jieqiPayset['nps']['R_Name']='';  //�ջ�������

$jieqiPayset['nps']['R_Address']='';  //�ջ���ַ

$jieqiPayset['nps']['R_PostCode']='';  //�ջ��ʱ�

$jieqiPayset['nps']['R_Telephone']='';  //�ջ��绰

$jieqiPayset['nps']['R_Email']='';  //�ջ�Email

$jieqiPayset['nps']['MOComment']='';  //��ע

$jieqiPayset['nps']['State']='0';  //֧��״̬

$jieqiPayset['nps']['addvars']=array();  //���Ӳ���
?>