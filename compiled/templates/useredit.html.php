<?php
echo '

<script type="text/javascript">
function jieqiFormValidate_useredit(){
  if(document.useredit.email.value == ""){
    alert("������Email");
    document.useredit.email.focus();
    return false;
  }
}
</script>
<div id="content"><link href="/sink/css/user.css" type="text/css" rel="stylesheet">

<!--wrap begin-->
<div class="wrap2">
  <script type="text/javascript">
$(function(){
	
  var ss = \'userhub\'+\'_\'+\'\';
  if(ss == \'userhub_inbox\' || ss == \'userhub_outbox\' || ss == \'userhub_draft\' || ss == \'userhub_toSysView\' || ss == \'userhub_messagedetail\'){
      $(\'#userhub_newmessage\').parent("dl.list_menu").show();
	  $(\'#userhub_newmessage\').children("a").addClass("focus");
  }
  if(ss == \'chapter_cmView\'){
      $(\'#article_masterPage\').parent("dl.list_menu").show();
	  $(\'#article_masterPage\').children("a").addClass("focus");
  }
//  if(\'\' == \'upaView\'){
//      $(\'#userhub_usereditView\').parent("dl.list_menu").show();
//	  $(\'#userhub_usereditView\').children("a").addClass("focus");
//  }
  if(\'\' == \'hotcomment\'){
      $(\'#userhub_comment\').parent("dl.list_menu").show();
	  $(\'#userhub_comment\').children("a").addClass("focus");
  }
  if(\'\' == \'uservip\'){
      $(\'#userhub_usermember\').parent("dl.list_menu").show();
	  $(\'#userhub_usermember\').children("a").addClass("focus");
  }
  if(\'\' == \'moderatorView\'){
      $(\'#userhub_review_view\').parent("dl.list_menu").show();
	  $(\'#userhub_review_view\').children("a").addClass("focus");
  }
  $(\'#\'+ss).parent("dl.list_menu").show();
  $(\'#\'+ss).children("a").addClass("focus");
  $("li#row em").click(function(){
  $(this).parent().parent().children("dl.list_menu").toggle(300);
  });
});

</script>
<!--sidebar2 begin-->
  <div class="sidebar2 fl bg4 fix">
	
		    <div class="user2 f_blue fix">
'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'

	'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
  <div class="kf"></div>
  </div>
  <div class="article2 fr">
	<div class="boxm2">

'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'�û�����', 'module'=>'system', 'filename'=>'block_userset_tab', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'', 'vars'=>'', 'template'=>'', 'contenttype'=>'4', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'
<script type="text/javascript">
function jieqiFormValidate_useredit(){
  if(document.useredit.email.value == ""){
    alert("������Email");
    document.useredit.email.focus();
    return false;
  }
}
</script>
<form name="useredit" id="useredit" action="'.$this->_tpl_vars['jieqi_url'].'/useredit.php?do=submit" method="post" onsubmit="return jieqiFormValidate_useredit();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>�޸�����</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�û�����</td>
  <td class="tdr">'.$this->_tpl_vars['username'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�ǳƣ�</td>
  <td class="tdr"><input type="text" class="text" name="nickname" id="nickname" size="25" maxlength="39" value="'.$this->_tpl_vars['nickname'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">Email��</td>
  <td class="tdr">';
if($this->_tpl_vars['verify']['email'] > 0){
echo $this->_tpl_vars['email'];
}else{
echo '<input type="text" class="text" name="email" id="email" size="25" maxlength="60" value="'.$this->_tpl_vars['email'].'" />';
}
echo '
&nbsp;<input type="checkbox" class="checkbox" name="showset_email" value="1"';
if($this->_tpl_vars['showset']['email'] > 0){
echo ' checked="checked"';
}
echo ' />��������
</td>
</tr>
<tr valign="middle" align="left">
<td class="tdl" width="25%">�Ա�</td>
<td class="tdr">
<input type="radio" class="radio" name="sex" value="1"';
if($this->_tpl_vars['sex'] == 1){
echo ' checked="checked"';
}
echo '  />��
<input type="radio" class="radio" name="sex" value="2"';
if($this->_tpl_vars['sex'] == 2){
echo ' checked="checked"';
}
echo ' />Ů
<input type="radio" class="radio" name="sex" value="0"';
if($this->_tpl_vars['sex'] == 0){
echo ' checked="checked"';
}
echo '  />����
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">QQ��</td>
  <td class="tdr"><input type="text" class="text" name="qq" id="qq" size="25" maxlength="15" value="'.$this->_tpl_vars['qq'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">MSN��</td>
  <td class="tdr"><input type="text" class="text" name="msn" id="msn" size="25" maxlength="30" value="'.$this->_tpl_vars['msn'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">��վ/΢����</td>
  <td class="tdr"><input type="text" class="text" name="url" id="url" size="25" maxlength="100" value="'.$this->_tpl_vars['url'].'" /></td>
</tr>

<tr valign="middle" align="left">
  <td class="tdl" width="25%">�Ƿ����վ��Email��</td>
  <td class="tdr"><input type="radio" class="radio" name="acceptset_email" value="1"';
if($this->_tpl_vars['acceptset']['email'] > 0){
echo ' checked="checked"';
}
echo ' />��
<input type="radio" class="radio" name="acceptset_email" value="0"';
if($this->_tpl_vars['acceptset']['email'] == 0){
echo ' checked="checked"';
}
echo ' />��
</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�û�ǩ����</td>
  <td class="tdr"><textarea class="textarea" name="sign" id="sign" rows="6" cols="60">'.$this->_tpl_vars['sign'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">���˼�飺</td>
  <td class="tdr"><textarea class="textarea" name="intro" id="intro" rows="6" cols="60">'.$this->_tpl_vars['intro'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'</td>
  <td class="tdr"><input type="submit" class="button" name="submit" value="�� ��" /></td>
</tr>
</table>
</form>
</div>
</div></div></div>';
?>