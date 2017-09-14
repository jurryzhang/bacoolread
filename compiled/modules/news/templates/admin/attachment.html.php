<?php
echo '<br />
<form action="'.$this->_tpl_vars['form_url_action'].'" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
<caption>'.$this->_tpl_vars['page_head_name'].'</caption>
  <tr align="center">
    <th width="5%">选择</td>
    <th width="25%">附件名称</td>
	<th width="20%">附件类型</td>
	<th width="25%">附件大小</td>
	<th width="25%">上传日期</td>
  </tr>
 ';
if (empty($this->_tpl_vars['attach_list'])) $this->_tpl_vars['attach_list'] = array();
elseif (!is_array($this->_tpl_vars['attach_list'])) $this->_tpl_vars['attach_list'] = (array)$this->_tpl_vars['attach_list'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['attach_list']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['attach_list']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['attach_list']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['attach_list']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['attach_list']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr align="center">
    <td class="odd" align="center">'.$this->_tpl_vars['attach_list'][$this->_tpl_vars['i']['key']]['checkbox'].'</td>
    <td class="even">'.$this->_tpl_vars['attach_list'][$this->_tpl_vars['i']['key']]['name'].'</td>
	<td class="odd" >'.$this->_tpl_vars['attach_list'][$this->_tpl_vars['i']['key']]['type'].' </td>
	<td class="even">'.$this->_tpl_vars['attach_list'][$this->_tpl_vars['i']['key']]['size'].'</td>
	<td class="even">'.$this->_tpl_vars['attach_list'][$this->_tpl_vars['i']['key']]['date'].'</td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="5" align="right" class="odd">
		<input type="button" name="allcheck" value="全部选中" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }" />
		<input type="button" name="nocheck" value="全部取消" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }" />
		<input type="submit" name="delcheck" value="删除选中记录" class="button" onclick="javascript:if(confirm(\'确实要删除选中记录么？\')){ this.form.checkaction.value=\'1\';this.form.submit();}else{return false;}" />
		<input name="checkaction" type="hidden" id="checkaction" value="0" />
	</td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>