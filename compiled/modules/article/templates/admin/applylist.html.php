<?php
echo '
<div class="gridtop">作者申请记录&nbsp;&nbsp;&nbsp; <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php">全部记录</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?display=ready">待审记录</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?display=success">已审记录</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?display=failure">被拒记录</a></div>
<form id="form1" name="form1" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=batchdel" onSubmit="javascript:if(confirm(\'确实要删除选中记录么？\')) return true; else return false;">
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="4%"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></th>
    <th width="18%">申请时间</th>
    <th width="14%">申请人</th>
    <th width="16%">审核时间</th>
    <th width="14%">审核人</th>
    <th width="10%">审核状态</th>
    <th width="10%">申请内容</th>
    <th width="14%">操作</th>
  </tr>
  ';
if (empty($this->_tpl_vars['applyrows'])) $this->_tpl_vars['applyrows'] = array();
elseif (!is_array($this->_tpl_vars['applyrows'])) $this->_tpl_vars['applyrows'] = (array)$this->_tpl_vars['applyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['applyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['applyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['applyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['applyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['applyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center"><input name="applyid[]" type="checkbox" id="applyid[]" value="'.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyid'].'" /></td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applytime']).'</td>
    <td><a href="'.$this->_tpl_vars['jieqi_url'].'/admin/usermanage.php?id='.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyuid'].'" target="_blank">'.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyname'].'</a></td>
    <td>';
if($this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['authtime'] > 0){
echo date('Y-m-d H:i:s',$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['authtime']);
}
echo '</td>
    <td><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['authuid']).'" target="_blank">'.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['authname'].'</a></td>
    <td align="center">'.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['authstatus'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applyinfo.php?id='.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyid'].'" target="_blank">点击查看</a></td>
    <td align="center">';
if($this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyflag'] == 0){
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=confirm&id='.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyid'].'">审核</a> <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=refuse&id='.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyid'].'">拒绝</a> ';
}
echo '<a href="javascript:if(confirm(\'确实要删除该申请记录么？\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/applylist.php?action=delete&id='.$this->_tpl_vars['applyrows'][$this->_tpl_vars['i']['key']]['applyid'].'\'">删除</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="8" align="left"><input type="submit" name="Submit" value="批量删除" class="button" /></td>
    </tr>  
</table>
</form>

<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>