<?php
//��Ǯ99bill֧����ز���

$jieqiPayset['99card']['payid']='123456';  //�̻����

$jieqiPayset['99card']['paykey']='******';  //��Կֵ

$jieqiPayset['99card']['payurl']='https://www.99bill.com/webapp/receiveMerchantInfoAction.do';  //�ύ���Է�����ַ

$jieqiPayset['99card']['payreturn']='http://www.domain.com/modules/pay/99cardreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['99card']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['99card']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['99card']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['99card']['currency']='3';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['99card']['pemail']='';  //������email

$jieqiPayset['99card']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['99card']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['99card']['pid_99billaccount']='';  //����/��������̻����

$jieqiPayset['99card']['addvars']=array();  //���Ӳ���
?>