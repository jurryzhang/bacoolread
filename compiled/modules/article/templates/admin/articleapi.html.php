<?php
echo '
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_article'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td>
		状态：
		<select class="select" size="1" name="display">
		  <option value="">全部</option>
		  <option value="ready"';
if($this->_tpl_vars['_request']['display'] == 'ready'){
echo ' selected="selected"';
}
echo '>待审</option>
		  <option value="show"';
if($this->_tpl_vars['_request']['display'] == 'show'){
echo ' selected="selected"';
}
echo '>已审</option>
		  <option value="hide"';
if($this->_tpl_vars['_request']['display'] == 'hide'){
echo ' selected="selected"';
}
echo '>隐藏</option>
		  <option value="empty"';
if($this->_tpl_vars['_request']['display'] == 'empty'){
echo ' selected="selected"';
}
echo '>无章节</option>
		  <option value="agent"';
if($this->_tpl_vars['_request']['display'] == 'agent'){
echo ' selected="selected"';
}
echo '>书盟作品</option>
		</select>
		分类：
		<select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">
		<option value="0">不限分类</option>
		';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		<option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['_request']['sortid'] == $this->_tpl_vars['i']['key']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'</option>
		';
}
echo '
		</select>
		<span id="typeselect" name="typeselect"></span>
        <script type="text/javascript">
        function showtypes(obj){
          var typeselect=document.getElementById(\'typeselect\');
          typeselect.innerHTML=\'\';
          ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	      ';
if($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] != ''){
echo '
	      if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') typeselect.innerHTML=\'<select class="select" size="1" name="typeid" id="typeid"><option value="0">不限子类</option>';
if (empty($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = (array)$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '<option value="'.$this->_tpl_vars['j']['key'].'"';
if($this->_tpl_vars['_request']['typeid'] == $this->_tpl_vars['j']['key']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']].'</option>';
}
echo '</select>\';
	      ';
}
echo '
          ';
}
echo '
         }
		 ';
if($this->_tpl_vars['_request']['sortid'] > 0){
echo 'showtypes(document.getElementById(\'sortid\'));';
}
echo '
        </script>
		排序：
		<select class="select" size="1" name="order">
		  <option value="lastupdate"';
if($this->_tpl_vars['_request']['order'] == 'lastupdate'){
echo ' selected="selected"';
}
echo '>最近更新</option>
		  <option value="postdate"';
if($this->_tpl_vars['_request']['order'] == 'postdate'){
echo ' selected="selected"';
}
echo '>入库时间</option>
		  <option value="toptime"';
if($this->_tpl_vars['_request']['order'] == 'toptime'){
echo ' selected="selected"';
}
echo '>编辑推荐</option>
		  <option value="goodnum"';
if($this->_tpl_vars['_request']['order'] == 'goodnum'){
echo ' selected="selected"';
}
echo '>收藏数</option>
		  <option value="size"';
if($this->_tpl_vars['_request']['order'] == 'size'){
echo ' selected="selected"';
}
echo '>小说字数</option>
		  <option value="allvisit"';
if($this->_tpl_vars['_request']['order'] == 'allvisit'){
echo ' selected="selected"';
}
echo '>总点击</option>
		  <option value="monthvisit"';
if($this->_tpl_vars['_request']['order'] == 'monthvisit'){
echo ' selected="selected"';
}
echo '>月点击</option>
		  <option value="allvote"';
if($this->_tpl_vars['_request']['order'] == 'allvote'){
echo ' selected="selected"';
}
echo '>总推荐</option>
		  <option value="monthvote"';
if($this->_tpl_vars['_request']['order'] == 'monthvote'){
echo ' selected="selected"';
}
echo '>月推荐</option>
		</select>
		<select class="select" size="1" name="asc">
		  <option value="0"';
if($this->_tpl_vars['_request']['asc'] == 0){
echo ' selected="selected"';
}
echo '>倒序</option>
		  <option value="1"';
if($this->_tpl_vars['_request']['asc'] == 1){
echo ' selected="selected"';
}
echo '>顺序</option>
		</select>
		 搜索条件：
		<input type="radio" name="keytype" class="radio" value="0"';
if($this->_tpl_vars['_request']['keytype'] == 0){
echo ' checked="checked"';
}
echo '">小说名称
        <input type="radio" name="keytype" class="radio" value="1"';
if($this->_tpl_vars['_request']['keytype'] == 1){
echo ' checked="checked"';
}
echo '>作者 
		<input type="radio" name="keytype" class="radio" value="2"';
if($this->_tpl_vars['_request']['keytype'] == 2){
echo ' checked="checked"';
}
echo '>发表者 &nbsp;&nbsp;
		<input type="submit" name="btnsearch" class="button" value="搜 索">
		<span class="hottext">（下方允许多个关键字，用英文空格分隔）</span>
		<textarea class="textarea" name="keyword" style="width:80%;height:3em;">'.$this->_tpl_vars['_request']['keyword'].'</textarea>
        </td>
    </tr>
</table>
</form>
<form action="'.$this->_tpl_vars['url_batchaction'].'" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
<caption>小说列表</caption>
  <tr align="center">
    <th width="2%">&nbsp;</th>
    <th width="15%">小说名称</th>
	<th width="3%">书号</th>

<th width="">畅读</th>
<th width="">书旗</th>
<th width="">掌阅</th>
<th width="">爱奇艺</th>
<th width="">迅雷</th>
<th width="">阅读星</th>
<th width="">乐读书</th>
<th width="">开阅</th>
<th width="">神马</th>
<th width="">鬼姐姐</th>
<th width="">阅庭</th>

 
    <th width="24%">操作</th>
  </tr>
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
    <td align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'"></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<span class="hottext">vip</span>';
}
echo '</td>
	<td>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'</td>

