<?php
//����΢����¼�ӿڲ�������

$apiOrder = 4; //�ӿ���ţ������޸�
$apiName = 'weibo'; //�ӿ����������޸�
$apiTitle = '����΢��'; //�ӿڱ��⣬�����޸�

$apiConfigs[$apiName] = array(); //��ʼ���������飬�����޸�

$apiConfigs[$apiName]['appid'] = '380228203';  //Ӧ��ID������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['appkey'] = '862d7c1ceeced01c4be1b6b6ade0ffc1';  //�ӿ���Կ������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //��¼�󷵻صı�վ��ַ�������޸�

//$apiConfigs[$apiName]['callback'] = 'http://www.mianfeidushu.com/api/weibo/loginback.php';  //��¼�󷵻صı�վ��ַ�������޸�

$apiConfigs[$apiName]['scope'] = 'snsapi_login'; //������Ȩ��Щapi�ӿڣ���Ӣ�Ķ��ŷָ�
?>