<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>ͶƱ-�</title>
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
  <a href="javascript:;" id="close" class="close" title="�ر�"></a>
  <div class="pop_t">
    <h3 class="p5">��'.$this->_tpl_vars['articlename'].'�����߻���</h3>    
  </div>
  <ul class="tab2 fix f14" id="tabs100">
  
   <li';
if($this->_tpl_vars['gfuname'] == flower){
echo ' class="thistab"';
}
echo '><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?type=flower&id='.$this->_tpl_vars['articleid'].'"><em class="recom" style="cursor:pointer">�ʻ�</em></a></li>
   <li';
if($this->_tpl_vars['gfuname'] == vipvote){
echo ' class="thistab"';
}
echo '><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/vipvote.php?&id='.$this->_tpl_vars['articleid'].'"><em class="vote" style="cursor:pointer">��Ʊ</em></a></li>
   <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/tip.php?id='.$this->_tpl_vars['articleid'].'"><em class="reward" style="cursor:pointer">����</em></a></li>
   <li><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/hurry.php?id='.$this->_tpl_vars['articleid'].'" ><em class="urge" style="cursor:pointer">�߸�</em></a></li>
  </ul>  
  <ul id="tab_conbox100">
  <li>
    <div class="po_box auto p20">
	<form name="frmhurry" id="frmhurry" action="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/gift.php?do=submit" method="post" ">
<table width="500" class="grid" cellspacing="1" align="center">
       <div class="not">
        <p class="b">���߸���̫�����ˣ��Ҿ���<em class="red">';
if($this->_tpl_vars['gfuname'] == flower){
echo '���ʻ�';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '����Ʊ';
}
echo '
</em>֧������</p>
        </div>
		<div class="rdo f12"><em class="f14 g6">����';
if($this->_tpl_vars['gfuname'] == flower){
echo '�ʻ������ۣ�'.$this->_tpl_vars['flowerprice'].' '.$this->_tpl_vars['egoldname'].')';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '��Ʊ�����У�'.$this->_tpl_vars['vipvotemoney'].' ��)';
}
echo '��</em>    
       <input value="1" type="radio" name="num" checked /><label>1';
if($this->_tpl_vars['gfuname'] == flower){
echo '���ʻ�';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '����Ʊ';
}
echo '</label>
       <input value="2" type="radio" name="num" /><label>2';
if($this->_tpl_vars['gfuname'] == flower){
echo '���ʻ�';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '����Ʊ';
}
echo '</label>
       <input value="5" type="radio" name="num" /><label>5';
if($this->_tpl_vars['gfuname'] == flower){
echo '���ʻ�';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '����Ʊ';
}
echo '</label>
       <input value="10" type="radio" name="num" /><label>10';
if($this->_tpl_vars['gfuname'] == flower){
echo '���ʻ�';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '����Ʊ';
}
echo '</label>
	   <input value="20" type="radio" name="num" /><label>20';
