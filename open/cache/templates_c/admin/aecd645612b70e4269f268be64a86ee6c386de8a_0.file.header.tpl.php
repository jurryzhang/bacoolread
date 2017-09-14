<?php /* Smarty version 3.1.27, created on 2016-11-25 11:15:36
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\include\header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:100015837acd8b59d72_69141601%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aecd645612b70e4269f268be64a86ee6c386de8a' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\include\\header.tpl',
      1 => 1437017938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100015837acd8b59d72_69141601',
  'variables' => 
  array (
    'title' => 0,
    'userinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837acd8b59d71_91329264',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837acd8b59d71_91329264')) {
function content_5837acd8b59d71_91329264 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '100015837acd8b59d72_69141601';
?>
<!--Header-part-->
<div id="header">
    <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li  class="dropdown" id="profile-messages" ><a title="" href="javascript:void(0);" data-toggle="dropdown" data-target="#profile-messages"><i class="icon icon-user"></i>  <span class="text"><?php echo $_smarty_tpl->tpl_vars['userinfo']->value->name;?>
</span></a>
        </li>
        <li class=""><a title="" href="javascript:void(0);" onclick="Login.logout();"><i class="icon icon-share-alt"></i> <span class="text">注销</span></a></li>
    </ul>
</div>
<!--close-top-Header-menu--><?php }
}
?>