<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>投票-活动</title>
<link href="/sink/css/pop.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/sink/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/sink/js/layer.js"></script>
<script type="text/javascript" src="/sink/js/page.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body class="bg7">
<!--pop2 begin-->
<div class="pop2 fix">
  <a href="javascript:;" id="close" class="close" title="关闭"></a>
  <div class="pop_t">
    <h3 class="p5">《'.$this->_tpl_vars['articlename'].'》读者互动</h3>    
  </div>
  <ul class="tab2 fix f14" id="tabs100">
  
   <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?type=flower&id='.$this->_tpl_vars['articleid'].'"><em class="recom" style="cursor:pointer">鲜花</em></a></li>
   <li class="thistab"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/vipvote.php?&id='.$this->_tpl_vars['articleid'].'"><em class="vote" style="cursor:pointer">月票</em></a></li>
   <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'"><em class="reward" style="cursor:pointer">打赏</em></a></li>
   <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/hurry.php?id='.$this->_tpl_vars['articleid'].'" ><em class="urge" style="cursor:pointer">催更</em></a></li>
  </ul>  
  <ul id="tab_conbox100">
  <li>
    <div class="po_box auto p20">
	<form name="vipvote" id="vipvote" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/vipvote.php?do=submit" method="post" ">
<table width="500" class="grid" cellspacing="1" align="center">
       <div class="not">
        <p class="b">作者更新太给力了，我决定<em class="red">送月票
</em>支持作者</p>
        </div>
		<div class="rdo f12"><em class="f14 g6">赠送月票（现有：'.$this->_tpl_vars['vipvote'].' 张)：</em>    
       <input value="1" type="radio" name="num" checked /><label>1张月票</label>
       <input value="2" type="radio" name="num" /><label>2张月票</label>
       <input value="5" type="radio" name="num" /><label>5张月票</label>
       <input value="10" type="radio" name="num" /><label>10张月票</label>
       </div>

     <div class="text"><textarea name="pcontent" id="pcontent" cols="" rows="" onkeyup="checkMsgLen(this.id)" onfocus="if(this.value==\'您可输入6-500字寄语给作者，投票成功后您的寄语将在书评区显示\') this.value=\'\';">您可输入6-500字寄语给作者，投票成功后您的寄语将在书评区显示</textarea></div> 
     <div class="comm_box">
	<div class="face fix">
      <div class="facep1" onclick="javascript:inface(\'呵呵\',\'pcontent\');"></div>	<!--呵呵-->
      <div class="facep2" onclick="javascript:inface(\'偷笑\',\'pcontent\');"></div>	<!--偷笑-->
      <div class="facep3" onclick="javascript:inface(\'花心\',\'pcontent\');"></div>	<!--花心-->
      <div class="facep4" onclick="javascript:inface(\'思考\',\'pcontent\');"></div>	<!--思考-->	
      <div class="facep5" onclick="javascript:inface(\'问号\',\'pcontent\');"></div>	<!--问号-->
      <div class="facep6" onclick="javascript:inface(\'汗\',\'pcontent\');"></div>		<!--汗-->
      <div class="facep7" onclick="javascript:inface(\'伤心\',\'pcontent\');"></div>	<!--伤心-->
      <div class="facep8" onclick="javascript:inface(\'哼\',\'pcontent\');"></div>		<!--哼-->
      <div class="facep9" onclick="javascript:inface(\'吃惊\',\'pcontent\');"></div>	<!--吃惊-->
      <div class="facep10" onclick="javascript:inface(\'怒\',\'pcontent\');"></div>	<!--怒-->
      <div class="facep11" onclick="javascript:inface(\'睡\',\'pcontent\');"></div>	<!--睡-->
      <div class="facep12" onclick="javascript:inface(\'闭嘴\',\'pcontent\');"></div>	<!--闭嘴-->
      <div class="facep13" onclick="javascript:inface(\'爱你\',\'pcontent\');"></div>	<!--爱你-->
      <div class="facep14" onclick="javascript:inface(\'泪\',\'pcontent\');"></div>	<!--泪-->
      <div class="facep15" onclick="javascript:inface(\'鄙视\',\'pcontent\');"></div>	<!--鄙视-->
      <div class="facep16" onclick="javascript:inface(\'鼓掌\',\'pcontent\');"></div>	<!--鼓掌-->
      <div class="facep17" onclick="javascript:inface(\'ok\',\'pcontent\');"></div>	<!--ok-->
      <div class="facep18" onclick="javascript:inface(\'握手\',\'pcontent\');"></div>	<!--握手-->
      <div class="facep19" onclick="javascript:inface(\'求\',\'pcontent\');"></div>	<!--求-->
      <div class="facep20" onclick="javascript:inface(\'可怜\',\'pcontent\');"></div>	<!--可怜-->
     </div>
     <div class="not3 fix">
      <p class="fl g6" id="pcontentmsgLen">您还可以输入<em class="red">150</em>字</p>
    ';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '<div class="deliver">
      <p><img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php" id="code" style="cursor:pointer;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" width="60" height="24" /></p>
      <input name="checkcode" id="checkcode"  type="text" class="tit"  />
     <label>验证码：</label>';
}
echo '
      </div>
     </div>
     </div>

  <input type="hidden" name="action" id="action" value="post" />
  <input type="hidden" name="type" id="type" value="'.$this->_tpl_vars['gfuname'].'" />
  <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articleid'].'" />  </td>
  <p class="auto tc p20"><input type="submit"  class="btn4" name="submit"  id="submit" value="提 交" /></p>
