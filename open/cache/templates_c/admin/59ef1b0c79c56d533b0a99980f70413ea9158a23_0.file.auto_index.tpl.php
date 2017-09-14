<?php /* Smarty version 3.1.27, created on 2016-11-25 12:10:13
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\auto_index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:240005837b9a5f08624_54381460%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59ef1b0c79c56d533b0a99980f70413ea9158a23' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\auto_index.tpl',
      1 => 1437017938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '240005837b9a5f08624_54381460',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837b9a60032b2_48663065',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837b9a60032b2_48663065')) {
function content_5837b9a60032b2_48663065 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '240005837b9a5f08624_54381460';
echo $_smarty_tpl->getSubTemplate ("include/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    <div id="content" style="margin-left: 0px !important;">

    </div>
<style>
    .widget-box{
        box-shadow: 2px 2px 5px 2px #999;
        border-radius: 10px;
        overflow: hidden;
    }
    .form-horizontal .control-label {
        padding: 10px 0;
        height: 20px;
        line-height: 20px;
        margin: 0px;
    }
    .widget-title h5{
        font-size: 1rem;
    }
    .form-horizontal .controls {
        font-size: 14px;
        font-weight: normal;
    }
</style>
<?php echo '<script'; ?>
 src="templates/admin/js/excanvas.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.ui.custom.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.flot.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.flot.resize.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.peity.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/fullcalendar.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/bootstrap-colorpicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/bootstrap-datepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/masked.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.gritter.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.validate.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.wizard.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.uniform.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/select2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/Miyue.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/Globals.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="templates/admin/js/Login.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function(){
        Admin_index = "index.php/auto/index/";
        var uri = window.location.hash || "index.php/auto/start";
        uri = uri.replace("#","");
        Miyue.PageView(uri);
    });
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>