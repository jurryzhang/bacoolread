<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

jieqi_includedb( );
class jieqibadge extends jieqiobjectdata
{

    function jieqibadge( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "badgeid", JIEQI_TYPE_INT, 0, "ÐòºÅ", false, 11 );
        $this->initvar( "btypeid", JIEQI_TYPE_INT, 0, "ÀàÐÍ", false, 11 );
        $this->initvar( "caption", JIEQI_TYPE_TXTBOX, "", "Ñ«ÕÂÃû³Æ", true, 100 );
        $this->initvar( "description", JIEQI_TYPE_TXTAREA, "", "ÃèÊö", false, NULL );
        $this->initvar( "linkid", JIEQI_TYPE_INT, 0, "¹ØÁªÐòºÅ", false, 11 );
        $this->initvar( "imagetype", JIEQI_TYPE_INT, 0, "Í¼Æ¬ÀàÐÍ", false, 3 );
        $this->initvar( "maxnum", JIEQI_TYPE_INT, 0, "»ÕÕÂÊýÁ¿", false, 11 );
        $this->initvar( "usenum", JIEQI_TYPE_INT, 0, "°ä·¢ÊýÁ¿", false, 11 );
        $this->initvar( "uptime", JIEQI_TYPE_INT, 0, "¸üÐÂÊ±¼ä", false, 11 );
    }

}

class jieqibadgehandler extends jieqiobjecthandler
{

    function jieqibadgehandler( $_obfuscate_sx8ÿ = "" )
    {
        $this->jieqiobjecthandler( $_obfuscate_sx8ÿ );
        $this->basename = "badge";
        $this->autoid = "badgeid";
        $this->dbname = "badge_badge";
    }

}

?>
