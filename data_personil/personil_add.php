<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";
	if(isset($_POST['add'])){
		$nrp		= $_POST['nrp'];
		$nama			= $_POST['nama'];
		$jabatan		= $_POST['jabatan'];
		$pangkat			= $_POST['pangkat'];
		$satker			= $_POST['satker'];
		$cek = mysqli_query($db_link, "SELECT * FROM tblpersonil WHERE nrp='$nrp'");

		//$tgl 		= ubah_tgl2($tgl);
		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO tblpersonil (nrp,nama,jabatan,pangkat,satker) VALUES ('$nrp','$nama','$jabatan','$pangkat','$satker')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Personil Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=personil_add">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Personil Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>NRP Sudah Ada!</div>';
			}
	}
?>
<div class="container-flunrp">
<div class="row">
			<h2><i class="fa fa-group"></i> Tambah Data Personil</h2><hr>
			<form class="form-horizontal" action="" method="POST">
				<!--<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-2">
						<input type="hidden" name="nrp" class="form-control" value="<?php //echo $kodeUser?>" readonly>
					</div>
				</div-->
				<div class="form-group">
					<label class="col-sm-2 control-label">NRP</label>
					<div class="col-sm-2">
						<input type="text" name="nrp" class="form-control" placeholder="NRP Personil" required autofocus>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="Nama Personil" required autofocus>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Jabatan</label>
					<div class="col-sm-3">
						<input type="text" name="jabatan" class="form-control" placeholder="jabatan" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Pangkat</label>
					<div class="col-sm-3">
						<input type="text" name="pangkat" class="form-control" placeholder="pangkat" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Satker</label>
					<div class="col-sm-3">
						<input type="text" name="satker" class="form-control" placeholder="satker" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=personil_data" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>