<?php
/**
 * ���ݱ������ѡ���ֵ�Ķ�Ӧ��ϵ
 * multiple 0 ��ѡ 1 ��ѡ
 * default Ĭ��ֵ
 * items ѡ���б�
*/
//������Ȩ
$jieqiOption['article']['authorflag'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '��Ȩ��������', 0 => '��ʱ������Ȩ'));

//��Ȩ����
$jieqiOption['article']['permission'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '������Ʒ', 0 => '��Ȩ��Ʒ'));

//�׷�״̬
$jieqiOption['article']['firstflag'] = array('multiple' => 0, 'default' => 1, 'items' => array(1 => '��վ�׷�', 0 => '��վ�׷�'));

//����״̬
$jieqiOption['article']['fullflag'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '����', 1 => 'ȫ��'));

//�Ƿ�VIP
$jieqiOption['article']['isvip'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => 'VIP', 0 => '���',3 => '����',4 => 'ǩԼ',5 => 'VIP���'));

//�����鼮����
$jieqiOption['article']['mouthlybuy'] = array('multiple' => 0, 'default' => 0, 'items' => array( 1 => 'VIP', 2 => '����', 3 => 'ǩԼ', 4 => '��Ʒ', 5 => '�����Ƽ�', 6 => 'VIP���'));

//��ʾ״̬
$jieqiOption['article']['display'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '��ʾ', 1 => '����', 2=>'����'));

//�Ƿ�ǩԼ
$jieqiOption['article']['issign'] = array('multiple' => 0, 'default' => 0, 'items' => array(10 => 'A��ǩԼ', 1 => '��ͨǩԼ', 0 => 'δǩԼ'));

//�Ƿ����
$jieqiOption['article']['monthly'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '����', 0 => 'δ����'));

//�Ƿ����
$jieqiOption['article']['discount'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '����', 0 => 'δ����'));

//�Ƿ�VIP���
$jieqiOption['article']['isvvip'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '	vip���', 0 => 'δ���'));

//�Ƿ�Ʒ
$jieqiOption['article']['quality'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '	��Ʒ', 0 => '��ͨ'));

//����Ƶ��
$jieqiOption['article']['rgroup'] = array('multiple' => 0, 'default' => 0, 'items' => array('1' => '����','2' => 'Ů��','3' => '����','4' => '����'));

//��������
$jieqiOption['article']['jieqimonthly'] = array('multiple' => 0, 'default' => 1, 'items' => array(1 => '1000', 3 => '3000', 6 => '6000', 12 => '12000'));
?>