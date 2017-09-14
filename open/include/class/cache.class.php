<?
class Cache {
	public $staticindex = 0;
	public $staticindextime = 60;
    public function __construct(){
        
        $this->cachepath = ROOT_PATH."/cache/";
        if($this->staticindex==1){//file
            $this->cachepath = ROOT_PATH."/cache/";
        }elseif($this->staticindex==2){//memcache
            $this->mem = new Memcache;
            $this->mem->connect("localhost","11211");
        }else{
            return false;
        }
    }

    public function set($key,$value){
        
        if($this->staticindex==1){//file
            $result = $this->writefile($key,$value);
        }elseif($this->staticindex==2){//memcache
            $result = $this->writemem($key,$value);
        }else{
            return false;
        }
        return $result;
    }

    public function get($key){
        
        if($this->staticindex==1){//file
            $result = $this->readfile($key);
        }elseif($this->staticindex==2){//memcache
            $result = $this->readmem($key);
        }else{
            return false;
        }
        return $result;
    }

    public function setfile($key,$value){
        
        if($this->staticindex!=0){//file
            $result = $this->writefile($key,$value);
        }else{
            return false;
        }
        return $result;
    }

    public function getfile($key){
        
        if($this->staticindex!=0){//file
            $result = $this->readfile($key);
        }else{
            return false;
        }
        return $result;
    }

    public function iscached($key){
        
        if($this->staticindex==1){//file
            $result = file_exists($this->cachepath.$key.".php");
        }elseif($this->staticindex==2){//memcache
            $result = (bool)$this->readmem($key);
        }else{
            return false;
        }
        return $result;
    }

    private function writefile($key,$value){
        miyue::check_dir(dirname($this->cachepath.$key.".php"));
        $temp["cachecreattime"] = time();
        $temp["cache"] = $value;
        $of = fopen($this->cachepath.$key.".php",'w');
        $result = fwrite($of,"<?php\nreturn '".serialize($temp)."';\n?>");
        fclose($of);
        return $result;
    }

    private function readfile($key){
        $result = @include($this->cachepath.$key.".php");
        if($result){
            $result = unserialize($result);
            $staticindextime = $this->staticindextime>0 ? $this->staticindextime : 3600;
            if(time()-$result["cachecreattime"]>$staticindextime){
                unlink($this->cachepath.$key.".php");
            }
            $result = $result["cache"];
        }
        return $result;
    }

    private function writemem($key,$value){
        
        $staticindextime = $this->staticindextime>0 ? $this->staticindextime : 3600;
        $result = $this->mem->set(md5($key),$value,0,$staticindextime);
        return $result;
    }

    private function readmem($key){
        $result = $this->mem->get(md5($key));
        return $result;
    }
}
?>