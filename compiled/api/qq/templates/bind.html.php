<?php
echo '<script type="text/javascript" src="/scripts/common.js"></script>
<div id="content">
    <link rel="stylesheet" rev="stylesheet" href="/sink/css/login.css" type="text/css" media="all" />
    <div class="box_mid fix">
        <div class="regist fix">
            <h4>'.$this->_tpl_vars['apititle'].'登录成功，完善本站账号信息</h4>

            <form name="frmbindnew" id="frmbindnew" action="'.$this->_tpl_vars['jieqi_user_url'].'/api/'.$this->_tpl_vars['apiname'].'/bind.php?do=submit" method="post">
                <fieldset>
                    <div class="form-item">
                        <div class="field-name">用户名:</div>
                        <div class="field-input">
                            <input type="text" class="text" name="username" id="username" size="25" maxlength="30" style="width:160px" value="'.$this->_tpl_vars['api_nickname'].'" onBlur="Ajax.Update(\''.$this->_tpl_vars['check_url'].'?item=u&username=\'+this.value, {outid:\'usermsg\', tipid:\'usermsg\', onLoading:\'<img border=\\\'0\\\' height=\\\'16\\\' width=\\\'16\\\' src=\\\''.$this->_tpl_vars['jieqi_url'].'/images/loading.gif\\\' /> Loading...\'});" />
                            <span id="usermsg"></span>
                            <br /><span style="line-height:150%;color:gray;">用于本站登录及显示的用户名</span>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="field-name">Email:</div>
                        <div class="field-input">
                            <input type="text" class="text" name="email" id="email" size="25" maxlength="60" style="width:160px" value="" onBlur="Ajax.Update(\''.$this->_tpl_vars['check_url'].'?item=m&email=\'+this.value, {outid:\'mailmsg\', tipid:\'mailmsg\', onLoading:\'<img border=\\\'0\\\' height=\\\'16\\\' width=\\\'16\\\' src=\\\''.$this->_tpl_vars['jieqi_url'].'/images/loading.gif\\\' /> Loading...\'});" />
                            <span id="mailmsg"></span>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="field-name">本站密码:</div>
                        <div class="field-input">
                            <input type="password" class="text" name="password" id="password" size="25" maxlength="20" style="width:160px" value="" />
                            <span id="passmsg"></span>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="field-name">确认密码:</div>
                        <div class="field-input">
                            <input type="password" class="text" name="repassword" id="repassword" size="25" maxlength="20" style="width:160px" value="" />
                            <span id="repassmsg"></span>
                            <br /><span style="line-height:150%;color:gray;">重复输入以上密码。</span>
                        </div>
                    </div>
                </fieldset>

                <button name="submit" id="submit" class="btn-submit2" type="submit">确认绑定</button>
                <input type="hidden" name="action" value="bindnew" />
            </form>
        </div>

        <div class="remark">
            <dl>
                <dt>注册成为'.$this->_tpl_vars['jieqi_pagetitle'].'会员，您将拥有：</dt>
                <dd>&middot;拥有海量书架收藏更多图书</dd>
                <dd>&middot;投推荐票给喜欢的小说,支持作者创作</dd>
                <dd>&middot;升级为VIP,章节订阅最优惠</dd>
                <dd>&middot;购买会员,最好的上架作品随便看</dd>
            </dl>

        </div>
    </div>
</div>

<div class="tabvalue" style="display:none">
    <form name="frmbindold" id="frmbindold" action="'.$this->_tpl_vars['jieqi_user_url'].'/api/'.$this->_tpl_vars['apiname'].'/bind.php?do=submit" method="post">
        <table class="grid" width="80%" align="center">
            <caption>'.$this->_tpl_vars['apititle'].'登录成功，跟本站已有账号绑定</caption>
            <tr>
                <td class="tdl" width="25%">用户名</td>
                <td class="tdr"><input type="text" class="text" size="20" maxlength="30" style="width:120px" name="username" onKeyPress="javascript: if (event.keyCode == 32 || event.which == 32) return false;">
                </td>
            </tr>
            <tr>
                <td class="tdl" width="25%">密　码</td>
                <td class="tdr"><input type="password" class="text" size="20" maxlength="30" style="width:120px" name="password"></td>
            </tr>
            <tr>
                <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="bindold" /></td>
                <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="确认绑定" />
                    <!--<a href="'.$this->_tpl_vars['jieqi_url'].'/">以后再说，立即去看书！</a>-->
                </td>
            </tr>
        </table>
    </form>
</div>
';
?>