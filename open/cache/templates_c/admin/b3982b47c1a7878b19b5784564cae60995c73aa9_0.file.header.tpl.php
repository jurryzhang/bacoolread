<?php /* Smarty version 3.1.27, created on 2016-07-22 13:20:08
         compiled from "C:\virtualhost\mianfeidushu\open\templates\admin\include\header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:33765791ad08bb8bf4_38983612%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3982b47c1a7878b19b5784564cae60995c73aa9' => 
    array (
      0 => 'C:\\virtualhost\\mianfeidushu\\open\\templates\\admin\\include\\header.tpl',
      1 => 1437017938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33765791ad08bb8bf4_38983612',
  'variables' => 
  array (
    'title' => 0,
    'userinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5791ad08bb8bf3_48723383',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5791ad08bb8bf3_48723383')) {
function content_5791ad08bb8bf3_48723383 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '33765791ad08bb8bf4_38983612';
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
