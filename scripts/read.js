var jieqiUserId = 0;
var jieqiUserName = '';
var jieqiUserPassword = '';
var jieqiUserGroup = 0;
var jieqiNewMessage = 0;

if(document.cookie.indexOf('jieqiUserInfo') >= 0){
	
	var jieqiUserInfo = get_cookie_value('jieqiUserInfo');
	
	start = 0;
	offset = jieqiUserInfo.indexOf(',', start); 
	while(offset > 0){
		tmpval = jieqiUserInfo.substring(start, offset);
		tmpidx = tmpval.indexOf('=');
		if(tmpidx > 0){
           tmpname = tmpval.substring(0, tmpidx);
		   tmpval = tmpval.substring(tmpidx+1, tmpval.length);
		   if(tmpname == 'jieqiUserId') jieqiUserId = tmpval;
		   else if(tmpname == 'jieqiUserName_un') jieqiUserName = tmpval;
		   else if(tmpname == 'jieqiUserPassword') jieqiUserPassword = tmpval;
		   else if(tmpname == 'jieqiUserGroup') jieqiUserGroup = tmpval;
		   else if(tmpname == 'jieqiNewMessage') jieqiNewMessage = tmpval;
		}
		start = offset+1;
		if(offset < jieqiUserInfo.length){
		  offset = jieqiUserInfo.indexOf(',', start); 
		  if(offset == -1) offset =  jieqiUserInfo.length;
		}else{
          offset = -1;
		}
	}
}

if(jieqiUserId != 0 && jieqiUserName != '' && (document.cookie.indexOf('PHPSESSID') != -1 || jieqiUserPassword != '')){
  document.write('<script type="text/javascript" src="/sink/js/jquery.cookie.js"></script>');
document.write('<!--logined2  begin-->');
document.write('<div class="logined2">');
document.write('    <ul class="topmenu" clearfix="" id="jq_topmenu">');
document.write('     <li class="webnav" qxpp="" style="background:none">');
document.write('      <span class="icon_arr2"><em>'+jieqiUserName+'</em></span>');
document.write('      <div class="jq_hidebox" id="jq_hidebox" style="display: none; " block;="">');
document.write('        <dl class="jq2">');
document.write('          <dd class="dd1"><a href="/user/" class="f_black">��������</a></dd>');
document.write('	  <dd><a href="/modules/article/myarticle.php" class="f_black">��������</a></dd>');
document.write('          <dd><a href="/useredit.php" class="f_black">�˺Ź���</a></dd>');
document.write('          <dd><a href="/setavatar.php" class="f_black">�޸�ͷ��</a></dd>');
document.write('          <dd><a href="/passedit.php" class="f_black">�޸�����</a></dd>');
document.write('          <dd><a href="/modules/pay/buyegold.php" class="f_black">��ֵ</a></dd>');
document.write('          <dd class="dd2"><a href="/logout.php" class="f_black">�˳�</a></dd>');
document.write('        </dl>');
document.write('      </div>');
document.write('     </li>');
document.write('     <li class="webnav" qxpp="" style="background:none">');
document.write('      <span class="icon_arr2">��Ϣ</span>');
document.write('      <div class="jq_hidebox" id="jq_hidebox" style="display: none; " block;="">');
document.write('        <dl class="jq1">');
document.write('          <dd><a href="/message.php?box=inbox" class="f_black">�鿴˽��</a><em class="g9">');
  if(jieqiNewMessage > 0){
	  document.write('���ж���');
  }else{
	  document.write('�鿴����');
  }
document.write('</em></dd>');
document.write('        </dl>');
document.write('      </div>');
document.write('     </li>');
document.write('     <li class="webnav" qxpp="" style="background:none">');
document.write('      <span class="icon_arr2">�ҵ����</span>');
document.write('      <div class="jq_hidebox" id="jq_hidebox" style="display: none; " block;="">');
document.write('       <div class="jq3 fix">');
document.write('        <ul id="tabs9" class="tabmenu2 fix" >');
document.write('          <li id="arl" class="brdl"><a href="javascript:;">��ܼ�¼</a></li>');
document.write('          <li id="list"><a href="javascript:;">����Ķ�</a></li>');
document.write('        </ul>');
document.write('        <ul id="tab_conbox9">');
document.write('         <li style="display:none;" id="am">');
document.write('			          <dl class="lisd fix">');
document.write('		  <script type="text/javascript" src="/blockshow.php?bid=0&module=article&filename=block_ubookcase&classname=BlockArticleUbookcase&vars=lastupdate%2C10%2C0%2Cuid&template=block_shujia.html&contenttype=4&custom=0&publish=3&hasvars=1"></script>');
document.write('           ');
document.write('		    ');
document.write('           <dd class="fix g9 noline tr"><a href="/modules/article/bookcase.php" class="f_blue1">�鿴����&gt;&gt;</a></dd>');
document.write('          </dl>');
document.write('         </li>');
document.write('         <li>');
document.write('          <dl class="lisd fix" id="list2">');
document.write('          </dl>');
document.write('         </li>');
document.write('        </ul>');
document.write('       </div>');
document.write('      </div>');
document.write('     </li>');
document.write('     <li>|<a href="/logout.php" class="f_black">�˳�</a></li>');
document.write('    </ul>');
document.write('</div><!--logined2 end-->');
}else{
  var jumpurl="";
  if(location.href.indexOf("jumpurl") == -1){
    jumpurl=location.href;
  }
  document.write('<div class="logn">��ӭ���ʣ�<span class="g9">��<a href="/login.php" class="f_blue5">��¼</a>��<a href="/register.php" class="f_blue5">ע��</a></span><a href="/api/qq/login.php" class="qq f_gray3r" title="QQ��¼">&nbsp;</a><a href="/api/weibo/login.php" class="sina f_gray3r" title="΢����¼">&nbsp;</a></div>');      
}

function get_cookie_value(Name) { 
  var search = Name + "=";
��var returnvalue = ""; 
��if (document.cookie.length > 0) { 
��  offset = document.cookie.indexOf(search) 
����if (offset != -1) { 
����  offset += search.length 
����  end = document.cookie.indexOf(";", offset); 
����  if (end == -1) 
����  end = document.cookie.length; 
����  returnvalue=unescape(document.cookie.substring(offset, end));
����} 
��} 
��return returnvalue; 
}