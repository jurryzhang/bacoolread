<?
function ic($aid){//取COOKIES
	return $_COOKIE[$aid];
}

function gc($aid,$cid){//存COOKIES
//如果已经有AID  与 如果没有AID
if(@empty($_COOKIE[$aid])){
	setcookie($aid,$cid,time()+31536000,'/');//存c
}
//换c
	setcookie($aid,'',time()-3600);//先删除
	setcookie($aid,$cid,time()+31536000,'/');//存c
}