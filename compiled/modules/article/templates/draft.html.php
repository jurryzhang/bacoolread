<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<form action="" method="post" name="checkform" id="checkform">
<ul class="ultab">
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draft.php"';
if($this->_tpl_vars['_request']['type'] == 0){
echo ' class="selected"';
}
echo '>ȫ���ݸ�</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draft.php?type=1"';
if($this->_tpl_vars['_request']['type'] == 1){
echo ' class="selected"';
}
echo '>˽�˲ݸ�</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draft.php?type=2"';
if($this->_tpl_vars['_request']['type'] == 2){
echo ' class="selected"';
}
echo '>��ʱ�½�</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/draft.php?type=3"';
if($this->_tpl_vars['_request']['type'] == 3){
echo ' class="selected"';
}
echo '>�����½�</a></li>
</ul>
<table class="grid" width="100%" align="center">
  <tr class="head">
    <th width="20%" class="head">С˵����</th>
    <th width="35%" class="head">�½ڱ���</th>
	<th width="13%" class="head">��ʱ����</th>
	<th width="12%" class="head">�ݸ�����</th>
    <th width="20%" class="head">����</th>
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
    <td><a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articleid'].'">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td><a href="'.$this->_tpl_vars['article_static_url'].'/draftedit.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'">'.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
	<td align="center">';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['pubdate'] > 0){
echo date('m-d H:i',$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['pubdate']);
}else{
echo '----------';
}
echo '</td>
	<td align="center">';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['isvip_n'] == 1){
echo '������';
}else{
echo '����С˵';
}
echo '</td>
    <td align="center"><a href="'.$this->_tpl_vars['article_static_url'].'/draftedit.php?id='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'].'">�༭</a> <a href="javascript:if(confirm(\'ȷʵҪɾ�����½�ô��\')) document.location=\''.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['url_delete'].'\';">ɾ��</a>';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo ' <a href="';
if($this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['isvip_n'] == 1){
echo $this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articleid'].'&draftid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'];
}else{
echo $this->_tpl_vars['article_static_url'].'/newchapter.php?aid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['articleid'].'&draftid='.$this->_tpl_vars['draftrows'][$this->_tpl_vars['i']['key']]['draftid'];
}
echo '">����</a>';
}
echo '</td>
';
}
echo '
  </tr>
</table>
</form>
'.$this->_tpl_vars['url_jumppage'].'</div></div>';
?>