<?php
echo '<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
<div class="auzuojia col10">
<br /><br />
<form name="frmbuychapter" method="post" action="'.$this->_tpl_vars['url_buychapter'].'">
 <table class="grid" width="60%" align="center">
    <caption>����VIP�½�</caption>
	<tr>
	  <td width="100" align="right">�½����ƣ�</td>
	  <td width="300">��'.$this->_tpl_vars['obookname'].' - '.$this->_tpl_vars['chaptername'].'��</td>
    </tr>
	<tr>
	  <td align="right">��&nbsp;&nbsp;&nbsp; ��</td>
	  <td>'.$this->_tpl_vars['saleprice'].$this->_tpl_vars['egoldname'].'</td>
    </tr>
	<tr>
	  <td align="right">�����û���</td>
	  <td>'.$this->_tpl_vars['username'].'</td>
    </tr>
	<tr>
	  <td align="right">������</td>
	  <td>'.$this->_tpl_vars['useremoney'].$this->_tpl_vars['egoldname'].'</td>
    </tr>

	 <!--burn�޸ģ�2017-01-04-->
	 <!--<tr>-->
	  <!--<td align="right">���е��þ�</td>-->
          <!--<td>'.$this->_tpl_vars['juan'].$this->_tpl_vars['juanname'].'</td>-->
    <!--</tr>-->
  <tr>
    <td width="29%" align="right" valign="middle">֧��ѡ�</td>
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
if($this->_tpl_vars['getepe']['items'][$this->_tpl_vars['i']['key']] != '����'){
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
	  <td align="right">����ѡ�</td>
	  <td><input type="checkbox" name="autobuy" value="1"> <span title="ѡ���Զ����ģ���������VIP�½��ڵ���Ķ�ʱ�Զ����򣬲���Ҫÿ�ι�������Ķ���">�Զ����ı�������VIP�½�</span></td>
    </tr>
	<tr align="center">
	  <td colspan="2"><input type="hidden" name="action" value="buy">
      <input type="hidden" name="cid" value="'.$this->_tpl_vars['cid'].'">      <input type="submit" class="button" value="ȷ�������Ķ�" name="submit"></td>
    </tr>
	<tr align="center">
	  <td colspan="2" class="foot">
	  <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'index').'">����Ŀ¼</a> | <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'">������ҳ</a> | <a href="'.$this->_tpl_vars['url_obookinfo'].'">VIP��Ϣ</a> | <a href="'.$this->_tpl_vars['url_buyegold'].'">�ʻ���ֵ</a>
	  </td> 
    </tr>
  </table>
</form><br /><br />
</div>
</div>';
?>