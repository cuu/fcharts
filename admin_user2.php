<?php
/// this is for root opers,  delete ,change passwd...
session_start();
include_once "header.php";
include_once "cscheck.php";
include_once "function/conn.php";
include_once "function/function.php";
include_once "function/xdownpage.php";
?>

<html>
<head>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" href="images/css.css">
<!--[if IE]>
  <link rel="stylesheet" type="text/css" href="images/all-ie.css" />
<![endif]-->

<title>��̨�û�Ȩ�޹���</title>
<script language="javascript" src="images/time.js" type="text/javascript"></script>
<script language="javascript" src="images/js.js" type="text/javascript"></script>

<?php
include "jq_ui.php";
?>
<script  language="javascript"  >


 $(function() {
 // $("#btg_adduser").button();

});
</script>


<style type="text/css">
body{	background:url("images/dang.jpg") no-repeat bottom right;}
#out_list
{
  margin:8px;
  border:1px solid #bbb;
  border-bottom:none;
}
#out_list td
{
  border-bottom:1px solid #ccc;
}
</style>
</head>
<body>

<?php
	$action = getFormValue("action");
	switch($action)
	{
		case "Search":
			adu2_Search();
		break;
		case "del":
			adu2_del();
		break;
		default:
		{
?>
<?php
		  //list all managers
		  /*
		    [delete]---[motify]----uname----  ---user type---  

		   */
		$sql = "select * from admin";
		$handle = openConn();
		if($handle ==NULL) die( "mysql error". mysql_error() );
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
		    <?php  
		    if( intval($_SESSION["zz"]) != 1  ) // super user 
		    {
                          echo "You are not supposed to be here";
                            die();
                    }
?>

<div style="background:#fff;font-weight:bold; padding-bottom:2px;padding-left:10px;margin-bottom:14px;" >
<!--		    <span style="font-size:20px;" >�ʻ��޸�</span>
                  &nbsp; &nbsp; &nbsp;
-->
</div>

<div>
<a style="font-family:simhei;width:auto;height:auto;margin-left:10px;font-size:12px;color:blue;text-decoration:underline;" href="add_user.php" >��ӹ���Ա�������</a>
</div>


<TABLE  id ="out_list" border="0" cellspacing="0"  cellpadding="1" bordercolorlight="#fff" bordercolordark="#fff" style="border-collapse: collapse; table-layout:fixed;width:600px;" bordercolor="#fff"  >
      <tr height='30' bgcolor='#000000'  >
       <td width="150" class="tdbiaoti">ȷ�ϲ���</td>
       <td width="120"  class="tdbiaoti">����Ա����</td>
       <td width="120" class="tdbiaoti">����Ա����</td>
       <td width="120" class="tdbiaoti">ʹ��״̬</td>

       <td></td>
     </tr>
<?php
	        
		for( $i = 0; $i < $num; $i++)
		{   
		  $row = mysql_fetch_array($result,MYSQL_ASSOC); 
?>
<tr height='25' style="border-bottom:1px solid #ccc;">
 <td align="center"  >
         <a  class="del" href="admin_user.php?jzrq=<?php echo trim($row["jzrq"]); ?>&zt=<?php echo trim( $row["zt"]); ?>&type=<?php echo trim($row["type"]); ?>&edit=1&name=<?php echo trim($row["username"]);?>" >�޸�</a>
		    &nbsp;&nbsp;
         <a href="?action=del&name=<?php echo trim($row["username"]);?>" class="del" onClick="return confirm('ɾ���ù����ʺ�,��ȷ������ɾ��������')" target="delframe">ɾ��</a>
        </td>
<td align="center">
		    <?php echo trim($row["username"]); ?>
</td>
<td align="center">
		    <?php
                       $t_type = intval( trim($row["type"])) + intval( strtotime( trim($row["jzrq"])));
                       if ($t_type ==1) echo "��������Ա"; 
                       else if ($t_type ==2)  echo "������";
                       //else if( $t_type - ( intval( strtotime( trim($row["jzrq"]) ))) ==1) echo "������";
                       else if ($t_type== 3) echo "��ͨ����Ա";
			else echo "�������Ա";
		    ?>
</td>
<td align="center">
		  <?php 
		  switch( trim($row["zt"]))
		    {
		    case "1": echo "ʹ����"; break;
		    case "0": echo "������"; break;
		    default:break;
		    }
		  ?>
</td>
<td></td>
</tr>
<?php	
               
               	}
?>

</table>

<?php		  
		}else echo "û�й���Ա";
?>

<?php          }break; //end default;
	}; /// end switch 
?>

<?php 
function adb2_del()
{

  $id = getFormValue("name");
  $sql = "delete from admin where username='".$id."'";
  $handle = openConn();
  if($handle ==NULL) die();
  $result = mysql_query($sql,$handle);
  if($result === false)
  {
    closeConn($handle);
    echo "<script language=javascript>alert('ɾ��ʧ�ܣ�����Ա������');window.parent.location.reload();</script>";
  }
  else
  {
      closeConn($handle);
      echo "<script language=javascript>alert('ɾ���ɹ���');window.parent.location.reload();</script>";
      die();
  }

}

?>
