<?php
//Zend 5.2 PHP�����޸���:��Դ�� http://Www.ZhaoYuanMa.Com ��վ�����ṩ,QQ:7530782  
//�޸���������:0��
//�޸���������:9��
//�޸���������:0��
//�Զ���������:0��

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
