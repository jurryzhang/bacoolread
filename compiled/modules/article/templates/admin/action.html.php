<?php
echo '<br />
<table class="grid" width="100%" align="center">
  <caption>������������</caption>
  <tr align="center">
    <th width="3%">���</th>
    <th width="6%">��������</th>
    <th width="6%">����ִ��</th>
	<th width="6%">��¼��־</th>
    <th width="6%">������</th>
	<th width="6%">VIP����</th>
	<th width="6%">վ��֪ͨ</th>
	<th width="6%">�Ƿ�������</th>
	<th width="6%">��������</th>
	<th width="6%">���ѻ���ֵ</th>
	<th width="6%">��С����ֵ</th>
	<th width="6%">�������ֵ</th>
	<th width="6%">��û���</th>
	<th width="6%">��ù���ֵ</th>
	<th width="6%">�����Ʊ</th>
	<th width="6%">����</th>

	
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
    <td align="center"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/action.php?id='.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actionid'].'&action=edit">�༭</a>';
if($this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actiontype'] == 0){
echo '  <a href="javascript:if(confirm(\'ȷʵҪɾ����ͷ��ô��\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/action.php?id='.$this->_tpl_vars['action'][$this->_tpl_vars['i']['key']]['actionid'].'&action=delete\';">ɾ��</a>';
}
echo '</td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="16" style="color:#FF4500;font-size:16px;">&nbsp;��ʾ����ҳ������0��ʾ��1��ʾ�ǡ�<br/></td>
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