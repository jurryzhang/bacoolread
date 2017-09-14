<?php
echo '
<script type="text/javascript">
//删除
function act_delete(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onReturn: function(){
			$_(o.parentNode.parentNode).remove();
		}
	}
	if(confirm(\'确实要删除该记录么？\')) Ajax.Tip(url, param);
	return false;
}
</script>
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php">
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
            <input type="submit" name="btnsearch" class="button" value="搜 索">
			<input name="type" type="hidden" value="'.$this->_tpl_vars['_request']['type'].'">

            &nbsp;&nbsp;&nbsp;&nbsp;[<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php">显示全部</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?type=1">普通草稿</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?type=2">定时章节</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?type=3">待审章节</a>]  
        </td>
    </tr>
</table>
</form>
<br />

<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
  <caption>';
if($this->_tpl_vars['_request']['type'] == 1){
echo '普通草稿列表';
}elseif($this->_tpl_vars['_request']['type'] == 2){
echo '定时章节列表';
}elseif($this->_tpl_vars['_request']['type'] == 3){
echo '待审章节列表';
}else{
echo '全部草稿列表';
}
echo '</caption>
</table>
<table class="grid" width="100%" align="center">
  <tr align="center" valign="middle">
    <th width="4%">&nbsp;</th>
    <th width="14%" class="head">小说名称</th>
    <th width="18%" class="head">章节标题</th>
	<th width="12%" class="head">更新</th>
	<th width="6%" class="head">类型</th>
	<th width="16%" class="head">状态</th>
	<th width="15%" class="head">发表者</th>
    <th width="15%" class="head">操作</th>
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
echo '<span class="hot">VIP</span>';
}else{
echo '免费';
}
echo '</td>
	<td align="center">';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['ispub_n'] == 1){
echo '定时：'.date('Y-m-d H:i',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['pubdate']);
}else{
echo '草稿';
}
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo '(待审)';
}
echo '</td>
	<td align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['posterid'],'info').'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['poster'].'</a> [<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/newmessage.php?receiver='.urlencode($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['poster']).'&title=" target="_blank">发消息</a>]</td>
    <td align="center">
	<a href="'.$this->_tpl_vars['article_static_url'].'/admin/draftshow.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" target="_blank">查看</a> 
	<a id="act_delete_'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" href="javascript:;" onclick="act_delete(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?checkid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'&type='.$this->_tpl_vars['_request']['type'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\');">删除</a>
	';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo ' <a id="act_audit_'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" href="javascript:;" onclick="Ajax.Tip(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?checkid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'&type='.$this->_tpl_vars['_request']['type'].'&act=audit'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">审核</a>';
}
echo '</td>
';
}
echo '
  </tr>
  <tr>
    <td align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
    <td colspan="7" align="left">
	<input name="act" type="hidden" value="">'.$this->_tpl_vars['jieqi_token_input'].'
	<input name="keyword" type="hidden" value="'.$this->_tpl_vars['_request']['keyword'].'">
	<input name="keytype" type="hidden" value="'.$this->_tpl_vars['_request']['keytype'].'">
	<input name="type" type="hidden" value="'.$this->_tpl_vars['_request']['type'].'">
	<input type="button" name="batchdelete" value="批量删除" class="button" onclick="if(confirm(\'确实要删除选中记录么？\')){this.form.act.value=\'delete\'; this.form.submit();}">
	';
if($this->_tpl_vars['_request']['type'] == 3){
echo '<input type="button" name="batchaudit" value="批量审核" class="button" onclick="this.form.act.value=\'audit\'; this.form.submit();">';
}
echo '
	</td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>
';
?>