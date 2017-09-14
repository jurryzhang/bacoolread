<?php
//Zend 5.2 PHP�����޸���:��Դ�� http://Www.ZhaoYuanMa.Com ��վ�����ṩ,QQ:7530782  
//�޸���������:0��
//�޸���������:11��
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

jieqi_includedb( );
class jieqicategory extends jieqiobjectdata
{

    function jieqicategory( )
    {
        $this->jieqiobjectdata( );
        $this->initvar( "categoryid", JIEQI_TYPE_INT, 0, "��Ŀ���", false, 5 );
        $this->initvar( "parentid", JIEQI_TYPE_INT, 0, "�ϼ���Ŀ���", true, 5 );
        $this->initvar( "categoryname", JIEQI_TYPE_TXTBOX, "", "��Ŀ����", true, 20 );
        $this->initvar( "categoryorder", JIEQI_TYPE_INT, 0, "��Ŀ�������", true, 5 );
    }

}

class jieqicategoryhandler extends jieqiobjecthandler
{

    function jieqicategoryhandler( $db = "" )
    {
        $this->jieqiobjecthandler( $db );
        $this->basename = "category";
        $this->autoid = "categoryid";
        $this->dbname = "news_category";
    }
    function jieqinavigationbar( $pid = null, $cid = null )
    {
        $navarray[] = array(
            "title" => $this->jieqicategorynamebyid($pid),
            "url" => $jieqiModules['news']['path'] . "/modules/news/newslist.php?pid=".$pid
        );
        if ($cid)
        {
            $navarray[] = array(
                "title" => $this->jieqicategorynamebyid($cid),
                "url" => $jieqiModules['news']['path'] . "/modules/news/newslist.php?pid=".$pid."&cid=".$cid
            );
        }
        return $navarray;
    }

    function jieqicategorychildcount( $criteria = null )
    {
        return $this->getcount( $criteria );
    }

    function jieqicategorynameidarray( )
    {
        $category_array = array( );
        $sql = "SELECT categoryid, categoryname FROM ".jieqi_dbprefix( $this->dbname )." WHERE parentid = 0 ORDER BY categoryorder";
        if ( $Result = $this->execute( $sql ) )
        {
            while ( $RS = $this->getrow( $Result ) )
            {
                $category_array[] = array(
                    "id" => $RS['categoryid'],
                    "name" => $RS['categoryname']
                );
            }
            return $category_array;
        }
    }

    function jieqisubcategorynameidarray( $pid = null )
    {
        $category_array = array( );
        $sql = "SELECT categoryid, categoryname FROM ".jieqi_dbprefix( $this->dbname ).( " WHERE parentid = ".$pid." ORDER BY categoryorder" );
        if ( $Result = $this->execute( $sql ) )
        {
            while ( $RS = $this->getrow( $Result ) )
            {
                $category_array[] = array(
                    "id" => $RS['categoryid'],
                    "name" => $RS['categoryname']
                );
            }
            return $category_array;
        }
    }

    function jieqicategorynamebyid( $cid = null )
    {
        $sql = "SELECT categoryname FROM ".jieqi_dbprefix( $this->dbname ). " WHERE categoryid = ".$cid;
        if ( ( $Result = $this->execute( $sql ) ) && ( $RS = $this->getrow( $Result ) ) )
        {
            return $RS['categoryname'];
        }
    }

