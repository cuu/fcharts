<?php

	$server_v1 = strval( $_SERVER["HTTP_REFERER"] );
	$server_v2 = strval( $_SERVER["SERVER_NAME"]  );
	// php 7 for http, 8 for https
	$sv_len = 7;
	if ( substr( $server_v1, $sv_len,strlen( $server_v2) ) <> $server_v2 )
	{
		echo "<br><br><center><table border=1 cellpadding=20 bordercolor=black bgcolor=#EEEEEE width=450>";
		echo "<tr><td style=font:9pt Verdana>";
		echo "���ύ��·�����󣬽�ֹ��վ���ⲿ�ύ�����벻Ҫ�ҸĲ�����";
		echo "</td></tr></table></center>";
		die();
	}
?>
