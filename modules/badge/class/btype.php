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
        $this->initvar( "btypeid", JIEQI_TYPE_INT, 0, "ÀàÐÍÐòºÅ", true, 11 );
        $this->initvar( "title", JIEQI_TYPE_TXTBOX, "", "ÀàÐÍÃû³Æ", true, 100 );
        $this->initvar( "sysflag", JIEQI_TYPE_INT, 0, "ÀàÐÍ±êÖ¾", false, 1 );
    }

}

class jieqibtypehandler extends jieqiobjecthandler
{

    function jieqibtypehandler( $_obfuscate_sx8ÿ = "" )
    {
        $this->jieqiobjecthandler( $_obfuscate_sx8ÿ );
        $this->basename = "btype";
        $this->autoid = "btypeid";
        $this->dbname = "badge_btype";
    }

}

?>
