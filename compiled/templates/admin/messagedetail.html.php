<?php
echo '<table class="grid" width="100%" align="center">
<caption>���⣺'.$this->_tpl_vars['messagevals']['title'].'</caption>
  <tr>
    <td width="20%" class="tdl">�����ˣ�</td>
    <td width="80%" class="tdr">';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['messagevals']['fromid']).'" target="_blank">'.$this->_tpl_vars['messagevals']['fromname'].'</a> [<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/usermanage.php?id='.$this->_tpl_vars['messagevals']['fromid'].'">�����û�</a>]';
}else{
echo '<span class="hottext">��վ����Ա</span>';
}
echo '</td>
  </tr>
  <tr>
    <td class="tdl">�����ˣ�</td>
    <td class="tdr">';
if($this->_tpl_vars['messagevals']['toid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['messagevals']['toid']).'" target="_blank">'.$this->_tpl_vars['messagevals']['toname'].'</a> [<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/usermanage.php?id='.$this->_tpl_vars['messagevals']['toid'].'">�����û�</a>]';
}else{
echo '<span class="hottext">��վ����Ա</span>';
}
echo '</td>
  </tr>
  <tr>
    <td class="tdl">ʱ&nbsp; �䣺</td>
    <td class="tdr">'.date('Y-m-d H:i:s',$this->_tpl_vars['messagevals']['postdate']).'</td>
  </tr>
  <tr>
    <td class="tdl">��&nbsp; �ݣ�</td>
    <td class="tdr">'.$this->_tpl_vars['messagevals']['content'].'</td>
  </tr>
  <tr>
    <td colspan="2" class="foot">';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/newmessage.php?reid='.$this->_tpl_vars['messagevals']['messageid'].'">�ظ���Ϣ</a>&nbsp;&nbsp;&nbsp;&nbsp;';
}
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/newmessage.php?fwid='.$this->_tpl_vars['messagevals']['messageid'].'">ת����Ϣ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:if(confirm(\'ȷʵҪɾ������Ϣô��\')) document.location=\''.$this->_tpl_vars['jieqi_url'].'/admin/message.php?box='.$this->_tpl_vars['box'].'&delid='.$this->_tpl_vars['messagevals']['messageid'].'\'">ɾ����Ϣ</a>&nbsp;&nbsp;&nbsp;&nbsp;';
if($this->_tpl_vars['box'] == 'outbox'){
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/message.php?box=outbox">���ط�����</a>';
}else{
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/message.php?box=inbox">�����ռ���</a>';
}
echo '</td>
  </tr>
</table>
';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '
<script type="text/javascript">
<!--
  function frmnewmessage_validate(){
    if ( document.frmnewmessage.title.value == "" ){
      alert( "���������" );
      document.frmnewmessage.title.focus();
      return false;
    }
  }
//-->
</script>
<br />
<form name="frmnewmessage" id="frmnewmessage" action="'.$this->_tpl_vars['jieqi_url'].'/admin/newmessage.php?do=submit" method="post" onsubmit="return frmnewmessage_validate();">
<table class="grid" width="100%" align="center">
  <caption>���ٻظ�</caption>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">�ռ��ˣ�</td>
    <td class="tdr">';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['messagevals']['fromid']).'" target="_blank">'.$this->_tpl_vars['messagevals']['fromname'].'</a><input type="hidden" name="receiver" id="receiver" size="30" maxlength="30" value="'.$this->_tpl_vars['messagevals']['fromname'].'" />';
}else{
echo '<span class="hottext">��վ����Ա</span><input type="hidden" name="tosys" id="tosys" value="1" />';
}
echo '</td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">���⣺</td>
    <td class="tdr"><input type="text" class="text" name="title" id="title" size="30" maxlength="100" value="Re:'.$this->_tpl_vars['messagevals']['title'].'" /></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">���ݣ�</td>
    <td class="tdr"><textarea class="textarea" name="content" id="content" rows="8" cols="60"></textarea></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">&nbsp;</td>
    <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�ظ���Ϣ" /><input type="hidden" name="action" id="action" value="newmessage" /></td>
  </tr>
</table>
</form>
';
}

?>