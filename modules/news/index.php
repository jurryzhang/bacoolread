<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

define( "JIEQI_MODULE_NAME", "news" );
include_once( "../../global.php" );
jieqi_getconfigs( JIEQI_MODULE_NAME, "indexblocks", "jieqiBlocks" );
include_once( JIEQI_ROOT_PATH."/header.php" );
$jieqiTset['jieqi_contents_template'] = "";
include_once( JIEQI_ROOT_PATH."/footer.php" );
?>
