<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";
$kodeUser =autonumber("tbluser", "kd_user", 5, "USR");

	if(isset($_POST['add'])){
		$kd_user		= $_POST['kd_user'];
		$nm_lengkap		= $_POST['nm_lengkap'];
		$nm_user		= $_POST['nm_user'];
		$password		= $_POST['password'];
		$level			= $_POST['level'];
		$aktif			= $_POST['aktif'];

		$cek = mysqli_query($db_link, "SELECT * FROM tbluser WHERE kd_user='$kd_user'");

		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO tbluser (kd_user,nm_lengkap,nm_user,password,level,aktif) VALUES ('$kd_user','$nm_lengkap','$nm_user',md5('$password'),'$level','$aktif')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=user_add">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Kode Sudah Ada!</div>';
			}
	}
?>
<div class="container-fluid">
<div class="row">
			<h2><i class="fa fa-group"></i> Tambah Data User</h2><hr>
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<label class="col-sm-2 control-label">ID User</label>
					<div class="col-sm-2">
						<input type="text" name="kd_user" class="form-control" value="<?php echo $kodeUser?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Lengkap</label>
					<div class="col-sm-3">
						<input type="text" name="nm_lengkap" class="form-control" placeholder="Nama Lengkap" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-3">
						<input type="text" name="nm_user" class="form-control" placeholder="Username" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-2">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Level</label>
					<div class="col-sm-2">
						<select class="form-control" name="level">
							<option value="">---Pilih---</option>	
							<option value="Admin">Admin</option>
							<option value="Petugas">Petugas</option>
						</select>
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label class="col-sm-2 control-label">aktif</label>
					<div class="col-sm-1">
						<select class="form-control" name="aktif">
							<option value="Y">Ya</option>
							<option value="T">Tidak</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=user_data" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>