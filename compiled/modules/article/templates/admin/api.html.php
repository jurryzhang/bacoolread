<?php
echo '<!--burn ��� 2016-12-27-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>����������--�������б�
            <a  href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editapi.php?id=-1&action=show">
                + ���Ӻ�����
            </a>
        </caption>

        <tr align="center" class="head">
            <td width="5%" valign="middle">ID</td>
            <td width="8%" valign="middle">������</td>
            <td width="18%" valign="middle">����</td>
            <td width="23%" valign="middle">bookIDs</td>
            <td width="20%" valign="middle">token����</td>
            <td width="20%" valign="middle">����ʱ��</td>
            <td width="10%" valign="middle">����</td>
        </tr>

        ';
if (empty($this->_tpl_vars['apilist'])) $this->_tpl_vars['apilist'] = array();
elseif (!is_array($this->_tpl_vars['apilist'])) $this->_tpl_vars['apilist'] = (array)$this->_tpl_vars['apilist'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['apilist']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['apilist']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['apilist']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['apilist']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['apilist']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['id'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['partner'].'
            </td>

            <td align="center">
                <a width="100%" href="'.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['url'].'"  alt="'.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['title'].'" >'.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['url'].'</a>
            </td>

            <td align="center">
                '.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['bookIDs'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['token'].'
            </td>
			
			 <td align="center">
                '.date('Y-m-d H:i:s',$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['addtime']).'
            </td>


            <input type="hidden" name="id" value="'.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['id'].'">

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editapi.php?id='.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['id'].'&action=show">�޸�
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editapi.php?id='.$this->_tpl_vars['apilist'][$this->_tpl_vars['i']['key']]['id'].'&action=delete" onclick="return confirm(\'ȷ��Ҫɾ���ú�������\')">ɾ��
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