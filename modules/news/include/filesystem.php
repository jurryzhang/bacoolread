<?php
//Zend 5.2 PHP程序修复由:找源码 http://Www.ZhaoYuanMa.Com 网站在线提供,QQ:7530782  
//修复混淆函数:0个
//修复混淆变量:9个
//修复混淆类名:0个
//自动混淆变量:0个

?>
<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function jieqi_filewrite( $FILE, $CONTENT, $MODE = "wb" )
{
    jieqi_makedir( $FILE );
    if ( !( $fp = @fopen( $FILE, $MODE ) ) )
    {
        return false;
    }
    @fwrite( $fp, $CONTENT );
    @fclose( $fp );
    @umask( $oldmask );
    return true;
}

function jieqi_makedir( $FILE )
{
    $dir = @explode( "/", $FILE );
    $NUM = count( $dir ) - 1;
    $tmp = "./";
    for ($VuwuuuuuwU5 = 0; $VuwuuuuuwU5 < $NUM; $VuwuuuuuwU5++ )
    {
        $tmp .= $dir[$VuwuuuuuwU5];
        if ( !file_exists( $tmp ) )
        {
            @mkdir( $tmp );
            @chmod( $tmp, 511 );
        }
        $tmp .= "/";
    }
}

?>
