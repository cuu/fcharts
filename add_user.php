<?php
session_start();
include_once "header.php";
include_once "waibu.php";
include_once "cscheck.php";
?>

<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="images/css.css">
<script language="javascript" src="images/time.js" type="text/javascript"></script>
<script language="javascript" src="images/js.js" type="text/javascript"></script>
<?php
include "jq_ui.php";
?>
<script  language="javascript"  >

 $(function() {
  $("#btg_confirm_add").button();
  $("#btg_confirm_add").css("fontSize","14px");
  $("#container").draggable({handle: "#dr_title"});
  $("#container").resizable();

  $("table, tr, td").disableSelection();

  $("#btg_confirm_add").click( 
     function()
    {
      var str="";
       str = $("#u_type option:selected").text();
       str = jQuery.trim(str);
     /* 
      if( strcmp( str ,"代理商") == 0 && ( strlen( jQuery.trim( $("#ipt_pstime").val()) ) ==0 || strcmp(jQuery.trim( $("#ipt_pstime").val()),"不限时")==0 ) )
       {
          alert("添加[代理商]必须设定有限时效!");
          return false;
       }else 
      {

       }
	*/
    }
  );
});
</script>
<style type="text/css">
body{   background:url("images/dang.jpg") no-repeat bottom right;}
#container tr
{
  margin-top:8px;
  margin-bottom:8px;
}

</style>
<title>添加管理员</title>
</head>

<body  topmargin="0">

<form method="POST" action="admin_user_db.php">
 <div align="center"><p>　</p><p>　</p>
<input name="add_new_user" type="hidden" value="add" >
  <table id="container" border="0" width="368" cellspacing="4" cellpadding="1"  style="border: 1px solid #ccc;border-right:1px solid #999;border-bottom:1px solid #999;  padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
   <tr>
    <td id="dr_title" height="25"  width="358" colspan="2" class="biaoti">添加新的管理员帐号</td>
   </tr>
   <tr>
    <td style="border-left-width: 1px; border-right-width: 1px; " width="80" align="center">
    <font size="2">帐号名称：
   </font></td>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
    <input class="g_input"  type="text" name="add_username" size="20" value="" >
   </td>
   </tr>
   <tr>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="80" align="center">
    <font size="2">帐号密码：</font></td>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
    <input class="g_input"  type="text" name="add_psw" size="20"></td>
   </tr>
<!--
   <tr>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="80" align="center">
    <font size="2">帐号时效：</font></td>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
    <input class="g_input"  type="text" id="ipt_pstime"  name="add_pstime" size="20" onClick="javascript:this.focus()" onFocus="fPopCalendar(this,this,PopCal); return false;" style="cursor:hand" readonly=""  value="不限时"> &nbsp;<font size="2" color="#FF0000">默认空白时效为无限</font> </td>
    
   </tr>
-->
	<input type="hidden" name="add_pstime" value="不限时"  />
   <tr>
  <td style="border-left-width: 1px; border-right-width: 1px; " width="80" align="center">
 <font size="2">帐号类型：</font></td>
<td style="border-left-width: 1px; border-right-width: 1px; " width="286" align="left">
  <select id="u_type" name="u_type" style="width:100px;">
     <option value="2" selected="selected">代理商</option>
     <option value="1">超级管理员</option>
     <option value="3">普通管理员</option>
  </select>
  
</td>
   </tr>
   <tr>
  <td style="border-left-width: 1px; border-right-width: 1px; " width="80" align="center">
 <font size="2">帐号状态：</font></td>
<td style="border-left-width: 1px; border-right-width: 1px; " width="286" align="left">
  <select id="edit_zt" name="edit_zt" style="width:100px;">
     <option value="1">使用</option>
     <option value="0">禁用</option>
  </select>
   &nbsp;<font size="2" color="#FF0000">默认为使用 </font>
</td>
   </tr>

<tr>
<td style="margin-top:9px;" width="80" >&nbsp;</td>
<td  style="margin-top:9px;"> <input id="btg_confirm_add" type="submit" style=""  value="确定添加" name="2B"> </td>
</tr>
  </table>
 
</div>
</form>
</body>
</html>
