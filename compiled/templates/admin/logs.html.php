<?php
echo '<form name="frmsearch" method="post" action="'.$this->_tpl_vars['jieqi_url'].'/admin/logs.php?logtype='.$this->_tpl_vars['logtype'].'&loglevel='.$this->_tpl_vars['loglevel'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td align="right">关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="0" maxlength="50"> <input name="keytype" type="radio" class="radio" value="0" checked>
            操作人员
            <input type="radio" name="keytype" class="radio" value="1">
            操作对象 &nbsp;&nbsp;
            <input type="submit" name="btnsearch" class="button" value="搜 索">      </td>
    </tr>
</table>
</form>
<table class="grid" width="100%" align="center">
<caption><a href="logs.php">全部日志</a>';
if (empty($this->_tpl_vars['logsort'])) $this->_tpl_vars['logsort'] = array();
elseif (!is_array($this->_tpl_vars['logsort'])) $this->_tpl_vars['logsort'] = (array)$this->_tpl_vars['logsort'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['logsort']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['logsort']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['logsort']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['logsort']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['logsort']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo ' <a href="logs.php?logtype='.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['logsort'][$this->_tpl_vars['i']['key']]['caption'].'</a>';
}
echo '</caption>
  <tr align="center" valign="middle">
    <th width="16%">时间</th>
    <th width="15%">用户</th>
	<th width="14%">IP</th>
    <th width="30%">动作</th>
    <th width="25%">URL</th>
  </tr>
  ';
if (empty($this->_tpl_vars['logrows'])) $this->_tpl_vars['logrows'] = array();
elseif (!is_array($this->_tpl_vars['logrows'])) $this->_tpl_vars['logrows'] = (array)$this->_tpl_vars['logrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['logrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['logrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['logrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['logrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['logrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr valign="middle">
    <td align="center">'.date('Y-m-d H:i:s',$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['logtime']).'</td>
    <td><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['userid'],'info').'" target="_blank" title="'.$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['userip'].'">'.$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['username'].'</a></td>
	<td align="center">'.$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['userip'].'</td>
    <td><span title="'.$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['logdata'].'">'.$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['logtitle'].'</span></td>
    <td>';
if($this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['logurl'] != ''){
echo '<a href="'.$this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['logurl'].'" target="_blank">'.basename($this->_tpl_vars['logrows'][$this->_tpl_vars['i']['key']]['logurl']).'</a>';
}
echo '</td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>