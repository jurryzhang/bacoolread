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
function formcheck(){
  if(document.getElementById(\'applytext\').value == "") {
    alert(\'����������С˵���£�\');
	document.getElementById(\'applytext\').focus();
    return false;
  }
}

function textstatnum(){
  alert(\'��ǰ���� \'+ document.getElementById(\'applytext\').value.length + \' ���֡�\');
}
</script>
<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/applywriter.php" method="post" onsubmit="return formcheck();">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="grid">
	<caption>��������</caption>
	<tr>
		<td style="padding:10px;font-size:14px;line-height:180%;">
		<p>
		<strong>һ����������������</strong><br />
		&nbsp;&nbsp;&nbsp; 1������С˵����Ϊԭ����Ʒ��<br />
		&nbsp;&nbsp;&nbsp; 2���бȽ��ȶ���д��ʱ���д���ٶȡ�<br />
		&nbsp;&nbsp;&nbsp; 3��С˵���ݲ��ú���ɫ�顢���μ�����Υ�����ݡ�<br />
		</p>
		<p>
		<strong>��������Ҫ��</strong><br />
		&nbsp;&nbsp;&nbsp; ����ԭ�����߱����ύ������2000�ֵ�ԭ��С˵���£���������ͨ�����ܷ���С˵��<br /><br />
		</p>
		<div style="margin:5px 0;">
		<strong>������������С˵���£�</strong>  <input name="textstat" type="button" class="button" onclick="textstatnum();" value=" ����ͳ�� " />
		</div>
		<textarea id="applytext" name="applytext" cols="80" rows="15"></textarea>
		</td>
	</tr>
	<tr>
    <td align="center" class="foot">
	<input name="action" type="hidden" value="applywriter" />
	<input name="submit" type="submit" id="submit" class="button" value=" ͬ�Ⲣ���� " />
	</td>
  </tr>
</table>
</form>
</div>
</div></div></div>';
?>