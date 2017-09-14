<?php
echo '
<div style="width:100%;padding-top:3px;padding-bottom:3px;text-align:left;">
<a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/index.php">论坛首页</a> &gt; <a href="'.jieqi_geturl('forum','topiclist',$this->_tpl_vars['lpage'],$this->_tpl_vars['forumid']).'">'.$this->_tpl_vars['forumname'].'</a> &gt; '.$this->_tpl_vars['title'].'
</div>

<div style="width:100%;padding-top:3px;padding-bottom:3px;">
<div class="fl"><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/newpost.gif" border="0" alt="发表新主题"></a>
';
if($this->_tpl_vars['islock'] == 0){
echo '&nbsp;&nbsp;<a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'&tid='.$this->_tpl_vars['topicid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/reply.gif" border="0" alt="回复主题"></a>';
}
echo '</div>
<div class="fr">'.$this->_tpl_vars['url_jumppage'].'</div>
<div class="cb"></div>
</div>

<table class="grid" width="100%" align="center">
    <tr>
        <th width="20%" class="title">作者</th>
        <th width="80%" align="left" class="title">标题</th>
    </tr>
</table>
';
if (empty($this->_tpl_vars['postrows'])) $this->_tpl_vars['postrows'] = array();
elseif (!is_array($this->_tpl_vars['postrows'])) $this->_tpl_vars['postrows'] = (array)$this->_tpl_vars['postrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['postrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['postrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['postrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['postrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['postrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
<table class="grid" width="100%" align="center">
    <tr>
		<td width="20%" valign="top">
		<div style="padding:5px 0px 5px 15px;line-height:150%;">
		';
if($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['userid'] > 0){
echo '
			<img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['userid'],'l',$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['avatar']).'" class="avatar" alt="头像"><br />
			<strong><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['userid']).'" target="_blank">'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['username'].'</a></strong><br />
  			';
if($this->_tpl_vars['jieqi_modules']['badge']['publish'] > 0){
echo '
  				';
if($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['groupurl'] != ""){
echo '<img src="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['groupurl'].'" border="0" title="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['groupname'].'"><br />';
}
echo '
				';
if($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['honorurl'] != ""){
echo '<img src="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['honorurl'].'" border="0" title="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['honor'].'"><br />';
}
echo '
  				';
if (empty($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'])) $this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'] = array();
elseif (!is_array($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'])) $this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'] = (array)$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
				<img src="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'][$this->_tpl_vars['j']['key']]['imageurl'].'" border="0" title="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows'][$this->_tpl_vars['j']['key']]['caption'].'">
				';
}
echo '
				';
if(count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['badgerows']) > 0){
echo '<br />';
}
echo '
			';
}else{
echo '
				'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['groupname'].'<br />
				'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['honor'].'<br />
  			';
}
echo '
			加入日期：'.date('Y-m-d',$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['regdate']).'<br />
			经　　验：'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['experience'].'<br />
			积　　分：'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['score'].'<br /><br />
			<a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?receiver='.urlencode($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['useruname']).'&ajax_gets=jieqi_contents">发送消息</a> | <a id="addfriends'.$this->_tpl_vars['i']['order'].'" href="'.$this->_tpl_vars['jieqi_url'].'/addfriends.php?id='.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['userid'].'">加为好友</a><br />
			<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['userid']).'" target="_blank">查看资料</a> | <a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?oid='.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['userid'].'" target="_blank">会 客 室</a>
		';
}else{
echo '
			<strong>游客</strong><br /><br /><br /><br /><br />
		';
}
echo '
		</div>
		</td>
        <td width="80%" valign="top">
		<div class="fl"><strong>标题：'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['subject'].'</strong></div>
		<div class="fr"><a href="#pid'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['postid'].'" name="pid'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['postid'].'">'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['order'].'#</a>&nbsp;</div>
		<hr />
		';
