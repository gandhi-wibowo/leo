      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }

require_once ("library/koneksi.php");
require_once "library/library.php";
opendb();
$_SESSION['SES_LOGIN'] ? $user_id = trim($_SESSION['SES_LOGIN']) : $user_id="";
?>
<div class="container-fluid">
<div class="row">
			<h2><i class="fa fa-group"></i> Data Konseling Anggota Bermasalah</h2><hr>
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
							
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT tblpersonil.*, tblpeserta_amasalah.* FROM tblpersonil LEFT JOIN tblpeserta_amasalah ON tblpeserta_amasalah.nrp = tblpersonil.nrp WHERE tblpeserta_amasalah.nrp = '$user_id'";
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
                                    	<a href="?open=hasil_amasalah_data_personil&id_amasalah=<?php echo $data['id_amasalah'];?>" title="Hasil" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                                        </span></a>                              
                                	</td>
									
									
								</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>