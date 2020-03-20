<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
 require_once "library/library.php";

            $id_pkp = $_GET['id_pkp'];
            $tgl    = $_GET['tgl'];
            
            $id_konseling_lnjt = $_GET['id_konseling_lnjt'];
            $sql = mysqli_query($db_link, "SELECT * FROM konseling_lnjt WHERE id_konseling_lnjt='$id_konseling_lnjt'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=konseling_lnjt_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
        $id_konseling_lnjt       = $_POST['id_konseling_lnjt'];
        $saran        = $_POST['saran'];
                $update = mysqli_query($db_link, "UPDATE konseling_lnjt SET saran='$saran' WHERE id_konseling_lnjt='$id_konseling_lnjt'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=pkp_data");
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
        <h2><i class="fa fa-group"></i> Edit Hasil Konseling</h2><hr>
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="hidden" name="id_konseling_lnjt" class="form-control" value="<?php echo $id_konseling_lnjt?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-2 control-label">Saran</label>
                            <div class="col-sm-10">
                                <input type="text"  name="saran" class="form-control" value="<?php echo $row ['saran']; ?>" required> </textarea>
                            </div>
                        </div>
                        

                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">  
                        <a href="?open=konseling_tambahan_pkp_data&id_pkp=<?php echo $id_pkp;?>&tgl=<?php echo $tgl;?>" class="btn btn-sm btn-danger">Batal</a>                          
                    </div>
                </div>
            </form>
    </div><!-- /row -->
</div>