<?php
echo '<table class="grid" width="100%" align="center">
    <caption>����˵��</caption>
    <tr>
        <td>
		<ul>
		<li>�ɼ���վ�б�������ļ�Ϊ��configs/article/collectsite.php</li>
		<li>ĳ����վ�Ĳɼ����������ļ�Ϊ��configs/article/site_��վӢ�ı�ʶ.php</li>
		<li>��վӢ�ı�ʶ�������ظ�</li>
		</ul>
		</td>
    </tr>
</table>

<br />
<div class="gridtop">�ɼ��������� | <a href="'.$this->_tpl_vars['article_static_url'].'/admin/collectnew.php">����µĲɼ�����</a></div>
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="40%">��վ����</th>
    <th width="20%">��վӢ�ı�ʶ</th>
    <th width="20%">��ƪ�ɼ�����</th>
    <th width="20%">�����ɼ�����</th>
  </tr>
  ';
if (empty($this->_tpl_vars['siterows'])) $this->_tpl_vars['siterows'] = array();
elseif (!is_array($this->_tpl_vars['siterows'])) $this->_tpl_vars['siterows'] = (array)$this->_tpl_vars['siterows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['siterows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['siterows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['siterows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['siterows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['siterows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
  <tr>
    <td align="center"><a href="'.$this->_tpl_vars['siterows'][$this->_tpl_vars['i']['key']]['url'].'" target="_blank">'.$this->_tpl_vars['siterows'][$this->_tpl_vars['i']['key']]['name'].'</a></td>
    <td align="center">'.$this->_tpl_vars['siterows'][$this->_tpl_vars['i']['key']]['config'].'</td>
    <td align="center"><a href="'.$this->_tpl_vars['article_static_url'].'/admin/collectedit.php?config='.$this->_tpl_vars['siterows'][$this->_tpl_vars['i']['key']]['config'].'">�༭</a> | <a href="javascript:if(confirm(\'ȷʵҪɾ���òɼ�����ô��\')) document.location=\''.$this->_tpl_vars['article_static_url'].'/admin/collectset.php?action=del&config='.$this->_tpl_vars['siterows'][$this->_tpl_vars['i']['key']]['config'].'\'">ɾ��</a></td>
    <td align="center"><a href="'.$this->_tpl_vars['article_static_url'].'/admin/collectpage.php?config='.$this->_tpl_vars['siterows'][$this->_tpl_vars['i']['key']]['config'].'">�������</a></td>
  </tr>
  ';
}
echo '
  <tr>
    <td colspan="4" align="right"><a href="'.$this->_tpl_vars['article_static_url'].'/admin/collectnew.php">����µĲɼ�����</a>&nbsp;</td>
  </tr>
</table>';
?>