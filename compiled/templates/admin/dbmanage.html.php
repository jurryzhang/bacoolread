<?php
if($this->_tpl_vars['option'] == 4){
echo $this->_tpl_vars['s'];
}
if($this->_tpl_vars['option'] == 3){
echo '
<br />
<br />
<table class="grid" align="center" width="50%">
<caption>���ݿⱸ��</caption>
  <tr><td><br />'.$this->_tpl_vars['backup_info'].'<br /><br /></td></tr>
  <tr><td align="center"><a href="javascript:history.go(-1);">������ҳ</a></td></tr>
</table>
';
}
echo '
<table class="grid" width="100%">
  ';
if($this->_tpl_vars['option'] == 1){
echo '  
  <caption>��ʾ</caption>
  <tr><td>
  <ul>
  <li>���ݱ��ݹ��ܸ�������ѡ������ݱ��ݳ��ļ��������������ļ����á����ݿ�ָ������ܻ� phpMyAdmin ���룬Ĭ�ϱ����ļ�������/files/system/dbbackupĿ¼��</li>
  <li>ȫ�����ݾ�������ģ���ļ��͸����ļ���ģ�塢�����ı���ֻ��ͨ�� FTP ������ ./templates, ./files Ŀ¼���ɣ���ϵͳ���ṩ�������ݡ�</li>
  <li>���ݱ���ѡ���е����ã������߼��û���������;ʹ�ã�������δ�����ݿ���ȫ��ϸ�µ��˽�֮ǰ����ʹ��Ĭ�ϲ������ݣ����򽫵��±������ݴ�����������⡣</li>
  <li>ʮ�����Ʒ�ʽ���Ա�֤�������ݵ������ԣ����Ǳ����ļ���ռ�ø���Ŀռ䡣</li>
  ';
}else if($this->_tpl_vars['option'] == 2){
echo '
  <caption>��ʾ</caption>
  <tr><td>
  <ul>
  <li>�������ڻָ��������ݵ�ͬʱ����ȫ������ԭ�����ݣ���ȷ���ָ�ǰ�ѽ���վ�رգ��ָ�ȫ����ɺ���Խ���վ���¿��š�</li>
  <li>���ݻָ�����ֻ�ָܻ��ɵ�ǰ�汾���򵼳��������ļ����������������ʽ�����޷�ʶ��</li>
  <li>�������ֶ����뱸��SQL���ļ����������ݻָ�������ļ�ֻ������ĳһ�־��ļ��������з־������ļ�����ϵͳ�Զ����롣</li>
  <li>ϵͳ���Զ�ʶ������080811_OPSVstMx-1.sql �� 080811_OPSVstMx-1 �� 080811_OPSVstMx���ļ�����</li>
  ';
}
echo '
  </ul>
  </td></tr>
</table>
<br />
'.$this->_tpl_vars['dbmanage_form'].'
<br />
';
if($this->_tpl_vars['option'] == 2){
echo '
<form name="form1" method="post" action="">
<table class="grid" width="100%">
<caption>���ݱ��ݼ�¼</caption>
  <tr align="center">
    <td width="5%">ѡ��</td>
    <td width="5%">���</td>
    <td width="20%">�ļ�����</td>
	<td width="17%">����ʱ��</td>
    <td width="10%">�汾</td>
	<td width="10%">��С</td>
	<td width="10%">����</td>
	<td width="5%">��ʽ</td>
	<td width="5%">���</td>
	<td width="13%">����</td>
  </tr>
';
if (empty($this->_tpl_vars['log_list'])) $this->_tpl_vars['log_list'] = array();
elseif (!is_array($this->_tpl_vars['log_list'])) $this->_tpl_vars['log_list'] = (array)$this->_tpl_vars['log_list'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['log_list']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['log_list']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['log_list']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['log_list']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['log_list']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr align="center">
    <td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['checkbox'].'</td>
	<td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['id'].'</td>
    <td><a href="'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['downloadurl'].'">'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['name'].'</a></td>
	<td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['time'].'</td>
    <td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['version'].'</td>
    <td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['size'].'</td>
	<td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['type'].'</td>
	<td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['mode'].'</td>
    <td>'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['volume'].'</td>
	<td><a href="'.$this->_tpl_vars['log_list'][$this->_tpl_vars['i']['key']]['importurl'].'" onclick="javascript:if(confirm(\'ȷʵҪ�ָ�����������\\n\\n�ò����ᵼ�µ�ǰȫ���򲿷����ݶ�ʧ���ָ�ǰ�����������ݱ��ݹ�����\')){return true;}else{return false;}">�ָ�</a></td>
  </tr>
';
}
echo '
  
</table>
<br />
<input type="checkbox" name="allcheck" onclick="javascript:if(this.checked==true){for(var i=0;i<this.form.elements.length;i++){this.form.elements[i].checked=true;}}else{for(var i=0;i<this.form.elements.length;i++){this.form.elements[i].checked=false;}}" />ȫѡ&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="delcheck" value="ɾ��ѡ�м�¼" class="button" onclick="javascript:if(confirm(\'ȷʵҪɾ��ѡ�м�¼ô��\')){ this.form.checkaction.value=\'1\';this.form.submit();}else{return false;}" /><input name="checkaction" type="hidden" id="checkaction" value="0" />
</form>
';
}
echo '
<br />
<br />';
?>