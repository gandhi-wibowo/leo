      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";

$id_pkp = $_GET['id_pkp'];
$tgl = $_GET['tgl'];

if(isset($_GET['aksi']) == 'delete'){

	$id_pkp = $_GET['id_pkp'];
	        
    $id_konseling_lnjt = $_GET['id_konseling_lnjt'];
    $cek = mysqli_query($db_link, "SELECT * FROM konseling_lnjt WHERE id_konseling_lnjt='$id_konseling_lnjt'");
    //$tgl 		= ubah_tgl2($tgl);
		
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM konseling_lnjt WHERE id_konseling_lnjt='$id_konseling_lnjt'");
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
			<h2><i class="fa fa-group"></i> Hasil Konseling Lanjutan</h2><hr>
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
								$sql = "SELECT * FROM konseling_lnjt WHERE id_pkp IN (SELECT id_pkp FROM tblpeserta_pkp WHERE id_pkp='$id_pkp')";
								$query = mysqli_query($db_link, $sql);
	                           // $nomor = 0;
								//$data = mysqli_fetch_array($query);
								if(mysqli_num_rows($query) == 0)
								{
									$id_konseling_lnjt =autonumber("konseling_lnjt", "id_konseling_lnjt", 5, "KLJ");
									//echo $id_konseling_lnjt;
									$data['id_konseling_lnjt'] = $id_konseling_lnjt ;
								}
								else
								{
									$data = mysqli_fetch_array($query);
								}
	                            //    $nomor++;
							?> 
			<a href="?open=konseling_tambahan_pkp_add&id_konseling_lnjt=<?php echo $data['id_konseling_lnjt'];?>&id_pkp=<?php echo $id_pkp;?>&tgl=<?php echo $tgl;?>"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span> Input Hasil Konseling</button></a>

			<a href="?open=konseling_tambahan_pkp_edit&id_konseling_lnjt=<?php echo $data['id_konseling_lnjt'];?>&id_pkp=<?php echo $id_pkp;?>&tgl=<?php echo $tgl;?>" title="Edit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
            
			<a href="?open=konseling_tambahan_pkp_data&aksi=delete&id_konseling_lnjt=<?php echo $data['id_konseling_lnjt'];?>&id_pkp=<?php echo $data['id_pkp'];?>&tgl=<?php echo $tgl;?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                	
            <a href="?open=cetak_konseling_lnjt"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
            <a href="?open=pkp_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-repeat"></span> Back</button></a>
			                   	
         	</td>
			</p>
			<div class="tabel-responsive"></div>
				<table id="lookup" class="table table-bordered">
					<thead>
							<tr>
	                            <th style="background-color: #ffffff">No</th>
								<th style="background-color: #ffffff">Saran</th>
								<th style="background-color: #ffffff">Tanggal</th>							
							</tr>
						</thead>
						<tbody>
							<?php

								$sql = "SELECT * FROM konseling_lnjt  WHERE id_pkp='$id_pkp'";
								$query = mysqli_query($db_link, $sql);
	                            $nomor = 0;
								while ($data = mysqli_fetch_array($query)) {
	                                $nomor++;
							?>	
								<tr>
	                                <td style="background-color: #ffffff"><center><?php echo $nomor; ?></center></td>
	                                <td style="background-color: #ffffff" align="center"><?php echo $data['saran'];?></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['tgl'];?></td>
								</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>