<?php
/**
 *  �Զ���ҳ��ʾ��
 */

//���屾ҳ���������飬�����޸�
define('JIEQI_MODULE_NAME', 'system');
require_once('global.php');

//�������������ļ�(/configs/customblocks.php)����Ҫ�ֹ��������ļ������ֲ�ͬ���������д�����Բο���̨�������
//������ļ��� customblocks�����Ի����Լ���Ҫ������
jieqi_getconfigs(JIEQI_MODULE_NAME, 'customblocks', 'jieqiBlocks');
//���Զ���ʾ���飬����ģ������ָ��λ�õ���
if(is_array($jieqiBlocks)) foreach($jieqiBlocks as $k => $v) $jieqiBlocks[$k]['side'] = -1;

//����ҳͷ���������޸�
include_once(JIEQI_ROOT_PATH.'/header.php'); 

//���ø�ҳ���ģ���ļ�����ʾ�� /templates/custom.html�����ģ�����Ĭ��theme.html�����������html����ֻҪ�м����ݲ���
//���һ��ģ����һ�������İ���ҳͷҳβ��html��������theme.html������� 'jieqi_contents_template' �ĳ� 'jieqi_page_template'
$jieqiTset['jieqi_contents_template']=JIEQI_ROOT_PATH.'/templates/custom.html';

//��ʹ��ҳ�滺�棬�����޸�
$jieqiTpl->setCaching(0);
//����ҳβ���������޸�
include_once(JIEQI_ROOT_PATH.'/footer.php');  
?>