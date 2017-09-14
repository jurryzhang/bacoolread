<?php

?>
<?php

jieqi_includedb( );
class jieqiaward extends jieqiobjectdata
{

    function jieqiaward( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "awardid", JIEQI_TYPE_INT, 0, "ÐòºÅ", false, 11 );
        $this->initvar( "addtime", JIEQI_TYPE_INT, 0, "°ä·¢Ê±¼ä", false, 11 );
        $this->initvar( "fromid", JIEQI_TYPE_INT, 0, "°ä·¢Õßid", false, 11 );
        $this->initvar( "fromname", JIEQI_TYPE_TXTBOX, "", "°ä·¢Õß", false, 30 );
        $this->initvar( "toid", JIEQI_TYPE_INT, 0, "ÊÚÓèÕßid", false, 11 );
        $this->initvar( "toname", JIEQI_TYPE_TXTBOX, "", "ÊÚÓèÕß", false, 30 );
        $this->initvar( "badgeid", JIEQI_TYPE_INT, 0, "»ÕÕÂid", false, 11 );
    }

}

class jieqiawardhandler extends jieqiobjecthandler
{

    function jieqiawardhandler( $_obfuscate_sx8ÿ = "" )
    {
        $this->jieqiobjecthandler( $_obfuscate_sx8ÿ );
        $this->basename = "award";
        $this->autoid = "awardid";
        $this->dbname = "badge_award";
    }

}

?>
