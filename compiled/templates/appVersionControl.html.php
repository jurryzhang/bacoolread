<?php
echo '<!--burn ���� 2016-12-28-->
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
                buttonText : \'ѡ��APK��\',
                buttonImage: "/uploadify/filebotton.png",
                width: "124",
                height: "33",
                fileObjName : \'apk_file\',
                fileTypeDesc : \'֧�ָ�ʽ��\',
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
                        $(\'#\' + file.id).find(\'.data\').html(\' - <font color="red">�ϴ�ʧ�ܣ�</font>\');
                        return false;
                    }

                    $(\'#\' + file.id).find(\'.data\').html(\' - <font color="green">�ϴ��ɹ���</font>\');
                }
            });
    });
</script>

<link href="/sink/css/au.css" type="text/css" rel="stylesheet" />
<form action="'.$this->_tpl_vars['jieqi_modules']['app']['url'].'/admin/appVersionControl.php" method="post"  enctype="multipart/form-data">
    <table width="100%" class="grid" cellspacing="1" align="center">
        <caption>
            APP��̨--APP�汾����
        </caption>
        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �汾�ţ�
            </td>

            <td class="tdr">
                <input type="text" name="version" value="'.$this->_tpl_vars['version'].'" />
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td class="tdl" width="25%">
                �ϴ�APK��
            </td>

            <td class="tdr">
                <input type="file" id="upload_apk" class="text" name="apk_file" accept=".apk" />
                <input type="hidden" id="apk" name="apk" value="" />
                <span class="hottext">Ӧ�ø�ʽ��.apk</span>
            </td>
        </tr>

        <tr valign="middle" align="left">
            <td  class="tdl" width="25%">
                <input type="hidden" name="action" value="edit" />
            </td>

            <td class="tdr">
                <input type="submit" class="button" name="submit"  id="submit" value="�޸�" />
            </td>
        </tr>
    </table>
</form>';
?>