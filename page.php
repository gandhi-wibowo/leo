<?php
ob_start();
session_start();
if(!isset($_SESSION['SES_LOGIN'])){
	header('location:home');
}
require_once "library/koneksi.php";
require_once "library/library.php";
opendb();
//carii data user
$_SESSION['SES_LOGIN'] ? $user_id = trim($_SESSION['SES_LOGIN']) : $user_id="";
$_SESSION['USER_LEVEL'] ? $levelAkses = trim($_SESSION['USER_LEVEL']) : $levelAkses="";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Sistem E - Konseling</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" href="datatables/dataTables.bootstrap.css"> 
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="js/plugins/select2/select2.min.css" rel="stylesheet">
    <script src="js/jquery-1.4.3.min.js"></script>
    <script src="js/notifikasi.js"></script>
    <style media="all">
    th{
      text-align: center;
      color: #000;}
    td{
      color: #000;
    }

  </style>

  </head>
  <body>
  <?php 
    switch($levelAkses){
      case "Admin":
        include"menu_all.php";
        break;
         case "Petugas":
        include"menu_petugas.php";
        break;
      default:
        include"menu_personil.php";
    }
  ?>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jQuery.js"></script>
    <script src="js/moment.js"></script>

    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="datatables/jquery.dataTables.js"></script>
    <script src="datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
      $(function () {
        $('#tgl').datetimepicker({
          format: 'DD-MM-YYYY',
        });
      });
      $(function () {
        $('#tgl2').datetimepicker({
          format: 'DD-MM-YYYY',
        });
      });
    </script>
    <script type="text/javascript">
    //tabel lookup
      $(function () {
                $("#lookup").dataTable();
            });

      $(function () {
      //Initialize Select2 Elements
        $(".select2").select2();    
      });            
    </script>
  </body>
</html>