<?php

$jieqiFilter['article']['rgroup'] = array (
  1 => 
  array (
    'caption' => 'Ů��',
    'rgroup' => 1,
  ),
  2 => 
  array (
    'caption' => '����',
    'rgroup' => 2,
  ),
);

$jieqiFilter['article']['order'] = array (
  'weekvisit' => 
  array (
    'caption' => '�ܵ��',
    'order' => 'weekvisit DESC',
    'limit' => 'lastvisit >= <{$weekstart}>',
  ),
  'monthvisit' => 
  array (
    'caption' => '�µ��',
    'order' => 'monthvisit DESC',
    'limit' => 'lastvisit >= <{$monthstart}>',
  ),
  'allvisit' => 
  array (
    'caption' => '�ܵ��',
    'order' => 'allvisit DESC',
  ),
  'weekvote' => 
  array (
    'caption' => '���Ƽ�',
    'order' => 'weekvote DESC',
    'limit' => 'lastvote >= <{$weekstart}>',
  ),
  'monthvote' => 
  array (
    'caption' => '���Ƽ�',
    'order' => 'monthvote DESC',
    'limit' => 'lastvote >= <{$monthstart}>',
  ),
  'allvote' => 
  array (
    'caption' => '���Ƽ�',
    'order' => 'allvote DESC',
  ),
  'size' => 
  array (
    'caption' => '����',
    'order' => 'size DESC',
  ),
  'viptime' => 
  array (
    'caption' => '����ǩԼ',
    'order' => 'viptime DESC',
  ),
  'goodnum' => 
  array (
    'caption' => '�ղ���',
    'order' => 'goodnum DESC',
  ),
  'lastupdate' => 
  array (
    'caption' => '����ʱ��',
    'order' => 'lastupdate DESC',
  ),
  'postdate' => 
  array (
    'caption' => '���ʱ��',
    'order' => 'postdate DESC',
  ),
  'toptime' => 
  array (
    'caption' => '�༭�Ƽ�',
    'order' => 'toptime DESC',
  ),
);

$jieqiFilter['article']['size'] = array (
  1 => 
  array (
    'caption' => '30������',
    'limit' => 'size < 600000',
  ),
  2 => 
  array (
    'caption' => '30-50��',
    'limit' => 'size >= 600000 AND size < 1000000',
  ),
  3 => 
  array (
    'caption' => '50-100��',
    'limit' => 'size >= 1000000 AND size < 2000000',
  ),
  4 => 
  array (
    'caption' => '100-200��',
    'limit' => 'size >= 2000000 AND size < 4000000',
  ),
  5 => 
  array (
    'caption' => '200������',
    'limit' => 'size >= 4000000',
  ),
);

$jieqiFilter['article']['update'] = array (
  1 => 
  array (
    'caption' => '������',
    'days' => 3,
  ),
  2 => 
  array (
    'caption' => '������',
    'days' => 7,
  ),
  3 => 
  array (
    'caption' => '������',
    'days' => 15,
  ),
  4 => 
  array (
    'caption' => 'һ����',
    'days' => 30,
  ),
);

$jieqiFilter['article']['tag'] = array (
  1 => 
  array (
    'caption' => '����',
  ),
  2 => 
  array (
    'caption' => 'Ű��',
  ),
  3 => 
  array (
    'caption' => 'Ůǿ',
  ),
  4 => 
  array (
    'caption' => '����',
  ),
  5 => 
  array (
    'caption' => '����',
  ),
  6 => 
  array (
    'caption' => '����',
  ),
  7 => 
  array (
    'caption' => '��',
  ),
  8 => 
  array (
    'caption' => 'ˬ��',
  ),
  9 => 
  array (
    'caption' => 'Ȩı',
  ),
  10 => 
  array (
    'caption' => 'ǿȢ',
  ),
  11 => 
  array (
    'caption' => '����',
  ),
  12 => 
  array (
    'caption' => '����',
  ),
  13 => 
  array (
    'caption' => '����Ի�',
  ),
  14 => 
  array (
    'caption' => '�ܿ���ʷ',
  ),
  15 => 
  array (
    'caption' => 'լ��',
  ),
  16 => 
  array (
    'caption' => '����',
  ),
  17 => 
  array (
    'caption' => '�ܲ�',
  ),
  18 => 
  array (
    'caption' => 'ְ��',
  ),
  19 => 
  array (
    'caption' => '�ʺ�',
  ),
  20 => 
  array (
    'caption' => '������',
  ),
);

$jieqiFilter['article']['isfull'] = array (
  2 => 
  array (
    'caption' => '��������',
    'limit' => 'fullflag = 0',
  ),
  1 => 
  array (
    'caption' => '�Ѿ�ȫ��',
    'limit' => 'fullflag > 0',
  ),
);

$jieqiFilter['article']['isvip'] = array (
  2 => 
  array (
    'caption' => '�����Ʒ',
    'limit' => 'isvip = 0',
  ),
  1 => 
  array (
    'caption' => 'VIP��Ʒ',
    'limit' => 'isvip = 1',
  ),
  4 => 
  array (
    'caption' => '������Ʒ',
    'limit' => 'isvip = 3',
  ),
  3 => 
  array (
    'caption' => 'ǩԼ��Ʒ',
    'limit' => 'isvip = 4',
  ),
  5 => 
  array (
    'caption' => '	VIP���',
    'limit' => 'isvip = 5',
  ),
);

?>