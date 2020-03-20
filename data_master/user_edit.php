<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }

            $kd_user = $_GET['kd_user'];
            $sql = mysqli_query($db_link, "SELECT * FROM tbluser WHERE kd_user='$kd_user'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=user_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
                $kd_user        = $_POST['kd_user'];
                $nm_lengkap     = $_POST['nm_lengkap'];
                $nm_user        = $_POST['nm_user'];
                $password       = md5($_POST['password']);
                $level          = $_POST['level'];
                $aktif         = $_POST['aktif'];
                
                $update = mysqli_query($db_link, "UPDATE tbluser SET nm_lengkap='$nm_lengkap', nm_user='$nm_user', password='$password', level='$level', aktif='$aktif' WHERE kd_user='$kd_user'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=user_edit&kd_user=".$kd_user."&pesan=sukses");
                }else{
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal di Edit, silahkan coba lagi.</div>';
                }
            }
            
            if(isset($_GET['pesan']) == 'sukses'){
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil di Edit.</div>';
            }
?>
<div class="container-fluid">
    <div class="row">
                    <h2><i class="fa fa-group"></i> Edit Data User</h2><hr>
                    <form class="form-horizontal" action="" method="POST">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">ID User</label>
                            <div class="col-sm-2">
                                <input type="text" name="kd_user" class="form-control" placeholder="Kode Dokter" value="<?php echo $row ['kd_user']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-3">
                                <input type="text" name="nm_lengkap" class="form-control" value="<?php echo $row ['nm_lengkap']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-3">
                                <input type="text" name="nm_user" class="form-control" value="<?php echo $row ['nm_user']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-2">
                                <input type="password" name="password" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="level">
                                <?php if($row["level"]=="Admin"){$plh1='selected';$plh2='';$plh3='';$plh4='';}elseif($row["level"]=="Petugas"){$plh1='';$plh2='selected';$plh3='';$plh4='';}elseif($row["level"]=="User"){$plh1='';$plh2='';$plh3='selected';$plh4='';}elseif($row["level"]=="Kepsek"){$plh1='';$plh2='';$plh3='';$plh4='selected';}?>
                                    <option value="Admin" <?php echo $plh1?>>Admin</option>
                                    <option value="Petugas" <?php echo $plh2?>>Petugas</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label">aktif</label>
                            <div class="col-sm-1">
                                <select class="form-control" name="aktif">
                                <?php if($row["aktif"]=="Y"){$plh1='selected';$plh2='';}else{$plh1='';$plh2='selected';}?>
                                     <option value="Y" <?php echo $plh1?>>Ya</option>
                                      <option value="T" <?php echo $plh2?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-6">
                                <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">
                                <a href="?open=user_data" class="btn btn-sm btn-danger">Batal</a>                 
                            </div>
                        </div>
                    </form>
    </div><!-- /row -->
</div>