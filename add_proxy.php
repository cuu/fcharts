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
            if( jQuery.trim($("#add_username").val()) =="")
            {
		$("#check_progress").html("�����̱�Ų���Ϊ��");
		$('#check_progress').fadeIn().delay(5000).fadeOut('slow'); 
		return false;
            }
            if( jQuery.trim($("#add_psw").val()) =="")
            {
		//alert("����д�����̵�¼����,����д��123456Ҳ��");
		$("#check_progress").html("����д�����̵�¼����,����д��123456Ҳ��");
		$('#check_progress').fadeIn().delay(5000).fadeOut('slow'); 
		return false;
            }	
	    $("#check_progress").html("���ڼ���Ƿ��Ѵ���...");

            			$.ajax({
                                        
                                        url: 'check.php?action=pcheck&pname='+jQuery.trim($("#add_username").val()),
                                        success: function(data) 
                                        {
                                                //alert(data);
                                                //$('.result').html(data);
                                                if(data ==1)
                                                {
                                                        $("#check_progress").html("�˴������Ѿ�����,����������,����ɾ��ԭ�д������ٽ��д���...");
							$('#check_progress').fadeIn().delay(5000).fadeOut('slow'); 
                                                        return false;
                                                }else if(data ==0)
                                                {
                                                        $("#check_progress").html("");  
                                                        
                                                        $("#target_group").submit(); 
                                                }
                                                
                                        },
                                        error: function(xhr, ajaxOptions, thrownError)
                                        {
                                                   // alert(xhr.statusText);
                                                   // alert(thrownError);
                                                $("#check_progress").text(xhr.statusText);
                                                return false;
                                        }
                                });
	   return false;
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
<title>��Ӵ�����</title>
</head>

<body  topmargin="0">

<form method="POST" action="admin_user_db.php"  id="target_group" >
 <div align="center"><p>��</p><p>��</p>
<input name="add_new_user" type="hidden" value="add" >
  <table id="container" border="0" width="368" cellspacing="4" cellpadding="1"  style="border: 1px solid #ccc;border-right:1px solid #999;border-bottom:1px solid #999;  padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
   <tr>
    <td id="dr_title" height="25"  width="358" colspan="2" class="biaoti">����µĴ�����</td>
   </tr>
   <tr>
    <td style="border-left-width: 1px; border-right-width: 1px; " width="100" align="center">
    <font size="2">�����̱�ţ�
   </font></td>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
    <input class="g_input"  style="font-size:13px;"  type="text" id="add_username" name="add_username" size="20" value="" >
   </td>
   </tr>
   <tr>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="100" align="center">
    <font size="2">���������룺</font></td>
    <td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
    <input class="g_input"  style="font-size:13px;"  type="text" id="add_psw"  name="add_psw" size="20"></td>
   </tr>

	<input type="hidden" name="add_pstime" value="����ʱ"  />
	<input type="hidden" name="u_type" value="2" />

   <tr>
  <td style="border-left-width: 1px; border-right-width: 1px; " width="80" align="center">
 <font size="2">�ʺ�״̬��</font></td>
<td style="border-left-width: 1px; border-right-width: 1px; " width="286" align="left">
  <select id="edit_zt" name="edit_zt" style="width:100px;">
     <option value="1">ʹ��</option>
     <option value="0">����</option>
  </select>
   &nbsp;<font size="2" color="#FF0000">Ĭ��Ϊʹ�� </font>
</td>
   </tr>

<tr>
<td style="margin-top:9px;" width="80" >&nbsp;</td>
<td  style="margin-top:9px;"> <input id="btg_confirm_add" type="submit" style=""  value="ȷ�����" name="2B"> </td>
</tr>
  </table>
<label id="check_progress" style="background:red;color:white;" ></label>

</div>
</form>
</body>
</html>
