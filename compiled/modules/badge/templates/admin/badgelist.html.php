<?php
echo '<table class="grid" width="100%" align="center">
    <tr>
        <td class="odd" align="center">
		';
if (empty($this->_tpl_vars['btyperows'])) $this->_tpl_vars['btyperows'] = array();
elseif (!is_array($this->_tpl_vars['btyperows'])) $this->_tpl_vars['btyperows'] = (array)$this->_tpl_vars['btyperows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['btyperows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['btyperows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['btyperows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['btyperows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['btyperows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo ' [<a href="'.$this->_tpl_vars['jieqi_modules']['badge']['url'].'/admin/badgelist.php?btypeid='.$this->_tpl_vars['btyperows'][$this->_tpl_vars['i']['key']]['btypeid'].'">'.$this->_tpl_vars['btyperows'][$this->_tpl_vars['i']['key']]['title'].'</a>] ';
}
echo '
		</td>
    </tr>
</table>
<div class="gridtop">'.$this->_tpl_vars['badgetitle'];
if($this->_tpl_vars['sysflag'] != 1){
echo ' | <a href="'.$this->_tpl_vars['jieqi_modules']['badge']['url'].'/admin/badgenew.php?btypeid='.$this->_tpl_vars['btypeid'].'">���ӻ���</a>';
}
echo '</div>
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="8%">ѫ��ID</th>
	<th width="16%">��־</th>
    <th width="16%">ѫ������</th>
    <th width="10%">����ID</th>
    <th width="10%">�ϴ�����</th>
	<th width="8%">������</th>
	<th width="8%">�Ѱ䷢</th>
    <th width="24%">����</th>
  </tr>
  ';
if (empty($this->_tpl_vars['badgerows'])) $this->_tpl_vars['badgerows'] = array();
elseif (!is_array($this->_tpl_vars['badgerows'])) $this->_tpl_vars['badgerows'] = (array)$this->_tpl_vars['badgerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['badgerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['badgerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['badgerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['badgerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['badgerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td class="odd" align="center">'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['badgeid'].'</td>
	<td class="even" align="center">';
if($this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['uptime'] > 0){
echo '<img src="'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['url_image'].'" border="0" />';
}
echo '</td>
    <td class="odd">'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['caption'].'</td>
    <td class="even" align="center">'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['linkid'].'</td>
    <td class="odd" align="center">';
if($this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['uptime'] > 0){
echo date('Y-m-d',$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['uptime']);
}else{
echo 'δ�ϴ�';
}
echo '</td>
	<td class="even" align="center">'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['maxnum'].'</td>
    <td class="odd" align="center">'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['usenum'].'</td>
    <td class="even" align="center"><a href="'.$this->_tpl_vars['jieqi_modules']['badge']['url'].'/admin/badgeedit.php?btypeid='.$this->_tpl_vars['btypeid'].'&badgeid='.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['badgeid'].'&linkid='.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['linkid'].'&page='.$this->_tpl_vars['page'].'">�༭</a>';
if($this->_tpl_vars['sysflag'] != 1){
echo ' | <a href="javascript:if(confirm(\'ɾ�����½�ͬʱɾ��������Ļ��¼�¼��ȷ��Ҫ����ô��\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['badge']['url'].'/admin/badgelist.php?action=delete&btypeid='.$this->_tpl_vars['btypeid'].'&badgeid='.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['badgeid'].'&page='.$this->_tpl_vars['page'].'\';">ɾ��</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['badge']['url'].'/admin/badgeconfer.php?btypeid='.$this->_tpl_vars['btypeid'].'&badgeid='.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['badgeid'].'&linkid='.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['linkid'].'">����</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['badge']['url'].'/admin/badgeaward.php?badgeid='.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['badgeid'].'">��¼</a>';
}
echo '</td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="8" class="foot">&nbsp;'.$this->_tpl_vars['url_jumppage'].'</td>
  </tr>
</table>';
?>