<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";
$id_hasil_pkp = $_GET ['id_hasil_pkp'];
$id_pkp = $_GET['id_pkp'];
//$id_hasil_pkp =autonumber("hasil_pkp", "id_hasil_pkp", 3, "HSP");
	if(isset($_POST['add'])){
		$id_hasil_pkp		= $_POST['id_hasil_pkp'];
		$knds_klinis		= $_POST['knds_klinis'];
		$depresi			= $_POST['depresi'];
		$rs_bersalah		= $_POST['rs_bersalah'];
		$bnh_diri			= $_POST['bnh_diri'];
		$insomnia			= $_POST['insomnia'];
		$apatis				= $_POST['apatis'];
		$kelambanan			= $_POST['kelambanan'];
		$kegelisahan		= $_POST['kegelisahan'];
		$kcms_psikis		= $_POST['kcms_psikis'];
		$kcms_somatik		= $_POST['kcms_somatik'];
		$ggn_pencernaan		= $_POST['ggn_pencernaan'];
		$smtk_umum			= $_POST['smtk_umum'];
		$ggn_prlk_seksual	= $_POST['ggn_prlk_seksual'];
		$hpkndriaris		= $_POST['hpkndriaris'];
		$khl_dy_tubuh		= $_POST['khl_dy_tubuh'];
		$khl_brt_badan		= $_POST['khl_brt_badan'];
		$tgkt_kejenuhan		= $_POST['tgkt_kejenuhan'];
		$klhn_emosi			= $_POST['klhn_emosi'];
		$pncp_diri			= $_POST['pncp_diri'];
		$depersonalisasi	= $_POST['depersonalisasi'];
		$tgkt_stress		= $_POST['tgkt_stress'];
		$rekomendasi		= $_POST['rekomendasi'];
		$id_pkp				= $_POST['id_pkp'];
				
		$cek = mysqli_query($db_link, "SELECT * FROM hasil_pkp WHERE id_hasil_pkp='$id_hasil_pkp'");

		if(mysqli_num_rows($cek) == 0){
		$insert = mysqli_query($db_link, "INSERT INTO hasil_pkp (id_hasil_pkp,knds_klinis,depresi,rs_bersalah,bnh_diri,insomnia,apatis,kelambanan,kegelisahan,kcms_psikis,kcms_somatik,ggn_pencernaan,smtk_umum,ggn_prlk_seksual,hpkndriaris,khl_dy_tubuh,khl_brt_badan,tgkt_kejenuhan,klhn_emosi,pncp_diri,depersonalisasi,tgkt_stress,rekomendasi,id_pkp) VALUES ('$id_hasil_pkp','$knds_klinis','$depresi','$rs_bersalah','$bnh_diri','$insomnia','$apatis','$kelambanan','$kegelisahan','$kcms_psikis','$kcms_somatik','$ggn_pencernaan','$smtk_umum','$ggn_prlk_seksual','$hpkndriaris','$khl_dy_tubuh','$khl_brt_badan','$tgkt_kejenuhan','$klhn_emosi','$pncp_diri','$depersonalisasi','$tgkt_stress','$rekomendasi','$id_pkp')") or die(mysqli_error());
			if($insert){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Hasil PKP Berhasil Di Simpan!</div>';
				echo '<meta http-equiv="refresh" content="0; url=?open=pkp_data">';
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal Di Simpan!</div>';
			}
			}else{
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Sudah Ada!</div>';
			}
	}
?>
<div class="container-fluid_hasil_pkp">
<div class="row">
			<h2><i class="fa fa-group"></i> Hasil PKP</h2><hr>
			<tbody>
			</tbody>
			<form class="form-horizontal" action="" method="POST">
			<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_hasil_pkp" class="form-control" value="<?php echo $id_hasil_pkp?>" readonly>
					</div>
				</div>
			<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_pkp" class="form-control" value="<?php echo $id_pkp?>" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-3 control-label">Kondisi Klinis</label></div>
					<div class="col-sm-2">
						<select class="form-control" name="knds_klinis">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Depresi</label>
					<div class="col-sm-2">
						<select class="form-control" name="depresi">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Rasa Bersalah</label>
					<div class="col-sm-2">
						<select class="form-control" name="rs_bersalah">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Bunuh Diri</label>
					<div class="col-sm-2">
						<select class="form-control" name="bnh_diri">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Insomnia</label>
					<div class="col-sm-2">
						<select class="form-control" name="insomnia">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Apatis</label>
					<div class="col-sm-2">
						<select class="form-control" name="apatis">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kelambanan</label>
					<div class="col-sm-2">
						<select class="form-control" name="kelambanan">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kegelisahan</label>
					<div class="col-sm-2">
						<select class="form-control" name="kegelisahan">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kecemas Psikis</label>
					<div class="col-sm-2">
						<select class="form-control" name="kcms_psikis">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kecemas Somatik</label>
					<div class="col-sm-2">
						<select class="form-control" name="kcms_somatik">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Gangguan Pencernaan</label>
					<div class="col-sm-2">
						<select class="form-control" name="ggn_pencernaan">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Somatik Umum</label>
					<div class="col-sm-2">
						<select class="form-control" name="smtk_umum">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Gangguan Prilaku Seksual</label>
					<div class="col-sm-2">
						<select class="form-control" name="ggn_prlk_seksual">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Hipokondriaris</label>
					<div class="col-sm-2">
						<select class="form-control" name="hpkndriaris">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kehilangan Daya Tubuh</label>
					<div class="col-sm-2">
						<select class="form-control" name="khl_dy_tubuh">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kehilangan Berat Badan</label>
					<div class="col-sm-2">
						<select class="form-control" name="khl_brt_badan">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Tingkat Kejenuhan</label>
					<div class="col-sm-2">
						<select class="form-control" name="tgkt_kejenuhan">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Kelelahan Emosi</label>
					<div class="col-sm-2">
						<select class="form-control" name="klhn_emosi">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Pencapaian Diri</label>
					<div class="col-sm-2">
						<select class="form-control" name="pncp_diri">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Depersonalisasi</label>
					<div class="col-sm-2">
						<select class="form-control" name="depersonalisasi">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Tingkat Stress</label>
					<div class="col-sm-2">
						<select class="form-control" name="tgkt_stress">
							<option value="">---Pilih---</option>	
							<option value="Rendah">Rendah</option>
							<option value="Sedang">Sedang</option>
							<option value="Tinggi">Tinggi</option>
						</select>
					</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Rekomendasi</label>
					<div class="col-sm-2">
						<select class="form-control" name="rekomendasi">
							<option value="">---Pilih---</option>	
							<option value="Wajib Konseling">Wajib Konseling</option>
							<option value="Disarankan Konseling">Disarankan Konseling</option>
							<option value="Pertahankan Kondisi Psikologis Anda">Pertahankan Kondisi Psikologis Anda</option>
						</select>
					</div>
				</div>	
				</div>
				
				<div class="form-group">
					<div class="col-sm-2">
						<input type="hidden" name="id_pkp" class="form-control" value="<?php echo $id_pkp?>" readonly>
					</div>
				</div>
									

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-warning" value="Simpan">	
						<a href="?open=hasil_pkp_data&id_pkp=<?php echo $id_pkp;?>" class="btn btn-sm btn-danger">Batal</a>							
					</div>
				</div>
			</form>
</div><!-- /row -->
</div>