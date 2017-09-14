<?php
echo '<!--burn 添加 2017-01-11-->
<form>
    <table class="grid" width="100%" align="center">
        <caption>APP后台--常见列表
            <a  href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editQuestionAndAnswer.php?id=-1&action=show">
                + 增加常见问题
            </a>
        </caption>

        <tr align="center" class="head">
            <td width="15%" valign="middle">顺序</td>
            <td width="15%" valign="middle">问题</td>
            <td width="15%" valign="middle">答案</td>
            <td width="18%" valign="middle">时间</td>
            <td width="13%" valign="middle">操作</td>
        </tr>

        ';
if (empty($this->_tpl_vars['questionAndAnswerList'])) $this->_tpl_vars['questionAndAnswerList'] = array();
elseif (!is_array($this->_tpl_vars['questionAndAnswerList'])) $this->_tpl_vars['questionAndAnswerList'] = (array)$this->_tpl_vars['questionAndAnswerList'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['questionAndAnswerList']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['questionAndAnswerList']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['questionAndAnswerList']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['questionAndAnswerList']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['questionAndAnswerList']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                '.$this->_tpl_vars['questionAndAnswerList'][$this->_tpl_vars['i']['key']]['showid'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['questionAndAnswerList'][$this->_tpl_vars['i']['key']]['question'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['questionAndAnswerList'][$this->_tpl_vars['i']['key']]['answer'].'
            </td>

            <td align="center">
                '.$this->_tpl_vars['questionAndAnswerList'][$this->_tpl_vars['i']['key']]['time'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editQuestionAndAnswer.php?id='.$this->_tpl_vars['questionAndAnswerList'][$this->_tpl_vars['i']['key']]['id'].'&action=show">修改
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editQuestionAndAnswer.php?id='.$this->_tpl_vars['questionAndAnswerList'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">删除
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