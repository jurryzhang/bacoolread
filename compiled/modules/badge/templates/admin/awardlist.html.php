<?php
echo '<form name="frmsearch" method="post" action="badgeaward.php">
<table class="grid" width="100%" align="center">
    <tr>
        <td class="odd">
		�ؼ��֣�
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> 
            <select name="keytype">
              <option value="toname">ӵ�����û���</option>
			  <option value="toid">ӵ����ID</option>
			  <option value="fromname">�䷢���û���</option>
			  <option value="fromname">�䷢ID</option>
            </select>
            <input type="submit" name="btnsearch" class="button" value="�� ��">
		</td>
    </tr>
</table>
</form> 
<table class="grid" width="100%" align="center">
<caption>���������¼</caption>
  <tr align="center">
    <th width="14%">��������</th>
	<th width="15%">��������</th>
	<th width="16%">���±�־</th>
    <th width="15%">����ӵ����</th>
    <th width="15%">���°䷢��</th>
    <th width="15%">�䷢ʱ��</th>
	<th width="10%">����</th>
  </tr>
  ';
if (empty($this->_tpl_vars['awardrows'])) $this->_tpl_vars['awardrows'] = array();
elseif (!is_array($this->_tpl_vars['awardrows'])) $this->_tpl_vars['awardrows'] = (array)$this->_tpl_vars['awardrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['awardrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['awardrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['awardrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['awardrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['awardrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td class="odd" align="center">'.$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['btypename'].'</td>
	<td class="even" align="center">'.$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['caption'].'</td>
    <td class="odd" align="center"><img src="'.$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['url_image'].'" border="0" /></td>
    <td class="even" align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['toid']).'" target="_blank">'.$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['toname'].'</a></td>
    <td class="odd" align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['fromid']).'" target="_blank">'.$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['fromname'].'</a></td>
	<td class="even" align="center">'.date('Y-m-d H:i',$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['addtime']).'</td>
	<td class="odd" align="center"><a href="badgeaward.php?action=delete&awardid='.$this->_tpl_vars['awardrows'][$this->_tpl_vars['i']['key']]['awardid'].'&page='.$this->_tpl_vars['page'].'&keytype='.$this->_tpl_vars['keytype'].'&keyword='.$this->_tpl_vars['keyword'].'">ȡ������</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="8" class="foot">&nbsp;'.$this->_tpl_vars['url_jumppage'].'</td>
  </tr>
</table>';
?>