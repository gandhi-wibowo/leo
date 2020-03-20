<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
 require_once "library/library.php";

            $id_amasalah = $_GET['id_amasalah'];
            
            $id_hasil_amasalah = $_GET['id_hasil_amasalah'];
            $sql = mysqli_query($db_link, "SELECT * FROM hasil_amasalah WHERE id_hasil_amasalah='$id_hasil_amasalah'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=hasil_amasalah_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
        $id_hasil_amasalah      = $_POST['id_hasil_amasalah'];
        $tempat                 = $_POST['tempat'];
        $ident_masalah          = $_POST['ident_masalah'];
        $harapan                = $_POST['harapan'];
        $penanganan             = $_POST['penanganan'];
        $dnmk_psi               = $_POST['dnmk_psi'];
        $saran                  = $_POST['saran'];
        $id_amasalah            = $_POST['id_amasalah'];
                $update = mysqli_query($db_link, "UPDATE hasil_amasalah SET tempat='$tempat', ident_masalah='$ident_masalah', harapan='$harapan', penanganan='$penanganan', dnmk_psi='$dnmk_psi', saran='$saran' WHERE id_hasil_amasalah='$id_hasil_amasalah'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=hasil_amasalah_data&id_amasalah=".$id_amasalah."");
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
        <h2><i class="fa fa-group"></i> Edit Hasil Konseling Anggota Bermasalah</h2><hr>
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="hidden" name="id_hasil_amasalah" class="form-control" value="<?php echo $id_hasil_amasalah?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tempat</label>
                    <div class="col-sm-10">
                        <input type="text" name="tempat" class="form-control" value="<?php echo $row['tempat'];?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Identifikasi Masalah</label>
                    <div class="col-sm-10">
                        <textarea rows="6" name="ident_masalah" class="form-control" ><?php echo $row['ident_masalah'] ;?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Harapan</label>
                    <div class="col-sm-10">
                        <textarea rows="6" name="harapan" class="form-control" ><?php echo $row['harapan'] ;?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Penanganan</label>
                    <div class="col-sm-10">
                        <textarea rows="6" name="penanganan" class="form-control" ><?php echo $row['penanganan'] ;?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Dinamika PSI</label>
                    <div class="col-sm-10">
                        <textarea rows="6" name="dnmk_psi" class="form-control" ><?php echo $row['dnmk_psi'] ;?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Saran</label>
                    <div class="col-sm-10">
                        <textarea rows="6" name="saran" class="form-control" ><?php echo $row['saran'];?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <input type="hidden" name="id_amasalah" class="form-control" value="<?php echo $id_amasalah?>" readonly>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">  
                        <a href="?open=hasil_amasalah_data&id_amasalah=<?php echo $id_amasalah;?>" class="btn btn-sm btn-danger">Batal</a>                          
                    </div>
                </div>
            </form>
    </div><!-- /row -->
</div>