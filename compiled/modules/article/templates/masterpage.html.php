<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<form action="'.$this->_tpl_vars['url_article'].'" method="post" name="checkform" id="checkform">
<ul class="ultab">
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/masterpage.php"';
if($this->_tpl_vars['_request']['display'] == 'all' || $this->_tpl_vars['_request']['display'] == ''){
echo ' class="selected"';
}
echo '>全部小说</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/masterpage.php?display=author"';
if($this->_tpl_vars['_request']['display'] == 'author'){
echo ' class="selected"';
}
echo '>原创小说</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/masterpage.php?display=poster"';
if($this->_tpl_vars['_request']['display'] == 'poster'){
echo ' class="selected"';
}
echo '>转载小说</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/masterpage.php?display=agent"';
if($this->_tpl_vars['_request']['display'] == 'agent'){
echo ' class="selected"';
}
echo '>代管小说</a></li>
</ul>
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="30%">小说名称</th>
    <th width="35%">最新章节</th>
    <th width="15%">更新</th>
    <th width="20%">操作</th>
  </tr>
  <tbody id="jieqi_page_contents">
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
  <tr>
    <td><a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank" title="作者：'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td>
	';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapterid'] > 0){
echo '
	<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleindex'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipvolume'].' '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapter'].'</a> <em class="hot">vip</em>
	';
}else{
echo '
	<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleindex'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastvolume'].' '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>
	';
}
echo '
	</td>
    <td align="center">'.date('Y-m-d',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
    <td align="center">
	<a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'">管理</a>
	';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sourceid'] == 0){
echo '
	| <a href="'.$this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'">更新</a>
	';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign_n'] == 0){
echo '
	| <a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=3" class="hot" title="申请VIP签约">签约</a>
	';
}
echo '
	';
}
echo '
	</td>
  </tr>
  ';
}
echo '
  </tbody>
</table>
</form>
'.$this->_tpl_vars['url_jumppage'].'

</div>
</div>
';
?>