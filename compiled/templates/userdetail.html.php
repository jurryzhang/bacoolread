<?php
echo '

'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'�û�����', 'module'=>'system', 'filename'=>'block_userset_tab', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'', 'vars'=>'', 'template'=>'', 'contenttype'=>'4', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'
<table class="grid" width="100%" align="center">
<caption>�û�����</caption>
  <tr align="left">
    <td width="20%"  class="tdl">�û�ID��</td>
    <td width="40%" class="tdr">'.$this->_tpl_vars['uid'].'</td>
    <td width="40%" rowspan="9" class="tdr" align="center">
	<img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['uid'],'l',$this->_tpl_vars['avatar']).'" class="avatar" alt="ͷ��"><br />
	';
if($this->_tpl_vars['jieqi_modules']['badge']['publish'] > 0){
echo '
	<br />
    ';
if($this->_tpl_vars['url_group'] != ""){
echo '<img src="'.$this->_tpl_vars['url_group'].'" border="0" title="'.$this->_tpl_vars['jieqi_groupname'].'"><br />';
}
echo '
	';
if($this->_tpl_vars['url_honor'] != ""){
echo '<img src="'.$this->_tpl_vars['url_honor'].'" border="0" title="'.$this->_tpl_vars['jieqi_honor'].'"><br />';
}
echo '
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
	echo '<img src="'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['imageurl'].'" border="0" title="'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['caption'].'">';
}
echo '
    ';
}
echo '
	</td>
  </tr>
  <tr align="left">
    <td class="tdl">�û�����</td>
    <td class="tdr">'.$this->_tpl_vars['uname'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">�ǳƣ�</td>
    <td class="tdr">'.$this->_tpl_vars['name'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">�ȼ���</td>
    <td class="tdr">'.$this->_tpl_vars['group'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">ͷ�Σ�</td>
    <td class="tdr">'.$this->_tpl_vars['honor'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">�Ա�</td>
    <td class="tdr">'.$this->_tpl_vars['sex'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">Email��</td>
    <td class="tdr"><a href="mailto:'.$this->_tpl_vars['email'].'">'.$this->_tpl_vars['email'].'</a> </td>
  </tr>
  <tr align="left">
    <td class="tdl">QQ��</td>
    <td class="tdr">'.$this->_tpl_vars['qq'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">��վ��</td>
    <td class="tdr"><a href="'.$this->_tpl_vars['url'].'" target="_blank">'.$this->_tpl_vars['url'].'</a></td>
  </tr>
  <tr>
    <td colspan="3" class="foot">�������</td>
  </tr>
  <tr align="left">
    <td class="tdl">ע�����ڣ�</td>
    <td colspan="2" class="tdr">'.date('Y-m-d',$this->_tpl_vars['regdate']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">����ֵ��</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['credit'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">����ֵ��</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['experience'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">���л��֣�</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['score'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">��Ʊ����</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['setting']['gift']['vipvote']).'</td>
  </tr>  <tr align="left">
    <td class="tdl">����������</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['system']['maxfriends']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">���������Ϣ����</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['system']['maxmessages']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">�������ղ�����</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['article']['maxbookmarks']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">ÿ�������Ƽ�������</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['article']['dayvotes']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">ÿ���������ִ�����</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['article']['dayrates']).'</td>
  </tr>
  <tr>
    <td colspan="3" class="foot">VIP��Ϣ</td>
  </tr>
  <tr align="left">
    <td class="tdl">VIP���ͣ�</td>
    <td colspan="2" class="tdr">';
if($this->_tpl_vars['isvip'] <= 0){
echo '��vip��Ա';
}else{
echo 'VIP��Ա';
}
echo '</td>
  </tr>
  <tr align="left">
    <td class="tdl">���µ��ڣ�</td>
    <td colspan="2" class="tdr">';
if($this->_tpl_vars['overtime'] > 0){
echo date('Y-m-d',$this->_tpl_vars['overtime']);
}else{
echo '��δ����';
}
echo ' &nbsp; &nbsp; ��<a id="a_monthly" href="javascript:;" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthly.php?id='.$this->_tpl_vars['uid'].'&ajax_gets=jieqi_contents\', false);">�������</a>��</td>
  </tr>  <tr align="left">
    <td class="tdl">'.$this->_tpl_vars['egoldname'].'��</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['egold'].' &nbsp; [<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php">��ֵ</a>]</td>
  </tr></td>
  </tr>
  <tr>
    <td colspan="3" class="foot">������Ϣ</td>
  </tr>
  <tr align="left">
    <td class="tdl">�û�ǩ����</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['sign'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">���˼�飺</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['intro'].'</td>
  </tr>
</table>';
?>