<?php
echo '

'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'用户设置', 'module'=>'system', 'filename'=>'block_userset_tab', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'', 'vars'=>'', 'template'=>'', 'contenttype'=>'4', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'
<table class="grid" width="100%" align="center">
<caption>用户资料</caption>
  <tr align="left">
    <td width="20%"  class="tdl">用户ID：</td>
    <td width="40%" class="tdr">'.$this->_tpl_vars['uid'].'</td>
    <td width="40%" rowspan="9" class="tdr" align="center">
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
    <td class="tdl">Email：</td>
    <td class="tdr"><a href="mailto:'.$this->_tpl_vars['email'].'">'.$this->_tpl_vars['email'].'</a> </td>
  </tr>
  <tr align="left">
    <td class="tdl">QQ：</td>
    <td class="tdr">'.$this->_tpl_vars['qq'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">网站：</td>
    <td class="tdr"><a href="'.$this->_tpl_vars['url'].'" target="_blank">'.$this->_tpl_vars['url'].'</a></td>
  </tr>
  <tr>
    <td colspan="3" class="foot">积分相关</td>
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
  <tr align="left">
    <td class="tdl">月票数：</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['setting']['gift']['vipvote']).'</td>
  </tr>  <tr align="left">
    <td class="tdl">最多好友数：</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['system']['maxfriends']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">信箱最多消息数：</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['system']['maxmessages']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">书架最大收藏量：</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['article']['maxbookmarks']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">每天允许推荐次数：</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['article']['dayvotes']).'</td>
  </tr>
  <tr align="left">
    <td class="tdl">每天允许评分次数：</td>
    <td colspan="2" class="tdr">'.intval($this->_tpl_vars['right']['article']['dayrates']).'</td>
  </tr>
  <tr>
    <td colspan="3" class="foot">VIP信息</td>
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
    <td class="tdl">包月到期：</td>
    <td colspan="2" class="tdr">';
if($this->_tpl_vars['overtime'] > 0){
echo date('Y-m-d',$this->_tpl_vars['overtime']);
}else{
echo '尚未包月';
}
echo ' &nbsp; &nbsp; 【<a id="a_monthly" href="javascript:;" onclick="openDialog(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthly.php?id='.$this->_tpl_vars['uid'].'&ajax_gets=jieqi_contents\', false);">购买包月</a>】</td>
  </tr>  <tr align="left">
    <td class="tdl">'.$this->_tpl_vars['egoldname'].'：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['egold'].' &nbsp; [<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php">充值</a>]</td>
  </tr></td>
  </tr>
  <tr>
    <td colspan="3" class="foot">其他信息</td>
  </tr>
  <tr align="left">
    <td class="tdl">用户签名：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['sign'].'</td>
  </tr>
  <tr align="left">
    <td class="tdl">个人简介：</td>
    <td colspan="2" class="tdr">'.$this->_tpl_vars['intro'].'</td>
  </tr>
</table>';
?>