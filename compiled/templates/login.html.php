<?php
echo '<div id="content">
<link rel="stylesheet" rev="stylesheet" href="/sink/css/login.css" type="text/css" media="all" />
<div class="box_mid fix">
  <div class="login">
   <h3>�û���¼</h3>
<form name="frmlogin" id="frmlogin" class="signup" action="'.$this->_tpl_vars['url_login'].'" method="post">
<fieldset>
    <div class="form-item">
        <div class="field-name">�û���:</div>
        <div class="field-input">
          <input type="text" maxlength="30" name="username" onKeyPress="javascript: if (event.keyCode == 32 || event.which == 32) return false;">
        </div>
    </div>
    <div class="form-item">
        <div class="field-name">����:</div>
        <div class="field-input">
          <input type="password" name="password" autocomplete="off" data-rule="����:required;length[3~]" />
        </div>
    </div>
	';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
	    <div class="form-item" id="code_div">
	        <div class="field-name">��֤��:</div>
	        <div class="field-input">
	          	<input type="text" name="checkcode" class="yzm" maxlength="6" autocomplete=��off��/>
	          	<img src="'.$this->_tpl_vars['jieqi_url'].'/checkcode.php" class="pic" id="checkcode" /><a id="recode" class="f_org2 pl10" href="javascript:;">��һ��</a>
	        </div>
	    </div>';
}
echo '
    <div class="form-item">
    	<div class="field-name"></div>
        <div class="field-input">
          <p><input name="usecookie" type="checkbox" value="1" checked="checked" class="check" />��ס��(1�������¼)</p>
        </div>
    </div>
</fieldset>
    
<button name="submit" id="submit" class="btn-submit2" type="submit">��¼</button>
<input type="hidden" name="action" value="login">
<p class="snback f_blue"><br />�������룿���<a href="'.$this->_tpl_vars['url_getpass'].'" title="�һ�����">�һ�����</a></p>
</form>

  </div>
  <div class="lother">
   <h3>�û�ע��</h3>
   ��û���˺ţ�
   <a href="'.$this->_tpl_vars['jieqi_user_url'].'/register.php" onclick="openDialog(\''.$this->_tpl_vars['jieqi_user_url'].'/register.php?ajax_gets=jieqi_contents\', false);stopEvent();"  title="����ע��" class="reg"></a>
   ��Ҳ������վ���˺ŵ�¼:
    <p class="o_login"><a href="'.$this->_tpl_vars['jieqi_url'].'/api/qq/login.php" title="��ѶQQ" class="qq">
<a href="'.$this->_tpl_vars['jieqi_url'].'/api/weibo/login.php" title="����΢��" class="sina"></a>
 <a href="'.$this->_tpl_vars['jieqi_url'].'/api/weixin/login.php" title="΢�ŵ�¼" class="wechat"></a>
</div>
  

</a><a href="javascript:;" onclick="otherlogin(\''.$this->_tpl_vars['jieqi_url'].'/api/weibo/login.php\');" title="����΢��" class="sina"></a><a href="javascript:;" onclick="otherlogin(\'#\');" title="΢�ŵ�¼" class="wechat"></a><a href="javascript:;" onclick="otherlogin(\'#\');" title="�ٶȵ�¼" class="baidu"></a></p>



</div></div>

<script type="text/javascript">
layer.ready(function(){
		$(\'#frmlogin\').on(\'submit\', function(e){
		e.preventDefault();
		var i = layer.load(0);

        GPage.postForm(\'frmlogin\', $("#frmlogin").attr("action"),
       function(data){
            if(data.status==\'OK\'){
                layer.msg(data.msg,1,{type:1,shade:false},function(){});
                $.ajaxSetup ({ cache: false });
                jumpurl(data.jumpurl);
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
</script>';
?>