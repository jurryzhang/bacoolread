<?php
echo '
<table class="grid" width="100%" align="center">
<caption>标题：'.$this->_tpl_vars['messagevals']['title'].'</caption>
  <tr>
    <td width="15%" class="tdl">发送人：</td>
    <td width="85%" class="tdr">';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['messagevals']['fromid']).'" target="_blank">'.$this->_tpl_vars['messagevals']['fromname'].'</a>';
}else{
echo '<span class="hottext">网站管理员</span>';
}
echo '</td>
  </tr>
  <tr>
    <td class="tdl">接收人：</td>
    <td class="tdr">';
if($this->_tpl_vars['messagevals']['toid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['messagevals']['toid']).'" target="_blank">'.$this->_tpl_vars['messagevals']['toname'].'</a>';
}else{
echo '<span class="hottext">网站管理员</span>';
}
echo '</td>
  </tr>
  <tr>
    <td class="tdl">时&nbsp; 间：</td>
    <td class="tdr">'.date('Y-m-d H:i:s',$this->_tpl_vars['messagevals']['postdate']).'</td>
  </tr>
  <tr>
    <td class="tdl">内&nbsp; 容：</td>
    <td class="tdr">'.$this->_tpl_vars['messagevals']['content'].'</td>
  </tr>
  <tr>
    <td colspan="2" class="foot">
	';
if($this->_tpl_vars['messagevals']['toid'] == $this->_tpl_vars['jieqi_userid']){
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?reid='.$this->_tpl_vars['messagevals']['messageid'].'&tosys=';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '0';
}else{
echo '0';
}
echo '">回复消息</a>&nbsp;&nbsp;&nbsp;&nbsp;';
}
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?fwid='.$this->_tpl_vars['messagevals']['messageid'].'">转发消息</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:if(confirm(\'确实要该消息么？\')) document.location=\''.$this->_tpl_vars['jieqi_url'].'/message.php?box='.$this->_tpl_vars['box'].'&delid='.$this->_tpl_vars['messagevals']['messageid'].'\'">删除消息</a>&nbsp;&nbsp;&nbsp;&nbsp;';
if($this->_tpl_vars['box'] == 'outbox'){
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=outbox">返回发件箱</a>';
}else{
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/message.php?box=inbox">返回收件箱</a>';
}
echo '
	</td>
  </tr>
</table>
';
if($this->_tpl_vars['messagevals']['toid'] == $this->_tpl_vars['jieqi_userid']){
echo '
<script type="text/javascript">
<!--
  function jieqiFormValidate_newmessage(){
    if ( window.document.newmessage.title.value == "" ){
      alert( "请输入 标题" );
      window.document.newmessage.title.focus();
      return false;
    }
  }
//-->
</script>
<br />
<form name="newmessage" id="newmessage" action="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?do=submit" method="post" onsubmit="return jieqiFormValidate_newmessage();">
<table class="grid" width="100%" align="center">
  <caption>快速回复</caption>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">收件人：</td>
    <td class="tdr">';
if($this->_tpl_vars['messagevals']['fromid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['messagevals']['fromid']).'" target="_blank">'.$this->_tpl_vars['messagevals']['fromname'].'</a><input type="hidden" name="receiver" id="receiver" size="30" maxlength="30" value="'.$this->_tpl_vars['messagevals']['fromname'].'" />';
}else{
echo '<span class="hottext">网站管理员</span><input type="hidden" name="tosys" id="tosys" value="1" />';
}
echo '</td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">标题：</td>
    <td class="tdr"><input type="text" class="text" name="title" id="title" size="60" maxlength="100" value="Re:'.$this->_tpl_vars['messagevals']['title'].'" /></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">内容：</td>
    <td class="tdr"><textarea class="textarea" name="content" id="content" rows="8" cols="60"></textarea></td>
  </tr>
  <tr valign="middle" align="left">
    <td class="tdl" width="25%">&nbsp;</td>
    <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="回复消息" /><input type="hidden" name="action" id="action" value="newmessage" /></td>
  </tr>
</table>
</form>
';
}

?>