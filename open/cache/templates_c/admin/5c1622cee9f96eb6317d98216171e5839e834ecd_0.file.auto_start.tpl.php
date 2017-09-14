<?php /* Smarty version 3.1.27, created on 2016-11-25 17:19:27
         compiled from "C:\virtualhost\bacoolread\open\templates\admin\auto_start.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:35635838021f676855_35391811%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c1622cee9f96eb6317d98216171e5839e834ecd' => 
    array (
      0 => 'C:\\virtualhost\\bacoolread\\open\\templates\\admin\\auto_start.tpl',
      1 => 1480065258,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35635838021f676855_35391811',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5838021f6b38d9_35810584',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5838021f6b38d9_35810584')) {
function content_5838021f6b38d9_35810584 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '35635838021f676855_35391811';
?>
        <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                        <h5>内容源采集器</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="form-horizontal">
                            <div class="control-group" id="spider_progress">
                                <label class="control-label">内容源总进度</label>
                                <div class="controls">
                                    <div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>
                                </div>
                            </div>
                            <div class="control-group" id="book_progress">
                                <label class="control-label">当前源小说进度</label>
                                <div class="controls">
                                    <div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>
                                </div>
                            </div>
                            <div class="control-group" id="chapter_progress">
                                <label class="control-label">当前小说章节进度</label>
                                <div class="controls">
                                    <div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>
                                </div>
                            </div>
                            <div class="control-group" id="spider_status">
                                <label class="control-label">当前内容源</label>
                                <div class="controls">--</div>
                            </div>
                            <div class="control-group" id="book_status">
                                <label class="control-label">当前小说</label>
                                <div class="controls">--</div>
                            </div>
                            <div class="control-group" id="chapter_status">
                                <label class="control-label">当前章节</label>
                                <div class="controls">--</div>
                            </div>
                            <div class="control-group" id="status">
                                <label class="control-label">当前动作</label>
                                <div class="controls">--</div>
                            </div>
                            <div class="control-group">
                                <label class="control-label oldform">循环采集间隔</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="text" id="waittime" onblur="TotalCount=$('#waittime').val();" placeholder="一次完整采集距离下次采集的间隔" class="span3" value="3600">
                                        <span class="add-on">秒</span> </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label oldform">日志</label>
                                <div class="controls" id="syslog">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <style>
            .oldform{
                padding-top: 15px !important;
            }
        </style>
        <?php echo '<script'; ?>
>
            var Autospiderlist = '<?php echo urlconfigs::URL_auto(array('m'=>"auto/spiderlist"),$_smarty_tpl);?>
';
            var Autoarticlelist = '<?php echo urlconfigs::URL_auto(array('m'=>"auto/articlelist"),$_smarty_tpl);?>
';
            var Autochapterlist = '<?php echo urlconfigs::URL_auto(array('m'=>"auto/chapterlist"),$_smarty_tpl);?>
';
            var Autochapter = '<?php echo urlconfigs::URL_auto(array('m'=>"auto/chapter"),$_smarty_tpl);?>
';
            var Spiderlist=[];
            var Articlelist=[];
            var Chapterlist=[];
            var SpiderOrder=0;
            var ArticleOrder=0;
            var ChapterOrder=0;
            var InterValObj;
            var curCount=0;
            var TotalCount=$("#waittime").val();
            GetSpiderlist();
            function GetSpiderlist(){
                $("#spider_status .controls").html("--");
                $("#book_status .controls").html("--");
                $("#chapter_status .controls").html("--");
                $("#syslog").html("");
                Globals.Ajax(Autospiderlist, "get","", "json", function () {
                   $("#status .controls").html("正在获取内容源列表...");
                }, function (result) {
                    if(result.Success) {
                        if(result.Data.length>0) {
                            Spiderlist = result.Data;
                            //console.log(Spiderlist);
                            GetArticlelist();
                            $("#status .controls").html("获取内容源列表成功!");
                        }else{
                            $("#status .controls").html("暂无可采集资源！");
                        }
                    }else{
                        $("#syslog").append(result.Msg+'<br/>');
                    }
                });
            }
            function GetArticlelist(){
                var spiderid = Spiderlist[SpiderOrder].mark;
                $("#book_status .controls").html("--");
                $("#chapter_status .controls").html("--");
                Globals.Ajax(Autoarticlelist, "post",{
                    spiderid:spiderid
                }, "json", function () {
                    var per = Math.ceil((SpiderOrder+1)*100/Spiderlist.length);
                    $("#spider_progress .bar").animate({width:per+'%'},0);
                    $("#spider_status .controls").html("("+Math.ceil(SpiderOrder+1)+"/"+Spiderlist.length+")　"+Spiderlist[SpiderOrder].name);
                    $("#status .controls").html("正在获取小说列表...");
                }, function (result) {
                    if(result.Success) {
                        if(result.Data.length>0) {
                            Articlelist = result.Data;
                            //console.log(Articlelist);
                            GetChapterlist();
                            $("#status .controls").html("小说列表获取成功！");
                        }else{
                            $("#status .controls").html("该内容源下无可采集小说");
                            SpiderOrder++;
                            ArticleOrder=0;
                            ChapterOrder=0;
                            if(SpiderOrder<Spiderlist.length) {
                                GetArticlelist();
                            }else {
                                SpiderOrder=0;
                                InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                            }
                        }
                    }else{
                        $("#syslog").append(result.Msg+'<br/>');
                        SpiderOrder++;
                        ArticleOrder=0;
                        ChapterOrder=0;
                        if(SpiderOrder<Spiderlist.length) {
                            GetArticlelist();
                        }else {
                            SpiderOrder=0;
                            InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                        }
                    }
                });
            }
            function GetChapterlist(){
                var spiderid = Spiderlist[SpiderOrder].mark;
				var userid = Spiderlist[SpiderOrder].userid;
                var bookid = Articlelist[ArticleOrder].articleid;
                $("#chapter_status .controls").html("--");
                Globals.Ajax(Autochapterlist, "post",{
                    spiderid:spiderid,
					userid:userid,
                    bookid:bookid
                }, "json", function () {
                    var per = Math.ceil((ArticleOrder+1)*100/Articlelist.length);
                    $("#book_progress .bar").animate({width:per+'%'},0);
                    $("#book_status .controls").html("("+Math.ceil(ArticleOrder+1)+"/"+Articlelist.length+")　"+Articlelist[ArticleOrder].articlename);
                    $("#status .controls").html("正在获取章节列表...");
                }, function (result) {
                    if(result.Success) {
                        if(result.Data.length>0) {
                            Chapterlist = result.Data;
                            //console.log(Chapterlist);
                            $("#chapter_progress .bar").width("0%");
                            GetChapter();
                            $("#status .controls").html("章节列表获取成功！");
                        }else{
                            $("#status .controls").html("该小说下暂无可采集章节！");
                            ArticleOrder++;
                            ChapterOrder=0;
                            if(ArticleOrder<Articlelist.length) {
                                GetChapterlist();
                            }else{
                                SpiderOrder++;
                                ArticleOrder=0;
                                ChapterOrder=0;
                                if(SpiderOrder<Spiderlist.length) {
                                    GetArticlelist();
                                }else {
                                    SpiderOrder=0;
                                    InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                                }
                            }
                        }
                    }else{
                        $("#syslog").append(result.Msg+'<br/>');
                        ArticleOrder++;
                        ChapterOrder=0;
                        if(ArticleOrder<Articlelist.length) {
                            GetChapterlist();
                        }else{
                            SpiderOrder++;
                            ArticleOrder=0;
                            ChapterOrder=0;
                            if(SpiderOrder<Spiderlist.length) {
                                GetArticlelist();
                            }else {
                                SpiderOrder=0;
                                InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                            }
                        }
                    }
                });
            }
            function GetChapter(){
                var spiderid = Spiderlist[SpiderOrder].mark;
                var bookid = Articlelist[ArticleOrder].articleid;
                var chapterid = Chapterlist[ChapterOrder].chapterid;
                Globals.Ajax(Autochapter, "post",{
                    spiderid:spiderid,
                    bookid:bookid,
                    chapterid:chapterid
                }, "json", function () {
                    var per = Math.ceil((ChapterOrder+1)/Chapterlist.length*100);
                    $("#chapter_progress .bar").animate({width:per+'%'},0);
                    $("#chapter_status .controls").html("("+Math.ceil(ChapterOrder+1)+"/"+Chapterlist.length+")　"+Chapterlist[ChapterOrder].chaptername);
                    $("#status .controls").html("正在获取章节内容...");
                }, function (result) {
                    if(result.Success) {
                        $("#status .controls").html("章节采集成功！");
                    }else{
                        $("#syslog").append(result.Msg+'<br/>');
                    }
                    ChapterOrder++;
                    if(ChapterOrder<Chapterlist.length){
                        GetChapter();
                    }else{
                        ArticleOrder++;
                        ChapterOrder=0;
                        if(ArticleOrder<Articlelist.length) {
                            GetChapterlist();
                        }else{
                            SpiderOrder++;
                            ArticleOrder=0;
                            ChapterOrder=0;
                            if(SpiderOrder<Spiderlist.length) {
                                GetArticlelist();
                            }else {
                                SpiderOrder=0;
                                InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                            }
                        }
                    }
                });
            }
            function SetRemainTime() {
                if(curCount>=TotalCount){
                    window.clearInterval(InterValObj);
                    curCount=0;
                    GetSpiderlist();
                }else{
                    curCount++;
                    $("#status .controls").html(Math.ceil(TotalCount-curCount)+"秒后重新开始！");
                }
            }
        <?php echo '</script'; ?>
>

<?php }
}
?>