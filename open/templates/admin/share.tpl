<{include file="include/nav.tpl"}>
<!--Action boxes-->
<div class="container-fluid">
	<hr>
	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-th"></i></span>
					<h5>渠道列表</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th width="10%">渠道ID</th>
								<th width="50%">渠道名称</th>
								<th width="20%">修改时间</th>
								<th width="20%">管理操作</th>
							</tr>
						</thead>
						<tbody>
							<{section name=a loop=$data}>
							<tr class="gradeA">
								<td><{$data[a].filename}></td>
								<td><{$data[a].data.name}></td>
								<td><{$data[a].edittime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
								<td class="center">
									<div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/share_edit/?id=<{$data[a].filename}>')">编辑</div>
									<div class="btn btn-danger btn-mini"  onclick="Miyue.Deleteshare('<{$data[a].filename}>')">删除</div>
								</td>
							</tr>
							<{/section}>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</div>
<script>
$('.data-table').dataTable({
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sDom": '<"">t<"F"p>'
});
$('select').select2();
</script>