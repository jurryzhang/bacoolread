<?php
echo '<script type="text/javascript" src="/scripts/common.js"></script>
<div id="content">
    <link rel="stylesheet" rev="stylesheet" href="/sink/css/login.css" type="text/css" media="all" />
    <div class="box_mid fix">
        <div class="regist fix">
            <h4>'.$this->_tpl_vars['apititle'].'��¼�ɹ������Ʊ�վ�˺���Ϣ</h4>

            <form name="frmbindnew" id="frmbindnew" action="'.$this->_tpl_vars['jieqi_user_url'].'/api/'.$this->_tpl_vars['apiname'].'/bind.php?do=submit" method="post">
                <fieldset>
                    <div class="form-item">
                        <div class="field-name">�û���:</div>
                        <div class="field-input">
                            <input type="text" class="text" name="username" id="username" size="25" maxlength="30" style="width:160px" value="'.$this->_tpl_vars['api_nickname'].'" onBlur="Ajax.Update(\''.$this->_tpl_vars['check_url'].'?item=u&username=\'+this.value, {outid:\'usermsg\', tipid:\'usermsg\', onLoading:\'<img border=\\\'0\\\' height=\\\'16\\\' width=\\\'16\\\' src=\\\''.$this->_tpl_vars['jieqi_url'].'/images/loading.gif\\\' /> Loading...\'});" />
                            <span id="usermsg"></span>
                            <br /><span style="line-height:150%;color:gray;">���ڱ�վ��¼����ʾ���û���</span>
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
                        <div class="field-name">��վ����:</div>
                        <div class="field-input">
                            <input type="password" class="text" name="password" id="password" size="25" maxlength="20" style="width:160px" value="" />
                            <span id="passmsg"></span>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="field-name">ȷ������:</div>
                        <div class="field-input">
                            <input type="password" class="text" name="repassword" id="repassword" size="25" maxlength="20" style="width:160px" value="" />
                            <span id="repassmsg"></span>
                            <br /><span style="line-height:150%;color:gray;">�ظ������������롣</span>
                        </div>
                    </div>
                </fieldset>

                <button name="submit" id="submit" class="btn-submit2" type="submit">ȷ�ϰ�</button>
                <input type="hidden" name="action" value="bindnew" />
            </form>
        </div>

        <div class="remark">
            <dl>
                <dt>ע���Ϊ'.$this->_tpl_vars['jieqi_pagetitle'].'��Ա������ӵ�У�</dt>
                <dd>&middot;ӵ�к�������ղظ���ͼ��</dd>
                <dd>&middot;Ͷ�Ƽ�Ʊ��ϲ����С˵,֧�����ߴ���</dd>
                <dd>&middot;����ΪVIP,�½ڶ������Ż�</dd>
                <dd>&middot;�����Ա,��õ��ϼ���Ʒ��㿴</dd>
            </dl>

        </div>
    </div>
</div>

<div class="tabvalue" style="display:none">
    <form name="frmbindold" id="frmbindold" action="'.$this->_tpl_vars['jieqi_user_url'].'/api/'.$this->_tpl_vars['apiname'].'/bind.php?do=submit" method="post">
        <table class="grid" width="80%" align="center">
            <caption>'.$this->_tpl_vars['apititle'].'��¼�ɹ�������վ�����˺Ű�</caption>
            <tr>
                <td class="tdl" width="25%">�û���</td>
                <td class="tdr"><input type="text" class="text" size="20" maxlength="30" style="width:120px" name="username" onKeyPress="javascript: if (event.keyCode == 32 || event.which == 32) return false;">
                </td>
            </tr>
            <tr>
                <td class="tdl" width="25%">�ܡ���</td>
                <td class="tdr"><input type="password" class="text" size="20" maxlength="30" style="width:120px" name="password"></td>
            </tr>
            <tr>
                <td class="tdl" width="25%">&nbsp;<input type="hidden" name="action" id="action" value="bindold" /></td>
                <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="ȷ�ϰ�" />
                    <!--<a href="'.$this->_tpl_vars['jieqi_url'].'/">�Ժ���˵������ȥ���飡</a>-->
                </td>
            </tr>
        </table>
    </form>
</div>
';
?>