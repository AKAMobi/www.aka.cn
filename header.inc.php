<?
//session_set_cookie_params( time()+60*60*24*365, "/", "aka.com.cn" );
session_set_cookie_params( 0, "/", "aka.com.cn" );
session_start();

readfile( "header.html", 1 );

//require_once( "pay.inc.php" );
require_once( "db.inc.php" );


$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");

function err_msg( $msg )
{
	print "<p align=center><font color=red size=+1>$msg</font></p>";
}

function notice_msg( $msg )
{
	print "<p align=center><font color=blue size=+1>$msg</font></p>";
}

function ok_msg( $msg )
{
	print "<p align=center><font color=gree size=+1> $msg</font></p>";
}
