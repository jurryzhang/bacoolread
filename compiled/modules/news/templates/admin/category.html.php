<?php
echo '<br />
<form action="'.$this->_tpl_vars['form_url_action'].'" method="post" name="checkform" id="checkform">
<table class="grid" width="100%" align="center">
<caption>��Ŀ����</caption>
  <tr align="center">
	<th width="5%">ѡ��</td>
    <th width="70%">��Ŀ����</td>
    <th width="25%">����</td>
  </tr>
 ';
if (empty($this->_tpl_vars['category_list'])) $this->_tpl_vars['category_list'] = array();
elseif (!is_array($this->_tpl_vars['category_list'])) $this->_tpl_vars['category_list'] = (array)$this->_tpl_vars['category_list'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['category_list']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['category_list']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['category_list']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['category_list']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['category_list']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
 ';
if($this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['pid'] == 0){
echo '
  <tr>
    <td class="odd" align="center"> 
		<input type="hidden" name="id" value="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cid'].'" />'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['checkbox'].'
	</td>
    <td class="even" onclick="displayItems(\''.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cid'].'\');" style="cursor:pointer;"> 
		<img src="'.$this->_tpl_vars['jieqi_news_url'].'/images/explode.gif" height="11" width="11" border="0" align="absmiddle" />
		'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cname'].'[ID:'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cid'].']
	</td>
	<td class="odd" align="center">
		<a href="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['addurl'].'">���Ӷ�����Ŀ</a>|
		<a href="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['editurl'].'">�༭</a>|
		<a href="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['delurl'].'">ɾ��</a>| 
		<a href="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['taxurl'].'">����</a>
	</td>
  </tr>
 ';
}else{
echo '
  <tr name="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['pid'].'" id="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['pid'].'" style="display:none;">
    <td class="odd" align="center">
		<input type="hidden" name="id" value="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cid'].'" />'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['checkbox'].'
	</td>
    <td class="even">��
		'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cname'].'[ID:'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['cid'].']
	</td>
	<td class="odd" align="center">
		<a href="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['editurl'].'">�༭</a>|
		<a href="'.$this->_tpl_vars['category_list'][$this->_tpl_vars['i']['key']]['delurl'].'">ɾ��</a>
	</td>
  </tr>
  ';
}
echo '
  ';
}
echo '
  <tr>
    <td colspan="3" align="right" class="odd">
		<input type="button" value="���Ӷ�����Ŀ" class="button" onclick="document.location=\''.$this->_tpl_vars['category_add_root_url'].'\'" />
		<input type="button" value="������Ŀ����" class="button" onclick="document.location=\''.$this->_tpl_vars['category_tax_root_url'].'\'" />
		<input type="button" name="allcheck" value="ȫ��ѡ��" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = true; }" />
		<input type="button" name="nocheck" value="ȫ��ȡ��" class="button" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ this.form.elements[i].checked = false; }" />
		<input type="submit" name="delcheck" value="ɾ��ѡ�м�¼" class="button" onclick="javascript:if(confirm(\'ȷʵҪɾ��ѡ�е���Ŀ��\\n\\r\\n\\r�ò�����ɾ������Ŀ������������Ŀ�����������ݣ�\')){ this.form.checkaction.value=\'1\';this.form.submit();}else{return false;}" />
		<input name="checkaction" type="hidden" id="checkaction" value="0" />
	</td>
  </tr>
</table>
</form>
<script language="JavaScript">
<!--
function displayItems(elementID)	{
	var tTank = document.getElementsByName(elementID);
	for(i=0;i<tTank.length;i++){
		if (tTank[i].style.display == \'inline\') {tTank[i].style.display = \'none\';}
		else {tTank[i].style.display = \'inline\';}
	}
}
//-->
</script>';
?>