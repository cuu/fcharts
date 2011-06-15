<?php

?>

<html>
<HEAD>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<TITLE>后台登录</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK href="images/css.css" type=text/css rel=stylesheet>
<META content="MSHTML 5.00.2314.1000" name=GENERATOR>
<script >
function reflash(img)
{
	img.src="GetCode.php";
}
</script>
</HEAD>
<style type="text/css">
body
{
	background:url("images/mbg.jpg") repeat;
}
</style>
<BODY><BR><BR>
<?php
function  GetCode()
{
	echo
	 "<img src=\"GetCode.php\"  alt=\"验证码,看不清楚?请点击刷新验证码\" style=\"margin-bottom:0px;cursor:pointer;height:30px;\"  onclick=\"this.src='GetCode.php'\" /> " ;

}
?>
<div style="font-size:50px;margin-left:80px;"><span style="color:red;font-size:55px;">☭</span> 金石后台登陆 </div>
<hr size="1" />
<form name="admininfo" action="chklogin.php"  method=post onSubmit="return check()" style="margin-top:33px;margin-left:80px;" >
	<table cellspacing="4" cellpadding="3">
	<tr>
	<td>
	用户名:
	<input name="adminname" size="20" class="logininput" value="admin" />
	</td>
	<td>
	密码:
	<input class="logininput" name="adminpsw" type="password" size="20" value="" /> <br />
	</td></tr>
	</table>
	<table cellspacing="4">
	<tr>
	<td>
		验证码:
		<input type="text" name="code" size="4"    style="font-size:15px;width:70px;"  />
	</td>
	<td>
		<?php 
			GetCode(); 
		?>
	</td> </tr>

	</table>
	<input type="submit" style="width:60px;height:28px;cursor:pointer; "  name="submit_login" value="登录" />


</form>

</body>

</html>
<script LANGUAGE="javascript">
<!--
function checkspace(checkstr) {
  var str = '';
  for(i = 0; i < checkstr.length; i++) {
    str = str + ' ';
  }
  return (str == checkstr);
}
function check()
{
  if(checkspace(document.admininfo.adminname.value)) {
	document.admininfo.adminname.focus();
    alert("管理员不能为空！");
	return false;
  }
  if(checkspace(document.admininfo.adminpsw.value)) {
	document.admininfo.adminpsw.focus();
    alert("密码不能为空！");
	return false;
  }
  if(checkspace(document.admininfo.code.value)) {
	document.admininfo.code.focus();
    alert("验证码不能为空！");
	return false;
  }

	document.admininfo.submit();
  }
//-->
</script> 
