<?php
echo '<!--burn ��� 2016-12-28-->
<form>
    <table class="grid" width="100%" align="center">
        <caption style="height: 60px">
            APP��̨--Ƶ���ֲ�ͼ�б�
            <a  href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editSlideBanner.php?id=-1&action=show">
                + ����Ƶ���ֲ�ͼ
            </a>

            <p style="color: white" >ע�⣺�޸��ֲ�ͼʱ����Ҫ��ɾ����ǰ���ֲ�ͼ���ã��ڽ�����ӣ�����ֱ�ӽ����޸ģ�</p>

        </caption>

        <tr align="center" class="head">
            <td width="15%" valign="middle">����Ƶ��</td>
            <td width="18%" valign="middle">booksID</td>
            <td width="13%" valign="middle">����</td>
        </tr>

        ';
if (empty($this->_tpl_vars['slideBannerList'])) $this->_tpl_vars['slideBannerList'] = array();
elseif (!is_array($this->_tpl_vars['slideBannerList'])) $this->_tpl_vars['slideBannerList'] = (array)$this->_tpl_vars['slideBannerList'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['slideBannerList']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['slideBannerList']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['slideBannerList']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['slideBannerList']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['slideBannerList']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        <tr valign="middle">
            <td align="center">
                ';
if($this->_tpl_vars['slideBannerList'][$this->_tpl_vars['i']['key']]['channel'] == 0){
echo '
                ��ѡ
                ';
}elseif($this->_tpl_vars['slideBannerList'][$this->_tpl_vars['i']['key']]['channel'] == 1){
echo '
                ��Ƶ
                ';
}elseif($this->_tpl_vars['slideBannerList'][$this->_tpl_vars['i']['key']]['channel'] == 2){
echo '
                ŮƵ
                ';
}
echo '
            </td>

            <td align="center">
                '.$this->_tpl_vars['slideBannerList'][$this->_tpl_vars['i']['key']]['booksID'].'
            </td>

            <td align="center">
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editSlideBanner.php?id='.$this->_tpl_vars['slideBannerList'][$this->_tpl_vars['i']['key']]['id'].'&action=show">�޸�
                </a>
                |
                <a href="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/editSlideBanner.php?id='.$this->_tpl_vars['slideBannerList'][$this->_tpl_vars['i']['key']]['id'].'&action=delete">ɾ��
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