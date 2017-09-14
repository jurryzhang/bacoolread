<?php /* Smarty version 3.1.27, created on 2016-11-25 11:15:36
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\include\foot.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:142865837acd8b96df5_38688558%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08d89dba628533e9bbfefd176c6bde09cdb19fcc' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\include\\foot.tpl',
      1 => 1435645238,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142865837acd8b96df5_38688558',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837acd8b96df8_38495554',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837acd8b96df8_38495554')) {
function content_5837acd8b96df8_38495554 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '142865837acd8b96df5_38688558';
?>
<!--Footer-part-->

<div class="row-fluid">
    <div id="footer" class="span12"> 2015 copyright by hon6</div>
</div>

<!--end-Footer-part-->

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
    	var uri = window.location.hash || "index.php/admin/dashboard";
    	uri = uri.replace("#","");
        Miyue.PageView(uri);
    });
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>