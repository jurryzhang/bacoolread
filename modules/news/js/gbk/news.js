//����Ԫ��Ĭ������
if(document.forms[0].elements['news_name']) document.forms[0].elements['news_name'].disabled=true;
//��ȡ�����е�ͼƬ·��
function fetchImagesPath(){
	var nPath=new Array();
	var nBody=tinyMCE.getContent()
	var nImage=document.forms[0].elements['news_image'];
	nPath=nBody.match(/\/\d{8}\/\d{4}\.(jpg|gif|png|bmp)/gi);
	if (nPath){for (i=0;i<nPath.length;i++){nImage.options[i+1]=new Option(nPath[i],nPath[i]);}}
}
//�ж����������
function checkFormsInput(){
	var objForm=document.forms[0];
	objForm.elements['news_body'].value=tinyMCE.getContent();
	var nType=objForm.elements['news_type']?objForm.elements['news_type']:null;
	var nName=objForm.elements['news_name']?objForm.elements['news_name']:null;
	var nParent=objForm.elements['news_pid'];
	var nChild=objForm.elements['news_cid'];
	var nTitle=objForm.elements['news_title'];
	//var nSource=objForm.elements['news_source'];
	var nAuthor=objForm.elements['news_author'];
	var nBody=objForm.elements['news_body'];
	
	if(nType && nName){
		if(nType[1].checked && !nName.value){alert('��������������!');nName.focus();return false;}
		if(nType[0].checked && !nParent.value){alert('��ѡ��һ��������Ŀ!');nParent.focus();return false;}
		if(nType[0].checked && !nChild.value){alert('��ѡ�����������Ŀ!');nChild.focus();return false;}
	}else{
		if(!nParent.value){alert('��ѡ��һ��������Ŀ!');nParent.focus();return false;}
		if(!nChild.value){alert('��ѡ�����������Ŀ!');nChild.focus();return false;}
	}
	if(!nTitle.value){alert('���������ű���!');nTitle.focus();return false;}
	//if(!nSource.value){alert('������������Դ!');nSource.focus();return false;}
	//if(!nAuthor.value){alert('��������������!');nAuthor.focus();return false;}
	if(!nBody.value){alert('��������������!');return false;}
}
//����/���ñ���Ŀ
function setElementsUseable(){
	var objForm=document.forms[0];
	var nType=objForm.elements['news_type'];
	var nName=objForm.elements['news_name'];
	var nKeys=objForm.elements['news_keyword'];
	var nCat1=objForm.elements['news_pid'];
	var nCat2=objForm.elements['news_cid'];
	var nImage=objForm.elements['news_image'];
	if(nType[0].checked){
		nName.disabled=true;
		nKeys.disabled=false;
		nCat1.disabled=false;
		nCat2.disabled=false;
		nImage.disabled=false;
	}else if(nType[1].checked){
		nName.disabled=false;
		nKeys.disabled=true;
		nCat1.disabled=true;
		nCat2.disabled=true;
		nImage.disabled=true;
	}
}