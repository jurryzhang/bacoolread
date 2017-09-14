<?php
echo '<div id="top_img" style="height:280px;background-image:url(/sink/image/login_top_img.jpg);background-position:center; background-repeat:no-repeat;background-size: initial;background-repeat-x: no-repeat;background-repeat-y: no-repeat;background-attachment: initial;background-origin: initial;background-clip: initial">
</div>

<script type="text/javascript">
    function loginfocus()
    {
        if(document.getElementById(\'username\'))
        {
            document.getElementById(\'username\').focus();
        }
        else if(document.getElementById(\'password\'))
        {
            document.getElementById(\'password\').focus();
        }
    }

    if (document.all)
    {
        window.attachEvent(\'onload\',loginfocus);
    }
    else
    {
        window.addEventListener(\'load\',loginfocus,false);
    }
</script>

<form name="frmlogin" method="post" action="'.$this->_tpl_vars['url_login'].'">
  <table class="grid" align="center" style="width:400px;margin:50px auto; border:0px">
    <!--<caption>'.$this->_tpl_vars['jieqi_sitename'].'管理系统后台</caption>-->
    <tr align="center">
      <td  style="border:0px">
        <table width="100%" class="hide">
          <tr>
            <!--<td width="35%" align="right" valign="middle">-->
            <!--用户名：-->
            <!--</td>-->

            <td align="center" valign="middle">
              ';
if($this->_tpl_vars['jieqi_username'] == ''){
echo '
              <input type="text" class="text" size="20" maxlength="30" style="width:240px" name="username" id="username" placeholder="用户名" onKeyPress="javascript: if (event.keyCode==32) return false;">
              ';
}else{
echo '
              <input type="text" class="text" size="20" maxlength="30" style="width:240px" name="username" id="username" placeholder="用户名" value="'.$this->_tpl_vars['jieqi_username'].'">
              ';
}
echo '
            </td>
          </tr>

          <tr>
            <!--<td align="right" valign="middle">-->
            <!--密　码：-->
            <!--</td>-->

            <td align="center" valign="middle">
              <input type="password" class="text" size="20" maxlength="30" style="width:240px" placeholder="密　码" name="password" id="password">
            </td>
          </tr>

          ';
if($this->_tpl_vars['show_checkcode'] == 1){
echo '
          <tr>
            <td align="right" valign="middle">
              验证码：
            </td>

            <td>
              <input type="text" class="text" size="4" maxlength="8" name="checkcode" onfocus="if($_(\'login_imgccode\').style.display == \'none\'){$_(\'login_imgccode\').src = \''.$this->_tpl_vars['jieqi_url'].'/checkcode.php\';$_(\'login_imgccode\').style.display = \'\';}" title="点击显示验证码"><img id="login_imgccode" src="" style="cursor:pointer;vertical-align:middle;margin-left:3px;display:none;" onclick="this.src=\''.$this->_tpl_vars['jieqi_url'].'/checkcode.php?rand=\'+Math.random();" title="点击刷新验证码">
            </td>
          </tr>
          ';
}
echo '

          <tr>
            <td>
              <input type="hidden" name="action" value="login">
            </td>
          </tr>

          <tr>
            <td align="center" valign="middle">
              <input type="submit"  class="button" style="width:248px"  value="登 录" name="submit">
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>

<style>
  .footer
  {
    clear: both;
    display: block;
    text-align: center;
    margin: 0px auto;
    position: fixed;
    bottom: 0px;
    align:center;
    width:99%;
  }
  
  .bottom-line
  {
    clear: both;
    display: block;
    text-align: center;
    margin: 0px auto;
    align:center;
	border-bottom:40px solid rgb(214,211,206);
    width:99%;
  }
  
</style>

<div class="footer" id="footer">
  <!--<div align="center" style="position: fixed;bottom: 0px; border: 1px solid red" id="footer">-->
  <a  href="'.$this->_tpl_vars['jieqi_url'].'/" title="返回首页">
    <img src="/sink/image/an_01.png" width="120px" />
  </a>

  <a href="javascript:history.back(1);" title="返回上页">
    <img src="/sink/image/an_02.png" width="120px" />
  </a>

  <a href="'.$this->_tpl_vars['jieqi_url'].'/getpass.php"" title="取回密码">
    <img src="/sink/image/an_03.png" width="120px" />
  </a>
  
  <div class=\'bottom-line\'>
  </div>
  
</div>';
?>