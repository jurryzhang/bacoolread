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
include_once( JIEQI_ROOT_PATH."/header.php" );
jieqi_loadlang( "body", JIEQI_MODULE_NAME );
include_once( $jieqiModules[JIEQI_MODULE_NAME]['path']."/class/category.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "newsindexablocks", "jieqiBlocks" );
$category_handler =& jieqicategoryhandler::getinstance( "JieqiCategoryHandler" );
$categoryarray = $category_handler->jieqicategorynameidarray( );
if ( is_array( $categoryarray ) && 0 < count( $categoryarray ) )
{
    foreach ( $categoryarray as $k => $v )
    {
        $jieqiBlocks[] = array(
            "bid" => $k,
            "blockname" => "新闻内容列表",
            "module" => "news",
            "filename" => "block_newslist",
            "classname" => "BlockNewsList",
            "side" => 4,
            "title" => $v['name'],
            "vars" => $v['id'].",0,5,60",
            "template" => "block_newslist.html",
            "contenttype" => 1,
            "custom" => 0,
            "publish" => 3,
            "hasvars" => 1
        );
    }
}
include_once( JIEQI_ROOT_PATH."/footer.php" );
?>
