<?php
echo '
<form name="frmsearch" method="get" action="'.$this->_tpl_vars['url_article'].'">
	<table class="grid" width="100%" align="center">
		<tr>
			<td>
				״̬��
				<select class="select" size="1" name="display">
					<option value="">ȫ��</option>
					<option value="ready"';
if($this->_tpl_vars['_request']['display'] == 'ready'){
echo ' selected="selected"';
}
echo '>����</option>
					<option value="show"';
if($this->_tpl_vars['_request']['display'] == 'show'){
echo ' selected="selected"';
}
echo '>����</option>
					<option value="hide"';
if($this->_tpl_vars['_request']['display'] == 'hide'){
echo ' selected="selected"';
}
echo '>����</option>
					<option value="empty"';
if($this->_tpl_vars['_request']['display'] == 'empty'){
echo ' selected="selected"';
}
echo '>���½�</option>
					<option value="agent"';
if($this->_tpl_vars['_request']['display'] == 'agent'){
echo ' selected="selected"';
}
echo '>������Ʒ</option>
                </select>

                ���ࣺ
                <select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid">
                    <option value="0">
                        ���޷���
                    </option>

                    ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                        <option value="'.$this->_tpl_vars['i']['key'].'"';
if($this->_tpl_vars['_request']['sortid'] == $this->_tpl_vars['i']['key']){
echo ' selected="selected"';
}
echo '>
                            '.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['caption'].'
                        </option>
                    ';
}
echo '
                </select>

                <span id="typeselect" name="typeselect"></span>

                <script type="text/javascript">
                    function showtypes(obj)
                    {
                        var typeselect = document.getElementById(\'typeselect\');
                        typeselect.innerHTML=\'\';

                        ';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                            ';
if($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] != ''){
echo '
                                if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') typeselect.innerHTML=\'<select class="select" size="1" name="typeid" id="typeid"><option value="0">��������</option>';
if (empty($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'])) $this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'] = (array)$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	echo '<option value="'.$this->_tpl_vars['j']['key'].'"';
if($this->_tpl_vars['_request']['typeid'] == $this->_tpl_vars['j']['key']){
echo ' selected="selected"';
}
echo '>'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']].'</option>';
}
echo '</select>\';
                            ';
}
echo '
                        ';
}
echo '
                   }

                   ';
if($this->_tpl_vars['_request']['sortid'] > 0){
echo 'showtypes(document.getElementById(\'sortid\'));';
}
echo '
                </script>

                ����
                <select class="select" size="1" name="order">
                    <option value="lastupdate"';
if($this->_tpl_vars['_request']['order'] == 'lastupdate'){
echo ' selected="selected"';
}
echo '>
                        �������
                    </option>

                    <option value="postdate"';
if($this->_tpl_vars['_request']['order'] == 'postdate'){
echo ' selected="selected"';
}
echo '>
                        ���ʱ��
                    </option>

                    <option value="toptime"';
if($this->_tpl_vars['_request']['order'] == 'toptime'){
echo ' selected="selected"';
}
echo '>
                        �༭�Ƽ�
                    </option>

                    <option value="goodnum"';
if($this->_tpl_vars['_request']['order'] == 'goodnum'){
echo ' selected="selected"';
}
echo '>
                        �ղ���
                    </option>

                    <option value="size"';
if($this->_tpl_vars['_request']['order'] == 'size'){
echo ' selected="selected"';
}
echo '>
                        С˵����
                    </option>

                    <option value="allvisit"';
if($this->_tpl_vars['_request']['order'] == 'allvisit'){
echo ' selected="selected"';
}
echo '>
                        �ܵ��
                    </option>

                    <option value="monthvisit"';
if($this->_tpl_vars['_request']['order'] == 'monthvisit'){
echo ' selected="selected"';
}
echo '>
                        �µ��
                    </option>
					
					<option value="dayvisit"';
if($this->_tpl_vars['_request']['order'] == 'dayvisit'){
echo ' selected="selected"';
}
echo '>
                        �յ��
                    </option>

                    <option value="allvote"';
if($this->_tpl_vars['_request']['order'] == 'allvote'){
echo ' selected="selected"';
}
echo '>
                        ���Ƽ�
                    </option>

                    <option value="monthvote"';
if($this->_tpl_vars['_request']['order'] == 'monthvote'){
echo ' selected="selected"';
}
echo '>
                        ���Ƽ�
                    </option>
                </select>

                <select class="select" size="1" name="asc">
                    <option value="0"';
if($this->_tpl_vars['_request']['asc'] == 0){
echo ' selected="selected"';
}
echo '>
                        ����
                    </option>

                    <option value="1"';
if($this->_tpl_vars['_request']['asc'] == 1){
echo ' selected="selected"';
}
echo '>
                        ˳��
                    </option>
                </select>

                ����������

                <input type="radio" name="keytype" class="radio" value="0"';
if($this->_tpl_vars['_request']['keytype'] == 0){
echo ' checked="checked"';
}
echo '">С˵����

                <input type="radio" name="keytype" class="radio" value="1"';
if($this->_tpl_vars['_request']['keytype'] == 1){
echo ' checked="checked"';
}
echo '>����

                <input type="radio" name="keytype" class="radio" value="2"';
