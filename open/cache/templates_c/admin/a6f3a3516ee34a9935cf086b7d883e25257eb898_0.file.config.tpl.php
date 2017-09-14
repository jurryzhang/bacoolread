<?php /* Smarty version 3.1.27, created on 2016-11-23 16:47:07
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\config.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:220365835578bb98316_45213954%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6f3a3516ee34a9935cf086b7d883e25257eb898' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\config.tpl',
      1 => 1460196769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '220365835578bb98316_45213954',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5835578bc4f4c4_28157020',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5835578bc4f4c4_28157020')) {
function content_5835578bc4f4c4_28157020 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '220365835578bb98316_45213954';
?>
var Admin_domain = "<?php echo @constant('SITEURL');?>
";
var Admin_index = "<?php echo urlconfigs::URL_auto(array('m'=>"admin/index"),$_smarty_tpl);?>
";
var Admin_share = "<?php echo urlconfigs::URL_auto(array('m'=>"admin/share"),$_smarty_tpl);?>
";
var Admin_spider = "<?php echo urlconfigs::URL_auto(array('m'=>"admin/spider"),$_smarty_tpl);?>
";
var Ajax_setsubmit = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminSetsubmit"),$_smarty_tpl);?>
";
var Ajax_sharesubmit = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminSharesubmit"),$_smarty_tpl);?>
";
var Ajax_sharesave = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminSharesave"),$_smarty_tpl);?>
";
var Ajax_batchsubmit = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminBatchsubmit"),$_smarty_tpl);?>
";
var Ajax_batchdelete = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminBatchdelete"),$_smarty_tpl);?>
";
var Ajax_apisubmit = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminApisubmit"),$_smarty_tpl);?>
";
var Ajax_apidelete = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminApidelete"),$_smarty_tpl);?>
";
var Ajax_sharedelete = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminSharedelete"),$_smarty_tpl);?>
";
var Ajax_batchsave = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminBatchsave"),$_smarty_tpl);?>
";
var Ajax_bookdeletefrombatch = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/Adminbookdeletefrombatch"),$_smarty_tpl);?>
";
var Ajax_apisave = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminApisave"),$_smarty_tpl);?>
";
var Site_logincheck = "<?php echo urlconfigs::URL_auto(array('m'=>"site/logincheck"),$_smarty_tpl);?>
";
var Site_login = "<?php echo urlconfigs::URL_auto(array('m'=>"site/login"),$_smarty_tpl);?>
";
var Site_logout = "<?php echo urlconfigs::URL_auto(array('m'=>"site/logout"),$_smarty_tpl);?>
";
var Ajax_spiderdelete = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/AdminSpiderdelete"),$_smarty_tpl);?>
";
var Ajax_spidersubmit = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/sipdersubmit"),$_smarty_tpl);?>
";
var Ajax_spidersave = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/sipdersave"),$_smarty_tpl);?>
";
var Ajax_spiderapisave = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/sipderapisave"),$_smarty_tpl);?>
";
var Ajax_spiderapi = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/sipderapi"),$_smarty_tpl);?>
";
var Ajax_spiderapipass = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/sipderapipass"),$_smarty_tpl);?>
";
var Ajax_spiderrefresh = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/spiderrefresh"),$_smarty_tpl);?>
";
var Ajax_spideronline = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/spideronline"),$_smarty_tpl);?>
";
var Ajax_spiderdisplay = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/spiderdisplay"),$_smarty_tpl);?>
";
var Ajax_spidershenhe = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/spidershenhe"),$_smarty_tpl);?>
";
var Ajax_spiderrefreshcover = "<?php echo urlconfigs::URL_auto(array('m'=>"ajax/spiderrefreshcover"),$_smarty_tpl);?>
";<?php }
}
?>