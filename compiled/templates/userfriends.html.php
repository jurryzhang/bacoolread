<?php
echo '
<table class="grid" width="100%" align="center">
<caption>'.$this->_tpl_vars['owner'].' �ĺ���</caption>
  <tr align="center">
    <th width="31%">��������</th>
    <th width="21%">��������</th>
    <th width="13%">�û���Ϣ</th>
    <th width="18%">���Ͷ���Ϣ</th>
    <th width="17%">��Ϊ����</th>
  </tr>
';
if (empty($this->_tpl_vars['friendsrows'])) $this->_tpl_vars['friendsrows'] = array();
elseif (!is_array($this->_tpl_vars['friendsrows'])) $this->_tpl_vars['friendsrows'] = (array)$this->_tpl_vars['friendsrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['friendsrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['friendsrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['friendsrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['friendsrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['friendsrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td>'.$this->_tpl_vars['friendsrows'][$this->_tpl_vars['i']['key']]['yourname'].'</td>
    <td align="center">'.$this->_tpl_vars['friendsrows'][$this->_tpl_vars['i']['key']]['adddate'].'</td>
    <td align="center">[<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['friendsrows'][$this->_tpl_vars['i']['key']]['yourid']).'" target="_blank">�鿴��Ϣ</a>]</td>
    <td align="center">[<a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?receiver='.urlencode($this->_tpl_vars['friendsrows'][$this->_tpl_vars['i']['key']]['yourname']).'" target="_blank">д����Ϣ</a>]</td>
    <td align="center">[<a href="'.$this->_tpl_vars['jieqi_url'].'/addfriends.php?id='.$this->_tpl_vars['friendsrows'][$this->_tpl_vars['i']['key']]['yourid'].'">��Ϊ����</a>]</td>
  </tr>
';
}
echo '</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>