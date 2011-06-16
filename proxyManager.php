<?php
/*
proxyManager.php
*/
?>
<?php
session_start();
include_once "header.php";
//include_once "waibu.php";
//include_once "cscheck.php";
include_once "function/conn.php";
include_once "function/function.php";
include_once "function/xdownpage.php";
?>

<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="images/css.css">
<!--[if IE]>
  <link rel="stylesheet" type="text/css" href="images/all-ie.css" />
<![endif]-->

<script language="javascript" src="images/time.js" type="text/javascript"></script>
<script language="javascript" src="images/js.js" type="text/javascript"></script>
<?php
	include "jq_ui.php";
?>

<style type="text/css">
.checked_line
{
        background:#ffcc99;
}
.unchecked_line
{
        background:#fff;
}
</style>

</head>
<body>
<?php
        $action      = getFormValue("action")     ;   
        $id          = getFormValue("id")         ;   
        $pg          = getFormValue("pg");

	if($id == "" ) $id=0;
if($action == "del") proxy_del();
else
{

		$sql = "select * from money";
                if( $pg!="")
                {
                  $sql2 = $sql;
                  $sql .= " LIMIT ".((intval($pg)-1)*20).", 20";

                }
                else
                {
                  $sql2 = $sql;
                  $sql .= " LIMIT 0 , 20";
                }

                $handle = openConn();
                if($handle ==NULL) die( "mysql error". mysql_error() );
                $result = mysql_query($sql2,$handle);
                if( $result !== false)
                {  
                    $all = mysql_num_rows($result);
                    $all_num = $all;
                }
                else { die("mysql error".mysql_error()); }

                $result = mysql_query($sql,$handle);
                if($result ===false)
                {  
                    echo "Search mysql error()".mysql_error()."<br />";
                    closeConn($handle);
                    die();
                }
                $num = mysql_num_rows($result);
                if($num > 0)
                {

?>
<br />
  <div style="background:;font-weight:bold; padding-bottom:2px;padding-left:10px;margin-bottom:14px;" >
                      <span style="font-size:20px;" class="biaoti_guu" >代理商设置</span>
  </div>
  <div>
  <a style="width:auto;height:auto;margin-left:10px;font-size:12px;color:blue;text-decoration:underline;" href="add_proxy.php" >创建新的代理商</a>
  </div>


<table  id ="group_out_list" border="0" cellspacing="0"  cellpadding="1" bordercolorlight="#fff" bordercolordark="#fff" style="border-collapse: collapse;  table-layout:fixed;width:600px;WORD-BREAK: break-all;" bordercolor="#fff"  >
      <tr height='30' bgcolor='#000000'  >
       <td width="150" class="tdbiaoti">确认操作</td>
       <td width="240" height="30"  class="tdbiaoti">代理商编号</td>
       <td width="120" class="tdbiaoti">钞票数目</td>
       <td width="120" class="tdbiaoti">更新时间</td>
    
       <td></td>
        </tr>
<?php

                        $row = mysql_fetch_array($result,MYSQL_ASSOC);
                        for( $i = 0; $i < $num; $i++)
                        {
?>
                      <tr height='25' style="overflow:hidden;border-bottom:1px solid #ccc;">
                       <td align="center"  >
                        <a class="del"  onClick="return confirm('删除该代理商,您确定进行删除操作吗？')"   href="proxyManager.php?action=del&id=<?php  echo   trim($row["id"]); ?>">删除</a> &nbsp;
                         <a  class="edit" style="color:blue;"  id="edit_a"  href="edit_proxy.php?action=edit&id=<?php echo trim($row["id"]);?>" >修改</a>
                    &nbsp;&nbsp;
                       </td>
                       <td nowrap  style=" overflow:hidden;width:240px;height:25px;" align="center">
			    <a href="show_charts.php?action=show&id=<?php echo trim($row["id"]); ?>" id="show_chart" ><?php echo $row["name"]; ?></a>
                            <?php echo trim($row["groupname"]); ?>
                       </td>
                      <td align="center">
                      <?php
                              
                                echo "money count";
                      ?>
                      </td>

                       <td align="center">
                            <?php echo trim( date("Y年n月j日",strtotime($row["time"])) ); ?>
                       </td>
                       <td align="center"></td>
                      </tr>
<?php
                                $row = mysql_fetch_array($result,MYSQL_ASSOC);
                        }
?>
     </table>
     <table id='page_table_bar' style="margin-left:8px;margin-right:8px;" width="100%" border="0" align="left" cellpadding="0" cellspacing="8"             
bgcolor=#ebeff9>
       <tr><td>
<?php  
        $a = new Pager($all_num,20);
        echo $a->thestr."&nbsp;".$a->backstr."&nbsp;".$a->nextstr."&nbsp;&nbsp; 页次：".$a->pg."/".$a->page."&nbsp; 共".$a->countall."条记录&nbsp; ".$a->countlist."条/页";

?></td></tr>
     </table>
<?php
                }// end if($num > 0)
                else
                {
?>
<br />
<div style="background:;font-weight:bold; padding-bottom:2px;padding-left:10px;margin-bottom:14px;" >
                    <span style="font-size:20px;" class="biaoti_guu" >目前没有代理商,请您添加</span>
</div>
<div>
<a style="font-family:simhei;width:auto;height:auto;margin-left:10px;font-size:12px;color:blue;text-decoration:underline;" href="add_proxy.php"            >创建新的代理商</a>
</div>
<?php
                }// end else 
?>
<?php
}//end 1 else
?>

</body>
</html>