<?php

function do_post_request($url, $data, $optional_headers = null)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => $data
            ));
  if ($optional_headers !== null) {
    $params['http']['header'] = $optional_headers;
  }
  $ctx = stream_context_create($params);
  $fp = @fopen($url, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with $url, $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from $url, $php_errormsg");
  }
  return $response;
}


function sendMsg( $f_mobile, $f_msg)
{
	/*
	$f_user = "c5858";
	$F_password = "123456";
	$strInetURL= "user=".$f_user."&password=".$f_password."&product_name=201&mobile=".$f_mobile."&msg=".$f_msg;
	do_post_request("http://www.linuxfire.com.cn/~guu/sendlistdd.php",$strInetURL);
	do_post_request("http://www.c5858.net/sendlistdd.asp",$strInetURL);
	*/

}
