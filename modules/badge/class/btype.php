<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

jieqi_includedb( );
class jieqibtype extends jieqiobjectdata
{

    function jieqibtype( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "btypeid", JIEQI_TYPE_INT, 0, "类型序号", true, 11 );
        $this->initvar( "title", JIEQI_TYPE_TXTBOX, "", "类型名称", true, 100 );
        $this->initvar( "sysflag", JIEQI_TYPE_INT, 0, "类型标志", false, 1 );
    }

}

class jieqibtypehandler extends jieqiobjecthandler
{

    function jieqibtypehandler( $_obfuscate_sx8� = "" )
    {
        $this->jieqiobjecthandler( $_obfuscate_sx8� );
        $this->basename = "btype";
        $this->autoid = "btypeid";
        $this->dbname = "badge_btype";
    }

}

?>
