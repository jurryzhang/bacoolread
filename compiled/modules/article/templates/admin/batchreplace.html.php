<?php
echo '<form name="batchreplace" id="batchreplace" action="'.$this->_tpl_vars['url_batchclean'].'" method="post" target="_blank" onsubmit="return confirm(\'ȷʵҪ��ʼ���������滻ô��\');">
<table width="100%" class="grid" align="center">
<caption>С˵���������滻</caption>
<tr>
  <td class="tdl" width="25%">����������</td>
  <td class="tdr" width="75%">
  <input name="action" type="radio" value="replacewithid" checked="checked"> С˵ID�� <input type="text" class="text" name="fromid" id="fromid" size="10" maxlength="15" value="'.$this->_tpl_vars['minaid'].'" /> �� <input type="text" class="text" name="toid" id="toid" size="10" maxlength="15" value="'.$this->_tpl_vars['maxaid'].'" /> <span class="hottext">��ǰ���ݿ�С˵IDΪ��'.$this->_tpl_vars['minaid'].' - '.$this->_tpl_vars['maxaid'].'</span>
  <hr />
  <input name="action" type="radio" value="replacewithtime"> ����ʱ��� <input type="text" class="text" name="starttime" id="starttime" size="20" maxlength="20" value="" /> �� <input type="text" class="text" name="stoptime" id="stoptime" size="20" maxlength="20" value="" /> <span class="hottext">ʱ���ʽ������2005-01-23 23:06:30</span>
  </td>
</tr>
<tr>
  <td class="tdl">���ࣺ</td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="checkbox" class="checkbox" name="sortid[]" value="'.$this->_tpl_vars['i']['key'].'" />'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'&nbsp;&nbsp; 
  ';
}
echo '
  </td>
</tr>
<tr>
  <td class="tdl">�����ַ���</td>
  <td class="tdr"><textarea class="textarea" name="txtsearch" id="txtsearch" rows="5" cols="60"></textarea></td>
</tr>
<tr>
  <td class="tdl">�滻��</td>
  <td class="tdr"><textarea class="textarea" name="txtreplace" id="txtreplace" rows="5" cols="60"></textarea></td>
</tr>
<tr>
  <td class="tdl">�滻����</td>
  <td class="tdr"><input type="radio" class="radio" name="replacetype" value="0" checked="checked" />����������Ϊһ���ַ����滻
<input type="radio" class="radio" name="replacetype" value="1" />ÿ��������Ϊһ���ַ����滻
</td>
</tr>
<tr>
  <td class="tdl">�滻�ļ�����</td>
  <td class="tdr">
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filetxt" />С˵ԭʼ����(txt)
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filetxtjs" />�½�JS��ʽ����(js)
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filehtml" />���½��Ķ�(html)
  <input type="checkbox" class="checkbox" name="replaceflag[]" value="filefull" />ȫ���Ķ�(html)
  </td>
</tr>
<tr>
  <td class="tdl">�ļ���С</td>
  <td class="tdr"><select class="select"  size="1" name="filesize" id="filesize">
<option value="sizeunlimit">������</option>
<option value="sizeless">С��1K</option>
<option value="sizemore">����1K</option>
</select></td>
</tr>
<tr>
  <td class="tdl">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="��ʼ����" /></td>
</tr>
</table>
</form>';
?>