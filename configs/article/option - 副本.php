<?php
/**
 * 数据表里面可选项和值的对应关系
 * multiple 0 单选 1 对选
 * default 默认值
 * items 选项列表
*/
//管理授权
$jieqiOption['article']['authorflag'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '授权给该作者', 0 => '暂时不予授权'));

//授权级别
$jieqiOption['article']['permission'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '独家作品', 0 => '授权作品'));

//首发状态
$jieqiOption['article']['firstflag'] = array('multiple' => 0, 'default' => 1, 'items' => array(1 => '本站首发', 0 => '他站首发'));

//连载状态
$jieqiOption['article']['fullflag'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '连载', 1 => '全本'));

//是否VIP
$jieqiOption['article']['isvip'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => 'VIP', 0 => '免费',3 => '包月',4 => '签约',5 => 'VIP免费'));

//申请书籍类型
$jieqiOption['article']['mouthlybuy'] = array('multiple' => 0, 'default' => 0, 'items' => array( 1 => 'VIP', 2 => '包月', 3 => '签约', 4 => '精品', 5 => '封面推荐', 6 => 'VIP免费'));

//显示状态
$jieqiOption['article']['display'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '显示', 1 => '待审', 2=>'隐藏'));

//是否签约
$jieqiOption['article']['issign'] = array('multiple' => 0, 'default' => 0, 'items' => array(10 => 'A级签约', 1 => '普通签约', 0 => '未签约'));

//是否包月
$jieqiOption['article']['monthly'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '包月', 0 => '未包月'));

//是否打折
$jieqiOption['article']['discount'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '打折', 0 => '未打折'));

//是否VIP免费
$jieqiOption['article']['isvvip'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '	vip免费', 0 => '未免费'));

//是否精品
$jieqiOption['article']['quality'] = array('multiple' => 0, 'default' => 0, 'items' => array(1 => '	精品', 0 => '普通'));

//所属频道
$jieqiOption['article']['rgroup'] = array('multiple' => 0, 'default' => 0, 'items' => array('1' => '男生','2' => '女生','3' => '出版','4' => '其他'));

//包月类型
$jieqiOption['article']['jieqimonthly'] = array('multiple' => 0, 'default' => 1, 'items' => array(1 => '1000', 3 => '3000', 6 => '6000', 12 => '12000'));
?>