<?php
echo '<br />
<table class="grid" width="600" align="center">
  <caption>
    <a href="'.$this->_tpl_vars['jieqi_url'].'/newmessage.php?receiver='.urlencode($this->_tpl_vars['name']).'&ajax_gets=jieqi_contents">发送消息</a> | <a id="addfriends" href="'.$this->_tpl_vars['jieqi_url'].'/addfriends.php?id='.$this->_tpl_vars['uid'].'">加为好友</a> | <a href="'.$this->_tpl_vars['jieqi_url'].'/ptopics.php?oid='.$this->_tpl_vars['uid'].'">会客室</a>
  </caption>
  <tr>
    <th colspan="3">基本信息</th>
  </tr>
  <tr align="left">
    <td width="100" class="tdl">用户ID：</td>
    <td width="280" class="tdr">'.$this->_tpl_vars['uid'].'</td>
    <td width="214" rowspan="7" class="tdr" align="center">
      <img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['uid'],'l',$this->_tpl_vars['avatar']).'" class="avatar" alt="头像"><br />
      ';
if($this->_tpl_vars['jieqi_modules']['badge']['publish'] > 0){
echo '
      <br />
      ';
if($this->_tpl_vars['url_group'] != ""){
echo '<img src="'.$this->_tpl_vars['url_group'].'" border="0" title="'.$this->_tpl_vars['jieqi_groupname'].'"><br />';
}
echo '
      ';
if($this->_tpl_vars['url_honor'] != ""){
echo '<img src="'.$this->_tpl_vars['url_honor'].'" border="0" title="'.$this->_tpl_vars['jieqi_honor'].'"><br />';
}
echo '
      ';
if (empty($this->_tpl_vars['badgerows'])) $this->_tpl_vars['badgerows'] = array();
elseif (!is_array($this->_tpl_vars['badgerows'])) $this->_tpl_vars['badgerows'] = (array)$this->_tpl_vars['badgerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['badgerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['badgerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['badgerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['badgerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['badgerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '<img src="'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['imageurl'].'" border="0" title="'.$this->_tpl_vars['badgerows'][$this->_tpl_vars['i']['key']]['caption'].'">';
}
echo '
      ';
}
echo '
    </td>
  </tr>
  <tr align="left">
    <td class="tdl">用户名：</td>
    <td class="tdr">'.$this->_tpl_vars['uname'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">昵称：</td>
    <td class="tdr">'.$this->_tpl_vars['name'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">等级：</td>
    <td class="tdr">'.$this->_tpl_vars['group'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">头衔：</td>
    <td class="tdr">'.$this->_tpl_vars['honor'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">性别：</td>
    <td class="tdr">'.$this->_tpl_vars['sex'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">网站/微博：</td>
    <td class="tdr"><a href="'.$this->_tpl_vars['url'].'" target="_blank">'.$this->_tpl_vars['url'].'</a></td>
  </tr>
  ';
if($this->_tpl_vars['ismaster'] == 1){
echo '
  <tr align="left">
    <td class="tdl">Email：</td>
    <td colspan="2" class="tdr"><a href="mailto:'.$this->_tpl_vars['email'].'">'.$this->_tpl_vars['email'].'</a></td>
  </tr>
  <tr align="left">
    <td class="tdl">QQ：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['qq'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">MSN：</td>
    <td colspan="2" class="tdr"><a href="mailto:'.$this->_tpl_vars['msn'].'">'.$this->_tpl_vars['msn'].'</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <th colspan="3">积分相关</th>
  </tr>
  <tr align="left">
    <td class="tdl">注册日期：</td>
    <td colspan="2" class="tdr">'.date('Y-m-d',$this->_tpl_vars['regdate']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">贡献值：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['credit'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">经验值：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['experience'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">现有积分：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['score'].'</td>
  </tr>
  ';
if($this->_tpl_vars['ismaster'] == 1){
echo '
  <tr>
    <th colspan="3">VIP信息</th>
  </tr>
  <tr align="left">
    <td class="tdl">VIP类型：</td>
    <td colspan="2" class="tdr">';
if($this->_tpl_vars['isvip'] <= 0){
echo '非vip会员';
}else{
echo 'VIP会员';
}
echo '</td>
  </tr>
  <tr align="left">
    <td class="tdl">'.$this->_tpl_vars['egoldname'].'</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['egold'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">最后登录：</td>
    <td colspan="2" class="tdr">';
if($this->_tpl_vars['lastlogin'] != 0){
echo date('Y-m-d H:i',$this->_tpl_vars['lastlogin']);
}else{
echo date('Y-m-d',$this->_tpl_vars['regdate']);
}
echo ' (IP：';
if($this->_tpl_vars['setting']['lastip'] != ''){
echo $this->_tpl_vars['setting']['lastip'];
}else{
echo $this->_tpl_vars['setting']['regip'];
}
echo ')</td>
  </tr>
  ';
}
echo '
  <tr>
    <th colspan="3">其他信息</th>
  </tr>
  <tr align="left">
    <td class="tdl">用户签名：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['sign'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">个人简介：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['intro'].'</td>
  </tr>
</table>
<br />
';
?>