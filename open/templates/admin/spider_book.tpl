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
                    <h5>已抓取小说管理</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="5%">选择</th>
                            <th width="10%">己方ID</th>
                            <th width="10%">对方ID</th>
                            <th width="20%">小说名称</th>
                            <th width="5%">章节</th>
                            <th width="5%">封面</th>
                            <th width="2%">己方最新章节</th>
                            <!--<th width="5%">WEB</th>-->
                            <th width="5%">APP</th>
                            <th width="15%">对方上次更新时间</th>
                            <th width="15%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <{section name=a loop=$books}>
                            <tr class="gradeA">
                                <td style="text-align:center;"><input type="checkbox" class="bookbox" value="<{$books[a].articleid}>"/></td>
                                <td style="text-align:center;"><{$books[a].articleid}></td>
                                <td style="text-align:center;"><{$books[a].sourceid}></td>
                                <td><{$books[a].articlename}></td>
                                <td style="text-align:center;"><{$books[a].chapters}></td>
                                <td style="text-align:center;"><{$books[a].imgflag}></td>
                                <td><{$books[a].lastchapter}></td>
                                <td><{if $books[a].display == "0"}>已显<{else}>已隐<{/if}></td>
                                <!--<td><{if $books[a].isapp == "1"}>已显<{else}>已隐<{/if}></td>-->
                                <td style="text-align:center;"><{$books[a].lastupdate|date_format:"%Y-%m-%d %H:%M:%S"}></td>
                                <td style="text-align:center;">
                                    <!--<div class="btn btn-danger btn-mini"  onclick="SetRefresh('<{$books[a].articleid}>')">删除重采</div>
                                    <div class="btn btn-danger btn-mini"  onclick="SetRefreshCover('<{$books[a].articleid}>')">删除封面</div>
                                    <{if $books[a].online == "1"}>
                                        <div class="btn btn-danger btn-mini"  onclick="Setonline('<{$books[a].articleid}>',0)">不采集</div>
                                    <{else}>
                                        <div class="btn btn-primary btn-mini"  onclick="Setonline('<{$books[a].articleid}>',1)">采集</div>
                                    <{/if}>
                                    <{if $books[a].isapp == "1"}>
                                        <div class="btn btn-danger btn-mini"  onclick="SetDisplay('<{$books[a].articleid}>',0)">APP隐藏</div>
                                    <{else}>
                                        <div class="btn btn-primary btn-mini"  onclick="SetDisplay('<{$books[a].articleid}>',1)">APP显示</div>
                                    <{/if}>-->
                                    <{if $books[a].display == "0"}>
                                    <div class="btn btn-danger btn-mini"  onclick="Setshenhe('<{$books[a].articleid}>',1)">WEB隐藏</div>
                                    <{else}>
                                    <div class="btn btn-primary btn-mini"  onclick="Setshenhe('<{$books[a].articleid}>',0)">WEB显示</div>
                                    <{/if}>
                                </td>
                            </tr>
                            <{/section}>
                        </tbody>
                    </table>
                    <div class="form-actions nomargin">
                        <div class="btn btn-primary btn-mini"  onclick="SelectAll()">全选</div>
                        <div class="btn btn-primary btn-mini"  onclick="UnSelectAll()">全不选</div>
                        <!--<div class="btn btn-danger btn-mini"  onclick="SetRefresh('')">删除重采</div>
                        <div class="btn btn-danger btn-mini"  onclick="Setonline('',0)">移除采集任务</div>
                        <div class="btn btn-danger btn-mini"  onclick="SetDisplay('',0)">APP隐藏</div>-->
                        <div class="btn btn-danger btn-mini"  onclick="Setshenhe('',1)">WEB隐藏</div>
                        <!--<div class="btn btn-primary btn-mini"  onclick="Setonline('',1)">加入采集任务</div>
                        <div class="btn btn-primary btn-mini"  onclick="SetDisplay('',1)">APP显示</div>-->
                        <div class="btn btn-primary btn-mini"  onclick="Setshenhe('',0)">WEB显示</div>
                        <!--<div class="btn btn-danger btn-mini"  onclick="SetRefreshCover('')">删除封面</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    var spiderid = "<{$smarty.get.id|default:""}>";
    $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>',
    });
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    function SelectAll(){
        $.each($(".bookbox"),function(k,v){
            $.uniform.update($(v).attr("checked", true));
        });
    }
    function UnSelectAll(){
        $.each($(".bookbox"),function(k,v){
            $.uniform.update($(v).attr("checked", false));
        });
    }
    function GetCheckbox(){
        var temp="";
        $.each($(".bookbox"),function(k,v){
            if($(v).attr("checked")=="checked"){
                if(temp==""){
                    temp += $(v).val();
                }else{
                    temp += ","+$(v).val();
                }
            }
        });
        if(temp==""){
            Globals.TipsWarning("您尚未选择小说！");
            return false;
        }
        return temp;
    }
    function SetRefresh(bookid){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            if (confirm("确定要删除现有章节重新采集吗？请谨慎操作，重新采集后所有章节ID会变动！")) {
                Globals.Ajax(Ajax_spiderrefresh, "post", {
                    id: spiderid,
                    idstring: idstring,
                }, "json", function () {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function (result) {
                    if (result.Success) {
                        Globals.TipsSuccess(result.Msg);
                        Globals.Refresh();
                    } else {
                        Globals.TipsWarning(result.Msg);
                    }
                    Globals.Ajaxloaded();
                    return;
                });
            }
        }
    }
    function SetRefreshCover(bookid){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            if (confirm("确定要删除现有封面重新采集吗？采集之前封面将为空！")) {
                Globals.Ajax(Ajax_spiderrefreshcover, "post", {
                    id: spiderid,
                    idstring: idstring,
                }, "json", function () {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function (result) {
                    if (result.Success) {
                        Globals.TipsSuccess(result.Msg);
                        Globals.Refresh();
                    } else {
                        Globals.TipsWarning(result.Msg);
                    }
                    Globals.Ajaxloaded();
                    return;
                });
            }
        }
    }
    function Setonline(bookid,answer){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            Globals.Ajax(Ajax_spideronline, "post", {
                id: spiderid,
                idstring: idstring,
                answer : answer
            }, "json", function () {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function (result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });

        }
    }
    function SetDisplay(bookid,answer){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            Globals.Ajax(Ajax_spiderdisplay, "post", {
                id: spiderid,
                idstring: idstring,
                answer : answer
            }, "json", function () {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function (result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });

        }
    }
    function Setshenhe(bookid,answer){
        if (spiderid == "") {
            Globals.TipsWarning("无效的内容源 ID！");
            return;
        }
        if(bookid=="") {
            var idstring = GetCheckbox();
        }else{
            var idstring = bookid;
        }
        if(idstring) {
            Globals.Ajax(Ajax_spidershenhe, "post", {
                id: spiderid,
                idstring: idstring,
                answer : answer
            }, "json", function () {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function (result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });

        }
    }
</script>