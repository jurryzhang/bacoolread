<?php
echo '
<table class="grid" width="100%" align="center"><tr align="center" class="head">
	
<th width="20%" class="head">��������</th>
<th width="5%" class="head">С˵ID</th>
    <th width="35%" class="head">����ʱ��</th>
	<th width="13%" class="head">����״̬</th>
<th width="13%" class="head">��������</th>
	<th width="50%" class="head">����</th>  </tr>
  ';
if (empty($this->_tpl_vars['monthlyrows'])) $this->_tpl_vars['monthlyrows'] = array();
elseif (!is_array($this->_tpl_vars['monthlyrows'])) $this->_tpl_vars['monthlyrows'] = (array)$this->_tpl_vars['monthlyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['monthlyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['monthlyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['monthlyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['monthlyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['monthlyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr valign="middle">	
  <td><a href="/modules/article/articleinfo.php?id='.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['bookid'].'" target="_blank">'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['bookname'].'</a></td>
  <td>'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['bookid'].'</td>
	<td>'.date('Y-m-d',$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['date']).'</td>
    <td>';
if($this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['typeid'] == 0){
echo '������';
}elseif($this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['typeid'] == 1){
echo '��ʧ��';
}elseif($this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['typeid'] == 2){
echo 'ͨ��';
}
echo '</td>
<td>'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['types'].'</td>
    <td><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/admin/articleups.php?id='.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['id'].'">����</a></td>
  </tr>
  ';
}
echo '
 	</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>