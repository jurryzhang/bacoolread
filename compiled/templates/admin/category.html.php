<?php
echo '<!--burn ��� 2016-12-19-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>С˵Ƶ��<a  href="'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleChannel.php?action=show"> + ����С˵Ƶ������ </a></caption>
        <tr align="center" class="head">
            <td width="18%" valign="middle">ID</td>
            <td width="15%" valign="middle">����</td>
            <td width="13%" valign="middle">����</td>
        </tr>
        ';
if (empty($this->_tpl_vars['articleChannel'])) $this->_tpl_vars['articleChannel'] = array();
elseif (!is_array($this->_tpl_vars['articleChannel'])) $this->_tpl_vars['articleChannel'] = (array)$this->_tpl_vars['articleChannel'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articleChannel']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articleChannel']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articleChannel']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articleChannel']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articleChannel']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['articleChannel'][$this->_tpl_vars['i']['key']]['id'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['articleChannel'][$this->_tpl_vars['i']['key']]['name'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleChannel.php?id='.$this->_tpl_vars['articleChannel'][$this->_tpl_vars['i']['key']]['id'].'&action=show">�޸�
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleChannel.php?id='.$this->_tpl_vars['articleChannel'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">ɾ��
                </a>
            </td>

        </tr>
        ';
}
echo '
    </table>
</form>

<form>
    <table class="grid" width="100%" align="center">
        <caption>С˵һ������<a href= "'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleCategory.php" > + ����С˵һ������ </a></caption>
        <tr align="center" class="head">
            <td width="18%" valign="middle">ID</td>
            <td width="15%" valign="middle">����</td>
            <td width="15%" valign="middle">����Ƶ��</td>
            <td width="13%" valign="middle">����</td>
        </tr>
        ';
if (empty($this->_tpl_vars['jieqiSort'])) $this->_tpl_vars['jieqiSort'] = array();
elseif (!is_array($this->_tpl_vars['jieqiSort'])) $this->_tpl_vars['jieqiSort'] = (array)$this->_tpl_vars['jieqiSort'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqiSort']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqiSort']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqiSort']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqiSort']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqiSort']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['id'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['caption'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['articleChannel'][$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['group']]['name'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleCategory.php?id='.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['id'].'&action=show">�޸�
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editArticleCategory.php?id='.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">ɾ��
                </a>
            </td>
        </tr>
        ';
}
echo '
    </table>
</form>

<form>
    <table class="grid" width="100%" align="center">
        <caption>С˵��������<a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editSecondaryCategory.php"> + ����С˵�������� </a></caption>
        <tr align="center" class="head">
            <td width="18%" valign="middle">ID</td>
            <td width="15%" valign="middle">����</td>
            <td width="15%" valign="middle">����һ������</td>
            <td width="13%" valign="middle">����</td>
        </tr>
        ';
if (empty($this->_tpl_vars['jieqiSort'])) $this->_tpl_vars['jieqiSort'] = array();
elseif (!is_array($this->_tpl_vars['jieqiSort'])) $this->_tpl_vars['jieqiSort'] = (array)$this->_tpl_vars['jieqiSort'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqiSort']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqiSort']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqiSort']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqiSort']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqiSort']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        ';
if (empty($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'] = array();
elseif (!is_array($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'] = (array)$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']]['id'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']]['name'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['caption'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editSecondaryCategory.php?id='.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']]['id'].'&firstCategoryID='.$this->_tpl_vars['i']['key'].'&action=show">�޸�
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_url'].'/admin/editSecondaryCategory.php?id='.$this->_tpl_vars['jieqiSort'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']]['id'].'&firstCategoryID='.$this->_tpl_vars['i']['key'].'&action=delete">ɾ��
                </a>
            </td>
        </tr>
        ';
}
echo '
        ';
}
echo '
    </table>
</form>
';
?>