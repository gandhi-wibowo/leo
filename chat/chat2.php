<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once ('library/library.php');
$dari = $_SESSION['SES_LOGIN'];
  

            $kd_user= isset($_GET['kd_user']) ?  $_GET['kd_user'] : '';
            $sql = mysqli_query($db_link, "SELECT * FROM tbluser WHERE kd_user='$kd_user'");
            if(mysqli_num_rows($sql) == 0){
                //header("Location: ?open=chat2");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
            $dari    = $_SESSION['SES_LOGIN'];
            $kepada     = htmlspecialchars($_POST['kepada']);
            $pesan      = htmlspecialchars($_POST['pesan']);
            $tgl        = date("Y-m-d");
            $waktu      = date("H:i:s");
                
            $kirim = mysqli_query($db_link,"INSERT INTO tblchat VALUES(null,'$dari','$kepada','$pesan','$tgl','$waktu','N')");
            if($kirim){
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Terkirim!</div>';
            }else{
                echo "gagal";
            }
        }

        if(isset($_GET['aksi']) == 'delete'){
            $id = $_GET['id'];
            $cek = mysqli_query($db_link, "SELECT * FROM tblchat WHERE id='$id'");
            if(mysqli_num_rows($cek) == 0){
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
            }else{
                $delete = mysqli_query($db_link, "DELETE FROM tblchat WHERE id='$id'");
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
		<div class="col-md-5">
			<div style="overflow:auto;height:320px;">
				<table class="table table-bordered">
						<tbody>
							<?php
							$Tampil= "SELECT tblchat.* , tbluser.* FROM tblchat, tbluser
							WHERE tblchat.dari=tbluser.kd_user AND tblchat.dari='$dari' AND tblchat.kepada='$kd_user' OR tblchat.dari=tbluser.kd_user AND tblchat.dari='$kd_user' AND tblchat.kepada='$dari' ORDER BY tblchat.id ASC LIMIT 99";

							$query = mysqli_query($db_link, $Tampil);
							while (	$hasil = mysqli_fetch_array ($query)) {
								$pesan 	 = stripslashes ($hasil['pesan']);
							/*$update = mysqli_query($db_link,"UPDATE tblchat SET dibaca='Y'
							WHERE kepada='$kd_user'");*/
							echo"
								<div id='atas'>
                                    <div class='btn btn-sm btn-danger'>
                                        <i class='fa fa-user'></i>&nbsp;$hasil[nm_user]
                                    </div>&nbsp;&nbsp;
                                    <a href='?open=chat2&aksi=delete&id=$hasil[id]' onclick='return confirm('Anda yakin mau hapus pesan ini?')' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                                    <span class='waktu'>$hasil[tgl]&nbsp/&nbsp;$hasil[waktu]
                                </div></span>
								<div id='pesan'>$hasil[pesan]</div>";
							}
							?>
						</tbody>
				</table>  
			</div>
		
				<form class="form-horizontal" action="" method="POST">
					   <div class="form-group">
                			<div class="col-sm-2">
                				<input type="hidden" name="kepada" class="form-control" value="<?php echo $row ['kd_user']; ?>" required>
                			</div>
                		</div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <input type="hidden" name="nama" class="form-control" value="<?php echo $row ['nm_user']; ?>" required>
                            </div>
                        </div>
                		<label>Pesan    :</label>
                        <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="pesan" required />
                                <span class="input-group-btn">
                                    <input type="submit" name="save" class="btn btn-sm btn-primary" value="Kirim">
                                </span>
                        </div><br>							
						
				</form>
	</div><!-- /row -->
            <div class="col-md-9">
            
                    <a href="?open=chat" class="btn btn-sm btn-success">Kembali</a>
            
        </div>
</div>
</div>