if($this->_tpl_vars['_request']['keytype'] == 2){
echo ' checked="checked"';
}
echo '>������ &nbsp;&nbsp;

                <input type="submit" name="btnsearch" class="button" value="�� ��">

                <span class="hottext">���·��������ؼ��֣���Ӣ�Ŀո�ָ���</span>

                <textarea class="textarea" name="keyword" onkeyup="if(event.keyCode==13){this.form.submit()}" style="width:80%;height:3em;">'.$this->_tpl_vars['_request']['keyword'].'</textarea>
            </td>
        </tr>
    </table>
</form>

<form action="'.$this->_tpl_vars['url_batchaction'].'" method="post" name="checkform" id="checkform">
    <table class="grid" width="100%" align="center">
        <caption>С˵�б�</caption>
            <tr align="center">
                <th width="2%">&nbsp;</th>
                <th width="10%">С˵����</th>
                <th width="15%">С˵����</th>
                <th width="15%">�����½�</th>
                <th width="8%">����</th>
                <th width="7%">����</th>
                <th width="7%">�յ��</th>
                <th width="7%">�ܵ��</th>
                <th width="12%">���=&gt;����</th>
                <th width="26%">����</th>
            </tr>

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

        <tr>
            <td align="center">
                <input type="checkbox" id="checkid[]" name="checkid[]" value="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'">
            </td>

            <td>
                <a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'],'info').'" target="_blank">
                    '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articlename'].'
                </a>
                ';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '
                    <span class="hottext">
                        vip
                    </span>
                ';
}
echo '
            </td>

            <!--burn�޸ģ�2017-01-10-->
            <td align="center">
                <img src="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['cover'].'" width="40%">
            </td>

        <td>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapterid'] > 0){
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_vipchapter'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipvolume'].' '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['vipchapter'].'</a><span class="hottext">vip</span>';
}else{
echo '<a href="'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['url_lastchapter'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastvolume'].' '.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastchapter'].'</a>';
}
echo '</td>

        <td>';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'] == 0){
echo $this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'];
}else{
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/authorpage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['authorid'].'" target="_blank">'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['author'].'</a>';
}
echo '</td>

        <td>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['size_c'].'</td>
        <td>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['dayvisit'].'</td>
        <td>'.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['allvisit'].'</td>
      <td align="center">'.date('Y-m-d',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['postdate']).'=&gt;'.date('Y-m-d',$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['lastupdate']).'</td>
      <td align="center">';
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['isvip_n'] > 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=quxiao&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'"><span class="hottext">��Լ</span></a>&nbsp;';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=iisvip&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'"><span class="hottext">ǩԼ</span></a>&nbsp;<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=qianyue&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'"><span class="hottext">VIP</span></a>&nbsp;';
}
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=hide&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">����</a> <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=ready&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">����</a>';
}elseif($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 1){
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=hide&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">����</a> <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=show&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">���</a>';
}else{
echo '<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=show&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">��ʾ</a> <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=ready&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">����</a>';
}
if($this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['display_n'] == 0){
echo ' <a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=toptime&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">�Ƽ�</a>/<a href="'.$this->_tpl_vars['article_dynamic_url'].'/admin/article.php?action=untoptime&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'">����</a>';
}else{
echo ' �Ƽ�/����';
}
echo ' <a href="'.$this->_tpl_vars['article_static_url'].'/articlemanage.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'" target="_blank">����</a> <a href="'.$this->_tpl_vars['article_static_url'].'/articleedit.php?id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'" target="_blank">�༭</a> <a href="javascript:if(confirm(\'ȷʵҪɾ����С˵ô��\')) document.location=\''.$this->_tpl_vars['article_static_url'].'/admin/article.php?action=del&id='.$this->_tpl_vars['articlerows'][$this->_tpl_vars['i']['key']]['articleid'].'&display='.$this->_tpl_vars['display'].'&page='.$this->_tpl_vars['pageNum'].'\'">ɾ��</a></td>
    </tr>
    ';
}
echo '
    <tr>
      <td align="center"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != \'checkkall\') this.form.elements[i].checked = this.form.checkall.checked; }"></td>
      <td colspan="9" align="left">
      <input name="batchaction" id="batchaction" type="hidden" value="del">

      <!--burn ��� 2016-12-20-->
      <input name="page" type="hidden" value="'.$this->_tpl_vars['pageNum'].'">

      <input name="url_jump" type="hidden" value="'.$this->_tpl_vars['url_jump'].'">
      <input type="button" name="batchdel" value="����ɾ��" class="button" onclick="javascript:if(confirm(\'ȷʵҪɾ��ѡ�м�¼ô��\')){ this.form.batchaction.value=\'del\'; this.form.submit();}"> &nbsp;
      <input type="button" name="batchhide" value="��������" class="button" onclick="javascript:if(confirm(\'ȷʵҪ����ѡ�м�¼ô��\')){ this.form.batchaction.value=\'hide\'; this.form.submit();}"> &nbsp;
      <input type="button" name="batchshow" value="�������" class="button" onclick="javascript:if(confirm(\'ȷʵҪ��ѡ�м�¼���ͨ��ô��\')){ this.form.batchaction.value=\'show\'; this.form.submit();}"> &nbsp;
      <input type="button" name="batchready" value="��������" class="button" onclick="javascript:if(confirm(\'ȷʵҪ��ѡ�м�¼��Ϊ����ô��\')){ this.form.batchaction.value=\'ready\'; this.form.submit();}"> &nbsp;
      </td>
    </tr>
  </table>
  </form>
  <div class="pages">'.$this->_tpl_vars['url_jumppage'].'</div>';
?>