<?php
echo '
<link rel="stylesheet" type="text/css" href="/sink/css/sort.css"/>



<div class="layout">
<div class="mainstore">
<div class="sysc_tit">
<div class="sxts"><h3>'.$this->_tpl_vars['articletitle'].'С˵�б�</h3></div></div>

<div class="tab_2">
<div class="search_result">
<div style="display: block;">
';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
<div class="book">
<a target="_blank" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">
<img width="90" height="128" src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'"></a>
<div class="book_info"><h3><em class="btn_a">
<a target="_blank" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" class="active">�����Ķ�</a>
<a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_bookcase'].'\');">�ղر���</a></em>
<a id="book_716873" target="_blank" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></h3>
<dl><dt>���ߣ�</dt><dd class="w_auth"><a target="_blank" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'].'">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a></dd><dt>���ࣺ</dt>
<dd class="w_auth"><a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortid']).'" target="_blank">['.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortname'].']</a></dd><dt>״̬��</dt><dd class="w_auth">������</dd></dl><div class="clear"></div><dl><dt>���£�</dt><dd class="w_auth">'.date('Y-m-d h:i',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</dd><dt>������</dt><dd class="w_auth">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['size'].'</dd></dl><div class="clear"></div><dl><dt>��飺</dt><dd class="book_intro" id="introCut">'.truncate($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['intro'],'102','..').'<a id="moreIntroBtn" style="display:inline block" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">����</a></dd></dl></div></div>';
}
echo '	
																			   
</div>
<div class="cls"></div>
'.$this->_tpl_vars['url_jumppage'].'

</div></div></div>

<div class="layout_right" id="right_2">
<div class="rankTitBox">
<h3>����<span>��</span></h3>
</div>
<div class="tabWrap channelList">
<div class="rankListWrap">
<ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'  </ul>

</div></div>
<div class="rankTitBox mt50 tabSwitch cf">
<div class="fr">
<span class="">���</span><span class="tabCur">�շ�<cite></cite></span></div>
<h3>�Ƽ�<span>��</span></h3>
</div>
<div class="tabWrap channelList"><div class="tabWrap changxiaoList"><div class="rankListWrap"><ul class="rankList rankHover numList tabList" style="display: none;">'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'</ul>

<ul class="rankList rankHover numList tabList hidden" style="display: block;">'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'</ul>
</div>
</div>
</div>

<div class="rankTitBox mt50"><h3>����<span>������</span></h3></div><div class="tabWrap channelList"><div class="tabWrap changxiaoList"><div class="rankListWrap"><ul class="rankList rankHover numList">'.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'</ul></div></div></div>

</div></div>

<script type="text/javascript" src="/sink/js/search_allbooks.js"></script><script type="text/javascript">    var searchInfo = {"TagListOne":"all","TagListTwo":"all","TagListThree":"all","TagListFour":"all","TagListFive":"all","TagListSix":"all","Bookwords":"all","Updatestatus":"all","Lastupdate":"all","Sortby":2,"Isvip":"all","Website":2,"Subjectid":0,"Contentid":0},
    getBookList_ajaxUrl = "";

    $(function () {
        //���ҳ
        CS.page.search.allbooks.init(searchInfo, getBookList_ajaxUrl);
    });

</script>
';
?>