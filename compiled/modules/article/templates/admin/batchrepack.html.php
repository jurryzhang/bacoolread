<?php
echo '<form name="batchrepack" id="batchrepack" action="'.$this->_tpl_vars['url_batchclean'].'" target="_blank" method="post" onsubmit="return confirm(\'ȷʵҪ��ʼ��������ô��\');">
<table class="grid" width="100%" align="center">
<caption>С˵��������</caption>
<tr>
  <td class="tdl" width="25%">����������</td>
  <td class="tdr" width="75%">
  <input name="action" type="radio" value="packwithid" checked="checked"> С˵ID�� <input type="text" class="text" name="fromid" id="fromid" size="10" maxlength="15" value="'.$this->_tpl_vars['minaid'].'" /> �� <input type="text" class="text" name="toid" id="toid" size="10" maxlength="15" value="'.$this->_tpl_vars['maxaid'].'" /> <span class="hottext">��ǰ���ݿ�С˵IDΪ��'.$this->_tpl_vars['minaid'].' - '.$this->_tpl_vars['maxaid'].'</span>
  <hr />
  <input name="action" type="radio" value="packwithtime"> ����ʱ��� <input type="text" class="text" name="starttime" id="starttime" size="20" maxlength="20" value="" /> �� <input type="text" class="text" name="stoptime" id="stoptime" size="20" maxlength="20" value="" /> <span class="hottext">ʱ���ʽ������2005-01-23 23:06:30</span>
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
  <td class="tdl">����ѡ�</td>
  <td class="tdr"><input type="checkbox" class="checkbox" name="packflag[]" value="makeopf" />����OPF(С˵Ŀ¼�ṹ�ļ�)
<input type="checkbox" class="checkbox" name="packflag[]" value="makeindex" />����Ŀ¼ҳHTML
<input type="checkbox" class="checkbox" name="packflag[]" value="makechapter" />�����½�ҳHTML
<input type="checkbox" class="checkbox" name="packflag[]" value="maketxtjs" />�����½�����JS
<input type="checkbox" class="checkbox" name="packflag[]" value="makezip" />����ZIP
<input type="checkbox" class="checkbox" name="packflag[]" value="makefull" />����HTMLȫ���Ķ�
<input type="checkbox" class="checkbox" name="packflag[]" value="maketxtfull" />����TXTȫ���Ķ�
<input type="checkbox" class="checkbox" name="packflag[]" value="makeumd" />�����ֻ�������UMD
<input type="checkbox" class="checkbox" name="packflag[]" value="makejar" />�����ֻ�������JAR
</td>
</tr>
<tr>
  <td class="tdl">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="��ʼ����" /></td>
</tr>
</table>
</form>';
?>