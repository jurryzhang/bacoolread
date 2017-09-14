<?php
$usercode = 'chuangkuaiqiyi9XecYti5';
$key = 'chuangkuaiqiyicontente3qgy7t';

header('Content-type: application/json; charset=UTF-8');
@set_time_limit(3600);
require_once ("../../global.php");
include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

jieqi_getconfigs( "article", "sort" );

if($_GET['identity']!=$usercode) {
    exit(json_encode(array('code'=>'A00001','msg'=>'wrong identity')));
}

$method = $_GET['method'];
$zt=array('0'=>2,'1'=>1);
if($method=='list') {
    $lastUpdateTime= intval($_GET['lastUpdateTime']/1000);   
    $sql = "SELECT articleid,articlename,lastupdate,display,author,keywords,sortid,intro,size,postdate FROM " . jieqi_dbprefix("article_article") . " WHERE lastupdate >= " . $lastUpdateTime . " and iqiyi=1";
    $query->execute($sql);
    $data=array();
    while ($row = $query->getRow()) {
        $fid = floor($row['articleid']/1000);
        $data[]=array(
             "id"=>(int)$row['articleid']
        );
    }
    $arr['code']='A00000';
    $arr['data']=array('books'=>$data,'timestamp'=>(int)time()*1000);
    $arr['msg']='Success';
    echo json_encode($arr);
}
if($method=='info') {
    $bookId= intval($_GET['bookId']);   
    $sql = "SELECT articleid,articlename,lastupdate,display,author,keywords,sortid,intro,size,postdate,chapters,imgflag,typeid FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . $bookId . " limit 0,1";
    $query->execute($sql);
    $row = $query->getRow();
    $fid = floor($row['articleid']/1000);
    if($row['typeid']<=28) {
        $cate = '男生';
    } else {
        $cate = '女生';
    }
    $data=array(
        "id"=>(int)$row['articleid'],
        "name"=>iconv("GBK","UTF-8//IGNORE",$row['articlename']),
        "aliasName"=>"",
        "foreignName"=>"",
        "author"=>iconv("GBK","UTF-8//IGNORE",$row['author']),
        "translator"=>"",
        "briefDescription"=>iconv("GBK","UTF-8//IGNORE",$row['intro']),
        "promptDescription"=>"",
        "keywords"=>iconv("GBK","UTF-8//IGNORE",$row['keywords']),
        "coverImg"=> jieqi_geturl('article', 'cover',$row['articleid'], 'l', $row['imgflag']),
        "bookType"=>2,
        "bookMediaType"=>1,
        "progress"=>$zt[$row['display']],
        "chapterCount"=>(int)$row['chapters'],
        "cpUpdateTime"=>(int)$row['lastupdate']*1000,
        "category"=>$cate.",".iconv("GBK","UTF-8//IGNORE",$jieqiSort['article'][$row['sortid']]['caption'].','.$jieqiSort['article'][$row['sortid']]['types'][$row['typeid']]),
    );
    $arr['code']='A00000';
    $arr['data']=$data;
    $arr['msg']='Success';
    echo json_encode($arr);
}



if($method=='structure') {
    $bookId = intval($_GET['bookId']);
    $sql = "SELECT chapterid,chaptername,isvip,chapterorder,chaptertype FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . $bookId . " order by chapterorder asc ";
    $query->execute($sql);
    $volume=array();
    while ($row = $query->getRow()) {
        
        if($row['chaptertype']==1) {
            ++$i;
            $volumeA = $row;
            $volume[]= array(
                "volumeId"=>(int)$row['chapterid'],
                "volumeNumber"=>(int)$i,
                "volumeTitle"=>iconv("GBK","UTF-8//IGNORE",$row['chaptername']),
                "volumeType"=>1,
            );
            $k=0;
        }else {
            ++$k;
            $chapter[$i][] = array(
                "chapterId"=>(int)$row['chapterid'],
                "chapterNumber"=>$k,
            );
        }
        if (!$volumeA) {
            $volumeA = array('chapterid'=>1,'chaptername'=>'正文');
            $i=1;
            $k=0;
            $volume[]= array(
                "volumeId"=>1,
                "volumeNumber"=>$i,
                "volumeTitle"=>"正文",
                "volumeType"=>1,
            );
        }
    }
    foreach ($volume as $k=>$v) {
        $volume[$k]['chapterCount ']=count($chapter[$v['volumeNumber']]);
        $volume[$k]['chapters']=$chapter[$v['volumeNumber']];
    }
    $arr['code']='A00000';
    $arr['data']['volumes']=$volume;
    $arr['msg']='Success';
    echo json_encode($arr);
}
if($method=='chapterinfo') {
    $articleid = intval($_GET['bookId']);
    $chapterid = intval($_GET['chapterId']);
    $verify = $_GET['verify'];
    $sign = $_GET['sign'];
    $volumeid = intval($_GET['volumeId']);
    if ($sign!=md5("$verify#".md5("$chapterid#$usercode#chuangkuaiqiyicontente3qgy7t"))) {
        exit(json_encode(array('code'=>'A00002','msg'=>'wrong sign')));
    }
    
    
    
    $sql = "SELECT isvip,chaptername FROM " . jieqi_dbprefix("article_chapter") . " WHERE chapterid = " . $chapterid . " LIMIT 0, 1";
    $query->execute($sql);
    $row = $query->getRow();
    if ($row['isvip'] ==1) {
        $sql = "SELECT ocontent FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = " . $chapterid . " LIMIT 0, 1";
        $query->execute($sql);
        $arow = $query->getRow(); 
        $content = $arow['ocontent'];
    } else {
        $retdir=jieqi_uploadpath($jieqiConfigs['article']['txtdir'], 'article');
        $retdir .= '/txt'.jieqi_getsubdir($articleid);
        $content = @jieqi_readfile ($retdir.'/'.$articleid.'/'.$chapterid.'.txt');
    }
    $data = array(
        'id'=>(int)$chapterid,
        'title'=>iconv("GBK","UTF-8//IGNORE",$row['chaptername']),
        'volumeId'=>(int)$volumeid,
        'bookId'=>(int)$articleid,
        'content'=>iconv("GBK","UTF-8//IGNORE",  str_replace("\r","",$content)),
    );
    $arr['code']='A00000';
    $arr['data']=$data;
    $arr['msg']='Success';
    echo json_encode($arr);
}

