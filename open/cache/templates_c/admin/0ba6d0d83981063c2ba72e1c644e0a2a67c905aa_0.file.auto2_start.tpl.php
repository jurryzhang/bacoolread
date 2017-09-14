<?php /* Smarty version 3.1.27, created on 2016-11-25 11:53:09
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\auto2_start.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:257385837b5a566b861_70766113%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ba6d0d83981063c2ba72e1c644e0a2a67c905aa' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\auto2_start.tpl',
      1 => 1460795804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '257385837b5a566b861_70766113',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837b5a56a88e3_57084972',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837b5a56a88e3_57084972')) {
function content_5837b5a56a88e3_57084972 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '257385837b5a566b861_70766113';
?>
        <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                        <h5><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="form-horizontal">
                            <div class="control-group" id="spider_progress">
                                <label class="control-label">自动发布进度</label>
                                <div class="controls">
                                    <div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>
                                </div>
                            </div>
                            <div class="control-group" id="status">
                                <label class="control-label">当前动作</label>
                                <div class="controls">--</div>
                            </div>
                            <div class="control-group">
                                <label class="control-label oldform">监控间隔</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="text" id="waittime" onblur="TotalCount=$('#waittime').val();" placeholder="一次完整监控距离下次监控的间隔" class="span3" value="30">
                                        <span class="add-on">秒</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <style>
            .oldform{
                padding-top: 15px !important;
            }
        </style>
        <?php echo '<script'; ?>
>
            var Autolist = '<?php echo urlconfigs::URL_auto(array('m'=>"auto2/Autolist"),$_smarty_tpl);?>
';
            var Autochapter = '<?php echo urlconfigs::URL_auto(array('m'=>"auto2/Autochapter"),$_smarty_tpl);?>
';
            var __List=[];
            var AutoOrder=0;
            var InterValObj;
            var curCount=0;
            var TotalCount=$("#waittime").val();
            GetAutolist();
            function GetAutolist(){
                Globals.Ajax(Autolist, "get","", "json", function () {
                   $("#status .controls").html("正在获取可发布内容...");
                }, function (result) {
                    if(result.Success) {
                        if(result.Data.length>0) {
                            __List = result.Data;
                            InsertChapter();
                            $("#status .controls").html("获取可发布内容成功!");
                        }else{
                            $("#status .controls").html("暂无可发布内容！");
                            curCount=0;
                            InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                        }
                    }else{
                        $("#status .controls").html(result.Msg);
                        curCount=0;
                        InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                    }
                });
            }
            function InsertChapter(){
                var draftid = __List[AutoOrder].draftid;
                Globals.Ajax(Autochapter, "post",{
                    draftid:draftid,
                }, "json", function () {
                    var per = Math.ceil((AutoOrder+1)/__List.length*100);
                    $("#spider_progress .bar").animate({width:per+'%'},0);
                    $("#status .controls").html("发布《"+__List[AutoOrder].articlename+"》章节《"+__List[AutoOrder].chaptername+"》中...");
                }, function (result) {
                    if(result.Success) {
                        $("#status .controls").html("发布《"+__List[AutoOrder].articlename+"》章节《"+__List[AutoOrder].chaptername+"》成功！");
                    }else{
                        $("#status .controls").html("发布《"+__List[AutoOrder].articlename+"》章节《"+__List[AutoOrder].chaptername+"》失败！原因:"+result.Msg);
                    }
                    AutoOrder++;
                    if(AutoOrder<__List.length){
                        InsertChapter();
                    }else{
                        AutoOrder=0;
                        InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                    }
                });
            }
            function SetRemainTime() {
                if(curCount>=TotalCount){
                    window.clearInterval(InterValObj);
                    curCount=0;
                    AutoOrder=0;
                    __List=[];
                    GetAutolist();
                }else{
                    curCount++;
                    $("#status .controls").html(Math.ceil(TotalCount-curCount)+"秒后重新开始！");
                }
            }
        <?php echo '</script'; ?>
>

<?php }
}
?>