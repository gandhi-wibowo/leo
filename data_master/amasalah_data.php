      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }

if(isset($_GET['aksi']) == 'delete'){
    $id_amasalah = $_GET['id_amasalah'];
    $cek = mysqli_query($db_link, "SELECT * FROM tblpeserta_amasalah WHERE id_amasalah='$id_amasalah'");
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM tblpeserta_amasalah WHERE id_amasalah = '$id_amasalah'");
        $delete = mysqli_query($db_link, "DELETE FROM tblpeserta_amasalah WHERE id_amasalah IN (SELECT id_amasalah FROM hasil_amasalah WHERE id_amasalah='$id_amasalah')");
        $delete = mysqli_query($db_link, "DELETE FROM hasil_amasalah WHERE id_amasalah IN (SELECT id_amasalah FROM hasil_amasalah WHERE id_amasalah='$id_amasalah')");
    	
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
			<h2><i class="fa fa-group"></i> Data Peserta Konseling Anggota Bermasalah</h2><hr>
			<p><a href="?open=amasalah_personil_data"><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</button></a></p>
			<div class="tabel-responsive"></div>
				<table id="lookup" class="table table-bordered">
					<thead>
							<tr>
	                            <th style="background-color: #ffffff">No</th>
								<th style="background-color: #ffffff">NRP</th>
								<th style="background-color: #ffffff">Nama</th>
								<th style="background-color: #ffffff">Jabatan</th>
								<th style="background-color: #ffffff">Pangkat</th>
								<th style="background-color: #ffffff">Satker</th>
								<th style="background-color: #ffffff">Tgl Konseling</th>
								<th style="background-color: #ffffff">Hasil Konseling</th>
								<th style="background-color: #ffffff">Pilihan</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = 'SELECT tblpersonil.*, tblpeserta_amasalah.* FROM tblpersonil, tblpeserta_amasalah WHERE tblpersonil.nrp = tblpeserta_amasalah.nrp order by nama ASC';
								$query = mysqli_query($db_link, $sql);
	                            $nomor = 0;
								while ($data = mysqli_fetch_array($query)) {
	                                $nomor++;
							?>	
								<tr>
	                                <td style="background-color: #ffffff"><center><?php echo $nomor; ?></center></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['nrp'];?></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['nama'];?></td>
									<td style="background-color: #ffffff"><?php echo $data['jabatan'];?></a></td>
	                                <td style="background-color: #ffffff"><?php echo $data['pangkat']; ?></td>
	                                <td style="background-color: #ffffff"><?php echo $data['satker']; ?></td>
									<td style="background-color: #ffffff" align="center"><?php echo tgl_indo2($data['tgl']);  ?></td>
									<td style="background-color: #ffffff" align="center">
                                    	<a href="?open=hasil_amasalah_data&id_amasalah=<?php echo $data['id_amasalah'];?>" title="Hasil" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                                        </span></a>                              
                                	</td>
									
									<td style="background-color: #ffffff" align="center">
                                    	<a href="?open=amasalah_edit&id_amasalah=<?php echo $data['id_amasalah'];?>" title="Edit Tanggal Konseling" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="?open=amasalah_data&aksi=delete&id_amasalah=<?php echo $data['id_amasalah'];?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data <?php echo $data['nama'] ?> ?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                	</td>
								</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>