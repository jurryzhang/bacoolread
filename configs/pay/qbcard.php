<?php
//qbcard֧����ز���

$jieqiPayset['qbcard']['payid']='123456';  //�̻����

$jieqiPayset['qbcard']['paykey']='******';  //��Կֵ

$jieqiPayset['qbcard']['payurl']='http://pay.15173.com/Pay_gate.aspx';  //�ύ���Է�����ַ

$jieqiPayset['qbcard']['payreturn']='http://www6.2100book.com/modules/pay/15173return.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['qbcard']['paynotify']='http://www6.2100book.com/modules/pay/15173notify.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['qbcard']['paylimit']=array('600'=>'10', '930'=>'15', '1900'=>'30', '3850'=>'60');
//֧�����ӻ���
$jieqiPayset['qbcard']['payscore']=array('600'=>'100', '930'=>'150', '1900'=>'300', '3850'=>'600');

$jieqiPayset['qbcard']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['qbcard']['paytype']='r';  //a �����п�֧�� b ����һ��֧ͨ�� c ʢ��֧�� d ��;��Ϸ��֧�� i ��Ѷ�绰֧�� n �Ѻ�һ��֧ͨ�� o 5173��ֵ��֧�� q ����һ��֧ͨ�� r ��ѶQ�ҿ�֧�� f ���п�����֧�� g �Ƹ�ͨ�ʻ�֧��

$jieqiPayset['qbcard']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['qbcard']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['qbcard']['pemail']='';  //������email

$jieqiPayset['qbcard']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['qbcard']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['qbcard']['pid_qbcardaccount']='';  //����/��������̻����

$jieqiPayset['qbcard']['addvars']=array();  //���Ӳ���
?>