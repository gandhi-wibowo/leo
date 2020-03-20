<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";
$id_konseling_lnjt = $_GET ['id_konseling_lnjt'];
$id_pkp = $_GET['id_pkp'];
$tgl = $_GET['tgl'];
//$id_konseling_lnjt =autonumber("konseling_lnjt", "id_konseling_lnjt", 3, "HSP");
	if(isset($_POST['add'])){
		$id_konseling_lnjt		= $_POST['id_konseling_lnjt'];
		$saran					= $_POST['saran'];
		$tgl					= $_POST['tgl'];
		$id_pkp					= $_POST['id_pkp'];
				
		$cek = mysqli_query($db_link, "SELECT * FROM konseling_lnjt WHERE id_konseling_lnjt='$id_konseling_lnjt'");
		//$tgl 		= ubah_tgl2($tgl);
		
		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO konseling_lnjt (id_konseling_lnjt,tgl,saran,id_pkp) VALUES ('$id_konseling_lnjt','$tgl','$saran','$id_pkp')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Hasil PKP Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=konseling_tambahan_pkp_data&id_pkp=<?php echo $id_pkp;?>&tgl=<?php echo $tgl;?>">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Sudah Ada!</div>';
			}
	}
?>
<div class="container-fluid_konseling_lnjt">
<div class="row">
			<h2><i class="fa fa-group"></i> Hasil PKP</h2><hr>
			<tbody>
			</tbody>
			<form class="form-horizontal" action="" method="POST">
			<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_konseling_lnjt" class="form-control" value="<?php echo $id_konseling_lnjt?>" readonly>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="tgl" class="form-control" value="<?php echo $tgl?>" readonly>
					</div>
				</div>
			

			<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_pkp" class="form-control" value="<?php echo $id_pkp?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Saran Konseling</label>
					<div class="col-sm-10">
						<textarea rows='20' name="saran" class="form-control" placeholder="saran" required></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=konseling_tambahan_pkp_data&id_pkp=<?php echo $id_pkp;?>&tgl=<?php echo $tgl;?>" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>