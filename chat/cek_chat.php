<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once ("../library/koneksi.php"); 
$kd_user = $_SESSION['SES_LOGIN'];
$pesan = mysqli_query($db_link,"SELECT id FROM tblchat
    WHERE kepada='$kd_user' and dibaca='N'");
$j = mysqli_num_rows($pesan);
if($j>0){
    echo $j;
}
?>
