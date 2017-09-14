<?
class mysql{
    private $getfilter = "'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    private $postfilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    private $cookiefilter = "\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    function __construct(){

    }
    function checksql(){
        foreach($_GET as $key=>$value){$this->stopattack($key,$value,$this->getfilter);}
        foreach($_POST as $key=>$value){$this->stopattack($key,$value,$this->postfilter);}
        foreach($_COOKIE as $key=>$value){$this->stopattack($key,$value,$this->cookiefilter);}
    }
    /**
     * 参数检查并写日志
     */
    public function stopattack($StrFiltKey, $StrFiltValue, $ArrFiltReq){
        if(is_array($StrFiltValue))$StrFiltValue = implode($StrFiltValue);
        if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue) == 1){
            $this->writeslog($_SERVER["REMOTE_ADDR"]."    ".strftime("%Y-%m-%d %H:%M:%S")."    ".$_SERVER["PHP_SELF"]."    ".$_SERVER["REQUEST_METHOD"]."    ".$StrFiltKey."    ".$StrFiltValue);
            echo miyue::Apijson(false,'您提交的参数非法,系统已记录您的本次操作！','');
            exit();
        }
    }
    /**
     * SQL注入日志
     */
    public function writeslog($log){
        $log_path = ROOT_PATH."/cache/sql_log/".date("Y_m_d").".txt";
        check_dir(dirname($log_path));
        $ts = fopen($log_path,"a+");
        fputs($ts,$log."\r\n");
        fclose($ts);
    }
    function mysql_link(){ //建立连接
        $link = @mysql_connect(MYSQL_HOST.":".MYSQL_PORT,MYSQL_USER,MYSQL_PASS) or die ('连接MYSQL服务器出错');
        @mysql_select_db(MYSQL_DB,$link) or die ('连接MYSQL数据库出错');
        return $link;
    }
    function query($sql){ //执行 SQL 语句
        mysql_query('set names gbk'); //此句在你的mysql字符集为latin1时不需要 注释即可
        mysql_query('set character_set_client = '.MYSQL_CHARSET);
        mysql_query('set character_set_connection = '.MYSQL_CHARSET);
        mysql_query('set character_set_results = '.MYSQL_CHARSET);
        $sqlresult = @mysql_query($sql);
        return $sqlresult;
    }
    function num_rows($sql){ //获得记录总数
        $num = @mysql_num_rows($sql);
        return $num;
    }
    function fetch_object($sql){ //返回一条记录
        return @mysql_fetch_object($sql);
    }
    function fetch_array($sql, $type = MYSQL_ASSOC){ //查询多条记录
        return mysql_fetch_array($sql,$type);
    }
    function fetch_assoc($sql){ //查询多条记录
        return @mysql_fetch_assoc($sql);
    }
    function fetch_row($sql){ //查询多条记录
        return @mysql_fetch_row($sql);
    }
    function insert_id(){ //取得上一步 INSERT 操作产生的 ID
        return @mysql_insert_id();
    }
    function free_result($sql){ //释放资源
        return @mysql_free_result($sql);
    }
    function list_tables(){ //获得数据表
        global $mysql__db;
        return $this->query_array("SHOW TABLES FROM $mysql__db");
    }
    function close(){ //关闭MYSQL连接
        return @mysql_close();
    }
    /******************************  以上是基本操作 以下是此mysql操作类的精华部分 *************************/
    function query_num($sql){ //查询总数
        $sql = $this->query($sql);
        $num = @mysql_num_rows($sql);
        $num = $num?$num:0;
        return $num;
    }
    function query_array($sql){ //查询多条记录保存到数组
        $sql = $this->query($sql);
        $num = @mysql_num_rows($sql);
        if($num){
            $array = array();
            for($a=0; $row = @mysql_fetch_array($sql,MYSQL_ASSOC); $a++){
                $array[$a] = $row;
            }
            return $array;
        }else{
            return false;
        }
    }
    function query_object($sql){ //查询一条记录保存到数组
        $sql = $this->query($sql);
        $num = @mysql_num_rows($sql);
        if($num){
            $array = array();
            $array = @mysql_fetch_object($sql);
            return $array;
        }else{
            return false;
        }
    }
    function query_field($sql){ //返回一条记录中一个字段
        $sql = $this->query($sql);
        $row = @mysql_fetch_row($sql);
        if($row){
            return $row[0];
        }else{
            return false;
        }
    }
}
?>