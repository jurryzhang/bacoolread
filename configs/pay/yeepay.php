<?php
//�ױ�yeepay֧����ز���

$jieqiPayset['yeepay']['payid']='10012967902';  //�̻����

$jieqiPayset['yeepay']['paykey']='b7S9Lf8a4m25e93k4PT0V00987876Q9b9qx0ht4012f1kS11s95T0X4D9pXL';  //��Կֵ

$jieqiPayset['yeepay']['payurl']='https://www.yeepay.com/app-merchant-proxy/node';  //�ύ���Է�����ַ

$jieqiPayset['yeepay']['payreturn']='http://www.mianfeidushu.com/modules/pay/yeepayreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['yeepay']['paylimit']=array('100'=>'1','1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500');
//֧�����ӻ���
//$jieqiPayset['yeepay']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['yeepay']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['yeepay']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����



$jieqiPayset['yeepay']['addressFlag']='0';  //��Ҫ��д�ͻ���Ϣ 0������Ҫ  1:��Ҫ

$jieqiPayset['yeepay']['messageType']='Buy';  //ҵ������

$jieqiPayset['yeepay']['cur']='CNY';  //���ҵ�λ

$jieqiPayset['yeepay']['productId']='';  //��Ʒ��

$jieqiPayset['yeepay']['productDesc']='';  //��Ʒ����

$jieqiPayset['yeepay']['productCat']='';  //��Ʒ����

$jieqiPayset['yeepay']['sMctProperties']='';  //���Ӳ���

$jieqiPayset['yeepay']['frpId']='';  //���Ӳ���

$jieqiPayset['yeepay']['needResponse']='0';  //�Ƿ���ҪӦ����ƣ�Ĭ�ϻ�"0"Ϊ����Ҫ,"1"Ϊ��Ҫ

$jieqiPayset['yeepay']['payfrom']=array(
'1000000-NET'   => '�ױ���Ա֧��',
'SZX'           => '������֧����',
'ABC-NET'       => '�й�ũҵ����',
'BCCB-NET'      => '��������',
'BOCO-NET'      => '��ͨ����',
'CCB-NET'       => '��������',
'CIB-NET'       => '��ҵ����',
'CMBCHINA-NET'  => '��������',
'CMBCHINA-PHONE'=> '���е绰����',
'CMBC-NET'      => '�й�������������',
'CMBC-PHONE'    => '�����绰����',
'ICBC-NET'      => '�й���������',
'JUNNET-NET'    => '����һ��ͨ(��Ҫ�ر�ͨ�ſ�ʹ��)',
'LIANHUAOKCARD-NET'=>'����OK ��(��Ҫ�ر�ͨ�ſ�ʹ��)',
'POST-NET'      => '�й�����(��Ҫ�ر�ͨ�ſ�ʹ��)',
'SDB-NET'       => '���ڷ�չ����',
'SHTEL-NET'     => '���ž��ſ�(��Ҫ�ر�ͨ�ſ�ʹ��)',
'SPDB-NET'      => '�Ϻ��ֶ���չ����',
'TONGCARD-NET'  => '����֧��(ͨ��)(��Ҫ�ر�ͨ�ſ�ʹ��)'
);

$jieqiPayset['yeepay']['paytype']=array(
'1000000-NET'   => 'yeepay',
'SZX'           => 'yeepay-szx',
'ABC-NET'       => 'yeepay-bank',
'BCCB-NET'      => 'yeepay-bank',
'BOCO-NET'      => 'yeepay-bank',
'CCB-NET'       => 'yeepay-bank',
'CIB-NET'       => 'yeepay-bank',
'CMBCHINA-NET'  => 'yeepay-bank',
'CMBCHINA-PHONE'=> 'yeepay-bank',
'CMBC-NET'      => 'yeepay-bank',
'CMBC-PHONE'    => 'yeepay-bank',
'ICBC-NET'      => 'yeepay-bank',
'JUNNET-NET'    => 'yeepay-other',
'LIANHUAOKCARD-NET'=>'yeepay-other',
'POST-NET'      => 'yeepay-other',
'SDB-NET'       => 'yeepay-bank',
'SHTEL-NET'     => 'yeepay-other',
'SPDB-NET'      => 'yeepay-bank',
'TONGCARD-NET'  => 'yeepay-other'
);

$jieqiPayset['yeepay']['addvars']=array();  //���Ӳ���

/*
�ױ�Ĭ��֧�� /modules/pay/buyegold.php?t=yeepaypay
��Ӧģ�� /modules/pay/templates/yeepaypay.html

�ױ������� /modules/pay/buyegold.php?t=yeeszxpay
��Ӧģ�� /modules/pay/templates/yeeszxpay.html

paytype.php ���ܵ�֧���������ã������ױ�֧���Ļ�����ԭ�����û����ϼ�����������

$jieqiPaytype['yeepay'] = array('name' => '�ױ���Ա֧��', 'shortname' => '�ױ���Ա', 'description'=>'', 'url' => 'http://www.yeepay.com');

$jieqiPaytype['yeepay-szx'] = array('name' => '�ױ������п�֧��', 'shortname' => '�ױ�������', 'description'=>'', 'url' => 'http://www.yeepay.com');

$jieqiPaytype['yeepay-bank'] = array('name' => '�ױ����п�֧��', 'shortname' => '�ױ����п�', 'description'=>'', 'url' => 'http://www.yeepay.com');

$jieqiPaytype['yeepay-other'] = array('name' => '�ױ�����֧��', 'shortname' => '�ױ�����', 'description'=>'', 'url' => 'http://www.yeepay.com');
*/

?>
