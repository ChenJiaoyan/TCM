<?php
include_once (dirname(__FILE__).'/../conf.php');

function  sqlExecute($sql)
{
	global $dbHost,$dbName,$dbUsername,$dbPassword;
	$conn = mysql_connect($dbHost,$dbUsername,$dbPassword);
	if(!$conn) 
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbName,$conn);
    $queryReslut=mysql_query($sql,$conn);
	$error= mysql_error();
    $result=Array(
		"result"=>$queryReslut,
	    "error"=>$error,
		);
	return $result;
}
?>
