<?php
/**
 * ��վ��ҳ
 *
 * ��վ��ҳ�������û��޸�����������ģ��ʵ�ֶ���Ч��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: index.php 344 2013-05-20 03:06:07Z juny $
 */

 //php�жϿͻ����Ƿ�Ϊ�ֻ�  
//���뿴��ȥ�ܶ࣬��ʵ�������������Եö���ң���Ҫ�������������ŵ�Ŷ��

function is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;

	foreach ($mobile_agents as $device)
	{
		//�����ֵ����һ�飬���ڲ����Ƿ��������ַ������ֹ�
		if (stristr($user_agent, $device))
		{
			//stristr ���ҷÿͶ���Ϣ�Ƿ������������У������ڼ�ΪPC�ˡ�
			$is_mobile = true;
			break;
		}
	}
	
	return $is_mobile;
}
 
	
if(is_mobile())  
{
	header("Location:http://m.mianfeidushu.com");  
}
else
{
	//���屾ҳ������ģ�飨�����޸ģ�
	define("JIEQI_MODULE_NAME", "system");
	require_once("global.php");
	
	//����������������޸ĵڶ���������Ĭ�� blocks ��ʾ��������������ļ��� /configs/blocks.php
	//�û��ɴ����Զ������������ļ�������� /configs/indexblocks.php�����º����ڶ��������ĳ� indexblocks ����
	jieqi_getconfigs(JIEQI_MODULE_NAME, "index", "jieqiBlocks");
	
	//����ҳͷ����
	include_once JIEQI_ROOT_PATH."/header.php";
		
	//������ҳ��־������ģ����������ж�
	$jieqiTpl->assign("jieqi_indexpage",1);
	
	//����ģ��ĸ�ֵ�����ַ�ʽ
	//1��������ģ���������ʾĬ�ϰ������������ļ���������ʾ�������ݺ�λ��
	//$jieqiTset["jieqi_contents_template"] = "";
	//2��ָ��һ����ҳ�м����ݲ���ģ�壬ҳͷ��ҳβ������ϵͳĬ�ϵ�theme���������£�
	
	$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/sink/view-source_yunqi.qq.com.html";
	//$jieqiTset['jieqi_page_template']=JIEQI_ROOT_PATH.'/templates/index_neixiong.html';
	
	//3��ָ����ҳģ�壬ģ�屾�����ҳͷҳβ���ִ��룬�������£�
	//$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/templates/index.html";
	
	//��ʹ����ҳģ��ʱ�����²���Ϊ 0 ��ʾ����������ģ�����ݣ�1 ��ʾ���� ��Ĭ�ϲ����棩
	$jieqiTpl->setCaching(0);
	
	//����ҳβ�����������ҳ��ʾ
	include_once(JIEQI_ROOT_PATH."/footer.php");
}
?>