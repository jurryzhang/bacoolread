<?php
//�Ա���¼�ӿڲ�������
//δ�����Ա���¼�ӿ��˺ŵģ��뵽 http://open.taobao.com/ �ύ����

$apiOrder = 5; //�ӿ���ţ������޸�
$apiName = 'taobao'; //�ӿ����������޸�
$apiTitle = '�Ա�'; //�ӿڱ��⣬�����޸�

$apiConfigs[$apiName] = array(); //��ʼ���������飬�����޸�

$apiConfigs[$apiName]['appid'] = '000000';  //Ӧ��ID������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['appkey'] = '000000';  //�ӿ���Կ������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //��¼�󷵻صı�վ��ַ�������޸�

$apiConfigs[$apiName]['scope'] = ''; //������Ȩ��Щapi�ӿڣ���Ӣ�Ķ��ŷָ�
?>