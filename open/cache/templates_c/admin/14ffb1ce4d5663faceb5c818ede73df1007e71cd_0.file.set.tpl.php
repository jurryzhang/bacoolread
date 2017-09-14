<?php /* Smarty version 3.1.27, created on 2016-11-25 11:16:17
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\set.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:26195837ad01b90b99_87321964%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14ffb1ce4d5663faceb5c818ede73df1007e71cd' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\set.tpl',
      1 => 1461582671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26195837ad01b90b99_87321964',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ad01c0ac91_17119651',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ad01c0ac91_17119651')) {
function content_5837ad01c0ac91_17119651 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '26195837ad01b90b99_87321964';
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
					<h5>平台属性</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="form-horizontal">
						<div class="control-group">
							<label class="control-label">平台域名</label>
							<div class="controls">
								<input id="domain" type="text" value="<?php echo @constant('SITEURL');?>
" disabled>
								<span class="help-block blue">平台所使用的域名,只允许在配置文件修改，请勿使用二级域名或其他域名</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">URL类型</label>
							<div class="controls">
								<select id="urlmode"><option value="1"<?php if (@constant('URL_MODE') == 1) {?> selected<?php }?>>GET模式</option><option value="2"<?php if (@constant('URL_MODE') == 2) {?> selected<?php }?>>PATHINFO模式</option></select> <span
									class="help-block blue">GET模式（如http://xxx.com/index.php?m=admin/index）<br />PATHINFO模式（如http://xxx.com/index.php/admin/index）
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
					<h5>数据库设置</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="form-horizontal">
						<div class="control-group">
							<label class="control-label">数据库地址</label>
							<div class="controls">
								<input id="dbhost" type="text"
									value="<?php echo @constant('MYSQL_HOST');?>
"> <span
									class="help-block blue">应与杰奇数据库保持一致</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">数据库端口</label>
							<div class="controls">
								<input id="dbport" type="text"
									value="<?php echo @constant('MYSQL_PORT');?>
"> <span
									class="help-block blue">数据库服务所在端口号，默认情况下为3306</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">数据库名称</label>
							<div class="controls">
								<input id="dbname" type="text"
									value="<?php echo @constant('MYSQL_DB');?>
"> <span
									class="help-block blue">杰奇数据库名称</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">数据库登录用户</label>
							<div class="controls">
								<input id="dbuser" type="text"
									value="<?php echo @constant('MYSQL_USER');?>
"> <span
									class="help-block blue">该用户需要对数据库有写入，修改，删除，读取的权限</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">数据库登录密码</label>
							<div class="controls">
								<input id="dbpassword" type="text"
									value="<?php echo @constant('MYSQL_PASS');?>
"> <span
									class="help-block blue">登陆数据库的密码，错误的密码将会导致前端无法正常运行</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">数据库编码</label>
							<div class="controls">
								<input id="dbcharset" type="text"
									value="<?php echo @constant('MYSQL_CHARSET');?>
"> <span
									class="help-block blue">链接到数据库所使用的编码，默认情况下请输入utf8,不要写成utf-8</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">数据表前缀</label>
							<div class="controls">
								<input id="dbpre" type="text"
									value="<?php echo @constant('MYSQL_PRE');?>
"> <span
									class="help-block blue">数据表前缀，默认情况下为jieqi_</span>
							</div>
						</div>
					</div>
					<div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
					<h5>文件路径</h5>
				</div>
				<div class="widget-content nopadding">
					<div class="form-horizontal">
						<div class="control-group">
							<label class="control-label">分类文件路径</label>
							<div class="controls">
								<input id="sortpath" type="text" value="<?php echo @constant('SORTPATH');?>
">
								<span class="help-block blue">小说分类文件所在路径，请填写完整物理路径，默认在 杰奇根目录/configs/article/sort.php</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">TXT物理路径</label>
							<div class="controls">
								<input id="txtpath" type="text" value="<?php echo @constant('TXTPATH');?>
">
								<span class="help-block blue">TXT文件所在目录，请填写完整物理路径，默认在 杰奇根目录/files/article/txt/<br/>*请以斜线结尾</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">封面访问路径</label>
							<div class="controls">
								<input id="imgurl" type="text" value="<?php echo @constant('IMGURL');?>
">
								<span class="help-block blue">请填写用于前台访问图片的路径，http://img.xxx.com/files/article/image/<br/>*请以斜线结尾</span>
							</div>
						</div>
						<div class="form-actions">
							<div class="btn btn-success" onclick="Miyue.Setsubmit();">保存</div>
						</div>
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
			Miyue.Setsubmit();
		}
	});
<?php echo '</script'; ?>
><?php }
}
?>