if($this->_tpl_vars['gfuname'] == flower){
echo '���ʻ�';
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '����Ʊ';
}
echo '</label>
       </div>

     <div class="text"><textarea name="pcontent" id="pcontent" cols="" rows="" onkeyup="checkMsgLen(this.id)" onfocus="if(this.value==\'��������6-500�ּ�������ߣ�ͶƱ�ɹ������ļ��ｫ����������ʾ\') this.value=\'\';">��������6-500�ּ�������ߣ�ͶƱ�ɹ������ļ��ｫ����������ʾ</textarea></div> 
     <div class="comm_box">
	<div class="face fix">
      <div class="facep1" onclick="javascript:inface(\'�Ǻ�\',\'pcontent\');"></div>	<!--�Ǻ�-->
      <div class="facep2" onclick="javascript:inface(\'͵Ц\',\'pcontent\');"></div>	<!--͵Ц-->
      <div class="facep3" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep4" onclick="javascript:inface(\'˼��\',\'pcontent\');"></div>	<!--˼��-->	
      <div class="facep5" onclick="javascript:inface(\'�ʺ�\',\'pcontent\');"></div>	<!--�ʺ�-->
      <div class="facep6" onclick="javascript:inface(\'��\',\'pcontent\');"></div>		<!--��-->
      <div class="facep7" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep8" onclick="javascript:inface(\'��\',\'pcontent\');"></div>		<!--��-->
      <div class="facep9" onclick="javascript:inface(\'�Ծ�\',\'pcontent\');"></div>	<!--�Ծ�-->
      <div class="facep10" onclick="javascript:inface(\'ŭ\',\'pcontent\');"></div>	<!--ŭ-->
      <div class="facep11" onclick="javascript:inface(\'˯\',\'pcontent\');"></div>	<!--˯-->
      <div class="facep12" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep13" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep14" onclick="javascript:inface(\'��\',\'pcontent\');"></div>	<!--��-->
      <div class="facep15" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep16" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep17" onclick="javascript:inface(\'ok\',\'pcontent\');"></div>	<!--ok-->
      <div class="facep18" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
      <div class="facep19" onclick="javascript:inface(\'��\',\'pcontent\');"></div>	<!--��-->
      <div class="facep20" onclick="javascript:inface(\'����\',\'pcontent\');"></div>	<!--����-->
     </div>
     <div class="not3 fix">
      <p class="fl g6" id="pcontentmsgLen">������������<em class="red">150</em>��</p>
    ';
if($this->_tpl_vars['postcheckcode'] > 0){
echo '<div class="deliver">
      <p><img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php" id="code" style="cursor:pointer;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" width="60" height="24" /></p>
      <input name="checkcode" id="checkcode"  type="text" class="tit"  />
     <label>��֤�룺</label>';
}
echo '
      </div>
     </div>
     </div>

  <input type="hidden" name="action" id="action" value="post" />
  <input type="hidden" name="type" id="type" value="'.$this->_tpl_vars['gfuname'].'" />
  <input type="hidden" name="id" id="id" value="'.$this->_tpl_vars['articleid'].'" />  </td>
  <p class="auto tc p20"><input type="submit"  class="btn4" name="submit"  id="submit" value="�� ��" /></p>
</form>
        <dl class="not2 g6">
        <dd>';
if($this->_tpl_vars['gfuname'] == flower){
echo '�����˻�����<em class="red">'.$this->_tpl_vars['useremoney'].'</em>'.$this->_tpl_vars['egoldname'];
}elseif($this->_tpl_vars['gfuname'] == vipvote){
echo '�����˻�����<em class="red">'.$this->_tpl_vars['vipvotemoney'].'</em>����Ʊ';
}
echo '</dd>
		<dd>˵������������ָ�õ��߶����߽��й������¡�</dd>
        </dl>
     </div>
   </li>
   
  </ul>     
</div><!--pop2 end-->
<script type="text/javascript">
//�ύ����
$(function(){
      //  if(this.pcontent.value==\'��������6-500�ּ��������\' || this.pcontent.value==\'��������6-500�ּ�������ߣ�ͶƱ�ɹ������ļ��ｫ����������ʾ\') this.pcontent.value=\'\';
		$(\'#frmhurry\').on(\'submit\', function(e){
		event.preventDefault();
	    if(this.pcontent.value==\'��������6-500�ּ��������\' || this.pcontent.value==\'��������6-500�ּ�������ߣ�ͶƱ�ɹ������ļ��ｫ����������ʾ\') this.pcontent.value=\'\';
			e.preventDefault();
			if(getUserId()<1){
				userLogin();
			}else{
				var i = layer.load(0);
				GPage.postForm(\'frmhurry\', $("#frmhurry").attr("action"), function(data){
					if(data.status==\'OK\'){loadheader();
						layer.msg(data.msg,2,{type:1,shade:false});
						picTimer = setInterval(function() {
						    clearInterval(picTimer);
							parent.layer.close(parent.layer.getFrameIndex(window.name));
						},2000); //��3000�����Զ����ŵļ������λ������
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
			if(obj.value==\'��������6-500�ּ��������\' || obj.value==\'��������6-500�ּ�������ߣ�ͶƱ�ɹ������ļ��ｫ����������ʾ\') obj.value=\'\';
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
					$(\'#\'+strTag).html(\'�ѳ���<b style="color:red;">\'+(len-150)+\'</b>��\');
					//$(\'#btn_\'+tag).attr(\'disabled\',true);
				}else{
					var n=150-len;
					$(\'#\'+strTag).html(\'������������<b style="color:red;">\'+n+\'</b>��\');
				   
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
</script>

</body>
</html>';
?>