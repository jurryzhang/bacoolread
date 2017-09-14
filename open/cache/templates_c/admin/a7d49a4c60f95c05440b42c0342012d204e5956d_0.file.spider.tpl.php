<?php /* Smarty version 3.1.27, created on 2016-11-25 11:18:27
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\spider.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:326005837ad837baaa0_09557869%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7d49a4c60f95c05440b42c0342012d204e5956d' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\spider.tpl',
      1 => 1460530374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '326005837ad837baaa0_09557869',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ad83825782_30379762',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ad83825782_30379762')) {
function content_5837ad83825782_30379762 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\virtualhost\\bacoolread\\open\\include\\smarty\\plugins\\modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '326005837ad837baaa0_09557869';
echo $_smarty_tpl->getSubTemplate ("include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--Action boxes-->
<div class="container-fluid">
	<hr>
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>内容源列表</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
                                <th width="40%">内容源名称</th>
								<th width="20%">内容源标记</th>
								<th width="20%">修改时间</th>
								<th width="20%">管理操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['a'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['a']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['name'] = 'a';
$_smarty_tpl->tpl_vars['smarty']->value['section']['a']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['data']['name'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
</td>
								<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['edittime'],"%Y-%m-%d %H:%M:%S");?>
</td>
								<td class="center">
									<div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/spider_edit/?id=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">编辑</div>
									<div class="btn btn-danger btn-mini"  onclick="Miyue.Deletespider('<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">删除</div>
                                    <div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/spider_book/?id=<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->getVariable('smarty')->value['section']['a']['index']]['filename'];?>
')">内容管理</div>
								</td>
							</tr>
							<?php endfor; endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</div>
<?php echo '<script'; ?>
>
$('.data-table').dataTable({
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sDom": '<"">t<"F"p>'
});
$('select').select2();
<?php echo '</script'; ?>
><?php }
}
?>