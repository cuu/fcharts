<?php
session_start();
include_once "header.php";
//include_once "waibu.php";
include_once "cscheck.php";
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
<style type="text/css">
body{   background:url("images/dang.jpg") no-repeat bottom right;}
</style>
<?php
include "jq_ui.php";
?>
<script language="javascript">
  $(function() {
    $("#mgr_table").draggable();
    $("#mgr_table").resizable();
    $("table, tr, td").disableSelection();

    $("#btg_confirm_edit").button();
    $("#btg_confirm_edit").css("fontSize","14px");
    $("#btg_confirm_edit").click(
      function()
      {
         var str="";
       str = $("#edit_type option:selected").text();
       str = jQuery.trim(str);
      /*
      if( strcmp( str ,"��ʱ����Ա") == 0 && strlen( jQuery.trim( $("#xpstime").val()) ) ==0  )
       {
          alert("���[��ʱ����Ա]�����趨����ʱЧ!");
          return false;
       }
       else 
       { }
	*/      
      }
      );//end click() 
  });
</script>

<title>����Ա�ʺ������޸�</title>
</head>

<body bgcolor="#ffffff" topmargin="0">

<form method="POST" action="admin_user_db.php">
<?php
  if( isset($_GET["edit"]) && $_GET["edit"] =="1" )
    {
?>
    <input type="hidden" name="sedit" value="1" />
<?php
    }
?>
 <div align="center"><p>��</p><p>��</p>
  <table id="mgr_table" class="g_input" border="0" width="368" cellspacing="4" cellpadding="1"  style=" padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
   <tr>
    <td height="25"  width="358" colspan="2" class="biaoti">����Ա�ʺ�����</td>
   </tr>
   <tr>
    <td style="border-left-width: 1px;"  width="80" align="left">
    <font size="2">ԭ�ʺţ�
   </font></td>
    <td style="border-left-width: 1px;" width="286" align="left">
    <input type="text" name="yusername" size="20" value="<?php if( isset($_GET['name']))  echo $_GET["name"];?>" />
   </td>
   </tr>
   <tr>
    <td style="border-left-width: 1px;" width="80" align="left">
    <font size="2">ԭ���룺</font></td>
    <td style="border-left-width: 1px;" width="286" align="left">
    <input type="text" name="ypsw" size="20"></td>
   </tr>
   <tr>
    <td style="border-left-width: 1px;" width="80" align="left">
    <font size="2">���ʺţ�</font></td>
    <td style="border-left-width: 1px;" width="286" align="left">
    <input type="text" name="xusername" size="20" value="">&nbsp;<font size="2" color="#FF0000">�����޸�������д</font></td>
   </tr>
   <tr>
    <td style="border-left-width: 1px; " width="80" align="left">
    <font size="2">�����룺</font></td>
    <td style="border-left-width: 1px; " width="286" align="left">
    <input type="text" name="xpsw" size="20">&nbsp;<font size="2" color="#FF0000">�����޸�������д</font></td>
   </tr>

<input type="hidden"  name="xpstime" value="<?php if(intval($_GET["jzrq"])!=0){ echo $_GET["jzrq"];}else {echo "����ʱ";} ?>" />
<?php
/*
  if(isset($_GET["jzrq"]) && ( intval($_SESSION["zz"] )==1 )) 
    {
      ?>

   <tr>
    <td style="border-left-width: 1px; " width="80" align="left">
    <font size="2">��ʱЧ��</font></td>
    <td style="border-left-width: 1px; " width="286" align="left">
      <input type="text" id="xpstime" name="xpstime" size="20" value="<?php if(intval($_GET["jzrq"])!=0){ echo $_GET["jzrq"];}else {echo "����ʱ";} ?>" onClick="javascript:this.focus()" onFocus="fPopCalendar(this,this,PopCal); return false;" style="cursor:hand" readonly="" >&nbsp;<font  color="#FF0000"  size="2" >�����޸������հ�</font></td>
   </tr>

<?php    
    }
*/
?>
  <?php if (isset($_SESSION["zz"]) && intval($_SESSION["zz"] )==1)
{ 
?>
   <tr>
    <td style="border-left-width: 1px; " width="80" align="left">
    <font size="2">�ʺ����ͣ�</font></td>
    <td style="border-left-width: 1px;" width="286" align="left">
    <select id="edit_type" name="edit_type" >
    <?php
    $rt= intval($_GET["type"]) ;
    $rs = $rt + intval( strtotime($_GET["jzrq"]));
    $rv  =  intval( strtotime($_GET["jzrq"]));
    if( $rs ==1 )
    {

    ?>
      <option value="1" >��������Ա</option>
     <option value="3" > ��ͨ����Ա</option>
     <option value="2" > ������</option>   

    <?php
  }else if ($rs ==2 )
   {
?>
      <option value="3" >��ͨ����Ա </option>
     <option value="1" > ��������Ա</option>
     <option value="2" > ������ </option>
    
<?php
      }else if ( ($rs-$rv) == 1)
      {
?>
      <option value="2" > ������</option>
        <option value="3" >��ͨ����Ա</option>
      <option value="1" > ��������Ա </option>
<?php
      }
?>
    </select>
    </td>
   </tr>
<tr>
  <td style="border-left-width: 1px; " width="80" align="left">
    <font size="2">�ʺ�״̬��</font></td>
    <td style="border-left-width: 1px;" width="286" align="left">
    <select name="edit_zt">
<?php
switch($_GET["zt"])
  {
  case "1":
  {
?>
   <option value="1"> ʹ���� </option>
<option value="0"> ������ </option>
<?php
  }break;
  case "0":
  {
?>
    <option value="0"> ������ </option>
     <option value="1"> ʹ���� </option>
<?php
      }break;
  default:break;

  }
?>

    </select>
</td>
</tr>

<?php 
} // end if
?>

<tr>
<td>&nbsp;</td>
<td width="186" >
  <input id="btg_confirm_edit" type="submit" value="ȷ���޸�" name="B1">
</td>
</tr>

  </table>
</form>
</body>
</html>
