<?php
echo '
<div id="content"><link href="/sink/css/user.css" type="text/css" rel="stylesheet">

<!--wrap begin-->
<div class="wrap2">
  <script type="text/javascript">
$(function(){
	
  var ss = \'userhub\'+\'_\'+\'\';
  if(ss == \'userhub_inbox\' || ss == \'userhub_outbox\' || ss == \'userhub_draft\' || ss == \'userhub_toSysView\' || ss == \'userhub_messagedetail\'){
      $(\'#userhub_newmessage\').parent("dl.list_menu").show();
	  $(\'#userhub_newmessage\').children("a").addClass("focus");
  }
  if(ss == \'chapter_cmView\'){
      $(\'#article_masterPage\').parent("dl.list_menu").show();
	  $(\'#article_masterPage\').children("a").addClass("focus");
  }
//  if(\'\' == \'upaView\'){
//      $(\'#userhub_usereditView\').parent("dl.list_menu").show();
//	  $(\'#userhub_usereditView\').children("a").addClass("focus");
//  }
  if(\'\' == \'hotcomment\'){
      $(\'#userhub_comment\').parent("dl.list_menu").show();
	  $(\'#userhub_comment\').children("a").addClass("focus");
  }
  if(\'\' == \'uservip\'){
      $(\'#userhub_usermember\').parent("dl.list_menu").show();
	  $(\'#userhub_usermember\').children("a").addClass("focus");
  }
  if(\'\' == \'moderatorView\'){
      $(\'#userhub_review_view\').parent("dl.list_menu").show();
	  $(\'#userhub_review_view\').children("a").addClass("focus");
  }
  $(\'#\'+ss).parent("dl.list_menu").show();
  $(\'#\'+ss).children("a").addClass("focus");
  $("li#row em").click(function(){
  $(this).parent().parent().children("dl.list_menu").toggle(300);
  });
});

</script>
<!--sidebar2 begin-->
  <div class="sidebar2 fl bg4 fix">
	
		    <div class="user2 f_blue fix">
'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'

	'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
  <div class="kf"></div>
  </div>
  <div class="article2 fr">
	<div class="boxm3">
	    <div class="box_mid2">
        <div class="t"><h3>我的书架</h3><a href="'.jieqi_geturl('article','bookcase','bookcase','0').'" class="fr f_blue4">更多&gt;&gt;</a></div>
        <div class="down">
         <div class="tt"><span class="name">作品名</span><span class="status">状态</span><span class="date">更新日期</span>
         </div>
         <dl class="list_td3 pt10 pb10">
         '.$this->_tpl_vars['jieqi_pageblocks']['1']['content'].'
         </dl>
        </div>
      </div>

      <!--box_mid2 begin-->
      <div class="box_mid2 mt10">
        <div class="t"><h3>动 态</h3></div>
        <!--down begin-->
        <div class="down p10">
          <!--box begin-->
          <div class="box p5">
            <div class="tabs4box">
          	  <ul class="tabs4" id="tabs0">
           		<li id="dall" class="thistab"><a href="javascript:void(0)">全部动态</a></li>
           		<li id="sale"><a href="javascript:void(0)">作品订阅</a></li>
           		<li id="reward"><a href="javascript:void(0)">作者打赏</a></li>
           		<li id="goodnum"><a href="javascript:void(0)">精品收藏</a></li>
		   		<li id="vote"><a href="javascript:void(0)">小说推荐</a></li>
		   		<li id="my"><a href="javascript:void(0)">赠送鲜花</a></li>
          	  </ul>
            </div>
          	<ul class="i_trend" id="tab_conbox0">
           	  <li class="fix" id="allli">
            	<dl class="list_img2" id="dalldyn"></dl>
           	  </li>
           	  <li class="fix" id="saleli" style="display:none;">
            	<dl class="list_img2" id="saledyn">亲，你还没有订阅信息</dl>
           	  </li>
           	  <li class="fix" id="rewardli" style="display:none;">
            	<dl class="list_img2" id="rewarddyn">亲，你还没有打赏信息</dl>
           	  </li>
           	  <li class="fix" id="goodnumli" style="display:none;">
            	<dl class="list_img2" id="goodnumdyn">亲，你还没有收藏信息</dl>
           	  </li>
		      <li class="fix" id="voteli" style="display:none;">
            	<dl class="list_img2" id="votedyn">亲，你还没有推荐信息</dl>
           	  </li>
		   	  <li class="fix" id="myli" style="display:none;">
            	<dl class="list_img2" id="mydyn">亲，你还没有推荐信息</dl>
           	  </li>
            </ul> 
          </div>
      	</div>
      </div>    
	</div>

    <div class="sidebar fr">
      <dl class="user_info">
        <dt class="f_blue">帐号：<a  href="#"><img src="'.$this->_tpl_vars['jieqi_group_imageurl'].'"/>'.$this->_tpl_vars['uname'].'</a></dt>
        <dd><em>昵称：</em>'.$this->_tpl_vars['name'].'</dd>
        <dd><em><em>'.$this->_tpl_vars['juanname'].'余额：</em>'.$this->_tpl_vars['juan'].'</dd>
        <dd><em>'.$this->_tpl_vars['egoldname'].'余额：</em>'.$this->_tpl_vars['egold'].'<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" class="recharge">立即充值</a></dd>
      </dl>
      <div class="box_re">
		<div class="box_sign" id="sign">
		  <div class="box_left">
			<div class="box_pa">
			  <p class="left_title">&nbsp;</p>
			  <p>&nbsp;</p>
			  <p class="left_bottom">&nbsp;</p>
			</div>
		  </div>
		  <div class="buttons" href="javascript:;" onclick="GPage.addbook(\''.$this->_tpl_vars['jieqi_url'].'/user/signin\');">打卡签到</div>
		</div>
	    <input type="hidden" name="issign" value="1">
	    <input type="hidden" name="totalsign" value="">
      </div>


      <div class="box">
        <div class="t"><h4>我的等级</h4></div>
        <div class="box_dwn">
		  <p class="intro">
		    当前等级：<a title="'.$this->_tpl_vars['honor'].'级" href="#"><img src="'.$this->_tpl_vars['jieqi_honor_imageurl'].'"></a></br>
		    当前积分：'.$this->_tpl_vars['score'].' </br>
		  	距离升级：'.$this->_tpl_vars['score'].'/'.$this->_tpl_vars['honorup'].'
		  </p>
        </div>
      </div>     
      <div class="box">
        <div class="t"><h4>我的VIP</h4></div>
        <div class="box_dwn">
          <p class="intro">
		    当前等级：<a title="'.$this->_tpl_vars['vip'].'" href="#"><img src="'.$this->_tpl_vars['jieqi_vip_imageurl'].'"></a></br>
		    当前消费：'.$this->_tpl_vars['expenses'].' </br>
		  	距离升级：'.$this->_tpl_vars['expenses'].'/'.$this->_tpl_vars['maxgold'].'
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var weekday = new Array("周日","周一","周二","周三","周四","周五","周六"),
  	   myDate = new Date(),
	  	    y = myDate.getFullYear(),
	  	    m = myDate.getMonth()+1 < 10 ? \'0\'+(myDate.getMonth()+1) : myDate.getMonth()+1,
	  	    d = (myDate.getDate() < 10) ? \'0\'+myDate.getDate() : myDate.getDate(),
	  	   md = m+\'-\'+d,//月日
	  	    w = weekday[myDate.getDay()],//周
	 daycount = new Date(y,m,0).getDate();
  
  $(".box_pa p:eq(1)").html(md);//签到按钮左边的月，日
  $(".left_bottom").html(w);//签到按钮旁的星期
  
  function showDynamic(_this, url, show){//点击页码ajax翻页
	var i = layer.load(0);
	var midDynamic = _this.id + "dyn";
	if(show!=\'1\') $("#"+_this.id+"li").toggle();
	GPage.loadpage(midDynamic, url);
	layer.close(i);
  }
  
  var my = \'\';
  $(function() {
  	if (!my) {
		var dynamicurl = "'.$this->_tpl_vars['jieqi_url'].'/user/myDynamic?mid=dall";
		GPage.loadpage(\'dalldyn\', dynamicurl);
	}
	$.jqtab("#tabs0","#tab_conbox0","click");

    $(\'#dall\').bind(\'click\',myDynamic);
    $(\'#reward\').bind(\'click\',myDynamic);
    $(\'#sale\').bind(\'click\',myDynamic);
    $(\'#goodnum\').bind(\'click\',myDynamic);
    $(\'#vote\').bind(\'click\',myDynamic);
    $(\'#my\').bind(\'click\',myDynamic);
	if (my) $(\'#my\').click();
	function myDynamic() {
	  var i = layer.load(0);
      var dynamicurl = "'.$this->_tpl_vars['jieqi_url'].'/user/myDynamic";
	  dynamicurl =  urlParams(dynamicurl, "mid=" +this.id);
	  var mid = this.id + "dyn";
	  //加载模版
	  GPage.loadpage(mid, dynamicurl);
	  if (mid == \'mydyn\') loadheader();
	  layer.close(i);
	}
	var issign,totaosign,sign=\'\',showDate1,signhref;
	function creatrili(){
	  issign = $("[name=\'issign\']").prop("value"),//attr
	  totalsign = $("[name=\'totalsign\']").prop("value");//attr
      if(issign > 0){
		sign +=\'<div class="rili">\';
		sign +=\'<div class="sign_status">\';
		sign +=\'<div class="status_img"><img src="'.$this->_tpl_vars['jieqi_url'].'/sink/image/sign.png" alt="签到"></div>\';
		sign +=\'<div class="sign_msg">';
if($this->_tpl_vars['qiandao'] == 0){
echo '今日未签到！';
}else{
echo '签到成功!';
}
echo '</div>\';
		sign +=\'</div>\';
		sign +=\'<div class="mt5 mb5 tc">2015年一月</div>\';
		sign +=\'<div class="data_box" id="data_box">\';
		sign +=\'<div class="sel_date">\';
		sign +=\'<table class="data_table">\';
		sign +=\'<thead><tr>\';
		sign +=\'<td class="red">日</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td class="red">六</td>\';
		sign +=\'</tr></thead>\';
		sign +=\'<tbody>\';
		sign +=\'<tr><td class="red"></td><td></td><td></td><td></td><td></td><td></td><td class="red"></td></tr>\';
		sign +=\'<tr><td class="red"></td><td></td><td></td><td></td><td></td><td></td><td class="red"></td></tr>\';
		sign +=\'<tr><td class="red"></td><td></td><td></td><td></td><td></td><td></td><td class="red"></td></tr>\';
		sign +=\'<tr><td class="red"></td><td></td><td></td><td></td><td></td><td></td><td class="red"></td></tr>\';
		sign +=\'<tr><td class="red"></td><td></td><td></td><td></td><td></td><td></td><td class="red"></td></tr>\';
		sign +=\'<tr><td class="red"></td><td></td><td></td><td></td><td></td><td></td><td class="red"></td></tr>\';
		sign +=\'</tbody>\';
		sign +=\'</table></div></div>\';
		sign +=\'<div class="ml10 mr5 mb5 mt5 pl5">累计签到满<span class="org">7</span>天，奖励<span class="org">20</span>'.$this->_tpl_vars['juanname'].'。</div>\';
		sign +=\'<div class="ml10 mr5 mb5 pl5">累计签到满<span class="org">15</span>天，奖励<span class="org">30</span>'.$this->_tpl_vars['juanname'].'。</div>\';
		sign +=\'<div class="ml10 mr5 mb5 pl5">累计签到<span class="org">30</span>天，奖励<span class="org">50</span>'.$this->_tpl_vars['juanname'].'。</div>\';
		sign +=\'</div>\';
		
		$(".box_re").append(sign).children(".rili").hide();
		//实例化日历对象
		showDate1 = new showDate({id: "data_box"}),
        signhref = \''.$this->_tpl_vars['jieqi_url'].'/user/showSignView\';
        //日历上的年，月
        $(".rili .tc").html(y+"年"+m+"月");
      }	
	}

	//签到操作ajax
	$("a.buttons").click(function(e){
	  e.preventDefault();
	  var _self = this;
	  GPage.getJson(this.href,function(data){
	    if(data.status == \'OK\'){
		  //layer.msg(data.msg,1,{shade:false});
		  $(_self).html("已签到");
		  $(_self).removeAttr("href");
		  $(_self).parent().addClass("unable");
		  $("[name=\'issign\']").prop("value","1");//attr
		  $(".box_sign .buttons").mouseover();
	    }else{
		  layer.msg(data.msg);
	    }
	  });
	});

    $(".box_sign .buttons").mouseover(function(){
      creatrili();
	  if(issign > 0){
	  	var rlcount = $(".rili").length;
		//如果显示rili时已有rili，就删除最后一个rili
		if(rlcount >0) { $(".rili:not(:eq(0))").remove(); }
        $.ajax({
    	  url:signhref,
    	  dataType: \'json\',
    	  success: function(data){
    		showDate1.init();
    		var tmpArr = data.dates.split(",");
    		$.each(tmpArr, function(i, n){
    		  tmpArr[i] = parseInt(n);
    		});
    		$("tbody td").each(function(){
    		  if($(this).html() == \'\'){return true;}
    		  if($.inArray(parseInt($(this).html()),tmpArr)>-1){
    		  	$(this).html($(this).html()+"<div class=\'mark\'></div>");
    		  }
    		});
    		setTimeout(function(){
    		  $(".rili").show();
    		},300);
    	  },
    	  error : function(data){
			layer.alert(data.msg, 8, !1);
	  	  }
        });
	  }
    }).mouseout(function(){
	  $(".rili").animate({opacity:\'0\'},"slow",function(){
	  	$(this).remove();
	  });
    });
  });
</script>
<script type="text/javascript" src="/sink/js/mod.user.index.js"></script>


</div>';
?>