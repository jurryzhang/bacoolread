<?php
//��Ǯ99bill֧����ز���

$jieqiPayset['qq']['payid']='123456';  //�̻����

$jieqiPayset['qq']['paykey']='******';  //��Կֵ

$jieqiPayset['qq']['payurl']='http://cp.tenpay.com/cgi-bin/cp_pull';  //�ύ���Է�����ַ

$jieqiPayset['qq']['payreturn']='http://www.domain.com/modules/pay/qqreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['qq']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['qq']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['qq']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['qq']['service_id']='YW50CUIW301';  //ҵ�����

$jieqiPayset['qq']['user_id']='';  //ҵ����غ��루��ѡ������

$jieqiPayset['qq']['user_type']='1';  //ҵ����غ�������ͣ�1��qq����2���Ƹ�ͨ�ʺ�100��cp�Լ��ĺ���

$jieqiPayset['qq']['pay_type']='1';  //֧���������ͣ��û���CP����վ��ѡ��1��q��֧��2���Ƹ�֧ͨ��

$jieqiPayset['qq']['source']='1';  //������Դ1��cp��վ2���Ƹ��ռ�portal

$jieqiPayset['qq']['from']='';  //�ⲿ������Դ������ͳ���ƹ���վ�ԲƸ��ռ���ƹ����ã�

$jieqiPayset['qq']['cmd_line']=$GLOBALS['jieqiModules']['pay']['path'].'/qqrsa/phprsa';  //������֤�����·��

$jieqiPayset['qq']['addvars']=array();  //���Ӳ���
?>