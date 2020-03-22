<?php
error_reporting(0);
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
}

$tAwal = @$_GET['awal'];
$tAkhir = @$_GET['akhir'];
$cari   = @$_GET['cari'];
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$limit = 10;
$limit_start = ($page - 1) * $limit;
$no = $limit_start + 1;

$withDate = false;
$optQuery = "";
$urlCetak = "";
if ($tAwal != "" && $tAkhir != "") {
    $withDate = true;
    $optQuery.= "WHERE DATE(tgl) >= DATE('{$tAwal}') AND DATE(tgl) <= DATE('{$tAkhir}') ";
    $urlCetak.= "&awal={$tAwal}&akhir={$tAkhir}";
}
if ($withDate) {
    if ($cari != "") {
        $optQuery.= " AND nama LIKE '%{$cari}%' OR no_hp LIKE '%{$cari}%' OR pemkab LIKE '%{$cari}%' OR pendidikan LIKE '%{$cari}%' OR pretest LIKE '%{$cari}%' OR posttest LIKE '%{$cari}%' OR nilai LIKE '%{$cari}%' ";
        $urlCetak.="&cari={$cari}";
    }
}
else{
    if($cari != ""){
        $optQuery.= " WHERE nama LIKE '%{$cari}%' OR no_hp LIKE '%{$cari}%' OR pemkab LIKE '%{$cari}%' OR pendidikan LIKE '%{$cari}%' OR pretest LIKE '%{$cari}%' OR posttest LIKE '%{$cari}%' OR nilai LIKE '%{$cari}%' ";
        $urlCetak.="&cari={$cari}";
    }
}

$fullQuery = "SELECT * FROM tblpeserta_binlat {$optQuery} LIMIT {$limit_start},{$limit}";
$countQuery = "SELECT COUNT(*) AS jumlah FROM tblpeserta_binlat {$optQuery}";
$urlCetak.="&page={$page}";
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12">
					<h2>
						<i class="fa fa-book"></i> LAPORAN DATA PESERTA BINLAT SISWA
					</h2>
					<hr>		
				</div>
				<div class="col-sm-12">
					<div class="col-sm-8" >
						<form action='page.php' class="form-inline">
							<div class="col-sm-8">
								<div class="col-sm-6">
								  <div class="form-group">
								    <input  name="awal" id="awal" class="form-control input-sm date" placeholder="Awal" value="<?= @$_GET['awal']; ?>">
								  </div>
								</div>
								<div class="col-sm-6">
								  <div class="form-group">
								    <input  name="akhir" id="akhir" class="form-control input-sm date" placeholder="Akhir" value="<?= @$_GET['akhir']; ?>">
								  </div>									
								</div>
							</div>
							<div class="col-sm-4">
								<div class="col-sm-10">
								  <div class="form-group">
								  	<?= hiddenFormSearch($_GET); ?>
								    <input type="text" name="cari" class="form-control input-sm" id="cari" placeholder="Cari" value="<?= @$_GET['cari']; ?>">
								  </div>									
								</div>
								<div class="col-sm-2">
									<button class="btn btn-sm btn-success" type="submit" >
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</div>
							</div>
						</form>						
					</div>
					<div class="col-sm-4">
						<a href='cetak/cetak_lap_hasil_binlat.php?<?= $urlCetak;?>' class="btn btn-sm btn-success" type="submit" >
							<span class="glyphicon glyphicon-print"></span> Cetak
						</a>
					</div>
				</div>
				<div class="col-sm-12">&nbsp;</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="tabel-responsive">
				<table class="table" >
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
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($db_link, $fullQuery);
						while ($data = mysqli_fetch_array($query)) { ?>	
							<tr>
							    <td style="background-color: #ffffff" align="center"><?= $no;?> </td>
							    <td style="background-color: #ffffff" align="center"><?= $data['nama'];?></td>
							    <td style="background-color: #ffffff" align="center"><?= tgl_indo2($data['tgl']);  ?></td>
							    <td style="background-color: #ffffff"><?= $data['pemkab'];?></a></td>
							    <td style="background-color: #ffffff"><?= $data['pendidikan']; ?></td>
							    <td style="background-color: #ffffff" align="center"><?= $data['pretest'];?></td>
							    <td style="background-color: #ffffff"><?= $data['posttest']; ?></td>
							    <td style="background-color: #ffffff"><?= $data['nilai']; ?></td>
							</tr>
						<?php $no++; } ?>
					</tbody>
				</table>			
			</div>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-6">
			  <ul class="pagination">
			  </ul>
			</div>
			<div class="col-sm-6" align="right">
		        <ul class="pagination">
		            <?php if ($page == 1) { ?>
		                <li class="disabled"><a href="#">First</a></li>
		                <li class="disabled"><a href="#">&laquo;</a></li>
		            <?php } else { $link_prev = ($page > 1) ? $page - 1 : 1; ?>
		                <li><a href="page.php<?= createUrl($_GET,'page');?>page=1">First</a></li>
		                <li><a href="page.php<?= createUrl($_GET,'page');?>page=<?php echo $link_prev; ?>">&laquo;</a></li>
		            <?php  }  

		            $sql2 = $pdo->prepare($countQuery);
		            $sql2->execute();
		            $get_jumlah = $sql2->fetch();

		            $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
		            $jumlah_number = 3;
		            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
		            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; 

		            for ($i = $start_number; $i <= $end_number; $i++) {
		                $link_active = ($page == $i) ? 'class="active"' : '';
		            ?>
		                <li <?php echo $link_active; ?>><a href="page.php<?= createUrl($_GET,'page');?>page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		            <?php }
		            if ($page == $jumlah_page) {
		            ?>
		                <li class="disabled"><a href="#">&raquo;</a></li>
		                <li class="disabled"><a href="#">Last</a></li>
		            <?php } else { $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page; ?>
		                <li><a href="page.php<?= createUrl($_GET,'page');?>page=<?php echo $link_next; ?>">&raquo;</a></li>
		                <li><a href="page.php<?= createUrl($_GET,'page');?>page=<?php echo $jumlah_page; ?>">Last</a></li>
		            <?php } ?>
		        </ul>
			</div>
		</div>
	</div>
</div>

