<?php

?>
<?php

jieqi_includedb( );
class jieqiaward extends jieqiobjectdata
{

    function jieqiaward( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "awardid", JIEQI_TYPE_INT, 0, "���", false, 11 );
        $this->initvar( "addtime", JIEQI_TYPE_INT, 0, "�䷢ʱ��", false, 11 );
        $this->initvar( "fromid", JIEQI_TYPE_INT, 0, "�䷢��id", false, 11 );
        $this->initvar( "fromname", JIEQI_TYPE_TXTBOX, "", "�䷢��", false, 30 );
        $this->initvar( "toid", JIEQI_TYPE_INT, 0, "������id", false, 11 );
        $this->initvar( "toname", JIEQI_TYPE_TXTBOX, "", "������", false, 30 );
        $this->initvar( "badgeid", JIEQI_TYPE_INT, 0, "����id", false, 11 );
    }

}

class jieqiawardhandler extends jieqiobjecthandler
{

    function jieqiawardhandler( $_obfuscate_sx8� = "" )
    {
        $this->jieqiobjecthandler( $_obfuscate_sx8� );
        $this->basename = "award";
        $this->autoid = "awardid";
        $this->dbname = "badge_award";
    }

}

?>
