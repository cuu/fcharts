<?php
session_start();
include_once "header.php";
include_once "waibu.php";
include_once "cscheck.php";

include_once "function/conn.php";
include_once "function/md5.php"; // for crc32



$yusername = trim($_POST['yusername']);
$ypsw      = trim($_POST['ypsw']     );
$xusername = trim($_POST['xusername']);
$xpsw      = trim($_POST['xpsw']     );
//$add_username = trim($_POST["add_username"] );
//$add_psw      = trim($_POST["add_psw"]);
$add_new_user = trim($_POST["add_new_user"] );
$edit_type="2"; /// for normally ,user is normal ,2
$xpstime = "0";

if ( isset($_POST["xpstime"]) )// �޸�
{
    if ( strcmp($_POST["xpstime"], "����ʱ") !=0  && strlen($_POST["xpstime"]) == 10)
      $xpstime= $_POST["xpstime"];
}

if ( isset($_POST["add_pstime"]) ) // ���
{
    if ( strcmp($_POST["add_pstime"], "����ʱ") !=0  && strlen($_POST["add_pstime"]) == 10)
      $xpstime= $_POST["add_pstime"];
}

if( isset($_SESSION["zz"]) && intval( trim($_SESSION["zz"]) ) == 1)
  {
    $edit_type = trim($_POST["edit_type"]);
  }

if ( isset($_POST["sedit"] ) && $_POST["sedit"] == "1" )
{// sedit ,from super user edit mode
     $edit_zt = $_POST["edit_zt"];
    if( strlen($ypsw) ==0 && strlen($xusername)==0 && strlen($xpsw)==0  && strlen($yusername)!=0 ) //��ʾ���޸� �ʺź�����
    {
      // only update ʱЧ,״̬���ʺ�����
      $s_none=1;
    }

   if ( strlen($ypsw) == 0 && strlen($xpsw)!=0)
    {
	echo "<script language=javascript>alert('����дԭ�ʺ����룡');window.history.back();</script>";
	die();        
    }

    if ( strlen($ypsw) != 0 && strlen($xpsw)==0)
    {
	echo "<script language=javascript>alert('����д���ʺ����룡');window.history.back();</script>";
	die();        
    }

 
    if ( ( strlen($yusername)!= 0 ) && ( strlen($xusername)!=0 )  && ( strlen($ypsw)==0 || strlen($xpsw) == 0 ) )
    {
	echo "<script language=javascript>alert('����д�ʺ����룡');window.history.back();</script>";
	die();        
    } 
    

    if( strlen($ypsw) !=0 && strlen($xusername)!=0 && strlen($xpsw)!=0  && strlen($yusername)!=0 )  //��ʾȫ�޸�
    {
      // all update
      $s_none=2;
    }



    $sql = "";

    switch($s_none)
    {
        case 1: // only update ʱЧ,״̬,����
        {
            $sql  = "update admin set jzrq='".$xpstime."',type=".$edit_type.",zt=".$edit_zt." where username='".$yusername."'";
            $handle = openConn();
            if($handle == NULL) die("openConn error".mysql_error());  
            $result = mysql_query($sql,$handle);
            if($result !== false)
            {
 		closeConn($handle);
		echo "<script language=javascript>alert('����Ա�ʺ��޸ĳɹ�;���ס���޸ĺ����Ϣ!');window.location.href='admin_user2.php' </script>";
		die();               
            }
            else
            {
 		closeConn($handle);
		echo "<script language=javascript>alert('����Ա�ʺ��޸��д� '".mysql_error().");</script>";
		die();
            }
        }break;
        default:break;
    }
  
 
} // end sedit

