<?php
echo '<form name="frmsearch" method="post" action="showpaycard.php">
<table class="grid" width="100%">
    <tr>
      <td class="odd">���ţ�
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> <input name="paytype" type="radio" class="radio" value="0" checked>
            ȫ������
            <input type="radio" name="paytype" class="radio" value="1">
            �ѳ�ֵ�� 
			<input type="radio" name="paytype" class="radio" value="2">
			δ��ֵ�� 
            <input type="submit" name="btnsearch" class="button" value="�� ��">
        &nbsp;</td>
    </tr>
</table>
</form>
<br />
<div class="gridtop">��ѯ���';
if($this->_tpl_vars['totalrows'] > 0){
echo '���� '.$this->_tpl_vars['totalrows'].' ����';
}
echo '</div>
<table class="grid" width="100%">
  <tr align="center">
    <th width="10%">���</th>
    <th width="17%">����</th>
    <th width="17%">����</th>
    <th width="10%">���</th>
    <th width="16%">��ֵ��</th>
    <th width="20%">��ֵʱ��</th>
    <th width="10%">��ֵ״̬</th>
  </tr>
  ';
if (empty($this->_tpl_vars['cardrows'])) $this->_tpl_vars['cardrows'] = array();
elseif (!is_array($this->_tpl_vars['cardrows'])) $this->_tpl_vars['cardrows'] = (array)$this->_tpl_vars['cardrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['cardrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['cardrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['cardrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['cardrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['cardrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td class="odd">'.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['order'].'</td>
    <td class="odd">'.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['cardno'].'</td>
    <td class="even">'.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['cardpass'].'</td>
    <td class="odd">'.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['payemoney'].'</td>
    <td class="even">';
if($this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['payname'] != 0){
echo '��ֵ��';
}else{
echo '<a href="'.$this->_tpl_vars['jieqi_user_url'].'/userinfo.php?id='.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['payuid'].'" target="_blank">'.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['payname'];
}
echo '</a></td>
    <td class="odd" align="center">'.$this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['paytime'].'</td>
    <td class="odd" align="center">';
if($this->_tpl_vars['cardrows'][$this->_tpl_vars['i']['key']]['ispay'] == 0){
echo 'δ��ֵ';
}else{
echo '<span class="hottext">�ѳ�ֵ</span>';
}
echo '</td>
  </tr>
  ';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>