<?php
echo '<br />
<table class="grid" width="100%" align="center">
<caption>'.$this->_tpl_vars['page_head_name'].'</caption>
<form action="'.$this->_tpl_vars['form_url_action1'].'" method="post" name="checkform" id="checkform">
  <!--<tr>
    <th colspan="10">'.$this->_tpl_vars['jump_menu_js'].$this->_tpl_vars['jump_menu_name'].' <input type="button" name="allcheck" value="显示全部" class="button" onclick="javascript: this.form.submit();" /></td>
  </tr>-->
  <tr align="center">
    <th width="5%" >选择</td>
    <th width="5%" >ID</td>
	<th width="35%">新闻标题</td>
	<th width="10%">所属栏目</td>
	<th width="10%">加入日期</td>
	<th width="5%" >锁定</td>
	<th width="5%" >置顶</td>
	<th width="5%" >点击</td>
    <th width="20%">操作</td>
  </tr>
 ';
if (empty($this->_tpl_vars['news_list'])) $this->_tpl_vars['news_list'] = array();
elseif (!is_array($this->_tpl_vars['news_list'])) $this->_tpl_vars['news_list'] = (array)$this->_tpl_vars['news_list'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['news_list']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['news_list']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['news_list']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['news_list']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['news_list']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td class="odd"  align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['checkbox'].'</td>
    <td class="even" align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['id'].'</td>
	<td class="odd"  align="left"  >'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['title'].'</td>
	<td class="even" align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['category'].'</td>
	<td class="odd"  align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['date'].'</td>
	<td class="even" align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['status'].'</td>
	<td class="odd"  align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['putop'].'</td>
    <td class="even" align="center">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['click'].'</td>
    <td class="odd"  align="center">
		<a href="'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['urleditor'].'">编辑</a>|
		<a href="'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['urlislock'].'">'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['audit'].'</a>|
		<a href="'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['urlputtop'].'">置顶</a>|
		<a href="'.$this->_tpl_vars['news_list'][$this->_tpl_vars['i']['key']]['urldelete'].'">删除</a>
	</td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="10" align="right" class="odd">
		<input type="button" name="allcheck" value="全部选中" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }" />
		<input type="button" name="nocheck" value="全部取消" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }" />
		<input type="submit" name="delcheck" value="删除选中记录" class="button" onclick="javascript:if(confirm(\'确实要删除选中记录么？\')){ this.form.checkaction.value=\'1\';this.form.submit();}else{return false;}" />
		<input type="submit" name="auditcheck" value="审核选中记录" class="button" onclick="javascript:if(confirm(\'确实要进行该操作吗？\')){this.form.checkaction.value=\'2\';this.form.action=\''.$this->_tpl_vars['form_url_action2'].'\';this.form.submit();}else{return false;}" />
		<input type="submit" name="abortcheck" value="取消审核选中记录" class="button" onclick="javascript:if(confirm(\'确实要进行该操作吗？\')){this.form.checkaction.value=\'3\';this.form.action=\''.$this->_tpl_vars['form_url_action2'].'\';this.form.submit();}else{return false;}" />
		<input name="checkaction" type="hidden" id="checkaction" value="0" />
	</td>
  </tr></form>
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>