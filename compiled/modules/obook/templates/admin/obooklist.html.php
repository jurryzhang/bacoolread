<?php
echo '
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_obook'].'">
<table class="grid" width="100%" align="center">
    <tr>
        <td>�ؼ��֣�
            <input name="keyword" type="text" id="keyword" class="text" size="15" maxlength="50"> 
            <input name="keytype" type="radio" class="radio" value="0" checked="checked">����
            <input type="radio" name="keytype" class="radio" value="1">���� 
			&nbsp;&nbsp;
            <input type="submit" name="btnsearch" class="button" value="�� ��">
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/obooklist.php">ȫ��������</a> | <a href="'.$this->_tpl_vars['obook_dynamic_url'].'/admin/obooklist.php?display=self">��վ������</a>        
        </td>
    </tr>
</table>
</form>
<table class="grid" width="100%" align="center">
    <caption>'.$this->_tpl_vars['obooktitle'].'</caption>
    <tr align="center">
        <th width="25%">
            ����������
        </th>

        <th width="20%">
            ����

        </th>

        <th width="10%">
            ����
        </th>

        <th width="10%">
            ����
        </th>

        <th width="10%">
            �߸�
        </th>

        <th width="10%">
            ������
        </th>

        <th width="25%">
            ����
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
                ����
            </a> |

            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articleedit.php?id='.$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank">
                �༭
            </a>
            |
            <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['obookrows'][$this->_tpl_vars['i']['key']]['articleid'],'index').'" target="_blank">
                Ŀ¼
            </a>
        </td>
    </tr>
';
}
echo '
</table>
<div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>