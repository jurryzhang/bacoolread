<?php
echo '<form name="frmsearch" method="get" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/actlog.php">
<table class="grid" width="100%" align="center">
    <tr>
        <td>
		<span class="hottext fr">总记录：'.$this->_tpl_vars['actlogstat']['cot'].'， 总金额：'.$this->_tpl_vars['actlogstat']['sumactnum'].'</span>
		用户名： <input name="uname" type="text" class="text" size="15" value="'.$this->_tpl_vars['_request']['uname'].'">
		小说名： <input name="aname" type="text" class="text" size="15" value="'.$this->_tpl_vars['_request']['aname'].'">
		动作日期：<input name="datestart" type="text" class="text" size="10" maxlength="10" value="'.$this->_tpl_vars['_request']['datestart'].'">-<input name="dateend" type="text" class="text" size="10" maxlength="10" value="'.$this->_tpl_vars['_request']['dateend'].'">
        <input type="submit" name="btnsearch" class="button" value="搜 索">
        <input type="hidden" name="act" value="tip">
		日期格式：2012-05-06
        </td>
    </tr>
</table>
</form>
<table width="100%" cellpadding="0" cellspacing="1" class="grid">
  <caption>打赏记录</caption>
  <tr align="center">
    <td width="20%" class="head">用户名</td> 
    <td width="30%" class="head">小说名称</td> 
    <td width="20%" class="head">动作时间</td>
    <td width="15%" class="head">动作名称</td>
    <td width="15%" class="head">数量</td>
  </tr>
';
if (empty($this->_tpl_vars['actlogrows'])) $this->_tpl_vars['actlogrows'] = array();
elseif (!is_array($this->_tpl_vars['actlogrows'])) $this->_tpl_vars['actlogrows'] = (array)$this->_tpl_vars['actlogrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['actlogrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['actlogrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['actlogrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['actlogrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['actlogrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
	<td align="center"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uid']).'" target="_blank">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['uname'].'</a></td>
    <td><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></td>
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['addtime']).'</td>
    <td align="center">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actname'].'</td>
    <td align="center">'.$this->_tpl_vars['actlogrows'][$this->_tpl_vars['i']['key']]['actnum'].'</td>
  </tr>
';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>

';
?>