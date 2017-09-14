<?php
class urlconfigs{

    public static function URL_auto($params){
        if(URL_MODE==1){
            $query = "?";
        }else{
            $query = "/";
        }
        if(is_array($params)){
            foreach($params as $k=>$v){
                if(URL_MODE==1){
                    $query .= $k."=".$v;
                    $query .= "&";
                }else{
                    if($k=="m"||$k=="M"){
                        $query .= $v;
                    }else{
                        $query .= $k."=".$v;
                    }
                    $query .= "/";
                }
            }
            if(URL_MODE==1){
                $query = substr($query,0,strlen($query)-1);
            }
        }
        return "index.php$query";
    }
}
?>