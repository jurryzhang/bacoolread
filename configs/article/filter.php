<?php

$jieqiFilter['article']['rgroup'] = array (
  1 => 
  array (
    'caption' => '女生',
    'rgroup' => 1,
  ),
  2 => 
  array (
    'caption' => '男生',
    'rgroup' => 2,
  ),
);

$jieqiFilter['article']['order'] = array (
  'weekvisit' => 
  array (
    'caption' => '周点击',
    'order' => 'weekvisit DESC',
    'limit' => 'lastvisit >= <{$weekstart}>',
  ),
  'monthvisit' => 
  array (
    'caption' => '月点击',
    'order' => 'monthvisit DESC',
    'limit' => 'lastvisit >= <{$monthstart}>',
  ),
  'allvisit' => 
  array (
    'caption' => '总点击',
    'order' => 'allvisit DESC',
  ),
  'weekvote' => 
  array (
    'caption' => '周推荐',
    'order' => 'weekvote DESC',
    'limit' => 'lastvote >= <{$weekstart}>',
  ),
  'monthvote' => 
  array (
    'caption' => '月推荐',
    'order' => 'monthvote DESC',
    'limit' => 'lastvote >= <{$monthstart}>',
  ),
  'allvote' => 
  array (
    'caption' => '总推荐',
    'order' => 'allvote DESC',
  ),
  'size' => 
  array (
    'caption' => '字数',
    'order' => 'size DESC',
  ),
  'viptime' => 
  array (
    'caption' => '最新签约',
    'order' => 'viptime DESC',
  ),
  'goodnum' => 
  array (
    'caption' => '收藏数',
    'order' => 'goodnum DESC',
  ),
  'lastupdate' => 
  array (
    'caption' => '更新时间',
    'order' => 'lastupdate DESC',
  ),
  'postdate' => 
  array (
    'caption' => '入库时间',
    'order' => 'postdate DESC',
  ),
  'toptime' => 
  array (
    'caption' => '编辑推荐',
    'order' => 'toptime DESC',
  ),
);

$jieqiFilter['article']['size'] = array (
  1 => 
  array (
    'caption' => '30万以下',
    'limit' => 'size < 600000',
  ),
  2 => 
  array (
    'caption' => '30-50万',
    'limit' => 'size >= 600000 AND size < 1000000',
  ),
  3 => 
  array (
    'caption' => '50-100万',
    'limit' => 'size >= 1000000 AND size < 2000000',
  ),
  4 => 
  array (
    'caption' => '100-200万',
    'limit' => 'size >= 2000000 AND size < 4000000',
  ),
  5 => 
  array (
    'caption' => '200万以上',
    'limit' => 'size >= 4000000',
  ),
);

$jieqiFilter['article']['update'] = array (
  1 => 
  array (
    'caption' => '三日内',
    'days' => 3,
  ),
  2 => 
  array (
    'caption' => '七日内',
    'days' => 7,
  ),
  3 => 
  array (
    'caption' => '半月内',
    'days' => 15,
  ),
  4 => 
  array (
    'caption' => '一月内',
    'days' => 30,
  ),
);

$jieqiFilter['article']['tag'] = array (
  1 => 
  array (
    'caption' => '宠文',
  ),
  2 => 
  array (
    'caption' => '虐恋',
  ),
  3 => 
  array (
    'caption' => '女强',
  ),
  4 => 
  array (
    'caption' => '养成',
  ),
  5 => 
  array (
    'caption' => '腹黑',
  ),
  6 => 
  array (
    'caption' => '重生',
  ),
  7 => 
  array (
    'caption' => '后宫',
  ),
  8 => 
  array (
    'caption' => '爽文',
  ),
  9 => 
  array (
    'caption' => '权谋',
  ),
  10 => 
  array (
    'caption' => '强娶',
  ),
  11 => 
  array (
    'caption' => '变身',
  ),
  12 => 
  array (
    'caption' => '异能',
  ),
  13 => 
  array (
    'caption' => '扮猪吃虎',
  ),
  14 => 
  array (
    'caption' => '架空历史',
  ),
  15 => 
  array (
    'caption' => '宅斗',
  ),
  16 => 
  array (
    'caption' => '复仇',
  ),
  17 => 
  array (
    'caption' => '总裁',
  ),
  18 => 
  array (
    'caption' => '职场',
  ),
  19 => 
  array (
    'caption' => '皇后',
  ),
  20 => 
  array (
    'caption' => '带球跑',
  ),
);

$jieqiFilter['article']['isfull'] = array (
  2 => 
  array (
    'caption' => '正在连载',
    'limit' => 'fullflag = 0',
  ),
  1 => 
  array (
    'caption' => '已经全本',
    'limit' => 'fullflag > 0',
  ),
);

$jieqiFilter['article']['isvip'] = array (
  2 => 
  array (
    'caption' => '免费作品',
    'limit' => 'isvip = 0',
  ),
  1 => 
  array (
    'caption' => 'VIP作品',
    'limit' => 'isvip = 1',
  ),
  4 => 
  array (
    'caption' => '包月作品',
    'limit' => 'isvip = 3',
  ),
  3 => 
  array (
    'caption' => '签约作品',
    'limit' => 'isvip = 4',
  ),
  5 => 
  array (
    'caption' => '	VIP免费',
    'limit' => 'isvip = 5',
  ),
);

?>