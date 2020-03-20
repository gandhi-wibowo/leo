<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 
 }

require_once "library/library.php";
$id_hasil_amasalah = $_GET ['id_hasil_amasalah'];
$id_amasalah = $_GET['id_amasalah'];
//$id_hasil_amasalah =autonumber("hasil_amasalah", "id_hasil_amasalah", 3, "HSP");
	if(isset($_POST['add'])){
		$id_hasil_amasalah		= $_POST['id_hasil_amasalah'];
		$tempat					= $_POST['tempat'];
		$ident_masalah			= $_POST['ident_masalah'];
		$harapan				= $_POST['harapan'];
		$penanganan				= $_POST['penanganan'];
		$dnmk_psi				= $_POST['dnmk_psi'];
		$saran					= $_POST['saran'];
		$id_amasalah			= $_POST['id_amasalah'];
		$nama_konselor			= $_POST['nama_konselor'];
				
		$cek = mysqli_query($db_link, "SELECT * FROM hasil_amasalah WHERE id_hasil_amasalah='$id_hasil_amasalah'");

		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO hasil_amasalah (id_hasil_amasalah,tempat,ident_masalah,harapan,penanganan,dnmk_psi,saran,id_amasalah,nama_konselor) VALUES ('$id_hasil_amasalah','$tempat','$ident_masalah','$harapan','$penanganan','$dnmk_psi','$saran','$id_amasalah','$nama_konselor')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Hasil PKP Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=amasalah_data">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Sudah Ada!</div>';
			}
	}
?>
 <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="datatables/dataTables.bootstrap.css"/>
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="js/plugins/select2/select2.min.css">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<div class="container-fluid_hasil_amasalah">
<div class="row">
			<h2><i class="fa fa-group"></i> Hasil Konseling</h2><hr>
			<tbody>
			</tbody>
			<form class="form-horizontal" action="" method="POST">
			<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_hasil_amasalah" class="form-control" value="<?php echo $id_hasil_amasalah?>" readonly>
					</div>
				</div>
			<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_amasalah" class="form-control" value="<?php echo $id_amasalah?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Tempat</label>
					<div class="col-sm-10">
						<input type="text" name="tempat" class="form-control" placeholder="Tempat" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Identifikasi Masalah</label>
					<div class="col-sm-10">
						<textarea rows='6' name="ident_masalah" class="form-control" placeholder="Identifikasi Masalah" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Harapan</label>
					<div class="col-sm-10">
						<textarea rows='6' name="harapan" class="form-control" placeholder="Harapan" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Penanganan</label>
					<div class="col-sm-10">
						<textarea rows='6' name="penanganan" class="form-control" placeholder="Penanganan" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Dinamika PSI</label>
					<div class="col-sm-10">
						<textarea rows='6' name="dnmk_psi" class="form-control" placeholder="Dinamika PSI" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Saran</label>
					<div class="col-sm-10">
						<textarea rows='6' name="saran" class="form-control" placeholder="Saran" ></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Nama Konselor</label>
					<div class="col-sm-10">
						<textarea rows='3' name="nama_konselor" class="form-control" placeholder="Nama Konselor" ></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_amasalah" class="form-control" value="<?php echo $id_amasalah?>" readonly>
					</div>
				</div>
									

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=hasil_amasalah_data&id_amasalah=<?php echo $id_amasalah;?>" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>