<?php /* Smarty version 3.1.27, created on 2016-07-22 13:20:08
         compiled from "C:\virtualhost\mianfeidushu\open\templates\admin\include\head.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:172955791ad08bb8bf9_95389514%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'def7dd3efcf0e4d64d56b0ecdeb1f2d8a6944e5d' => 
    array (
      0 => 'C:\\virtualhost\\mianfeidushu\\open\\templates\\admin\\include\\head.tpl',
      1 => 1437848744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172955791ad08bb8bf9_95389514',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5791ad08bb8bf7_19943848',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5791ad08bb8bf7_19943848')) {
function content_5791ad08bb8bf7_19943848 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '172955791ad08bb8bf9_95389514';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<base href="http://<?php echo @constant('SITEURL');?>
/" />
<link rel="stylesheet" href="templates/admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="templates/admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="templates/admin/css/fullcalendar.css" />
<link rel="stylesheet" href="templates/admin/css/matrix-style.css" />
<link rel="stylesheet" href="templates/admin/css/matrix-media.css" />
<link rel="stylesheet" href="templates/admin/css/colorpicker.css" />
<link rel="stylesheet" href="templates/admin/css/datepicker.css" />
<link rel="stylesheet" href="templates/admin/css/uniform.css" />
<link rel="stylesheet" href="templates/admin/css/select2.css" />
<link href="templates/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="templates/admin/css/jquery.gritter.css" />
<link rel="stylesheet" href="templates/admin/css/Miyue.css" />
<?php echo '<script'; ?>
 src="<?php echo urlconfigs::URL_auto(array('m'=>"site/config"),$_smarty_tpl);?>
"><?php echo '</script'; ?>
>
</head>
<body><?php }
}
?>
