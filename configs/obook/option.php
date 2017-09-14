<?php
/**
 * 数据表里面可选项和值的对应关系
 * multiple 0 单选 1 多选
 * default 默认值
 * items 选项列表
*/
//显示状态
$jieqiOption['obook']['display'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '销售中', 1 => '待审核', 2=>'已下架'));

//金额类型
$jieqiOption['obook']['paidcurrency'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '人民币', 1 => '美元'));

//结算类型
$jieqiOption['obook']['paidtype'] = array('multiple' => 0, 'default' => 0, 'items' => array(0 => '稿酬', 1 => '奖励'));

//支付类型
$jieqiOption['obook']['getepe'] = array('multiple' => 0, 'default' => 1, 'items' => array(1 => JIEQI_EGOLD_NAME, 2 => JIEQI_NAME_JUAN));

?>