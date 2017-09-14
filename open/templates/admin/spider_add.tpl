<{include file="include/nav.tpl"}>
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
<script>
	$(".controls input").unbind("keydown").bind("keydown", function(e) {
		if (e && e.keyCode == 13) {
			e.preventDefault();
			Miyue.Spideradd();
		}
	});
</script>