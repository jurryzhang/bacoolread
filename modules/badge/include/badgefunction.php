<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

function getbadgetype( $_obfuscate_3GykTM16 )
{
    global $jieqiType;
    if ( !isset( $jieqiType['badge'] ) )
    {
        jieqi_getconfigs( "badge", "type" );
    }
    if ( isset( $jieqiType['badge'][$_obfuscate_3GykTM16]['title'] ) )
    {
        return $jieqiType['badge'][$_obfuscate_3GykTM16]['title'];
    }
    return "";
}

function getbadgeurl( $_obfuscate_tXjHeVONVgÿÿ, $_obfuscate_9cdbadHq, $_obfuscate_QQ5W4ikQ2aUT = 0, $_obfuscate_OozBCgjOH4xC = false )
{
    global $jieqiConfigs;
    global $jieqi_image_type;
    if ( !isset( $jieqiConfigs['badge'] ) )
    {
        jieqi_getconfigs( "badge", "configs" );
    }
    if ( empty( $_obfuscate_o_NKMSFgSajRAQL1pv7ahwÿÿ ) )
    {
        $_obfuscate_m92UXBR15bzo75Mÿ = array( 1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp" );
    }
    else
    {
        $_obfuscate_m92UXBR15bzo75Mÿ = $jieqi_image_type;
    }
    if ( $_obfuscate_tXjHeVONVgÿÿ == 1 || $_obfuscate_tXjHeVONVgÿÿ == 2 || $_obfuscate_tXjHeVONVgÿÿ == 3 )
    {
        $_obfuscate_hwÿÿ = $jieqiConfigs['badge']['sysimgtype'];
    }
    else
    {
        $_obfuscate_hwÿÿ = is_numeric( $_obfuscate_QQ5W4ikQ2aUT ) ? $_obfuscate_m92UXBR15bzo75Mÿ[$_obfuscate_QQ5W4ikQ2aUT] : $_obfuscate_QQ5W4ikQ2aUT;
    }
    $_obfuscate_7XjNZZEPNqY2 = jieqi_uploadurl( $jieqiConfigs['badge']['imagedir'], "", "badge" )."/".$_obfuscate_tXjHeVONVgÿÿ.jieqi_getsubdir( $_obfuscate_9cdbadHq )."/".$_obfuscate_9cdbadHq.$_obfuscate_hwÿÿ;
    if ( $_obfuscate_OozBCgjOH4xC )
    {
        $_obfuscate_2wJXFxhoe7RYmQÿÿ = jieqi_uploadpath( $jieqiConfigs['badge']['imagedir'], "badge" )."/".$_obfuscate_tXjHeVONVgÿÿ.jieqi_getsubdir( $_obfuscate_9cdbadHq )."/".$_obfuscate_9cdbadHq.$_obfuscate_hwÿÿ;
        if ( is_file( $_obfuscate_2wJXFxhoe7RYmQÿÿ ) )
        {
            return $_obfuscate_7XjNZZEPNqY2;
        }
        return "";
    }
    return $_obfuscate_7XjNZZEPNqY2;
}

function getbadgepath( $_obfuscate_tXjHeVONVgÿÿ, $_obfuscate_9cdbadHq, $_obfuscate_QQ5W4ikQ2aUT = 0 )
{
    global $jieqiConfigs;
    global $jieqi_image_type;
    if ( !isset( $jieqiConfigs['badge'] ) )
    {
        jieqi_getconfigs( "badge", "configs" );
    }
    if ( empty( $_obfuscate_o_NKMSFgSajRAQL1pv7ahwÿÿ ) )
    {
        $_obfuscate_m92UXBR15bzo75Mÿ = array( 1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp" );
    }
    else
    {
        $_obfuscate_m92UXBR15bzo75Mÿ = $jieqi_image_type;
    }
    if ( $_obfuscate_tXjHeVONVgÿÿ == 1 || $_obfuscate_tXjHeVONVgÿÿ == 2 || $_obfuscate_tXjHeVONVgÿÿ == 3)
    {
        $_obfuscate_hwÿÿ = $jieqiConfigs['badge']['sysimgtype'];
    }
    else
    {
        $_obfuscate_hwÿÿ = is_numeric( $_obfuscate_QQ5W4ikQ2aUT ) ? $_obfuscate_m92UXBR15bzo75Mÿ[$_obfuscate_QQ5W4ikQ2aUT] : $_obfuscate_QQ5W4ikQ2aUT;
    }
    $_obfuscate_2wJXFxhoe7RYmQÿÿ = jieqi_uploadpath( $jieqiConfigs['badge']['imagedir'], "badge" )."/".$_obfuscate_tXjHeVONVgÿÿ.jieqi_getsubdir( $_obfuscate_9cdbadHq )."/".$_obfuscate_9cdbadHq.$_obfuscate_hwÿÿ;
    return $_obfuscate_2wJXFxhoe7RYmQÿÿ;
}

function upuserbadge( $_obfuscate_7Ri3 )
{
    global $jieqiConfigs;
    $_obfuscate_7Ri3 = intval( $_obfuscate_7Ri3 );
    if ( !isset( $jieqiConfigs['badge'] ) )
    {
        jieqi_getconfigs( "badge", "configs" );
    }
    $jieqiConfigs['badge']['userbadgenum'] = intval( $jieqiConfigs['badge']['userbadgenum'] );
    if ( $jieqiConfigs['badge']['userbadgenum'] <= 0 )
    {
        return true;
    }
    jieqi_includedb( );
    $_obfuscate_EMoX0Xj4GLZzcGMÿ = jieqiqueryhandler::getinstance( "JieqiQueryHandler" );
    $_obfuscate_7N3YzQnxIwÿÿ = array( );
    $_obfuscate_drYFGumx1RAÿ = new criteriacompo( );
    $_obfuscate_drYFGumx1RAÿ->settables( jieqi_dbprefix( "badge_award" )." a LEFT JOIN ".jieqi_dbprefix( "badge_badge" )." b ON a.badgeid=b.badgeid" );
    $_obfuscate_drYFGumx1RAÿ->add( new criteria( "a.toid", $_obfuscate_7Ri3 ) );
    $_obfuscate_drYFGumx1RAÿ->setsort( "b.btypeid ASC, a.awardid" );
    $_obfuscate_drYFGumx1RAÿ->setorder( "ASC" );
    $_obfuscate_drYFGumx1RAÿ->setlimit( $jieqiConfigs['badge']['userbadgenum'] );
    $_obfuscate_EMoX0Xj4GLZzcGMÿ->queryobjects( $_obfuscate_drYFGumx1RAÿ );
    $_obfuscate_5wÿÿ = 0;
    while ( $_obfuscate_9CcpKg0ÿ = $_obfuscate_EMoX0Xj4GLZzcGMÿ->getobject( ) )
    {
        $_obfuscate_7N3YzQnxIwÿÿ[$_obfuscate_5wÿÿ]['btypeid'] = $_obfuscate_9CcpKg0ÿ->getvar( "btypeid", "n" );
        $_obfuscate_7N3YzQnxIwÿÿ[$_obfuscate_5wÿÿ]['linkid'] = $_obfuscate_9CcpKg0ÿ->getvar( "linkid", "n" );
        $_obfuscate_7N3YzQnxIwÿÿ[$_obfuscate_5wÿÿ]['imagetype'] = $_obfuscate_9CcpKg0ÿ->getvar( "imagetype", "n" );
        $_obfuscate_7N3YzQnxIwÿÿ[$_obfuscate_5wÿÿ]['caption'] = $_obfuscate_9CcpKg0ÿ->getvar( "caption", "n" );
        ++$_obfuscate_5wÿÿ;
    }
    if ( 0 < count( $_obfuscate_7N3YzQnxIwÿÿ ) )
    {
        $_obfuscate_XT1RGy1bBK_K = serialize( $_obfuscate_7N3YzQnxIwÿÿ );
    }
    else
    {
        $_obfuscate_XT1RGy1bBK_K = "";
    }
    $_obfuscate_3y0Y = "UPDATE ".jieqi_dbprefix( "system_users" )." SET badges='".jieqi_dbslashes( $_obfuscate_XT1RGy1bBK_K )."' WHERE uid=".$_obfuscate_7Ri3;
    $_obfuscate_EMoX0Xj4GLZzcGMÿ->execute( $_obfuscate_3y0Y );
}

?>
