        <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                        <h5><{$title}></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="form-horizontal">
                            <div class="control-group" id="spider_progress">
                                <label class="control-label">自动发布进度</label>
                                <div class="controls">
                                    <div class="progress progress-striped active"><div class="bar" style="width: 0%;"></div></div>
                                </div>
                            </div>
                            <div class="control-group" id="status">
                                <label class="control-label">当前动作</label>
                                <div class="controls">--</div>
                            </div>
                            <div class="control-group">
                                <label class="control-label oldform">监控间隔</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="text" id="waittime" onblur="TotalCount=$('#waittime').val();" placeholder="一次完整监控距离下次监控的间隔" class="span3" value="30">
                                        <span class="add-on">秒</span> </div>
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
        <script>
            var Autolist = '<{URL_auto m="auto2/Autolist"}>';
            var Autochapter = '<{URL_auto m="auto2/Autochapter"}>';
            var __List=[];
            var AutoOrder=0;
            var InterValObj;
            var curCount=0;
            var TotalCount=$("#waittime").val();
            GetAutolist();
            function GetAutolist(){
                Globals.Ajax(Autolist, "get","", "json", function () {
                   $("#status .controls").html("正在获取可发布内容...");
                }, function (result) {
                    if(result.Success) {
                        if(result.Data.length>0) {
                            __List = result.Data;
                            InsertChapter();
                            $("#status .controls").html("获取可发布内容成功!");
                        }else{
                            $("#status .controls").html("暂无可发布内容！");
                            curCount=0;
                            InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                        }
                    }else{
                        $("#status .controls").html(result.Msg);
                        curCount=0;
                        InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                    }
                });
            }
            function InsertChapter(){
                var draftid = __List[AutoOrder].draftid;
                Globals.Ajax(Autochapter, "post",{
                    draftid:draftid,
                }, "json", function () {
                    var per = Math.ceil((AutoOrder+1)/__List.length*100);
                    $("#spider_progress .bar").animate({width:per+'%'},0);
                    $("#status .controls").html("发布《"+__List[AutoOrder].articlename+"》章节《"+__List[AutoOrder].chaptername+"》中...");
                }, function (result) {
                    if(result.Success) {
                        $("#status .controls").html("发布《"+__List[AutoOrder].articlename+"》章节《"+__List[AutoOrder].chaptername+"》成功！");
                    }else{
                        $("#status .controls").html("发布《"+__List[AutoOrder].articlename+"》章节《"+__List[AutoOrder].chaptername+"》失败！原因:"+result.Msg);
                    }
                    AutoOrder++;
                    if(AutoOrder<__List.length){
                        InsertChapter();
                    }else{
                        AutoOrder=0;
                        InterValObj = window.setInterval(SetRemainTime,1000);//启动计时器，1秒执行一次
                    }
                });
            }
            function SetRemainTime() {
                if(curCount>=TotalCount){
                    window.clearInterval(InterValObj);
                    curCount=0;
                    AutoOrder=0;
                    __List=[];
                    GetAutolist();
                }else{
                    curCount++;
                    $("#status .controls").html(Math.ceil(TotalCount-curCount)+"秒后重新开始！");
                }
            }
        </script>

