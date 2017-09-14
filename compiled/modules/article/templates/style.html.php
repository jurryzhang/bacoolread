<?php
echo '<!--[if lt IE 7 ]><html class="lowie ie6" lang="zh-cn"><![endif]-->
<!--[if IE 7 ]><html class="lowie ie7" lang="zh-cn"><![endif]-->
<!--[if IE 8 ]><html class="lowie ie8" lang="zh-cn"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="zh-cn"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="" lang="zh-cn">
<!--<![endif]-->
<head>
    <meta charset="gbk">
    <meta name="keywords" content="'.$this->_tpl_vars['articlename'].' '.$this->_tpl_vars['chaptername'].' '.$this->_tpl_vars['author'].' '.$this->_tpl_vars['sort'].' '.$this->_tpl_vars['jieqi_sitename'].'" />
    <meta name="description" content="'.truncate($this->_tpl_vars['summary'],'500','..').'" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$this->_tpl_vars['articlename'].'-'.$this->_tpl_vars['chaptername'].'-'.$this->_tpl_vars['author'].'-'.$this->_tpl_vars['sort'].'-'.$this->_tpl_vars['jieqi_sitename'].'</title>
    <link rel="stylesheet" href="/sink/css/commo.css" type="text/css">
    <link rel="stylesheet" href="/sink/css/read.css" type="text/css">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico"/>
    <script type="text/javascript" src="/sink/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/sink/js/base.js"></script>
    <script type="text/javascript" src="/sink/js/layer.js"></script>
    <script type="text/javascript" src="/sink/js/page.js"></script>
    <!--book headerjs-->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="/sink/css/iefix.css" type="text/css">
    <script src="/sink/js/html5shiv.min.js" info="html5shiv"></script>
    <script>
        window.lowie = 1;
    </script>
    <script src="/sink/js/iefix.js"></script>
    <![endif]-->

</head>
<body onselectstart="return false">

<body>
<div style="height:38px;"></div>
<div class="nav-group">
    <div class="top-bar">
        <div class="main top-wrap">
            <div class="fl">
                <div class="top-opt"> <a class="nav-tit" href="'.$this->_tpl_vars['jieqi_url'].'" target="_blank">'.$this->_tpl_vars['jieqi_sitename'].'</a>
                </div>

            </div>
            <div class="fr">
                <div class="login-box fl">
                    <div class="before-login">
                        ';
if($this->_tpl_vars['jieqi_userid'] == 0){
echo '
                        <a href="javascript:;" onclick="userLogin();">登录</a> <span>|</span> <a href="'.$this->_tpl_vars['jieqi_user_url'].'/register.php">注册</a>
                        ';
}else{
echo '
                        <img src="'.$this->_tpl_vars['jieqi_url'].'/files/badge/image/3/0/'.$this->_tpl_vars['jieqi_vip_img'].'.png" class="logvip" /><a href="'.$this->_tpl_vars['jieqi_url'].'/user/">'.$this->_tpl_vars['jieqi_username'].'</a> <span>|</span> <a href="'.$this->_tpl_vars['jieqi_url'].'/user/">个人中心</a><span>|</span> <a href="/logout.php">退出</a>
                        ';
}
echo '
                    </div>
                </div>
                <span class="sp">|</span>
                <div class="fl top-chg"> <a href="" target="_blank">充值</a> </div>
            </div>
        </div>
        <!-- end of top-wrap-->
    </div>
    <!--end of top bar-->

</div>
<!--end of nav group -->

<div class="read-main">

    <!--end read-tab-->
    <div class="read-top">
        <h2><a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'" target="_balnk">'.$this->_tpl_vars['articlename'].'</a><span>'.$this->_tpl_vars['chaptername'].'</span></h2>
        <div class="selcetbox_yd">
            <script type="text/javascript" src="/sink/js/pagetop.js"></script>
        </div>

        <!--end read-setup-->
    </div>
    <!--end read-top-->
    <div id="htmlContent" class="read-content">
        <h2>'.$this->_tpl_vars['chaptername'].'</h2>
        <div class="textinfo">
            小说：<a href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'info').'" target="_blank">'.$this->_tpl_vars['articlename'].'</a>
            作者：
            ';
if($this->_tpl_vars['authorid'] == 0){
echo '
            <a href="'.jieqi_geturl('article','author',$this->_tpl_vars['authorid'],$this->_tpl_vars['author']).'" target="_blank">'.$this->_tpl_vars['author'].'</a>
            ';
}else{
echo '
            <a href="'.jieqi_geturl('system','user',$this->_tpl_vars['authorid'],$this->_tpl_vars['author']).'" target="_blank">'.$this->_tpl_vars['author'].'</a>
            ';
}
echo '
            
            更新时间：'.date('Y-m-d H:i',$this->_tpl_vars['chaptertime']).'    字数：'.$this->_tpl_vars['chaptersize_c'].'  </div>

        <style>
            .read-content p *{ font-style:normal; font-weight:100; text-decoration:none; line-height:inherit;}
            .read-content p cite{ display:none; visibility:hidden;}
        </style>





        <p>
            '.$this->_tpl_vars['jieqi_content'].'
        </p>



    </div>
    <!--end read-content-->



    <div class="read-page">
        <span class="gray">（← 快捷键 </span>
        <a href="'.$this->_tpl_vars['url_preview'].'">上一章</a>
        <a href="'.$this->_tpl_vars['url_index'].'">回目录</a>
        <a href="'.$this->_tpl_vars['url_next'].'">下一章</a>
        <span class="gray">快捷键→）</span>
    </div>
    <!--end read-page-->



    <!--end book-rcm-->
