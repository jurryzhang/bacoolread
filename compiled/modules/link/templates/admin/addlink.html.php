<?php
echo '<script type="text/javascript">
<!--
var isIE = navigator.userAgent.toLowerCase().indexOf(\'ie\');
function getbyid(id) {
	if (document.getElementById) {
		return document.getElementById(id);
	} else if (document.all) {
		return document.all[id];
	} else if (document.layers) {
		return document.layers[id];
	} else {
		return null;
	}
}		
//计算字符串长度
function chklength(checkStr) {
	var n = 0;
	for (i = 0; i<checkStr.length; i++) {
		chcode = checkStr.charCodeAt(i);
		if (chcode>=0 && chcode<=255) {
			n++;
		} else {
			n += 2;
		}
	}
	return n;
}		
function submitcheck() {
	var name=getbyid("name");
	if(name) {
		var nlength = chklength(name.value);
		if (nlength < 2 || nlength > 50) {
			alert("'.$this->_tpl_vars['jieqi_lang']['need_link_title'].'");
			name.focus();
			return false;
		}
	}
	var url=getbyid("url");
	if(url) {
		if (chklength(url.value)<10 || chklength(url.value) > 100) {
			alert("'.$this->_tpl_vars['jieqi_lang']['need_link_url'].'");
			url.focus();
			return false;
		}
	}
	var logo=getbyid("logo");
	if(logo) {
		if (chklength(logo.value) > 100) {
			alert("'.$this->_tpl_vars['jieqi_lang']['need_link_logo'].'");
			logo.focus();
			return false;
		}
	}
	return true;
}
		

document.write("<OBJECT id=\\"dlgHelper\\" CLASSID=\\"clsid:3050f819-98b5-11cf-bb82-00aa00bdce0b\\" width=\\"0px\\" height=\\"0px\\"></OBJECT>"); 
var ocolorPopup = window.createPopup(); 
var ecolorPopup=null; 

function colordialogmouseout(obj){ 
obj.style.borderColor=""; 
obj.bgColor=""; 
} 

function colordialogmouseover(obj){ 
obj.style.borderColor="#0A66EE"; 
obj.bgColor="#EEEEEE"; 
} 

function colordialogmousedown(color){ 
ecolorPopup.value=color; 
document.getElementById(\'selectcolor\').style.color = color;
document.getElementById(\'namecolor\').value = color;
document.getElementById(\'name\').style.color = color;
ocolorPopup.document.body.blur(); 
} 

function colordialogmore(){ 
var sColor=dlgHelper.ChooseColorDlg(ecolorPopup.value); 
sColor = sColor.toString(16); 
if (sColor.length < 6) { 
var sTempString = "000000".substring(0,6-sColor.length); 
sColor = sTempString.concat(sColor); 
} 
ecolorPopup.value="#"+sColor.toUpperCase(); 
//document.body.bgColor="#"+sColor.toUpperCase(); 
ocolorPopup.document.body.blur(); 
} 

function colordialog(){ 
var e=event.srcElement; 
e.onkeyup=colordialog; 
ecolorPopup=e; 
var ocbody; 
var oPopBody = ocolorPopup.document.body; 
var colorlist=new Array(40); 
oPopBody.style.backgroundColor = "#f9f8f7"; 
oPopBody.style.border = "solid #999999 1px"; 
oPopBody.style.fontSize = "12px"; 

colorlist[0]="#000000"; colorlist[1]="#993300"; colorlist[2]="#333300"; colorlist[3]="#003300"; 
colorlist[4]="#003366"; colorlist[5]="#000080"; colorlist[6]="#333399"; colorlist[7]="#333333"; 

colorlist[8]="#800000"; colorlist[9]="#FF6600"; colorlist[10]="#808000";colorlist[11]="#008000"; 
colorlist[12]="#008080";colorlist[13]="#0000FF";colorlist[14]="#666699";colorlist[15]="#808080"; 

colorlist[16]="#FF0000";colorlist[17]="#FF9900";colorlist[18]="#99CC00";colorlist[19]="#339966"; 
colorlist[20]="#33CCCC";colorlist[21]="#3366FF";colorlist[22]="#800080";colorlist[23]="#999999"; 

colorlist[24]="#FF00FF";colorlist[25]="#FFCC00";colorlist[26]="#FFFF00";colorlist[27]="#00FF00"; 
colorlist[28]="#00FFFF";colorlist[29]="#00CCFF";colorlist[30]="#993366";colorlist[31]="#CCCCCC"; 

colorlist[32]="#FF99CC";colorlist[33]="#FFCC99";colorlist[34]="#FFFF99";colorlist[35]="#CCFFCC"; 
colorlist[36]="#CCFFFF";colorlist[37]="#99CCFF";colorlist[38]="#CC99FF";colorlist[39]="#FFFFFF"; 

ocbody = ""; 
ocbody += "<table CELLPADDING=0 CELLSPACING=3>"; 
ocbody += "<tr height=\\"20\\" width=\\"20\\"><td align=\\"center\\"><table style=\\"border:1px solid #808080;\\" width=\\"12\\" height=\\"12\\" bgcolor=\\""+e.value+"\\"><tr><td></td></tr></table></td><td bgcolor=\\"eeeeee\\" colspan=\\"7\\" style=\\"font-size:12px;\\" align=\\"center\\">当前颜色</td></tr>"; 
for(var i=0;i<colorlist.length;i++){ 
if(i%8==0) 
ocbody += "<tr>"; 
ocbody += "<td width=\\"14\\" height=\\"16\\" style=\\"border:1px solid;\\" onMouseOut=\\"parent.colordialogmouseout(this);\\" onMouseOver=\\"parent.colordialogmouseover(this);\\" onMouseDown=\\"parent.colordialogmousedown(\'"+colorlist[i]+"\')\\" align=\\"center\\" valign=\\"middle\\"><table style=\\"border:1px solid #808080;\\" width=\\"12\\" height=\\"12\\" bgcolor=\\""+colorlist[i]+"\\"><tr><td></td></tr></table></td>"; 
if(i%8==7) 
ocbody += "</tr>"; 
} 
ocbody += "<tr><td align=\\"center\\" height=\\"22\\" colspan=\\"8\\" onMouseOut=\\"parent.colordialogmouseout(this);\\" onMouseOver=\\"parent.colordialogmouseover(this);\\" style=\\"border:1px solid;font-size:12px;cursor:default;\\" onMouseDown=\\"parent.colordialogmore()\\">其它颜色...</td></tr>"; 
ocbody += "</table>"; 

oPopBody.innerHTML=ocbody; 
var pos = $_(\'selectcolor\').getPosition();

ocolorPopup.show(pos.x, pos.y + e.offsetHeight + 2, 158, 147, document.body); 
} 
//--> 
</script> 			
<br /><br />
<form id="theform" action="addlink.php" method="post" onsubmit="return submitcheck();" enctype="multipart/form-data">
		<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="grid">
		  <caption>';
if($this->_tpl_vars['link']['linkid']>0){
echo $this->_tpl_vars['jieqi_lang']['link_edit'];
}else{
echo $this->_tpl_vars['jieqi_lang']['link_add'];
}
echo '</caption>
		<tr>
		<td width="120">链接名称</td>
		<td width="480"><input name="name" type="text" size="45" value="'.$this->_tpl_vars['link']['name'].'" style="color:'.$this->_tpl_vars['link']['namecolor'].'"/>
		 <input id="selectcolor" name="selectcolor" type="button" onfocus="colordialog()" style="color:'.$this->_tpl_vars['link']['namecolor'].'" value="'.defaultval($this->_tpl_vars['link']['namecolor'],'文字颜色').'">
         <input type="hidden" name="namecolor" value="'.$this->_tpl_vars['link']['namecolor'].'" /></td>
		</tr>
		
		<tr>
		<td>链接url</td>
		<td><input name="url" type="text" id="url" size="60" value="'.defaultval($this->_tpl_vars['link']['url'],'http://').'" /></td>
		</tr>
		
		<tr>
		<td>链接logo</td>
		<td><input name="logo" type="text" id="logo" size="60" value="'.$this->_tpl_vars['link']['logo'].'" /></td>
		</tr>
		
		<tr>
          <td>联系人</td>
		  <td><input name="mastername" type="text" id="mastername" size="60" value="'.$this->_tpl_vars['link']['mastername'].'" /></td>
		  </tr>
		<tr>
          <td>联系方式</td>
		  <td><input name="mastertell" type="text" id="mastertell" size="60" value="'.$this->_tpl_vars['link']['mastertell'].'" /></td>
		  </tr>
		<tr>
		<td>链接介绍</td>
		<td><textarea name="introduce" cols="50" rows="8">'.$this->_tpl_vars['link']['introduce'].'</textarea></td>
		</tr>
		
		<tr>
		<td>显示顺序</td>
		<td><input name="listorder" type="text" size="5" value="';
if($this->_tpl_vars['link']['listorder']>0){
echo $this->_tpl_vars['link']['listorder'];
}else{
echo '0';
}
echo '" /></td>
		</tr>
		
		<tr>
		<td>&nbsp;</td>
		<td>
		<input type="hidden" name="action" value="';
if($this->_tpl_vars['link']['linkid']>0){
echo 'edit';
}else{
echo 'add';
}
echo '" />
		<button value="true" type="submit" name="linksubmit" class="submit">提交保存</button> 
		 ';
if($this->_tpl_vars['link']['linkid']>0){
echo '<button value="true" type="button" name="link" class="submit" onclick="javascript:history.back();">返回</button><input type="hidden" name="id" value="'.$this->_tpl_vars['link']['linkid'].'" />';
}
echo '
		</td>
		</tr>
  </table>
</form>';
?>