<?php
//sms֧����ز���

$jieqiPayset['ivansms']['payid']='000000';  //�̻����

$jieqiPayset['ivansms']['paykey']='xxxxxxxx';  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

$jieqiPayset['ivansms']['payurl']='';  //�ύ���Է�����ַ

$jieqiPayset['ivansms']['payreturn']='http://www.domain.com/modules/pay/ivansmsreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
//�����������
//$jieqiPayset['ivansms']['paylimit']=array('100'=>'1');  

$jieqiPayset['ivansms']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['ivansms']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����


//��ͬ���Ŵ������������ͬ
//spnumber   - �û��ֻ����͵�ָ��
//egold       - ��ֵ�������
//emoney      - ʵ�ʿ۵Ľ��(��λ����)
//message     - ��վ�����ֻ�����ʾ��Ϣ(<{$serialno}> ������ţ�<{$randpass}> ��ֵ���� <{$egold}> �����)

$jieqiPayset['ivansms']['paytype'][]=array('spnumber'=>'', 'egold'=>'200', 'emoney'=>'200', 'message'=>'��ţ�<{$serialno}>�����룺<{$randpass}>������2Ԫ��');

//֧�����ӻ��֣���������Ҷ�Ӧ���ٻ��֣�
//$jieqiPayset['ivansms']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');


//��������
$jieqiPayset['ivansms']['passlen']='8';  //������볤��

$jieqiPayset['ivansms']['passtype']='3';  //����������� 1-���֣�2-Сд��ĸ, 3-���ֺ�Сд��ĸ

$jieqiPayset['ivansms']['addvars']=array();  //���Ӳ���

//�ֻ�����֧����Ҫ���ε��ֻ��ţ�������һ��php����
//�� $jieqiPayset['ivansms']['denyphone']=array('13600000000', '13700000000', '13800000000');
$jieqiPayset['ivansms']['denyphone']=array();
?>