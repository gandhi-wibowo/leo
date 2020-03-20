<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";
$id_pkp =autonumber("tblpeserta_pkp", "id_pkp", 5, "PKP");
$nrp = $_GET['nrp'];

	if(isset($_POST['add'])){
		$id_pkp		= $_POST['id_pkp'];
		$tgl			= $_POST['tgl'];
		$nrp			= $_POST['nrp'];
		//$id_pkp		= $_SESSION['SES_LOGIN'];

		$cek = mysqli_query($db_link, "SELECT * FROM tblpeserta_pkp WHERE id_pkp='$id_pkp'");

		$tgl 		= ubah_tgl2($tgl);
		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO tblpeserta_pkp (id_pkp,tgl,nrp) VALUES ('$id_pkp','$tgl','$nrp')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Peserta Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=pkp_data">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Peserta Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>id_pkp Sudah Ada!</div>';
			}
	}
?>
<div class="container-fluid_pkp">
<div class="row">
			<h2><i class="fa fa-group"></i> Tambah Data Peserta</h2><hr>
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-2">
						<input type="hidden" name="id_pkp" class="form-control" value="<?php echo $id_pkp?>" readonly>
					</div>
				</div>
				<div class="form-group">
    				<label class="col-sm-2 control-label">NRP</label>
    					<div class="col-sm-4">
    					<input type="text" name="nrp" class="form-control" value="<?php echo $nrp?>" readonly>
    					</div>
    						</div>
    						
				<div class="form-group">
                    <label class="col-sm-2 control-label">Tgl Konseling</label>
                    <div class="col-sm-2">
                        <input name="tgl" id="tgl" class="input-group date form-control" placeholder="Tgl Konseling" required>
                    </div>
                </div>
                <div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=pkp_data" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>