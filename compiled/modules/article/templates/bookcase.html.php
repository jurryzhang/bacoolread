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
function check_confirm(){
	var checkform = document.getElementById(\'checkform\');
	var checknum = 0;
	for (var i=0; i < checkform.elements.length; i++){
	 if (checkform.elements[i].name == \'checkid[]\' && checkform.elements[i].checked == true) checknum++; 
	}
	if(checknum == 0){
		alert(\'����ѡ��Ҫ��������Ŀ��\');
		return false;
	}
	var newclassid = document.getElementById(\'newclassid\');
	if(newclassid.value == -1){
		if(confirm(\'ȷʵҪ��ѡ����Ŀ�Ƴ����ô��\')) return true;
		else return false;
	}else{
		return true;
	}
}
</script>
<form action="" method="post" name="checkform" id="checkform" onsubmit="return check_confirm();">
<table class="grid" width="100%" align="center">
  <caption>
  ������ܿ��ղ� '.$this->_tpl_vars['maxbookcase'].' �������ղ� '.$this->_tpl_vars['nowbookcase'].' ���������� '.$this->_tpl_vars['classbookcase'].' ����
  ';
if($this->_tpl_vars['maxmarkclass'] > 0){
echo '
  &nbsp;&nbsp;&nbsp;&nbsp;ѡ�����
  <select name="classlist" onchange="javascript:document.location=\'bookcase.php?classid=\'+this.value;">
    <option value="0"';
if($this->_tpl_vars['classid'] == 0){
echo ' selected="selected"';
}
echo '>Ĭ�����</option>
	';
if (empty($this->_tpl_vars['markclassrows'])) $this->_tpl_vars['markclassrows'] = array();
elseif (!is_array($this->_tpl_vars['markclassrows'])) $this->_tpl_vars['markclassrows'] = (array)$this->_tpl_vars['markclassrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['markclassrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['markclassrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['markclassrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['markclassrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['markclassrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
    <option value="'.$this->_tpl_vars['markclassrows'][$this->_tpl_vars['i']['key']]['classid'].'"';
if($this->_tpl_vars['classid'] == $this->_tpl_vars['markclassrows'][$this->_tpl_vars['i']['key']]['classid']){
echo ' selected="selected"';
}
echo '>��'.$this->_tpl_vars['markclassrows'][$this->_tpl_vars['i']['key']]['classid'].'�����</option>
	';
}
echo '
  </select>
  ';
}
echo '
  </caption>
  <tr align="center">
    <th width="5%"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></th>
    <th width="21%">С˵����</th>
    <th width="30%">�����½�</th>
    <th width="30%">��ǩ</th>
    <th width="7%">����</th>
    <th width="7%">����</th>
  </tr>
';
if (empty($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = array();
elseif (!is_array($this->_tpl_vars['bookcaserows'])) $this->_tpl_vars['bookcaserows'] = (array)$this->_tpl_vars['bookcaserows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['bookcaserows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['bookcaserows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['bookcaserows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['bookcaserows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center">
	<input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['caseid'].'">    </td>
    <td>';
if($this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['hasnew'] == 1){
echo '<span class="hottext">��</span>';
}
echo '<a href="'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_index'].'" target="_blank">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td>
	';
if($this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['viptime'] > $this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['freetime']){
echo '
	<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/readbookcase.php?bid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['caseid'].'&aid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articleid'].'&cid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['vipchapterid'].'" target="_blank">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['vipchapter'].'</a><em class="hottext">vip</em>
	';
}else{
echo '
	<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/readbookcase.php?bid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['caseid'].'&aid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articleid'].'&cid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastchapterid'].'" target="_blank">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>
	';
}
echo '
	</td>
    <td><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/readbookcase.php?bid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['caseid'].'&aid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articleid'].'&cid='.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['chapterid'].'" target="_blank">'.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['articlemark'].'</a></td>
    <td align="center">'.date('m-d',$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['lastupdate']).'
	';
if($this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['obookupdate'] != ""){
echo '<br /><span class="hottext">'.date('m-d',$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['obookupdate']).'</span>';
}
echo '</td>
    <td align="center"><a href="javascript:if(confirm(\'ȷʵҪ�������Ƴ����ô��\')) document.location=\''.$this->_tpl_vars['bookcaserows'][$this->_tpl_vars['i']['key']]['url_delete'].'\';">�Ƴ�</a></td>
';
}
echo '  </tr>
<tr>
    <td colspan="6" align="center" class="foot">ѡ����Ŀ
	<select name="newclassid" id="newclassid">
	<option value="-1" selected="selected">�Ƴ����</option>
	<option value="0">�Ƶ�Ĭ�����</option>
	';
if (empty($this->_tpl_vars['markclassrows'])) $this->_tpl_vars['markclassrows'] = array();
elseif (!is_array($this->_tpl_vars['markclassrows'])) $this->_tpl_vars['markclassrows'] = (array)$this->_tpl_vars['markclassrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['markclassrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['markclassrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['markclassrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['markclassrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['markclassrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
    <option value="'.$this->_tpl_vars['markclassrows'][$this->_tpl_vars['i']['key']]['classid'].'">�Ƶ���'.$this->_tpl_vars['markclassrows'][$this->_tpl_vars['i']['key']]['classid'].'�����</option>
	';
}
echo '
  </select> <input name="btnsubmit" type="submit" value=" ȷ�� " class="button" /><input name="clsssid" type="hidden" value="'.$this->_tpl_vars['classid'].'" /></td>
    </tr>
</table>
</form>
</div>
</div></div></div>
';
?>