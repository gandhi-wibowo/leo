<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";
$id_binlat =autonumber("tblpeserta_binlat", "id_binlat", 5, "BNL");
	if(isset($_POST['add'])){
		$id_binlat	= $_POST['id_binlat'];
		$nama		= $_POST['nama'];
		$no_hp		= $_POST['no_hp'];
		$tgl		= $_POST['tgl'];
		$pemkab		= $_POST['pemkab'];		
		$pendidikan	= $_POST['pendidikan'];
		$pretest	= $_POST['pretest'];
		$posttest	= $_POST['posttest'];
		$nilai		= $_POST['nilai'];

		$cek = mysqli_query($db_link, "SELECT * FROM tblpeserta_binlat WHERE id_binlat='$id_binlat'");

		$tgl 		= ubah_tgl2($tgl);
		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO tblpeserta_binlat (id_binlat,nama,no_hp,tgl,pemkab,pendidikan,pretest,posttest,nilai) VALUES ('$id_binlat','$nama','$no_hp','$tgl','$pemkab','$pendidikan','$pretest','$posttest','$nilai')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Peserta Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=binlat_add">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Binlat Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>id_binlat Sudah Ada!</div>';
			}
	}
?>
<div class="container-fluid_binlat">
<div class="row">
			<h2><i class="fa fa-group"></i> Tambah Data Peserta BINLAT</h2><hr>
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-2">
						<input type="hidden" name="id_binlat" class="form-control" value="<?php echo $id_binlat?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Peserta</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="Nama Peserta" required autofocus>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">NO HP</label>
					<div class="col-sm-3">
						<input type="text" name="no_hp" class="form-control" placeholder="no_hp" required>
					</div>
				</div>
				<div class="form-group">
                    <label class="col-sm-2 control-label">Tgl Konseling</label>
                    <div class="col-sm-2">
                        <input name="tgl" id="tgl" class="input-group date form-control" placeholder="Tgl binlat" required>
                    </div>
                </div>               
				<div class="form-group">
					<label class="col-sm-2 control-label">PEMKAB</label>
					<div class="col-sm-3">
						<input type="text" name="pemkab" class="form-control" placeholder="pemkab" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Pendidikan</label>
					<div class="col-sm-3">
						<input type="text" name="pendidikan" class="form-control" placeholder="Pendidikan" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Pre Test</label>
					<div class="col-sm-3">
						<input type="text" name="pretest" class="form-control" placeholder="Pre Test" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Post Test</label>
					<div class="col-sm-3">
						<input type="text" name="posttest" class="form-control" placeholder="Post Test" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Nilai</label>
					<div class="col-sm-3">
						<input type="text" name="nilai" class="form-control" placeholder="Nilai" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=binlat_data" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>