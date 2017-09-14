<?php /* Smarty version 3.1.27, created on 2016-11-25 11:19:27
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\share_add.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:254865837adbfb0b1e5_55277689%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2c900b53614ba20e4b066df16bf0c55f974c0a6' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\share_add.tpl',
      1 => 1435645238,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '254865837adbfb0b1e5_55277689',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837adbfb4bf65_84846201',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837adbfb4bf65_84846201')) {
function content_5837adbfb4bf65_84846201 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '254865837adbfb0b1e5_55277689';
echo $_smarty_tpl->getSubTemplate ("include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--Action boxes-->
<div class="container-fluid">
	<hr>

	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
					<h5>渠道信息</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="form-horizontal">
						<div class="control-group">
							<label class="control-label">渠道名称</label> 
							<div class="controls">
								<input id="name" type="text" value="">
								<span class="help-block blue">如:百度书城、掌阅等...仅做后台区分使用</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">鉴权方式</label>
							<div class="controls">
								<label><input type="checkbox" id="token"/>密钥授权</label>
                				<label><input type="checkbox" id="passip"/>IP地址授权</label>
                				<span class="help-block blue">至少选择一种鉴权方式</span>
							</div>
						</div>
						<div class="form-actions">
							<div class="btn btn-success" onclick="Miyue.Sharesubmit();">保存</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php echo '<script'; ?>
>
$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$(".controls input").unbind("keydown").bind("keydown", function(e) {
		if (e && e.keyCode == 13) {
			e.preventDefault();
			Miyue.Sharesubmit();
		}
	});
<?php echo '</script'; ?>
><?php }
}
?>