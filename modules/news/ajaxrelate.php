<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

define( "JIEQI_MODULE_NAME", "news" );
if ( !defined( "JIEQI_GLOBAL_INCLUDE" ) )
{
    include_once( "../../global.php" );
}
header( "Content-Type:text/html;charset=".JIEQI_CHAR_SET );
jieqi_loadlang( "body", JIEQI_MODULE_NAME );
jieqi_getconfigs( JIEQI_MODULE_NAME, "configs" );
include_once( JIEQI_ROOT_PATH."/header.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/topic.php" );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/include/formcheck.php" );
if ( isset( $_GET['method'] ) && $_GET['method'] == "fetch" )
{
    if ( !jieqinumericcheck( 1, 10, $_GET['id'] ) )
    {
        jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_id_error'] );
    }
    $topic_handler = jieqinewstopichandler::getinstance( "JieqiNewsTopicHandler" );
    if ( $criteria = $topic_handler->get( $_GET['id'] ) )
    {
        $keywordarray = array( );
        if ( $keywordstring = $criteria->getvar( "newskeyword" ) )
        {
            $keywordarray = explode( ";", $keywordstring );
            if ( is_array( $keywordarray ) && 0 < count( $keywordarray ) )
            {
                $arrayid = array( );
                foreach ( $keywordarray as $v )
                {
                    if ( 0 < strlen( trim( $v ) ) )
                    {
                        $criteria2 = new criteriacompo( );
                        $criteria2->add( new criteria( "newstitle", "%".$v."%", "LIKE" ) );
                        $criteria2->add( new criteria( "newsstatus", 1 ) );
                        if ( !$topic_handler->queryobjects( $criteria2 ) )
                        {
                            jieqi_printfail( $jieqiLang[JIEQI_MODULE_NAME]['news_query_error'] );
                        }
                        while ( $n = $topic_handler->getobject( ) )
                        {
                            $arrayid[] = $n->getvar( "newsid" );
                            if ( count( $arrayid ) == $jieqiConfigs[JIEQI_MODULE_NAME]['relatenewslistpnum'] )
                            {
                                continue;
                            }
                        }
                        unset( $criteria2 );
                    }
                }
                $relatestring = "";
                $arrayid = array_unique( $arrayid );
                rsort( &$arrayid );
                if ( is_array( $arrayid ) && 0 < count( $arrayid ) )
                {
                    foreach ( $arrayid as $v )
                    {
                        if ( $criteria3 = $topic_handler->get( $v ) )
                        {
                            $relatestring .= "<li>";
                            $relatestring .= "<a href=\"";
                            $relatestring .= "newshow.php?id=".$criteria3->getvar( "newsid" );
                            $relatestring .= "\">";
                            $relatestring .= jieqi_substr( $criteria3->getvar( "newstitle" ), 0, $jieqiConfigs[JIEQI_MODULE_NAME]['relatenewslistword'] );
                            $relatestring .= "</a>";
                            $relatestring .= "</li>";
                        }
                    }
                }
                else
                {
                    $relatestring = $jieqiLang[JIEQI_MODULE_NAME]['relate_news_not_found'];
                }
            }
        }
        else
        {
            $relatestring = $jieqiLang[JIEQI_MODULE_NAME]['relate_news_not_found'];
        }
        echo $relatestring;
    }
}
?>
