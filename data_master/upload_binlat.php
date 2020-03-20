      <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
<?php
require_once "library/library.php";
require_once "library/koneksi.php";
require_once "library/excel_reader2.php";


if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:../home');
 }

?>
<div class="container-fluid">
<div class="row">
			<h2><i class="fa fa-group"></i> Upload Data Binlat</h2><hr>
			<form method="post" enctype="multipart/form-data" action="?open=upload_binlat_aksi">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
</div><!-- /row -->
</div>