<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
 require_once "library/library.php";

            $id_pkp = $_GET['id_pkp'];
            
            $id_hasil_pkp = $_GET['id_hasil_pkp'];
            $sql = mysqli_query($db_link, "SELECT * FROM hasil_pkp WHERE id_hasil_pkp='$id_hasil_pkp'");
            if(mysqli_num_rows($sql) == 0){
                header("Location: ?open=hasil_pkp_edit");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){
                $id_hasil_pkp       = $_POST['id_hasil_pkp'];
        $knds_klinis        = $_POST['knds_klinis'];
        $depresi            = $_POST['depresi'];
        $rs_bersalah        = $_POST['rs_bersalah'];
        $bnh_diri           = $_POST['bnh_diri'];
        $insomnia           = $_POST['insomnia'];
        $apatis             = $_POST['apatis'];
        $kelambanan         = $_POST['kelambanan'];
        $kegelisahan        = $_POST['kegelisahan'];
        $kcms_psikis        = $_POST['kcms_psikis'];
        $kcms_somatik       = $_POST['kcms_somatik'];
        $ggn_pencernaan     = $_POST['ggn_pencernaan'];
        $smtk_umum          = $_POST['smtk_umum'];
        $ggn_prlk_seksual   = $_POST['ggn_prlk_seksual'];
        $hpkndriaris        = $_POST['hpkndriaris'];
        $khl_dy_tubuh       = $_POST['khl_dy_tubuh'];
        $khl_brt_badan      = $_POST['khl_brt_badan'];
        $tgkt_kejenuhan     = $_POST['tgkt_kejenuhan'];
        $klhn_emosi         = $_POST['klhn_emosi'];
        $pncp_diri          = $_POST['pncp_diri'];
        $depersonalisasi    = $_POST['depersonalisasi'];
        $tgkt_stress        = $_POST['tgkt_stress'];
        $rekomendasi        = $_POST['rekomendasi'];
                $update = mysqli_query($db_link, "UPDATE hasil_pkp SET knds_klinis='$knds_klinis', depresi='$depresi', rs_bersalah='$rs_bersalah', bnh_diri='$bnh_diri', insomnia='$insomnia', apatis='$apatis', kelambanan='$kelambanan', kegelisahan='$kegelisahan', kcms_psikis='$kcms_psikis', kcms_somatik='$kcms_somatik', ggn_pencernaan='$ggn_pencernaan', smtk_umum='$smtk_umum', ggn_prlk_seksual='$ggn_prlk_seksual', hpkndriaris='$hpkndriaris', khl_dy_tubuh='$khl_dy_tubuh', khl_brt_badan='$khl_brt_badan', tgkt_kejenuhan='$tgkt_kejenuhan', klhn_emosi='$klhn_emosi', pncp_diri='$pncp_diri', depersonalisasi='$depersonalisasi', tgkt_stress='$tgkt_stress', rekomendasi='$rekomendasi' WHERE id_hasil_pkp='$id_hasil_pkp'") or die(mysqli_error());
                if($update){
                    header("Location: ?open=hasil_pkp_data&id_pkp=".$id_pkp."");
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
        <h2><i class="fa fa-group"></i> Edit Hasil PKP</h2><hr>
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="hidden" name="id_hasil_pkp" class="form-control" value="<?php echo $id_hasil_pkp?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kondisi Klinis</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="knds_klinis">
                        <?php 
                            if($row['knds_klinis']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['knds_klinis']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['knds_klinis']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}
                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Depresi</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="depresi">
                        <?php 
                            if($row['depresi']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['depresi']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['depresi']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}
                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Rasa Bersalah</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="rs_bersalah">
                        <?php 
                            if($row['rs_bersalah']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['rs_bersalah']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['rs_bersalah']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Bunuh Diri</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="bnh_diri">
                        <?php 
                            if($row['bnh_diri']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['bnh_diri']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['bnh_diri']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Insomnia</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="insomnia">
                        <?php 
                            if($row['insomnia']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['insomnia']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['insomnia']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Apatis</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="apatis">
                        <?php 
                            if($row['apatis']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['apatis']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['apatis']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kelambanan</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="kelambanan">
                        <?php 
                            if($row['kelambanan']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['kelambanan']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['kelambanan']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kegelisahan</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="kegelisahan">
                        <?php 
                            if($row['kegelisahan']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['kegelisahan']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['kegelisahan']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kecemas Psikis</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="kcms_psikis">
                        <?php 
                            if($row['kcms_psikis']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['kcms_psikis']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['kcms_psikis']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kecemas Somatik</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="kcms_somatik">
                        <?php 
                            if($row['kcms_somatik']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['kcms_somatik']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['kcms_somatik']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Gangguan Pencernaan</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="ggn_pencernaan">
                        <?php 
                            if($row['ggn_pencernaan']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['ggn_pencernaan']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['ggn_pencernaan']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Somatik Umum</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="smtk_umum">
                        <?php 
                            if($row['smtk_umum']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['smtk_umum']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['smtk_umum']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Gangguan Prilaku Seksual</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="ggn_prlk_seksual">
                        <?php 
                            if($row['ggn_prlk_seksual']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['ggn_prlk_seksual']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['ggn_prlk_seksual']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Hipokondriaris</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="hpkndriaris">
                        <?php 
                            if($row['hpkndriaris']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['hpkndriaris']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['hpkndriaris']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
               </div>

               <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kehilangan Daya Tubuh</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="khl_dy_tubuh">
                        <?php 
                            if($row['khl_dy_tubuh']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['khl_dy_tubuh']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['khl_dy_tubuh']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kehilangan Berat Badan</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="khl_brt_badan">
                        <?php 
                            if($row['khl_brt_badan']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['khl_brt_badan']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['khl_brt_badan']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Tingkat Kejenuhan</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="tgkt_kejenuhan">
                        <?php 
                            if($row['tgkt_kejenuhan']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['tgkt_kejenuhan']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['tgkt_kejenuhan']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Kelelahan Emosi</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="klhn_emosi">
                        <?php 
                            if($row['klhn_emosi']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['klhn_emosi']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['klhn_emosi']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Pencapaian Diri</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="pncp_diri">
                        <?php 
                            if($row['pncp_diri']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['pncp_diri']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['pncp_diri']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Depersonalisasi</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="depersonalisasi">
                        <?php 
                            if($row['depersonalisasi']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['depersonalisasi']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['depersonalisasi']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Tingkat Stress</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="tgkt_stress">
                        <?php 
                            if($row['tgkt_stress']=="Rendah")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['tgkt_stress']=="Sedang")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['tgkt_stress']=="Tinggi")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                                         <option value="Rendah" <?php echo $plh1?>>Rendah</option>
                                         <option value="Sedang" <?php echo $plh2?>>Sedang</option>
                                         <option value="Tinggi" <?php echo $plh3?>>Tinggi</option>
                    </select>
                    </div>
                
                <div class="form-group">
                    <div class="col-sm-3 control-label"><font size="4">Rekomendasi</label></div>
                    <div class="col-sm-2">
                    <select class="form-control" name="rekomendasi">
                        <?php 
                            if($row['rekomendasi']=="Wajib Konseling")
                                    { $plh1='selected';$plh2='';$plh3=''; }
                            else if($row['rekomendasi']=="Disarankan Konseling")
                                    { $plh1='';$plh2='selected';$plh3=''; }
                            else if ($row['rekomendasi']=="Pertahankan Kondisi Psikologis Anda")
                                { $plh1='';$plh2='';$plh3='selected';}
                            else
                                { $plh1='';$plh2='';$plh3='';}                            
                            ?>
                                         <option value="">---Pilih---</option>  
                         <option value="Wajib Konseling" <?php echo $plh1?>>Wajib Konseling</option>
                         <option value="Disarankan Konseling" <?php echo $plh2?>>Disarankan Konseling</option>
                         <option value="Pertahankan Kondisi Psikologis Anda" <?php echo $plh3?>>Pertahankan Kondisi Psikologis Anda</option>
                    </select>
                    </div>
                </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-2">
                        <input type="hidden" name="id_pkp" class="form-control" value="<?php echo $id_pkp?>" readonly>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-warning" value="Edit">  
                        <a href="?open=hasil_pkp_data&id_pkp=<?php echo $id_pkp;?>" class="btn btn-sm btn-danger">Batal</a>                          
                    </div>
                </div>
            </form>
    </div><!-- /row -->
</div>