if(strcmp($add_new_user,"add") == 0)
  {
    //echo " add new user now";

    $add_username = trim($_POST["add_username"] );
    $add_psw      = trim($_POST["add_psw"]);
    $u_type       = trim($_POST["u_type"] );
    $u_time       = trim($_POST["add_pstime"]);
    if( strlen( trim($add_username)) < 1) 
      {
      	echo "<script language=javascript>alert('�ʺ����Ʋ���Ϊ�գ�');window.history.back();</script>";
	die();
      }
    if( strlen( trim($add_psw)) < 1)
      {
        echo "<script language=javascript>alert('�ʺ����벻��Ϊ�գ�');window.history.back();</script>";
	die();
      }
	if( strcmp( $u_time,"����ʱ") == 0)
		$u_time = "0";
    if( strlen( $u_time) ==0)
      {
          $u_time="0";
      }
      
    if( strlen( $u_time) >10)
      {
          echo "<script language=javascript>alert('�ʺ�ʱ�޲��ԣ�');window.history.back();</script>";
	  die();          
      }

     if( strlen($u_time) >5 && strtotime($u_time) < time() )
      {
         echo "<script language=javascript>alert('�ʺ�ʱ�޲��ԣ�');window.history.back();</script>";
	 die();         
      }

    $handle = openConn();
    if($handle == NULL) die("openConn error".mysql_error());
    $sql = "select * from admin where username='".$add_username."'";
    $result = mysql_query($sql,$handle);
    //echo "mysql_query 1";
    if($result !== false)
      {
	$num = mysql_num_rows($result);
	//echo "num = ".$num;
	if($num > 0)
	  {
	    closeConn($handle);
	    echo "<script language=javascript>alert('�ʺ��Ѵ���,��ȷ�������Ƿ���ȷ��');window.history.back();</script>";
	    die();
	  }
	else
	  {
	    $sql = "insert into admin(username,passwd,type,jzrq) values('".$add_username."','".g_CRC32($add_psw)."',".intval($u_type).",'".$u_time."')";
	    // echo "insert sql =".$sql;
	    $result1 = mysql_query($sql,$handle);
	    //echo "<br />".gettype($result1)." ".mysql_error();

	    if($result1 !== false)
	      {
		//echo "result1 !== false";
		closeConn($handle);
		echo show_inf( '����Ա�ʺ���ӳɹ�;���ס�������ʺ���Ϣ!');
		die();
	      }
	    else
	      {
		closeConn($handle);
		echo "<script language=javascript>alert('����Ա�ʺ�����д� '".mysql_error().");</script>";
		die();
	      }
	  }
      }else die("mysql_query failed".mysql_error());
  
    return;
  }

if( strlen( trim($yusername)) < 1 ) 
{
	echo "<script language=javascript>alert('ԭ�ʺŲ���Ϊ�գ�');window.history.back();</script>";
	die();
}

if( strlen( trim($ypsw)) < 1)
{
	echo "<script language=javascript>alert('ԭ���벻��Ϊ��!');window.history.back();</script>";
	die();
}

if(strlen( trim($xpsw ) )< 1)
{
	echo "<script language=javascript>alert('�����벻��Ϊ��!');window.history.back();</script>";;
	die();
}



$sql = "select * from admin where username='".$yusername."'";

$handle = openConn();
if($handle ==NULL) die("DATA BASE ERROR".mysql_error());
$result = mysql_query($sql,$handle);
if($result === false) 
{
	closeConn($handle);
	echo "<script language=javascript>alert('ԭ�û�����������');window.history.back();</script>";
	die();
}
else
{
	$num = mysql_num_rows($result); 
	if($num <= 0)
	{
		closeConn($handle);
		echo "<script language=javascript>alert('ԭ�û��������ڣ�');window.history.back();</script>";
		die();
	}
	else
	{
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		if( ( strcmp( strval($row['type']), $_SESSION["zz"] ) == 0 ) && strcmp( $row['passwd'] , g_CRC32( $ypsw ) ) == 0) // yuan pass is right and user type is equal
		{
			if($xusername == "")
				$xusername = $yusername;
			if($xpsw !="")
				$xpsw = g_CRC32($xpsw);
			else
				$xpsw = $ypsw;
                        if($_SESSION["zz"]=="1") // super
                        {
                          $sql2 = "update admin set zt=".$_POST["edit_zt"].",jzrq='".$xpstime."',username='".$xusername."', passwd='".$xpsw."', type=".intval($edit_type)."  where username='".$yusername."'";
                        } else
                        {
                          $sql2 = "update admin set username='".$xusername."', passwd='".$xpsw."'  where username='".$yusername."'";
                        }
			$result = mysql_query($sql2,$handle);
			if($result===false)
			{  
				closeConn($handle);
				echo "<script language=javascript>alert('����Ա�ʺ������д� '".mysql_error().");'</script>";
			}
			else
			{
				closeConn($handle);
				echo "<script language=javascript>alert('����Ա�ʺ����óɹ�;���ס�������ʺ���Ϣ!');</script>";
				die();
			}	

		}
		else if(  $_SESSION["zz"] != "1" && strcmp( strval($row['type']), $_SESSION["zz"] ) !=0 ) // IF USER IS BLEW  
		  {
		    closeConn($handle);
		    echo "<script language=javascript>alert('�ʺ���������');window.history.back();</script>";
		  }
		else
		{
			closeConn($handle);
			echo "<script language=javascript>alert('ԭ������������');window.history.back();</script>";
		}
	}
}

?>
