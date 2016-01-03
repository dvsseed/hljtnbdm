<?php
header("Content-Type:text/html; charset=utf-8");
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		mysql_connect("localhost","hljtnbuser","hljtnbdm@root") or
         die("无法连接: " . mysql_error());
    //change to your database name
		mysql_select_db("hljtnbdm") or
		     die("无法获取数据库: " . mysql_error());
		mysql_query("SET NAMES 'utf8'");
	}
}
?>