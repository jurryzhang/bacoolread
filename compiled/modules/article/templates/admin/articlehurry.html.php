<?php
echo '
<form name="frmsearch" method="post" action="articlehurry.php?do=submit">
<table width="100%" align="center" cellpadding="0" cellspacing="1" class="grid">
    <tr>
        <td class="odd">关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> 
            <input name="keytype" type="radio" class="radio" value="0" checked>书名
            <input type="radio" name="keytype" class="radio" value="1">催更人 
			&nbsp;&nbsp;
            <input type="submit" name="btnsearch" class="button" value="搜 索">
			&nbsp; <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/articlehurry.php">显示全部</a>
        </td>
    </tr>
</table>
</form>
<br />
<table width="100%" cellpadding="0" cellspacing="1" class="grid">
  <tr align="center">
    <td colspan="7" class="title">催更记录</td>
  </tr>
  <tr align="center">
    <td width="25%" class="head">催更小说</td> 
    <td width="15%" class="head">提交时间</td>
    <td width="15%" class="head">提交人</td>
    <td width="10%" class="head">催更'.$this->_tpl_vars['egoldname'].'</td>
    <td width="10%" class="head">最少字数</td>
    <td width="15%" class="head">截止更新时间</td>
    <td width="10%" class="head">状态</td>
  </tr>
';
if (empty($this->_tpl_vars['hurryrows'])) $this->_tpl_vars['hurryrows'] = array();
elseif (!is_array($this->_tpl_vars['hurryrows'])) $this->_tpl_vars['hurryrows'] = (array)$this->_tpl_vars['hurryrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['hurryrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['hurryrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['hurryrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['hurryrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['hurryrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td class="odd"><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td class="even" align="center">'.date('m-d H:i:s',$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['addtime']).'</td>
    <td class="odd"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['uid'],'info').'" target="_blank">'.$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['uname'].'</a></td>
    <td class="odd" align="center">'.$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['payegold'].'</td>
    <td class="even" align="center">'.$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['minsize'].'</td>
    <td class="odd" align="center">'.date('m-d H:i:s',$this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['overtime']).'</td>
    <td class="even" align="center">';
if($this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['payflag'] == 1){
echo '<font color="green">已成功</font>';
}elseif($this->_tpl_vars['hurryrows'][$this->_tpl_vars['i']['key']]['payflag'] == 2){
echo '<font color="red">已失败</font>';
}else{
echo '进行中';
}
echo '</td>
  </tr>
';
}
echo '
</table>
<table width="100%"  border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td align="right">'.$this->_tpl_vars['url_jumppage'].'</td>
  </tr>
</table>';
?>