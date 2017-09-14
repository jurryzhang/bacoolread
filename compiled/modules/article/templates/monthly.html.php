<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>开通包月</title>
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
    <h3 class="p5"></h3>    
  </div>
  <ul class="tab2 fix f14" id="tabs100">
   <li><a href="" ><em class="recom" style="cursor:pointer">开通包月</em></a></li>
  </ul>  
  <ul id="tab_conbox100">
  <li>
    <div class="po_box auto p20">
	<form name="frmgift" id="frmgift" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthly.php?do=submit" method="post" ">
<table width="500" class="grid" cellspacing="1" align="center">
       <div class="not">
        <p class="b"></p>
        </div>
		<div class="rdo3 f12"><em class="f14 g6">当前用户：</em>'.$this->_tpl_vars['jieqi_username'].'</div>
		<div class="rdo3 f12"><em class="f14 g6">包月状态：</em>';
if($this->_tpl_vars['overtime'] == 0){
echo '尚未包月';
}elseif($this->_tpl_vars['overtime'] < $this->_tpl_vars['time']){
echo '已经到期';
}else{
echo date('Y-m-d',$this->_tpl_vars['overtime']).' 到期';
}
echo '</div>
        <div class="rdo3 f12"><em class="f14 g6">当前余额：</em>'.$this->_tpl_vars['emoney'].' '.$this->_tpl_vars['egoldname'].'</div>
<div class="rdo f12"><em class="f14 g6">选项：</em>   
';
if (empty($this->_tpl_vars['jieqimonthly']['items'])) $this->_tpl_vars['jieqimonthly']['items'] = array();
elseif (!is_array($this->_tpl_vars['jieqimonthly']['items'])) $this->_tpl_vars['jieqimonthly']['items'] = (array)$this->_tpl_vars['jieqimonthly']['items'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['jieqimonthly']['items']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['jieqimonthly']['items']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['jieqimonthly']['items']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['jieqimonthly']['items']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['jieqimonthly']['items']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '	
<input type="radio" class="radio" name="buytype" id="buytype" value="'.$this->_tpl_vars['i']['key'].'" ';
if($this->_tpl_vars['i']['key'] == $this->_tpl_vars['jieqimonthly']['default']){
echo ' checked="checked"';
}
echo '/><label>'.$this->_tpl_vars['i']['key'].'个月 ('.$this->_tpl_vars['jieqimonthly']['items'][$this->_tpl_vars['i']['key']].$this->_tpl_vars['egoldname'].')</label>
	';
}
echo '		

       </div>

   <input type="hidden" name="action" value="post">
   <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['uid'].'" /></td>
  <p class="auto tc p20"><input type="submit"  class="btn4" name="submit"  id="submit" value="提 交" /></p>
</form>

     </div>
   </li>
   
  </ul>     
</div><!--pop2 end-->
<script type="text/javascript">
layer.ready(function(){
		$(\'#frmgift\').on(\'submit\', function(e){
		e.preventDefault();
		var i = layer.load(0);
				GPage.postForm(\'frmgift\', $("#frmgift").attr("action"),
			   function(data){
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
//			}
		});
});
$(\'#recode\').click(function(){
	$(\'#checkcode\').attr(\'src\',\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random());
});
</script>

</body>
</html>';
?>