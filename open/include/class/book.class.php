<?php
class book{
    public function __construct() {
        $this->db = new mysql();
        $this->db -> mysql_link();
        $this->db->checksql();
        //$this->cache = new Cache();
    }
    public function getbookinfobyarray($array){
        if(count($array)>0){
            $Result = $this->db->query_array("SELECT A.articleid,A.articlename,A.keywords,A.author,A.intro,A.sortid,coalesce(B.lastchapterid,A.lastchapterid) AS lastchapterid,coalesce(B.lastchapter,A.lastchapter) AS lastchaptername,coalesce((A.chapters+B.chapters),A.chapters) AS chapters,floor(coalesce((A.size+B.size),A.size)/2) AS size,coalesce(B.lastupdate,A.lastupdate) AS lastupdate,coalesce(B.fullflag,A.fullflag) AS fullflag,A.postdate,A.allvisit,A.monthvisit,A.weekvisit,A.dayvisit,A.allvote,A.monthvote,A.weekvote,A.dayvote FROM ".MYSQL_PRE."article_article A LEFT JOIN ".MYSQL_PRE."obook_obook B ON A.articleid=B.articleid WHERE A.articleid in (".implode(",",$array).") ORDER BY find_in_set(A.articleid,'".implode(",",$array)."')");
            return $Result;
        }else{
            return array();
        }
    }
    public function getbookinfobyspiderid($spiderid){
        if($spiderid!=""){
            $Result = $this->db->query_array("SELECT * FROM ".MYSQL_PRE."article_article WHERE siteid='".$spiderid."' ORDER BY articleid ASC");
            return $Result;
        }else{
            return array();
        }
    }
    public function getbookinfobyid($id){
        if(intval($id)!=0){
            $Result = $this->db->query_object("SELECT A.*,coalesce(B.lastchapterid,a.lastchapterid) AS lastchapterid,coalesce(B.lastchapter,A.lastchapter) AS lastchaptername,floor(A.size/2) AS size,coalesce(B.lastupdate,A.lastupdate) AS lastupdate FROM ".MYSQL_PRE."article_article A LEFT JOIN ".MYSQL_PRE."obook_obook B ON A.articleid=B.articleid WHERE A.articleid = {$id}");
			return $Result;
        }else{
            return array();
        }
    }
    public function getbooklistbyid($id){
        if(intval($id)!=0){
            $temp = $this->db->query_array("SELECT *,floor(size/2) as size FROM ".MYSQL_PRE."article_chapter WHERE articleid = $id AND display=0 ORDER BY chapterorder ASC");
            $temp2 = $this->db->query_array("SELECT A.*,B.*,floor(A.size/2) as size FROM ".MYSQL_PRE."obook_ochapter A LEFT JOIN ".MYSQL_PRE."obook_obook B ON B.obookid=A.obookid WHERE B.articleid = $id AND A.display=0 ORDER BY A.chapterorder ASC");
            if(is_array($temp2)){
                $temp3 = array_merge($temp,$temp2);
            }else{
                $temp3=$temp;
            }
            return $temp3;
        }else{
            return array();
        }
    }
    public function getchapterbyid($bid,$cid){
        if(intval($bid)!=0&&intval($cid)!=0){
            $temp = $this->db->query_object("SELECT *,floor(size/2) as size FROM ".MYSQL_PRE."article_chapter WHERE articleid=$bid and chapterid = $cid AND display=0");
            if($temp->isvip > 0){
                $temp = $this->db->query_object("SELECT A.*,B.*,floor(A.size/2) as size FROM ".MYSQL_PRE."obook_ochapter A LEFT JOIN ".MYSQL_PRE."obook_obook B ON B.obookid=A.obookid WHERE B.articleid=$bid AND A.ochapterid = $cid AND A.display=0");
                if($temp){
                    $temp1 = $this->db->query_num("SELECT articleid FROM ".MYSQL_PRE."article_chapter WHERE articleid=$bid AND display=0");
                    $temp2 = $this->db->query_num("SELECT ochapterid FROM ".MYSQL_PRE."obook_ochapter A LEFT JOIN ".MYSQL_PRE."obook_obook B ON B.obookid=A.obookid WHERE B.articleid=$bid AND A.chapterorder <= ".$temp->chapterorder." AND A.display=0");
                    $temp->chapterorder = $temp1+$temp2;
                    $temp->txt = $this->db->query_field("SELECT ocontent FROM ".MYSQL_PRE."obook_ocontent WHERE ochapterid = $cid");
                    return $temp;
                }else{
                    return array();
                }
            }else{
                $temp->txt = false;
                return $temp;
            }
        }else{
            return array();
        }
    }
    public function getbooklistbyspiderid($spiderid){
        if($spiderid!=""){
            $temp = $this->db->query_array("SELECT * FROM ".MYSQL_PRE."article_article WHERE display=0 AND siteid='".$spiderid."'");
            if(is_array($temp)){
                $temp2=array();
                foreach($temp as $k => $v){
                    array_push($temp2,$v["sourceid"]);
                }
                return $temp2;
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
    private function formattrim($str){
     return str_replace(" ","",$str);
    }
    public function checkchapterandinsert($spiderid, $articleinfo, $chapterlist, $userid){
        if($spiderid != "" && $userid != ""){
			$user = $this->db->query_object("SELECT * FROM ".MYSQL_PRE."system_users WHERE uid='{$userid}'");
		    $article = $this->db->query_object("SELECT * FROM ".MYSQL_PRE."article_article WHERE siteid='{$spiderid}' AND sourceid='{$articleinfo->articleid}'");
            if($article){

                //检查封面如果为0则同步
                if($article->imgflag==0){
                   $this->getimg($article->articleid,$articleinfo->cover);
                }
				if($articleinfo->chapters == $article->chapters){
					return array();
				}else{
					return $chapterlist;
				}
            }else {
                /*小说入库*/
				$articlecode = jieqi_getpinyin(iconv("UTF-8","GB2312//IGNORE",$articleinfo->articlename));
				$initial = jieqi_getinitial(iconv("UTF-8","GB2312//IGNORE",$articleinfo->articlename));
				$re = $this->db->query("INSERT INTO ".MYSQL_PRE."article_article(siteid,sourceid,postdate,lastupdate,articlename,articlecode,keywords,initial,authorid,author,posterid,poster,sortid,intro,notice,fullflag,size,isvip,rgroup,lastchapterid,lastchapter,freetime,vipchapterid,vipchapter,viptime)VALUES('{$spiderid}', '{$articleinfo->articleid}', '{$articleinfo->postdate}', '{$articleinfo->lastupdate}', '{$articleinfo->articlename}', '{$articlecode}', '{$articleinfo->keywords}', '{$initial}', '{$userid}', '{$articleinfo->author}', '{$userid}', '{$user->uname}', '{$articleinfo->sortid}', '{$articleinfo->intro}', '{$articleinfo->notice}', '{$articleinfo->fullflag}', '{$articleinfo->words}', '{$articleinfo->isvip}', '{$articleinfo->rgroup}', '{$articleinfo->freechapterid}', '{$articleinfo->freechapter}', '{$articleinfo->freetime}', '{$articleinfo->vipchapterid}', '{$articleinfo->vipchapter}', '{$articleinfo->viptime}')");
                if($re){
                    $articleid=$this->db->insert_id();
                    $this->getimg($articleid,$articleinfo->cover);
                    return $chapterlist;
                }else{
                    return array();
                }
            }
        }else{
            return array();
        }
    }
    public function getimg($bookid,$coverurl){
        /*封面物理路径写死*/
        $path=dirname(TXTPATH)."/image/".intval($bookid/1000)."/".$bookid."/";
        miyue::check_dir($path);
        $filename = pathinfo(strtolower($coverurl));
        if($filename["extension"]=="jpg"||$filename["extension"]=="gif"||$filename["extension"]=="png"||$filename["extension"]=="jpeg"){
            $filepath = $path.$bookid."s.".$filename["extension"];
            $of = fopen($filepath,'w');
            //$f = new Hon6FetchURL();
            $result = fwrite($of,file_get_contents($coverurl));
            fclose($of);
            if($filename["extension"]=="jpg"){
                $imgflag = 1;
            }elseif($filename["extension"]=="gif"){
                $imgflag = 5;
            }elseif($filename["extension"]=="png"){
                $imgflag = 17;
            }else{
                $imgflag = 75;
            }
            if($result){
                $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET imgflag=".$imgflag." WHERE articleid=".$bookid);
            }
            return $result;
        }else{
            return false;
        }
    }
    public function insertchapter($spiderid,$bookid,$chapter){
		global $jieqiConfigs;
		
		if (!isset($jieqiConfigs["article"])) {
		   jieqi_getconfigs("article", "configs");
	    }

	    if (!isset($jieqiConfigs["obook"])) {
		   jieqi_getconfigs("obook", "configs");
	    }
		
        if($spiderid!="") {
            $article = $this->db->query_object("SELECT * FROM " . MYSQL_PRE . "article_article WHERE siteid='" . $spiderid . "' AND sourceid=" . $bookid);
			
            if($article) {
				$summary = jieqi_substr($chapter->content, 0, 500, "..");
				$chapter->words = ceil($chapter->words * 2);
				
				if (0 < $chapter->words) {
		            $chapter->saleprice = 0;
		                if (is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			               $wordsperegold = ceil($jieqiConfigs["obook"]["wordsperegold"]) * 2;

			             if ($jieqiConfigs["obook"]["priceround"] == 1) {
				               $chapter->saleprice = floor($chapter->words / $wordsperegold);
			                }
			                else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				               $chapter->saleprice = ceil($chapter->words / $wordsperegold);
			                }
			               else {
				               $chapter->saleprice = round($chapter->words / $wordsperegold);
			                }
		                }
	                }
	                else {
		                $chapter->saleprice = ($chapter->words == 0 ? 0 : intval($chapter->saleprice));
	                }
				
				/*检查是否入库过*/
                $oldchapter = $this->db->query_object("SELECT * FROM " . MYSQL_PRE . "article_chapter WHERE sourceid='{$bookid}' AND sourcecid ='{$chapter->chapterid}'");
				
				if($oldchapter){
					//有更新
					if($oldchapter->lastupdate != $chapter->lastupdate && $chapter->chaptertype == 0){
						return $this->inserttxt($article->articleid,$oldchapter->chapterid,$chapter->content,$chapter->lastupdate);
					}else{
					    return false;	
					}
				}else{
					//未入库开始入库
					$chpaterorder=$this->db->query_num("SELECT chapterid FROM " . MYSQL_PRE . "article_chapter WHERE articleid=".$article->articleid);
                    if(!$chpaterorder){
                       $chpaterorder = 1;
                    }else{
                       $chpaterorder++;
                    }
					$this->db->query("INSERT INTO " . MYSQL_PRE . "article_chapter (siteid,sourceid,sourcecid,articleid,articlename,volumeid,poster,postdate,lastupdate,chaptername,saleprice,size,salenum,totalcost,summary,isimage,isvip,chaptertype,power,display,chapterorder)VALUES('{$spiderid}', '{$bookid}', '{$chapter->chapterid}', '{$article->articleid}', '{$article->articlename}', '0', '{$article->poster}', '{$chapter->postdate}', '{$chapter->lastupdate}', '{$chapter->chaptername}', '{$chapter->saleprice}', '{$chapter->words}', '0', '0', '{$summary}', '0', '{$chapter->isvip}', '{$chapter->chaptertype}', '0', '0', '{$chpaterorder}')");
					$newchapterid = $this->db->insert_id();
				}
				
				/*收费章节处理*/
				if($chapter->isvip > 0){
				$obook =  $this->db->query_object("SELECT * FROM ".MYSQL_PRE."obook_obook WHERE articleid = ".$article->articleid);
				  if(!is_object($obook)){
			         $this->db->query("INSERT INTO " . MYSQL_PRE . "obook_obook(siteid,sourceid,postdate,lastupdate,obookname,keywords,articleid,initial,sortid,intro,notice,setting,author,authorid,posterid,poster)VALUES('{$article->siteid}', '{$bookid}', '{$article->postdate}', '{$article->lastupdate}', '{$article->articlename}', '{$article->keywords}', '{$article->articleid}', '{$article->initial}', '{$article->sortid}', '{$article->intro}', '{$article->notice}', '{$article->setting}', '{$article->author}', '{$article->authorid}', '{$article->posterid}', '{$article->poster}')");
		            }
				}
					
                /*判断小说是收费还是免费
                0免费 1收费*/
                if ($chapter->isvip == 0) {//免费
                    article_repack($article->articleid, array("makeopf" => 1, "makehtml" => 1), 0);
					if($newchapterid){
					   $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET lastupdate='{$chapter->lastupdate}',lastchapterid='{$newchapterid}',lastchapter='{$chapter->chaptername}',freetime='{$chapter->lastupdate}' WHERE articleid=" . $article->articleid);
					   if($chapter->chaptertype == 0){
                          return $this->inserttxt($article->articleid,$newchapterid,$chapter->content,$chapter->lastupdate);
					    }
                    }else{
                       return array(3);
                    }
                } elseif($chapter->isvip > 0) {//收费电子书
                        /*检查是否入库过*/
                        $oldvipchapter = $this->db->query_object("SELECT * FROM " . MYSQL_PRE . "obook_ochapter WHERE sourceid='{$bookid}' AND sourcecid ='{$chapter->chapterid}'");
                        if ($oldvipchapter) {
                            //已经入库对比更新时间
                            if ($oldvipchapter->lastupdate != $chapter->lastupdate && $chapter->chaptertype == 0) {
                                //有更新
                                return $this->inserttxtobook("update", $oldvipchapter->ochapterid, $chapter->content,$chapter->lastupdate);
                            } else {
                                return array(6);
                            }
                        } else {
                            //未入库开始入库
                            $chpaterorder=$this->db->query_num("SELECT ochapterid FROM " . MYSQL_PRE . "obook_ochapter WHERE obookid=".$obook->obookid);
                            if(!$chpaterorder){
                              $chpaterorder = 1;
                            }else{
                              $chpaterorder++;
                            }
							$this->db->query("INSERT INTO " . MYSQL_PRE . "obook_ochapter (ochapterid,siteid,sourceid,sourcecid,obookid,articleid,chapterid,postdate,lastupdate,obookname,chaptername,chaptertype,chapterorder,summary,size,posterid,poster,saleprice)VALUES('{$newchapterid}', '{$spiderid}', '{$bookid}', '{$chapter->chapterid}', '{$obook->obookid}', '{$article->articleid}', '{$newchapterid}', '{$chapter->postdate}', '{$chapter->lastupdate}', '{$article->articlename}', '{$chapter->chaptername}', '{$chapter->chaptertype}', '{$chpaterorder}', '{$summary}', '{$chapter->words}', '{$article->posterid}', '{$article->poster}', '{$chapter->saleprice}')");
							$vipnewchapterid = $this->db->insert_id();
                            if ($vipnewchapterid) {
								article_repack($article->articleid, array("makeopf" => 1, "makehtml" => 1), 0);
								
                                $this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET lastupdate='{$chapter->lastupdate}',lastchapterid={$vipnewchapterid},lastchapter='{$chapter->chaptername}',chapters='{$chpaterorder}',size=size+{$chapter->words},lastsummary='{$summary}' WHERE obookid=" . $obook->obookid);
								
								$this->db->query("UPDATE " . MYSQL_PRE . "article_article SET lastupdate='{$chapter->lastupdate}',viptime='{$chapter->lastupdate}',vipid='{$obook->obookid}', vipchapters='{$chpaterorder}', vipsize=vipsize+{$chapter->words}, vipchapterid='{$vipnewchapterid}', vipchapter='{$chapter->chaptername}', vipsummary='{$summary}' WHERE articleid=" . $article->articleid);
								if($chapter->chaptertype == 0){
                                   return $this->inserttxtobook("insert", $vipnewchapterid, $chapter->content, $chapter->lastupdate);
								}
                            } else {
                                return array(7);
                            }
                        }
                }
            }else{
                return array(1);
            }
        }else{
            return array(0);
        }
    }
    public function refreshbook($spiderid,$idstring){
        $Total = $this->db->query_num("SELECT articleid FROM " . MYSQL_PRE . "miyue_article WHERE spiderid='".$spiderid."' AND articleid in (".$idstring.")");
        if($Total!=count(explode(",",$idstring))){
            return false;
        }else {
            $this->db->query("DELETE FROM " . MYSQL_PRE . "article_chapter WHERE articleid in (" . $idstring . ")");
            $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET lastchapterid=0,lastchapter='',chapters=0,size=0 WHERE articleid in (" . $idstring . ")");
            $obookid = $this->getobookidbyarray($idstring);
            if($obookid) {
                $temp="";
                foreach($obookid as $k=>$v){
                    if($temp==""){
                        $temp.=$v["obookid"];
                    }else{
                        $temp.=",".$v["obookid"];
                    }
                }
                $this->db->query("DELETE FROM " . MYSQL_PRE . "obook_ochapter WHERE obookid in (" . $temp . ")");
                $this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET lastchapterid=0,lastchapter='',chapters=0,size=0 WHERE obookid in (" . $temp . ")");
            }
            return true;
        }
    }
    public function refreshbookcover($spiderid,$idstring){
        $Total = $this->db->query_num("SELECT articleid FROM " . MYSQL_PRE . "miyue_article WHERE spiderid='".$spiderid."' AND articleid in (".$idstring.")");
        if($Total!=count(explode(",",$idstring))){
            return false;
        }else {
            $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET imgflag=0 WHERE articleid in (" . $idstring . ")");
            return true;
        }
    }
    public function setonline($spiderid,$idstring,$answer){
        if($answer==0) {
            $this->db->query("UPDATE " . MYSQL_PRE . "miyue_article SET online=0 WHERE spiderid='" . $spiderid . "' AND articleid in (" . $idstring . ")");
        }else{
            $this->db->query("UPDATE " . MYSQL_PRE . "miyue_article SET online=1 WHERE spiderid='" . $spiderid . "' AND articleid in (" . $idstring . ")");
        }
    }
    public function setdisplay($spiderid,$idstring,$answer){
        if($answer==0) {
            $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET isapp=0 WHERE articleid in (" . $idstring . ")");
            //$this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET display=1 WHERE articleid in (" . $idstring . ")");
        }else{
            $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET isapp=1 WHERE articleid in (" . $idstring . ")");
            //$this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET display=0 WHERE articleid in (" . $idstring . ")");
        }
    }
    public function setshenhe($spiderid,$idstring,$answer){
        if($answer==0) {
            $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET display=0 WHERE articleid in (" . $idstring . ")");
            $this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET display=0 WHERE articleid in (" . $idstring . ")");
        }else{
            $this->db->query("UPDATE " . MYSQL_PRE . "article_article SET display=1 WHERE articleid in (" . $idstring . ")");
            $this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET display=1 WHERE articleid in (" . $idstring . ")");
        }
    }
    public function gettotalbooknumbyrobot(){
        return $this->db->query_num("SELECT articleid FROM " . MYSQL_PRE . "article_article WHERE siteid > 0");
    }
	//定时发布开始
    public function getautolist(){
        $Result = $this->db->query_array("SELECT * FROM ".MYSQL_PRE."article_draft WHERE display = 0 AND ispub > 0 AND pubdate<='".time()."' ORDER BY pubdate ASC, draftid ASC");
        return $Result;
    }
    public function autochapter($id){
		global $jieqiConfigs;
		
		if (!isset($jieqiConfigs["article"])) {
		   jieqi_getconfigs("article", "configs");
	    }

	    if (!isset($jieqiConfigs["obook"])) {
		   jieqi_getconfigs("obook", "configs");
	    }
		
        $postvars = $this->db->query_object("SELECT * FROM ".MYSQL_PRE."article_draft WHERE ispub > 0 AND pubdate<='".time()."' AND draftid=".$id);
		
		$article =  $this->db->query_object("SELECT * FROM ".MYSQL_PRE."article_article WHERE articleid = ".$postvars->articleid);
	
        if($postvars){
			$summary = jieqi_substr($postvars->chaptercontent, 0, 500, "..");
			if($postvars->isvip > 0){
				$obook =  $this->db->query_object("SELECT * FROM ".MYSQL_PRE."obook_obook WHERE articleid = ".$postvars->articleid);
		        if(!is_object($obook)){
			       $this->db->query("INSERT INTO " . MYSQL_PRE . "obook_obook(siteid,postdate,lastupdate,obookname,keywords,articleid,initial,sortid,intro,notice,setting,author,authorid,posterid,poster)VALUES('{$article->siteid}', '{$article->postdate}', '{$article->lastupdate}', '{$article->articlename}', '{$article->keywords}', '{$article->articleid}', '{$article->initial}', '{$article->sortid}', '{$article->intro}', '{$article->notice}', '{$article->setting}', '{$article->author}', '{$article->authorid}', '{$article->posterid}', '{$article->poster}')");
				}
		
				if ((0 < $postvars->size) && (!isset($postvars->saleprice) || !is_numeric($postvars->saleprice) || (intval($postvars->saleprice) < 0))) {
		            $postvars->saleprice = 0;
		                if (is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			               $wordsperegold = ceil($jieqiConfigs["obook"]["wordsperegold"]) * 2;

			             if ($jieqiConfigs["obook"]["priceround"] == 1) {
				               $postvars->saleprice = floor($postvars->size / $wordsperegold);
			                }
			                else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				               $postvars->saleprice = ceil($postvars->size / $wordsperegold);
			                }
			               else {
				               $postvars->saleprice = round($postvars->size / $wordsperegold);
			                }
		                }
	                }
	            else {
		            $postvars->saleprice = ($postvars->size == 0 ? 0 : intval($postvars->saleprice));
	            }
			}
                //免费书
                //未入库开始入库
                $chpaterorder=$this->db->query_num("SELECT chapterid FROM " . MYSQL_PRE . "article_chapter WHERE articleid=".$postvars->articleid);
                if(!$chpaterorder){
                    $chpaterorder = 1;
                }else{
                    $chpaterorder++;
                }
				
                $this->db->query("INSERT INTO " . MYSQL_PRE . "article_chapter (siteid,articleid,articlename,volumeid,posterid,poster,postdate,lastupdate,chaptername,chapterorder,saleprice,size,salenum,totalcost,summary,isimage,isvip,chaptertype,power,display)VALUES('{$article->siteid}', '{$postvars->articleid}', '{$postvars->articlename}', '0', '{$postvars->posterid}', '{$postvars->poster}', '{$postvars->postdate}', '{$postvars->lastupdate}', '{$postvars->chaptername}', '{$chpaterorder}', '{$postvars->saleprice}', '{$postvars->size}', '0', '0', '{$summary}', '0', '{$postvars->isvip}', '0', '0', '0')");
				$newchapterid = $this->db->insert_id();
			
			if($postvars->isvip == 0){
				article_repack($article->articleid, array("makeopf" => 1, "makehtml" => 1), 0);
                if($newchapterid){
					$this->db->query("UPDATE " . MYSQL_PRE . "article_article SET lastupdate='{$postvars->lastupdate}',lastchapterid='{$newchapterid}',lastchapter='{$postvars->chaptername}',freetime='{$postvars->lastupdate}' WHERE articleid=" . $postvars->articleid);
                    $this->autodelete($postvars->ispub,$id);
                    return $this->inserttxt($postvars->articleid,$newchapterid,$postvars->chaptercontent,$postvars->lastupdate);
                }else{
                    return array(3);
                }
            }elseif($obook && $postvars->isvip == 1){
				$chpaterorder=$this->db->query_num("SELECT ochapterid FROM " . MYSQL_PRE . "obook_ochapter WHERE obookid=".$obook->obookid);
                if(!$chpaterorder){
                    $chpaterorder = 1;
                }else{
                    $chpaterorder++;
                }
				$this->db->query("INSERT INTO " . MYSQL_PRE . "obook_ochapter (ochapterid,siteid,obookid,articleid,chapterid,postdate,lastupdate,obookname,chaptername,chaptertype,chapterorder,summary,size,posterid,poster,saleprice)VALUES('{$newchapterid}', '{$article->siteid}', '{$obook->obookid}', '{$postvars->articleid}', '{$newchapterid}', '{$postvars->postdate}', '{$postvars->lastupdate}', '{$article->articlename}', '{$postvars->chaptername}', '0', '{$chpaterorder}', '{$summary}', '{$postvars->size}', '{$postvars->posterid}', '{$postvars->poster}', '{$postvars->saleprice}')");
				$vipnewchapterid = $this->db->insert_id();
				
				if($vipnewchapterid){
					article_repack($article->articleid, array("makeopf" => 1, "makehtml" => 1), 0);
					$this->db->query("UPDATE " . MYSQL_PRE . "obook_obook SET lastupdate='{$postvars->lastupdate}',lastchapterid={$vipnewchapterid},lastchapter='{$postvars->chaptername}',chapters='{$chpaterorder}',size=size+{$postvars->size},lastsummary='{$summary}' WHERE obookid=" . $obook->obookid);
					
					$this->db->query("UPDATE " . MYSQL_PRE . "article_article SET lastupdate='{$postvars->lastupdate}',viptime='{$postvars->lastupdate}',vipid='{$obook->obookid}', vipchapters='{$chpaterorder}', vipsize=vipsize+{$postvars->size}, vipchapterid='{$vipnewchapterid}', vipchapter='{$postvars->chaptername}', vipsummary='{$summary}' WHERE articleid=" . $postvars->articleid);

					$this->autodelete($postvars->ispub,$id);
					return $this->inserttxtobook("insert", $vipnewchapterid, $postvars->chaptercontent, $postvars->lastupdate);
				}else{
					return array(3);
				}
			}else{
			    return "没有找到符合条件的记录！";
			}
        }else{
            return "没有找到符合条件的记录！";
        }
    }
	
    private function autodelete($ispub,$id){
        if($ispub==1){
            $this->db->query("DELETE FROM ".MYSQL_PRE."article_draft WHERE ispub = 1 AND pubdate <= '".time()."' AND draftid=".$id);
        }
    }
    private function inserttxt($bookid,$chapterid,$content,$lastupdate){
		$texttypeset = new TextTypeset();
		$content = $texttypeset->doTypeset($content);
        $path = TXTPATH.intval($bookid/1000)."/".$bookid."/".$chapterid.".txt";
        $path = iconv("utf-8","gbk",$path);
        miyue::check_dir(dirname($path));
        $of = fopen($path,'w');
        $result = fwrite($of,iconv("utf-8","gbk",$content));
        fclose($of);
        if($result){
            $this->db->query("UPDATE " . MYSQL_PRE . "article_chapter SET lastupdate='".$lastupdate."' WHERE chapterid=".$chapterid);
        }
        return $path;
    }
    private function inserttxtobook($way,$chapterid,$content,$lastupdate){
		$texttypeset = new TextTypeset();
		$content = $texttypeset->doTypeset($content);
        if($way=="insert") {
            $result = $this->db->query("INSERT INTO " . MYSQL_PRE . "obook_ocontent(ochapterid,ocontent)VALUES(" . $chapterid . ",'" . $content . "')");
        }else{
            $result = $this->db->query("UPDATE " . MYSQL_PRE . "obook_ocontent SET ocontent='".$content."' WHERE ochapterid=".$chapterid);
        }
        if($result){
            $this->db->query("UPDATE " . MYSQL_PRE . "obook_ochapter SET lastupdate='".$lastupdate."' WHERE ochapterid=".$chapterid);
        }
        return $result;
    }
    private function getobookidbyid($bookid){
        $temp = $this->db->query_field("SELECT obookid FROM " . MYSQL_PRE . "obook_obook WHERE articleid=".$bookid);
            return $temp;
    }
	//定时发布结束
    private function getobookidbyarray($isstring)
    {
        $temp = $this->db->query_array("SELECT obookid FROM " . MYSQL_PRE . "obook_obook WHERE articleid in (" . $isstring . ")");
        return $temp;
    }
    public function getbookcommentbybookid($bookid)
    {
        $temp = $this->db->query_array("SELECT title,posttime FROM " . MYSQL_PRE . "article_reviews WHERE ownerid = " . $bookid . " order by posttime desc limit 0,3");
        return $temp;
    }
}