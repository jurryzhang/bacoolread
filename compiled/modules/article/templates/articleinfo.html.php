<?php
echo '
<link rel="stylesheet" type="text/css" href="/sink/css/bookmain.css" />

<body onselectstart="return false">
<div class="wrap clearfix">
    <div class="mainbox">
        <div class="main1">
            <div class="title">
                <a href="'.$this->_tpl_vars['url_articleinfo'].'" title="'.$this->_tpl_vars['articlename'].'����">
                    <b>&nbsp;'.$this->_tpl_vars['articlename'].'</b>
                </a>

                <i>'.$this->_tpl_vars['fullflag'].'</i>
                <span>|</span>

                <i>
                    <a href="'.$this->_tpl_vars['url_read'].'" title="'.$this->_tpl_vars['articlename'].'ȫ���Ķ�">
                        ȫ���Ķ�
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
                ��ţ�'.$this->_tpl_vars['articleid'].'
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
                                    �鿴Ŀ¼
                                </a>
                            </td>

                            <td>
                                <a id="readNow" href="'.jieqi_geturl('article','article',$this->_tpl_vars['articleid'],'read').'" alt="'.$this->_tpl_vars['articlename'].'�����½�,'.$this->_tpl_vars['articlename'].'Ŀ¼" class="but02">
                                    �����Ķ�
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'\');"  class="but03 btnDashang">
                                    ��������
                                </a>
                            </td>

                            <td>
                                <a  href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/hurry.php?id='.$this->_tpl_vars['articleid'].'\');" class="but04 btnCuigeng">
                                    �߸�����
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['url_uservote'].'\');" class="but04 btnTuijian">
                                    Ͷ�Ƽ�Ʊ
                                </a>
                            </td>

                            <td>
                                <a href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['url_bookcase'].'\');" class="but04 btnShujia">
                                    �������
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="title">
                    <a href="'.$this->_tpl_vars['jieqi_url'].'">
                        ��ҳ
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
                        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"slide":{"type":"slide","bdImg":"7","bdPos":"right","bdTop":"100"},"image":{"viewList":["weixin","qzone","tsina","sqq","tqq","tieba"],"viewText":"������","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["weixin","qzone","tsina","sqq","tqq","tieba"]}};with(document)0[(getElementsByTagName(\'head\')[0]||body).appendChild(createElement(\'script\')).src=\'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=\'+~(-new Date()/36e5)];
                    </script>

                    <p class="author">
                        ���ߣ�
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
					��ࣺ'.$this->_tpl_vars['agent'].'
					</p>

                    <div class="tabbox_bk">
                        <div class="tt1">
                            <ul class="tabs_bk" id="tabs1">
                                <li class="thistab">
                                    ��Ʒ���
                                </li>

                                <li class="">
                                    ��Ʒ��Ϣ
                                </li>

                                <li class="">
                                    ���߹���
                                </li>

                                <li class="">
                                    ��������
                                </li>
                            </ul>
                        </div>

                        <div class="tab_conbox_bk" id="tab_conbox1">
                            <div class="one" style="display: block; overflow: hidden;">
                                <p class="intro">
                                    '.htmlclickable($this->_tpl_vars['intro']).'
                                </p>

                                <p class="fr blue2 poi" id="zhan">
                                    +���չ��
                                </p>

                            </div>

                            <div class="two g3 dn" style="display: none;">
                                <dl class="clearfix">
                                    <dd><em>��Ʒ���</em>'.$this->_tpl_vars['sort'].'</dd>
                                    <!--<dd><em>��Ȩ�ṩ��</em>'.$this->_tpl_vars['poster'].'</dd>-->
                                    <dd><em>����״̬��</em>'.$this->_tpl_vars['fullflag'].'</dd>
                                    <dd><em>���ܵ����</em>'.$this->_tpl_vars['weekvisit'].'</dd>
                                    <dd><em>���µ����</em>'.$this->_tpl_vars['monthvisit'].'</dd>
                                    <dd><em>�ܵ������</em>'.$this->_tpl_vars['allvisit'].'</dd>
                                    <dd><em>�����Ƽ���</em>'.$this->_tpl_vars['monthvote'].'</dd>
                                    <dd><em>���Ƽ�����</em>'.$this->_tpl_vars['allvote'].'</dd>
                                    <dd><em>���ղ�����</em>'.$this->_tpl_vars['goodnum'].'</dd>
                                    <dd><em>���ʻ�����</em>'.$this->_tpl_vars['allflower'].'</dd>
                                    <dd><em>����Ʊ����</em>'.$this->_tpl_vars['allvipvote'].'</dd>
                                    <dd><em>ȫ�ĳ��ȣ�</em>'.$this->_tpl_vars['size_c'].'</dd>
                                    <dd><em>�����£�</em>'.date('Y-m-d',$this->_tpl_vars['lastupdate']).'</dd>
                                </dl>
                            </div>

                            <div class="three dn" style="display: none;">
                                <dl>
                                    ';
if($this->_tpl_vars['notice'] != ""){
echo htmlclickable($this->_tpl_vars['notice']);
}else{
echo '����������Ϣ��';
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
                            ��Ʒ���֣�
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
                                    ('.$this->_tpl_vars['ratenum'].'������)
                                </span>
                        </div>
                    </div>
                </div>

                <div class="tags" >��Ʒ��ǩ��';
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
                    <h3 class="t">��Ʒ��̬</h3>

                    <dl class="mulitline f-gray3 clearfix">
                        '.$this->_tpl_vars['jieqi_pageblocks']['8']['content'].'</dl>
                    <!--<a href="javascript:void(0);" class="tips_mov"></a>-->
                    <div class="ope2">
                        <a href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'\');" class="reward">������</a><a href="javascript:void(0);" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/hurry.php?id='.$this->_tpl_vars['articleid'].'\');" class="urge">�߸���</a>
                    </div>
                </div>
                <div class="bk_author">
                    <h3 class="t">�ҵķ�˿ֵ</h3>
                    '.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'

                </div>
            </div>
        </div>

        <div class="main3">
            <div class="middle">
                <div id="newChapterTabBox" class="tab">
                    <h2 class="tab2left choice">
                        <a id="newChapterTab" listid="newChapterList" href="javascript:" title="'.$this->_tpl_vars['articlename'].'�����½�">
                            ��������½�
                        </a>
                    </h2>

                    <h2 class="tab2right">
                        <a id="novelInfoTab" listid="novelInfo" href="javascript:" title="'.$this->_tpl_vars['articlename'].'����VIP">
                            ����VIP�½�
                        </a>
                    </h2>

                    <div class="tabnext">
                    </div>
                </div>

                <!-- �����½� -->
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
                        <a href="'.$this->_tpl_vars['url_lastchapter'].'" alt="'.$this->_tpl_vars['articlename'].'�����½�" class="read">
                            �Ķ����½�
                        </a>

                        <a href="'.$this->_tpl_vars['url_read'].'" class="index" alt="'.$this->_tpl_vars['articlename'].','.$this->_tpl_vars['articlename'].'�����½�,Ŀ¼">
                            Ŀ¼
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
                        <a href="'.$this->_tpl_vars['url_vipchapter'].'" alt="'.$this->_tpl_vars['articlename'].'�����½�" class="read">
                            �Ķ����½�
                        </a>

                        <a href="'.$this->_tpl_vars['url_read'].'" class="index" alt="'.$this->_tpl_vars['articlename'].','.$this->_tpl_vars['articlename'].'�����½�,Ŀ¼">
                            Ŀ¼
                        </a>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="boxs2">
                    <h2 class="t">
                        ¡���Ƽ�
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
                            <li class="giv01" onclick=\'donate(this)\' title="���" data-id="2" data-unit="��" data-desc="�ͺ�������ٽ���������ȡ����ʤ����" name="rid" data-value="'.$this->_tpl_vars['redroseprice'].'" data-icon="icon-jiubei" data-name="���">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv01.png" class="donate-item donate-item-1" alt="���">
                                <p>
                                    <span>'.$this->_tpl_vars['redrose'].'</span>��
                                </p>
                                <p>
                                    ���
                                </p>
                            </li>

                            <li class="giv01" onclick=\'donate(this)\' title="����" data-id="3" data-unit="��" data-desc="�����ƣ����ٽ���������ȡ����ʤ����" name="rid" data-value="'.$this->_tpl_vars['yellowroseprice'].'" data-icon="icon-zuanshi" data-name="����">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv02.png" class="donate-item donate-item-2" alt="����">
                                <p>
                                    <span>'.$this->_tpl_vars['yellowrose'].'</span>��
                                </p>
                                <p>
                                    ����
                                </p>
                            </li>
                            <li class="giv01" onclick=\'donate(this)\' title="����" data-id="4" data-unit="��" data-desc="�����ң����ٽ���������ȡ����ʤ����" name="rid" data-value="'.$this->_tpl_vars['blueroseprice'].'" data-icon="icon-car" data-name="����">

                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nv-giv01.png" class="donate-item donate-item-3" alt="����">
                                <p>
                                    <span>'.$this->_tpl_vars['bluerose'].'</span>��
                                </p>
                                <p>
                                    ����
                                </p>
                            </li>

                            <li class="giv01" onclick=\'donate(this)\' title="��ʯ" data-id="5" data-unit="ö" data-desc="����ʯ�����ٽ���������ȡ����ʤ����" name="rid" data-value="'.$this->_tpl_vars['whiteroseprice'].'" data-icon="icon-villa" data-name="��ʯ">

                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv03.png" class="donate-item donate-item-5" alt="��ʯ">
                                <p>
                                    <span>'.$this->_tpl_vars['whiterose'].'</span>ö
                                </p>
                                <p>
                                    ��ʯ
                                </p>
                            </li>

                            <li class="giv01" onclick=\'donate(this)\' title="����" data-id="6" data-unit="��" data-desc="�ͳ��ܣ����ٽ���������ȡ����ʤ����" name="rid" data-value="'.$this->_tpl_vars['blackroseprice'].'" data-icon="icon-villa" data-name="����">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv04.png" class="donate-item donate-item-5" alt="����">
                                <p>
                                    <span>'.$this->_tpl_vars['blackrose'].'</span>��
                                </p>
                                <p>
                                    ����
                                </p>
                            </li>

                            <li class="giv01 rt0" onclick=\'donate(this)\' title="���" data-id="7" data-unit="��" data-desc="�͹�ڣ����ٽ���������ȡ����ʤ����" name="rid" data-value="'.$this->_tpl_vars['greenroseprice'].'" data-icon="icon-aircraft" data-name="���">
                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/liwu/nan-giv05.png" class="donate-item donate-item-7" alt="���">
                                <p>
                                    <span>'.$this->_tpl_vars['greenrose'].'</span>��
                                </p>
                                <p>
                                    ���
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="giving-open top10">
                        <form name="frmgifts" id="frmgifts" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gifts.php?do=submit&authorid= '.$this->_tpl_vars['authorid'].'" method="post">
                            <div class="nums">
                                ��
                                <span class="bdbg">
			                            <input type="text" name="count" class="inputnum" onchange="changeRCount()" id="donate_count">
			                                <c id="donate_unit">��</c>
			                                <span class="cred rt10">
                                            </span>
                                            ��ֵ
                                            <span id="donate_gold" class="cred">
                                                '.$this->_tpl_vars['redroseprice'].'
                                            </span>
                                            '.$this->_tpl_vars['egoldname'].'
			                                <input type="hidden" class="text" id="donate_num" name="rnums" value="'.$this->_tpl_vars['redroseprice'].'" />
                                    </span>
                            </div>

                            <div class="bdinput top10">
                                <textarea class="textarea textarea-nan" id="donate_reply" name="reply" placeholder="�ͺ��1�������ٽ���������ȡ����ʤ����"></textarea>
                            </div>

                            <div class="clearfix">
                                <input type="hidden" name="act" value="post" />
                                '.$this->_tpl_vars['jieqi_token_input'].'
                                <input type="hidden" name="id" value="'.$this->_tpl_vars['articleid'].'" />
                                <input type="hidden" name="rid" id="rid" value="2">
                                <input type="submit" name="submit" value="����" class="inputbtn01 inputbtnnan rt10" />
                                ʣ�ࣺ<span class="cred">'.$this->_tpl_vars['jieqi_egold'].'</span>'.$this->_tpl_vars['egoldname'].',<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank" class="lf15 cyellow">ȥ��ֵ��</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix props-new top10">
                    <div class="props-newper">
                        <ul id="ul_proListTime">'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'���ͼ�¼', 'module'=>'article', 'filename'=>'block_actlog', 'classname'=>'BlockArticleActlog', 'side'=>'-1', 'title'=>'���ͼ�¼', 'vars'=>'addtime,10,0,$articleid,', 'template'=>'xin_block_actlog.html', 'contenttype'=>'4', 'custom'=>'0', 'publish'=>'3', 'hasvars'=>'1'), 1).'
                        </ul>
                    </div>
                </div>
            </div>

            <div class="right" style="margin-top: 20px;">
                <div class="boxs2">
                    <h2 class="t">
                        �����˿���а�
                    </h2>

                    <dl class="list_t22 f-black">
                        '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
                        <a href="http://www.mianfeidushu.com/modules/article/creditlist.php?id='.$this->_tpl_vars['articleid'].'" class="btn btn-more" target="_blank">
                            +�鿴��������&gt;&gt;
                        </a>
                    </dl>
                </div>
            </div>


            <div class="main4">
                <div class="cont-m fl">
                    <div class="bk_comment clearfix">
                        <div class="t">
                            <ul class="tabs_comm">
                                <li class="thistab">��������</li>
                            </ul>

                            <p class="fr g6 f14 pr10">
                                ��
                                <em class="b rd" id="count">
                                    '.$this->_tpl_vars['reviewsnum'].'
                                </em>
                                ������
                            </p>
                        </div>

                        <ul class="tab_conbox_comm">
                            <li class="tab_con_comm">
                                <dl class="list_comm" id="reviewcontent">
                                </dl>

                                <a href="'.$this->_tpl_vars['jieqi_url'].'/reviews/?aid='.$this->_tpl_vars['articleid'].'" id="loadreview" class="more f_blue5">
                                    ���ظ�������...
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--bk_comment end-->

                    <div class="commentbar mt10">
                        <div class="t">
                            <h3>
                                ���۱���
                            </h3>
                        </div>

                        <form name="review" id="review" method="post" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['articleid'].'">
                            <div class="comm_box down">
                                <div class="txt">
                                    <textarea name="pcontent" id="pcontent" placeholder="�����ʲô��..."></textarea>

                                    <div class="txt_r fix">
                                        <div class="face2 fix fl">
                                            <em class="iface" id="em'.$this->_tpl_vars['articleid'].'" title="����"></em>
                                            <div class="box_face dn" id="box'.$this->_tpl_vars['articleid'].'">
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_01.gif" title="�Ǻ�"/><!--onclick="javascript:inface(\'�Ǻ�\',\'pcontent\');"-->
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_02.gif" title="͵Ц"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_03.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_04.gif" title="˼��"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_05.gif" title="�ʺ�"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_06.gif" title="��"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_07.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_08.gif" title="��"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_09.gif" title="�Ǻ�"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_10.gif" title="�Ծ�"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_11.gif" title="˯"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_12.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_13.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_14.gif" title="��"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_15.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_16.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_17.gif" title="ok"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_18.gif" title="����"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_19.gif" title="��"/>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/images/smiles/f_20.gif" title="����"/>
                                            </div>
                                        </div>
                                        <!--face2 end-->

                                        <!--deliver begin-->
                                        <div class="deliver">
                                            <input id="btn_pcontent" name="dosubmit" type="submit" value="��������" class="btn_deliver" />

                                            ';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '
                                            <p>
                                                <img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" id="code_post" title="�������"/>
                                            </p>

                                            <input name="checkcode" id="checkcode" type="text" class="tit" placeholder="��֤��" />

                                            <label>��֤�룺</label>
                                            ';
}
echo '

                                            <font class="ibt" id="pcontentmsgLen">
                                                ������������
                                                <b id="fontnum" class="rd">
                                                    3000
                                                </b>
                                                ��
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
                        <h3 class="t">ɨ���ά���ע΢��</h3>
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
        //��ʼ����������
        //��������������һҳ
        addLoad(\'loadreview\',\'reviewcontent\');

        //���ؾ���������һҳ
        addLoad(\'loadgoodreview\',\'goodreviewcontent\');
        $(\'#loadreview\').trigger("click");
        $(\'#loadgoodreview\').trigger("click");
        //�ύ����
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

                        //�������������
                        window.scrollTo(0,764);								//�����������۴�
                        layer.close(i);
                        checkMsgLen(\'pcontent\');
                        $(\'.numb\').html(parseInt($(\'.numb\').html())+1);
                        $(\'#code_post\').attr(\'src\',$(\'#code_post\').attr(\'src\')+\'?rand=\'+Math.random());							//ˢ����֤��
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

        linum = $(\'.mainlist li\').length;//ͼƬ����
        w = linum*141.6;//ul���
        $(\'.piclist\').css(\'width\', w + \'px\');//ul���
        $(\'.swaplist\').html($(\'.mainlist\').html());//��������
        $(\'.changes\').click(function(){
            if($(\'.swaplist,.mainlist\').is(\':animated\')){
                $(\'.swaplist,.mainlist\').stop(true,true);
            }
            if($(\'.mainlist li\').length>5){//����4��ͼƬ
                ml = parseInt($(\'.mainlist\').css(\'left\'));//Ĭ��ͼƬulλ��
                sl = parseInt($(\'.swaplist\').css(\'left\'));//����ͼƬulλ��
                if(ml<=0 && ml>w*-1){//Ĭ��ͼƬ��ʾʱ
                    $(\'.swaplist\').css({left: \'1416px\'});//����ͼƬ������ʾ�����Ҳ�
                    $(\'.mainlist\').animate({left: ml - 708 + \'px\'},\'slow\');//Ĭ��ͼƬ����
                    if(ml==(w-708)*-1){//Ĭ��ͼƬ���һ��ʱ
                        $(\'.swaplist\').animate({left: \'0px\'},\'slow\');//����ͼƬ����
                    }
                }else{//����ͼƬ��ʾʱ
                    $(\'.mainlist\').css({left: \'1416px\'})//Ĭ��ͼƬ������ʾ������
                    $(\'.swaplist\').animate({left: sl - 708 + \'px\'},\'slow\');//����ͼƬ����
                    if(sl==(w-708)*-1){//����ͼƬ���һ��ʱ
                        $(\'.mainlist\').animate({left: \'0px\'},\'slow\');//Ĭ��ͼƬ����
                    }
                }
            }
        });
    });

    $("#em"+'.$this->_tpl_vars['articleid'].').on(\'click\',function(){//������л�
        $("#box"+'.$this->_tpl_vars['articleid'].').toggle();
    });
    $("#box"+'.$this->_tpl_vars['articleid'].').on(\'mouseleave\',function(){//���������
        $("#box"+'.$this->_tpl_vars['articleid'].').hide();
    });
    $("#box"+'.$this->_tpl_vars['articleid'].'+" img").on(\'click\',function(){//ѡ�����
        inface($(this).attr("title"),\'pcontent\');
    });
    $("#code_post").on(\'click\',function(){
        $(this).attr("src","'.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand="+Math.random());
    });
    $("#pcontent").on(\'keyup\',function(){
        checkMsgLen(this.id);
    });

    //abelId ��ǩID��ContainerId ����ID
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

            //���һҳ�ļ��ظ���ɾ��
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
                        $(\'#\'+abelId).text("��,û��������");
                        $(\'#\'+abelId).attr("disabled",true);
                    }
                }
            });
        });
    }

    //��ʾ�ظ��ͷ�ҳ��ʾ�ظ�
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

    //�ж�����
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

    //��ȡ�ַ����ȣ�����Ϊ2���ַ�
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

    //�ύ�ظ�
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
            $(this).html("-����۵�");
        },function(){
            $(this).parents("div.one").css("overflow","hidden");
            $(this).prev("p").css({overflow:"hidden",height:"110px"});
            $("div.bktop").css("height","470px;");
            $(this).html("+���չ��");
        });
        layer.tips(\'��˴��͸��ֱ��顣\',".reward", {
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