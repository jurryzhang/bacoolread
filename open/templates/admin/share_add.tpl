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
<script>
$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$(".controls input").unbind("keydown").bind("keydown", function(e) {
		if (e && e.keyCode == 13) {
			e.preventDefault();
			Miyue.Sharesubmit();
		}
	});
</script>