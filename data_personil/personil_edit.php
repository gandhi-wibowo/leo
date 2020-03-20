<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
 require_once "library/library.php";

            $nrp = $_GET['nrp'];
            $sql = mysqli_query($db_link, "SELECT * FROM tblpersonil WHERE nrp='$nrp'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=peserta_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
                $nrp        = $_POST['nrp'];
                $nama           = $_POST['nama'];
                $jabatan       = $_POST['jabatan'];
                $pangkat         = $_POST['pangkat'];
                $satker            = $_POST['satker'];
                
               // $tgl      = ubah_tgl2($tgl);
                $update = mysqli_query($db_link, "UPDATE tblpersonil SET nama='$nama', jabatan='$jabatan', pangkat='$pangkat', satker='$satker' WHERE nrp='$nrp'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=personil_edit&nrp=".$nrp."&pesan=sukses");
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
        <h2><i class="fa fa-group"></i> Edit Data Personil</h2><hr>
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">NRP</label>
                    <div class="col-sm-2">
                        <input type="readonly" name="nrp" class="form-control" value="<?php echo $nrp?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Personil</label>
                    <div class="col-sm-3">
                        <input type="text" name="nama" class="form-control" value="<?php echo $row ['nama']; ?>" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">jabatan</label>
                    <div class="col-sm-4">
                        <input type="text" name="jabatan" class="form-control" value="<?php echo $row ['jabatan']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Pangkat</label>
                    <div class="col-sm-3">
                        <input type="text" name="pangkat" class="form-control" value="<?php echo $row ['pangkat']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Satker</label>
                    <div class="col-sm-3">
                        <input type="text" name="satker" class="form-control" value="<?php echo $row ['satker']; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">  
                        <a href="?open=personil_data" class="btn btn-sm btn-danger">Batal</a>                          
                    </div>
                </div>
            </form>
    </div><!-- /row -->
</div>