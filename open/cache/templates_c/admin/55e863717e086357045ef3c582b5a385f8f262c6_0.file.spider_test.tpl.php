<?php /* Smarty version 3.1.27, created on 2016-11-25 11:28:02
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\spider_test.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:267335837afc2514a56_03904297%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55e863717e086357045ef3c582b5a385f8f262c6' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\spider_test.tpl',
      1 => 1461677026,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267335837afc2514a56_03904297',
  'variables' => 
  array (
    'api' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837afc2587143_56641219',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837afc2587143_56641219')) {
function content_5837afc2587143_56641219 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '267335837afc2514a56_03904297';
echo $_smarty_tpl->getSubTemplate ("include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!--Action boxes--><div class="fixbtn disabledbtn btn">测试通过</div>
<div class="container-fluid">
	<hr>

	<div class="row-fluid">
		<div class="span12">
			<div class="widget-box nomargin">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>接口列表<input id="spiderid" value="<?php echo $_GET['id'];?>
" type="hidden"></h5>
                </div>
            </div>
                <div class="accordion nopadding nomargin" id="collapse-group">
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse-group" id="uri_articlelist" onclick="articlelist();" href="#collapseGOne" data-toggle="collapse" class=""> <span class="icon"><i class="icon-link"></i></span>
                                    <h5>获取小说列表：<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_articlelist'];?>
</h5>
                                </a> </div>
                        </div>
                        <div class="accordion-body collapse" id="collapseGOne" style="height: 0px;">
                            <div class="widget-content"></div>
                        </div>
                    </div>
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse-group" id="uri_articleinfo" onclick="articleinfo();" href="#collapseGTwo" data-toggle="collapse"> <span class="icon"><i class="icon-link"></i></span>
                                    <h5>获取小说详情：<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_articleinfo'];?>
</h5>
                                </a> </div>
                        </div>
                        <div class="accordion-body collapse" id="collapseGTwo" style="height: 0px;">
                            <div class="widget-content"></div>
                        </div>
                    </div>
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse-group" id="uri_chapterlist" onclick="chapterlist();" href="#collapseGThree" data-toggle="collapse" class=""> <span class="icon"><i class="icon-link"></i></span>
                                    <h5>获取小说目录：<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_chapterlist'];?>
</h5>
                                </a> </div>
                        </div>
                        <div class="accordion-body collapse" id="collapseGThree" style="height: 0px;">
                            <div class="widget-content"></div>
                        </div>
                    </div>
                    <div class="accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title"> <a data-parent="#collapse-group" id="uri_chapter" onclick="chapter();" href="#collapseGFour" data-toggle="collapse" class=""> <span class="icon"><i class="icon-link"></i></span>
                                    <h5>获取章节内容：<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_chapter'];?>
</h5>
                                </a> </div>
                        </div>
                        <div class="accordion-body collapse" id="collapseGFour" style="height: 0px;">
                            <div class="widget-content"></div>
                        </div>
                    </div>
                </div>
		</div>
	</div>

</div>
<?php echo '<script'; ?>
>
    var bookid = 0;
    var chapterid = 0;
    var spiderid = $("#spiderid").val();
    var status_articlelist=0;
    var status_articleinfo=0;
    var status_chapterlist=0;
    var status_chapter=0;
    function articlelist() {
        Globals.Ajax(Ajax_spiderapi, "post", {
            id: spiderid,
            type: "uri_articlelist",
        }, "json", function () {}, function (result) {
            if(result.Success) {
                if(result.Data.length>0) {
                    var html = '';
                    $.each(result.Data, function (k, v) {
                        if (k == 0) {
                            bookid = v.articleid;
                        }
                        var templink = "<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_articleinfo'];?>
".replace("{bookid}", v.articleid);
                        html += '<a href="javascript:void(0);" onclick="articleinfo(' + v.articleid + ')">' + v.articleid + '：' + v.articlename + ': ' + v.lastupdate + ' ' + templink + '</a><br/>';
                    });
                    $("#uri_articlelist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(html);
                    $("#uri_articlelist .icon i").attr("class","icon-ok");
                    status_articlelist=1;
                }else{
                    $("#uri_articlelist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html("采集成功，但是小说列表为空！");
                    $("#uri_articlelist .icon i").attr("class","icon-remove");
                    status_articlelist=0;
                }
            }else{
                $("#uri_articlelist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(result.Msg);
                $("#uri_articlelist .icon i").attr("class","icon-remove");
                status_articlelist=0;
            }
            checkbtnstatus();
        });
    }
    function articleinfo(){
        if(bookid==0){
            return;
        }
        if(arguments[0]>0){
            bookid = arguments[0];
            var tempid = arguments[0];
        }
        Globals.Ajax(Ajax_spiderapi, "post", {
            id: spiderid,
            type: "uri_articleinfo",
            bookid: bookid,
        }, "json", function () {}, function (result) {
            if(tempid>0) {
                $("#uri_articleinfo").trigger("click");
            }
            if(result.Success) {
                var html = '';
                html += '小说ID：'+result.Data.articleid+"<br/>";
				html += '入库时间：'+result.Data.postdate+"<br/>";
				html += '更新时间：'+result.Data.lastupdate+"<br/>";
                html += '小说名称：'+result.Data.articlename+"<br/>";
                html += '作者：'+result.Data.author+"<br/>";
                html += '关键字：'+result.Data.keywords+"<br/>";
				html += '本书简介：'+result.Data.intro+"<br/>";
				html += '本书公告：'+result.Data.notice+"<br/>";
                html += '连载状态：'+result.Data.fullflag+"<br/>";
				html += '章节数：'+result.Data.chapters+"<br/>";
                html += '总字数：'+result.Data.words+"<br/>";
                html += '是否签约：'+result.Data.isvip+"<br/>";
				html += '所属频道：'+result.Data.rgroup+"<br/>";
				html += '分类：'+result.Data.category+"<br/>";
				html += '封面：'+result.Data.cover+"<br/>";
				html += '免费最新章节ID：'+result.Data.freechapterid+"<br/>";
				html += '免费最新章节名：'+result.Data.freechapter+"<br/>";
				html += '免费最后更新时间：'+result.Data.freetime+"<br/>";
				html += 'VIP最新章节ID：'+result.Data.vipchapterid+"<br/>";
				html += 'VIP最新章节名：'+result.Data.vipchapter+"<br/>";
				html += 'VIP最后更新时间：'+result.Data.viptime+"<br/>";
                $("#uri_articleinfo .icon i").attr("class","icon-ok");
                $("#uri_articleinfo").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(html);
                status_articleinfo=1;
            }else{
                status_articleinfo=0;
                $("#uri_articleinfo .icon i").attr("class","icon-remove");
                $("#uri_articleinfo").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(result.Msg);
            }
            checkbtnstatus();
        });
    }
    function chapterlist(){
        if(bookid==0){
            return;
        }
        Globals.Ajax(Ajax_spiderapi, "post", {
            id: spiderid,
            type: "uri_chapterlist",
            bookid: bookid,
        }, "json", function () {}, function (result) {
            //$("#uri_chapterlist").trigger("click");
            if(result.Success) {
                if(result.Data.length>0) {
                    var html = '';
                    //console.log(result);
                    $.each(result.Data, function (k, v) {
                        if (k == 0) {
                            chapterid = v.chapterid;
                        }
                        var templink = "<?php echo $_smarty_tpl->tpl_vars['api']->value['uri_chapter'];?>
".replace("{bookid}", bookid).replace("{chapterid}", v.chapterid);
                        html += '<a href="javascript:void(0);" onclick="chapter(' + v.chapterid + ')">' + v.chapterid + '：' + v.chaptername + '：' + v.chaptertype + '：' + v.isvip + '：' + v.saleprice + '：' + v.postdate + '：' + v.lastupdate + '：' + v.words + ' ' + templink + '</a><br/>';
                    });
                    $("#uri_chapterlist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(html);
                    $("#uri_chapterlist .icon i").attr("class","icon-ok");
                    status_chapterlist=1;
                }else{
                    $("#uri_chapterlist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html("采集成功，但是章节列表为空！");
                    $("#uri_chapterlist .icon i").attr("class","icon-remove");
                    status_chapterlist=0;
                }
            }else{
                status_chapterlist=0;
                $("#uri_chapterlist .icon i").attr("class","icon-remove");
                $("#uri_chapterlist").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(result.Msg);
            }
            checkbtnstatus();
        });
    }
    function chapter(){
        if(bookid==0){
            return;
        }
        if(chapterid==0){
            $("#uri_chapterlist").trigger("click");
            return;
        }
        if(arguments[0]>0){
            chapterid = arguments[0];
            var tempid = arguments[0];
        }
        Globals.Ajax(Ajax_spiderapi, "post", {
            id: spiderid,
            type: "uri_chapter",
            bookid: bookid,
            chapterid:chapterid,
        }, "json", function () {}, function (result) {
            if(tempid>0) {
                $("#uri_chapter").trigger("click");
            }
            if(result.Success) {
                var html = '';
                html += '章节ID：'+result.Data.chapterid+"<br/>";
                html += '章节名称：'+result.Data.chaptername+"<br/>";
                html += '创建时间：'+result.Data.postdate+"<br/>";
                html += '更新时间：'+result.Data.lastupdate+"<br/>";
				html += '章节属性：'+result.Data.chaptertype+"<br/>";
                html += '是否免费：'+result.Data.isvip+"<br/>";
				html += '章节单价：'+result.Data.saleprice+"<br/>";
                html += '字数：'+result.Data.words+"<br/>";
                html += '<p style="white-space: pre-wrap;">章节内容：'+result.Data.content+"</p>";
                $("#uri_chapter .icon i").attr("class","icon-ok");
                $("#uri_chapter").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(html);
                status_chapter=1;
            }else{
                status_chapter=0;
                $("#uri_chapter .icon i").attr("class","icon-remove");
                $("#uri_chapter").parents(".accordion-group").children(".accordion-body").children(".widget-content").html(result.Msg);
            }
            checkbtnstatus();
        });
    }
    function checkbtnstatus(){
        if(status_articlelist==1&&status_articleinfo==1&&status_chapterlist==1&&status_chapter==1){
            $(".fixbtn").removeClass("disabledbtn").removeClass("btn-success").addClass("btn-success");
            $(".fixbtn").attr("onclick","checkpass();");
        }else{
            $(".fixbtn").removeClass("disabledbtn").removeClass("btn-success").addClass("disabledbtn");
            $(".fixbtn").removeAttr("onclick");
        }
    }
    function checkpass(){
        Globals.Ajax(Ajax_spiderapipass, "post", {
            id:spiderid,
            status_articlelist : status_articlelist,
            status_articleinfo : status_articleinfo,
            status_chapterlist : status_chapterlist,
            status_chapter : status_chapter
        }, "json", function() {
            Globals.Ajaxloading();
        }, function(result) {
            if (result.Success) {
                Miyue.PageView('index.php/admin/spider_edit/?id='+spiderid);
                Globals.TipsSuccess(result.Msg);
            } else {
                Globals.TipsWarning(result.Msg);
            }
            Globals.Ajaxloaded();
            return;
        });
    }
    <?php echo '</script'; ?>
><?php }
}
?>