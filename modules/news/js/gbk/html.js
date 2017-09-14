//设置元素默认属性
if(document.forms[0].elements['newsidstart']) document.forms[0].elements['newsidstart'].disabled=true;
if(document.forms[0].elements['newsidend']) document.forms[0].elements['newsidend'].disabled=true;
//判断输入表单内容
function checkFormsInput(){
	var objForm=document.forms[0];
	var nTpe=objForm.elements['htmltype'];
	var nID1=objForm.elements['newsidstart'];
	var nID2=objForm.elements['newsidend'];
	var nCat1=objForm.elements['news_pid'];
	var nCat2=objForm.elements['news_cid'];
	var nFile=objForm.elements['newstemplate'];
	if(nTpe[0].checked){
		if(!nCat1.value){alert('请选择新闻一级栏目!');nCat1.focus();return false;}
		//if(!nCat2.value){alert('请选择新闻二级栏目!');nCat2.focus();return false;}
	}else if(nTpe[1].checked){
		if(!nID1.value){alert('请输入新闻起始ID!');nID1.focus();return false;}
		if(!nID2.value){alert('请输入新闻结束ID!');nID2.focus();return false;}
	}
	if(!nFile.value){alert('请输入新闻模板文件名!');nFile.focus();return false;}
}
//启用/禁用表单项目
function setElementsUseable(){
	var objForm=document.forms[0];
	var nTpe=objForm.elements['htmltype'];
	var nID1=objForm.elements['newsidstart'];
	var nID2=objForm.elements['newsidend'];
	var nCat1=objForm.elements['news_pid'];
	var nCat2=objForm.elements['news_cid'];
	if(nTpe[0].checked){
		nID1.disabled=true;
		nID2.disabled=true;
		nCat1.disabled=false;
		nCat2.disabled=false;
		nCat1.focus();
	}else if(nTpe[1].checked){
		nID1.disabled=false;
		nID2.disabled=false;
		nCat1.disabled=true;
		nCat2.disabled=true;
		nID1.focus();
	}
}