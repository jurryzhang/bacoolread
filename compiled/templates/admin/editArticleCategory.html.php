<?php
echo '<!--burn ��� 2016-12-20-->
<form>
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>С˵һ���������</caption>
        ';
if($this->_tpl_vars['id'] != 0){
echo '
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                һ������ID��
            </td>

            <td class="tdr" width="75%">
                '.$this->_tpl_vars['id'].'
            </td>
        </tr>
        ';
}
echo '

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                һ���������ƣ�
            </td>

            <td class="tdr" width="75%">
                <input type="text" class="text" name="category" size="25" maxlength="20" value="'.$this->_tpl_vars['category'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ����Ƶ����
            </td>

            <td class="tdr" width="75%">
                <select class="select" size="1" name="rgroupid" id="rgroupid">
                    ';
if (empty($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = array();
elseif (!is_array($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = (array)$this->_tpl_vars['rgroup']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgroup']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgroup']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgroup']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['rgroupid']){
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'" selected="selected">'.$this->_tpl_vars['rgroup']['items'][$this->_tpl_vars['i']['key']].'</option>
                    ';
}else{
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'">
                        '.$this->_tpl_vars['rgroup']['items'][$this->_tpl_vars['i']['key']].'
                    </option>
                    ';
}
echo '
                    ';
}
echo '
                </select>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl">
                ';
if($this->_tpl_vars['id'] != 0){
echo '
                <input type="hidden" name="action"  value="edit" />
                <input type="hidden" name="id"  value="'.$this->_tpl_vars['id'].'" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="�����޸�" />
                ';
}else{
echo '
                <input type="hidden" name="action" id="action" value="add" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="�� ��" />
                ';
}
echo '

            </td>
        </tr>
    </table>
</form>';
?>