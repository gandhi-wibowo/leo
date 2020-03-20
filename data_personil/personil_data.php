      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }

if(isset($_GET['aksi']) == 'delete'){
    $nrp = $_GET['nrp'];
    $cek = mysqli_query($db_link, "SELECT * FROM tblpersonil WHERE nrp='$nrp'");
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM tblpersonil WHERE nrp='$nrp'");
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
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12">
					<h2><i class="fa fa-group"></i> Data Personil</h2><hr>				
				</div>
				<div class="col-sm-12">
					<div class="col-sm-6">
						<a href="?open=personil_add">
							<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</button>
						</a>
						<a href="?open=upload_personil">
							<button type="button" class="btn btn-info btn-sm">
								<span class="glyphicon glyphicon-upload"></span>Upload Data Personil (.xlsx)
							</button>
						</a>					
					</div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3">
						<form action='page.php' class="form-inline">
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
						</form>
					</div>

				</div>
				<div class="col-sm-12">
						<?php echo (isset($_GET['cari'])) ? "<b> Hasil Pencarian : ".$_GET['cari']."</b>" : "&nbsp;";?>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="tabel-responsive">
				<table class="table" >
					<thead>
						<tr>
                            <th style="background-color: #ffffff">No</th>
							<th style="background-color: #ffffff">NRP</th>
							<th style="background-color: #ffffff">Nama</th>
							<th style="background-color: #ffffff">Jabatan</th>
							<th style="background-color: #ffffff">Pangkat</th>
							<th style="background-color: #ffffff">Satker</th>
							<th style="background-color: #ffffff">Pilihan</th>	
						</tr>
					</thead>
					<tbody>
						<?php
						$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
						$limit = 10;
						$limit_start = ($page - 1) * $limit;
						$no = $limit_start + 1;

						$cari    = @$_GET['cari'];
						$search_query = "";
						if (!empty($cari)) {
							$search_query = " WHERE nrp LIKE '%{$cari}%' OR nama LIKE '%{$cari}%' OR jabatan LIKE '%{$cari}%' OR pangkat LIKE '%{$cari}%' OR satker LIKE '%{$cari}%' ";
						}

						$sql = "SELECT * FROM tblpersonil {$search_query} LIMIT $limit_start,$limit";
						$query = mysqli_query($db_link, $sql);

						while ($data = mysqli_fetch_array($query)) { ?>	
							<tr>
                                <td style="background-color: #ffffff"><center><?php echo $no; ?></center></td>
								<td style="background-color: #ffffff" align="center"><?php echo $data['nrp'];?></td>
								<td style="background-color: #ffffff" align="center"><?php echo $data['nama'];?></td>
								<td style="background-color: #ffffff"><?php echo $data['jabatan'];?></a></td>
                                <td style="background-color: #ffffff"><?php echo $data['pangkat']; ?></td>
								<td style="background-color: #ffffff"><?php echo $data['satker']; ?></td>
								<td style="background-color: #ffffff" align="center">
                                	<a href="?open=personil_edit&nrp=<?php echo $data['nrp'];?>" title="Edit Data" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    <a href="?open=personil_data&aksi=delete&nrp=<?php echo $data['nrp'];?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data <?php echo $data['nama'] ?> ?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            	</td>
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

		            $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM tblpersonil {$search_query}");
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



