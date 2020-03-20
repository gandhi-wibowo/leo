<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
 require_once "library/library.php";

            $nrp = $_GET['nrp'];
            $sql = mysqli_query($db_link, "SELECT * FROM tblpeserta WHERE nrp='$nrp'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=binlat_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
                $nrp        = $_POST['nrp'];
                $nama           = $_POST['nama'];
                $jabatan       = $_POST['jabatan'];
                $pangkat         = $_POST['pangkat'];
                $tgl            = $_POST['tgl'];
                $rekomendasi            = $_POST['rekomendasi'];
                
                $tgl      = ubah_tgl2($tgl);
                $update = mysqli_query($db_link, "UPDATE tblpeserta SET nama='$nama', jabatan='$jabatan', pangkat='$pangkat', tgl='$tgl', rekomendasi='$rekomendasi' WHERE nrp='$nrp'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=binlat_edit&nrp=".$nrp."&pesan=sukses");
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
        <h2><i class="fa fa-group"></i> Edit Data Peserta Konseling</h2><hr>
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="hidden" name="nrp" class="form-control" value="<?php echo $nrp?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Tamu</label>
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
                    <label class="col-sm-2 control-label">pangkat</label>
                    <div class="col-sm-3">
                        <input type="text" name="pangkat" class="form-control" value="<?php echo $row ['pangkat']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tgl Konseling</label>
                    <div class="col-sm-2">
                        <input name="tgl" id="tgl" class="input-group date form-control" value="<?php echo indonesiaTgl($row ['tgl']); ?>" required>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Rekomendasi</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="rekomendasi">
                            <option value=""><?php echo $row ['rekomendasi']; ?></option>   
                            <option value="Wajib Konseling">Wajib Konseling</option>
                            <option value="Disarankan Konseling">Disarankan Konseling</option>
                            <option value="Pertahankan Kondisi Psikologis Anda">Pertahankan Kondisi Psikologis Anda</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">  
                        <a href="?open=binlat_data" class="btn btn-sm btn-danger">Batal</a>                          
                    </div>
                </div>
            </form>
    </div><!-- /row -->
</div>