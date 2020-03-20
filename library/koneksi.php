<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "P4s5WordMy5@l";
$myDbs	= "db_leo";

$db_link = mysqli_connect($myHost,$myUser,$myPass,$myDbs);
if (mysqli_connect_errno()){
	echo 'Koneksi Ke Database GAGAL!'.mysqli_connect_error();
}

function opendb(){
		global $myHost, $myUser, $myPass, $myDbs, $koneksi_db;
		$db_link = mysqli_connect($myHost,$myUser,$myPass,$myDbs); 
		
		//mysql_select_db($mysql_database, $koneksi_db);
		return $db_link;
	}
	
/*** Koneksi dg OOP ***/
$mysqli = new mysqli($myHost,$myUser,$myPass,$myDbs);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", $mysqli->connect_error());
    exit();
}
$pdo = new PDO('mysql:host='.$myHost.';dbname='.$myDbs, $myUser, $myPass);
?>