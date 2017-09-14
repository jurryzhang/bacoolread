<?php
echo '<!--burn 添加 2016-12-28-->
<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://www.mianfeidushu.com/scripts/theme.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.mianfeidushu.com/uploadify/uploadify.css">
<script type="text/javascript" src="http://www.mianfeidushu.com/uploadify/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://www.mianfeidushu.com/uploadify/jquery.uploadify.min.js"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function()
    {
        $("#upload_apk").uploadify(
            {
                swf : \'/uploadify/uploadify.swf\',
                uploader : \'/modules/app/admin/APPUpload.php\',
                buttonText : \'选择APK包\',
                buttonImage: "/uploadify/filebotton.png",
                width: "124",
                height: "33",
                fileObjName : \'apk_file\',
                fileTypeDesc : \'支持格式：\',
                fileTypeExts : \'*.apk\',
                fileSizeLimit : \'100MB\',
                queueSizeLimit : 1,
                multi : false,
                removeCompleted : false,
                onSelect : function(file)
                {
                    $("#apk").val("");
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
                    $("#apk").val(data);
                    $(\'#\' + file.id).find(\'.cancel\').hide();
                    $(\'#\' + file.id).find(\'.uploadify-progress\').hide();

                    if (data == "")
                    {
                        $(\'#\' + file.id).find(\'.data\').html(\' - <font color="red">上传失败！</font>\');
                        return false;
                    }

                    $(\'#\' + file.id).find(\'.data\').html(\' - <font color="green">上传成功！</font>\');
                }
            });
    });
</script>

<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/appVersionControl.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>
            APP后台--APP版本设置
        </caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                版本号：
            </td>

            <td class="tdr">
                <input type="text" name="version" value="'.$this->_tpl_vars['version'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                上传APK：
            </td>

            <td class="tdr">
                <input type="file" id="upload_apk" class="text" name="apk_file" accept=".apk" />
                <input type="hidden" id="apk" name="apk" value="" />
                <span class="hottext">应用格式：.apk</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                <input type="hidden" name="action" value="edit" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="修改" />
            </td>
        </tr>
    </table>
</form>';
?>