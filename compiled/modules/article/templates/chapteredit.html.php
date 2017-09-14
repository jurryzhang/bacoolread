<?php
echo '
<script type="text/javascript">
function frmchapteredit_validate(){
  if(document.frmchapteredit.chaptername.value == ""){
    alert("请输入章节章节标题");
    document.frmchapteredit.chaptername.focus();
    return false;
  }
}
</script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/attaches.js"></script>
<form name="frmchapteredit" id="frmchapteredit" action="'.$this->_tpl_vars['url_chapteredit'].'" method="post" onsubmit="return frmchapteredit_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>';
if($this->_tpl_vars['chaptertype'] == 1){
echo '编辑分卷';
}else{
echo '编辑章节';
}
echo '</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">小说名称：</td>
  <td class="tdr"><a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articleid'].'">'.$this->_tpl_vars['articlename'].'</a></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">';
if($this->_tpl_vars['chaptertype'] == 1){
echo '分卷标题：';
}else{
echo '章节标题：';
}
echo '</td>
  <td class="tdr"><input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="'.$this->_tpl_vars['chaptername'].'" />';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['chaptertype'] == 0){
echo '<span class="hottext">vip</span>';
}
echo '</td>
</tr>
';
if($this->_tpl_vars['chaptertype'] != 1){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">章节内容：<br /><span class="hottext"><br /><input name="textstat" type="button" class="button" onclick="javascript:alert(\'当前长度 \'+ document.getElementById(\'chaptercontent\').value.replace(/\\s/g, \'\').length + \' 字。\');" value="字数统计" /></span></td>
  <td class="tdr"><textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80">'.$this->_tpl_vars['chaptercontent'].'</textarea></td>
</tr>
';
if($this->_tpl_vars['isvip_n'] > 0 && $this->_tpl_vars['customprice'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">销售价格：</td>
  <td class="tdr"><input type="text" class="text" name="saleprice" id="saleprice" size="4" maxlength="10" value="';
if($this->_tpl_vars['autoprice'] == 0){
echo $this->_tpl_vars['saleprice'];
}
echo '" />'.$this->_tpl_vars['egoldname'].' <span class="hottext" id="saledesc">(留空则自动按字数计价)</span>
</td>
</tr>
';
}
if($this->_tpl_vars['authtypeset'] == 1){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">小说排版：</td>
  <td class="tdr"><input type="radio" class="radio" name="typeset" value="1" checked="checked" />自动排版
<input type="radio" class="radio" name="typeset" value="0" />无需排版
</td>
</tr>
';
}
if($this->_tpl_vars['attachnum'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">现有附件： <br /><span class="hottext">（取消打勾表示删除该附件）</span></td>
  <td class="tdr">
  ';
if (empty($this->_tpl_vars['attachrows'])) $this->_tpl_vars['attachrows'] = array();
elseif (!is_array($this->_tpl_vars['attachrows'])) $this->_tpl_vars['attachrows'] = (array)$this->_tpl_vars['attachrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['attachrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['attachrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['attachrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['attachrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['attachrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="checkbox" class="checkbox" name="oldattach[]" value="'.$this->_tpl_vars['attachrows'][$this->_tpl_vars['i']['key']]['attachid'].'" checked="checked" />'.$this->_tpl_vars['attachrows'][$this->_tpl_vars['i']['key']]['name'].' 
  ';
}
echo '
  </td>
</tr>
';
}
if($this->_tpl_vars['canupload'] == true && $this->_tpl_vars['maxattachnum'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">附件限制：</td>
  <td class="tdr">文件类型：'.$this->_tpl_vars['attachtype'].', 图片最大：'.$this->_tpl_vars['maximagesize'].'K, 文件最大：'.$this->_tpl_vars['maxfilesize'].'K</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">附件上传：</td>
  <td class="tdr">
  <input type="file" class="file" name="attachfile[]" id="attachfile" onchange="Attaches.addFile(\'attachfile\', \'attachdiv\', true);" /><input type="button" class="filebutton" onclick="if(document.all){document.getElementById(\'attachfile\').outerHTML += \'\';}else{document.getElementById(\'attachfile\').value = \'\';}" value="清空" />
  <div id="attachdiv"></div>
  </td>
</tr>
';
}
}
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">
  &nbsp;
  <input type="hidden" name="action" id="action" value="update" />
  <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['chapterid'].'" />
  <input type="hidden" name="chaptertype" id="chaptertype" value="'.$this->_tpl_vars['chaptertype'].'" />
  </td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
</tr>
</table>
</form>
<script>
$("#chaptercontent").blur(function(){
		$.get("/modules/article/getperegold.php?id='.$this->_tpl_vars['articleid'].'",function(peregold){
			if(peregold > 0){
				var size=document.getElementById(\'chaptercontent\').value.replace(/\\s/g, \'\').length ;
				var saleprice=Math.round(size/1000*peregold);
				$("#saleprice").val(saleprice);
				$("#saledesc").text(\'(该书已经设置千字价,如需单独设置请手动输入)\');
			}
		});
})
</script>';
?>