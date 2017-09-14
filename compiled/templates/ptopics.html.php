<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<table width="100%"  border="0" cellspacing="5" cellpadding="3">
  <tr>
    <td width="40%" align="left"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['ownerid']).'">'.$this->_tpl_vars['ownername'].'</a> 的会客室 </td>
    <td width="60%" align="right">';
if($this->_tpl_vars['type'] == "good"){
echo '[<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?oid='.$this->_tpl_vars['ownerid'].'&type=all">全部主题</a>]&nbsp;&nbsp;[精华主题]';
}else{
echo '[全部主题]&nbsp;&nbsp;[<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?oid='.$this->_tpl_vars['ownerid'].'&type=good">精华主题</a>]';
}
if($this->_tpl_vars['enablepost'] == 1){
echo '&nbsp;&nbsp;[<a href="#postnew">发表主题</a>]';
}
echo '</td>
  </tr>
</table>
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="54%" class="head">主题</th>
    <th width="12%" class="head">回复/查看</th>
    <th width="17%" class="head">发表人/回复人</th>
    <th width="15%" class="head">发表时间</th>
  </tr>
  ';
if (empty($this->_tpl_vars['ptopicrows'])) $this->_tpl_vars['ptopicrows'] = array();
elseif (!is_array($this->_tpl_vars['ptopicrows'])) $this->_tpl_vars['ptopicrows'] = (array)$this->_tpl_vars['ptopicrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['ptopicrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['ptopicrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['ptopicrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['ptopicrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['ptopicrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td>';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['istop'] == 1){
echo '<span class="hottext">[顶]</span>';
}
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['isgood'] == 1){
echo '<span class="hottext">[精]</span>';
}
echo '<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopicshow.php?tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'">'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['title'].'</a></td>
    <td align="center">'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['replies'].'/'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['views'].'</td>
    <td>';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['posterid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['posterid'],'space').'" target="_blank">'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['poster'].'</a>';
}else{
echo '游客';
}
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['replyflag'] > 0){
echo '/';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['replierid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['replierid']).'" target="_blank">'.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['replier'].'</a>';
}else{
echo '游客';
}
}
echo '</td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['posttime']).'
	';
if($this->_tpl_vars['ismaster'] == 1){
echo '
	<br />';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['istop'] == 0){
echo '[<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?action=top&oid='.$this->_tpl_vars['ownerid'].'&tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'">置顶</a>]';
}else{
echo '[<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?action=untop&oid='.$this->_tpl_vars['ownerid'].'&tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'">置后</a>]';
}
echo ' 
	';
if($this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['isgood'] == 0){
echo '[<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?action=good&oid='.$this->_tpl_vars['ownerid'].'&tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'">加精</a>]';
}else{
echo '[<a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?action=normal&oid='.$this->_tpl_vars['ownerid'].'&tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'">去精</a>]';
}
echo ' 
	[<a href="javascript:if(confirm(\'确实要删除该主题么？\')) document.location=\''.$this->_tpl_vars['jieqi_url'].'/ptopics.php?action=del&oid='.$this->_tpl_vars['ownerid'].'&tid='.$this->_tpl_vars['ptopicrows'][$this->_tpl_vars['i']['key']]['topicid'].'\';">删除</a>]
	';
}
echo '
	</td>
  </tr>
  ';
}
echo '
</table>
<table width="100%"  border="0" cellspacing="2" cellpadding="3">
    <tr>
        <td align="right">'.$this->_tpl_vars['url_jumppage'].'</td>
    </tr>
</table>
';
if($this->_tpl_vars['enablepost'] == 1){
echo '
<a name="postnew"></a>
<script type="text/javascript">
<!--
function frmptopic_validate(){
  if(document.frmptopic.pcontent.value == ""){
    alert("请输入内容");
    document.frmptopic.pcontent.focus();
    return false;
  }
}
//-->
</script>
<form name="frmptopic" id="frmptopic" action="ptopics.php?oid='.$this->_tpl_vars['oid'].'&do=submit" method="post" onsubmit="return frmptopic_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>发表主题</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">标题：</td>
  <td class="tdr"><input type="text" class="text" name="ptitle" id="ptitle" size="60" maxlength="60" value="" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">内容：</td>
  <td class="tdr"><textarea class="textarea" name="pcontent" id="pcontent" rows="12" cols="60"></textarea>
  <script type="text/javascript">loadJs("'.$this->_tpl_vars['jieqi_url'].'/scripts/ubbeditor_'.$this->_tpl_vars['jieqi_charset'].'.js", function(){UBBEditor.Create("pcontent");});</script>
  </td>
</tr>
';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
<tr valign="middle" align="left">
  <td class="tdl">验证码：</td>
  <td class="tdr"><input type="text" class="text" size="8" maxlength="8" name="checkcode" onfocus="if($_(\'p_imgccode\').style.display == \'none\'){$_(\'p_imgccode\').src = \''.$this->_tpl_vars['jieqi_url'].'/checkcode.php\';$_(\'p_imgccode\').style.display = \'\';}" title="点击显示验证码"><img id="p_imgccode" src="" style="cursor:pointer;vertical-align:middle;margin-left:3px;display:none;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" title="点击刷新验证码"></td>
</tr>
';
}
echo '
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="newpost" /></td>
  <td class="tdr"><input type="submit" class="button" name="btnpost"  id="btnpost" value="提 交" /></td>
</tr>
</table>
</form>
';
}
echo '
<br />
</div></div>';
?>