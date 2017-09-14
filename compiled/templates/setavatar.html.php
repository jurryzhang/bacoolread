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
<form name="setavatar" id="setavatar" action="'.$this->_tpl_vars['jieqi_url'].'/setavatar.php?do=submit" method="post" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>设置头像</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">用户名：</td>
  <td class="tdr">'.$this->_tpl_vars['jieqi_username'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">当前头像：</td>
  <td class="tdr">
';
if($this->_tpl_vars['avatartype'] > 0){
echo '
<img id="cut_img" src="'.$this->_tpl_vars['url_avatar'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
';
if($this->_tpl_vars['avatarcut'] == 1){
echo '
<img id="cut_img" src="'.$this->_tpl_vars['url_avatars'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
<img id="cut_img" src="'.$this->_tpl_vars['url_avatari'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
';
}
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">上传头像：</td>
  <td class="tdr"><input type="file" class="text" size="30" name="avatarimage" id="avatarimage" /><br />
  <span class="hot">头像图片格式为 '.$this->_tpl_vars['need_imagetype'].' ，文件大小不能超过 '.$this->_tpl_vars['max_imagesize'].'K</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;
  <input type="hidden" name="action" value="upload" />'.$this->_tpl_vars['jieqi_token_input'].'
  </td>
  <td class="tdr"><input type="submit" class="button" name="submit" value="上传头像" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%"><span class="hot">注：</span></td>
  <td class="tdr"><span class="hot">如果发现个人资料里面个人头像未更新，请重新登陆。</span></td>
</tr>
</table>
</form>
</div>
</div></div></div>';
?>