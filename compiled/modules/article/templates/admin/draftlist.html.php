<?php
echo '
<script type="text/javascript">
//ɾ��
function act_delete(url){
	var o = getTarget();
	var param = {
		method: \'POST\', 
		onReturn: function(){
			$_(o.parentNode.parentNode).remove();
		}
	}
	if(confirm(\'ȷʵҪɾ���ü�¼ô��\')) Ajax.Tip(url, param);
	return false;
}
</script>
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php">
<table class="grid" width="100%" align="center">
    <tr>
        <td>�ؼ��֣�
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50" value="'.$this->_tpl_vars['_request']['keyword'].'"> <input name="keytype" type="radio" class="radio" value="0"';
if($this->_tpl_vars['_request']['keytype'] == 0){
echo ' checked="checked"';
}
echo '>С˵����
            <input type="radio" name="keytype" class="radio" value="1"';
if($this->_tpl_vars['_request']['keytype'] == 1){
echo ' checked="checked"';
}
echo '>������ 
            <input type="submit" name="btnsearch" class="button" value="�� ��">
			<input name="type" type="hidden" value="'.$this->_tpl_vars['_request']['type'].'">

            &nbsp;&nbsp;&nbsp;&nbsp;[<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php">��ʾȫ��</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?type=1">��ͨ�ݸ�</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?type=2">��ʱ�½�</a> | <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?type=3">�����½�</a>]  
        </td>
    </tr>
</table>
</form>
<br />

<form action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
  <caption>';
if($this->_tpl_vars['_request']['type'] == 1){
echo '��ͨ�ݸ��б�';
}elseif($this->_tpl_vars['_request']['type'] == 2){
echo '��ʱ�½��б�';
}elseif($this->_tpl_vars['_request']['type'] == 3){
echo '�����½��б�';
}else{
echo 'ȫ���ݸ��б�';
}
echo '</caption>
</table>
<table class="grid" width="100%" align="center">
  <tr align="center" valign="middle">
    <th width="4%">&nbsp;</th>
    <th width="14%" class="head">С˵����</th>
    <th width="18%" class="head">�½ڱ���</th>
	<th width="12%" class="head">����</th>
	<th width="6%" class="head">����</th>
	<th width="16%" class="head">״̬</th>
	<th width="15%" class="head">������</th>
    <th width="15%" class="head">����</th>
  </tr>
';
if (empty($this->_tpl_vars['draftrows'])) $this->_tpl_vars['draftrows'] = array();
elseif (!is_array($this->_tpl_vars['draftrows'])) $this->_tpl_vars['draftrows'] = (array)$this->_tpl_vars['draftrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['draftrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['draftrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['draftrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['draftrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['draftrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr valign="middle">
    <td align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'"></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td><a href="'.$this->_tpl_vars['article_static_url'].'/admin/draftshow.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
	<td align="center">'.date('Y-m-d H:i',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
	<td align="center">';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['isvip_n'] == 1){
echo '<span class="hot">VIP</span>';
}else{
echo '���';
}
echo '</td>
	<td align="center">';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['ispub_n'] == 1){
echo '��ʱ��'.date('Y-m-d H:i',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['pubdate']);
}else{
echo '�ݸ�';
}
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo '(����)';
}
echo '</td>
	<td align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['posterid'],'info').'" target="_blank">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['poster'].'</a> [<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/newmessage.php?receiver='.urlencode($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['poster']).'&title=" target="_blank">����Ϣ</a>]</td>
    <td align="center">
	<a href="'.$this->_tpl_vars['article_static_url'].'/admin/draftshow.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" target="_blank">�鿴</a> 
	<a id="act_delete_'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" href="javascript:;" onclick="act_delete(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?checkid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'&type='.$this->_tpl_vars['_request']['type'].'&act=delete'.$this->_tpl_vars['jieqi_token_url'].'\');">ɾ��</a>
	';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo ' <a id="act_audit_'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'" href="javascript:;" onclick="Ajax.Tip(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/draftlist.php?checkid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'&type='.$this->_tpl_vars['_request']['type'].'&act=audit'.$this->_tpl_vars['jieqi_token_url'].'\', {method: \'POST\'});">���</a>';
}
echo '</td>
';
}
echo '
  </tr>
  <tr>
    <td align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
    <td colspan="7" align="left">
	<input name="act" type="hidden" value="">'.$this->_tpl_vars['jieqi_token_input'].'
	<input name="keyword" type="hidden" value="'.$this->_tpl_vars['_request']['keyword'].'">
	<input name="keytype" type="hidden" value="'.$this->_tpl_vars['_request']['keytype'].'">
	<input name="type" type="hidden" value="'.$this->_tpl_vars['_request']['type'].'">
	<input type="button" name="batchdelete" value="����ɾ��" class="button" onclick="if(confirm(\'ȷʵҪɾ��ѡ�м�¼ô��\')){this.form.act.value=\'delete\'; this.form.submit();}">
	';
if($this->_tpl_vars['_request']['type'] == 3){
echo '<input type="button" name="batchaudit" value="�������" class="button" onclick="this.form.act.value=\'audit\'; this.form.submit();">';
}
echo '
	</td>
  </tr>
</table>
</form>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>
';
?>