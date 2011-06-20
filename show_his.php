<?php
session_start();
include_once "header.php";
//include_once "cscheck.php"; // for dev
include_once "function/conn.php";
include_once "function/function.php";
?>

<?php
$pages = 5;
$action = getFormValue("action");
if($action == "ajaxshow")
{
	$id = getFormValue("id");
	$name = getFormValue("name");
	ajax_show_his($id,$name);
}else if($action =="nshow")
{
	$name = getFormValue("name");
	n_show_his($name);
}
else if($action == "ajaxdelete")
{
	$id = getFormValue("id");
	ajax_delete($id);
}

function ajax_delete($id)
{
	if( intval($id) < 1) { echo "error"; return; }
	$sql = "delete from money where id=".$id;

        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql,$handle)   or die('Error in query $query.' .mysql_error());
	
	closeConn($handle);
	return;
}

function n_show_his($name)
{
	if( trim($name) =="") return;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
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
		<script type="text/javascript"> 
		function show_his(id,NAME)
		{
            			$.ajax({
                                        
                                        url: 'show_his.php?action=ajaxshow&id='+id+"&name="+NAME,
                                        success: function(data) 
                                        {
                                                //alert(data);
                                                //$('.result').html(data);
						$("#his_container").html(data);
                                                
                                        },
                                        error: function(xhr, ajaxOptions, thrownError)
                                        {
                                                   // alert(xhr.statusText);
                                                   // alert(thrownError);
                                                $("#his_container").html(xhr.statusText);
                                                return false;
                                        }
                                });
		}

		</script>
	</head> 
	<body> 
		<div id="his_container" style="line-height:1.6em;margin-left:20px;margin-bottom:8px;margin-top:40px;" >
		</div>
		<div  style="line-height:1.6em;margin-left:20px;margin-bottom:8px;">
<?php
	// 分页
	$sql = "select count(id) from money where name='".$name."'";
        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql,$handle)   or die('Error in query $query.' .mysql_error());
	$row = mysql_fetch_array($result,MYSQL_NUM);
	$all_num = intval($row[0]);

	$pages = 5;
	if ($all_num == 0)
	{	
		echo "No Records";
	}
	else if( $all_num <=$pages && $all_num > 0)
	{
		// one page
	}else if($all_num > $pages)
	{
		$left = $all_num;
		for( $i=1; $i < ($all_num/$pages)+1; $i++)
		{
			
			if($left < $pages) 
			{
				echo "<a  href='#' id='hisa'  class='show_his'  onclick='javascript:show_his({$i},\"{$name}\")'>".$i."</a>&nbsp;";
				
				break;
			}
			$left = $left-$pages;
			echo "<a   href='#' id='hisa' class='show_his'  onclick='javascript:show_his({$i},\"{$name}\")'>".$i."</a>&nbsp;";
		}
	}
	closeConn($handle);
?>
	</div>				
	</body> 
	<script>
		show_his(1,"<?php echo $name; ?>");
	</script>
</html> 
<?php

} // end function

function ajax_show_his($id,$name)
{
	global $pages;

	if( intval($id) < 1) { echo "error"; return; }
	$start = ( intval($id) - 1) *$pages;
	$end =  intval($id) *$pages; 
	$sql = "select name,time,money,id from money where name='".$name."' order by time desc LIMIT ".$start.",".$end;

        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql,$handle)   or die('Error in query $query.' .mysql_error());
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		for($i = 0; $i < $num; $i++)
		{
			$row = mysql_fetch_array($result,MYSQL_NUM);
			if( intval($_SESSION["zz"]) == 1)
				echo "<div id='item_his' ><a onclick='javascript:delete_this({$row[3]},this)'  href='#' class=\"del\" >删除</a> {$row[0]} 在 {$row[1]} 记录了 {$row[2]} ￥ </div>";
			else
				echo "<div id='item_his' >{$row[0]} 在 {$row[1]} 记录了 {$row[2]} ￥ </div>";
		}
	}else
	{
		echo "没有记录";
	}
	closeConn($handle);
	return;
}

?>