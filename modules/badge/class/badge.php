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
        $this->initvar( "badgeid", JIEQI_TYPE_INT, 0, "���", false, 11 );
        $this->initvar( "btypeid", JIEQI_TYPE_INT, 0, "����", false, 11 );
        $this->initvar( "caption", JIEQI_TYPE_TXTBOX, "", "ѫ������", true, 100 );
        $this->initvar( "description", JIEQI_TYPE_TXTAREA, "", "����", false, NULL );
        $this->initvar( "linkid", JIEQI_TYPE_INT, 0, "�������", false, 11 );
        $this->initvar( "imagetype", JIEQI_TYPE_INT, 0, "ͼƬ����", false, 3 );
        $this->initvar( "maxnum", JIEQI_TYPE_INT, 0, "��������", false, 11 );
        $this->initvar( "usenum", JIEQI_TYPE_INT, 0, "�䷢����", false, 11 );
        $this->initvar( "uptime", JIEQI_TYPE_INT, 0, "����ʱ��", false, 11 );
    }

}

class jieqibadgehandler extends jieqiobjecthandler
{

    function jieqibadgehandler( $_obfuscate_sx8� = "" )
    {
        $this->jieqiobjecthandler( $_obfuscate_sx8� );
        $this->basename = "badge";
        $this->autoid = "badgeid";
        $this->dbname = "badge_badge";
    }

}

?>
