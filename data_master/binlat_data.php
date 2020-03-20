      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }

if(isset($_GET['aksi']) == 'delete'){
    $id_binlat = $_GET['id_binlat'];
    $cek = mysqli_query($db_link, "SELECT * FROM tblpeserta_binlat WHERE id_binlat='$id_binlat'");
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM tblpeserta_binlat WHERE id_binlat='$id_binlat'");
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
			<h2><i class="fa fa-group"></i> Data Peserta Konseling BINLAT PSI</h2><hr>
			<p><a href="?open=binlat_add"><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</button></a>
			<a href="?open=upload_binlat"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-upload"></span>Upload Data Binlat (.xlsx)</button></a></p>
			<a href="?open=cetak_hasil_binlat"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
            <a href="?open=binlat_data"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-repeat"></span> Back</button></a>
			
			<div class="tabel-responsive"></div>
				<table id="lookup" class="table table-bordered">
					<thead>
							<tr>
	                            <th style="background-color: #ffffff">No</th>
								<th style="background-color: #ffffff">nama</th>
								<th style="background-color: #ffffff">Tanggal Konseling</th>
								<th style="background-color: #ffffff">Pemkab</th>
								<th style="background-color: #ffffff">Pendidikan</th>
								<th style="background-color: #ffffff">Pre Test</th>
								<th style="background-color: #ffffff">Post Test</th>
								<th style="background-color: #ffffff">Nilai</th>	
								<th style="background-color: #ffffff">Pilihan</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = 'SELECT * FROM tblpeserta_binlat order by nama ASC';
								$query = mysqli_query($db_link, $sql);
	                            $nomor = 0;
								while ($data = mysqli_fetch_array($query)) {
	                                $nomor++;
							?>	
								<tr>
	                                <td style="background-color: #ffffff"><center><?php echo $nomor; ?></center></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['nama'];?></td>
									<td style="background-color: #ffffff" align="center"><?php echo tgl_indo2($data['tgl']);  ?></td>
									<td style="background-color: #ffffff"><?php echo $data['pemkab'];?></a></td>
	                                <td style="background-color: #ffffff"><?php echo $data['pendidikan']; ?></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['pretest'];?></td>
									<td style="background-color: #ffffff"><?php echo $data['posttest']; ?></td>
									<td style="background-color: #ffffff"><?php echo $data['nilai']; ?></td>
									<td style="background-color: #ffffff" align="center">
                                    	<a href="?open=binlat_edit&id_binlat=<?php echo $data['id_binlat'];?>" title="Edit Data" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="?open=binlat_data&aksi=delete&id_binlat=<?php echo $data['id_binlat'];?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data <?php echo $data['nama'] ?> ?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                	</td>
								</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>