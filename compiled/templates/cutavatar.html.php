<?php
echo '

<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/drag.js"></script>
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
	<div class="boxm2">
<div class="divbox">
<form name="setavatar" id="setavatar" action="'.$this->_tpl_vars['jieqi_url'].'/setavatar.php?do=submit" method="post" onsubmit="return getcutpos();">
<div class="c_title">ͷ��ü�</div>
<div class="c_head">˵����Ϊ��ҳ�����࣬��վͳһͷ��ͼƬ��С���ϴ�ͷ��ͼƬ����������ѡ��ü�λ�ã����ύ������ʽ����ɹ���</div>

<div id="cut_div" style="border:2px solid #888888; width:284px; height:266px; overflow: hidden; position:relative; top:0px; left:0px; margin:4px; cursor:pointer;text-align:left;">
<table style="border-collapse: collapse; z-index: 10; filter: alpha(opacity=75); position: relative; left: 0px; top: 0px; width: 284px;  height: 266px; opacity: 0.75;" cellspacing="0" cellpadding="0" border="0" unselectable="on">
<tr>
<td style="background: #cccccc; height: 73px;" colspan="3"></td></tr>
<tr>
<td style="background: #cccccc; width: 82px;"></td>
<td style="border: 1px solid #ffffff; width: 120px; height: 120px;"></td>
<td style="background: #cccccc; width: 82px;"></td></tr>
<tr><td style="background: #cccccc; height: 73px;" colspan="3"></td></tr>
</table>
<img  id="cut_img" style="position:relative; top:-266px; left:0px" src="'.$this->_tpl_vars['url_avatar'].'" />
</div>

<table cellspacing="0" cellpadding="0">
<tr>
<td><img style="margin-top: 5px; cursor:pointer;"  src="'.$this->_tpl_vars['jieqi_url'].'/images/ui/sh.gif" alt="ͼƬ��С" onmouseover="this.src=\''.$this->_tpl_vars['jieqi_url'].'/images/ui/sc.gif\'" onmouseout="this.src=\''.$this->_tpl_vars['jieqi_url'].'/images/ui/sh.gif\'" onclick="imageresize(false)" /></td>
<td><img id="img_track" style="width: 250px; height: 18px; margin-top: 5px" src="'.$this->_tpl_vars['jieqi_url'].'/images/ui/track.gif" /></td>
<td><img style="margin-top: 5px; cursor:pointer;" src="'.$this->_tpl_vars['jieqi_url'].'/images/ui/ah.gif" alt="ͼƬ�Ŵ�"  onmouseover="this.src=\''.$this->_tpl_vars['jieqi_url'].'/images/ui/ac.gif\'" onmouseout="this.src=\''.$this->_tpl_vars['jieqi_url'].'/images/ui/ah.gif\'" onclick="imageresize(true)" /></td>
</tr>
</table>
<img id="img_grip" style="position:absolute; z-index:100; left:-1000px; top:-1000px; cursor:pointer;" src="'.$this->_tpl_vars['jieqi_url'].'/images/ui/grip.gif" />

<div style="padding-top:15px; padding-left:5px;">
<input type="hidden" name="action" id="action" value="cutsave" />
<input type="hidden" name="cut_pos" id="cut_pos" value="" />
<input type="submit" class="button" name="submit"  id="submit" value=" ȷ�ϲü����ύ " />
&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button" name="cancel"  id="cancel" value=" ȡ�� " onclick="javascript:history.back(1);"  />
</div>

</form>
</div>
</div></div></div></div>
<script type="text/javascript">
	var cut_div;  //�ü�ͼƬ���div
	var cut_img;  //�ü�ͼƬ
	var imgdefw;  //ͼƬĬ�Ͽ���
	var imgdefh;  //ͼƬĬ�ϸ߶�
	var offsetx = 82; //ͼƬλ��λ��x
	var offsety = -193; //ͼƬλ��λ��y
	var divx = 284; //������
	var divy = 266; //���߶�
	var cutx = 120;  //�ü�����
	var cuty = 120;  //�ü��߶�
	var zoom = 1; //���ű���

	var zmin = 0.1; //��С����
	var zmax = 10; //������
	var grip_pos = 5; //�϶���λ��0-���� 10 ����
	var img_grip; //�϶���
	var img_track; //�϶���
	var grip_y; //�϶���yֵ
	var grip_minx; //�϶���x��Сֵ
	var grip_maxx; //�϶���x���ֵ
	
	
