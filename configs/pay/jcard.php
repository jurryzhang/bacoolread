<?php
//jcard֧����ز���

$jieqiPayset['jcard']['payid']='123456';  //�̻����

$jieqiPayset['jcard']['paykey']='******';  //��Կֵ

$jieqiPayset['jcard']['payurl']='http://pay.15173.com/Pay_gate.aspx';  //�ύ���Է�����ַ

$jieqiPayset['jcard']['payreturn']='http://www6.2100book.com/modules/pay/15173return.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['jcard']['paynotify']='http://www6.2100book.com/modules/pay/15173notify.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)
/*
5Ԫ     380�����ͱ�
6Ԫ     420�����ͱ�
10Ԫ    790�����ͱ�
15Ԫ    1200�����ͱ�
30Ԫ    2450�����ͱ�
50Ԫ    4100�����ͱ�
100Ԫ   8250�����ͱ�
*/
//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['jcard']['paylimit']=array('380'=>'5', '420'=>'6', '790'=>'10','1200'=>'15', '2450'=>'30', '4100'=>'50', '8250'=>'100');
//֧�����ӻ���
$jieqiPayset['jcard']['payscore']=array('380'=>'50', '420'=>'60', '790'=>'100','1200'=>'150', '2450'=>'300', '4100'=>'500', '8250'=>'1000');

$jieqiPayset['jcard']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['jcard']['paytype']='b';  //a �����п�֧�� b ����һ��֧ͨ�� c ʢ��֧�� d ��;��Ϸ��֧�� i ��Ѷ�绰֧�� n �Ѻ�һ��֧ͨ�� o 5173��ֵ��֧�� q ����һ��֧ͨ�� r ��ѶQ�ҿ�֧�� f ���п�����֧�� g �Ƹ�ͨ�ʻ�֧��

$jieqiPayset['jcard']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['jcard']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['jcard']['pemail']='';  //������email

$jieqiPayset['jcard']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['jcard']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['jcard']['pid_jcardaccount']='';  //����/��������̻����

$jieqiPayset['jcard']['addvars']=array();  //���Ӳ���
?>