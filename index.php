<?php
/**
 * 网站首页
 *
 * 网站首页，允许用户修改载入的区块和模板实现定制效果
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: index.php 344 2013-05-20 03:06:07Z juny $
 */

 //php判断客户端是否为手机  
//代码看上去很多，其实就是数组里面显得多而乱，不要被表面现象所吓倒哦！

function is_mobile()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;

	foreach ($mobile_agents as $device)
	{
		//这里把值遍历一遍，用于查找是否有上述字符串出现过
		if (stristr($user_agent, $device))
		{
			//stristr 查找访客端信息是否在上述数组中，不存在即为PC端。
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
	//定义本页面所属模块（请勿修改）
	define("JIEQI_MODULE_NAME", "system");
	require_once("global.php");
	
	//包含区块参数，可修改第二个参数。默认 blocks 表示载入的区块配置文件是 /configs/blocks.php
	//用户可创建自定义区块配置文件，比如叫 /configs/indexblocks.php，以下函数第二个参数改成 indexblocks 即可
	jieqi_getconfigs(JIEQI_MODULE_NAME, "index", "jieqiBlocks");
	
	//包含页头处理
	include_once JIEQI_ROOT_PATH."/header.php";
		
	//设置首页标志，便于模板里面可以判断
	$jieqiTpl->assign("jieqi_indexpage",1);
	
	//内容模板的赋值有三种方式
	//1、不定义模板变量，表示默认按照区块配置文件的配置显示区块内容和位置
	//$jieqiTset["jieqi_contents_template"] = "";
	//2、指定一个首页中间内容部分模板，页头和页尾部分用系统默认的theme，例子如下：
	
	$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/sink/view-source_yunqi.qq.com.html";
	//$jieqiTset['jieqi_page_template']=JIEQI_ROOT_PATH.'/templates/index_neixiong.html';
	
	//3、指定整页模板，模板本身包含页头页尾部分代码，例子如下：
	//$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/templates/index.html";
	
	//在使用首页模板时候，以下参数为 0 表示不缓存以上模板内容，1 表示缓存 （默认不缓存）
	$jieqiTpl->setCaching(0);
	
	//包含页尾，最终输出网页显示
	include_once(JIEQI_ROOT_PATH."/footer.php");
}
?>