</div>




<div class="sidebar read-toolbar" id="rightToolbar" style="left: 80%; visibility: visible;">
    <div class="sidebar-btn" style="border: 1px solid rgb(253,125,114);">
        <ul>
            <li style="border-top-color:rgb(253,125,114)"><a class="addto-shelf-btn" href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/addbookcase.php?bid='.$this->_tpl_vars['articleid'].'&cid='.$this->_tpl_vars['chapterid'].'\');" style="color:rgb(253,125,114);border-top-color:rgb(253,125,114);" ><i class="icon icon-book"></i>书签</a></li>
            <li style="border-top-color:rgb(253,125,114)"><a class="send-reward-btn" href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'\');"   style="color:rgb(253,125,114)" ><i class="icon icon-reward"></i>打赏</a></li>
            <li style="border-top-color:rgb(253,125,114)"><a class="send-flower-btn" href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?type=flower&id='.$this->_tpl_vars['articleid'].'\');"  style="color:rgb(253,125,114)"><i class="icon icon-flower"></i>送花</a></li>


        </ul>
    </div>
    <!--end sidebar-btn-->
    <div class="sidebar-scroll"  style="border: 1px solid rgb(253,125,114)">
        <ul>
            <li style="border-top-color:rgb(253,125,114)"><a title="" href="'.$this->_tpl_vars['url_preview'].'"><i class="arr-up" style="border-color: transparent transparent rgb(253,125,114);"></i></a></li>
            <li style="border-top-color:rgb(253,125,114)"><a href="'.$this->_tpl_vars['url_next'].'" ><i class="arr-down"  style="border-color: rgb(253,125,114) transparent transparent;" ></i></a></li>
        </ul>
    </div>


    <script type="text/javascript" src="/sink/js/pagebottom.js"></script>
    <script type="text/javascript" src="/sink/js/jquery.cookie.js"></script>
    <script language="JavaScript">
        var preview_page = "'.$this->_tpl_vars['url_previous'].'";
        var next_page = "'.$this->_tpl_vars['url_next'].'";
        var index_page = "'.$this->_tpl_vars['url_index'].'";
        var article_id = "'.$this->_tpl_vars['articleid'].'";
        var chapter_id = "'.$this->_tpl_vars['chapterid'].'";

        function jumpPage() {
            var event = document.all ? window.event : arguments[0];
            if (event.keyCode == 37) document.location = preview_page;
            if (event.keyCode == 39) document.location = next_page;
            if (event.keyCode == 13) document.location = index_page;
        }
        document.onkeydown=jumpPage;

        $(function(){
            var art_tit = "'.$this->_tpl_vars['articlename'].'";
            var chp_tit = "'.$this->_tpl_vars['chaptername'].'"
            var chp_url = document.URL;
            var art_url = "'.jieqi_geturl('article','chapter',$this->_tpl_vars['chapterid'],$this->_tpl_vars['articleid'],'0').'";
            var history;
            var json="[";
            var json1;
            var canAdd= true;
            if(!$.cookie("history")){
                history = $.cookie("history","[{art_tit:\\""+art_tit+"\\""+",art_url:\\""+art_url+"\\""+",chp_tit:\\""+chp_tit+"\\""+",chp_url:\\""+chp_url+"\\"}]",{expires:1, path: \'/\'});
            }else {
                history = $.cookie("history");
                json1 = eval("("+history+")");
                $(json1).each(function(){
                    if(this.art_tit==art_tit&&this.chp_tit==chp_tit){
                        canAdd=false;
                        return false;
                    }
                })
                if(canAdd){
                    $(json1).each(function(){
                        if(this.art_tit!=art_tit){
                            json = json + "{\\"art_tit\\":\\""+this.art_tit+"\\",\\"art_url\\":\\""+this.art_url+"\\",\\"chp_tit\\":\\""+this.chp_tit+"\\",\\"chp_url\\":\\""+this.chp_url+"\\"},";
                        }
                    })
                    json = json + "{\\"art_tit\\":\\""+art_tit+"\\",\\"art_url\\":\\""+art_url+"\\",\\"chp_tit\\":\\""+chp_tit+"\\",\\"chp_url\\":\\""+chp_url+"\\"}]";
                    $.cookie("history",json,{expires:1, path: \'/\'});
                }
            }
        });

    </script>
	<script>
$.get("/modules/article/articlevisit.php", {id:'.$this->_tpl_vars['article_id'].',number:13} );
$.get("/modules/article/lastread.php", {bn:"'.$this->_tpl_vars['articlename'].'"} );
	</script>
</body>
</html>';
?>