</form>
        <dl class="not2 g6">
        <dd>';
if($this->_tpl_vars['gfuname'] == flower){
echo '您的账户还余<em class="red">'.$this->_tpl_vars['useremoney'].'</em>'.$this->_tpl_vars['egoldname'];
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '您的账户还余<em class="red">'.$this->_tpl_vars['vipvotemoney'].'</em>张月票';
}
echo '</dd>
		<dd>说明：本功能是指用道具对作者进行鼓励更新。</dd>
        </dl>
     </div>
   </li>
   
  </ul>     
</div><!--pop2 end-->
<script type="text/javascript">
//提交评论
$(function(){
      //  if(this.pcontent.value==\'您可输入6-500字寄语给作者\' || this.pcontent.value==\'您可输入6-500字寄语给作者，投票成功后您的寄语将在书评区显示\') this.pcontent.value=\'\';
		$(\'#vipvote\').on(\'submit\', function(e){
		event.preventDefault();
	    if(this.pcontent.value==\'您可输入6-500字寄语给作者\' || this.pcontent.value==\'您可输入6-500字寄语给作者，投票成功后您的寄语将在书评区显示\') this.pcontent.value=\'\';
			e.preventDefault();
			if(getUserId()<1){
				userLogin();
			}else{
				var i = layer.load(0);
				GPage.postForm(\'vipvote\', $("#vipvote").attr("action"), function(data){
					if(data.status==\'OK\'){loadheader();
						layer.msg(data.msg,2,{type:1,shade:false});
						picTimer = setInterval(function() {
						    clearInterval(picTimer);
							parent.layer.close(parent.layer.getFrameIndex(window.name));
						},2000); //此3000代表自动播放的间隔，单位：毫秒
//					{
//						layer.msg(data.msg,1,{type:1,shade:false},function(){});
//						$.ajaxSetup ({ cache: false });
//						layer.close(i);
					}else{
					    layer.close(i);
						layer.alert(data.msg, 8, !1);
					}
			   });
			}
		});
});
	function inface(str,tag){
		if(str!=\'\'){
			var str = "["+str+"]";
			var obj=document.getElementById(tag);
			if(obj.value==\'您可输入6-500字寄语给作者\' || obj.value==\'您可输入6-500字寄语给作者，投票成功后您的寄语将在书评区显示\') obj.value=\'\';
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
					$(\'#\'+strTag).html(\'已超出<b style="color:red;">\'+(len-150)+\'</b>字\');
					//$(\'#btn_\'+tag).attr(\'disabled\',true);
				}else{
					var n=150-len;
					$(\'#\'+strTag).html(\'您还可以输入<b style="color:red;">\'+n+\'</b>字\');
				   
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
</script>

</body>
</html>';
?>