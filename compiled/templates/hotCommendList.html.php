<?php
echo '<!--burn 添加 2016-12-26-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>APP后台--热推书专区列表
            <a  href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php?id=-1&action=show">
                + 增加热推书专区
            </a>
        </caption>

        <tr align="center" class="head">
            <td width="15%" valign="middle">名称</td>
            <td width="15%" valign="middle">所属频道</td>
            <td width="15%" valign="middle">显示顺序</td>
            <td width="18%" valign="middle">booksID</td>
            <td width="13%" valign="middle">操作</td>
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
                精选
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['channel'] == 1){
echo '
                男频
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['channel'] == 2){
echo '
                女频
                ';
}
echo '
            </td>

            <td align="center">
                ';
if($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['showID'] == 1){
echo '
                    第一顺序区域
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['showID'] == 2){
echo '
                    第二顺序区域
                ';
}elseif($this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['showID'] == 3){
echo '
                    第三顺序区域
                ';
}
echo '
            </td>

            <td align="center">
                '.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['booksID'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php?id='.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['id'].'&action=show">修改
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php?id='.$this->_tpl_vars['hotCommendList'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">删除
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