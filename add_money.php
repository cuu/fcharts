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
<script language="javascript" src="js/jquery.vibrate.js" type="text/javascript"></script>

<script  language="javascript"  >


function to_cn_number( intNum ) 
{
	var strCnNum = '';
	var arrCnNum = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
	var arrCnMark = ["", "", "百", "千", "万", "十万", "百万", "千万", "亿"];
	var strNum = intNum.toString();
	var intLen = strNum.length;
	var zeroFlag = false;
	for(var i = 0; i < intLen; i++) 
	{
		var n = parseInt(strNum.charAt(i));
		if(parseInt(strNum.substr(i)) == 0) 
		{
			break;
		} 
		else 
		{
			if(n == 0) 
			{
				if(!zeroFlag) 
				{
					strCnNum += arrCnNum[n];
				}
				zeroFlag = true;
			}
			else 
			{
				strCnNum += arrCnNum[n];
				strCnNum += arrCnMark[intLen - i - 1];
				zeroFlag = false;
			}
		}
	}
	return strCnNum;
}

jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            return (
                key == 8 || 
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        })
    })
};


$(function() {
  $("#btg_confirm_add").button();
  $("#btg_confirm_add").css("fontSize","14px");
  $("#container").draggable({handle: "#dr_title"});
//  $("#container").resizable();

//  $("table, tr, td").disableSelection();
	$("#add_money").ForceNumericOnly();

	$("#add_money").change(function() {
		$("#money_count").html( to_cn_number( $(this).val() ) );
	});

	$("#add_money").keyup(function(event) {
		
		$("#money_count").html( to_cn_number( $(this).val() ) );
	});

  $("#btg_confirm_add").click( 
	function()
	{
		if(  $.trim( $("#add_name").val()) == "")
		{
			$("#check_progress").html("请输入代理商");
			$("#add_name").vibrate();
			$('#check_progress').fadeIn().delay(5000).fadeOut('slow'); 
			return false;
		}
		if(  $.trim( $("#add_money").val()) == "")
		{
			
			$("#check_progress").html( "请输入钞票数目");
			$("#add_money").vibrate();
			$('#check_progress').fadeIn().delay(5000).fadeOut('slow'); 
			return false;
		}
	    $("#check_progress").html("正在检查是否已存在该代理商...");

            			$.ajax({
                                        
                                        url: 'check.php?action=pcheck&pname='+jQuery.trim($("#add_name").val()),
                                        success: function(data) 
                                        {
                                                //alert(data);
                                                //$('.result').html(data);
                                                if(data ==0)
                                                {
                                                        $("#check_progress").html("此代理商不存在!");
							$('#check_progress').fadeIn().delay(5000).fadeOut('slow'); 
                                                        return false;
                                                }else if(data ==1)
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
<title>记录钞票</title>
</head>

<body  topmargin="0">
	<form action="add_money_db.php" method="POST" id="target_group">
		<div align="center"><p>　</p><p>　</p>
		<input name="add_money" type="hidden" value="add" >
		<table id="container" border="0" width="368" cellspacing="4" cellpadding="1"  style="border: 1px solid #ccc;border-right:1px solid #999;border-bottom:1px solid #999;  padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
			<tr>
				<td id="dr_title" height="25"  width="358" colspan="2" class="biaoti">记录目前钞票数目</td>
				
			</tr>
			<tr>
				<td style="border-left-width: 1px; border-right-width: 1px; " width="80" align="center">
					<font size="2">帐号名称：
					</font></td>
				<td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
					<input class="g_input"  style="font-size:15px;"  type="text" id="add_name" name="add_username" size="20" value="<?php echo $_SESSION["yhgl"]; ?>"  <?php if( intval($_SESSION["zz"]) != 1) { echo 'readonly="readonly"'; }  ?> >
				</td>
			</tr>
			<tr>
				<td style="border-left-width: 1px; border-right-width: 1px;" width="80" align="center">
					<font size="2">钞票数目：</font></td>
				<td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
					<input class="g_input"  style="font-size:15px;"  id="add_money"  type="text" name="add_money" size="20">
					<font size="1"><label id="money_count" ></label>￥RMB</font>
				</td>
			</tr>
			<tr>
				<td style="border-left-width: 1px; border-right-width: 1px;" width="80" align="center">
					<font size="2" style="color:gray;">记录时间：</font></td>
				<td style="border-left-width: 1px; border-right-width: 1px;" width="286" align="left">
					<label style="color:gray;"> <?php echo date("Y年m月d号 H:i:s"); ?> </label>	
					
				</td>
			</tr>
			<tr>
				<td style="margin-top:9px;" width="80" >&nbsp;</td>
				<td  style="margin-top:9px;"> <input id="btg_confirm_add" type="submit" style=""  value="确定记录" name="2B"> </td>
			</tr>
		</table>
		<label id="check_progress" style="background:red;color:white;" ></label>
		</div>
	</form>
</body>
</html>

