<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once ("../library/koneksi.php"); 
require_once ('../library/library.php');
$kd_user = $_SESSION['SES_LOGIN'];

$pesan = mysqli_query($db_link,"SELECT tblchat.*, tbluser.* FROM tblchat LEFT JOIN tbluser ON tblchat.dari = tbluser.kd_user WHERE tblchat.kepada='$kd_user' and tblchat.dibaca='N'");
// $pesan = mysqli_query($db_link, "SELECT * FROM tblchat WHERE kepada='$kd_user' and dibaca='N'");
$j = mysqli_num_rows($pesan);
if($j>0){
    echo "<table>";
}else{
    die("<font color=red size=1>Tidak ada pesan baru</font>");
}
while($p = mysqli_fetch_array($pesan)){
    echo "<tr>
    		<td>
    			<a href=?open=pesan>Pesan dari : ".$p['nm_user']."</a><br>
     			Waktu : ".ubah_tgl2($p['tgl'])."&nbsp;-&nbsp;".$p['waktu']."
     		</td>
     	  </tr>";
}
echo "</table>";
?>
