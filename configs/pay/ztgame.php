<?php
//ztgame֧����ز���

$jieqiPayset['ztgame']['payid']='123456';  //�̻����

$jieqiPayset['ztgame']['paykey']='******';  //��Կֵ

$jieqiPayset['ztgame']['payurl']='http://pay.15173.com/Pay_gate.aspx';  //�ύ���Է�����ַ

$jieqiPayset['ztgame']['payreturn']='http://www6.2100book.com/modules/pay/15173return.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['ztgame']['paynotify']='http://www6.2100book.com/modules/pay/15173notify.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['ztgame']['paylimit']=array('280'=>'5', '680'=>'10', '2150'=>'30','4400'=>'60', '1400'=>'20', '3600'=>'50', '7300'=>'100', '22100'=>'300');
//֧�����ӻ���
$jieqiPayset['ztgame']['payscore']=array('280'=>'50', '680'=>'100', '2150'=>'300','4400'=>'600', '1400'=>'200', '3600'=>'500', '7300'=>'1000', '22100'=>'3000');

$jieqiPayset['ztgame']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['ztgame']['paytype']='d';  //a �����п�֧�� b ����һ��֧ͨ�� c ʢ��֧�� d ��;��Ϸ��֧�� i ��Ѷ�绰֧�� n �Ѻ�һ��֧ͨ�� o 5173��ֵ��֧�� q ����һ��֧ͨ�� r ��ѶQ�ҿ�֧�� f ���п�����֧�� g �Ƹ�ͨ�ʻ�֧��

$jieqiPayset['ztgame']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['ztgame']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['ztgame']['pemail']='';  //������email

$jieqiPayset['ztgame']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['ztgame']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['ztgame']['pid_ztgameaccount']='';  //����/��������̻����

$jieqiPayset['ztgame']['addvars']=array();  //���Ӳ���
?>