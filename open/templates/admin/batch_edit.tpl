<{include file="include/nav.tpl"}>
<!--Action boxes-->
<div class="container-fluid">
    <hr>

    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>授权期限<input type="hidden" id="shareid" value="<{$smarty.get.id}>"><input type="hidden" id="batchid" value="<{$smarty.get.batchid}>"></h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">起始时间</label>
                            <div class="controls">
                                <input type="text" id="begintime" class="span10" value="<{$data.begintime|date_format:"%Y-%m-%d"}>"  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权起始时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">结束时间</label>
                            <div class="controls">
                                <input type="text"id="overtime" class="span10" value="<{$data.overtime|date_format:"%Y-%m-%d"}>"  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权结束时间，精确到当天00:00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>添加小说</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                       <div class="control-group">
                            <label class="control-label">添加小说ID</label>
                            <div class="controls">
                                <textarea id="addbook" class="span10"></textarea>
                                <span class="help-block blue">请填写要添加的小说ID，多个ID请使用逗号(半角 )隔开,添加过的不需要再次添加。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">已授权小说ID</label>
                            <div class="controls">
                                <textarea id="addbook" class="span10" disabled="disabled"><{$bookstring}></textarea>
                                <span class="help-block blue">已经授权的小说ID，此处仅供复制查看，管理已授权小说请在右侧管理。</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Batchsave();">保存</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="span6">
		<div class="widget-box">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>已授权小说管理</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="15%">ID</th>
                            <th width="55%">小说名称</th>
                            <th width="15%">章节</th>
                            <th width="15%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <{section name=a loop=$books}>
                            <tr class="gradeA">
                                <td><{$books[a].articleid}></td>
                                <td><{$books[a].articlename}></td>
                                <td><{$books[a].chapters}></td>
                                <td class="center">
                                    <div class="btn btn-danger btn-mini"  onclick="Miyue.Deletebookfrombatch('<{$smarty.get.id}>','<{$smarty.get.batchid}>','<{$books[a].articleid}>')">删除</div>
                                </td>
                            </tr>
                            <{/section}>
                        </tbody>
                    </table>
                    <div class="form-actions nomargin">
                        <div class="btn btn-primary btn-mini"  onclick="window.open('<{URL_auto m="ajax/AdminBatchExcel" id=$smarty.get.id batchid=$smarty.get.batchid}>');">导出EXCEL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $('#begintime').datepicker();
    $('#overtime').datepicker();
    $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>',
    });
    $('select').select2();
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    $(".controls input").unbind("keydown").bind("keydown", function(e) {
        if (e && e.keyCode == 13) {
            e.preventDefault();
            Miyue.Batchsave();
        }
    });
    $("#addbook").unbind("propertychange input").bind('propertychange input', function (e) {  
    	Miyue.Formatbooks();
    	if (e && e.keyCode == 13) {
            e.preventDefault();
            Miyue.Batchsave();
        }
    });
</script>