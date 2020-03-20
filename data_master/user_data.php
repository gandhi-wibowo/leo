<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }

if(isset($_GET['aksi']) == 'delete'){
    $kd_user = $_GET['kd_user'];
    $cek = mysqli_query($db_link, "SELECT * FROM tbluser WHERE kd_user='$kd_user'");
    if(mysqli_num_rows($cek) == 0){
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
    }else{
        $delete = mysqli_query($db_link, "DELETE FROM tbluser WHERE kd_user='$kd_user'");
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
			<h2><i class="fa fa-group"></i> Data User</h2><hr>
			<p><a href="?open=user_add"><button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Tambah Data</button></a>
			</p>
			<div class="tabel-responsive"></div>
				<table id="lookup" class="table table-bordered">
					<thead>
							<tr>
	                            <th style="background-color: #ffffff">No</th>
								<th style="background-color: #ffffff">Kode User</th>
								<th style="background-color: #ffffff">Nama Lengkap</th>
								<th style="background-color: #ffffff">Username</th>
								<th style="background-color: #ffffff">Level Akses</th>
								<th style="background-color: #ffffff">Status</th>
								<th style="background-color: #ffffff">Pilihan</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = 'SELECT * FROM tbluser order by kd_user ASC';
								$query = mysqli_query($db_link, $sql);
	                            $nomor = 0;
								while ($data = mysqli_fetch_array($query)) {
	                                $nomor++;
	                                if($data['aktif']=="Y"){
	                                	$klsBaris="";
	                                	$stat="<span class='label label-info'>Active</span>";
	                                }else{
	                                	$klsBaris="danger";
	                                	$stat="<span class='label label-danger'>Non Active</span>";
	                                }
							?>	
								<tr>
	                                <td style="background-color: #ffffff"><center><?php echo $nomor; ?></center></td>
									<td style="background-color: #ffffff" align="center"><?php echo $data['kd_user'];?></td>
									<td style="background-color: #ffffff"><?php echo $data['nm_lengkap'];?></a></td>
	                                <td style="background-color: #ffffff"><?php echo $data['nm_user']; ?></td>
									<td style="background-color: #ffffff"><?php echo $data['level']; ?></td>
									<td style="background-color: #ffffff" align="center"><?php echo $stat; ?></td>
									<td style="background-color: #ffffff" align="center">
                                    	<a href="?open=user_edit&kd_user=<?php echo $data['kd_user'];?>" title="Edit Data" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="?open=user_data&aksi=delete&kd_user=<?php echo $data['kd_user'];?>" title="Hapus Data" onclick="return confirm('Anda yakin mau hapus data <?php echo $data['nm_lengkap'] ?> ?')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                	</td>
								</tr>
							<?php
								}
							?>
						</tbody>						
				</table>
</div><!-- /row -->
</div>