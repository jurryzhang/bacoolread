<?
if(!@include(INCLUDE_DIR."/smarty/Smarty.class.php")) {
    exit('Smarty.class.php is missing');
}
$Hon6Configs = array(
    "/class/urlconfigs.class.php",
    "/class/smartyfunction.class.php",
    "/class/configs.class.php",
    "/class/snoopy.class.php",
    "/class/fetchurl.class.php",
    "/class/mysql.class.php",
    "/class/browser.class.php",
    "/class/controller.class.php",
    "/class/validatecode.class.php",
    "/class/smarty.class.php",
    "/class/cache.class.php",
	"/class/miyue.class.php",
	"/class/book.class.php",
	"/class/user.class.php",
);
foreach($Hon6Configs as &$files2){
    if(!require_once(INCLUDE_DIR.$files2)) {
        exit(INCLUDE_DIR.$files2);
    }
}
?>