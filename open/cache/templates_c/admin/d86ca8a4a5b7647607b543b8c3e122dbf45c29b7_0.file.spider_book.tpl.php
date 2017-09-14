<?php /* Smarty version 3.1.27, created on 2016-11-25 11:18:43
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\spider_book.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:24105837ad9314fb89_14579834%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd86ca8a4a5b7647607b543b8c3e122dbf45c29b7' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\spider_book.tpl',
      1 => 1460215697,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24105837ad9314fb89_14579834',
  'variables' => 
  array (
    'books' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ad93212425_82801864',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ad93212425_82801864')) {
function content_5837ad93212425_82801864 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\virtualhost\\bacoolread\\open\\include\\smarty\\plugins\\modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '24105837ad9314fb89_14579834';
echo $_smarty_tpl->getSubTemplate ("include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--Action boxes-->
<div class="container-fluid">
    <hr>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>已抓取小说管理</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="5%">选择</th>
                            <th width="10%">己方ID</th>
                            <th width="10%">对方ID</th>
                            <th width="20%">小说名称</th>
                            <th width="5%">章节</th>
                            <th width="5%">封面</th>
                            <th width="2%">己方最新章节</th>
                            <!--<th width="5%">WEB</th>-->
                            <th width="5%">APP</th>
                            <th width="15%">对方上次更新时间</th>
                            <th width="15%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['books']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['a']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['a']['total']);
?>
                            <tr class="gradeA">
                                <td style="text-align:center;"><input type="checkbox" class="bookbox" value="<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
"/></td>
                                <td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
</td>
                                <td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sourceid'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articlename'];?>
</td>
                                <td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['chapters'];?>
</td>
                                <td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['imgflag'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['lastchapter'];?>
</td>
                                <td><?php if ($_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['display'] == "0") {?>已显<?php } else { ?>已隐<?php }?></td>
                                <!--<td><?php if ($_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['isapp'] == "1") {?>已显<?php } else { ?>已隐<?php }?></td>-->
                                <td style="text-align:center;"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['lastupdate'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                <td style="text-align:center;">
                                    <!--<div class="btn btn-danger btn-mini"  onclick="SetRefresh('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
')">删除重采</div>
                                    <div class="btn btn-danger btn-mini"  onclick="SetRefreshCover('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
')">删除封面</div>
                                    <?php if ($_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['online'] == "1") {?>
                                        <div class="btn btn-danger btn-mini"  onclick="Setonline('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
',0)">不采集</div>
                                    <?php } else { ?>
                                        <div class="btn btn-primary btn-mini"  onclick="Setonline('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
',1)">采集</div>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['isapp'] == "1") {?>
                                        <div class="btn btn-danger btn-mini"  onclick="SetDisplay('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
',0)">APP隐藏</div>
                                    <?php } else { ?>
                                        <div class="btn btn-primary btn-mini"  onclick="SetDisplay('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
',1)">APP显示</div>
                                    <?php }?>-->
                                    <?php if ($_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['display'] == "0") {?>
                                    <div class="btn btn-danger btn-mini"  onclick="Setshenhe('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
',1)">WEB隐藏</div>
                                    <?php } else { ?>
                                    <div class="btn btn-primary btn-mini"  onclick="Setshenhe('<?php echo $_smarty_tpl->tpl_vars['books']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['articleid'];?>
',0)">WEB显示</div>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php endfor; endif; ?>
                        </tbody>
                    </table>
                    <div class="form-actions nomargin">
                        <div class="btn btn-primary btn-mini"  onclick="SelectAll()">全选</div>
                        <div class="btn btn-primary btn-mini"  onclick="UnSelectAll()">全不选</div>
                        <!--<div class="btn btn-danger btn-mini"  onclick="SetRefresh('')">删除重采</div>
                        <div class="btn btn-danger btn-mini"  onclick="Setonline('',0)">移除采集任务</div>
                        <div class="btn btn-danger btn-mini"  onclick="SetDisplay('',0)">APP隐藏</div>-->
                        <div class="btn btn-danger btn-mini"  onclick="Setshenhe('',1)">WEB隐藏</div>
                        <!--<div class="btn btn-primary btn-mini"  onclick="Setonline('',1)">加入采集任务</div>
                        <div class="btn btn-primary btn-mini"  onclick="SetDisplay('',1)">APP显示</div>-->
                        <div class="btn btn-primary btn-mini"  onclick="Setshenhe('',0)">WEB显示</div>
                        <!--<div class="btn btn-danger btn-mini"  onclick="SetRefreshCover('')">删除封面</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php echo '<script'; ?>
>
    var spiderid = "<?php echo (($tmp = @$_GET['id'])===null||$tmp==='' ? '' : $tmp);?>
";
    $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>',
    });
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    function SelectAll(){
        $.each($(".bookbox"),function(k,v){
            $.uniform.update($(v).attr("checked", true));
        });
    }
    function UnSelectAll(){
        $.each($(".bookbox"),function(k,v){
            $.uniform.update($(v).attr("checked", false));
        });
    }
    function GetCheckbox(){
        var temp="";
        $.each($(".bookbox"),function(k,v){
            if($(v).attr("checked")=="checked"){
                if(temp==""){
                    temp += $(v).val();
                }else{
                    temp += ","+$(v).val();
                }
            }
        });
        if(temp==""){
            Globals.TipsWarning("您尚未选择小说！");
            return false;
        }
        return temp;
    }
    function SetRefresh(bookid){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            if (confirm("确定要删除现有章节重新采集吗？请谨慎操作，重新采集后所有章节ID会变动！")) {
                Globals.Ajax(Ajax_spiderrefresh, "post", {
                    id: spiderid,
                    idstring: idstring,
                }, "json", function () {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function (result) {
                    if (result.Success) {
                        Globals.TipsSuccess(result.Msg);
                        Globals.Refresh();
                    } else {
                        Globals.TipsWarning(result.Msg);
                    }
                    Globals.Ajaxloaded();
                    return;
                });
            }
        }
    }
    function SetRefreshCover(bookid){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            if (confirm("确定要删除现有封面重新采集吗？采集之前封面将为空！")) {
                Globals.Ajax(Ajax_spiderrefreshcover, "post", {
                    id: spiderid,
                    idstring: idstring,
                }, "json", function () {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function (result) {
                    if (result.Success) {
                        Globals.TipsSuccess(result.Msg);
                        Globals.Refresh();
                    } else {
                        Globals.TipsWarning(result.Msg);
                    }
                    Globals.Ajaxloaded();
                    return;
                });
            }
        }
    }
    function Setonline(bookid,answer){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            Globals.Ajax(Ajax_spideronline, "post", {
                id: spiderid,
                idstring: idstring,
                answer : answer
            }, "json", function () {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function (result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });

        }
    }
    function SetDisplay(bookid,answer){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            Globals.Ajax(Ajax_spiderdisplay, "post", {
                id: spiderid,
                idstring: idstring,
                answer : answer
            }, "json", function () {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function (result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });

        }
    }
    function Setshenhe(bookid,answer){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            Globals.Ajax(Ajax_spidershenhe, "post", {
                id: spiderid,
                idstring: idstring,
                answer : answer
            }, "json", function () {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function (result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });

        }
    }
<?php echo '</script'; ?>
><?php }
}
?>