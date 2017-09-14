<?php /* Smarty version 3.1.27, created on 2016-11-25 11:15:37
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\include\nav.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:134215837acd9d04eb0_78723811%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de9b091c769c9bbdb7d88dcdea8097894c07195d' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\include\\nav.tpl',
      1 => 1436353422,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134215837acd9d04eb0_78723811',
  'variables' => 
  array (
    'breadcrumb' => 0,
    'breadno' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837acd9d41f34_02580609',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837acd9d41f34_02580609')) {
function content_5837acd9d41f34_02580609 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '134215837acd9d04eb0_78723811';
?>
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb">
		<a href="javascript:void(0);" class="tip-bottom" data-original-title="仪表盘" onclick="Miyue.PageView('<?php echo urlconfigs::URL_auto(array('m'=>"admin/dashboard"),$_smarty_tpl);?>
');"><i class="icon-home"></i> 仪表盘</a>
		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['breadcrumb']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
$_smarty_tpl->tpl_vars['breadno'] = new Smarty_Variable($_smarty_tpl->getVariable('smarty')->value['section']['a']['index']+1, null, 0);?>
		<a href="javascript:void(0);" <?php if ($_smarty_tpl->tpl_vars['breadno']->value == count($_smarty_tpl->tpl_vars['breadcrumb']->value)) {?>class="current"<?php } else { ?>class="tip-bottom"<?php }?> onclick="Miyue.PageView('<?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['link'];?>
');" data-original-title="<?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['text'];?>
"><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['text'];?>
</a> 
		<?php endfor; endif; ?>
	</div>
    <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
</div>
<!--End-breadcrumbs--><?php }
}
?>