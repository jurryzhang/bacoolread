<?php
echo '<br />
<table class="grid" width="100%" align="center">
  <caption>动作参数管理</caption>
  <tr align="center">
    <th width="3%">序号</th>
    <th width="6%">动作名称</th>
    <th width="6%">积分执行</th>
	<th width="6%">记录日志</th>
    <th width="6%">发书评</th>
	<th width="6%">VIP动作</th>
	<th width="6%">站内通知</th>
	<th width="6%">是否有消费</th>
	<th width="6%">消费名称</th>
	<th width="6%">消费基数值</th>
	<th width="6%">最小消费值</th>
	<th width="6%">最大消费值</th>
	<th width="6%">获得积分</th>
	<th width="6%">获得贡献值</th>
	<th width="6%">获得月票</th>
	<th width="6%">操作</th>

	
  </tr>
  ';
if (empty($this->_tpl_vars['action'])) $this->_tpl_vars['action'] = array();
elseif (!is_array($this->_tpl_vars['action'])) $this->_tpl_vars['action'] = (array)$this->_tpl_vars['action'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['action']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['action']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['action']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['action']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['action']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actionid'].'</td>
    <td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['acttitle'].'</td>
    <td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['minscore'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['islog'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['isreview'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['isvip'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['ismessage'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['ispay'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['paytitle'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['paybase'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['paymin'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['paymax'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['earnscore'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['earncredit'].'</td>
	<td align="center">'.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['earnvipvote'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/action.php?id='.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actionid'].'&action=edit">编辑</a>';
if($this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actiontype'] == 0){
echo '  <a href="javascript:if(confirm(\'确实要删除该头衔么？\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/action.php?id='.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actionid'].'&action=delete\';">删除</a>';
}
echo '</td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="16" style="color:#FF4500;font-size:16px;">&nbsp;提示：本页参数：0表示否，1表示是。<br/></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">'.$this->_tpl_vars['form_addhonor'].'</td>
  </tr>
</table>
';
?>