<?php
echo '
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td><table width="100%"  border="0" cellspacing="2" cellpadding="3">
            <tr>
                <td width="40%" align="left"><a href="'.$this->_tpl_vars['url_articleinfo'].'">��'.$this->_tpl_vars['articlename'].'��</a> �����ظ�</td>
                <td width="60%" align="right">[<a href="'.$this->_tpl_vars['article_dynamic_url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&type=all">ȫ������</a>] &nbsp;&nbsp; [<a href="'.$this->_tpl_vars['article_dynamic_url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'&type=good">��������</a>]</td>
            </tr>
        </table></td>
    </tr>
</table>
<table class="grid" width="100%" align="center">
    <tr><th><strong>���⣺'.$this->_tpl_vars['title'].'</strong></td></tr>
</table>
';
if (empty($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = array();
elseif (!is_array($this->_tpl_vars['replyrows'])) $this->_tpl_vars['replyrows'] = (array)$this->_tpl_vars['replyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['replyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['replyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['replyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['replyrows']);
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
if($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid'] > 0){
echo '
			<img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid'],'l',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['avatar']).'" class="avatar" alt="ͷ��"><br />
			<strong><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid']).'" target="_blank">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['username'].'</a></strong>';
if($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo '<span class="hottext">[VIP]</span>';
}
echo '<br />
  			';
if($this->_tpl_vars['jieqi_modules']['badge']['publish'] > 0){
echo '
  				';
if($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['groupurl'] != ""){
echo '<img src="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['groupurl'].'" border="0" title="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['groupname'].'"><br />';
}
echo '
				';
if($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['honorurl'] != ""){
echo '<img src="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['honorurl'].'" border="0" title="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['honor'].'"><br />';
}
echo '
  				';
if (empty($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'])) $this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'] = array();
elseif (!is_array($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'])) $this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'] = (array)$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
				<img src="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'][$this->_tpl_vars['j']['key']]['imageurl'].'" border="0" title="'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows'][$this->_tpl_vars['j']['key']]['caption'].'">
				';
}
echo '
				';
if(count($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['badgerows']) > 0){
echo '<br />';
}
echo '
			';
}else{
echo '
				'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['groupname'].'<br />
				'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['honor'].'<br />
  			';
}
echo '
			�������ڣ�'.date('Y-m-d',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['regdate']).'<br />
			�������飺'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['experience'].'<br />
			�������֣�'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['score'].'<br /><br />
			<a href="javascript:;" onclick="openDialog(\''.$this->_tpl_vars['jieqi_url'].'/newmessage.php?receiver='.urlencode($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['useruname']).'&ajax_gets=jieqi_contents\', false);">������Ϣ</a> | <a id="addfriends'.$this->_tpl_vars['i']['order'].'" href="javascript:;" onclick="Ajax.Tip(event, \''.$this->_tpl_vars['jieqi_url'].'/addfriends.php?id='.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid'].'\', 3000);">��Ϊ����</a><br />
			<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid']).'" target="_blank">�鿴����</a> | <a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?oid='.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['userid'].'" target="_blank">�� �� ��</a>
		';
}else{
echo '
			<strong>�ο�</strong><br /><br /><br /><br /><br />
		';
}
echo '
		</div>
		</td>
        <td width="80%" valign="top" align="right">
		<div style="width:60%;float:left;text-align:left;"><strong>'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['subject'].'</strong></div>
		<div style="width:39%;float:right;text-align:right;">'.date('Y-m-d H:i:s',$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttime']).'
		';
if($this->_tpl_vars['jieqi_userid'] == $this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posterid'] || $this->_tpl_vars['jieqi_userstatus'] == 2){
echo ' | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewedit.php?yid='.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'">�༭</a>';
}
echo '
		';
if($this->_tpl_vars['ismaster'] == 1){
echo ' | ';
if($this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['istopic'] == 1){
echo '<a href="javascript:if(confirm(\'ȷʵҪɾ��������ô��\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?action=del&aid='.$this->_tpl_vars['articleid'].'&rid='.$this->_tpl_vars['topicid'].'\';">ɾ��</a>';
}else{
echo '<a href="javascript:if(confirm(\'ȷʵҪɾ���ûظ�ô��\')) document.location=\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?action=del&aid='.$this->_tpl_vars['articleid'].'&rid='.$this->_tpl_vars['topicid'].'&did='.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'\';">ɾ��</a>';
}
}
echo '
		 | <a href="#yid'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'" name="yid'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['postid'].'">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['order'].'#</a>&nbsp;
		</div>
		<hr />
		<div style="width:100%;text-align:left;">'.$this->_tpl_vars['replyrows'][$this->_tpl_vars['i']['key']]['posttext'].'</div></td>
    </tr>
</table>
';
}
echo '

<table width="100%"  border="0" cellspacing="2" cellpadding="3">
    <tr>
        <td align="right">'.$this->_tpl_vars['url_jumppage'].'</td>
    </tr>
</table>
';
if($this->_tpl_vars['enablepost'] == 1){
echo '
<form name="frmreview" method="post" action="'.$this->_tpl_vars['article_dynamic_url'].'/reviewshow.php?rid='.$this->_tpl_vars['topicid'].'&aid='.$this->_tpl_vars['articleid'].'">
<table class="grid" width="100%" align="center">
  <caption>�ظ�����</caption>
  <tr>
    <td class="tdl" width="25%">���⣺</td>
    <td class="tdr"><input type="text" class="text" name="ptitle" id="ptitle" size="60" maxlength="60" value="" /></td>
  </tr>
  <tr>
    <td class="tdl" width="25%">���ݣ�</td>
    <td class="tdr"><textarea class="textarea" name="pcontent" id="pcontent" cols="60" rows="12"></textarea>
    <script type="text/javascript">loadJs("'.$this->_tpl_vars['jieqi_url'].'/scripts/ubbeditor_'.$this->_tpl_vars['jieqi_charset'].'.js", function(){UBBEditor.Create("pcontent");});</script>
    </td>
  </tr>
';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
<tr>
  <td class="tdl">��֤�룺</td>
  <td class="tdr"><input type="text" class="text" size="8" maxlength="8" name="checkcode" onfocus="if($_(\'p_imgccode\').style.display == \'none\'){$_(\'p_imgccode\').src = \''.$this->_tpl_vars['jieqi_url'].'/checkcode.php\';$_(\'p_imgccode\').style.display = \'\';}" title="�����ʾ��֤��"><img id="p_imgccode" src="" style="cursor:pointer;vertical-align:middle;margin-left:3px;display:none;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" title="���ˢ����֤��"></td>
</tr>
';
}
echo '
  <tr>
    <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="newpost" /></td>
    <td class="tdr"><input type="submit" name="Submit" class="button" value=" �ظ����� "></td>
  </tr>
</table>
</form>
';
}

?>