<?php /* Smarty version 3.1.27, created on 2016-07-22 13:20:08
         compiled from "C:\virtualhost\mianfeidushu\open\templates\admin\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:276375791ad08b01a48_76806553%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b5bb6288951f3cb1349f230d6c3725de2da25ca' => 
    array (
      0 => 'C:\\virtualhost\\mianfeidushu\\open\\templates\\admin\\index.tpl',
      1 => 1437017938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276375791ad08b01a48_76806553',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5791ad08b3ead7_57875952',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5791ad08b3ead7_57875952')) {
function content_5791ad08b3ead7_57875952 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '276375791ad08b01a48_76806553';
echo $_smarty_tpl->getSubTemplate ("include/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php echo $_smarty_tpl->getSubTemplate ("include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php echo $_smarty_tpl->getSubTemplate ("include/searchbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
$_smarty_tpl->tpl_vars['template'] = new Smarty_Variable(basename($_smarty_tpl->source->filepath), null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--main-container-part-->
<div id="content">

</div>
<!--end-main-container-part-->
<?php echo $_smarty_tpl->getSubTemplate ("include/foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>
