<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<div class="wrap clearfix">
'.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
<div class="auzuojia col10">
<table class="grid" width="100%" align="center">
<caption>��'.$this->_tpl_vars['obookname'].'���½�����ͳ��</caption>
  <tr>
    <td colspan="6" class="title">���½�����'.$this->_tpl_vars['ochaptersum']['count'].'���½ڵ����ܶ'.$this->_tpl_vars['ochaptersum']['saleprice'].'���ϼ���������'.$this->_tpl_vars['ochaptersum']['allsale'].'���ϼ����۶'.$this->_tpl_vars['ochaptersum']['sumemoney'].'</td>
  </tr>
  <tr align="center">
    <th width="30%">�½�����</th>
    <th width="10%">����</th>
    <th width="10%">������</th>
    <th width="25%">�����۶�</th>
    <th width="15%">״̬</th>
    <th width="10%">��ϸ��¼</th>
  </tr>
';
if (empty($this->_tpl_vars['ochapterrows'])) $this->_tpl_vars['ochapterrows'] = array();
elseif (!is_array($this->_tpl_vars['ochapterrows'])) $this->_tpl_vars['ochapterrows'] = (array)$this->_tpl_vars['ochapterrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['ochapterrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['ochapterrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['ochapterrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['ochapterrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['ochapterrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td><a href="'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['url_chapter'].'" target="_blank">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['chaptername'].'</a></td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['saleprice'].'</td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['allsale'].'</td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'</td>
    <td align="center">'.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['display'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['obook_dynamic_url'].'/chapterbuylog.php?cid='.$this->_tpl_vars['ochapterrows'][$this->_tpl_vars['i']['key']]['ochapterid'].'&oid='.$this->_tpl_vars['obookid'].'">��ϸ��¼</a></td>
  </tr>
';
}
echo '
</table>
'.$this->_tpl_vars['url_jumppage'].'
</div></div>
';
?>