<?php
//15173֧����ز���

$jieqiPayset['15173']['payid']='123456';  //�̻����

$jieqiPayset['15173']['paykey']='******';  //��Կֵ

$jieqiPayset['15173']['payurl']='http://pay.15173.com/Pay_gate.aspx';  //�ύ���Է�����ַ

$jieqiPayset['15173']['payreturn']='http://localhost/jieqi150/modules/pay/15173return.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['15173']['paynotify']='http://localhost/jieqi150/modules/pay/15173notify.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['15173']['paylimit']=array('100'=>'1', '1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');
//֧�����ӻ���
//$jieqiPayset['15173']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['15173']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['15173']['paytype']='d';  //a �����п�֧�� b ����һ��֧ͨ�� c ʢ��֧�� d ��;��Ϸ��֧�� i ��Ѷ�绰֧�� n �Ѻ�һ��֧ͨ�� o 5173��ֵ��֧�� q ����һ��֧ͨ�� r ��ѶQ�ҿ�֧�� f ���п�����֧�� g �Ƹ�ͨ�ʻ�֧��

$jieqiPayset['15173']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['15173']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['15173']['pemail']='';  //������email

$jieqiPayset['15173']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['15173']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['15173']['pid_15173account']='';  //����/��������̻����

$jieqiPayset['15173']['addvars']=array();  //���Ӳ���
?>