<?php
echo '<!--burn 添加 2016-12-26-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>
            APP后台--反馈列表
        </caption>

        <tr align="center" class="head">
            <td width="15%" valign="middle">用户</td>
            <td width="60%" valign="middle">内容</td>
            <td width="15%" valign="middle">提交时间</td>
            <td width="13%" valign="middle">操作</td>
        </tr>

        ';
if (empty($this->_tpl_vars['feedbackList'])) $this->_tpl_vars['feedbackList'] = array();
elseif (!is_array($this->_tpl_vars['feedbackList'])) $this->_tpl_vars['feedbackList'] = (array)$this->_tpl_vars['feedbackList'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['feedbackList']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['feedbackList']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['feedbackList']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['feedbackList']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['feedbackList']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['feedbackList'][$this->_tpl_vars['i']['key']]['username'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['feedbackList'][$this->_tpl_vars['i']['key']]['content'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['feedbackList'][$this->_tpl_vars['i']['key']]['time'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/feedbackList.php?id='.$this->_tpl_vars['feedbackList'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">删除
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