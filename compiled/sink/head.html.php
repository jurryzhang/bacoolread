<?php
echo '<div class="top fix">
    <div class="top_mini">
        <div class="wrap fix">
            <div class="userbar" id="userbar">
                <div class="headSerachBox">
                    <form action="/modules/article/search.php" method="post">
                        <input type="text" name="searchkey"   class="search_text" placeholder="键入书名、关键字开始搜索!">
                        <input type="submit" value="" class="search_button">
                    </form>
                </div>

                ';
if($this->_tpl_vars['jieqi_userid'] == 0){
echo '
                <div class="logn">欢迎访问，<span class="g9">请<a href="'.jieqi_geturl('users','users','login','0').'" class="f_blue5">登录</a>或<a href="'.jieqi_geturl('users','users','register','0').'" class="f_blue5">注册</a></span>
                    <a href="'.$this->_tpl_vars['jieqi_url'].'/api/qq/login.php" class="qq f_gray3r" title="QQ登录">&nbsp;</a>

                    <a href="'.$this->_tpl_vars['jieqi_url'].'/api/weibo/login.php" class="sina f_gray3r" title="微博登录">&nbsp;</a>

                    <a href="'.$this->_tpl_vars['jieqi_url'].'/api/weixin/login.php" class="wechat f_gray3r" title="微信登陆">&nbsp;</a></div>

                ';
}else{
echo '
                <script type="text/javascript" src="/sink/js/jquery.cookie.js"></script>
                <!--logined2  begin-->
                <div class="logined2">
                    <ul class="topmenu" clearfix="" id="jq_topmenu">
                        <li class="webnav" qxpp="" style="background:none">
                            <span class="icon_arr2"><em><img src="'.$this->_tpl_vars['jieqi_url'].'/files/badge/image/3/0/'.$this->_tpl_vars['jieqi_vip_img'].'.png" class="logvip" />'.$this->_tpl_vars['jieqi_username'].'</em></span>
                            <div class="jq_hidebox" id="jq_hidebox" style="display: none; " block;="">
                                <dl class="jq2">
                                    <dd class="dd1"><a href="'.$this->_tpl_vars['jieqi_url'].'/user/" class="f_black">个人中心</a></dd>
                                    <dd><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myarticle.php" class="f_black">作家中心</a></dd>
                                    <dd><a href="'.jieqi_geturl('users','users','useredit','0').'" class="f_black">账号管理</a></dd>
                                    <dd><a href="'.jieqi_geturl('users','users','setavatar','0').'" class="f_black">修改头像</a></dd>
                                    <dd><a href="'.jieqi_geturl('users','users','passedit','0').'" class="f_black">修改密码</a></dd>
                                    <dd><a href="/modules/pay/buyegold.php" class="f_black">充值</a></dd>
                                    <dd class="dd2"><a href="'.jieqi_geturl('users','users','logout','0').'" class="f_black">退出</a></dd>
                                </dl>
                            </div>
                        </li>
                        <li class="webnav" qxpp="" style="background:none">
                            <span class="icon_arr2">消息<em class="org">('.$this->_tpl_vars['jieqi_newmessage'].')</em></span>
                            <div class="jq_hidebox" id="jq_hidebox" style="display: none; " block;="">
                                <dl class="jq1">
                                    <dd><a href="/message.php?box=inbox" class="f_black">查看私信</a><em class="g9">您有<em class="org">'.$this->_tpl_vars['jieqi_newmessage'].'</em>条私信</em></dd>
                                </dl>
                            </div>
                        </li>
                        <li class="webnav" qxpp="" style="background:none">
                            <span class="icon_arr2">我的书架</span>
                            <div class="jq_hidebox" id="jq_hidebox" style="display: none; " block;="">
                                <div class="jq3 fix">
                                    <ul id="tabs9" class="tabmenu2 fix" >
                                        <li id="arl" class="brdl"><a href="javascript:;">书架记录</a></li>
                                        <li id="list"><a href="javascript:;">最近阅读</a></li>
                                    </ul>
                                    <ul id="tab_conbox9">
                                        <li style="display:none;" id="am">
                                            <dl class="lisd fix">
                                                '.jieqi_get_block(array('bid'=>'24', 'module'=>'article', 'filename'=>'block_ubookcase', 'classname'=>'BlockArticleUbookcase', 'side'=>'1', 'title'=>'我的书架', 'vars'=>'lastupdate,5,0,$jieqi_userid,0', 'template'=>'block_shujia.html', 'contenttype'=>'4', 'custom'=>'0', 'publish'=>'3', 'hasvars'=>'1'), 1).'


                                                <dd class="fix g9 noline tr"><a href="'.jieqi_geturl('article','bookcase','bookcase','0').'" class="f_blue1">查看更多&gt;&gt;</a></dd>
                                            </dl>

                                        </li>
                                        <li>
                                            <dl class="lisd fix" id="list2">
                                            </dl>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>|<a href="/logout.php" class="f_black">退出</a></li>
                    </ul>
                </div><!--logined2 end-->
                ';
}
echo '</div>
            <div class="mini_r f_gray3">
                <a href="'.$this->_tpl_vars['jieqi_url'].'/" onClick="window.external.addFavorite(this.href,this.title);return false;" title=\''.$this->_tpl_vars['jieqi_pagetitle'].'\' rel="sidebar" class="addfav">加入收藏</a>
                |<a href="javascript:;"  onclick=this.style.behavior="url(#default#homepage)";this.setHomePage("'.$this->_tpl_vars['jieqi_url'].'/");  class="sethome"  title="'.$this->_tpl_vars['jieqi_pagetitle'].'" >设为首页</a>
                |<a href="javascript:StranBody()" id="StranLink" name="StranLink" class="fan"  title="繁體">繁體</a>
                |<a href="#" title="帮助">帮助</a>
            </div>

        </div>
    </div>
</div>';
?>