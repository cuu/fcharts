<?php
/*
proxyManager.php
*/
?>
<?php
session_start();
include_once "header.php";
//include_once "waibu.php";
include_once "cscheck.php";
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
body{   background:url("images/dang.jpg") no-repeat bottom right;}
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

		$sql = "select * from admin where  type = 2";
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


<table  id ="proxy_out_list" border="0" cellspacing="0"  cellpadding="1" bordercolorlight="#fff" bordercolordark="#fff" style="border-collapse: collapse;  table-layout:fixed;width:600px;WORD-BREAK: break-all;margin:8px;border:1px solid #bbb; border-bottom:none;" bordercolor="#fff"  >
      <tr height='30' bgcolor='#000000'  >
       <td width="150" class="tdbiaoti">确认操作</td>
       <td width="240" height="30"  class="tdbiaoti">代理商编号</td>
       <td width="120" class="tdbiaoti">钞票数目</td>
       <td width="120" class="tdbiaoti">最后更新时间</td>
    
       <td></td>
        </tr>
<?php

                        $row = mysql_fetch_array($result,MYSQL_ASSOC);
                        for( $i = 0; $i < $num; $i++)
                        {
?>
                      <tr height='25' style="overflow:hidden;border-bottom:1px solid #ccc;">
                       <td align="center"  >
<?php
			if( intval($_SESSION["zz"]) ==1)
			{
?>
                        <a class="del"  onClick="return confirm('您确定进行删除操作吗？')"   href="proxyManager.php?action=del&id=<?php  echo   trim($row["id"]); ?>&name=<?php echo trim( $row["username"]); ?>">删除</a> &nbsp;
<?php
			}
			else
			{
				echo "不可操作";
			}
?>
			<!--
                         <a  class="edit" style="color:blue;"  id="edit_a"  href="admin_proxy.php?action=edit&id=<?php echo trim($row["id"]);?>" >修改</a>
			-->
                    &nbsp;&nbsp;
                       </td>
                       <td nowrap  style=" overflow:hidden;width:240px;height:25px;" align="center">
			    <a style="color:blue;font-size:12px;" href="show_charts.php?action=show&id=<?php echo trim($row["id"]); ?>" id="show_chart" ><?php echo $row["username"]; ?></a>
                        
                       </td>
                      <td align="center">
                      <?php
                       		$sql3 = "select money from money where name='{$row["username"]}'";
				$result3 = mysql_query($sql3,$handle)  or die('Error in query $query.' .mysql_error());
				 
                		$num3 = mysql_num_rows($result3);
                		if($num3 > 0)
				{
					for($i3=0; $i3<$num3; $i3++)
					{
						$row3 = mysql_fetch_array($result3,MYSQL_NUM);
						$money_count3 += intval($row3[0]);
					}
                                	echo strval($money_count3)."￥";
				}else
				{
					echo "0￥";
				}
                      ?>
                      </td>

                       <td align="center">
                      <?php
                       		$sql4 = "select time from money where name='{$row["username"]}' order by time desc";
				$result4 = mysql_query($sql4,$handle)  or die('Error in query $query.' .mysql_error());
				 
                		$num4 = mysql_num_rows($result4);
                		if($num4 > 0)
				{

						$row4 = mysql_fetch_array($result4,MYSQL_NUM);
						$last_time4 = $row4[0];

                                	echo date("Y年m月d日",strtotime($last_time4));
				}else
				{
					echo "没有更新";
				}
                      ?>                            
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

<?php

function proxy_del()
{
        $id   = getFormValue("id"   );
	$name = getFormValue("name" );
 
        $sql = "delete from admin where id=".$id;
	$sql2 = "delete from money where name='{$name}'";
	
        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql,$handle);
        if($result === false)
        {
                echo "Delete proxy db error ".mysql_error();
                closeConn($handle);
                die();
        }else
        {
		$result = mysql_query($sql2,$handle);
                echo show_inf("删除成功");
                closeConn($handle);
                die();
        }
        return;

}

?>