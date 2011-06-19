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
}


function ajax_show_his($id,$name)
{
	global $pages;

	if( intval($id) < 1) { echo "error"; return; }
	$start = ( intval($id) - 1) *$pages;
	$end =  intval($id) *$pages; 
	$sql = "select name,time,money from money where name='".$name."'  LIMIT ".$start.",".$end;

        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql,$handle)   or die('Error in query $query.' .mysql_error());
	$num = mysql_num_rows($result);
	if($num > 0)
	{
		for($i = 0; $i < $num; $i++)
		{
			$row = mysql_fetch_array($result,MYSQL_NUM);
			echo "{$row[0]} 在 {$row[1]} 记录了 {$row[2]} ￥ <br />";
		}
	}else
	{
		echo "没有记录";
	}
	closeConn($handle);
	return;
}

?>