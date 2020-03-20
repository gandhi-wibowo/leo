<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once ("library/koneksi.php");
require_once ('library/library.php');
$kd_user = $_SESSION['SES_LOGIN'];
?>
<div class="col-md-5">
			<div style="overflow:auto;height:320px;">
				<table class="table table-bordered">
					<tbody>
						<?php
						//$kd_user = $_GET['kd_user'];
						//$kode= isset($_GET['kd_user']) ?  $_GET['kd_user'] : ''; 
						$Tampil= "SELECT tblchat.*, tbluser.* FROM tblchat 
						LEFT JOIN tbluser ON tblchat.dari = tbluser.kd_user
						WHERE tblchat.kepada = '$kd_user' ORDER BY tblchat.tgl ASC LIMIT 99;";
						$query = mysqli_query($db_link, $Tampil);
						while (	$hasil = mysqli_fetch_array ($query)) {
							$pesan 	 = stripslashes ($hasil['pesan']);
						$update = mysqli_query($db_link,"UPDATE tblchat SET dibaca='Y'
						WHERE kepada='$kd_user'");
						echo"
							<div id='atas'><div class='btn btn-sm btn-danger'><i class='fa fa-user'></i>&nbsp;$hasil[nm_user]</div><span class='waktu'>$hasil[tgl]&nbsp/&nbsp;$hasil[waktu]</div></span>
							<div id='pesan'>$hasil[pesan]</div>";
						}
						?>
					</tbody>
				</table>  
			</div><br>
			<?php
					if(isset($_POST['add'])){
						$kd_user  	= $_SESSION['SES_LOGIN'];
						$kepada  	= htmlspecialchars($_POST['kepada']);
						$pesan 		= htmlspecialchars($_POST['pesan']);
						$tgl 		= date("Y-m-d");
						$waktu 		= date("H:i:s");

						//$tgl 		= ubah_tgl2($tgl);

						$kirim = mysqli_query($db_link,"INSERT INTO tblchat VALUES(null,'$kd_user','$kepada','$pesan','$tgl','$waktu','N')");
					}
			?>
			<div class="container-fluid">
				<div class="row">
					<div>
						<form method="POST" action="" enctype="multipart/form-data">
			                <label class="control-label">Kepada 	:</label>
							<select class="form-control" name="kepada">
		                        <option value="">---Pilih---</option>
		                            <?php
		                                $query = "SELECT * FROM tbluser ORDER BY kd_user";
		                                $hasil = mysqli_query($db_link, $query);
		                                    while($data=mysqli_fetch_array($hasil)){
		                                    if($data['kd_user'] == $Kode){
		                                    	$cek = "selected";
		                                    }else{ $cek="";}
		                                        echo "<option value=$data[kd_user]>$data[kd_user]-$data[nm_user]</option>";
		                                    }
		                                ?>
		                    </select><br>
			                <label>Pesan 	:</label>
			        		<div class="input-group input-group-sm">
			        			<input type="text" class="form-control" name="pesan" required />
			        			<span class="input-group-btn">
			        				<input type="submit" name="add" class="btn btn-sm btn-primary" value="Kirim">
			        			</span>
			        		</div>
							</form>
					</div>
				</div><!-- /row -->
			</div>
</div>