<?php
//sms֧����ز���

$jieqiPayset['tomorrow']['payid']='000000';  //�̻����

$jieqiPayset['tomorrow']['paykey']='xxxxxxxx';  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

$jieqiPayset['tomorrow']['payurl']='http://218.206.80.202:8181/web/httpMt';  //�ύ���Է�����ַ
$jieqiPayset['tomorrow']['payurl']='http://220.194.61.249:8181/web/httpMt';  //�ύ���Է�����ַ


$jieqiPayset['tomorrow']['payreturn']='http://www.domain.com/modules/pay/tomorrowreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
//�����������
//$jieqiPayset['tomorrow']['paylimit']=array('100'=>'1');  

$jieqiPayset['tomorrow']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['tomorrow']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

//���Ʋ���
$jieqiPayset['tomorrow']['TOUSER']='';  //����SP���û������Է���ҪУ�顿
$jieqiPayset['tomorrow']['TOPASS']='';  //����SP�����롾�Է���ҪУ�顿
$jieqiPayset['tomorrow']['MOUSEID']='';  //�������ID
$jieqiPayset['tomorrow']['MOUSEPACKAGEID']='1';  //���ʳ�Ա��ID��������ID
$jieqiPayset['tomorrow']['ISIMBALANCE']='0';  //�Ƿ����
$jieqiPayset['tomorrow']['ATTIME']='';  //��ʱ�·�ʱ��
$jieqiPayset['tomorrow']['MTTYPE']='2';  //MT����
$jieqiPayset['tomorrow']['MSGFORMAT']='15';  //��Ϣ�����ʽ0��ASCII3��д������ 4�������� 8��UCS2 15��GB�뺺��
$jieqiPayset['tomorrow']['REMARK']='';  //��ע

//��ͬ���Ŵ�����������������ͬ
//serviceid   - ����ID��������д��
//smtypeid    - MTҵ����Ϣ���͡�������д��
//egold       - ��ֵ�������
//emoney      - ʵ�ʿ۵Ľ��(��λ����)
//startmsg    - �ֻ�����������Ϣ��ʼ���
//message     - ��վ�����ֻ�����ʾ��Ϣ(<{$serialno}> ������ţ�<{$randpass}> ��ֵ���� <{$egold}> �����)

$jieqiPayset['tomorrow']['paytype'][]=array('serviceid'=>'', 'smtypeid'=>'', 'egold'=>'100', 'emoney'=>'100', 'startmsg'=>'', 'message'=>'������ţ�<{$serialno}>����ֵ���룺<{$randpass}>���ʷѣ�1Ԫ�����½��վ��ɳ�ֵ��');


/*
//�������Ŀǰ����
//��������ˣ�������Ϊ׼������ԭ������
$jieqiPayset['tomorrow']['CLASSID']='';  //���ؽ��յ�URL
$jieqiPayset['tomorrow']['CITYID']='';  //����ID
$jieqiPayset['tomorrow']['PROVINCEID']='';  //ʡ��ID

//���������У�����ԭ������
$jieqiPayset['tomorrow']['GATEWAYID']='';  //����ID��ԭ�����շ��أ�
$jieqiPayset['tomorrow']['SPNUMBER']='';  //�ط���
$jieqiPayset['tomorrow']['LINKID']='';  //�㲥ҵ��ʹ�õ�LinkID���ǵ㲥��ҵ���MT ���̲�ʹ�ø��ֶΡ�

*/

//��������
$jieqiPayset['tomorrow']['passlen']='8';  //������볤��

$jieqiPayset['tomorrow']['passtype']='3';  //����������� 1-���֣�2-Сд��ĸ, 3-���ֺ�Сд��ĸ

$jieqiPayset['tomorrow']['addvars']=array();  //���Ӳ���

//�ֻ�����֧����Ҫ���ε��ֻ��ţ�������һ��php����
//�� $jieqiPayset['tomorrow']['denyphone']=array('13600000000', '13700000000', '13800000000');
$jieqiPayset['tomorrow']['denyphone']=array();
?>