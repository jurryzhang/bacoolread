<?php
echo '<!--burn ��� 2016-12-28-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editSlideBanner.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>APP��̨--Ƶ���ֲ�ͼ����
            <span class="hottext">��˳����д����Ҫ���գ�</span>
        </caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ����Ƶ����
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
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['channel']){
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

        ';
if (empty($this->_tpl_vars['bannerList'])) $this->_tpl_vars['bannerList'] = array();
elseif (!is_array($this->_tpl_vars['bannerList'])) $this->_tpl_vars['bannerList'] = (array)$this->_tpl_vars['bannerList'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['bannerList']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['bannerList']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['bannerList']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['bannerList']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['bannerList']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                bookID��
            </td>

            <td class="tdr">
                <input type="text" class="text" name="booksID_'.$this->_tpl_vars['i']['key'].'"  value="'.$this->_tpl_vars['bannerList'][$this->_tpl_vars['i']['key']]['bookID'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �ϴ����棺
            </td>

            <td class="tdr">
                <input type="file" class="text" name="booksCover_'.$this->_tpl_vars['i']['key'].'" accept="image/jpeg" />
                <span class="hottext">ͼƬ��ʽ��.jpg</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                ���棺
            </td>

            <td class="tdr">
                <img width="60%" src="'.$this->_tpl_vars['bannerList'][$this->_tpl_vars['i']['key']]['bookCover'].'" />
            </td>
        </tr>

        <input type="hidden" name="oldCover_'.$this->_tpl_vars['i']['key'].'"  value="'.$this->_tpl_vars['i']['bookCover'].'" />

        ';
}
echo '

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                ';
if($this->_tpl_vars['id'] != -1){
echo '
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="id"     value="'.$this->_tpl_vars['id'].'" />
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