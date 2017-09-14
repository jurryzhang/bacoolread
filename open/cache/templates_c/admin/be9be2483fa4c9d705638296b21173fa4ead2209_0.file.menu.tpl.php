<?php /* Smarty version 3.1.27, created on 2016-11-25 11:15:36
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\include\menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:146015837acd8b59d79_81344647%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be9be2483fa4c9d705638296b21173fa4ead2209' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\include\\menu.tpl',
      1 => 1461654568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146015837acd8b59d79_81344647',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837acd8b96df6_69464089',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837acd8b96df6_69464089')) {
function content_5837acd8b96df6_69464089 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '146015837acd8b59d79_81344647';
?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> 仪表盘</a>
    <ul>
        <li><a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/dashboard"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)"><i class="icon icon-home"></i> <span>仪表盘</span></a> </li>
        <li> <a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/set"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)"><i class="icon icon-signal"></i> <span>平台设置</span></a> </li>
        <li> <a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"auto/start"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)"><i class="icon icon-inbox"></i> <span>计划任务</span></a> </li>
		<li> <a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"auto2/start"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)"><i class="icon icon-inbox"></i> <span>定时发布监控</span></a> </li>
        <li class="submenu"> <a uri="javascript:void(0);" onclick="Miyue.PageView(this,'slidedown')"><i class="icon icon-th-list"></i> <span>共享管理</span></a>
            <ul>
                <li><a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/share_add"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)">新增渠道</a></li>
                <li><a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/share"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)">渠道管理</a></li>
            </ul>
        </li>
        <li class="submenu"> <a uri="javascript:void(0);" onclick="Miyue.PageView(this,'slidedown')"><i class="icon icon-file"></i> <span>内容源管理</span></a>
            <ul>
                <li><a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/spider_add"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)">新增内容源</a></li>
                <li><a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/spider"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)">内容源管理</a></li>
            </ul>
        </li>
        <!--<li> <a href="javascript:void(0);" uri="<?php echo urlconfigs::URL_auto(array('m'=>"admin/access"),$_smarty_tpl);?>
" onclick="Miyue.PageView(this)"><i class="icon icon-inbox"></i> <span>权限管理</span></a> </li>-->
    </ul>
</div>
<!--sidebar-menu--><?php }
}
?>