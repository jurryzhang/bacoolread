<?php
echo '
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/theme.js"></script>
<link rel="stylesheet" type="text/css" href="'.$this->_tpl_vars['jieqi_url'].'/uploadify/uploadify.css">
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/uploadify/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/uploadify/jquery.uploadify.min.js"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function()
    {
        $("#upload_cover").uploadify(
            {
                swf : \'/uploadify/uploadify.swf\',
                uploader : \'/modules/article/upload.php\',
                formData :
                    {
                        type : \'cover\',
                        userid : \''.$this->_tpl_vars['jieqi_userid'].'\',
                        token : $("#token").val()
                    },
                buttonText : \'ѡ�����ͼƬ\',
                buttonImage: "/uploadify/filebotton.png",
                width: "124",
                height: "33",
                fileObjName : \'cover\',
                fileTypeDesc : \'֧�ָ�ʽ��\',
                fileTypeExts : \'*.jpg;*.jpge;*.gif;*.png\',
                fileSizeLimit : \'2MB\',
                queueSizeLimit : 1,
                multi : false,
                removeCompleted : false,
                onSelect : function(file)
                {
                    $("#cover").val("");
                    var queuedFile = {};

                    for (var n in this.queueData.files)
                    {
                        queuedFile = this.queueData.files[n];

                        if (queuedFile.id !== file.id)
                        {
                            $(\'#\' + queuedFile.id).remove();
                            this.cancelUpload(queuedFile.id);
                            delete this.queueData.files[n];
                        }
                    }
                },

                onUploadSuccess : function(file, data)
                {
                    $("#cover").val(data);
                    $(\'#\' + file.id).find(\'.cancel\').hide();
                    $(\'#\' + file.id).find(\'.uploadify-progress\').hide();

                    if (data == "")
                    {
                        $(\'#\' + file.id).find(\'.data\').html(\' - <font color="red">�ϴ�ʧ�ܣ�</font>\');

                        return false;
                    }

                    $(\'#\' + file.id).find(\'.data\').html(\' - <font color="green">�ϴ��ɹ���</font>\');
                }
            });

        $("#upload_ebook").uploadify(
            {
                swf : \'/uploadify/uploadify.swf\',
                uploader : \'/modules/article/upload.php\',
                formData :
                    {
                        type : \'ebook\',
                        userid : \''.$this->_tpl_vars['jieqi_userid'].'\',
                        token : $("#token").val()
                    },
                buttonText : \'ѡ�������\',
                buttonImage: "/uploadify/filebotton.png",
                width: "124",
                height: "33",
                fileObjName : \'ebook\',
                fileTypeDesc : \'֧�ָ�ʽ��\',
                fileTypeExts : \'*.txt\',
                fileSizeLimit : \'20MB\',
                queueSizeLimit : 1,
                multi : false,
                removeCompleted : false,
                onSelect : function(file)
                {
                    $("#ebook").val("");
                    var queuedFile = {};

                    for (var n in this.queueData.files)
                    {
                        queuedFile = this.queueData.files[n];

                        if (queuedFile.id !== file.id)
                        {
                            $(\'#\' + queuedFile.id).remove();
                            this.cancelUpload(queuedFile.id);
                            delete this.queueData.files[n];
                        }
                    }
                },
                onUploadSuccess : function(file, data)
                {
                    $("#ebook").val(data);
                    $(\'#\' + file.id).find(\'.cancel\').hide();
                    $(\'#\' + file.id).find(\'.uploadify-progress\').hide();

                    if (data == "")
                    {
                        $(\'#\' + file.id).find(\'.data\').html(\' - <font color="red">�ϴ�ʧ�ܣ�</font>\');
                        return false;
                    }

                    $(\'#\' + file.id).find(\'.data\').html(\' - <font color="green">�ϴ��ɹ���</font>\');
                }
            });
    });

    function frmnewarticle_validate()
    {
        if(document.frmnewarticle.sortid.value == "0")
        {
            alert("���������");
            document.frmnewarticle.sortid.focus();
            return false;
        }

        if(document.frmnewarticle.articlename.value == "")
        {
            alert("��������������");
            document.frmnewarticle.articlename.focus();
            return false;
        }

        if(document.frmnewarticle.author.value == "")
        {
            alert("����������");
            document.frmnewarticle.author.focus();
            return false;
        }
        if(document.frmnewarticle.ebook.value == "")
        {
            alert("���ϴ�������");
            return false;
        }
    }

    function frmnewarticle_validate()
    {
        if(document.frmnewarticle.sortid.value == "0")
        {
            alert("���������");
            document.frmnewarticle.sortid.focus();
            return false;
        }

        if(document.frmnewarticle.articlename.value == "")
        {
            alert("������С˵����");
            document.frmnewarticle.articlename.focus();
            return false;
        }
    }

    function showsorts(obj)
    {
        var sortselect = document.getElementById(\'sortselect\');
        sortselect.innerHTML = \'\';
        typeselect.innerHTML = \'\';
        ';
if (empty($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = array();
elseif (!is_array($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = (array)$this->_tpl_vars['rgroup']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgroup']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgroup']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgroup']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
        if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') sortselect.innerHTML = \'<select class="select" size="1" onchange="showtypes(this)" name="sortid" id="sortid"><option value="0">��ѡ�����</option>';
if (empty($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = array();
elseif (!is_array($this->_tpl_vars['sortrows'])) $this->_tpl_vars['sortrows'] = (array)$this->_tpl_vars['sortrows'];
$this->_tpl_vars['j']=array();
$this->_tpl_vars['j']['columns'] = 1;
$this->_tpl_vars['j']['count'] = count($this->_tpl_vars['sortrows']);
$this->_tpl_vars['j']['addrows'] = count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['j']['columns'] == 0 ? 0 : $this->_tpl_vars['j']['columns'] - count($this->_tpl_vars['sortrows']) % $this->_tpl_vars['j']['columns'];
$this->_tpl_vars['j']['loops'] = $this->_tpl_vars['j']['count'] + $this->_tpl_vars['j']['addrows'];
reset($this->_tpl_vars['sortrows']);
for($this->_tpl_vars['j']['index'] = 0; $this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['loops']; $this->_tpl_vars['j']['index']++){
	$this->_tpl_vars['j']['order'] = $this->_tpl_vars['j']['index'] + 1;
	$this->_tpl_vars['j']['row'] = ceil($this->_tpl_vars['j']['order'] / $this->_tpl_vars['j']['columns']);
	$this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['order'] % $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['column'] == 0) $this->_tpl_vars['j']['column'] = $this->_tpl_vars['j']['columns'];
	if($this->_tpl_vars['j']['index'] < $this->_tpl_vars['j']['count']){
		list($this->_tpl_vars['j']['key'], $this->_tpl_vars['j']['value']) = each($this->_tpl_vars['sortrows']);
		$this->_tpl_vars['j']['append'] = 0;
	}else{
		$this->_tpl_vars['j']['key'] = '';
		$this->_tpl_vars['j']['value'] = '';
		$this->_tpl_vars['j']['append'] = 1;
	}
	if($this->_tpl_vars['sortrows'][$this->_tpl_vars['j']['key']]['group'] == $this->_tpl_vars['i']['key']){
echo '<option value="'.$this->_tpl_vars['j']['key'].'">'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['j']['key']]['caption'].'</option>';
}
}
echo '</select>\';
        ';
}
echo '
    }

    function showtypes(obj)
    {
        var typeselect = document.getElementById(\'typeselect\');
        typeselect.innerHTML = \'\';
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
        if(obj.options[obj.selectedIndex].value == '.$this->_tpl_vars['i']['key'].') typeselect.innerHTML = \'<select class="select" size="1" name="typeid" id="typeid">';
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
	echo '<option value="'.$this->_tpl_vars['j']['key'].'">'.$this->_tpl_vars['sortrows'][$this->_tpl_vars['i']['key']]['types'][$this->_tpl_vars['j']['key']].'</option>';
}
echo '</select>\';
        ';
}
echo '
        ';
}
echo '
    }

</script>
<div class="wrap clearfix">
  '.$this->_tpl_vars['jieqi_pageblocks']['0']['content'].'
  <div class="auzuojia col10">
    <form name="frmnewarticle" id="frmnewarticle" method="post" onsubmit="return frmnewarticle_validate();" enctype="multipart/form-data">
      <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>��������</caption>
        <tr valign="middle" align="left">
          <td class="tdl" width="25%">���</td>
          <td class="tdr" width="75%">
            <select class="select" size="1" onchange="showsorts(this)" name="rgroupid" id="rgroupid">
              <option value="0">��ѡ��Ƶ��</option>
              ';
if (empty($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = array();
elseif (!is_array($this->_tpl_vars['rgroup']['items'])) $this->_tpl_vars['rgroup']['items'] = (array)$this->_tpl_vars['rgroup']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['rgroup']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['rgroup']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['rgroup']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['rgroup']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
              <option value="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['rgroup']['items'][$this->_tpl_vars['i']['key']].' </option>
              ';
}
echo '
            </select>
            <span id="sortselect" name="sortselect"></span>
            <span id="typeselect" name="typeselect"></span>
          </td>
        </tr>

        <tr valign="middle" align="left">
          <td class="tdl">С˵���ƣ�</td>
          <td class="tdr">
            <input type="text" class="text" name="articlename" id="articlename" size="30" maxlength="50" value="" onBlur="Ajax.Update(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlecheck.php?articlename=\'+this.value, {outid:\'anamemsg\', tipid:\'anamemsg\', onLoading:\'<img border=\\\'0\\\' height=\\\'16\\\' width=\\\'16\\\' src=\\\''.$this->_tpl_vars['jieqi_url'].'/images/loading.gif\\\' /> Loading...\'});" /> <span id="anamemsg"></span>
          </td>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl">�����⣺</td>
          <td class="tdr"><input type="text" class="text" name="backupname" id="backupname" size="30" maxlength="100" value="" /> <span class="hot">һ�仰���</span></td>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl">��ǩ��</td>
          <td class="tdr">
            <div class="dropdown">
              <div><input type="text" class="text" name="keywords" id="tagwords" size="60" maxlength="100" value=""';
if($this->_tpl_vars['taglimit'] > 0){
echo ' readonly="readonly"';
}
echo ' />';
if($this->_tpl_vars['tagnum'] == 0){
echo ' <span class="hot">�����ǩ��Ӣ�Ŀո�ָ�</span>';
}
echo '</div>
              ';
if($this->_tpl_vars['tagnum'] > 0){
echo '
              <div class="dropbox" style="width:400px;">
                <ul class="ultag">
                  ';
if (empty($this->_tpl_vars['tagwords'])) $this->_tpl_vars['tagwords'] = array();
elseif (!is_array($this->_tpl_vars['tagwords'])) $this->_tpl_vars['tagwords'] = (array)$this->_tpl_vars['tagwords'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['tagwords']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['tagwords']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['tagwords']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['tagwords']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['tagwords']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                  <li onclick="selecttag(\'tagwords\', this);">'.$this->_tpl_vars['tagwords'][$this->_tpl_vars['i']['key']]['name'].'</li>
                  ';
}
echo '
                </ul>
              </div>
              ';
}
echo '
            </div>
          </td>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl">����Ա��</td>
          <td class="tdr"><input type="text" class="text" name="agent" id="agent" size="30" maxlength="30" value="" /> <span class="hot">����ָ��һ����վ�����û���Ϊ����Ա</span></td>
        </tr>

        <tr style="display: none">
          <td class="tdr">
            <input type="hidden"  name="allowtrans" id="allowtrans"  value="'.$this->_tpl_vars['allowtrans'].'" />
          </td>
        </tr>

        ';
if($this->_tpl_vars['allowtrans'] > 0){
echo '
        <tr valign="middle" align="left">
          <td class="tdl">���ߣ�</td>
          <td class="tdr"><input type="text" class="text" name="author" id="author" size="30" maxlength="30" value="" /> <span class="hot">����</span></td>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl">������Ȩ��</td>
          <td class="tdr">
            ';
if (empty($this->_tpl_vars['authorflag']['items'])) $this->_tpl_vars['authorflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['authorflag']['items'])) $this->_tpl_vars['authorflag']['items'] = (array)$this->_tpl_vars['authorflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['authorflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['authorflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['authorflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['authorflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['authorflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            <input type="radio" class="radio" name="authorflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['authorflag']['default']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['authorflag']['items'][$this->_tpl_vars['i']['key']].'
            ';
}
echo '
          </td>
        </tr>
        ';
}else{
echo '
        <tr valign="middle" align="left">
          <td class="tdl">���ߣ�</td>
          <td class="tdr">
            <input type="text" name="author" id="author"  value="'.$this->_tpl_vars['author'].'" />
            <input type="hidden" name="authorid" id="authorid"  value="'.$this->_tpl_vars['authorid'].'" />
          </td>
        </tr>
        ';
}
echo '
        <tr valign="middle" align="left">
          <td class="tdl">��Ȩ����</td>
          <td class="tdr">
            ';
if (empty($this->_tpl_vars['permission']['items'])) $this->_tpl_vars['permission']['items'] = array();
elseif (!is_array($this->_tpl_vars['permission']['items'])) $this->_tpl_vars['permission']['items'] = (array)$this->_tpl_vars['permission']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['permission']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['permission']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['permission']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['permission']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['permission']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            <input type="radio" class="radio" name="permission" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['permission']['default']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['permission']['items'][$this->_tpl_vars['i']['key']].'
            ';
}
echo '
          </td>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl">�׷�״̬��</td>
          <td class="tdr">
            ';
if (empty($this->_tpl_vars['firstflag']['items'])) $this->_tpl_vars['firstflag']['items'] = array();
elseif (!is_array($this->_tpl_vars['firstflag']['items'])) $this->_tpl_vars['firstflag']['items'] = (array)$this->_tpl_vars['firstflag']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['firstflag']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['firstflag']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['firstflag']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['firstflag']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['firstflag']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
            <input type="radio" class="radio" name="firstflag" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['firstflag']['default']){
echo 'checked="checked" ';
}
echo '/>'.$this->_tpl_vars['firstflag']['items'][$this->_tpl_vars['i']['key']].'
            ';
}
echo '
          </td>
        </tr>
        ';
if($this->_tpl_vars['ismanager'] > 0){
echo '
        ';
if(count($this->_tpl_vars['customsites']) > 0){
echo '
        <tr valign="middle" align="left">
          <td class="tdl">��Դ��վ��</td>
          <td class="tdr">
            <select class="select" size="1" name="siteid">
              <option value="0" selected="selected">��վԭ��</option>
              ';
if (empty($this->_tpl_vars['customsites'])) $this->_tpl_vars['customsites'] = array();
elseif (!is_array($this->_tpl_vars['customsites'])) $this->_tpl_vars['customsites'] = (array)$this->_tpl_vars['customsites'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['customsites']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['customsites']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['customsites']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['customsites']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['customsites']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
              <option value="'.$this->_tpl_vars['i']['key'].'">'.$this->_tpl_vars['customsites'][$this->_tpl_vars['i']['key']]['name'].'</option>
              ';
}
echo '
            </select>
          </td>
        </tr>
        ';
}
echo '
        ';
}
echo '
        <tr valign="middle" align="left">
          <td class="tdl">���ݼ�飺</td>
          <td class="tdr"><textarea class="textarea" name="intro" id="intro" rows="6" cols="60"></textarea></td>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl">���鹫�棺</td>
          <td class="tdr"><textarea class="textarea" name="notice" id="notice" rows="6" cols="60"></textarea></td>
        </tr>
        <!--<tr valign="middle" align="left">-->
        <!--<td class="tdl">����ͼƬ��</td>-->
        <!--<td class="tdr">-->
        <!--<input type="file" class="input" size="30" id="upload_cover" /><input type="hidden" name="cover" id="cover" value="" /> <a id="tip_cover" class="hottext">ͼƬ��ʽ��.jpg</a>-->
        <!--</tr>-->
        <tr valign="middle" align="left">
          <td class="tdl">�����飺</td>
          <td class="tdr">
            <input type="file" class="input" size="30" id="upload_ebook" />
            <input type="hidden" name="ebook" id="ebook" value="" />
            <a id="tip_ebook" class="hottext">�������ʽ��.txt</a>
        </tr>
        <tr valign="middle" align="left">
          <td class="tdl"><input type="hidden" name="token" id="token" value="'.$this->_tpl_vars['token'].'" />
            <input type="hidden" name="action" id="action" value="check" /></td>
          <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="�� ��" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>';
?>