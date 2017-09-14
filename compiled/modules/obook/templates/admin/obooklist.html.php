<?php
echo '
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_obook'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td>关键字：
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> 
            <input name="keytype" type="radio" class="radio" value="0" checked="checked">书名
            <input type="radio" name="keytype" class="radio" value="1">作者 
			&nbsp;&nbsp;
            <input type="submit" name="btnsearch" class="button" value="搜 索">
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/obooklist.php">全部电子书</a> | <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/obooklist.php?display=self">本站电子书</a>        
        </td>
    </tr>
</table>
</form>
<table class="grid" width="100%" align="center">
    <caption>'.$this->_tpl_vars['obooktitle'].'</caption>
    <tr align="center">
        <th width="25%">
            电子书名称
        </th>

        <th width="20%">
            作者

        </th>

        <th width="10%">
            订阅
        </th>

        <th width="10%">
            打赏
        </th>

        <th width="10%">
            催更
        </th>

        <th width="10%">
            总收入
        </th>

        <th width="25%">
            操作
        </th>
    </tr>
    ';
if (empty($this->_tpl_vars['obookrows'])) $this->_tpl_vars['obookrows'] = array();
elseif (!is_array($this->_tpl_vars['obookrows'])) $this->_tpl_vars['obookrows'] = (array)$this->_tpl_vars['obookrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['obookrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['obookrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['obookrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['obookrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['obookrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
    <tr>
        <td>
            <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">
                '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['obookname'].'
            </a>
        </td>
        <td>
            ';
if($this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['authorid'] == 0){
echo '
                '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['author'].'
            ';
}else{
echo '
                <a href="'.jieqi_geturl('system','user',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['authorid']).'" target="_blank">
                    '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['author'].'
                </a>
            ';
}
echo '
        </td>

        <td align="center">
            '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['allsale'].'
        </td>

        <td align="center">
            '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumtip'].'
        </td>

        <td align="center">
            '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumhurry'].'
        </td>

        <td align="center">
            '.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['sumemoney'].'
        </td>

        <td align="center">
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlemanage.php?id='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank">
                管理
            </a> |

            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleedit.php?id='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank">
                编辑
            </a>
            |
            <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'],'index').'" target="_blank">
                目录
            </a>
        </td>
    </tr>
';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>