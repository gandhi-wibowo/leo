      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";

$id_pkp = @$_GET['id_pkp'];

if(isset($_GET['aksi']) == 'delete'){

	$id_pkp = $_GET['id_pkp'];
	        
    $id_hasil_pkp = $_GET['id_hasil_pkp'];
    $cek = mysqli_query($db_link, "SELECT * FROM hasil_pkp WHERE id_hasil_pkp='$id_hasil_pkp'");
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM hasil_pkp WHERE id_hasil_pkp='$id_hasil_pkp'");
    	if($delete){
        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus!</div>';
    	}else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
    	}
    }
}	  
?>
<div class="container-fluid">
	<div class="row">
		<h2><i class="fa fa-group"></i> Profil Klinis Psikologi</h2><hr>
		<tbody>
		<?php
		$id_pkp = @$_GET['id_pkp'];
        
							$sql = "SELECT * FROM tblpersonil WHERE nrp IN (SELECT nrp FROM tblpeserta_pkp WHERE id_pkp='$id_pkp')";
							$query = mysqli_query($db_link, $sql);
							$data = mysqli_fetch_array($query);
						?>
		<p>
		<tr>
		<h3> <th style="background-color: #ffffaa">NAMA : </th><td style="background-color: #ffffff" align="center"><?php echo $data['nama'];?></td></h3>
		</tr>
		</tbody>
		
		<p>
		<?php
							$sql = "SELECT * FROM hasil_pkp WHERE id_pkp IN (SELECT id_pkp FROM tblpeserta_pkp WHERE id_pkp='$id_pkp')";
							$query = mysqli_query($db_link, $sql);
                           // $nomor = 0;
							//$data = mysqli_fetch_array($query);
							if(mysqli_num_rows($query) == 0)
							{
								$id_hasil_pkp =autonumber("hasil_pkp", "id_hasil_pkp", 5, "HSP");
								//echo $id_hasil_pkp;
								$data['id_hasil_pkp'] = $id_hasil_pkp ;
							}
							else
							{
								$data = mysqli_fetch_array($query);
							}
                            //    $nomor++;
						?> 
		<a href="?open=hasil_pkp_add&id_hasil_pkp=<?php echo $data['id_hasil_pkp'];?>&id_pkp=<?php echo $id_pkp;?>"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span> Input Hasil PKP</button></a>
		<a href="?open=hasil_pkp_edit&id_hasil_pkp=<?php echo $data['id_hasil_pkp'];?>&id_pkp=<?php echo $id_pkp;?>" title="Edit PKP" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
        
		<a href="?open=hasil_pkp_data&aksi=delete&id_hasil_pkp=<?php echo $data['id_hasil_pkp'];?>&id_pkp=<?php echo $data['id_pkp'];?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            	
        <a href="./cetak/cetak_hasil_pkp.php?id_pkp=<?=$id_pkp; ?>" target="_blank"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
        <a href="?open=pkp_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-repeat"></span> Back</button></a>
		                   	
     	</td>
		</p>
		<div class="tabel-responsive"></div>
			<table class="table table-bordered">
				<thead>
					<tr>
                        <th style="background-color: #ffffff">No</th>
						<th style="background-color: #ffffff">Skala Psikologi</th>
						<th style="background-color: #ffffff">Indikasi / Kategori</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$sql = "
					SELECT
					knds_klinis AS 'kondisi klinis',
					depresi,
					rs_bersalah AS 'rasa bersalah',
					bnh_diri AS 'bunuh diri',
					insomnia,
					apatis,
					kelambanan,
					kegelisahan,
					kcms_psikis AS 'kecemasan psikis',
					kcms_somatik AS 'kecemasan somatik',
					ggn_pencernaan AS 'gangguan pencernaan',
					smtk_umum AS 'somatik umum',
					ggn_prlk_seksual AS 'gangguan prilaku seksual',
					hpkndriaris AS 'hipokondriaris',
					khl_dy_tubuh AS 'kehilangan daya tubuh',
					khl_brt_badan AS 'kehilangan berat badan',
					tgkt_kejenuhan AS 'tingkat kejenuhan',
					klhn_emosi AS 'kelelahan emosi',
					pncp_diri AS 'pencapaian diri',
					depersonalisasi,
					tgkt_stress AS 'tingkat stress',
					rekomendasi					
					FROM hasil_pkp HPKP
					LEFT JOIN tblpeserta_pkp PPKP ON HPKP.id_pkp = PPKP.id_pkp
					WHERE PPKP.id_pkp='{$id_pkp}';
					";
					$query = mysqli_query($db_link, $sql);
					while ($data = mysqli_fetch_assoc($query)) {
						echo createTr($data);
					}

					?>
				</tbody>						
			</table>
		</div>
	</div>
</div>