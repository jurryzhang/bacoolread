<?php
//1.�˹����������������ļ���ÿ���������õ�д�����Բο���̨������������Ĭ��д�����ٸ���ʵ����Ҫ�޸Ĳ�����
//2.���Զ���ʾ���飬����ģ��ָ������ʱ�򣬽������������ side ����ֵ���ó� -1
//3.$jieqiBlocks[ �� ]֮������ֿ����Լ����壬��ͬ������ظ�������$jieqiBlocks[12]��ģ����������������ʱ����������ã� {?$jieqi_pageblocks['12']['title']?} ������������  {?$jieqi_pageblocks['12']['content']?} 

$jieqiBlocks[1]=array('bid'=>0, 'blockname'=>'�û���¼', 'module'=>'system', 'filename'=>'block_login', 'classname'=>'BlockSystemLogin', 'side'=>-1, 'title'=>'�û���¼', 'vars'=>'', 'template'=>'', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>0);

$jieqiBlocks[2]=array('bid'=>1, 'blockname'=>'��վ����', 'module'=>'system', 'filename'=>'', 'classname'=>'BlockSystemCustom', 'side'=>-1, 'title'=>'��վ����', 'vars'=>'', 'template'=>'', 'contenttype'=>1, 'custom'=>1, 'publish'=>3, 'hasvars'=>0);

$jieqiBlocks[3]=array('bid'=>0, 'blockname'=>'С˵����', 'module'=>'article', 'filename'=>'block_search', 'classname'=>'BlockArticleSearch', 'side'=>-1, 'title'=>'С˵����', 'vars'=>'', 'template'=>'', 'contenttype'=>0, 'custom'=>0, 'publish'=>3, 'hasvars'=>0);

$jieqiBlocks[4]=array('bid'=>0, 'blockname'=>'�������', 'module'=>'article', 'filename'=>'block_articlelist', 'classname'=>'BlockArticleArticlelist', 'side'=>0, 'title'=>'�������', 'vars'=>'allvisit,10,0,0,0,0', 'template'=>'block_articlelist.html', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>1);

$jieqiBlocks[5]=array('bid'=>0, 'blockname'=>'�������', 'module'=>'article', 'filename'=>'block_articlelist', 'classname'=>'BlockArticleArticlelist', 'side'=>5, 'title'=>'�������', 'vars'=>'lastupdate,10,0,0,0,0', 'template'=>'block_lastupdate.html', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>1);

$jieqiBlocks[6]=array('bid'=>0, 'blockname'=>'�Ƽ�����', 'module'=>'article', 'filename'=>'block_articlelist', 'classname'=>'BlockArticleArticlelist', 'side'=>0, 'title'=>'�Ƽ�����', 'vars'=>'allvote,10,0,0,0,0', 'template'=>'block_articlelist.html', 'contenttype'=>4, 'custom'=>0, 'publish'=>3, 'hasvars'=>1);

?>