<?php
echo '<form name="frmbatchclecn" method="post" action="'.$this->_tpl_vars['url_batchclean'].'" target="_blank" onsubmit="return confirm(\'���������漰����ɾ���������ɻָ���ȷ��Ҫִ��ô��\');">
<table class="grid" width="100%" align="center">
<caption>С˵��������</caption>
<tr>
  <td class="tdl" width="25%">ִ�еĲ�����</td>
  <td class="tdr" width="75%">
  <input name="operate" type="radio" value="delarticle"> ɾ��С˵��������Ӧ�½ڡ��������Ķ��ļ�<br />
  <input name="operate" type="radio" value="delchapter"> ɾ��С˵�������½ڣ������Ķ��ļ�������С˵��Ϣ������<br />
  <input name="operate" type="radio" value="delattach"> ɾ��С˵���и������½ڣ�ͨ����ָͼƬ����<br />  
  <input name="operate" type="radio" value="hidearticle"> ���ط�������С˵<br />  
  <input name="operate" type="radio" value="showarticle" checked="checked"> ��ʾ��������С˵<br />  
  </td>
</tr>
<tr>
  <td class="tdl">С˵ID��</td>
  <td class="tdr">�� <input name="startid" type="text" id="startid" size="10" maxlength="11" class="text"> �� <input name="stopid" type="text" id="stopid" size="10" maxlength="11" class="text"> ��С˵</td>
</tr>
<tr>
  <td class="tdl">����ʱ�䣺</td>
  <td class="tdr">��� <input name="upday" type="text" id="upday" size="10" maxlength="11" class="text"> ���� <select name="upflag">
    <option value="0">δ����</option>
    <option value="1">���¹�</option>
  </select> 
    ��С˵</td>
</tr>
<tr>
  <td class="tdl">���ͳ�ƣ�</td>
  <td class="tdr">
  <select name="visittype">
    <option value="allvisit">�ܵ��</option>
    <option value="monthvisit">�µ��</option>
	<option value="weekvisit">�ܵ��</option>
	<option value="allvote">���Ƽ�</option>
    <option value="monthvote">���Ƽ�</option>
	<option value="weekvote">���Ƽ�</option>
  </select>
  <select name="visitflag">
    <option value="0">С��</option>
    <option value="1">����</option>
  </select>
  <input name="visitnum" type="text" id="visitnum" size="10" maxlength="11" class="text"> ��С˵  </td>
</tr>
<tr>
  <td class="tdl">С˵���ͣ�</td>
  <td class="tdr">
  <input name="authorflag" type="radio" value="0" checked> ���� 
  <input name="authorflag" type="radio" value="1"> ԭ��С˵
  <input name="authorflag" type="radio" value="2"> ת��С˵  
  <input name="authorflag" type="radio" value="3"> ����С˵  
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
  <td class="tdl">�ؼ��֣�<br />��ѯС˵���(ID)����С˵��<br />���ID��Ӣ�Ķ��ŷֿ�����Ҫ���У��磺<br />12,34,56,78<br /><br />���С˵������ÿ��һ�У��磺<br />С˵һ<br />С˵��<br />С˵��</td>
  <td class="tdr"><input name="idname" type="radio" value="0" checked>��С˵��ţ����ŷָ� &nbsp;<input name="idname" type="radio" value="1">��С˵����ÿ��һ�� <br />
  <textarea class="textarea" name="articles" id="articles" rows="10" cols="70"></textarea></td>
</tr>
<tr>
  <td class="tdl">�ر�˵����</td>
  <td class="tdr"><span class="hottext">��������������ѡ���������ȫ�����ղ�����������С˵���д���<br />���������ɻָ��������ʹ�ã�</span></td> 
</tr> 
<tr> 
  <td class="tdl">&nbsp;</td>
  <td class="tdr"><input type="submit" name="btnclecn" value="��ʼ����" class="button"><input type="hidden" name="action" value="clean"></td>
</tr>
</table>
</form> ';
?>