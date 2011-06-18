<?php
include_once("header.php");
session_start();
function return_account_type($v)
{
  switch(intval($v))
  {
      case 1: return "超级管理员"; break;
      case 3: return "普通管理员"; break;
      case 2: return "代理商"; break;
      default:break;
  }
}
?>
<HTML>
<HEAD>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<META http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="images/left.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
  <link rel="stylesheet" type="text/css" href="images/all-ie.css" />
<![endif]-->

<SCRIPT language="javascript" src="images/left.js"></SCRIPT>
<SCRIPT language="javascript" src="images/jquery-1.4.4.min.js"></SCRIPT>
<script language="javascript" >

$(function(){


$("#main_menubar_left  a ").click(
    function(){
      $("#main_menubar_left  a ").each(
      function(i,domEle)
      {
	$(domEle).removeClass("active");
	$(domEle).css("color","#0000cc");
      }
      );

      $(this).addClass("active");
      $(this).css("color","black");
      $("body").click();
    }
  
)

});

</script>
<style type="text/css">
#main_menubar
{
/*background:none repeat scroll 0 0 #EBEFF9;*/
padding:5px 10px 0 5px;
border-bottom:1px solid #6B90DA;
white-space:nowrap;
}
.tab
{
color: #0000cc;
cursor:pointer;
  float:left;
margin: 5px 15px 6px 10px;

}
.active {
background:none repeat scroll 0 0 #FFFFFF;
border-color:#6B90DA #6B90DA -moz-use-text-color;
border-style:solid solid none;
border-width:1px 1px 0;
color:#000000;
cursor:default;
font-weight:bold;
margin:0 5px -1px 0;
padding:5px 9px 6px;
text-decoration:none;
}

</style>

</HEAD>
<BODY style="border-bottom:1px solid #6B90DA;" >
<div id="main_menubar" style=" " >
<div id="main_menubar_left" style="float:left;padding:5px;font-size:15px;">
      <a class="tab active" style="color:black;"  href="right.php"   target="mainFrame"  >后台管理菜单</a>
	<?php
	if( intval($_SESSION["zz"]) == 1)
	  {
	    ?>
        <a class="tab" id="menu_item5" href="admin_user2.php" target="mainFrame">帐户修改</a>
	      <?php }else
	  {
	    ?>
       <a  class="tab"  id="menu_item5" href="admin_user.php" target="mainFrame">帐户修改</A>
	    <?php   }
	    ?>
<?php 
	if( intval( $_SESSION["zz"] ) == 1 || intval( $_SESSION["zz"] ) == 3 )
	{
?>
		<a class="tab" id="menu_item1" href="proxyManager.php" target=mainFrame>代理商管理</a> 
<?php
	}
?>
<a class="tab" id="menu_item2" href="add_money.php" target=mainFrame>记录今天赚了多少钱</A> 
<!--
 <a class="tab" id="menu_item3" href="noteSet.php" target=mainFrame></A>
-->
</div>

<div id="main_menubar_right" style="float:right;padding:5px;"

<span id="kk5" ><b><?php echo $_SESSION["yhgl"]; ?></b> - 您是 <font color="red"><?php echo return_account_type($_SESSION["zz"]); ?></font></span>
<span id="kk4">  <a id="menu_item4" href="logout.php" target=mainFrame>登出</A> </span>
</div>

<div style="clear:both;"></div>

</div> <!-- end main_menubar --> 
<script>


	   /*
      	      $("#menu_item1").click(function () {
		  $(this).parent().css('background-color', '#bbccff');
		
		  $("#kk2").css('background-color','white');
		  $("#kk3").css('background-color',"white");
		  $("#kk6").css('background-color',"white");
		 // $("#kkk1").css('background-color', '#bbccff');
		 // $("#kkk2").css('background-color', '#fff');
		 // $("#kkk3").css('background-color', '#fff');
		});
      	      $("#menu_item2").click(function () {
		  $(this).parent().css('background-color', '#bbccff');
		  
		  $("#kk1").css('background-color','white');
		  $("#kk3").css('background-color',"white");
		  $("#kk6").css('background-color',"white");
		 // $("#kkk2").css('background-color', '#bbccff');
		 // $("#kkk1").css('background-color', '#fff');
		 // $("#kkk3").css('background-color', '#fff');
		});
      	      $("#menu_item3").click(function () {
		  $(this).parent().css('background-color', '#bbccff');
		  $("#kk2").css('background-color','white');
		  $("#kk1").css('background-color',"white");
		  $("#kk6").css('background-color',"white");
		  //$("#kkk3").css('background-color', '#bbccff');
		  //$("#kkk1").css('background-color', '#fff');
		  //$("#kkk2").css('background-color', '#fff');
		});
      	      $("#menu_item5").click(function () {
		  $(this).parent().css('background-color', '#bbccff');
		  $("#kk2").css('background-color','white');
		  $("#kk1").css('background-color',"white");
		  $("#kk3").css('background-color',"white");
		 
		  //$("#kkk3").css('background-color', '#bbccff');
		  //$("#kkk1").css('background-color', '#fff');
		  //$("#kkk2").css('background-color', '#fff');
		});
	   */
</script>
</body>
</html>
