<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<ul class="ultab">
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=1">����VIP</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=3">����ǩԼ</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=2">�������</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=6">����VIP����Ķ�</a></li> 
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=4">���뾫Ʒ</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=5">��������Ƽ�</a></li>
</ul>
<table class="grid" width="100%" align="center"><tr align="center" class="head">	
<th width="20%" class="head">��������</th>
    <th width="35%" class="head">����ʱ��</th>
	<th width="13%" class="head">����״̬</th>
<th width="13%" class="head">��������</th>
	<th width="50%" class="head">����Ա�ظ�</th>  </tr>
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
    <td>'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['texts'].'</td>
  </tr>
  ';
}
echo '
 	</table>
<form name="frmnewarticle" id="frmnewarticle" action="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?do=submit" method="post" onsubmit="return frmnewdraft_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>����'.$this->_tpl_vars['mouthlybuyname'].'</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">����˵����</td>
  <td class="tdr">'.$this->_tpl_vars['gfuname'].'</td>
</tr>


<tr valign="middle" align="left">
  <td class="tdl">С˵���ƣ�</td>
  <td class="tdr">

		<div id="selarticle" style="display:block;">
';
if($this->_tpl_vars['tid'] == 3){
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--��ѡ��--</option>

		';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign'] == 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>';
}
echo '
		';
}
echo '

		</select>
';
}elseif($this->_tpl_vars['tid'] == 1){
echo '
        <select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--��ѡ��--</option>

		';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip'] == 0 && $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign'] > 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>';
}
echo '
		';
}
echo '

		</select>
';
}else{
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--��ѡ��--</option>
               	';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>';
}
echo '
		';
}
}
echo '
		</div>

  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">��ϵ��ʽ��</td>
  <td class="tdr"><input type="text" class="text" name="pc" id="pc" size="30" maxlength="30" value="" /> <span class="hottext"></span>*��������ֻ���������ǹ̶��绰</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">���ͣ�</td>
  <td class="tdr"> 
  <input type="radio" class="radio" name="type" id="type" value="'.$this->_tpl_vars['tid'].'" checked="checked" />����'.$this->_tpl_vars['mouthlybuyname'].'
</td>
</tr><tr valign="middle" align="left">
  <td class="tdl">�������ԣ�</td>
  <td class="tdr"><textarea class="textarea" name="text" id="text" rows="6" cols="60"></textarea>*��������Ա༭˵�Ļ�����Ʒ��������ɵȡ�</td>
</tr>
<tr valign="middle" align="left">
  <td width="20%">
  &nbsp;
  <input type="hidden" name="action" id="action" value="post" />
  </td>
  <td>
  <input type="submit" class="button" name="submit"  id="submit" value="�� ��" />
  </td>
</tr>
</table>
</form>
</div>
</div>';
?>