<?php /* Smarty version 3.1.27, created on 2016-11-25 11:17:41
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\share_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:81805837ad55f41079_43449476%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dd151ba4db2ef50c71b445369bcac1c232bf526' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\share_edit.tpl',
      1 => 1435686176,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81805837ad55f41079_43449476',
  'variables' => 
  array (
    'data' => 0,
    'sortlist' => 0,
    'sortid' => 0,
    'batch' => 0,
    'api' => 0,
    'modelid' => 0,
    'apimodel' => 0,
    'apitype' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ad56105fa7_20656028',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ad56105fa7_20656028')) {
function content_5837ad56105fa7_20656028 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\virtualhost\\bacoolread\\open\\include\\smarty\\plugins\\modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '81805837ad55f41079_43449476';
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
                    <h5>渠道信息<input id="shareid" value="<?php echo $_GET['id'];?>
" type="hidden"></h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">渠道名称</label>
                            <div class="controls">
                                <input id="name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
"> <span
                                        class="help-block blue">如:百度书城、掌阅等...仅做后台区分使用</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">鉴权方式</label>
                            <div class="controls">
                                <label><input type="checkbox" id="token" />密钥授权</label> <label><input
                                            type="checkbox" id="passip" />IP地址授权</label> <span
                                        class="help-block blue">至少选择一种鉴权方式</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">APPID</label>
                            <div class="controls">
                                <input id="domain" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['appid'];?>
" disabled>
                                <span class="help-block blue">渠道访问接口时唯一的身份标示</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">APPSECRET</label>
                            <div class="controls">
                                <input id="domain" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['appsecret'];?>
"
                                       disabled> <span class="help-block blue">渠道对应APPID唯一的密钥，渠道需保证密钥不外泄，否则有内容泄露风险！</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">白名单IP</label>
                            <div class="controls">
                                <textarea id="ip" rows="10"><?php echo $_smarty_tpl->tpl_vars['data']->value['ip'];?>
</textarea>
                                <span class="help-block blue">渠道服务器白名单设置，多个ip请使用回车，IP最后一段支持指定范围如:192.168.1.1-255</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">免费章节</label>
                            <div class="controls">
                                <input id="free" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['free'];?>
">
                                <span class="help-block blue">该参数控制每本书前多少章节免费</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">分类对应</label>
                            <div class="controls sortlistinput" style="white-space: nowrap;">
                                <input type="text" value="站内ID" style="width:3em" disabled>=><input type="text" value="对应ID" style="width:3em"  disabled>　<input type="text" value="站内名称" style="width:4em"  disabled>=><input type="text" value="对应名称" style="width:4em"  disabled>
                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['sortlist']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
$_smarty_tpl->tpl_vars['sortid'] = new Smarty_Variable($_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortid'], null, 0);?>
                                <div class="row-fluid">
                                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortid'];?>
" style="width:3em" disabled>=><input type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['sortlist'][$_smarty_tpl->tpl_vars['sortid']->value]['sortid'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortid'] : $tmp);?>
" style="width:3em" diysort="true" sortid="<?php echo $_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortid'];?>
">　<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortname'];?>
" style="width:4em" disabled>=><input type="text" id="sortname_<?php echo $_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortid'];?>
" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['sortlist'][$_smarty_tpl->tpl_vars['sortid']->value]['sortname'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['sortlist']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['sortname'] : $tmp);?>
" style="width:4em">
                                </div>
                                <?php endfor; endif; ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Sharesave();">保存</div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-align-justify"></i>
					</span>
                    <h5>授权批次</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="10%">批次</th>
                            <th width="30%">起始时间</th>
                            <th width="30%">结束时间</th>
                            <th width="10%">授权数量</th>
                            <th width="20%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['batch']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
                                <td><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['a']['index']+1;?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['batch']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['begintime'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['batch']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['overtime'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                <td><?php echo count($_smarty_tpl->tpl_vars['batch']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['books']);?>
</td>
                                <td class="center">
                                    <div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/batch_edit/?id=<?php echo $_GET['id'];?>
&batchid=<?php echo $_smarty_tpl->tpl_vars['batch']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">编辑</div>
                                    <div class="btn btn-danger btn-mini"  onclick="Miyue.Deletebatch('<?php echo $_GET['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['batch']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">删除</div>
                                </td>
                            </tr>
                            <?php endfor; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>添加批次</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">起始时间</label>
                            <div class="controls">
                                <input type="text" id="begintime" value=""  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权起始时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">结束时间</label>
                            <div class="controls">
                                <input type="text"id="overtime" value=""  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权结束时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Sharebatchsubmit();">添加</div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-align-justify"></i>
					</span>
                    <h5>接口管理</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="25%">接口用途</th>
                            <th width="15%">数据模型</th>
                            <th width="15%">数据类型</th>
                            <th width="25%">编辑时间</th>
                            <th width="15%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['api']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
                                <td><?php echo $_smarty_tpl->tpl_vars['api']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['apiuse'];?>
</td><?php $_smarty_tpl->tpl_vars['modelid'] = new Smarty_Variable($_smarty_tpl->tpl_vars['api']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['apimodel'], null, 0);?>
                                <td><?php echo $_smarty_tpl->tpl_vars['apimodel']->value[$_smarty_tpl->tpl_vars['modelid']->value]['name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['api']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['apitype'];?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['api']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['edittime'],"%Y-%m-%d %H:%M:%S");?>
</td>
                                <td class="center">
                                    <div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/api_edit/?id=<?php echo $_GET['id'];?>
&apiid=<?php echo $_smarty_tpl->tpl_vars['api']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">编辑</div>
                                    <div class="btn btn-danger btn-mini" onclick="Miyue.Deleteapi('<?php echo $_GET['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['api']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">删除</div>
                                </td>
                            </tr>
                            <?php endfor; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>添加接口</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">接口用途</label>
                            <div class="controls">
                                <input type="text" id="apiuse" value="">
                                <span class="help-block blue">请描述接口大致用途</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据模型</label>
                            <div class="controls">
                                <select id="apimodel">
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
"><?php echo $_smarty_tpl->tpl_vars['apimodel']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['name'];?>
</option>
                                    <?php endfor; endif; ?>
                                </select>
                                <span class="help-block blue">请选择接口数据模型，该参数不可修改。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据类型</label>
                            <div class="controls">
                                <select id="apitype">
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
"><?php echo $_smarty_tpl->tpl_vars['apitype']->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']];?>
</option>
                                    <?php endfor; endif; ?>
                                </select>
                                <span class="help-block blue">请选择接口返回数据类型，该参数不可修改。</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Shareapisubmit();">添加</div>
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
    $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<"">t<"F"p>',
    });
    $('select').select2();
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    <?php if (in_array("token",$_smarty_tpl->tpl_vars['data']->value['access'])) {?>$.uniform.update($("#token").attr("checked", true));<?php }?>
    <?php if (in_array("passip",$_smarty_tpl->tpl_vars['data']->value['access'])) {?>$.uniform.update($("#passip").attr("checked", true));<?php }?>
<?php echo '</script'; ?>
><?php }
}
?>