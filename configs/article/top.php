<?php
//���а���������
$jieqiTop['article']['allvisit'] = array('caption'=>'�ܵ����', 'description'=>'', 'where'=>'', 'sort'=>'allvisit', 'order'=>'DESC', 'default'=>1, 'publish' => '1');
$jieqiTop['article']['allvote'] = array('caption'=>'���Ƽ���', 'description'=>'', 'where'=>'', 'sort'=>'allvote', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthvisit'] = array('caption'=>'�µ����', 'description'=>'', 'where'=>'lastvisit >= <{$monthstart}>', 'sort'=>'monthvisit', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['monthvote'] = array('caption'=>'���Ƽ���', 'description'=>'', 'where'=>'lastvote >= <{$monthstart}>', 'sort'=>'monthvote', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weekvisit'] = array('caption'=>'�ܵ����', 'description'=>'', 'where'=>'lastvisit >= <{$weekstart}>', 'sort'=>'weekvisit', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['weekvote'] = array('caption'=>'���Ƽ���', 'description'=>'', 'where'=>'lastvote >= <{$weekstart}>', 'sort'=>'weekvote', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['dayvisit'] = array('caption'=>'�յ����', 'description'=>'', 'where'=>'lastvisit >= <{$daystart}>', 'sort'=>'dayvisit', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['dayvote'] = array('caption'=>'���Ƽ���', 'description'=>'', 'where'=>'lastvote >= <{$daystart}>', 'sort'=>'dayvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['postdate'] = array('caption'=>'�������', 'description'=>'', 'where'=>'', 'sort'=>'postdate', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['lastupdate'] = array('caption'=>'�������', 'description'=>'', 'where'=>'', 'sort'=>'lastupdate', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['goodnum'] = array('caption'=>'���ղذ�', 'description'=>'', 'where'=>'', 'sort'=>'goodnum', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['size'] = array('caption'=>'��������', 'description'=>'', 'where'=>'', 'sort'=>'size', 'order'=>'DESC', 'default'=>0, 'publish' => '1');
$jieqiTop['article']['toptime'] = array('caption'=>'��վ�Ƽ�', 'description'=>'', 'where'=>'', 'sort'=>'toptime', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['signtime'] = array('caption'=>'����ǩԼ', 'description'=>'', 'where'=>'', 'sort'=>'signtime', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['viptime'] = array('caption'=>'VIP�������', 'description'=>'', 'where'=>'', 'sort'=>'viptime', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
//2015.4.2
$jieqiTop['article']['weekvipvote'] = array('caption'=>'����Ʊ', 'description'=>'', 'where'=>'', 'sort'=>'weekvipvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['monthvipvote'] = array('caption'=>'����Ʊ', 'description'=>'', 'where'=>'', 'sort'=>'monthvipvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['allvipvote'] = array('caption'=>'����Ʊ', 'description'=>'', 'where'=>'', 'sort'=>'allvipvote', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['weekflower'] = array('caption'=>'����Ʊ', 'description'=>'', 'where'=>'', 'sort'=>'weekflower', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['monthflower'] = array('caption'=>'����Ʊ', 'description'=>'', 'where'=>'', 'sort'=>'monthflower', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
$jieqiTop['article']['allflower'] = array('caption'=>'����Ʊ', 'description'=>'', 'where'=>'', 'sort'=>'allflower', 'order'=>'DESC', 'default'=>0, 'publish' => '0');
?>