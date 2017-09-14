<?php
//Zend 5.2 PHP程序修复由:找源码 http://Www.ZhaoYuanMa.Com 网站在线提供,QQ:7530782  
//修复混淆函数:0个
//修复混淆变量:9个
//修复混淆类名:0个
//自动混淆变量:96个

?>
<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function jieqitextcheck( $Num1, $Num2, $str )
{
    if ( preg_match( "/^[a-zA-Z0-9]{".$Num1.",".$Num2."}\$/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqinumericcheck( $Num1, $Num2, $str )
{
    if ( preg_match( "/^[0-9]{".$Num1.",".$Num2."}\$/i", $str ) )
    {
        return true;
    }
    return false;
}

function jieqichinesecheck( $Num1, $Num2, $str )
{
    if ( preg_match( "/^([".chr(0xb0)."-".chr(0xf7)."][".chr(0xa1)."-".chr(0xfe)."]){".$Num1.",".$Num2."}\$/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqiidentitycheck( $str )
{
    if ( preg_match( "/(^([\\d]{15}|[\\d]{18}|[\\d]{17}x)\$)/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqiemailcheck( $str )
{
    if ( preg_match( "/^[_\\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\\.)+[a-z]{2,4}\$/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqiphonecheck( $str )
{
    if ( preg_match( "/^((\\(\\d{3}\\))|(\\d{3}\\-))?(\\(0\\d{2,3}\\)|0\\d{2,3}-)?[1-9]\\d{6,7}\$/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqipostcodecheck( $str )
{
    if ( preg_match( "/^[1-9]\\d{5}\$/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqiurlcheck( $str )
{
    if ( preg_match( "/^http:\\/\\/[A-Za-z0-9]+\\.[A-Za-z0-9]+[\\/=\\?%\\-&_~`@[\\]\\':+!]*([^<>\"\"])*\$/", $str ) )
    {
        return true;
    }
    return false;
}

function jieqidatajoin( &$data )
{
    if ( get_magic_quotes_gpc( ) == false )
    {
        if ( is_array( $data ) )
        {
            foreach ( $data as $append_editor => $ConfigControllerComponentCancel )
            {
                $data[$append_editor] = addslashes( $ConfigControllerComponentCancel );
            }
            return $data;
        }
        $data = addslashes( $data );
    }
    return $data;
}

function jieqidatarevert( &$data )
{
    if ( is_array( $data ) )
    {
        foreach ( $data as $k1 => $v1 )
        {
            if ( is_array( $v1 ) )
            {
                foreach ( $v1 as $zym_xoc => $v2 )
                {
                    $data[$k1][$zym_xoc] = stripslashes( $v2 );
                }
            }
            else
            {
                $data[$k1] = stripslashes( $v1 );
            }
        }
        return $data;
    }
    $data = stripslashes( $data );
    return $data;
}

?>
