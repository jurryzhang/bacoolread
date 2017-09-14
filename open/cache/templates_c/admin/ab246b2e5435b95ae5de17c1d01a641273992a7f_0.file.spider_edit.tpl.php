<?php /* Smarty version 3.1.27, created on 2016-11-25 11:18:33
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\spider_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:133485837ad8964b7b5_96938526%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab246b2e5435b95ae5de17c1d01a641273992a7f' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\spider_edit.tpl',
      1 => 1461470059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133485837ad8964b7b5_96938526',
  'variables' => 
  array (
    'data' => 0,
    'api' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ad896d0fc6_45445529',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ad896d0fc6_45445529')) {
function content_5837ad896d0fc6_45445529 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\virtualhost\\bacoolread\\open\\include\\smarty\\plugins\\modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '133485837ad8964b7b5_96938526';
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
					<h5>内容源信息<input id="spiderid" value="<?php echo $_GET['id'];?>
" type="hidden"></h5>
				</div>
				<div class="widget-content nopadding">
					<div class="form-horizontal">
						<div class="control-group">
							<label class="control-label">内容源名称</label>
							<div class="controls">
								<input id="name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
">
								<span class="help-block blue">如:百度书城、掌阅等...仅做后台区分使用</span>
							</div>
						</div>
                        <div class="control-group">
                            <label class="control-label">内容源标记</label>
                            <div class="controls">
                                <input id="mark" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['mark'];?>
" disabled>
                                <span class="help-block blue">该标记一旦写入不可更改，新的标记将会被识别为新内容源</span>
                            </div>
                        </div>
						<div class="control-group">
                            <label class="control-label">合作方UID</label>
                            <div class="controls">
                                <input id="userid" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['userid'];?>
" disabled>
                                <span class="help-block blue">该UID一旦写入不可更改，合作方在本站的用户名ID</span>
                            </div>
                        </div>
					</div>
				</div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>抓取设置</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">上线控制</label>
                            <div class="controls">
                                <label><input type="radio" name="buff" id="online" />上线模式</label> <label><input
                                            type="radio" name="buff" id="debug" />调试模式</label> <span
                                        class="help-block blue">上线中的接口不允许修改，若要改动请调整接口至调试模式！</span>
										<span
                                        class="help-block blue"><font color="red">提示：新增内容源接口请填完下面接口配置并测试接口通过后才能调整为上线模式！</font></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">起始时间</label>
                            <div class="controls">
                                <input type="text" id="begintime" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['begintime'],"%Y-%m-%d");?>
"  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权起始时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">结束时间</label>
                            <div class="controls">
                                <input type="text"id="overtime" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['overtime'],"%Y-%m-%d");?>
"  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权结束时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Spidersave();">保存</div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>接口配置</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">获取小说列表</label>
                            <div class="controls">
                                <input id="uri_articlelist" type="text" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_articlelist'];?>
" class="span10">
                                <span class="help-block blue">请填写完整URL</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">获取小说详情</label>
                            <div class="controls">
                                <input id="uri_articleinfo" type="text" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_articleinfo'];?>
" class="span10">
                                <span class="help-block blue">请填写完整URL，小说ID使用{bookid}替代。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">获取小说目录</label>
                            <div class="controls">
                                <input id="uri_chapterlist" type="text" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_chapterlist'];?>
" class="span10">
                                <span class="help-block blue">请填写完整URL，小说ID使用{bookid}替代。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">获取章节内容</label>
                            <div class="controls">
                                <input id="uri_chapter" type="text" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_chapter'];?>
" class="span10">
                                <span class="help-block blue">请填写完整URL，小说ID使用{bookid}替代、章节ID使用{chapterid}替代。</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Spiderapisave();">保存</div> <div class="btn btn-info" onclick="Miyue.Loadpage('index.php/admin/spider_test/?id=<?php echo $_GET['id'];?>
')">测试接口</div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>

</div>
<?php echo '<script'; ?>
>
    $('#begintime').datepicker();
    $('#overtime').datepicker();
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$(".controls input").unbind("keydown").bind("keydown", function(e) {
		if (e && e.keyCode == 13) {
			e.preventDefault();
			Miyue.Spidersave();
		}
	});
    <?php if (in_array("online",$_smarty_tpl->tpl_vars['data']->value['status'])) {?>$.uniform.update($("#online").attr("checked", true));<?php }?>
    <?php if (in_array("debug",$_smarty_tpl->tpl_vars['data']->value['status'])) {?>$.uniform.update($("#debug").attr("checked", true));<?php }?>
<?php echo '</script'; ?>
><?php }
}
?>