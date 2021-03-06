<?php
echo '
<link rel="stylesheet" type="text/css" href="/sink/css/bookmain.css" />

<body onselectstart="return false">
<div class="wrap clearfix">
    <div class="mainbox">
        <div class="main1">
            <div class="title">
                <a href="'.$this->_tpl_vars['url_articleinfo'].'" title="'.$this->_tpl_vars['articlename'].'官网">
                    <b>&nbsp;'.$this->_tpl_vars['articlename'].'</b>
                </a>

                <i>'.$this->_tpl_vars['fullflag'].'</i>
                <span>|</span>

                <i>
                    <a href="'.$this->_tpl_vars['url_read'].'" title="'.$this->_tpl_vars['articlename'].'全文阅读">
                        全文阅读
                    </a>
                </i>
            </div>

            <div class="tag">
                <div class="y">
                    <a href="javascript:void(0)" title="'.$this->_tpl_vars['articlename'].'">
                        '.$this->_tpl_vars['isvip'].'
                    </a>
                </div>

                <div class="y">
                    <a href="javascript:void(0)" title="'.$this->_tpl_vars['articlename'].'">
                        '.$this->_tpl_vars['issign'].'
                    </a>
                </div>
            </div>

            <div class="auther">
                书号：'.$this->_tpl_vars['articleid'].'
            </div>
        </div>

        <div class="main2">
            <div class="left">
                <div class="cover">
                    <cite id="discountTag" style="display:none;">
                    </cite>

                    <em id="discountTime" style="display:none;">
                    </em>

                    <a href="'.$this->_tpl_vars['url_read'].'" class="bookcover"><img src="'.$this->_tpl_vars['url_simage'].'" width="204" height="255" alt="'.$this->_tpl_vars['articlename'].'">
                    </a>
                </div>

                <div class="button1">
                    <table width="216" height="100" border="0">
                        <tbody>
                        <tr>
                            <td>
                                <a class="but01" href="'.$this->_tpl_vars['url_read'].'">
                                    查看目录
                                </a>
                            </td>

                            <td>
                                <a id="readNow" href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'read').'" alt="'.$this->_tpl_vars['articlename'].'最新章节,'.$this->_tpl_vars['articlename'].'目录" class="but02">
                                    立即阅读
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'\');"  class="but03 btnDashang">
                                    打赏作者
                                </a>
                            </td>

                            <td>
                                <a  href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/hurry.php?id='.$this->_tpl_vars['articleid'].'\');" class="but04 btnCuigeng">
                                    催更作者
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['url_uservote'].'\');" class="but04 btnTuijian">
                                    投推荐票
                                </a>
                            </td>

                            <td>
                                <a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['url_bookcase'].'\');" class="but04 btnShujia">
                                    加入书架
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="title">
                    <a href="'.$this->_tpl_vars['jieqi_url'].'">
                        首页
                    </a>&gt;

                    <a href="'.jieqi_geturl('article','articlelist',$this->_tpl_vars['sortid']).'">
                        '.$this->_tpl_vars['sortname'].'
                    </a>&gt;

                    <strong>
                        <a href="'.$this->_tpl_vars['url_read'].'">
                            '.$this->_tpl_vars['articlename'].'
                        </a>
                    </strong>
                </div>

                <div class="bktop_r clearfix">
                    <h1>
                        '.$this->_tpl_vars['articlename'].'
                    </h1>

                    <script>
                        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"slide":{"type":"slide","bdImg":"7","bdPos":"right","bdTop":"100"},"image":{"viewList":["weixin","qzone","tsina","sqq","tqq","tieba"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["weixin","qzone","tsina","sqq","tqq","tieba"]}};with(document)0[(getElementsByTagName(\'head\')[0]||body).appendChild(createElement(\'script\')).src=\'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=\'+~(-new Date()/36e5)];
                    </script>

                    <p class="author">
                        作者：
                        ';
if($this->_tpl_vars['authorid'] > 0){
echo '
                        <a href="'.jieqi_geturl('system','user',$this->_tpl_vars['authorid']).'" target="_blank">
                            '.$this->_tpl_vars['author'].'
                        </a>
                        ';
}else{
echo '
                        '.$this->_tpl_vars['author'].'
                        ';
}
echo '
                    </p>
					<p class="author">
					责编：'.$this->_tpl_vars['agent'].'
					</p>

                    <div class="tabbox_bk">
                        <div class="tt1">
                            <ul class="tabs_bk" id="tabs1">
                                <li class="thistab">
                                    作品简介
                                </li>

                                <li class="">
                                    作品信息
                                </li>

                                <li class="">
                                    作者公告
                                </li>

                                <li class="">
                                    本书荣誉
                                </li>
                            </ul>
                        </div>

                        <div class="tab_conbox_bk" id="tab_conbox1">
                            <div class="one" style="display: block; overflow: hidden;">
                                <p class="intro">
                                    '.htmlclickable($this->_tpl_vars['intro']).'
                                </p>

                                <p class="fr blue2 poi" id="zhan">
                                    +点击展开
                                </p>

                            </div>

                            <div class="two g3 dn" style="display: none;">
                                <dl class="clearfix">
                                    <dd><em>作品类别：</em>'.$this->_tpl_vars['sort'].'</dd>
                                    <!--<dd><em>版权提供：</em>'.$this->_tpl_vars['poster'].'</dd>-->
                                    <dd><em>文章状态：</em>'.$this->_tpl_vars['fullflag'].'</dd>
                                    <dd><em>本周点击：</em>'.$this->_tpl_vars['weekvisit'].'</dd>
                                    <dd><em>本月点击：</em>'.$this->_tpl_vars['monthvisit'].'</dd>
                                    <dd><em>总点击数：</em>'.$this->_tpl_vars['allvisit'].'</dd>
                                    <dd><em>本月推荐：</em>'.$this->_tpl_vars['monthvote'].'</dd>
                                    <dd><em>总推荐数：</em>'.$this->_tpl_vars['allvote'].'</dd>
                                    <dd><em>总收藏数：</em>'.$this->_tpl_vars['goodnum'].'</dd>
                                    <dd><em>总鲜花数：</em>'.$this->_tpl_vars['allflower'].'</dd>
                                    <dd><em>总月票数：</em>'.$this->_tpl_vars['allvipvote'].'</dd>
                                    <dd><em>全文长度：</em>'.$this->_tpl_vars['size_c'].'</dd>
                                    <dd><em>最后更新：</em>'.date('Y-m-d',$this->_tpl_vars['lastupdate']).'</dd>
                                </dl>
                            </div>

                            <div class="three dn" style="display: none;">
                                <dl>
                                    ';
if($this->_tpl_vars['notice'] != ""){
echo htmlclickable($this->_tpl_vars['notice']);
}else{
echo '本书尚无信息！';
}
echo '
                                </dl>

                            </div>
                        </div>
                        <!--tab_conbox_bk end-->
                    </div>

                    <script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/rating.js"></script>

                    <div style="text-align:center;margin:20px 0px;">
                        <div class="ratediv"><b class="fl">
                            作品评分：
                        </b>
                            <div class="rateblock">
                                <script type="text/javascript">
                                    showRating('.$this->_tpl_vars['ratemax'].', '.$this->_tpl_vars['rateavg'].', \'rating\', \''.$this->_tpl_vars['articleid'].'\');
                                    function rating(score, id){
                                        //Ajax.Request( \''.$this->_tpl_vars['article_dynamic_url'].'/rating.php?score=\'+score+\'&id=\'+id,{onComplete:function(){alert(this.response.replace(/<br[^<>]*>/g,\'\\n\'));}});
                                        GPage.addbook(\''.$this->_tpl_vars['article_dynamic_url'].'/rating.php?score=\'+score+\'&id=\'+id);
                                    }
                                </script>
                            </div>

                            <span class="ratenum">
                                    '.$this->_tpl_vars['rateavg'].'
                                </span>

                            <span class="gray">
                                    ('.$this->_tpl_vars['ratenum'].'人已评)
                                </span>
                        </div>
                    </div>
                </div>

                <div class="tags" >作品标签：';
if (empty($this->_tpl_vars['tagrows'])) $this->_tpl_vars['tagrows'] = array();
elseif (!is_array($this->_tpl_vars['tagrows'])) $this->_tpl_vars['tagrows'] = (array)$this->_tpl_vars['tagrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['tagrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['tagrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['tagrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['tagrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['tagrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/search.php?searchtype=keywords&searchkey='.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['tagencode'].'" target="_blank">
                        '.$this->_tpl_vars['tagrows'][$this->_tpl_vars['i']['key']]['tagname'].'
                    </a>
                    ';
}
echo '
                </div>
            </div>

            <div class="right">
                <div class="moving">
                    <h3 class="t">作品动态</h3>

                    <dl class="mulitline f-gray3 clearfix">
                        '.$this->_tpl_vars['jieqi_pageblocks']['8']['content'].'</dl>
                    <!--<a href="javascript:void(0);" class="tips_mov"></a>-->
                    <div class="ope2">
                        <a href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'\');" class="reward">打赏书</a><a href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/hurry.php?id='.$this->_tpl_vars['articleid'].'\');" class="urge">催更新</a>
                    </div>
                </div>
                <div class="bk_author">
                    <h3 class="t">我的粉丝值</h3>
                    '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'

                </div>
            </div>
        </div>

        <div class="main3">
            <div class="middle">
                <div id="newChapterTabBox" class="tab">
                    <h2 class="tab2left choice">
                        <a id="newChapterTab" listid="newChapterList" href="javascript:" title="'.$this->_tpl_vars['articlename'].'最新章节">
                            最新免费章节
                        </a>
                    </h2>

                    <h2 class="tab2right">
                        <a id="novelInfoTab" listid="novelInfo" href="javascript:" title="'.$this->_tpl_vars['articlename'].'最新VIP">
                            最新VIP章节
                        </a>
                    </h2>

                    <div class="tabnext">
                    </div>
                </div>

                <!-- 最新章节 -->
                <div id="newChapterList" class="swishlist"><div class="chaptername">
                    <b>
                        <a href="'.$this->_tpl_vars['url_lastchapter'].'" class="green">
                            ';
if($this->_tpl_vars['lastvolume'] != ''){
echo $this->_tpl_vars['lastvolume'].' ';
}
echo $this->_tpl_vars['lastchapter'].'
                        </a>
                    </b>
                    <span>
                        </span>

                </div>
                    <div class="chapternev">
                        <a href="'.$this->_tpl_vars['url_lastchapter'].'" rel="nofollow">
                            '.truncate(strip_tags($this->_tpl_vars['lastsummary']),'460','..').'
                        </a>
                    </div>

                    <div class="btnlist">
                        <a href="'.$this->_tpl_vars['url_lastchapter'].'" alt="'.$this->_tpl_vars['articlename'].'最新章节" class="read">
                            阅读此章节
                        </a>

                        <a href="'.$this->_tpl_vars['url_read'].'" class="index" alt="'.$this->_tpl_vars['articlename'].','.$this->_tpl_vars['articlename'].'最新章节,目录">
                            目录
                        </a>
                    </div>
                </div>

                <div id="novelInfo" class="swishlist" style="display:none">
                    <div class="chaptername">
                        <b>
						 
                                <span>&nbsp;&nbsp;VIP&nbsp; </span>
                           
                            <a href="'.$this->_tpl_vars['url_vipchapter'].'" class="green">
                                ';
if($this->_tpl_vars['vipvolume'] != ''){
echo $this->_tpl_vars['vipvolume'].' ';
}
echo $this->_tpl_vars['vipchapter'].'
                            </a>
                        </b>
                       
                    </div>

                    <div class="chapternev">
                        <a href="'.$this->_tpl_vars['url_vipchapter'].'" rel="nofollow">
                            '.truncate(strip_tags($this->_tpl_vars['vipsummary']),'460','..').'
                        </a>
                    </div>

                    <div class="btnlist">
                        <a href="'.$this->_tpl_vars['url_vipchapter'].'" alt="'.$this->_tpl_vars['articlename'].'最新章节" class="read">
                            阅读此章节
                        </a>

                        <a href="'.$this->_tpl_vars['url_read'].'" class="index" alt="'.$this->_tpl_vars['articlename'].','.$this->_tpl_vars['articlename'].'最新章节,目录">
                            目录
                        </a>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="boxs2">
                    <h2 class="t">
                        隆重推荐
                    </h2>

                    <dl class="list_t22 f-black">
                        '.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'
                    </dl>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function ()
            {
                $(\'#newChapterTab, #novelInfoTab\').on(\'click\', function ()
                {
                    var $this = $(this);

                    $(\'#newChapterTabBox h2\').removeClass(\'choice\');
                    $this.parent().addClass(\'choice\');

                    $(\'#newChapterList, #novelInfo\').hide();
                    $(\'#\' + $this.attr(\'listid\')).show();
                });
            });
        </script>

        <style>
            .top10{margin-top:10px}
            .props-nan-con,.props-nv-con{border:1px solid #d0f1ef;padding:20px 30px}
            .top20{margin-top:20px;margin-bottom:20px}
            .props-con{background-color:#fff;padding-top:20px;width:787px;float: left;}
            .giving li span{color:#ff2c2c}
            .giving li{float:left;width:102px;-moz-box-flex:1;-webkit-box-flex:1;box-flex:1;box-sizing:border-box;border:1px solid #fff;text-align:center;margin:0 10px 0 5px;padding:0 0 10px 0}
            .giving li a{display:inline-block}
            .giving li.giv05{margin-right:0}
            .giving li p{line-height:1.5em}
            .giving-open{border-top:1px solid #d1d1d1;padding:10px 0 0 0}
            .givingflower li,.givingticket li{float:left;margin-right:12px;display:inline}
            .givingflower a,.givingticket a{width:48px;height:48px;background:url(/Public/images/img.png) no-repeat -123px -118px;display:inline-block;font-size:0}
            .givingflower a.selected,.givingflower a:hover{background-position:-65px -118px}
            .givingticket a{background-position:-218px -118px;display:inline-block;font-size:0}
            .givingticket a.selected,.givingticket a:hover{background-position:-170px -118px}
            .givingflower .right,.givingticket .right .add{width:80px;display:inline-table}
            .givingflower .right .add,.givingticket .right .add{width:20px;height:42px;-webkit-border-top-left-radius:10px;-webkit-border-top-right-radius:0;-webkit-border-bottom-right-radius:0;-webkit-border-bottom-left-radius:10px;-moz-border-radius-topleft:10px;-moz-border-radius-topright:0;-moz-border-radius-bottomright:0;-moz-border-radius-bottomleft:10px;border-top-left-radius:10px;border-top-right-radius:0;border-bottom-right-radius:0;border-bottom-left-radius:10px;float:left;background:url(/Public/images/img.png) no-repeat -285px -118px;background-color:#f0f0f0;cursor:pointer}
            .givingflower .right .inputnum,.givingticket .right .inputnum{width:30px;display:inline-table;border:1px
            solid #ccc;border-radius:0;float:left;padding:0;height:40px}
            .givingflower .right .reduce,.givingticket .right .reduce{width:20px;height:42px;float:left;-webkit-border-top-left-radius:0;-webkit-border-top-right-radius:10px;-webkit-border-bottom-right-radius:10px;-webkit-border-bottom-left-radius:0-moz-border-radius-topleft:0px;-moz-border-radius-topright:10px;-moz-border-radius-bottomright:10px;-moz-border-radius-bottomleft:0;border-top-left-radius:0;border-top-right-radius:10px;border-bottom-right-radius:10px;border-bottom-left-radius:0;background:url(/Public/images/img.png) no-repeat -285px -163px;background-color:#f0f0f0;cursor:pointer}
            .liwu{overflow:hidden;height:166px}
            .giving-open{border-top:1px solid #d1d1d1;padding:10px 0 0 0}
            .bdbg{background-color:#f0f0f0;border-radius:4px;width:200px;height:36px;display:inline-block;padding:4px 6px;margin:0 5px}
            .add,.reduce{display:inline-table;width:24px;height:24px;border-radius:15px;background-color:#f0f0f0;border:1px solid #b4b4b4;text-align:center;vertical-align:middle;font-size:28px;font-weight:400;line-height:20px}
            .inputnum{width:24px;height:24px;border:1px solid #b4b4b4;text-align:center}
            .textarea{width:725px;height:68px;padding: 8px}
            .inputbtn01{margin-right:0;background-color:#bf040a;margin-left:20px;color:#fff;border:1px solid #bf040a}
            .inputbtn01{width:100px;height:36px;line-height:36px;font-size:14px;border-radius:4px;color:#fff;text-align:center;cursor:pointer}
            .props-new{border-top:1px solid #d1d1d1;padding-top:15px}
            .props-newper,props-topper{float:left;width:100%;-moz-box-flex:1;-webkit-box-flex:1;box-flex:1;box-sizing:border-box;height:94px;margin-right:1%;display:inline}
            .props-newper ul,.props-topper ul{width:750px;float:left}
            .props-newper ul li,.props-topper ul li{width:9.333%;float:left;text-align:center;position:relative}
            .props-newper ul li.right{float: right;}
            .props-newper span,.props-topper span{width:60px;float:left;height:100%;display:inline-block}
            .props-newper .photo,.props-newper .prop,.props-topper .photo,.props-topper .prop{border:solid 2px #d0d0d0;-moz-border-radius:100%;-webkit-border-radius:100%;border-radius:100%}
            .props-newper .photo,.props-topper .photo{width:48px;height:48px;overflow:hidden;margin:0 auto;margin-top:10px}
            .props-newper .photo a,.props-newper .prop,.props-topper .photo a,.props-topper .prop{display:block;width:100%;height:100%;-webkit-border-radius:100%;-moz-border-radius:100%;border-radius:100%;-webkit-background-clip:padding-box;background-clip:padding-box}
            .props-newper .photo a img,.props-newper .prop img,.props-topper .photo a img,.props-topper .prop img{width:100%;height:100%}
            .props-newper .name,.props-topper .name{height:30px;line-height:30px;overflow:hidden;text-align:center}
            .props-newper .prop,.props-topper .prop{width:24px;height:24px;overflow:hidden;position:absolute;left:5px;top:0}
            .props-newper .prop-num,.props-topper .prop-num{position:absolute;left:30px;top:-7px}
        </style>

        <div class="main4">
            <div class="props-con props-nan-con top20 clearfix">
                <div class="liwu">
                    <div class="giving clearfix">
                        <ul>
                            <li class="giv01" onclick=\'donate(this)\' title="红包" data-id="2" data-unit="个" data-desc="赏红包，望再接再厉，争取更大胜利！" name="rid" data-value="'.$this->_tpl_vars['redroseprice'].'" data-icon="icon-jiubei" data-name="红包">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv01.png" class="donate-item donate-item-1" alt="红包">
                                <p>
                                    <span>'.$this->_tpl_vars['redrose'].'</span>个
                                </p>
                                <p>
                                    红包
                                </p>
                            </li>

                            <li class="giv01" onclick=\'donate(this)\' title="美酒" data-id="3" data-unit="杯" data-desc="赏美酒，望再接再厉，争取更大胜利！" name="rid" data-value="'.$this->_tpl_vars['yellowroseprice'].'" data-icon="icon-zuanshi" data-name="美酒">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv02.png" class="donate-item donate-item-2" alt="美酒">
                                <p>
                                    <span>'.$this->_tpl_vars['yellowrose'].'</span>杯
                                </p>
                                <p>
                                    美酒
                                </p>
                            </li>
                            <li class="giv01" onclick=\'donate(this)\' title="香囊" data-id="4" data-unit="个" data-desc="赏香囊，望再接再厉，争取更大胜利！" name="rid" data-value="'.$this->_tpl_vars['blueroseprice'].'" data-icon="icon-car" data-name="香囊">

                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nv-giv01.png" class="donate-item donate-item-3" alt="香囊">
                                <p>
                                    <span>'.$this->_tpl_vars['bluerose'].'</span>个
                                </p>
                                <p>
                                    香囊
                                </p>
                            </li>

                            <li class="giv01" onclick=\'donate(this)\' title="钻石" data-id="5" data-unit="枚" data-desc="赏钻石，望再接再厉，争取更大胜利！" name="rid" data-value="'.$this->_tpl_vars['whiteroseprice'].'" data-icon="icon-villa" data-name="钻石">

                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv03.png" class="donate-item donate-item-5" alt="钻石">
                                <p>
                                    <span>'.$this->_tpl_vars['whiterose'].'</span>枚
                                </p>
                                <p>
                                    钻石
                                </p>
                            </li>

                            <li class="giv01" onclick=\'donate(this)\' title="超跑" data-id="6" data-unit="辆" data-desc="赏超跑，望再接再厉，争取更大胜利！" name="rid" data-value="'.$this->_tpl_vars['blackroseprice'].'" data-icon="icon-villa" data-name="超跑">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv04.png" class="donate-item donate-item-5" alt="超跑">
                                <p>
                                    <span>'.$this->_tpl_vars['blackrose'].'</span>辆
                                </p>
                                <p>
                                    超跑
                                </p>
                            </li>

                            <li class="giv01 rt0" onclick=\'donate(this)\' title="桂冠" data-id="7" data-unit="顶" data-desc="赏桂冠，望再接再厉，争取更大胜利！" name="rid" data-value="'.$this->_tpl_vars['greenroseprice'].'" data-icon="icon-aircraft" data-name="桂冠">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv05.png" class="donate-item donate-item-7" alt="桂冠">
                                <p>
                                    <span>'.$this->_tpl_vars['greenrose'].'</span>顶
                                </p>
                                <p>
                                    桂冠
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="giving-open top10">
                        <form name="frmgifts" id="frmgifts" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gifts.php?do=submit&authorid= '.$this->_tpl_vars['authorid'].'" method="post">
                            <div class="nums">
                                送
                                <span class="bdbg">
			                            <input type="text" name="count" class="inputnum" onchange="changeRCount()" id="donate_count">
			                                <c id="donate_unit">个</c>
			                                <span class="cred rt10">
                                            </span>
                                            价值
                                            <span id="donate_gold" class="cred">
                                                '.$this->_tpl_vars['redroseprice'].'
                                            </span>
                                            '.$this->_tpl_vars['egoldname'].'
			                                <input type="hidden" class="text" id="donate_num" name="rnums" value="'.$this->_tpl_vars['redroseprice'].'" />
                                    </span>
                            </div>

                            <div class="bdinput top10">
                                <textarea class="textarea textarea-nan" id="donate_reply" name="reply" placeholder="赏红包1个，望再接再厉，争取更大胜利！"></textarea>
                            </div>

                            <div class="clearfix">
                                <input type="hidden" name="act" value="post" />
                                '.$this->_tpl_vars['jieqi_token_input'].'
                                <input type="hidden" name="id" value="'.$this->_tpl_vars['articleid'].'" />
                                <input type="hidden" name="rid" id="rid" value="2">
                                <input type="submit" name="submit" value="赠送" class="inputbtn01 inputbtnnan rt10" />
                                剩余：<span class="cred">'.$this->_tpl_vars['jieqi_egold'].'</span>'.$this->_tpl_vars['egoldname'].',<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank" class="lf15 cyellow">去充值》</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix props-new top10">
                    <div class="props-newper">
                        <ul id="ul_proListTime">'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'打赏记录', 'module'=>'article', 'filename'=>'block_actlog', 'classname'=>'BlockArticleActlog', 'side'=>'-1', 'title'=>'打赏记录', 'vars'=>'addtime,10,0,$articleid,', 'template'=>'xin_block_actlog.html', 'contenttype'=>'4', 'custom'=>'0', 'publish'=>'3', 'hasvars'=>'1'), 1).'
                        </ul>
                    </div>
                </div>
            </div>

            <div class="right" style="margin-top: 20px;">
                <div class="boxs2">
                    <h2 class="t">
                        本书粉丝排行榜
                    </h2>

                    <dl class="list_t22 f-black">
                        '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
                        <a href="http://www.mianfeidushu.com/modules/article/creditlist.php?id='.$this->_tpl_vars['articleid'].'" class="btn btn-more" target="_blank">
                            +查看更多排名&gt;&gt;
                        </a>
                    </dl>
                </div>
            </div>


            <div class="main4">
                <div class="cont-m fl">
                    <div class="bk_comment clearfix">
                        <div class="t">
                            <ul class="tabs_comm">
                                <li class="thistab">最新评论</li>
                            </ul>

                            <p class="fr g6 f14 pr10">
                                共
                                <em class="b rd" id="count">
                                    '.$this->_tpl_vars['reviewsnum'].'
                                </em>
                                条评论
                            </p>
                        </div>

                        <ul class="tab_conbox_comm">
                            <li class="tab_con_comm">
                                <dl class="list_comm" id="reviewcontent">
                                </dl>

                                <a href="'.$this->_tpl_vars['jieqi_url'].'/reviews/?aid='.$this->_tpl_vars['articleid'].'" id="loadreview" class="more f_blue5">
                                    加载更多评论...
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--bk_comment end-->

                    <div class="commentbar mt10">
                        <div class="t">
                            <h3>
                                评论本书
                            </h3>
                        </div>

                        <form name="review" id="review" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'">
                            <div class="comm_box down">
                                <div class="txt">
                                    <textarea name="pcontent" id="pcontent" placeholder="发表点什么吧..."></textarea>

                                    <div class="txt_r fix">
                                        <div class="face2 fix fl">
                                            <em class="iface" id="em'.$this->_tpl_vars['articleid'].'" title="表情"></em>
                                            <div class="box_face dn" id="box'.$this->_tpl_vars['articleid'].'">
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_01.gif" title="呵呵"/><!--onclick="javascript:inface(\'呵呵\',\'pcontent\');"-->
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_02.gif" title="偷笑"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_03.gif" title="花心"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_04.gif" title="思考"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_05.gif" title="问号"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_06.gif" title="汗"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_07.gif" title="伤心"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_08.gif" title="哼"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_09.gif" title="呵呵"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_10.gif" title="吃惊"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_11.gif" title="睡"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_12.gif" title="闭嘴"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_13.gif" title="爱你"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_14.gif" title="泪"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_15.gif" title="鄙视"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_16.gif" title="鼓掌"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_17.gif" title="ok"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_18.gif" title="握手"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_19.gif" title="求"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_20.gif" title="可怜"/>
                                            </div>
                                        </div>
                                        <!--face2 end-->

                                        <!--deliver begin-->
                                        <div class="deliver">
                                            <input id="btn_pcontent" name="dosubmit" type="submit" value="发表评论" class="btn_deliver" />

                                            ';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
                                            <p>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" id="code_post" title="点击更新"/>
                                            </p>

                                            <input name="checkcode" id="checkcode" type="text" class="tit" placeholder="验证码" />

                                            <label>验证码：</label>
                                            ';
}
echo '

                                            <font class="ibt" id="pcontentmsgLen">
                                                您还可以输入
                                                <b id="fontnum" class="rd">
                                                    3000
                                                </b>
                                                字
                                            </font>

                                            <input type="hidden" name="action" id="action" value="newpost" />
                                        </div><!--deliver end-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--commentbar end-->
                </div>

                <div class="right">
                    <div class="boxs2">
                        <h3 class="t">扫描二维码关注微信</h3>
                    </div>

                    <img id="QRcode" src="/sink/image/weixin.jpg" width="200px" height="208px">
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/sink/js/page.js"></script>
<script type="text/javascript">
    $(function(){
        //初始化最新评论
        //加载最新评论下一页
        addLoad(\'loadreview\',\'reviewcontent\');

        //加载精华评论下一页
        addLoad(\'loadgoodreview\',\'goodreviewcontent\');
        $(\'#loadreview\').trigger("click");
        $(\'#loadgoodreview\').trigger("click");
        //提交评论
        $(\'#review\').on(\'submit\', function(e){
            e.preventDefault();
            if(getUserId()<1){
                userLogin();
            }else{
                var i = layer.load(0);
                GPage.postForm(\'review\', $("#review").attr("action"), function(data){
                    if(data.status==\'OK\'){
                        layer.msg(data.msg,1,{type:1,shade:false},function(){});
                        $.ajaxSetup ({ cache: false });
                        GPage.loadpage(\'reviewcontent\',\''.$this->_tpl_vars['jieqi_url'].'/modules/article/reviews_js.php?aid='.$this->_tpl_vars['articleid'].'&ajax_request\');
                        document.getElementById("review").reset();

                        //清空输入框的文字
                        window.scrollTo(0,764);								//跳到最新评论处
                        layer.close(i);
                        checkMsgLen(\'pcontent\');
                        $(\'.numb\').html(parseInt($(\'.numb\').html())+1);
                        $(\'#code_post\').attr(\'src\',$(\'#code_post\').attr(\'src\')+\'?rand=\'+Math.random());							//刷新验证码
                    }else{
                        layer.close(i);
                        layer.alert(data.msg, 8, !1);
                    }
                });
            }
        });
        $(".tt").live({mouseenter:function(){
            $(this).find(".tt_r").show();
        },mouseleave:function(){
            $(this).find(".tt_r").hide();
        }});


        $(\'.og_prev,.og_next\').hover(function(){
            $(this).fadeTo(\'fast\',1);
        },function(){
            $(this).fadeTo(\'fast\',0.7);
        });

        linum = $(\'.mainlist li\').length;//图片数量
        w = linum*141.6;//ul宽度
        $(\'.piclist\').css(\'width\', w + \'px\');//ul宽度
        $(\'.swaplist\').html($(\'.mainlist\').html());//复制内容
        $(\'.changes\').click(function(){
            if($(\'.swaplist,.mainlist\').is(\':animated\')){
                $(\'.swaplist,.mainlist\').stop(true,true);
            }
            if($(\'.mainlist li\').length>5){//多于4张图片
                ml = parseInt($(\'.mainlist\').css(\'left\'));//默认图片ul位置
                sl = parseInt($(\'.swaplist\').css(\'left\'));//交换图片ul位置
                if(ml<=0 && ml>w*-1){//默认图片显示时
                    $(\'.swaplist\').css({left: \'1416px\'});//交换图片放在显示区域右侧
                    $(\'.mainlist\').animate({left: ml - 708 + \'px\'},\'slow\');//默认图片滚动
                    if(ml==(w-708)*-1){//默认图片最后一屏时
                        $(\'.swaplist\').animate({left: \'0px\'},\'slow\');//交换图片滚动
                    }
                }else{//交换图片显示时
                    $(\'.mainlist\').css({left: \'1416px\'})//默认图片放在显示区域右
                    $(\'.swaplist\').animate({left: sl - 708 + \'px\'},\'slow\');//交换图片滚动
                    if(sl==(w-708)*-1){//交换图片最后一屏时
                        $(\'.mainlist\').animate({left: \'0px\'},\'slow\');//默认图片滚动
                    }
                }
            }
        });
    });

    $("#em"+'.$this->_tpl_vars['articleid'].').on(\'click\',function(){//表情层切换
        $("#box"+'.$this->_tpl_vars['articleid'].').toggle();
    });
    $("#box"+'.$this->_tpl_vars['articleid'].').on(\'mouseleave\',function(){//表情层隐藏
        $("#box"+'.$this->_tpl_vars['articleid'].').hide();
    });
    $("#box"+'.$this->_tpl_vars['articleid'].'+" img").on(\'click\',function(){//选择表情
        inface($(this).attr("title"),\'pcontent\');
    });
    $("#code_post").on(\'click\',function(){
        $(this).attr("src","'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand="+Math.random());
    });
    $("#pcontent").on(\'keyup\',function(){
        checkMsgLen(this.id);
    });

    //abelId 标签ID，ContainerId 容器ID
    function addLoad(abelId,ContainerId){
        var i = 1;
        $(\'#\'+abelId).on(\'click\',function(e){
            e.preventDefault();
            var ii = layer.load(0);
            var loadurl = this.href;
            if (loadurl.indexOf("display=") < 0)
            {
                loadurl = this.href +"&page="+i;
            }else{
                loadurl = this.href +"&page="+i;
            }

            if(i == $(this).attr("page"))
            {
                $(this).remove();
            }

            //最后一页的加载更多删除
            GPage.getJson(urlParams(loadurl,\'ajax_gets=\'+ContentTag),function(data)
            {
                if ($.trim(data) != "")
                {
                    $(\'#\'+ContainerId).html($(\'#\'+ContainerId).html()+data);
                    i++;
                    layer.close(ii);

                    if($("input[name=\'"+abelId+"_has_next_page\']:last").val() == 0)
                    {
                        $(\'#\'+abelId).die(\'click\');
                        $(\'#\'+abelId).text("亲,没有评论了");
                        $(\'#\'+abelId).attr("disabled",true);
                    }
                }
            });
        });
    }

    //显示回复和分页显示回复
    function showReplies(_this, url, show)
    {
        var relayid = "show"+_this.id;
        if(show!=\'1\') $("#"+relayid).toggle();
        GPage.loadpage(relayid, url);
    }
    function inface(str,tag){
        if(str!=\'\'){
            var str = "["+str+"]";
            var obj=document.getElementById(tag);
            if(document.selection){
                obj.focus();
                var sel=document.selection.createRange();
                document.selection.empty();
                sel.text=str;
            }else{
                var prefix,main,suffix;
                prefix=obj.value.substring(0,obj.selectionStart);
                main=obj.value.substring(obj.selectionStart,obj.selectionEnd);
                suffix=obj.value.substring(obj.selectionEnd);
                obj.value=prefix+str+suffix;
            }
            obj.focus();
        }
        checkMsgLen(tag);
    }

    //判定字数
    function checkMsgLen(tag){
        var content=$(\'#\'+tag).val();
        try{
            var len=GetLength(content);
            var strTag = tag+\'msgLen\';
            if(len>150){
                $(\'#\'+strTag+\' #fontnum\').html(len-150);
            }else{
                var n=150-len;
                $(\'#\'+strTag+\' #fontnum\').html(n)
            }
        }catch(e){
            return false;
        }
    }

    //获取字符长度，中文为2个字符
    function GetLength(str){
        var realLength=0;
        var n=str.length;
        var len=0;
        for(var i=0;i<n;i++){
            var ns=str[i];
            if(ns==null){
                ns=str.substring(i,i+1);
            }
            if(ns.match(/[^\\x00-\\xff]/ig)!=null){
                len+=2;
            }else{
                len+=1;
            }
        }
        len=parseInt(len/2);
        return len;
    }

    //提交回复
    function submit_reply(_this){
        var url = $(_this).attr("action");
        if(getUserId()<1){
            userLogin();
        }else{
            GPage.postForm(\'reply\'+_this.rid.value,url,function(data){
                if(data.status==\'OK\'){
                    addreplise(_this.rid.value+\'span\');
                    GPage.loadpage(\'show\'+_this.rid.value,_this.get_reply_url.value);
                }else{
                    layer.alert(data.msg, 8, !1);
                }
            });
        }
        return false;
    }

    function addreplise(obj){
        $(\'#\'+obj).html(parseInt($(\'#\'+obj).html())+1) ;
    }
    $(function(){
        $(\'#zhan\').toggle(function(){
            $(this).parents("div.one").css("overflow","visible");
            $(this).prev("p").css({overflow:"auto",height:"170px"});
            $("div.bktop").css("height","auto");
            $(this).html("-点击折叠");
        },function(){
            $(this).parents("div.one").css("overflow","hidden");
            $(this).prev("p").css({overflow:"hidden",height:"110px"});
            $("div.bktop").css("height","470px;");
            $(this).html("+点击展开");
        });
        layer.tips(\'点此打赏个持本书。\',".reward", {
            style: [\'background-color:#78BA32; color:#fff\', \'#78BA32\'],
            maxWidth:185,
            guide:2,
            closeBtn:[0, true]
        });
    });
    $("#wantreward").click(function(){
        showRewardLayer();
    });

    $(".liwu li").click(function() {
        var me = $(this);
        $(".liwu li.active").removeClass("active");
        $(this).addClass("active");
        $("#rid").val(me.data("id"));
        $("#count").val(1);
        $("#rnums").val(me.data("nums"));
        $("#rdesc").val(me.data("desc"));
        $("#rname").text(me.data("name"));
        $("#tnums").text(me.data("nums"));
    });
</script>

<script type="text/javascript">
    function donate(obj){
        var flag = $(obj).hasClass("active");
        var height = 349;
        if(flag)
        {
            height = 166;

        }else{
            $(".giving-open .giv01").removeClass("active");
            $("#donate_count").val(1);
            $("#donate_id").val($(obj).data(\'type\'));
            $("#donate_num").val($(obj).data(\'value\'));
            $("#donate_gold").text($(obj).data(\'value\'));
            $("#donate_unit").text($(obj).data(\'unit\'));
            $("#donate_reply").val($(obj).data(\'desc\'));
        }
        $(obj).toggleClass("active");
        $(".liwu").animate({height:height+"px"});
    }
    function changeRCount() {
        var count = $("#donate_count").val();
        var nums = $("#donate_num").val();
        if (count <= 1) {
            $("#donate_count").val(1);
            count = 1;
        }
        $("#donate_gold").text(nums * count);
    }
</script>';
?>