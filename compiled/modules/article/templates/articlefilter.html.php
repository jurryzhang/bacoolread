<?php
echo '
<link rel="stylesheet" type="text/css" href="/sink/css/shuku.css"/>

<div class="choose_area">
    <div class="select_area">
        <dl class="sort">
            <dt>
                ��ƷƵ����
            </dt>
            <dd class="tag_list">
                ';
if (empty($this->_tpl_vars['rgrouprows'])) $this->_tpl_vars['rgrouprows'] = array();
elseif (!is_array($this->_tpl_vars['rgrouprows'])) $this->_tpl_vars['rgrouprows'] = (array)$this->_tpl_vars['rgrouprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgrouprows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgrouprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgrouprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgrouprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgrouprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                ';
if($this->_tpl_vars['rgrouprows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                <a href="'.$this->_tpl_vars['rgrouprows'][$this->_tpl_vars['i']['key']]['url'].'"  class="active">'.$this->_tpl_vars['rgrouprows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}else{
echo '
                <a href="'.$this->_tpl_vars['rgrouprows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['rgrouprows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}
echo '
                ';
}
echo '
            </dd>
        </dl>
        <dl class="sort">
            <dt>
                ��Ʒ���ࣺ
            </dt>
            <dd class="tag_list" id="category_level2">
                ';
if (empty($this->_tpl_vars['sortidrows'])) $this->_tpl_vars['sortidrows'] = array();
elseif (!is_array($this->_tpl_vars['sortidrows'])) $this->_tpl_vars['sortidrows'] = (array)$this->_tpl_vars['sortidrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortidrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortidrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortidrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortidrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortidrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                ';
if($this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['group'] == $this->_tpl_vars['rgroup']){
echo '
                ';
if($this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '

                <a href="'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['url'].'"  class="active">'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}else{
echo '
                <a href="'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}
echo '
                ';
}elseif($this->_tpl_vars['rgroup'] == ''){
echo '
                ';
if($this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                <a href="'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['url'].'"  class="active">'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}else{
echo '
                <a href="'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['sortidrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}
echo '
                ';
}
echo '
                ';
}
echo '
            </dd>
            ';
if(count($this->_tpl_vars['typeidrows']) > 0){
echo '
            <dd style="" class="subclass">
                ';
if (empty($this->_tpl_vars['typeidrows'])) $this->_tpl_vars['typeidrows'] = array();
elseif (!is_array($this->_tpl_vars['typeidrows'])) $this->_tpl_vars['typeidrows'] = (array)$this->_tpl_vars['typeidrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['typeidrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['typeidrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['typeidrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['typeidrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['typeidrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                ';
if($this->_tpl_vars['typeidrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                <a href="'.$this->_tpl_vars['typeidrows'][$this->_tpl_vars['i']['key']]['url'].'"  class="active">'.$this->_tpl_vars['typeidrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}else{
echo '
                <a href="'.$this->_tpl_vars['typeidrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['typeidrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                ';
}
echo '
                ';
}
echo '
            </dd>
            ';
}
echo '
        </dl>
        <dl>

            <dl>
                <dt>
                    ��Ʒ������
                </dt>
                <dd id="words_select">
                    ';
if (empty($this->_tpl_vars['sizerows'])) $this->_tpl_vars['sizerows'] = array();
elseif (!is_array($this->_tpl_vars['sizerows'])) $this->_tpl_vars['sizerows'] = (array)$this->_tpl_vars['sizerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sizerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sizerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sizerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sizerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sizerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['url'].'" class="active">'.$this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['sizerows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}
echo '
                    ';
}
echo '
                </dd>
            </dl>
            <dl>
                <dt>
                    д�����ȣ�
                </dt>
                <dd id="books_progress">
                    ';
if (empty($this->_tpl_vars['isfullrows'])) $this->_tpl_vars['isfullrows'] = array();
elseif (!is_array($this->_tpl_vars['isfullrows'])) $this->_tpl_vars['isfullrows'] = (array)$this->_tpl_vars['isfullrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['isfullrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['isfullrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['isfullrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isfullrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['isfullrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['url'].'" class="active">'.$this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['isfullrows'][$this->_tpl_vars['i']['key']]['name'].'</a>&nbsp;
                    ';
}
echo '
                    ';
}
echo '
                </dd>
            </dl>

            <dl class="smallTag">
                <dt style="font-size: 14px;">��Ʒ��ǩ��</dt><dd class="tag_list">
                ';
if (empty($this->_tpl_vars['tagrows'])) $this->_tpl_vars['tagrows'] = array();
elseif (!is_array($this->_tpl_vars['tagrows'])) $this->_tpl_vars['tagrows'] = (array)$this->_tpl_vars['tagrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['tagrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['tagrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['tagrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['tagrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['tagrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                ';
if($this->_tpl_vars['i']['order'] == 51){
echo '
                <a href="'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                <a class="showBtn showbutton" href="javascript:" onclick="$(\'.select_area\').find(\'.smallTagall\').show();$(\'.showbutton\').hide();$(\'.hidebutton\').show();">ȫ����ʾ</a><a class="showBtn hidebutton" style="display: none" href="javascript:" onclick="$(\'.select_area\').find(\'.smallTagall\').hide();$(\'.showbutton\').show();$(\'.hidebutton\').hide();">����</a>
                <li class="smallTagall"  style="display: none">
                    ';
}elseif($this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['url'].'" class="active">'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}
echo '
                    ';
}
echo '
                </li>
            </dd></dl>

            <dl>
                <dt>
                    ����ʱ�䣺
                </dt>
                <dd id="books_uptime">
                    ';
if (empty($this->_tpl_vars['updaterows'])) $this->_tpl_vars['updaterows'] = array();
elseif (!is_array($this->_tpl_vars['updaterows'])) $this->_tpl_vars['updaterows'] = (array)$this->_tpl_vars['updaterows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['updaterows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['updaterows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['updaterows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['updaterows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['updaterows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['url'].'" class="active">'.$this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['updaterows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}
echo '
                    ';
}
echo '
                </dd>
            </dl>
            <dl>
                <dt>
                    ����ʽ��
                </dt>
                <dd id="sort_type">
                    ';
if (empty($this->_tpl_vars['orderrows'])) $this->_tpl_vars['orderrows'] = array();
elseif (!is_array($this->_tpl_vars['orderrows'])) $this->_tpl_vars['orderrows'] = (array)$this->_tpl_vars['orderrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['orderrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['orderrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['orderrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['orderrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['orderrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['url'].'" class="active">'.$this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['orderrows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}
echo '
                    ';
}
echo '
                </dd>
            </dl>
            <dl class="un_line">
                <dt>
                    �շ����ʣ�
                </dt>
                <dd id="other_option">
                    ';
if (empty($this->_tpl_vars['isviprows'])) $this->_tpl_vars['isviprows'] = array();
elseif (!is_array($this->_tpl_vars['isviprows'])) $this->_tpl_vars['isviprows'] = (array)$this->_tpl_vars['isviprows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['isviprows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['isviprows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['isviprows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['isviprows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['isviprows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['selected'] > 0){
echo '
                    <a href="'.$this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['url'].'" class="active">'.$this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}else{
echo '
                    <a href="'.$this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['url'].'">'.$this->_tpl_vars['isviprows'][$this->_tpl_vars['i']['key']]['name'].'</a>
                    ';
}
echo '
                    ';
}
echo '
                </dd>
            </dl>
    </div>
</div>


<div class="layout">
    <div id="mainstore" class="mainstore">
        <div class="sysc_tit">
            <em>
                <b class="" id="showChangeTab">
                    <a class="a_1" href="javascript:" id="detailedlyShow"></a>
                    <a class="a_2" href="javascript:" id="simplyShow"></a></b></em>
            <div class="sxts"><h3>ɸѡ���</h3></div></div>
        <!--�������-->
        <div style="display:none;" class="search_result" id="bookListBox">
            <div class="book_info_store">
                <ul id="simpleBookList" style="display: block;">
                    <li class="book_title">
                        <div class="bookdetail bg">
                            <h4>����</h4>
                            <span class="author">����</span>
                            <span class="book_sort">����</span>
                            <span class="book_click"> ���� </span></div></li>
                    ';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    <li><div class="bookdetail bg">
                        <h4><a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapterid'] > 0){
echo '<span class="icon_v"></span>';
}
echo '</h4><span class="author">

                        <!--<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>-->

                        ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'] > 0){
echo '
                        <a href="'.jieqi_geturl('system','user',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid']).'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>
                        ';
}else{
echo $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'];
}
echo '

                    </span><span class="book_sort"><a class="brown" href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortid']).'" target="_blank">['.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortname'].']</a></span><span class="book_click">'.date('Y-m-d h:i',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</span></div></li>
                    ';
}
echo '
                </ul></div>
            '.$this->_tpl_vars['url_jumppage'].'
        </div>
        <div id="detailedBookListPanel" class="tab_2">
            <div class="search_result">
                <div style="display: block;">
                    ';
if (empty($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = array();
elseif (!is_array($this->_tpl_vars['articlerows'])) $this->_tpl_vars['articlerows'] = (array)$this->_tpl_vars['articlerows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['articlerows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['articlerows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['articlerows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['articlerows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    <div class="book">
                        <a target="_blank" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">
                            <img width="90" height="128" src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_image'].'"></a>
                        <div class="book_info"><h3><em class="btn_a">
                            <a target="_blank" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'" class="active">�����Ķ�</a>
                            <a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_bookcase'].'\');">�ղر���</a></em>
                            <a id="book_716873" target="_blank" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'</a></h3>
                            <dl>
                                <dt>���ߣ�</dt>
                                <dd class="w_auth">
                                    <!--<a target="_blank" href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'].'">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>-->

                                    ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'] > 0){
echo '
                                    <a target="_blank" href="'.jieqi_geturl('system','user',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid']).'">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>
                                    ';
}else{
echo $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'];
}
echo '

                                </dd>
                                <dt>���ࣺ</dt>
                                <dd class="w_auth"><a href="'.jieqi_geturl('article','articlelist','1',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortid']).'" target="_blank">['.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['sortname'].']</a></dd><dt>״̬��</dt><dd class="w_auth">������</dd></dl><div class="clear"></div><dl><dt>���£�</dt><dd class="w_auth">'.date('Y-m-d h:i',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</dd><dt>������</dt><dd class="w_auth">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['size_c'].'</dd></dl><div class="clear"></div><dl><dt>��飺</dt><dd class="book_intro" id="introCut">'.truncate($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['intro'],'102','..').'<a id="moreIntroBtn" style="display:inline block" href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_articleinfo'].'">����</a></dd></dl></div></div>';
}
echo '

                </div>
                <div class="cls"></div>
                '.$this->_tpl_vars['url_jumppage'].'

            </div></div></div>

    <div class="layout_right" id="right_2">
        <div class="rankTitBox">
            <h3>�ʻ�<span>�ܰ�</span></h3>
        </div>
        <div class="tabWrap channelList">
            <div class="rankListWrap">
                <ul class="rankList rankHover numList">
                    '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'  </ul>

            </div></div>
        <div class="rankTitBox mt50 tabSwitch cf">
            <div class="fr">
                <span class="">����</span><span class="tabCur">����<cite></cite></span></div>
            <h3>�Ƽ�<span>�ܰ�</span></h3>
        </div>
        <div class="tabWrap channelList"><div class="tabWrap changxiaoList"><div class="rankListWrap"><ul class="rankList rankHover numList tabList" style="display: none;">'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'</ul>

            <ul class="rankList rankHover numList tabList hidden" style="display: block;">'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'</ul>
        </div>
        </div>
        </div>

        <div class="rankTitBox mt50"><h3>ǩԼ����<span>������</span></h3></div><div class="tabWrap channelList"><div class="tabWrap changxiaoList"><div class="rankListWrap"><ul class="rankList rankHover numList">'.$this->_tpl_vars['jieqi_pageblocks']['4']['content'].'</ul></div></div></div>

    </div></div>

<script type="text/javascript" src="/sink/js/search_allbooks.js"></script><script type="text/javascript">    var searchInfo = {"TagListOne":"all","TagListTwo":"all","TagListThree":"all","TagListFour":"all","TagListFive":"all","TagListSix":"all","Bookwords":"all","Updatestatus":"all","Lastupdate":"all","Sortby":2,"Isvip":"all","Website":2,"Subjectid":0,"Contentid":0},
    getBookList_ajaxUrl = "";

$(function () {
    //���ҳ
    CS.page.search.allbooks.init(searchInfo, getBookList_ajaxUrl);
});

</script>
';
?>