    function jieqicategoryselectbox( )
    {
        $jsstr = "<script language=\"javascript\">";
        $jsstr .= "var onecount=0;";
        $jsstr .= "subcat=new Array();";
        $sql = "SELECT categoryid, parentid, categoryname FROM ".jieqi_dbprefix( $this->dbname )." WHERE parentid != 0 ORDER BY categoryorder";
        if ( $Result = $this->execute( $sql ) )
        {
            $count = 0;
            while ( $RS = $this->getrow( $Result ) )
            {
                $jsstr .= "subcat[".$count."] = new Array(\"".$RS['categoryname']."\",\"".$RS['parentid']."\",\"".$RS['categoryid']."\");";
                $count++;
            }
        }
        $jsstr .= "onecount=".$count.";";
        $jsstr .= "function changelocation(cid){";
        $jsstr .= "document.forms[0].news_cid.length=1;";
        $jsstr .= "var cid=cid;";
        $jsstr .= "var i;";
        $jsstr .= "for(i=0;i<onecount;i++){";
        $jsstr .= "if(subcat[i][1]==cid){";
        $jsstr .= "document.forms[0].news_cid.options[document.forms[0].news_cid.length]=new Option(subcat[i][0], subcat[i][2]);}}}";
        $jsstr .= "</script>";
        $jsstr .= "<select name=\"news_pid\" onChange=\"changelocation(this.options[this.selectedIndex].value)\" size=\"1\">";
        $jsstr .= "<option value=\"\">��ѡ��һ����Ŀ</option>";
        $sql = "SELECT categoryid, parentid, categoryname FROM ".jieqi_dbprefix( $this->dbname )." WHERE parentid = 0 ORDER BY categoryorder";
		if ($Result = $this->execute($sql))
        {
			while ($RS = $this->getrow($Result))
        {
            $jsstr .= "<option value=\"".$RS['categoryid']."\">".$RS['categoryname']."</option>";
        }
	}
        $jsstr .= "</select>";
        $jsstr .= "<select name=\"news_cid\"><option value=\"\">��ѡ�������Ŀ</option></select>";
        return $jsstr;
    }

    function jieqiselectboxdefault( $pid = null, $cid = null )
    {
        $jsstr = "<script language=\"javascript\">";
        $jsstr .= "obj=document.forms[0];";
        $jsstr .= "for(i=0;i<obj.news_pid.length;i++){if(obj.news_pid.options[i].value==".$pid."){obj.news_pid.options[i].selected=true;}}";
        $jsstr .= "changelocation(".$pid.");";
        $jsstr .= "for(i=0;i<obj.news_cid.length;i++){if(obj.news_cid.options[i].value==".$cid."){obj.news_cid.options[i].selected=true;}}";
        $jsstr .= "</script>";
        return $jsstr;
    }

    function jieqicategoryjumpmenu( )
    {
        $jsstr = "<script language=\"javascript\">";
        $jsstr .= "var onecount=0;";
        $jsstr .= "subcat=new Array();";
        $sql = "SELECT categoryid, parentid, categoryname FROM ".jieqi_dbprefix( $this->dbname )." WHERE parentid != 0 ORDER BY categoryorder";
        if ( $Result = $this->execute( $sql ) )
        {
            $count = 0;
            while ( $RS = $this->getrow( $Result ) )
            {
                $jsstr .= "subcat[".$count."] = new Array(\r\n\t\t\t\t\t\"".$RS['categoryname']."\",\r\n\t\t\t\t\t\"".$RS['parentid']."\",\r\n\t\t\t\t\t\"".$jieqiModules['news']['path'] . "/modules/news/admin/newslist.php?pid=".$RS['parentid']."&cid=".$RS['categoryid']."\"\r\n\t\t\t\t\t);";
                $count++;
            }
        }
        $jsstr .= "onecount=".$count.";";
        $jsstr .= "function changelocation(cid){";
        $jsstr .= "document.forms[0].news_cid.length=1;";
        $jsstr .= "var cid=cid;";
        $jsstr .= "var i;";
        $jsstr .= "for(i=0;i<onecount;i++){";
        $jsstr .= "if(subcat[i][1]==cid){";
        $jsstr .= "document.forms[0].news_cid.options[document.forms[0].news_cid.length]=new Option(subcat[i][0], subcat[i][2]);}}}";
        $jsstr .= "</script>";
        $jsstr .= "<select name=\"news_pid\" onChange=\"changelocation(this.options[this.selectedIndex].value)\" size=\"1\">";
        $jsstr .= "<option value=\"\">ɸѡһ����Ŀ</option>";
        $sql = "SELECT categoryid, parentid, categoryname FROM ".jieqi_dbprefix( $this->dbname )." WHERE parentid = 0 ORDER BY categoryorder";
        if ( $Result = $this->execute( $sql ) )
        {
            while ( $RS = $this->getrow( $Result ) )
        {
            $jsstr .= "<option value=\"".$RS['categoryid']."\">".$RS['categoryname']."</option>";
        }
		}
        $jsstr .= "</select>";
        $jsstr .= "<select name=\"news_cid\" onChange=\"MM_jumpMenu('self',this,0);\"><option value=\"\">ɸѡ������Ŀ</option></select>";
        return $jsstr;
    }

}

?>
