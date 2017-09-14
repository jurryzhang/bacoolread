<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<ul class="ultab">
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=1">申请VIP</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=3">申请签约</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=2">申请包月</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=6">申请VIP免费阅读</a></li> 
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=4">申请精品</a></li>
<li><a href="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?id=5">申请封面推荐</a></li>
</ul>
<table class="grid" width="100%" align="center"><tr align="center" class="head">	
<th width="20%" class="head">申请书名</th>
    <th width="35%" class="head">申请时间</th>
	<th width="13%" class="head">申请状态</th>
<th width="13%" class="head">申请类型</th>
	<th width="50%" class="head">管理员回复</th>  </tr>
  ';
if (empty($this->_tpl_vars['monthlyrows'])) $this->_tpl_vars['monthlyrows'] = array();
elseif (!is_array($this->_tpl_vars['monthlyrows'])) $this->_tpl_vars['monthlyrows'] = (array)$this->_tpl_vars['monthlyrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['monthlyrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['monthlyrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['monthlyrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['monthlyrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['monthlyrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr valign="middle">	
  <td><a href="/modules/article/articleinfo.php?id='.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['bookid'].'" target="_blank">'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['bookname'].'</a></td>
	<td>'.date('Y-m-d',$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['date']).'</td>
    <td>';
if($this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['typeid'] == 0){
echo '处理中';
}elseif($this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['typeid'] == 1){
echo '已失败';
}elseif($this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['typeid'] == 2){
echo '通过';
}
echo '</td>
<td>'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['types'].'</td>
    <td>'.$this->_tpl_vars['monthlyrows'][$this->_tpl_vars['i']['key']]['texts'].'</td>
  </tr>
  ';
}
echo '
 	</table>
<form name="frmnewarticle" id="frmnewarticle" action="'.$this->_tpl_vars['jieqi_url'].'/modules/article/monthlybuy.php?do=submit" method="post" onsubmit="return frmnewdraft_validate();">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>申请'.$this->_tpl_vars['mouthlybuyname'].'</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">申请说明：</td>
  <td class="tdr">'.$this->_tpl_vars['gfuname'].'</td>
</tr>


<tr valign="middle" align="left">
  <td class="tdl">小说名称：</td>
  <td class="tdr">

		<div id="selarticle" style="display:block;">
';
if($this->_tpl_vars['tid'] == 3){
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--请选择--</option>

		';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign'] == 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>';
}
echo '
		';
}
echo '

		</select>
';
}elseif($this->_tpl_vars['tid'] == 1){
echo '
        <select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--请选择--</option>

		';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip'] == 0 && $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['issign'] > 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>';
}
echo '
		';
}
echo '

		</select>
';
}else{
echo '
		<select class=\'select\'  size=\'1\' name=\'articleid\' id=\'articleid\'>
		<option value=\'0\'>--请选择--</option>
               	';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip'] > 0){
echo '
		<option value=\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'\'>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</option>';
}
echo '
		';
}
}
echo '
		</div>

  </td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">联系方式：</td>
  <td class="tdr"><input type="text" class="text" name="pc" id="pc" size="30" maxlength="30" value="" /> <span class="hottext"></span>*输入你的手机号码或者是固定电话</td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl">类型：</td>
  <td class="tdr"> 
  <input type="radio" class="radio" name="type" id="type" value="'.$this->_tpl_vars['tid'].'" checked="checked" />申请'.$this->_tpl_vars['mouthlybuyname'].'
</td>
</tr><tr valign="middle" align="left">
  <td class="tdl">作者留言：</td>
  <td class="tdr"><textarea class="textarea" name="text" id="text" rows="6" cols="60"></textarea>*输入你想对编辑说的话，作品申请的理由等。</td>
</tr>
<tr valign="middle" align="left">
  <td width="20%">
  &nbsp;
  <input type="hidden" name="action" id="action" value="post" />
  </td>
  <td>
  <input type="submit" class="button" name="submit"  id="submit" value="提 交" />
  </td>
</tr>
</table>
</form>
</div>
</div>';
?>