<?php /* Smarty version 3.1.27, created on 2016-11-25 11:15:37
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\dashboard.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:76005837acd9c8ada6_42440092%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0514dbe1df72b56e6356f5fdd8991aab9bb81468' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\dashboard.tpl',
      1 => 1460197724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76005837acd9c8ada6_42440092',
  'variables' => 
  array (
    'totalshare' => 0,
    'totalspider' => 0,
    'totalbook' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837acd9d04eb9_24886589',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837acd9d04eb9_24886589')) {
function content_5837acd9d04eb9_24886589 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '76005837acd9c8ada6_42440092';
echo $_smarty_tpl->getSubTemplate ("include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--Action boxes-->
<div class="container-fluid"><hr>

    <!--Chart-box-->
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>数据概览</h5>
            </div>
            <div class="widget-content" >
                <div class="row-fluid">
                    <div class="span3">
                        <ul class="site-stats">
                            <li class="bg_lh" onclick="Miyue.PageView('<?php echo urlconfigs::URL_auto(array('m'=>"admin/share"),$_smarty_tpl);?>
')"><i class="icon-indent-left"></i> <strong><?php echo count($_smarty_tpl->tpl_vars['totalshare']->value);?>
</strong> <small>输出渠道</small></li>
                            <li class="bg_lh" onclick="Miyue.PageView('<?php echo urlconfigs::URL_auto(array('m'=>"admin/spider"),$_smarty_tpl);?>
')"><i class="icon-indent-right"></i> <strong><?php echo count($_smarty_tpl->tpl_vars['totalspider']->value);?>
</strong> <small>输入CP</small></li>
                            <li class="bg_lh" onclick="Miyue.PageView('<?php echo urlconfigs::URL_auto(array('m'=>"admin/spider"),$_smarty_tpl);?>
')"><i class="icon-tag"></i> <strong><?php echo $_smarty_tpl->tpl_vars['totalbook']->value;?>
</strong> <small>收录书籍</small></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End-Chart-box-->

</div><?php }
}
?>