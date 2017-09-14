<?php

@ignore_user_abort(true);
@set_time_limit(3600);
@session_write_close();
require_once ("../../global.php");
include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

$method = $_GET['method'];
$zt=array('0'=>'2','1'=>'1');
if($method=='booklist') {
    $type= intval($_GET['type']);   
    $sql = "SELECT articleid,articlename,lastupdate,display,author,keywords,sortid,intro,size,postdate,imgflag FROM " . jieqi_dbprefix("article_article") . " WHERE sortid = " . $type . " and xunlei=1";
    $query->execute($sql);
    $data=array();
    while ($row = $query->getRow()) {
        $fid = floor($row['articleid']/1000);
        $data[]=array(
            "book_id"=>(string)$row['articleid'],
            "cover_link"=>jieqi_geturl('article', 'cover',$row['articleid'], 'l', $row['imgflag']),
            "book_name"=>iconv("GBK","UTF-8//IGNORE",$row['articlename']),
            "type_id"=> (string)$row['sortid'],
            "author"=>iconv("GBK","UTF-8//IGNORE",$row['author']),
            "keywords"=>iconv("GBK","UTF-8//IGNORE",$row['keywords']),
            "description"=>iconv("GBK","UTF-8//IGNORE",$row['intro']),
            "price"=>'',
            "price_unit"=>"°´ÕÂÊÕ·Ñ",
            "book_status"=>$zt[$row['display']],
            "create_data"=>date('Y-m-d H:i:s',$row['postdate']),
            "book_size"=>(string)$row['size'],
            "is_out"=>"2",
            "pub_name"=>"",
            "isbn_id"=>""
        );
    }
    $arr['result']="0";
    $arr['message']='ok';
    $arr['data']=$data;
    echo json_encode($arr);
}

if($method=='getchapter') {
    $bookid = intval($_GET['bookid']);
    $sql = "SELECT chapterid,chaptername,isvip,chaptertype FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = " . $bookid . " ";
    $query->execute($sql);
    $data=array();
    while ($row = $query->getRow()) {
        if($row['chaptertype']!=1) {
            $data[] = array(
                 "chapter_id"=>(string)$row['chapterid'],
                "chapter_name"=>iconv("GBK","UTF-8//IGNORE",$row['chaptername']),
                "is_vip"=>(string)$row['isvip']
            );
        }
    }
    
    $arr['result']="0";
    $arr['message']='ok';
    $arr['data']=$data;
    echo json_encode($arr);
}
if($method=='getcontents') {
    $bookid = intval($_GET['bookid']);
    $chapterid = intval($_GET['chapterid']);
    $sql = "SELECT isvip FROM " . jieqi_dbprefix("article_chapter") . " WHERE chapterid = " . $chapterid . " LIMIT 0, 1";
    $query->execute($sql);
    $arow = $query->getRow();
    if ($arow['isvip'] ==1) {
        $sql = "SELECT ocontent FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = " . $chapterid . " LIMIT 0, 1";
        $query->execute($sql);
        $arow = $query->getRow(); 
        $content = $arow['ocontent'];
    } else {
        global $jieqiConfigs;
        $retdir=jieqi_uploadpath($jieqiConfigs['article'][$dirtype], 'article');
        $retdir .= '/txt'.jieqi_getsubdir($bookid);
        $content = @jieqi_readfile ($retdir.'/'.$bookid.'/'.$chapterid.'.txt');
    }
    $data = array(
         "book_id"=>(string)$bookid,
        "chapter_id"=>(string)$chapterid,
        "content"=>iconv("GBK","UTF-8//IGNORE",$content),
    );
    $arr['result']="0";
    $arr['message']='ok';
    $arr['data']=$data;
    echo json_encode($arr);
}