<?php
echo '<!--burn 添加 2016-12-27-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>WAP精选--精选列表
            <a  href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editTbook.php?id=-1&action=show">
                + 增加精选
            </a>
        </caption>

        <tr align="center" class="head">
            <td width="5%" valign="middle">排序</td>
            <td width="8%" valign="middle">标题</td>
            <td width="18%" valign="middle">封面</td>
            <td width="23%" valign="middle">描述</td>
            <td width="15%" valign="middle">bookID</td>
            <td width="10%" valign="middle">操作</td>
        </tr>

        ';
if (empty($this->_tpl_vars['tbooklist'])) $this->_tpl_vars['tbooklist'] = array();
elseif (!is_array($this->_tpl_vars['tbooklist'])) $this->_tpl_vars['tbooklist'] = (array)$this->_tpl_vars['tbooklist'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['tbooklist']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['tbooklist']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['tbooklist']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['tbooklist']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['tbooklist']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['sort'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['title'].'
            </td>

            <td align="center">
                <img width="40%" src="'.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['cover'].'"  alt="'.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['title'].'" />
            </td>

            <td align="center">
                '.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['desc'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['bookID'].'
            </td>

            <input type="hidden" name="id" value="'.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['id'].'">

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editTbook.php?id='.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['id'].'&action=show">修改
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/admin/editTbook.php?id='.$this->_tpl_vars['tbooklist'][$this->_tpl_vars['i']['key']]['id'].'&action=delete" onclick="return confirm(\'确定要删除该精选吗\')">删除
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