<?php
echo '<!--burn 添加 2016-12-20-->
<form>
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>小说二级分类管理</caption>
        ';
if($this->_tpl_vars['id'] != 0){
echo '
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                二级分类ID：
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
                二级分类名称：
            </td>

            <td class="tdr" width="75%">
                <input type="text" class="text" name="category" size="25" maxlength="20" value="'.$this->_tpl_vars['category'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                所属一级分类：
            </td>

            <td class="tdr" width="75%">
                <select class="select" size="1" name="firstCategoryID">
                    ';
if (empty($this->_tpl_vars['firstCategory'])) $this->_tpl_vars['firstCategory'] = array();
elseif (!is_array($this->_tpl_vars['firstCategory'])) $this->_tpl_vars['firstCategory'] = (array)$this->_tpl_vars['firstCategory'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['firstCategory']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['firstCategory']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['firstCategory']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['firstCategory']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['firstCategory']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['firstCatagoryID']){
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'" selected="selected">'.$this->_tpl_vars['firstCategory'][$this->_tpl_vars['i']['key']]['caption'].'</option>
                    ';
}else{
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'">
                        '.$this->_tpl_vars['firstCategory'][$this->_tpl_vars['i']['key']]['caption'].'
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
                <input type="submit" class="button" name="submit"  id="submit" value="保存修改" />
                ';
}else{
echo '
                <input type="hidden" name="action" id="action" value="add" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="增 加" />
                ';
}
echo '

            </td>
        </tr>
    </table>
</form>';
?>