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
			<a href="?open=cetak_konseling_lnjt"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Cetak</button></a>
            <a href="?open=pkp_data_personil"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-repeat"></span> Back</button></a>
			                   	
         	</td>
			</p>
			<div class="tabel-responsive"></div>
				<table class="table table-bordered">
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