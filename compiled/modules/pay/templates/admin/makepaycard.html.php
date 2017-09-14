<?php
echo '<br>
<table class="grid" width="100%">
  <caption>生成冲值点卡</caption>
<form name="form1" method="post" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/admin/makepaycard.php">
  <tr>
    <td width="29%" align="right" class="odd">冲值卡批号：</td>
    <td width="71%" class="even"><input name="batchno" type="text" id="batchno" size="20" maxlength="11" class="text"> 
    即卡号的前面部分，允许留空</td>
  </tr>
  <tr>
    <td align="right" class="odd">起始序号：</td>
    <td class="even"><input name="startid" type="text" id="startid" size="20" maxlength="11" class="text" /> 
      必须是数字</td>
  </tr>
  <tr>
    <td align="right" class="odd">结束序号：</td>
    <td class="even"><input name="endid" type="text" id="endid" size="20" maxlength="11" class="text" />
必须是数字，结束序号必须大于等于起始序号</td>
  </tr>
  <tr>
    <td align="right" class="odd">卡号长度：</td>
    <td class="even"><input name="cardlen" type="text" id="cardlen" size="20" maxlength="11" class="text" />
必须是数字，最长不超过30位</td>
  </tr>
  <tr>
    <td align="right" class="odd">密码长度：</td>
    <td class="even"><input name="passlen" type="text" id="passlen" size="20" maxlength="11" class="text">
必须是数字，最长不超过30位</td>
  </tr>
  <tr>
    <td align="right" class="odd">密码格式：</td>
    <td class="even"><input name="passtype" type="radio" value="1" checked="checked" />
      全数字 
        <input type="radio" name="passtype" value="2" />
      全字母 
      <input type="radio" name="passtype" value="3" />
      数字字母混合</td>
  </tr>
  <tr>
    <td align="right" class="odd">冲值金额：</td>
    <td class="even"><input name="payemoney" type="text" id="payemoney" size="20" maxlength="11" class="text"> 
    虚拟币，必须是数字</td>
  </tr>
  
  <tr>
    <td colspan="2" class="odd">说明：比如批号是 abc123 ，起始序号 0 ，结束序号 99，卡号长度 10 ，则生成的卡号为从 abc1230000 到 abc1230099 。</td>
    </tr>
  <tr>
    <td align="right" class="odd"><input name="action" type="hidden" value="makepaycard" /></td>
    <td class="even"><input type="submit" name="make1" value="开始生成" class="button"></td>
  </tr>
  <tr>
    <td colspan="2" align="right" class="foot">&nbsp;</td>
  </tr>
  </form>
</table>

<br>
<br>
';
?>