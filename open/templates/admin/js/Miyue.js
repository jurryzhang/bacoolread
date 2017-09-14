(function(win) {
    if (!win.Miyue)
        var F = {
            Extend : function(dest, source, replace) {
                for (prop in source) {
                    if (replace == false && dest[prop] != null)
                        continue;
                    dest[prop] = source[prop];
                }
                ;
                return dest;
            }
        };
    win.Miyue = F;
})(window);
(function() {
    var Funcs = {
        PageView : function() {
            var temp = arguments[0] || "";
            var temps = arguments[1] || "";
            if (typeof (temp) != "object") {
                temp = $("#sidebar ul li [uri='" + temp + "']");
            }
            if (temp.length == 1 || temp.length == undefined) {
                var tempss = $(temp).parent("li").parent("ul").parent("li")
                    .attr("class");
                if (typeof (tempss) != "undefined") {
                    if (tempss.indexOf('submenu') == -1) {
                        $(".submenu ul").slideUp();
                    }
                    temps = "slidedown";
                } else {
                    $(".submenu ul").slideUp();
                }
                if (temps == "slidedown") {
                    $(temp).parent("li").parent("ul").slideDown();
                    $(temp).parent("li").parent("ul").parent("li").addClass(
                        "active");
                    $(temp).parent("li").children("ul").slideDown();
                }
                $(temp).parent("li").parent("ul").children("li").removeClass(
                    "active");
                $(".submenu ul li").removeClass("active");
                $(temp).parent("li").addClass("active");
                var uri = $(temp).attr("uri");
            }else{
                var uri = arguments[0];
            }
            if (uri.indexOf('javascript:') > -1) {
                eval(uri);
            } else {
                Miyue.Loadpage(uri);
            }
        },
        Loadpage : function() {
            var uri = arguments[0] || "";
            if (uri == "") {
                Globals.TipsWarning("未获取到要加载的页面！");
                return;
            }
            Globals.Ajax(uri, "get", "", "text", function() {
                // console.log("geting");
                Globals.Pageloading();
            }, function(result) {
                Globals.Pageloaded();
                if (!result.match("^\{(.+:.+,*){1,}\}$")){
                    $("#content").html(result);
                    Globals.PushState("蜜阅", Admin_index + "#" + uri);
                }else{
                    result = $.parseJSON(result);
                    Globals.TipsWarning(result.Msg);
                    return;
                }
            });
        },
        Setsubmit : function() {
            var domain = $("#domain").val();
            if (domain == "") {
                Globals.TipsWarning("域名不能为空！");
                return;
            }
            var urlmode = $("#urlmode").val();
            if (urlmode == "") {
                Globals.TipsWarning("URL模式不能为空！");
                return;
            }
            var dbhost = $("#dbhost").val();
            if (dbhost == "") {
                Globals.TipsWarning("数据库地址不能为空！");
                return;
            }
            var dbport = $("#dbport").val();
            if (dbhost == "") {
                Globals.TipsWarning("数据库端口不能为空！");
                return;
            }
            var dbname = $("#dbname").val();
            if (dbname == "") {
                Globals.TipsWarning("数据库名称不能为空！");
                return;
            }
            var dbuser = $("#dbuser").val();
            if (dbuser == "") {
                Globals.TipsWarning("数据库用户名不能为空！");
                return;
            }
            var dbpassword = $("#dbpassword").val();
            if (dbpassword == "") {
                Globals.TipsWarning("数据库密码不能为空！");
                return;
            }
            var dbcharset = $("#dbcharset").val();
            if (dbcharset == "") {
                Globals.TipsWarning("数据库编码不能为空！");
                return;
            }
            var sortpath = $("#sortpath").val();
            if (sortpath == "") {
                Globals.TipsWarning("分类文件路径不能为空！");
                return;
            }
            var txtpath = $("#txtpath").val();
            if (txtpath == "") {
                Globals.TipsWarning("TXT物理路径！");
                return;
            }
            var imgurl = $("#imgurl").val();
            if (imgurl == "") {
                Globals.TipsWarning("封面访问路径不能为空！");
                return;
            }
            var dbpre = $("#dbpre").val();
            Globals.Ajax(Ajax_setsubmit, "post", {
                domain : domain,
                urlmode : urlmode,
                dbhost : dbhost,
                dbport : dbport,
                dbname : dbname,
                dbuser : dbuser,
                dbpassword : dbpassword,
                dbcharset : dbcharset,
                dbpre : dbpre,
                sortpath:sortpath,
                txtpath:txtpath,
                imgurl:imgurl
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Sharesubmit : function() {
            var name = $("#name").val();
            if (name == "") {
                Globals.TipsWarning("请输入渠道名称！");
                return;
            }
            var token = $("#token").attr("checked");
            var passip = $("#passip").attr("checked");
            if (passip == undefined && token == undefined) {
                Globals.TipsWarning("请至少选择一种鉴权方式！");
                return;
            }
            Globals.Ajax(Ajax_sharesubmit, "post", {
                name : name,
                token : token,
                passip : passip
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Miyue.PageView(Admin_share);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Sharesave : function(){
            var shareid = $("#shareid").val();
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            var name = $("#name").val();
            if (name == "") {
                Globals.TipsWarning("请输入渠道名称！");
                return;
            }
            var token = $("#token").attr("checked");
            var passip = $("#passip").attr("checked");
            if (passip == undefined && token == undefined) {
                Globals.TipsWarning("请至少选择一种鉴权方式！");
                return;
            }
            var ip = $("#ip").val();
            if (passip=="checked"&&ip == "") {
                Globals.TipsWarning("选择IP地址授权后请输入允许访问的IP地址白名单！");
                return;
            }
            var free = $("#free").val();
            if (free == "") {
                Globals.TipsWarning("请设置免费章节数量！");
                return;
            }
            var sortids = "";
            var sortnames = "";
        	$.each($("input[diysort='true']"),function(k,v){
        		if(k!=0){
        			sortids+= "&";
        			sortnames+= "&";
        		}
        		sortids+= $(v).attr("sortid")+"="+$(v).val();
        		sortnames+= $(v).val()+"="+$("#sortname_"+$(v).attr("sortid")).val();
        	});
            Globals.Ajax(Ajax_sharesave, "post", {
                id:shareid,
                name : name,
                token : token,
                passip : passip,
                ip:ip,
                free:free,
                sortids:sortids,
                sortnames:sortnames
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Sharebatchsubmit : function(){
            var shareid = $("#shareid").val();
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            var begintime = $("#begintime").val();
            if (begintime == "") {
                Globals.TipsWarning("请选择起始时间！");
                return;
            }
            var overtime = $("#overtime").val();
            if (overtime == "") {
                Globals.TipsWarning("请选择结束时间！");
                return;
            }
            if(Globals.Transdate(begintime)>=Globals.Transdate(overtime)){
                Globals.TipsWarning("请选择合理的时间区间！");
                return;
            }
            Globals.Ajax(Ajax_batchsubmit, "post", {
                id:shareid,
                begintime:begintime,
                overtime : overtime
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Deletebatch : function(shareid,batchid){
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            if (batchid == "") {
                Globals.TipsWarning("无效的批次！");
                return;
            }
            if (confirm("确认要删除该批次吗？")) {
                Globals.Ajax(Ajax_batchdelete, "post", {
                	shareid:shareid,
                    batchid:batchid,
                }, "json", function() {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function(result) {
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
        },
        Shareapisubmit : function(){
        	var shareid = $("#shareid").val();
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            var apiuse = $("#apiuse").val();
            if (apiuse == "") {
                Globals.TipsWarning("请填写接口用途！");
                return;
            }
            var apimodel = $("#apimodel").val();
            if (apimodel == "") {
                Globals.TipsWarning("请选择数据模型！");
                return;
            }
            var apitype = $("#apitype").val();
            if (apitype == "") {
                Globals.TipsWarning("请选择数据类型！");
                return;
            }
            Globals.Ajax(Ajax_apisubmit, "post", {
                id:shareid,
                apiuse:apiuse,
                apimodel : apimodel,
                apitype : apitype
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Deleteapi : function(shareid,apiid){
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            if (apiid == "") {
                Globals.TipsWarning("无效的接口！");
                return;
            }
            if (confirm("确认要删除该接口吗？")) {
                Globals.Ajax(Ajax_apidelete, "post", {
                	shareid:shareid,
                	apiid:apiid,
                }, "json", function() {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function(result) {
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
        },
        Deleteshare : function(shareid){
        	if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            if (confirm("确认要删除该渠道吗？")) {
                Globals.Ajax(Ajax_sharedelete, "post", {
                	shareid:shareid
                }, "json", function() {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function(result) {
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
        },
        Batchsave : function(){
        	var shareid = $("#shareid").val();
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            var batchid = $("#batchid").val();
            if (batchid == "") {
                Globals.TipsWarning("无效的批次！");
                return;
            }
            var begintime = $("#begintime").val();
            if (begintime == "") {
                Globals.TipsWarning("请选择起始时间！");
                return;
            }
            var overtime = $("#overtime").val();
            if (overtime == "") {
                Globals.TipsWarning("请选择结束时间！");
                return;
            }
            if(Globals.Transdate(begintime)>=Globals.Transdate(overtime)){
                Globals.TipsWarning("请选择合理的时间区间！");
                return;
            }
            var addbook = $("#addbook").val();
            Globals.Ajax(Ajax_batchsave, "post", {
                id:shareid,
                batchid:batchid,
                begintime:begintime,
                overtime : overtime,
                addbook : addbook
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Deletebookfrombatch : function(shareid,batchid,bookid){
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            if (batchid == "") {
                Globals.TipsWarning("无效的批次！");
                return;
            }
            if (bookid == "") {
                Globals.TipsWarning("请选择要取消授权的书操作！");
                return;
            }
            if (confirm("确认要取消该本授权吗？")) {
                Globals.Ajax(Ajax_bookdeletefrombatch, "post", {
                	id:shareid,
                	batchid:batchid,
                	bookid:bookid
                }, "json", function() {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function(result) {
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
        },
        Apisave : function(){
        	var shareid = $("#shareid").val();
            if (shareid == "") {
                Globals.TipsWarning("无效的渠道ID！");
                return;
            }
            var apiid = $("#apiid").val();
            if (apiid == "") {
                Globals.TipsWarning("无效的接口！");
                return;
            }
        	var apiuse = $("#apiuse").val();
        	if (apiuse == "") {
                Globals.TipsWarning("请描述接口用途！");
                return;
            }
        	var queryarray = "";
        	$.each($("input[diyquery='true']"),function(k,v){
        		if(k!=0){
        			queryarray+= "&";
        		}
        		queryarray+= $(v).attr("id")+"="+$(v).val();
        	});
        	var template = $("#template").val();
        	if (template == "") {
                Globals.TipsWarning("请设置输出模板！");
                return;
            }
        	Globals.Ajax(Ajax_apisave, "post", {
            	id:shareid,
            	apiid:apiid,
            	apiuse:apiuse,
            	queryarray:queryarray,
            	template:template
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Globals.Refresh();
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Formatbooks : function(){
        	var temp = $("#addbook").val();
        	temp = temp.replace(/ /g,",");
        	temp = temp.replace(/，/g,",");
        	$("#addbook").val(temp);
        	return;
        },
        Spideradd : function() {
            var name = $("#name").val();
            if (name == "") {
                Globals.TipsWarning("请输入内容源名称！");
                return;
            }
            var mark = $("#mark").val();
            if (mark == "") {
                Globals.TipsWarning("请输入内容源标记！");
                return;
            }
			if(isNaN(mark)){
				Globals.TipsWarning("内容源标记只能为数字！");
                return;
			}
			var userid = $("#userid").val();
            if (userid == "") {
                Globals.TipsWarning("请输入合作方UID！");
                return;
            }
			if(isNaN(userid)){
				Globals.TipsWarning("合作方UID只能为数字！");
                return;
			}
            Globals.Ajax(Ajax_spidersubmit, "post", {
                name : name,
                mark : mark,
				userid : userid
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    Miyue.PageView(Admin_spider);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Spidersave : function(){
            var spiderid = $("#spiderid").val();
            if (spiderid == "") {
                Globals.TipsWarning("无效的内容源！");
                return;
            }
            var name = $("#name").val();
            if (name == "") {
                Globals.TipsWarning("请输入内容源名称！");
                return;
            }
            var mark = $("#mark").val();
            if (mark == "") {
                Globals.TipsWarning("请输入内容源标记！");
                return;
            }
			var userid = $("#userid").val();
            if (userid == "") {
                Globals.TipsWarning("请输入合作方UID！");
                return;
            }
            var online = $("#online").attr("checked");
            var debug = $("#debug").attr("checked");
            if (online == undefined && debug == undefined) {
                Globals.TipsWarning("请选择上线或调试！");
                return;
            }
            var begintime = $("#begintime").val();
            if (begintime == "") {
                Globals.TipsWarning("请选择起始时间！");
                return;
            }
            var overtime = $("#overtime").val();
            if (overtime == "") {
                Globals.TipsWarning("请选择结束时间！");
                return;
            }
            if(Globals.Transdate(begintime)>=Globals.Transdate(overtime)){
                Globals.TipsWarning("请选择合理的时间区间！");
                return;
            }
            Globals.Ajax(Ajax_spidersave, "post", {
                id:spiderid,
                name : name,
                mark : mark,
				userid : userid,
                online : online,
                debug:debug,
                begintime:begintime,
                overtime:overtime
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        Spiderapisave : function(){
            var spiderid = $("#spiderid").val();
            if (spiderid == "") {
                Globals.TipsWarning("无效的内容源！");
                return;
            }
            var uri_articlelist = $("#uri_articlelist").val();
            if (uri_articlelist == "") {
                Globals.TipsWarning("获取小说列表接口不能为空！");
                return;
            }
            var uri_articleinfo = $("#uri_articleinfo").val();
            if (uri_articleinfo == "") {
                Globals.TipsWarning("获取小说详情接口不能为空！");
                return;
            }
            if (uri_articleinfo.indexOf("{bookid}")==-1){
                Globals.TipsWarning("获取小说详情接口缺少bookid参数，请添加！");
                return;
            }
            var uri_chapterlist = $("#uri_chapterlist").val();
            if (uri_chapterlist == "") {
                Globals.TipsWarning("获取小说目录接口不能为空！");
                return;
            }
            if (uri_chapterlist.indexOf("{bookid}")==-1){
                Globals.TipsWarning("获取小说目录接口缺少bookid参数，请添加！");
                return;
            }
            var uri_chapter = $("#uri_chapter").val();
            if (uri_chapter == "") {
                Globals.TipsWarning("获取章节内容接口不能为空！");
                return;
            }
            if (uri_chapter.indexOf("{bookid}")==-1){
                Globals.TipsWarning("获取章节内容接口缺少bookid参数，请添加！");
                return;
            }
            if (uri_chapter.indexOf("{chapterid}")==-1){
                Globals.TipsWarning("获取章节内容接口缺少chapterid参数，请添加！");
                return;
            }
            Globals.Ajax(Ajax_spiderapisave, "post", {
                id:spiderid,
                uri_articlelist : uri_articlelist,
                uri_articleinfo : uri_articleinfo,
                uri_chapterlist : uri_chapterlist,
                uri_chapter:uri_chapter
            }, "json", function() {
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
		Deletespider : function(mark){
        	if (mark == "") {
                Globals.TipsWarning("无效的内容源！");
                return;
            }
            if (confirm("确认要删除该内容源吗？")) {
                Globals.Ajax(Ajax_spiderdelete, "post", {
                	mark:mark
                }, "json", function() {
                    // console.log("submiting");
                    Globals.Ajaxloading();
                }, function(result) {
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
        },
        Spiderapitest : function(){

        }
    }
    Miyue.Extend(Miyue, Funcs, false);
})();