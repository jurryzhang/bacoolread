<?php /* Smarty version 3.1.27, created on 2016-11-25 11:15:36
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:267795837acd8aa2bd1_10938377%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2a33cbe46c04487d82af30599ab517b61a0ea6a' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\index.tpl',
      1 => 1437017938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267795837acd8aa2bd1_10938377',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837acd8b1cce0_12855831',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837acd8b1cce0_12855831')) {
function content_5837acd8b1cce0_12855831 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '267795837acd8aa2bd1_10938377';
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