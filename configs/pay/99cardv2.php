<?php
//��Ǯ99bill֧����ز���

$jieqiPayset['99cardv2']['payid']='123456';  //�̻����

$jieqiPayset['99cardv2']['paykey']='******';  //��Կֵ

$jieqiPayset['99cardv2']['payurl']='https://www.99bill.com/szxgateway/recvMerchantInfoAction.htm';  //�ύ���Է�����ַ

$jieqiPayset['99cardv2']['payreturn']='http://www.domain.com/modules/pay/99cardv2return.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['99cardv2']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['99cardv2']['inputCharset'] = '2'; //�ַ���,��Ϊ�ա�1����UTF-8; 2����GBK; 3����gb2312 Ĭ��ֵΪ1

$jieqiPayset['99cardv2']['version']='v2.0';  //������汾�Ź̶�Ϊv2.0

$jieqiPayset['99cardv2']['language']='1';  //1�������ģ�2����Ӣ�� Ĭ��ֵΪ1

$jieqiPayset['99cardv2']['signType']='1'; //1����MD5ǩ�� ��ǰ�汾�̶�Ϊ1

$jieqiPayset['99cardv2']['payType']='00';  //ֻ��ѡ��00 //00������֧�������п��Ϳ�Ǯ�ʻ�֧��

$jieqiPayset['99cardv2']['fullAmountFlag']='0';  //0�������С�ڶ������ʱ����֧�����Ϊʧ�ܣ�1�������С�ڶ�������Ƿ���֧�����Ϊ�ɹ���ͬʱ��������ʵ��֧����Ϊ�����п������.����̻����������п���ֱ��ʱ���������̶�ֵΪ1

$jieqiPayset['99cardv2']['ext1']='';  //��չ�ֶ�1

$jieqiPayset['99cardv2']['ext2']='';  //��չ�ֶ�2

$jieqiPayset['99cardv2']['addvars']=array();  //���Ӳ���
?>