if (empty($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'])) $this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'] = array();
elseif (!is_array($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'])) $this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'] = (array)$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'];
$this->_tpl_vars['m']=array();
$this->_tpl_vars['m']['columns'] = 1;
$this->_tpl_vars['m']['count'] = count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages']);
$this->_tpl_vars['m']['addrows'] = count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages']) % $this->_tpl_vars['m']['columns'] == 0 ? 0 : $this->_tpl_vars['m']['columns'] - count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages']) % $this->_tpl_vars['m']['columns'];
$this->_tpl_vars['m']['loops'] = $this->_tpl_vars['m']['count'] + $this->_tpl_vars['m']['addrows'];
reset($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages']);
for($this->_tpl_vars['m']['index'] = 0; $this->_tpl_vars['m']['index'] < $this->_tpl_vars['m']['loops']; $this->_tpl_vars['m']['index']++){
	$this->_tpl_vars['m']['order'] = $this->_tpl_vars['m']['index'] + 1;
	$this->_tpl_vars['m']['row'] = ceil($this->_tpl_vars['m']['order'] / $this->_tpl_vars['m']['columns']);
	$this->_tpl_vars['m']['column'] = $this->_tpl_vars['m']['order'] % $this->_tpl_vars['m']['columns'];
	if($this->_tpl_vars['m']['column'] == 0) $this->_tpl_vars['m']['column'] = $this->_tpl_vars['m']['columns'];
	if($this->_tpl_vars['m']['index'] < $this->_tpl_vars['m']['count']){
		list($this->_tpl_vars['m']['key'], $this->_tpl_vars['m']['value']) = each($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages']);
		$this->_tpl_vars['m']['append'] = 0;
	}else{
		$this->_tpl_vars['m']['key'] = '';
		$this->_tpl_vars['m']['value'] = '';
		$this->_tpl_vars['m']['append'] = 1;
	}
	echo '
		<img src="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'][$this->_tpl_vars['m']['key']]['url'].'" border="0" onload="imgResize(this);" onmouseover="imgMenu(this);" onclick="imgDialog(\''.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachimages'][$this->_tpl_vars['m']['key']]['url'].'\', this);"><br /><br />
		';
}
echo '
		';
if (empty($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'])) $this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'] = array();
elseif (!is_array($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'])) $this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'] = (array)$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'];
$this->_tpl_vars['n']=array();
$this->_tpl_vars['n']['columns'] = 1;
$this->_tpl_vars['n']['count'] = count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles']);
$this->_tpl_vars['n']['addrows'] = count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles']) % $this->_tpl_vars['n']['columns'] == 0 ? 0 : $this->_tpl_vars['n']['columns'] - count($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles']) % $this->_tpl_vars['n']['columns'];
$this->_tpl_vars['n']['loops'] = $this->_tpl_vars['n']['count'] + $this->_tpl_vars['n']['addrows'];
reset($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles']);
for($this->_tpl_vars['n']['index'] = 0; $this->_tpl_vars['n']['index'] < $this->_tpl_vars['n']['loops']; $this->_tpl_vars['n']['index']++){
	$this->_tpl_vars['n']['order'] = $this->_tpl_vars['n']['index'] + 1;
	$this->_tpl_vars['n']['row'] = ceil($this->_tpl_vars['n']['order'] / $this->_tpl_vars['n']['columns']);
	$this->_tpl_vars['n']['column'] = $this->_tpl_vars['n']['order'] % $this->_tpl_vars['n']['columns'];
	if($this->_tpl_vars['n']['column'] == 0) $this->_tpl_vars['n']['column'] = $this->_tpl_vars['n']['columns'];
	if($this->_tpl_vars['n']['index'] < $this->_tpl_vars['n']['count']){
		list($this->_tpl_vars['n']['key'], $this->_tpl_vars['n']['value']) = each($this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles']);
		$this->_tpl_vars['n']['append'] = 0;
	}else{
		$this->_tpl_vars['n']['key'] = '';
		$this->_tpl_vars['n']['value'] = '';
		$this->_tpl_vars['n']['append'] = 1;
	}
	echo '
		<img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/attach.gif" border="0" /><strong>附件:</strong><a href="'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'][$this->_tpl_vars['n']['key']]['url'].'">'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'][$this->_tpl_vars['n']['key']]['name'].'</a>('.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['attachfiles'][$this->_tpl_vars['n']['key']]['size_k'].'K)<br /><br />
		';
}
echo '
		<div class="c_content">'.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['posttext'].'</div>
		</td>
    </tr>
    <tr>
        <td valign="middle">'.date('Y-m-d H:i:s',$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['posttime']).'</td>
        <td valign="middle">
            <table class="hide" width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>&nbsp;</td>
                    <td align="right"><a href="javascript:if(confirm(\'确实要删除该帖子么？\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/delpost.php?fid='.$this->_tpl_vars['forumid'].'&tid='.$this->_tpl_vars['topicid'].'&pid='.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['postid'].'\';"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/icon_delete.gif" border="0" alt="删除帖子"></a> <a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/postedit.php?fid='.$this->_tpl_vars['forumid'].'&tid='.$this->_tpl_vars['topicid'].'&pid='.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['postid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/icon_edit.gif" border="0" alt="编辑帖子"></a> <a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'&tid='.$this->_tpl_vars['topicid'].'&pid='.$this->_tpl_vars['postrows'][$this->_tpl_vars['i']['key']]['postid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/icon_quote.gif" border="0" alt="引用回复"></a></td>
                </tr>
            </table></td>
    </tr>
</table>
';
}
echo '

<div style="width:100%;padding-top:3px;padding-bottom:3px;">
<div class="fl"><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/newpost.gif" border="0" alt="发表新主题"></a>
';
if($this->_tpl_vars['islock'] == 0){
echo '&nbsp;&nbsp;<a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'&tid='.$this->_tpl_vars['topicid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/reply.gif" border="0" alt="回复主题"></a>';
}
echo '</div>
<div class="fr">'.$this->_tpl_vars['url_jumppage'].'</div>
<div class="cb"></div>
</div>

<form name="frmpost" id="frmpost" action="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?do=submit" method="post" onsubmit="javascript:if(window.document.frmpost.posttext.value == \'\'){alert(\'请输入回复内容！\');window.document.frmpost.posttext.focus();return false;}">
<table class="grid" width="100%" align="center">
    <caption>快速回复</caption>
    <tr>
      <td width="10%">标题：</td>
      <td width="90%"><input type="text" class="text" name="topictitle" id="topictitle" size="60" maxlength="60" value=""></td>
    </tr>
    <tr>
      <td>内容：</td>
      <td><textarea name="posttext" cols="60" rows="8" id="posttext" class="textarea" onkeydown="javascript:if((event.ctrlKey && event.keyCode == 13)||(event.altKey && event.keyCode == 83)) window.document.frmpost.submit();"></textarea>
	  <script type="text/javascript">loadJs("'.$this->_tpl_vars['jieqi_url'].'/scripts/ubbeditor_'.$this->_tpl_vars['jieqi_charset'].'.js", function(){UBBEditor.Create("posttext");});</script>
		<input type="hidden" name="fid" id="fid" value="'.$this->_tpl_vars['forumid'].'">
		<input type="hidden" name="tid" id="tid" value="'.$this->_tpl_vars['topicid'].'">
		<input type="hidden" name="action" id="action" value="newpost"></td>
    </tr>
';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
	<tr>
      <td>验证码：</td>
      <td><input type="text" class="text" size="8" maxlength="8" name="checkcode" onfocus="if($_(\'p_imgccode\').style.display == \'none\'){$_(\'p_imgccode\').src = \''.$this->_tpl_vars['jieqi_url'].'/checkcode.php\';$_(\'p_imgccode\').style.display = \'\';}" title="点击显示验证码"><img id="p_imgccode" src="" style="cursor:pointer;vertical-align:middle;margin-left:3px;display:none;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" title="点击刷新验证码"></td>
    </tr>
';
}
echo '
    <tr>
      <td colspan="2"><span class="hottext">（按 Ctrl＋Enter 直接提交）</span><input type="submit" class="button" name="btnpost" id="btnpost" value=" 发 表 "></td>
    </tr>
</table>
</form>
';
if($this->_tpl_vars['ismaster'] > 0){
echo '
<form name="frmmove" id="frmmove" action="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?do=submit" method="post">
<table class="grid" width="100%">
  <tr>
    <th align="center">
	[<a id="set_top" href="javascript:;" onclick="set_top();"></a>]
	[<a id="set_good" href="javascript:;" onclick="set_good();"></a>]
	[<a id="set_lock" href="javascript:;" onclick="set_lock();"></a>]
	[<a id="set_push" href="javascript:;" onclick="set_push();">提前</a>]
	';
if(count($this->_tpl_vars['forumrows']) > 0){
echo '
	<br />帖子转移到 <select class="select"  size="1" name="tofid" id="tofid">
	';
if (empty($this->_tpl_vars['forumrows'])) $this->_tpl_vars['forumrows'] = array();
elseif (!is_array($this->_tpl_vars['forumrows'])) $this->_tpl_vars['forumrows'] = (array)$this->_tpl_vars['forumrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['forumrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['forumrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['forumrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['forumrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['forumrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
	<option value="'.$this->_tpl_vars['forumrows'][$this->_tpl_vars['i']['key']]['forumid'].'">'.$this->_tpl_vars['forumrows'][$this->_tpl_vars['i']['key']]['forumname'].'</option>
	';
}
echo '
	</select>
	<input type="button" class="button" name="btn_move"  id="btn_move" value="确定" onclick="set_move();" />
	<input type="hidden" name="action" id="action" value="move" />
	<input type="hidden" name="tid" id="tid" value="'.$this->_tpl_vars['topicid'].'" />
	<input type="hidden" name="fromfid" id="fromfid" value="'.$this->_tpl_vars['forumid'].'" />
	';
}
echo '
	<script type="text/javascript">
	//初始化变量
	var istop = '.$this->_tpl_vars['istop'].';
	var isgood = '.$this->_tpl_vars['isgood'].';
	var islock = '.$this->_tpl_vars['islock'].';
	
	var toptext = (istop > 0) ? \'解除置顶\' : \'置顶\';
	$_(\'set_top\').setValue(toptext);
	var goodtext = (isgood > 0) ? \'解除加精\' : \'加精\';
	$_(\'set_good\').setValue(goodtext);
	var locktext = (islock > 0) ? \'解除锁定\' : \'锁定\';
	$_(\'set_lock\').setValue(locktext);
	
	//置顶处理函数
	function set_top_loading(){
		$_(\'set_top\').setValue(\'处理中..\');
	}
	function set_top_complate(){
		if(this.response == \'1\'){
			if(istop > 0){
				istop = 0;
				toptext = \'置顶\';
			}else{
				istop = 1;
				toptext = \'解除置顶\';
			}
			$_(\'set_top\').setValue(toptext);
		}else{
			alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));
			$_(\'set_top\').setValue(toptext);
		}
	}
	function set_top(){
		var url = (istop > 0) ? \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=untop\' : \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=top\';
		Ajax.Request(url, {onLoading:set_top_loading, onComplete:set_top_complate});
	}
	
	//加精处理函数
	function set_good_loading(){
		$_(\'set_good\').setValue(\'处理中..\');
	}
	function set_good_complate(){
		if(this.response == \'1\'){
			if(isgood > 0){
				isgood = 0;
				goodtext = \'加精\';
			}else{
				isgood = 1;
				goodtext = \'解除加精\';
			}
			$_(\'set_good\').setValue(goodtext);
		}else{
			alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));
			$_(\'set_good\').setValue(goodtext);
		}
	}
	function set_good(){
		var url = (isgood > 0) ? \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=nogood\' : \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=good\';
		Ajax.Request(url, {onLoading:set_good_loading, onComplete:set_good_complate});
	}
	
	//处理锁定函数
	function set_lock_loading(){
		$_(\'set_lock\').setValue(\'处理中..\');
	}
	function set_lock_complate(){
		if(this.response == \'1\'){
			if(islock > 0){
				islock = 0;
				locktext = \'锁定\';
			}else{
				islock = 1;
				locktext = \'解除锁定\';
			}
			$_(\'set_lock\').setValue(locktext);
		}else{
			alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));
			$_(\'set_lock\').setValue(locktext);
		}
	}
	function set_lock(){
		var url = (islock > 0) ? \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=unlock\' : \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=lock\';
		Ajax.Request(url, {onLoading:set_lock_loading, onComplete:set_lock_complate});
	}
	
	//提前处理函数
	function set_push_loading(){
		$_(\'set_push\').setValue(\'处理中..\');
	}
	function set_push_complate(){
		if(this.response == \'1\'){
			$_(\'set_push\').setValue(\'已提前\');
		}else{
			alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));
			$_(\'set_push\').setValue(\'提前\');
		}
	}
	function set_push(){
		var url = \''.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/topicset.php?tid='.$this->_tpl_vars['topicid'].'&action=push\';
		Ajax.Request(url, {onLoading:set_push_loading, onComplete:set_push_complate});
	}
	//移动处理函数
	function set_move_loading(){
		$_(\'btn_move\').setValue(\'处理中..\');
	}
	function set_move_complate(){
		if(this.response == \'1\'){
			$_(\'btn_move\').setValue(\'移动成功\');
		}else{
			alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));
			$_(\'btn_move\').setValue(\'确定\');
		}
	}
	function set_move(){
		//alert(\'bb\');
		Ajax.Request(\'frmmove\',{onLoading:set_move_loading, onComplete:set_move_complate})
	}
	</script>
	</th>
  </tr>
</table>
</form>
';
}

?>