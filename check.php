<?php
session_start();
include_once "header.php";
//include_once "cscheck.php"; // for dev
include_once "function/conn.php";
include_once "function/function.php";

include_once "function/xdownpage.php";

?>


<?php
        $action = getFormValue("action");
        if($action == "pcheck") proxy_check(); // 检查代理商 是否存在
	else { echo "2"; return; }



function proxy_check()
{
        $name = getFormValue("pname");
        //var_dump($_GET);
        $sql = "select count(id) from admin where username ='".$name."'";
        $handle = openConn();
        if($handle ==NULL) die( "mysql error". mysql_error() );
        $result = mysql_query($sql,$handle);
        if( $result !== false)
        {   
                $row1 = mysql_fetch_array($result,MYSQL_NUM);
                if($row1[0] > 0){ closeConn($handle); echo "1"; return; }
                else { closeConn($handle); echo "0"; return; }
        }   
        else {
                closeConn($handle);
                echo "2";
                return;
        }   
}

?>
