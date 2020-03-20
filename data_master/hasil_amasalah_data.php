      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once "library/library.php";

$id_amasalah = $_GET['id_amasalah'];

if(isset($_GET['aksi']) == 'delete'){

	$id_amasalah = $_GET['id_amasalah'];
	        
    $id_hasil_amasalah = $_GET['id_hasil_amasalah'];
    $cek = mysqli_query($db_link, "SELECT * FROM hasil_amasalah WHERE id_hasil_amasalah='$id_hasil_amasalah'");
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM hasil_amasalah WHERE id_hasil_amasalah='$id_hasil_amasalah'");
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
			<h2><i class="fa fa-group"></i>Konseling Anggota Bermasalah</h2><hr>
			<tbody>
			<?php
			$id_amasalah = $_GET['id_amasalah'];
            
								$sql = "SELECT * FROM tblpersonil WHERE nrp IN (SELECT nrp FROM tblpeserta_amasalah WHERE id_amasalah='$id_amasalah')";
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
								$sql = "SELECT * FROM hasil_amasalah WHERE id_amasalah IN (SELECT id_amasalah FROM tblpeserta_amasalah WHERE id_amasalah='$id_amasalah')";
								$query = mysqli_query($db_link, $sql);
	                           // $nomor = 0;
								//$data = mysqli_fetch_array($query);
								if(mysqli_num_rows($query) == 0)
								{
									$id_hasil_amasalah =autonumber("hasil_amasalah", "id_hasil_amasalah", 5, "HSA");
									//echo $id_hasil_amasalah;
									$data['id_hasil_amasalah'] = $id_hasil_amasalah ;
								}
								else
								{
									$data = mysqli_fetch_array($query);
								}
	                            //    $nomor++;
							?> 
			<a href="?open=hasil_amasalah_add&id_hasil_amasalah=<?php echo $data['id_hasil_amasalah'];?>&id_amasalah=<?php echo $id_amasalah;?>"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span> Input Hasil Konseling</button></a>
			<a href="?open=hasil_amasalah_edit&id_hasil_amasalah=<?php echo $data['id_hasil_amasalah'];?>&id_amasalah=<?php echo $id_amasalah;?>" title="Edit" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></p>
            
			<a href="?open=hasil_amasalah_data&aksi=delete&id_hasil_amasalah=<?php echo $data['id_hasil_amasalah'];?>&id_amasalah=<?php echo $data['id_amasalah'];?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                	
            <a href="?open=cetak_hasil_amasalah&id_hasil_amasalah=<?php echo $data['id_hasil_amasalah'];?>"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
            <a href="?open=amasalah_data"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-repeat"></span> Back</button></a>
			                   	
         	</td>
			</p>
			<div class="tabel-responsive"></div>
				<table class="table table-bordered">
					<thead>
							<tr>
	                            <th style="background-color: #ffffff">Tempat</th>
								<th style="background-color: #ffffff">Identifikasi Masalah</th>
								<th style="background-color: #ffffff">Harapan</th>
								<th style="background-color: #ffffff">Penanganan</th>
								<th style="background-color: #ffffff">Dinamika PSI</th>
								<th style="background-color: #ffffff">Saran</th>
								<th style="background-color: #ffffff">Konselor</th>
										
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM hasil_amasalah WHERE id_amasalah IN (SELECT id_amasalah FROM tblpeserta_amasalah WHERE id_amasalah='$id_amasalah')";
								$query = mysqli_query($db_link, $sql);
	                            $nomor = 0;
								while ($data = mysqli_fetch_array($query)) {
	                                $nomor++;
							?>	
								<tr>
	                                <td style="background-color: #ffffff" align="left"><?php echo $data['tempat'];?></td>
									<td style="background-color: #ffffff" align="left"><textarea rows="6" readonly=""><?php echo $data['ident_masalah'];?></textarea></td>
									<td style="background-color: #ffffff" align="left"><textarea rows="6" readonly=""><?php echo $data['harapan'];?></textarea></td>
									<td style="background-color: #ffffff" align="left"><textarea rows="6" readonly=""><?php echo $data['penanganan'];?></textarea></td>
									<td style="background-color: #ffffff" align="left"><textarea rows="6" readonly=""><?php echo $data['dnmk_psi'];?></textarea></td>
									<td style="background-color: #ffffff" align="left"><textarea rows="6" readonly=""><?php echo $data['saran'];?></textarea></td>
									<td style="background-color: #ffffff" align="left"><textarea rows="6" readonly=""><?php echo $data['nama_konselor'];?></textarea></td>
									
									</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>