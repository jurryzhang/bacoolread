<?php
echo '<br>
<table class="grid" width="100%">
  <caption>���ɳ�ֵ�㿨</caption>
<form name="form1" method="post" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/admin/makepaycard.php">
  <tr>
    <td width="29%" align="right" class="odd">��ֵ�����ţ�</td>
    <td width="71%" class="even"><input name="batchno" type="text" id="batchno" size="20" maxlength="11" class="text"> 
    �����ŵ�ǰ�沿�֣���������</td>
  </tr>
  <tr>
    <td align="right" class="odd">��ʼ��ţ�</td>
    <td class="even"><input name="startid" type="text" id="startid" size="20" maxlength="11" class="text" /> 
      ����������</td>
  </tr>
  <tr>
    <td align="right" class="odd">������ţ�</td>
    <td class="even"><input name="endid" type="text" id="endid" size="20" maxlength="11" class="text" />
���������֣�������ű�����ڵ�����ʼ���</td>
  </tr>
  <tr>
    <td align="right" class="odd">���ų��ȣ�</td>
    <td class="even"><input name="cardlen" type="text" id="cardlen" size="20" maxlength="11" class="text" />
���������֣��������30λ</td>
  </tr>
  <tr>
    <td align="right" class="odd">���볤�ȣ�</td>
    <td class="even"><input name="passlen" type="text" id="passlen" size="20" maxlength="11" class="text">
���������֣��������30λ</td>
  </tr>
  <tr>
    <td align="right" class="odd">�����ʽ��</td>
    <td class="even"><input name="passtype" type="radio" value="1" checked="checked" />
      ȫ���� 
        <input type="radio" name="passtype" value="2" />
      ȫ��ĸ 
      <input type="radio" name="passtype" value="3" />
      ������ĸ���</td>
  </tr>
  <tr>
    <td align="right" class="odd">��ֵ��</td>
    <td class="even"><input name="payemoney" type="text" id="payemoney" size="20" maxlength="11" class="text"> 
    ����ң�����������</td>
  </tr>
  
  <tr>
    <td colspan="2" class="odd">˵�������������� abc123 ����ʼ��� 0 ��������� 99�����ų��� 10 �������ɵĿ���Ϊ�� abc1230000 �� abc1230099 ��</td>
    </tr>
  <tr>
    <td align="right" class="odd"><input name="action" type="hidden" value="makepaycard" /></td>
    <td class="even"><input type="submit" name="make1" value="��ʼ����" class="button"></td>
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