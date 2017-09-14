<?php
echo '
<script type="text/javascript">
function frmnewchapter_validate(){
  if(document.frmnewchapter.chaptername.value == ""){
    alert("请输入章节标题");
    document.frmnewchapter.chaptername.focus();
    return false;
  }
}
//统计输入字数
function show_inputsize(txt){
	txt = $_(txt);
	var size = (arguments.length > 1) ? $_(arguments[1]) : $_(txt.id + \'_size\');
	size.innerHTML = Math.ceil(txt.value.replace(/\\s/g, \'\').replace(/[^\\x00-\\xff]/gi, \'--\').length / 2);
}
//临时保存章节内容
function chapter_autosave(){
	if($_(\'chaptercontent\').value != \'\') Ajax.Request(\''.$this->_tpl_vars['jieqi_url'].'/autosave.php\',{method :\'POST\',parameters:\'savedata=\'+encodeURIComponent($_(\'chaptercontent\').value)});
}
AutoSaveTimer = setInterval(chapter_autosave, 60000);
</script>
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/attaches.js"></script>
<form name="frmnewchapter" id="frmnewchapter" action="'.$this->_tpl_vars['url_newchapter'].'" method="post" onsubmit="return frmnewchapter_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>增加章节</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">小说名称：</td>
  <td class="tdr"><a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articleid'].'">'.$this->_tpl_vars['articlename'].'</a></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">分卷名称：</td>
  <td class="tdr">
  <select class="select"  size="1" name="chapterorder" id="chapterorder">
  ';
if (empty($this->_tpl_vars['volumerows'])) $this->_tpl_vars['volumerows'] = array();
elseif (!is_array($this->_tpl_vars['volumerows'])) $this->_tpl_vars['volumerows'] = (array)$this->_tpl_vars['volumerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['volumerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['volumerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['volumerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['volumerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['volumerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <option value="'.$this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['chapterorder'].'"';
if($this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['chapterorder'] == $this->_tpl_vars['chapterorder']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['volumerows'][$this->_tpl_vars['i']['key']]['volumename'].'</option>
  ';
}
echo '
  </select>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">章节标题：</td>
  <td class="tdr"><input type="text" class="text" name="chaptername" id="chaptername" size="50" maxlength="50" value="'.$this->_tpl_vars['chaptername'].'" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="20%">章节内容：<br /><span class="hottext"><br /><input name="textstat" type="button" class="button" onclick="javascript:alert(\'当前长度 \'+ document.getElementById(\'chaptercontent\').value.replace(/\\s/g, \'\').length + \' 字。\');" value="字数统计" /></span></td>
  <td class="tdr"><textarea class="textarea" name="chaptercontent" id="chaptercontent" rows="25" cols="80">';
if($this->_tpl_vars['chaptercontent'] == ''){
echo $this->_tpl_vars['jieqi_autosave'];
}else{
echo $this->_tpl_vars['chaptercontent'];
}
echo '</textarea></td>
</tr>
';
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
if($this->_tpl_vars['issign'] >= 10 && $this->_tpl_vars['isvip'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">是否免费：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="isvip" value="0"';
if($this->_tpl_vars['cvip'] == 0){
echo ' checked="checked"';
}
echo ' />免费章节&nbsp;
  <input type="radio" class="radio" name="isvip" value="1"';
if($this->_tpl_vars['cvip'] > 0){
echo ' checked="checked"';
}
echo ' />VIP章节&nbsp;';
if($this->_tpl_vars['customprice'] > 0){
echo '<input type="text" class="text" name="saleprice" id="saleprice" size="4" maxlength="10" value="'.$this->_tpl_vars['saleprice'].'" />'.$this->_tpl_vars['egoldname'].' <span class="hot">(留空则自动按字数计价)</span>';
}
echo '
</td>
</tr>
';
}
echo '<tr valign="middle" align="left">
  <td class="tdl" width="20%">是否完本：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="fullflag" value="0" checked="checked" />未完待续&nbsp;
  <input type="radio" class="radio" name="fullflag" value="1" />完结篇
</td>
</tr>
';
if($this->_tpl_vars['authtypeset'] == 1){
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">小说排版：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="typeset" value="1" checked="checked" />自动排版&nbsp;
  <input type="radio" class="radio" name="typeset" value="0" />无需排版
</td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="20%">发表方式：</td>
  <td class="tdr">
  <input type="radio" class="radio" name="posttype" value="0"  checked="checked"/>直接发表&nbsp;
  <input type="radio" class="radio" name="posttype" value="1" />存为草稿&nbsp;<span class="hot">(定时发布请先存草稿后编辑定时)</span>
  
  
 <!-- ';
if($this->_tpl_vars['uptiming'] > 0){
echo ' 

  <input type="radio" class="radio" name="posttype" value="2" />定时发表
  <input type="text" class="text" name="pubyear" id="pubyear" size="4" maxlength="4" value="'.date('Y',$this->_tpl_vars['jieqi_time']).'" />年<input type="text" class="text" name="pubmonth" id="pubmonth" size="2" maxlength="2" value="'.date('m',$this->_tpl_vars['jieqi_time']).'" />月<input type="text" class="text" name="pubday" id="pubday" size="2" maxlength="2" value="'.date('d',$this->_tpl_vars['jieqi_time']).'" />日<input type="text" class="text" name="pubhour" id="pubhour" size="2" maxlength="2" value="" />时<input type="text" class="text" name="pubminute" id="pubminute" size="2" maxlength="2" value="" />分-->
  

	
  
  
  ';
}
echo '
  
  
</td><tr valign="middle" align="left">
  <td class="tdl" width="20%">
  &nbsp;
  <input type="hidden" name="token" value="'.$this->_tpl_vars['token'].'" />
  <input type="hidden" name="aid" value="'.$this->_tpl_vars['articleid'].'" />
  <input type="hidden" name="action" id="action" value="newchapter" />
  ';
if($this->_tpl_vars['draftid'] > 0){
echo '<input type="hidden" name="draftid" value="'.$this->_tpl_vars['draftid'].'" />';
}
echo '
  </td>
  <td class="tdr">
  <input type="submit" class="button" name="submit" value=" 提 交 " />
  ';
if($this->_tpl_vars['needupaudit'] > 0){
echo '&nbsp;&nbsp;<span class="hot">注意：直接发表的章节也会先保存在草稿箱待审章节列表中，管理员审核后才能正常显示。</span>';
}
echo '
  </td>
</tr>
</table>
</form>
</div>
</div>';
?>