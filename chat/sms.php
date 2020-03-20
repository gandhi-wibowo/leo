<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
require_once ('library/library.php');
            $kd_user = $_GET['kd_user'];
            $sql = mysqli_query($db_link, "SELECT * FROM tbluser WHERE kd_user='$kd_user'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=chat2");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5">
		      <form class="form-horizontal" action="" method="POST">
					<div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" name="nm_user" class="form-control" value="<?php echo $row ['nm_user']; ?>" required>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">No HP</label>
                            <div class="col-sm-4">
                                <input type="text" name="nm_user" class="form-control" value="<?php echo $row ['no_hp']; ?>" required>
                            </div>
                    </div>
                    <iframe src=http://smsgratis.web.id/wg3/?teks=Petugas_Piket frameborder=0 style=height:400px;width:400px;></iframe><hr>
			 </form>
	</div><!-- /row -->
            <div class="col-md-9">
            <div>
                    <a href="?open=chat" class="btn btn-sm btn-success">Kembali</a>
                </form>
            </div>
        </div>
</div>
</div>