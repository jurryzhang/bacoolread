<?php
//��Ǯ99bill֧����ز���

$jieqiPayset['99bill']['payid']='123456';  //�̻����

$jieqiPayset['99bill']['paykey']='******';  //��Կֵ

$jieqiPayset['99bill']['payurl']='https://www.99bill.com/webapp/receiveMerchantInfoAction.do';  //�ύ���Է�����ַ

$jieqiPayset['99bill']['payreturn']='http://www.domain.com/modules/pay/99billreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['99bill']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');
//֧�����ӻ���
//$jieqiPayset['99bill']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['99bill']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['99bill']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['99bill']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['99bill']['pemail']='';  //������email

$jieqiPayset['99bill']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['99bill']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['99bill']['pid_99billaccount']='';  //����/��������̻����

$jieqiPayset['99bill']['addvars']=array();  //���Ӳ���
?>