
<?php
error_reporting(0);
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
    $id_hasil_amasalah = $_GET['id_hasil_amasalah']; 
 ?>
 <div class="container-fluid">
<div class="row">
			<form class="form-horizontal" action="" method="POST">
                    <div class="row">
                        <h2><i class="fa fa-book"></i> LAPORAN DATA KONSELING ANGGOTA BERMASALAH</h2><hr>
                        <tbody>
            <?php
            
                                $sql = "SELECT * FROM tblpersonil WHERE nrp IN (SELECT nrp FROM tblpeserta_amasalah WHERE id_amasalah IN (SELECT id_amasalah FROM hasil_amasalah WHERE id_hasil_amasalah = '$id_hasil_amasalah'))";
                                $query = mysqli_query($db_link, $sql);
                                $data = mysqli_fetch_array($query);
            ?>
            <p>
            <tr>
            <h3>
                <th style="background-color: #ffffaa">Nama : </th>
                    <td style="background-color: #ffffff" align="center"><?php echo $data['nama'];?></td></h3><h3>
                <th style="background-color: #ffffaa">NRP   : </th>
                    <td style="background-color: #ffffff" align="center"><?php echo $data['nrp'];?></td></h3><h3>
                <th style="background-color: #ffffaa">Satker   : </th>
                    <td style="background-color: #ffffff" align="center"><?php echo $data['satker'];?></td>
            </h3>
            </tr>
            </tbody>            
            <p>
                <a href="cetak/cetak_lap_hasil_binlat.php&id_hasil_amasalah=<?php echo $id_hasil_amasalah?>" name="test" title="Cetak Data" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
                        </div>
                    </div>
                        <div class="col-sm-12">
                        <div class="table-responsive"></div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                    <th style="background-color: #ffffff">No</th>
                                    <th style="background-color: #ffffff">Tempat</th>
                                    <th style="background-color: #ffffff">Identifikasi Masalah</th>
                                    <th style="background-color: #ffffff">Harapan</th>
                                    <th style="background-color: #ffffff">Penanganan</th>
                                    <th style="background-color: #ffffff">Dinamika Psi</th>
                                    <th style="background-color: #ffffff">Saran</th>
                                    <th style="background-color: #ffffff">Nama Konselor</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //$no_rm= isset($_GET['no_rm']) ?  $_GET['no_rm'] : '';
                                        $sql = "SELECT * FROM hasil_amasalah WHERE id_hasil_amasalah='$id_hasil_amasalah'";
                                        $query = mysqli_query($db_link, $sql);

                                        //pagination config start
                                        $rpp = 10; // jumlah record per halaman
                                        $reload = "?open=cetak_hasil_amasalah?pagination=true";
                                        $page = intval($_GET["page"]);
                                        if($page<=0) $page = 1;  
                                        $tcount = mysqli_num_rows($query);
                                        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
                                        $count = 0;
                                        $i = ($page-1)*$rpp;
                                        $no_urut = ($page-1)*$rpp;
                                        //pagination config end
                                        
                                        //$nomor = 0;
                                        while(($count<$rpp) && ($i<$tcount)) {
                                            mysqli_data_seek($query,$i);
                                            $data = mysqli_fetch_array($query);

                                        //while ($data = mysqli_fetch_array($query)){
                                        //    $nomor++;
                                    ?>
                                    <tr>
                                        <td style="background-color: #ffffff" align="center"><?php echo ++$no_urut;?> </td>
                                        <td style="background-color: #ffffff" align="center"><?php echo $data['tempat'];?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo nl2br(htmlspecialchars ($data['ident_masalah']));?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo nl2br(htmlspecialchars ($data['harapan']));?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo nl2br(htmlspecialchars ($data['penanganan']));?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo nl2br(htmlspecialchars ($data['dnmk_psi']));?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo nl2br(htmlspecialchars ($data['saran']));?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo nl2br(htmlspecialchars ($data['nama_konselor']));?></td>
                                    </tr>
                                <?php
                                    $i++; 
                                    $count++;
                                        }
                                ?>
                                </tbody>
                            </table><?php echo paginate_one($reload, $page, $tpages); ?>
                        </div>
                </form>
</div><!-- /row -->
</div>