//ͼƬ��ʼ��
function imageinit(){
	cut_div = document.getElementById(\'cut_div\');
	cut_img = document.getElementById(\'cut_img\');
	imgdefw = cut_img.width;
	imgdefh = cut_img.height;
	if(imgdefw > divx){
		zoom = divx / imgdefw;
		cut_img.width = divx;
		cut_img.height = Math.round(imgdefh * zoom);
	}

	cut_img.style.left = Math.round((divx - cut_img.width) / 2);
	cut_img.style.top = Math.round((divy - cut_img.height) / 2) - divy;

	if(imgdefw > cutx){
		zmin = cutx / imgdefw;
	}else{
		zmin = 1;
	}
	zmax =  zmin > 0.25 ? 8.0: 4.0 / Math.sqrt(zmin);
	if(imgdefw > cutx){
		zmin = cutx / imgdefw;
		grip_pos = 5 * (Math.log(zoom * zmax) / Math.log(zmax));
	}else{
		zmin = 1;
		grip_pos = 5;
	}

	Drag.init(cut_div, cut_img);
	cut_img.onDrag = when_Drag;
}

//ͼƬ������
function imageresize(flag){
    if(flag){
		zoom = zoom * 1.5;
	}else{
		zoom = zoom / 1.5;
	}
	if(zoom < zmin) zoom = zmin;
	if(zoom > zmax) zoom = zmax;
	cut_img.width = Math.round(imgdefw * zoom);
	cut_img.height = Math.round(imgdefh * zoom);
	checkcutpos();
	grip_pos = 5 * (Math.log(zoom * zmax) / Math.log(zmax));
	img_grip.style.left = (grip_minx + (grip_pos / 10 * (grip_maxx - grip_minx))) + "px";
}

//���style���涨λ
function getStylepos(e){  
	return {x:parseInt(e.style.left), y:parseInt(e.style.top)}; 
}

//��þ��Զ�λ
function getPosition(e){  
	var t=e.offsetTop;  
	var l=e.offsetLeft;  
	while(e=e.offsetParent){  
		t+=e.offsetTop;  
		l+=e.offsetLeft;  
	}
	return {x:l, y:t}; 
}

//���ͼƬλ��
function checkcutpos(){
	var imgpos = getStylepos(cut_img);
	
	max_x = Math.max(offsetx, offsetx + cutx - cut_img.clientWidth);
	min_x = Math.min(offsetx + cutx - cut_img.clientWidth, offsetx);
	if(imgpos.x > max_x) cut_img.style.left = max_x + \'px\';
	else if(imgpos.x < min_x) cut_img.style.left = min_x + \'px\';

	max_y = Math.max(offsety, offsety + cuty - cut_img.clientHeight);
	min_y = Math.min(offsety + cuty - cut_img.clientHeight, offsety);

	if(imgpos.y > max_y) cut_img.style.top = max_y + \'px\';
	else if(imgpos.y < min_y) cut_img.style.top = min_y + \'px\';
}

//ͼƬ�϶�ʱ����
function when_Drag(clientX , clientY){
	checkcutpos();
}

//���ͼƬ�ü�λ��
function getcutpos(){
	var imgpos = getStylepos(cut_img);
	var x = offsetx - imgpos.x;
	var y = offsety - imgpos.y;
	var cut_pos = document.getElementById(\'cut_pos\');
	cut_pos.value = x + \',\' + y + \',\' + cut_img.width + \',\' + cut_img.height;
	return true;
}

//��������ʼ��
function gripinit(){
	img_grip = document.getElementById(\'img_grip\');
	img_track = document.getElementById(\'img_track\');
	track_pos = getPosition(img_track);

	grip_y = track_pos.y;
	grip_minx = track_pos.x + 4;
	grip_maxx = track_pos.x + img_track.clientWidth - img_grip.clientWidth - 5;

	img_grip.style.left = (grip_minx + (grip_pos / 10 * (grip_maxx - grip_minx))) + "px";
	img_grip.style.top = grip_y + "px";

	Drag.init(img_grip, img_grip);
	img_grip.onDrag = grip_Drag;

}

//�������϶�ʱ����
function grip_Drag(clientX , clientY){
	var posx = clientX;
	img_grip.style.top = grip_y + "px";
	if(clientX < grip_minx){
		img_grip.style.left = grip_minx + "px";
		posx = grip_minx;
	}
	if(clientX > grip_maxx){
		img_grip.style.left = grip_maxx + "px";
		posx = grip_maxx;
	}

	grip_pos = (posx - grip_minx) * 10 / (grip_maxx - grip_minx);
	zoom = Math.pow(zmax, grip_pos / 5) / zmax;
	if(zoom < zmin) zoom = zmin;
	if(zoom > zmax) zoom = zmax;
	cut_img.width = Math.round(imgdefw * zoom);
	cut_img.height = Math.round(imgdefh * zoom);
	checkcutpos();
}

//ҳ�������ʼ��
function avatarinit(){
	imageinit();
	gripinit();
}

if (document.all){
	window.attachEvent(\'onload\',avatarinit);
}else{
	window.addEventListener(\'load\',avatarinit,false);
} 
</script>';
?>