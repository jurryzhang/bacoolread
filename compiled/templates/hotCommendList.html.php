<?php
echo '<!--burn ��� 2016-12-26-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>APP��̨--������ר���б�
            <a  href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php?id=-1&action=show">
                + ����������ר��
            </a>
        </caption>

        <tr align="center" class="head">
            <td width="15%" valign="middle">����</td>
            <td width="15%" valign="middle">����Ƶ��</td>
            <td width="15%" valign="middle">��ʾ˳��</td>
            <td width="18%" valign="middle">booksID</td>
            <td width="13%" valign="middle">����</td>
        </tr>

        ';
if (empty($this->_tpl_vars['hotCommendList'])) $this->_tpl_vars['hotCommendList'] = array();
elseif (!is_array($this->_tpl_vars['hotCommendList'])) $this->_tpl_vars['hotCommendList'] = (array)$this->_tpl_vars['hotCommendList'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['hotCommendList']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['hotCommendList']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['hotCommendList']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['hotCommendList']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['hotCommendList']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['title'].'
            </td>

            <td align="center">
                ';
if($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['channel'] == 0){
echo '
                ��ѡ
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['channel'] == 1){
echo '
                ��Ƶ
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['channel'] == 2){
echo '
                ŮƵ
                ';
}
echo '
            </td>

            <td align="center">
                ';
if($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['showID'] == 1){
echo '
                    ��һ˳������
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['showID'] == 2){
echo '
                    �ڶ�˳������
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['showID'] == 3){
echo '
                    ����˳������
                ';
}
echo '
            </td>

            <td align="center">
                '.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['booksID'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php?id='.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['id'].'&action=show">�޸�
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php?id='.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">ɾ��
                </a>
            </td>

        </tr>
        ';
}
echo '
    </table>
</form>

';
?>