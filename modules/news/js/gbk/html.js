//����Ԫ��Ĭ������
if(document.forms[0].elements['newsidstart']) document.forms[0].elements['newsidstart'].disabled=true;
if(document.forms[0].elements['newsidend']) document.forms[0].elements['newsidend'].disabled=true;
//�ж����������
function checkFormsInput(){
	var objForm=document.forms[0];
	var nTpe=objForm.elements['htmltype'];
	var nID1=objForm.elements['newsidstart'];
	var nID2=objForm.elements['newsidend'];
	var nCat1=objForm.elements['news_pid'];
	var nCat2=objForm.elements['news_cid'];
	var nFile=objForm.elements['newstemplate'];
	if(nTpe[0].checked){
		if(!nCat1.value){alert('��ѡ������һ����Ŀ!');nCat1.focus();return false;}
		//if(!nCat2.value){alert('��ѡ�����Ŷ�����Ŀ!');nCat2.focus();return false;}
	}else if(nTpe[1].checked){
		if(!nID1.value){alert('������������ʼID!');nID1.focus();return false;}
		if(!nID2.value){alert('���������Ž���ID!');nID2.focus();return false;}
	}
	if(!nFile.value){alert('����������ģ���ļ���!');nFile.focus();return false;}
}
//����/���ñ���Ŀ
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