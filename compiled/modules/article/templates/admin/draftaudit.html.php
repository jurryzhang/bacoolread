<?php
echo '
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftaudit.php">
<table class="grid" width="100%" align="center">
    <tr>
        <td>关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50" value="'.$this->_tpl_vars['_request']['keyword'].'"> <input name="keytype" type="radio" class="radio" value="0"';
if($this->_tpl_vars['_request']['keytype'] == 0){
echo ' checked="checked"';
}
echo '>小说名称
            <input type="radio" name="keytype" class="radio" value="1"';
if($this->_tpl_vars['_request']['keytype'] == 1){
echo ' checked="checked"';
}
echo '>发表者 
            <input type="submit" name="btnsearch" class="button" value="搜 索"> <input type="checkbox" name="searchdel" value="1"><span class="hot">搜索后直接删除全部搜索结果</span>

            &nbsp;&nbsp;&nbsp;&nbsp;[<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftaudit.php">显示全部</a>]  
        </td>
    </tr>
</table>
</form>
<br />

<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftaudit.php" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
  <caption>待审核章节</caption>
</table>
<table class="grid" width="100%" align="center">
  <tr align="center" valign="middle">
    <th width="5%">&nbsp;</th>
    <th width="18%" class="head">小说名称</th>
    <th width="30%" class="head">章节标题</th>
	<th width="13%" class="head">更新时间</th>
	<th width="8%" class="head">草稿类型</th>
	<th width="16%" class="head">发表者</th>
    <th width="10%" class="head">操作</th>
  </tr>
';
if (empty($this->_tpl_vars['draftrows'])) $this->_tpl_vars['draftrows'] = array();
elseif (!is_array($this->_tpl_vars['draftrows'])) $this->_tpl_vars['draftrows'] = (array)$this->_tpl_vars['draftrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['draftrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['draftrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['draftrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['draftrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['draftrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr valign="middle">
    <td align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'"></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td><a href="'.$this->_tpl_vars['article_static_url'].'/admin/draftshow.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
	<td align="center">'.date('Y-m-d H:i',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
	<td align="center">';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['isvip_n'] == 1){
echo '电子书';
}else{
echo '公众小说';
}
echo '</td>
	<td align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['posterid'],'info').'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['poster'].'</a> [<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/newmessage.php?receiver='.urlencode($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['poster']).'&title=" target="_blank">发消息</a>]</td>
    <td align="center"><a href="'.$this->_tpl_vars['article_static_url'].'/admin/draftshow.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" target="_blank">查看</a> <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftaudit.php?action=audit&checkid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'">审核</a> <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftaudit.php?action=delete&checkid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'">删除</a></td>
';
}
echo '
  </tr>
  <tr>
    <td align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
    <td colspan="6" align="left">
	<input name="action" id="action" type="hidden" value="">
	<input name="keyword" type="hidden" value="'.$this->_tpl_vars['_request']['keyword'].'">
	<input name="keytype" type="hidden" value="'.$this->_tpl_vars['_request']['keytype'].'">
	<input type="button" name="batchaudit" value="批量审核" class="button" onclick="document.getElementById(\'action\').value=\'audit\'; this.form.submit();">
	<input type="button" name="batchdelete" value="批量删除" class="button" onclick="javascript:if(confirm(\'确实要删除选中记录么？\')){document.getElementById(\'action\').value=\'delete\'; this.form.submit();}">
	</td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>