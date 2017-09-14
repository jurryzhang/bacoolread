<?php /* Smarty version 3.1.27, created on 2016-11-25 11:33:45
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\api_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:318345837b1193ab958_28733871%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32d23dce32b525643fd4379739b75e471f97edac' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\api_edit.tpl',
      1 => 1441080930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '318345837b1193ab958_28733871',
  'variables' => 
  array (
    'data' => 0,
    'apimodel' => 0,
    'apitype' => 0,
    'query' => 0,
    'querystring' => 0,
    'queryinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837b119475c05_26124239',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837b119475c05_26124239')) {
function content_5837b119475c05_26124239 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '318345837b1193ab958_28733871';
echo $_smarty_tpl->getSubTemplate ("include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--Action boxes-->
<div class="container-fluid">
	 <a href="http://<?php echo @constant('SITEURL');?>
/<?php echo urlconfigs::URL_auto(array('m'=>"api/in",'AppID'=>$_GET['id'],'ApiID'=>$_GET['apiid']),$_smarty_tpl);?>
" target="_blank">http://<?php echo @constant('SITEURL');?>
/<?php echo urlconfigs::URL_auto(array('m'=>"api/in",'AppID'=>$_GET['id'],'ApiID'=>$_GET['apiid']),$_smarty_tpl);?>
</a>
    <hr>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>接口设置<input type="hidden" id="shareid" value="<?php echo $_GET['id'];?>
"><input type="hidden" id="apiid" value="<?php echo $_GET['apiid'];?>
"></h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">接口用途</label>
                            <div class="controls">
                                <input type="text" id="apiuse" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['apiuse'];?>
">
                                <span class="help-block blue">请描述接口大致用途</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据模型</label>
                            <div class="controls">
                                <select id="apimodel" disabled="disabled">
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['apimodel']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
                                    <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['a']['index'];?>
"<?php if ($_smarty_tpl->tpl_vars['data']->value['apimodel'] == $_smarty_tpl->getVariable('smarty')->value['section']['a']['index']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['apimodel']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['name'];?>
</option>
                                    <?php endfor; endif; ?>
                                </select>
                                <span class="help-block blue">请选择接口数据模型，该参数不可修改。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据类型</label>
                            <div class="controls">
                                <select id="apitype" disabled="disabled">
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['c'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['c']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['name'] = 'c';
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['apitype']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total']);
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['apitype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']];?>
"<?php if ($_smarty_tpl->tpl_vars['data']->value['apitype'] == $_smarty_tpl->tpl_vars['apitype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['apitype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']];?>
</option>
                                    <?php endfor; endif; ?>
                                </select>
                                <span class="help-block blue">请选择接口返回数据类型，该参数不可修改。</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>参数设置</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['query']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
                        <div class="control-group"><?php $_smarty_tpl->tpl_vars['querystring'] = new Smarty_Variable($_smarty_tpl->tpl_vars['query']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']], null, 0);?>
                            <label class="control-label"><?php echo $_smarty_tpl->tpl_vars['queryinfo']->value[$_smarty_tpl->tpl_vars['querystring']->value]['text'];?>
：<?php echo $_smarty_tpl->tpl_vars['querystring']->value;?>
</label>
                            <div class="controls">
                                <input type="text" id="<?php echo $_smarty_tpl->tpl_vars['querystring']->value;?>
" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['query'][$_smarty_tpl->tpl_vars['querystring']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['querystring']->value : $tmp);?>
" diyquery="true">
                                <span class="help-block blue">请填写渠道访问时自定义的参数名称，如果渠道没有参数个性化的需求请使用默认值，不要留空。</span>
                            </div>
                        </div>
                        <?php endfor; endif; ?>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>输出模板（<?php echo $_smarty_tpl->tpl_vars['data']->value['apitype'];?>
）</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="row-fluid nopadding nomargin ">
                    		<div class="span5"><textarea class="textarea_editor nomargin span12" rows="20" id="dome" disabled="disabled"></textarea></div>
                            <div class="span7">
                                <textarea class="textarea_editor nomargin span12" rows="20" id="template" placeholder="输出模板"><?php echo $_smarty_tpl->tpl_vars['data']->value['template'];?>
</textarea>
                            </div>
                    </div>
                    <div class="form-actions nomargin">
                            <div class="btn btn-success" onclick="Miyue.Apisave();">保存</div>
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
    $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>',
    });
    $("#dome").load("configs/dome/<?php echo $_smarty_tpl->tpl_vars['data']->value['apimodel'];?>
.html");
    $('select').select2();
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    $(".controls input").unbind("keydown").bind("keydown", function(e) {
        if (e && e.keyCode == 13) {
            e.preventDefault();
            Miyue.Apisave();
        }
    });
<?php echo '</script'; ?>
><?php }
}
?>