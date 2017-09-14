<?php /* Smarty version 3.1.27, created on 2016-11-25 11:18:19
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\spider_add.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:293675837ad7b86b666_07076711%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7970ec83781f4d89ef0ca74345fc3a31570cb285' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\spider_add.tpl',
      1 => 1461470051,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '293675837ad7b86b666_07076711',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ad7b8ac3f9_15635483',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ad7b8ac3f9_15635483')) {
function content_5837ad7b8ac3f9_15635483 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '293675837ad7b86b666_07076711';
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
					<h5>内容源配置信息</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="form-horizontal">
						<div class="control-group">
							<label class="control-label">内容源名称</label>
							<div class="controls">
								<input id="name" type="text" value="">
								<span class="help-block blue">如:百度书城、掌阅等...仅做后台区分使用</span>
							</div>
						</div>
                        <div class="control-group">
                            <label class="control-label">内容源ID</label>
                            <div class="controls">
                                <input id="mark" type="text" value="">
                                <span class="help-block blue">合作方提供的接口ID（数据库小说作品表 siteid 的值），该内容源ID一旦写入不可更改</span>
                            </div>
                        </div>
						<div class="control-group">
                            <label class="control-label">合作方UID</label>
                            <div class="controls">
                                <input id="userid" type="text" value="">
                                <span class="help-block blue">合作方在本站用户名ID，该合作UID一旦写入不可更改</span>
                            </div>
                        </div>
						<div class="form-actions">
							<div class="btn btn-success" onclick="Miyue.Spideradd();">保存</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php echo '<script'; ?>
>
	$(".controls input").unbind("keydown").bind("keydown", function(e) {
		if (e && e.keyCode == 13) {
			e.preventDefault();
			Miyue.Spideradd();
		}
	});
<?php echo '</script'; ?>
><?php }
}
?>