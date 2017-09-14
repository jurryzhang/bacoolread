<?php
echo '<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
<div class="auzuojia col10">
<br /><br />
<form name="frmbuychapter" method="post" action="'.$this->_tpl_vars['url_buychapter'].'">
 <table class="grid" width="60%" align="center">
    <caption>购买VIP章节</caption>
	<tr>
	  <td width="100" align="right">章节名称：</td>
	  <td width="300">《'.$this->_tpl_vars['obookname'].' - '.$this->_tpl_vars['chaptername'].'》</td>
    </tr>
	<tr>
	  <td align="right">价&nbsp;&nbsp;&nbsp; 格：</td>
	  <td>'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</td>
    </tr>
	<tr>
	  <td align="right">购买用户：</td>
	  <td>'.$this->_tpl_vars['username'].'</td>
    </tr>
	<tr>
	  <td align="right">现有余额：</td>
	  <td>'.$this->_tpl_vars['useremoney'].$this->_tpl_vars['egoldname'].'</td>
    </tr>

	 <!--burn修改，2017-01-04-->
	 <!--<tr>-->
	  <!--<td align="right">现有抵用卷：</td>-->
          <!--<td>'.$this->_tpl_vars['juan'].$this->_tpl_vars['juanname'].'</td>-->
    <!--</tr>-->
  <tr>
    <td width="29%" align="right" valign="middle">支付选项：</td>
    <td width="71%">
	';
if (empty($this->_tpl_vars['getepe']['items'])) $this->_tpl_vars['getepe']['items'] = array();
elseif (!is_array($this->_tpl_vars['getepe']['items'])) $this->_tpl_vars['getepe']['items'] = (array)$this->_tpl_vars['getepe']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['getepe']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['getepe']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['getepe']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['getepe']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['getepe']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
		';
if($this->_tpl_vars['getepe']['items'][$this->_tpl_vars['i']['key']] != '赠卷'){
echo '
		<input type="radio" class="radio" name="buytype" id="buytype" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['getepe']['default']){
echo ' checked="checked"';
}
echo '/>'.$this->_tpl_vars['getepe']['items'][$this->_tpl_vars['i']['key']].'<br />

		';
}
echo '
	';
}
echo '
	</td>
  </tr>
	<tr>
	  <td align="right">订阅选项：</td>
	  <td><input type="checkbox" name="autobuy" value="1"> <span title="选择自动订阅，则本书所有VIP章节在点击阅读时自动购买，不需要每次购买后再阅读。">自动订阅本书其它VIP章节</span></td>
    </tr>
	<tr align="center">
	  <td colspan="2"><input type="hidden" name="action" value="buy">
      <input type="hidden" name="cid" value="'.$this->_tpl_vars['cid'].'">      <input type="submit" class="button" value="确定购买并阅读" name="submit"></td>
    </tr>
	<tr align="center">
	  <td colspan="2" class="foot">
	  <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'index').'">返回目录</a> | <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'">返回书页</a> | <a href="'.$this->_tpl_vars['url_obookinfo'].'">VIP信息</a> | <a href="'.$this->_tpl_vars['url_buyegold'].'">帐户充值</a>
	  </td> 
    </tr>
  </table>
</form><br /><br />
</div>
</div>';
?>