<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['changdu'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=changdu&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=changdus&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['shuqi'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=shuqi&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=shuqis&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['zhangyue'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=zhangyue&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=zhangyues&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['iqiyi'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=iqiyi&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=iqiyis&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['xunlei'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=xunlei&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=xunleis&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['yueduxing'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=yueduxing&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=yueduxings&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['ledu'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=ledu&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=ledus&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['kaiyue'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=kaiyue&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=kaiyues&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['shenma'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=shenma&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=shenmas&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>
<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['guijiejie'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=guijiejie&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=guijiejies&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>

<td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['ytread'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=ytread&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span style="color: #919191">未授权</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/articleapi.php?action=ytreads&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">已授权</span></a>';
}
echo '</td>


    <td align="center"><!--';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=quxiao&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">解约</span></a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=qianyue&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'"><span class="hottext">签约</span></a>';
}
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=hide&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">隐藏</a> <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=ready&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">待审</a>';
}elseif($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=hide&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">隐藏</a> <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=show&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">审核</a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=show&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">显示</a> <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=ready&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">待审</a>';
}
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo ' <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=toptime&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">推荐</a>/<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=untoptime&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'">不荐</a>';
}else{
echo ' 推荐/不荐';
}
echo '--> <a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank">管理</a> <a href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'" target="_blank">编辑</a> <!--<a href="javascript:if(confirm(\'确实要删除该小说么？\')) document.location=\''.$this->_tpl_vars['article_static_url'].'/admin/article.php?action=del&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'\'">删除</a>--></td>
  </tr>
  ';
}
echo '
  <tr>
    <td align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
    <td colspan="11" align="left">
	<input name="batchaction" id="batchaction" type="hidden" value="del">
	<input name="url_jump" type="hidden" value="'.$this->_tpl_vars['url_jump'].'">
	<input type="button" name="batchdel" value="批量删除" class="button" onclick="javascript:if(confirm(\'确实要删除选中记录么？\')){ this.form.batchaction.value=\'del\'; this.form.submit();}"> &nbsp;
	<input type="button" name="batchhide" value="批量隐藏" class="button" onclick="javascript:if(confirm(\'确实要隐藏选中记录么？\')){ this.form.batchaction.value=\'hide\'; this.form.submit();}"> &nbsp;
	<input type="button" name="batchshow" value="批量审核" class="button" onclick="javascript:if(confirm(\'确实要把选中记录审核通过么？\')){ this.form.batchaction.value=\'show\'; this.form.submit();}"> &nbsp;
	<input type="button" name="batchready" value="批量待审" class="button" onclick="javascript:if(confirm(\'确实要把选中记录设为待审么？\')){ this.form.batchaction.value=\'ready\'; this.form.submit();}"> &nbsp;
	</td>
	<td></td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>