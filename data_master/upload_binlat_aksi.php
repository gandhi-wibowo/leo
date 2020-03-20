      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
require_once "library/library.php";
//require_once "library/excel_reader2.php";
require_once "library/koneksi.php";
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }
?>
<div class="container-fluid">
<div class="row">
			<h2><i class="fa fa-group"></i> Upload Data Binlat</h2><hr>
			<?php
require_once "library/vendor/autoload.php";
require_once "library/library.php";
//require_once "library/excel_reader2.php";
require_once "library/koneksi.php";
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
 
$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
 
    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    for($i = 1;$i < count($sheetData);$i++)
    {
        $id_binlat   = $sheetData[$i]['0'];
        $nama        = $sheetData[$i]['1'];
        $no_hp       = $sheetData[$i]['2'];
        $tgl         = $sheetData[$i]['3'];
        $pemkab      = $sheetData[$i]['4'];
        $pendidikan  = $sheetData[$i]['5'];
        $pretest     = $sheetData[$i]['6'];
        $posttest    = $sheetData[$i]['7'];
        $nilai       = $sheetData[$i]['8'];
                
        mysqli_query($db_link,"INSERT INTO tblpeserta_binlat (id_binlat,nama,no_hp,tgl,pemkab,pendidikan,pretest,posttest,nilai) VALUES ('$id_binlat','$nama','$no_hp','$tgl','$pemkab','$pendidikan','$pretest','$posttest','$nilai')");
    }
   header("Location: page.php?open=binlat_data"); 
}
?>
</div><!-- /row -->
</div>