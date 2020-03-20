      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";

$id_pkp = $_GET['id_pkp'];

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
			$id_pkp = $_GET['id_pkp'];
            
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
                                	
            <a href="?open=cetak_hasil_pkp"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
            <a href="?open=pkp_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-repeat"></span> Back</button></a>
			                   	
         	</td>
			</p>
			<div class="tabel-responsive"></div>
				<table id="lookup" class="table table-bordered">
					<thead>
							<tr>
	                            <th style="background-color: #ffffff">No</th>
								<th style="background-color: #aaaaff">Rekomendasi</th>
								<th style="background-color: #ffffaa">Kondisi Klinis</th>
								<th style="background-color: #ffffff">Depresi</th>
								<th style="background-color: #ffffff">Rasa Bersalah</th>
								<th style="background-color: #ffffff">Bunuh Diri</th>
								<th style="background-color: #ffffff">Insomnia</th>
								<th style="background-color: #ffffff">Apatis</th>
								<th style="background-color: #ffffff">Kelambanan</th>
								<th style="background-color: #ffffff">Kegelisahan</th>
								<th style="background-color: #ffffff">Kecemas Psikis</th>	
								<th style="background-color: #ffffff">Kecemas Somatik</th>	
								<th style="background-color: #ffffff">Gangguan Pencernaan</th>
								<th style="background-color: #ffffff">Somatik Umum</th>
								<th style="background-color: #ffffff">Gangguan Prilaku Seksual</th>
								<th style="background-color: #ffffff">Hipokondriaris</th>
								<th style="background-color: #ffffff">Kehilangan Daya Tubuh</th>
								<th style="background-color: #ffffff">Kehilangan Berat Badan</th>
								<th style="background-color: #ffffaa">Tingkat Kejenuhan</th>
								<th style="background-color: #ffffff">Kelelahan Emosi</th>
								<th style="background-color: #ffffff">Pencapaian Diri</th>
								<th style="background-color: #ffffff">Depersonalisasi</th>
								<th style="background-color: #ffffaa">Tingkat Stress</th>					
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM hasil_pkp WHERE id_pkp IN (SELECT id_pkp FROM tblpeserta_pkp WHERE id_pkp='$id_pkp')";
								$query = mysqli_query($db_link, $sql);
	                            $nomor = 0;
								while ($data = mysqli_fetch_array($query)) {
	                                $nomor++;
							?>	
								<tr>
	                                <td style="background-color: #ffffff"><center><?php echo $nomor; ?></center></td>
	                                <td style="background-color: #ffffff" align="center"><?php echo $data['rekomendasi'];?></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['knds_klinis'];?></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['depresi'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['rs_bersalah'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['bnh_diri'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['insomnia'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['apatis'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['kelambanan'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['kegelisahan'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['kcms_psikis'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['kcms_somatik'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['ggn_pencernaan'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['smtk_umum'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['ggn_prlk_seksual'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['hpkndriaris'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['khl_dy_tubuh'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['khl_brt_badan'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['tgkt_kejenuhan'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['klhn_emosi'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['pncp_diri'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['depersonalisasi'];?></td>									
									<td style="background-color: #ffffff" align="center"><?php echo $data['tgkt_stress'];?></td>									
									
									</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>