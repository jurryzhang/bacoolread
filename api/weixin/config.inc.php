<?php
//΢�ŵ�¼�ӿڲ�������
//δ����΢�ŵ�¼�ӿ��˺ŵģ��뵽 http://open.weixin.qq.com/ �ύ����

$apiOrder = 2; //�ӿ���ţ������޸�
$apiName = 'weixin'; //�ӿ����������޸�
$apiTitle = '΢��'; //�ӿڱ��⣬�����޸�

$apiConfigs[$apiName] = array(); //��ʼ���������飬�����޸�

$apiConfigs[$apiName]['appid'] = 'wx49571fba5040eff8';  //Ӧ��ID������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['appkey'] = '61281af902abec56c88a7337f173f78f';  //�ӿ���Կ������ʵ�������ֵ�޸�

//$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //��¼�󷵻صı�վ��ַ�������޸�

$apiConfigs[$apiName]['callback'] = 'http://www.mianfeidushu.com/api/weixin/loginback.php';  //��¼�󷵻صı�վ��ַ�������޸�

$apiConfigs[$apiName]['scope'] = 'snsapi_login'; //������Ȩ��Щapi�ӿڣ���Ӣ�Ķ��ŷָ�

?>
