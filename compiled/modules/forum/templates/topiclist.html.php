<?php
echo '
<div style="width:100%;padding-top:3px;padding-bottom:3px;">
<div class="fl"><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/index.php">论坛首页</a> &gt; <a href="'.jieqi_geturl('forum','topiclist','1',$this->_tpl_vars['forumid']).'">'.$this->_tpl_vars['forumname'].'</a></div>
<div class="fr">版主：';
if (empty($this->_tpl_vars['masters'])) $this->_tpl_vars['masters'] = array();
elseif (!is_array($this->_tpl_vars['masters'])) $this->_tpl_vars['masters'] = (array)$this->_tpl_vars['masters'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['masters']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['masters']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['masters']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['masters']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['masters']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['masters'][$this->_tpl_vars['i']['key']]['uid']).'">'.$this->_tpl_vars['masters'][$this->_tpl_vars['i']['key']]['uname'].'</a> ';
}
echo '</div>
<div class="cb"></div>
</div>

<div style="width:100%;padding-top:3px;padding-bottom:3px;">
<div class="fl"><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/newpost.gif" border="0" alt="发表新主题"></a></div>
<div class="fr">'.$this->_tpl_vars['url_jumppage'].'</div>
<div class="cb"></div>
</div>
<table class="grid" width="100%" align="center">
  <tr height="26" align="center">
    <th colspan="3" class="title">主题</th>
    <th width="12%" class="title">发表人</th>
    <th width="13%" class="title">回复/查看</th>
    <th width="25%" class="title">最后发表</th>
  </tr>
  ';
if($this->_tpl_vars['page']==1){
echo '
  ';
if (empty($this->_tpl_vars['forumtops'])) $this->_tpl_vars['forumtops'] = array();
elseif (!is_array($this->_tpl_vars['forumtops'])) $this->_tpl_vars['forumtops'] = (array)$this->_tpl_vars['forumtops'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['forumtops']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['forumtops']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['forumtops']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['forumtops']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['forumtops']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr height="26">
    <td width="3%" align="center" valign="middle"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/topic_top.gif" border="0"></td>
    <td width="3%" align="center"  valign="middle"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/icon_topics.gif" border="0"></td>
    <td width="44%" valign="middle"><a href="'.jieqi_geturl('forum','showtopic',$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['topicid'],'1','1').'"><span class="hottext">'.$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['title'].'</span></a>&nbsp;</td>
    <td align="center" valign="middle"><a href="'.jieqi_geturl('system','user',$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['posterid']).'" target="_blank">'.$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['poster'].'</a></td>
    <td align="center" valign="middle">'.$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['replies'].'/'.$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['views'].'</td>
    <td valign="middle">'.date('m-d H:i',$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['topictime']).' <a href="'.jieqi_geturl('system','user',$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['replierid']).'" target="_blank">'.$this->_tpl_vars['forumtops'][$this->_tpl_vars['i']['key']]['replier'].'</a> 发表</td>
  </tr>
  ';
}
echo '
  ';
}
echo '
  ';
if (empty($this->_tpl_vars['topicrows'])) $this->_tpl_vars['topicrows'] = array();
elseif (!is_array($this->_tpl_vars['topicrows'])) $this->_tpl_vars['topicrows'] = (array)$this->_tpl_vars['topicrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['topicrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['topicrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['topicrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['topicrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['topicrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr height="26">
    <td width="3%" align="center" valign="middle">
	';
if($this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['istop'] > 0){
echo '
	<img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/topic_top.gif" border="0">
	';
}elseif($this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['islock'] > 0){
echo '
	<img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/topic_lock.gif" border="0">
	';
}elseif($this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['isgood'] > 0){
echo '
	<img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/topic_good.gif" border="0">
	';
}else{
echo '
	<img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/topic_normal.gif" border="0">
	';
}
echo '
	</td>
    <td width="3%" align="center"  valign="middle"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/icon_topics.gif" border="0"></td>
    <td width="44%" valign="middle"><a href="'.jieqi_geturl('forum','showtopic',$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['topicid'],'1',$this->_tpl_vars['page']).'">'.$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['title'].'</a>&nbsp;</td>
    <td align="center" valign="middle">';
if($this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['posterid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['posterid']).'" target="_blank">'.$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['poster'].'</a>';
}else{
echo '<i>游客</i>';
}
echo '</td>
    <td align="center" valign="middle">'.$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replies'].'/'.$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['views'].'</td>
    <td valign="middle">
	';
if($this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replytime'] > 0){
echo '
	';
if($this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replierid'] > 0){
echo '
	'.date('m-d H:i',$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replytime']).' <a href="'.jieqi_geturl('system','user',$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replierid']).'" target="_blank">'.$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replier'].'</a> 发表
	';
}else{
echo '
	'.date('m-d H:i',$this->_tpl_vars['topicrows'][$this->_tpl_vars['i']['key']]['replytime']).' <i>游客</i> 发表
	';
}
echo '
	';
}
echo '</td>
  </tr>
  ';
}
echo '
</table>
<div style="width:100%;padding-top:3px;padding-bottom:3px;">
<div class="fl"><a href="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/newpost.php?fid='.$this->_tpl_vars['forumid'].'"><img src="'.$this->_tpl_vars['jieqi_modules']['forum']['url'].'/images/newpost.gif" border="0" alt="发表新主题"></a></div>
<div class="fr">'.$this->_tpl_vars['url_jumppage'].'</div>
<div class="cb"></div>
</div>';
?>