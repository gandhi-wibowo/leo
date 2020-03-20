
<?php
error_reporting(0);
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }
require_once "library/pagination.php";
# Deklarasi variabel
    $filterPeriode = ""; 
    $tgl1    = ""; 
    $tgl2   = "";

    # Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
    $tgl1    = isset($_POST['tgl1']) ? $_POST['tgl1'] : "01-".date('m-Y');
    $tgl2    = isset($_POST['tgl2']) ? $_POST['tgl2'] : date('d-m-Y');

    // Jika tombol filter tanggal (Tampilkan) diklik
    if (isset($_POST['tampil'])) {
        // Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
        $filterPeriode = "WHERE ( tgl BETWEEN '".ubah_tgl2($tgl1)."' AND '".ubah_tgl2($tgl2)."')";
    }
    else {
    // Membaca data tanggal dari URL, saat menu Pages diklik
        $tgl      = isset($_GET['tgl1']) ? $_GET['tgl1'] : $tgl1;
        $tgl2           = isset($_GET['tgl2']) ? $_GET['tgl2'] : $tgl2; 
    
        // Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
        $filterPeriode = "WHERE ( tgl BETWEEN '".ubah_tgl2($tgl1)."' AND '".ubah_tgl2($tgl2)."')";
    }
 ?>
 <div class="container-fluid">
<div class="row">
			<form class="form-horizontal" action="" method="POST">
                    <div class="row">
                        <h2><i class="fa fa-book"></i> LAPORAN DATA PESERTA KONSELING</h2><hr>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Tgl Awal</label>
                            <div class="col-sm-2">
                                <input name="tgl1" id="tgl" class="input-group date form-control" value="<?php echo $tgl1; ?>" placeholder="Tgl Awal" required>
                            </div><label class="col-sm-1 control-label">Tgl Akhir</label>
                            <div class="col-sm-2">
                                <input name="tgl2" id="tgl2" class="input-group date form-control" value="<?php echo $tgl2; ?>" placeholder="Tgl Akhir" required>
                            </div>
                        <button type="submit" name="tampil" class="btn btn-success"><span></span> Tampilkan</button>
                            <a href="cetak/cetak_lapkunjungan.php?tgl1=<?php echo $_POST['tgl1'];?>&&tgl2=<?php echo $_POST['tgl2'];?>" name="test" title="Cetak Data" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
                        </div>
                    </div>
                        <div class="col-sm-12">
                        <div class="table-responsive"></div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="background-color: #ffffff">No</th>
                                        <th style="background-color: #ffffff">NRP</th>
                                        <th style="background-color: #ffffff">Nama</th>
                                        <th style="background-color: #ffffff">Jabatan</th>
                                        <th style="background-color: #ffffff">Pangkat</th>
                                        <th style="background-color: #ffffff">Tgl Konseling</th>
                                        <th style="background-color: #ffffff">Rekomendasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //$no_rm= isset($_GET['no_rm']) ?  $_GET['no_rm'] : '';
                                        $sql = "SELECT * FROM tblpeserta $filterPeriode";
                                        $query = mysqli_query($db_link, $sql);

                                        //pagination config start
                                        $rpp = 10; // jumlah record per halaman
                                        $reload = "?open=laporan_kunjungan?pagination=true";
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
                                        <td style="background-color: #ffffff" align="center"><?php echo $data['nrp'];?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo $data['nama'];?></td>
                                        <td style="background-color: #ffffff"><?php echo $data['jabatan'];?></a></td>
                                        <td style="background-color: #ffffff"><?php echo $data['pangkat']; ?></td>
                                        <td style="background-color: #ffffff" align="center"><?php echo tgl_indo2($data['tgl']); ?></td>
                                        <td style="background-color: #ffffff"><?php echo $data['rekomendasi']; ?></td>
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