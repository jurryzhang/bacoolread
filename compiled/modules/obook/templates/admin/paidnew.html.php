<?php
echo '
<script language="javascript" type="text/javascript">
<!--
function frmpaidnew_validate(){
  if(document.frmpaidnew.payemoney.value == ""){
    alert("请输入结算的'.$this->_tpl_vars['egoldname'].'");
    document.frmpaidnew.payemoney.focus();
    return false;
  }
}
//-->
</script>
<br />
<form name="frmpaidnew" id="frmpaidnew" action="paidnew.php?do=submit" method="post" onsubmit="return frmpaidnew_validate();" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>
稿酬结算
</caption>
<tr valign="middle" align="left">
  <td class="odd" width="25%">电子书名</td>
  <td class="even"><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/obookinfo.php?id='.$this->_tpl_vars['obookid'].'" target="_blank">'.$this->_tpl_vars['obookname'].'</a> (作者：<a href="'.$this->_tpl_vars['jieqi_url'].'/userinfo.php?id='.$this->_tpl_vars['authorid'].'" target="_blank">'.$this->_tpl_vars['author'].'</a>)</td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">作者真实信息</td>
  <td class="even">
  真实姓名：'.$this->_tpl_vars['personsvars']['realname'].' <br />
  性别：'.$this->_tpl_vars['personsvars']['gender'].' <br />
  电话：'.$this->_tpl_vars['personsvars']['telephone'].' <br />
  手机：'.$this->_tpl_vars['personsvars']['mobilephone'].' <br />
  收款银行：'.$this->_tpl_vars['personsvars']['banktype'].'<br />
  银行地区：'.$this->_tpl_vars['personsvars']['bankname'].'<br />
  收款账号：'.$this->_tpl_vars['personsvars']['bankcard'].'<br />
  收款人：'.$this->_tpl_vars['personsvars']['bankuser'].'<br />
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">总收入 </td>
  <td class="even">'.$this->_tpl_vars['sumemoney'].' '.$this->_tpl_vars['egoldname'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">本书已结算</td>
  <td class="even">'.$this->_tpl_vars['paidemoney'].' '.$this->_tpl_vars['egoldname'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">本书待结算</td>
  <td class="even">'.$this->_tpl_vars['remainemoney'].' '.$this->_tpl_vars['egoldname'].'
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">本次结算</td>
  <td class="even">
  <input type="text" class="text" name="payemoney" id="payemoney" size="10" maxlength="10" value="" /> '.$this->_tpl_vars['egoldname'].' <span class="hottext">（必须是整数）</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">支付人民币</td>
  <td class="even">
  <input type="text" class="text" name="paymoney" id="paymoney" size="10" maxlength="10" value="" /> 元 <span class="hottext">（如 123.45）</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">结算类型</td>
  <td class="even">
  ';
if (empty($this->_tpl_vars['paidtype']['items'])) $this->_tpl_vars['paidtype']['items'] = array();
elseif (!is_array($this->_tpl_vars['paidtype']['items'])) $this->_tpl_vars['paidtype']['items'] = (array)$this->_tpl_vars['paidtype']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['paidtype']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['paidtype']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['paidtype']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['paidtype']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['paidtype']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <input type="radio" class="radio" name="paidtype" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['paidtype']['default']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['paidtype']['items'][$this->_tpl_vars['i']['key']].' 
  ';
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">
  &nbsp;
  <input type="hidden" name="action" id="action" value="post" />
  <input type="hidden" name="oid" id="oid" value="'.$this->_tpl_vars['obookid'].'" />
  </td>
  <td class="even"><input type="submit" class="button" name="submit"  id="submit" value="提 交" /></td>
</tr>
</table>
</form>';
?>