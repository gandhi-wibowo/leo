<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
 require_once "library/library.php";

            $id_pkp = $_GET['id_pkp'];
            $sql = mysqli_query($db_link, "SELECT * FROM tblpeserta_pkp WHERE id_pkp='$id_pkp'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=pkp_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
                $id_pkp        = $_POST['id_pkp'];
                $tgl            = $_POST['tgl'];
                
                $tgl      = ubah_tgl2($tgl);
                $update = mysqli_query($db_link, "UPDATE tblpeserta_pkp SET tgl='$tgl' WHERE id_pkp='$id_pkp'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=pkp_edit&id_pkp=".$id_pkp."&pesan=sukses");
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
        <h2><i class="fa fa-group"></i> Edit Data Konseling</h2><hr>
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="hidden" name="id_pkp" class="form-control" value="<?php echo $id_pkp?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tgl Konseling</label>
                    <div class="col-sm-2">
                        <input name="tgl" id="tgl" class="input-group date form-control" value="<?php echo indonesiaTgl($row ['tgl']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">  
                        <a href="?open=pkp_data" class="btn btn-sm btn-danger">Batal</a>                          
                    </div>
                </div>
            </form>
    </div><!-- /row -->
</div>