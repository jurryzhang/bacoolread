<?php
//排行榜类型配置
$jieqiTop['article']['allvisit'] = array('caption'=>'总点击榜', 'description'=>'', 'where'=>'', 'sort'=>'allvisit', 'order'=>'DESC', 'default'=>1, 'publish' => '1');
$jieqiTop['article']['allvote'] = array('caption'=>'总推荐榜', 'description'=>'', 'where'=>'', 'sort'=>'allvote', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthvisit'] = array('caption'=>'月点击榜', 'description'=>'', 'where'=>'lastvisit >= <{$monthstart}>', 'sort'=>'monthvisit', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthvote'] = array('caption'=>'月推荐榜', 'description'=>'', 'where'=>'lastvote >= <{$monthstart}>', 'sort'=>'monthvote', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weekvisit'] = array('caption'=>'周点击榜', 'description'=>'', 'where'=>'lastvisit >= <{$weekstart}>', 'sort'=>'weekvisit', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weekvote'] = array('caption'=>'周推荐榜', 'description'=>'', 'where'=>'lastvote >= <{$weekstart}>', 'sort'=>'weekvote', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['dayvisit'] = array('caption'=>'日点击榜', 'description'=>'', 'where'=>'lastvisit >= <{$daystart}>', 'sort'=>'dayvisit', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['dayvote'] = array('caption'=>'日推荐榜', 'description'=>'', 'where'=>'lastvote >= <{$daystart}>', 'sort'=>'dayvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['postdate'] = array('caption'=>'最新入库', 'description'=>'', 'where'=>'', 'sort'=>'postdate', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['lastupdate'] = array('caption'=>'最近更新', 'description'=>'', 'where'=>'', 'sort'=>'lastupdate', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['goodnum'] = array('caption'=>'总收藏榜', 'description'=>'', 'where'=>'', 'sort'=>'goodnum', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['size'] = array('caption'=>'字数排行', 'description'=>'', 'where'=>'', 'sort'=>'size', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['toptime'] = array('caption'=>'本站推荐', 'description'=>'', 'where'=>'', 'sort'=>'toptime', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['signtime'] = array('caption'=>'最新签约', 'description'=>'', 'where'=>'', 'sort'=>'signtime', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['viptime'] = array('caption'=>'VIP最近更新', 'description'=>'', 'where'=>'', 'sort'=>'viptime', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
//2015.4.2
$jieqiTop['article']['weekvipvote'] = array('caption'=>'周月票', 'description'=>'', 'where'=>'', 'sort'=>'weekvipvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['monthvipvote'] = array('caption'=>'月月票', 'description'=>'', 'where'=>'', 'sort'=>'monthvipvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['allvipvote'] = array('caption'=>'总月票', 'description'=>'', 'where'=>'', 'sort'=>'allvipvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['weekflower'] = array('caption'=>'周月票', 'description'=>'', 'where'=>'', 'sort'=>'weekflower', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['monthflower'] = array('caption'=>'月月票', 'description'=>'', 'where'=>'', 'sort'=>'monthflower', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['allflower'] = array('caption'=>'总月票', 'description'=>'', 'where'=>'', 'sort'=>'allflower', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
?>