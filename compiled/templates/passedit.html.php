<?php
echo '
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
'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'用户设置', 'module'=>'system', 'filename'=>'block_userset_tab', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'', 'vars'=>'', 'template'=>'', 'contenttype'=>'4', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'
<script type="text/javascript">
function frmpassedit_validate(){
  if (document.frmpassedit.oldpass.value == ""){
    alert( "请输入原密码！" );
	document.frmpassedit.oldpass.focus();
	return false;
  }
  if(document.frmpassedit.newpass.value == ""){
    alert( "请输入新密码！" );
	document.frmpassedit.newpass.focus();
	return false;
  }
  if (document.frmpassedit.repass.value != document.frmpassedit.newpass.value){
    alert( "两次新密码输入不同，请重新输入！" );
	document.frmpassedit.repass.focus();
	return false;
  }
}
</script>
<form name="frmpassedit" id="frmpassedit" action="'.$this->_tpl_vars['url_passedit'].'" method="post" onsubmit="return frmpassedit_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>修改密码</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">用户名：</td>
  <td class="tdr" width="75%">'.$this->_tpl_vars['jieqi_username'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">原密码：</td>
  <td class="tdr"><input type="password" class="text" name="oldpass" size="25" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">新密码：</td>
  <td class="tdr"><input type="password" class="text" name="newpass" size="25" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">重复新密码：</td>
  <td class="tdr"><input type="password" class="text" name="repass" size="25" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">&nbsp;<input type="hidden" name="action" value="update" />'.$this->_tpl_vars['jieqi_token_input'].'</td>
  <td class="tdr"><input type="submit" class="button" name="submit" value="保 存" /></td>
</tr>
</table>
</form>
</div>
</div></div></div>';
?>