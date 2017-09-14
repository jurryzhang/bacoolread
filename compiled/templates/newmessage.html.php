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
<script type="text/javascript">
<!--
function frmnewmessage_validate(){
  if(typeof(document.frmnewmessage.receiver) != "undefined"){
    if(document.frmnewmessage.receiver.value == "" ){
      alert("请输入收件人");
	  document.frmnewmessage.receiver.focus();
	  return false;
    }
  }
  if(document.frmnewmessage.title.value == ""){
    alert("请输入标题");
	window.document.frmnewmessage.title.focus();
	return false;
  }
}
//-->
</script>
<form name="frmnewmessage" id="frmnewmessage" action="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?do=submit" method="post" onsubmit="return frmnewmessage_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>写新消息</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">收件人：</td>
  <td class="tdr">
  ';
if($this->_tpl_vars['tosys'] > 0){
echo '
  网站管理员<input type="hidden" name="tosys" id="tosys" value="'.$this->_tpl_vars['tosys'].'" />
  ';
}else{
echo '
  <input type="text" class="text" name="receiver" id="receiver" size="30" maxlength="30" value="'.$this->_tpl_vars['receiver'].'" />
  ';
}
echo '
  </td>
</tr>
  <tr valign="middle" align="left"><td class="tdl" width="25%">标题：</td>
  <td class="tdr"><input type="text" class="text" name="title" id="title" size="60" maxlength="100" value="'.$this->_tpl_vars['title'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">内容：</td>
  <td class="tdr"><textarea class="textarea" name="content" id="content" rows="12" cols="60">'.$this->_tpl_vars['content'].'</textarea></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="发 送" /><input type="hidden" name="action" id="action" value="newmessage" /></td>
</tr>
</table>
</form>
</div>
</div></div></div>';
?>