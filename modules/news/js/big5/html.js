if(document.forms[0].elements['newsidstart']) document.forms[0].elements['newsidstart'].disabled=true;
if(document.forms[0].elements['newsidend']) document.forms[0].elements['newsidend'].disabled=true;
function checkFormsInput(){
	var objForm=document.forms[0];
	var nTpe=objForm.elements['htmltype'];
	var nID1=objForm.elements['newsidstart'];
	var nID2=objForm.elements['newsidend'];
	var nCat1=objForm.elements['news_pid'];
	var nCat2=objForm.elements['news_cid'];
	var nFile=objForm.elements['newstemplate'];
	if(nTpe[0].checked){
		if(!nCat1.value){alert('請選擇新聞一級欄目！');nCat1.focus();return false;}
	}else if(nTpe[1].checked){
		if(!nID1.value){alert('請輸入新聞起始ID！');nID1.focus();return false;}
		if(!nID2.value){alert('請輸入新聞結束ID！');nID2.focus();return false;}
	}
	if(!nFile.value){alert('請輸入新聞模板文件名稱！');nFile.focus();return false;}
}
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