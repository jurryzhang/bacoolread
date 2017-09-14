<?php
$jieqiConfigs['article']['needcheck'] = 1; //是否需要审核 1: 需要  0: 不需要
$jieqiConfigs['article']['splitwords'] = 5000; // 自动分割失败 按照字数分割  单位: 汉字
$jieqiConfigs['article']['maxwords'] = 20000; // 自动分割时候 每章最大字数  单位: 汉字
$jieqiConfigs['article']['minwords'] = 50; // 自动分割时候 每章最小字数  单位: 汉字
$jieqiConfigs['article']['maxsize'] = 20480; // 上传电子书 最大的大小  单位: K
$jieqiConfigs['article']['minsize'] = 0; // 上传电子书 最小的大小  单位: K
$jieqiConfigs['article']['uploaddir'] = 'upload'; // 附件上传路径
$jieqiConfigs['article']['banwords'] = array(
	'法轮大法',
	'法轮功',
	'天安门',
	'自焚',
);
?>