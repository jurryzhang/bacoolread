<?php
echo '<!--burn 添加 2016-12-27-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editHotCommend.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>APP后台--热推书专区设置</caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                名称：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="title" size="25" maxlength="20" value="'.$this->_tpl_vars['hotcommend']['title'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                显示顺序：
            </td>

            <td class="tdr">
                <select class="select" size="1" name="showid">
                    ';
if (empty($this->_tpl_vars['showOrder'])) $this->_tpl_vars['showOrder'] = array();
elseif (!is_array($this->_tpl_vars['showOrder'])) $this->_tpl_vars['showOrder'] = (array)$this->_tpl_vars['showOrder'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['showOrder']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['showOrder']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['showOrder']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['showOrder']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['showOrder']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['hotcommend']['showID']){
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'" selected="selected">'.$this->_tpl_vars['showOrder'][$this->_tpl_vars['i']['key']].'</option>
                    ';
}else{
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'">
                        '.$this->_tpl_vars['showOrder'][$this->_tpl_vars['i']['key']].'
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
            <td class="tdl" width="25%">
                所属频道：
            </td>

            <td class="tdr">
                <select class="select" size="1" name="channelid">
                    ';
if (empty($this->_tpl_vars['channelList'])) $this->_tpl_vars['channelList'] = array();
elseif (!is_array($this->_tpl_vars['channelList'])) $this->_tpl_vars['channelList'] = (array)$this->_tpl_vars['channelList'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['channelList']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['channelList']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['channelList']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['channelList']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['channelList']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['hotcommend']['channel']){
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'" selected="selected">'.$this->_tpl_vars['channelList'][$this->_tpl_vars['i']['key']].'</option>
                    ';
}else{
echo '
                    <option value="'.$this->_tpl_vars['i']['key'].'">
                        '.$this->_tpl_vars['channelList'][$this->_tpl_vars['i']['key']].'
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
            <td class="tdl" width="25%">
                booksID：
            </td>

            <td class="tdr">
                <input type="text" class="text" name="booksID" value="'.$this->_tpl_vars['hotcommend']['booksID'].'" />
                <span class="hottext">多本书用"|"隔开</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id"     value="'.$this->_tpl_vars['hotcommend']['id'].'" />
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