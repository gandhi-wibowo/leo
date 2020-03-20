<?php
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:home');
}
require_once ("library/koneksi.php");
?>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><i class="fa fa-building"></i> Sistem E - Konseling</a>
        </div>
            
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="?open=home"><i class="fa fa-bank"></i> Menu Utama</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-desktop"></i> Data Master<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="?open=user_data"><i class="fa fa-group"></i> Data User</a>
                        </li>
                        <li>
                            <a href="?open=personil_data"><i class="fa fa-group"></i> Data Personil</a>
                        </li>    
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-sign-in"></i> Daftar Konseling<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo1" class="collapse">
                        <li>
                             <a href="?open=pkp_data"><i class="fa fa-sign-in"></i> &nbsp;Konseling PSI Berkala</a>
                        </li>
                        <li>
                             <a href="?open=binlat_data"><i class="fa fa-sign-in"></i> &nbsp;Binlat PSI</a>
                        </li>
                        <li>
                             <a href="?open=amasalah_data"><i class="fa fa-sign-in"></i> &nbsp;Konseling Anggota Bermasalah </a>
                        </li>    
                    </ul>
                   
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-book"></i> &nbsp;Laporan<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo2" class="collapse">
                        <li>
                            <a href="?open=laporan_pkp"><i class="fa fa-line-chart"></i> Data Peserta Konseling PKP</a>
                        </li>
                        <li>
                            <a href="?open=laporan_pkp"><i class="fa fa-line-chart"></i> Data Peserta Konseling Anggota Bermasalah</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav><!-- /.navbar-collapse -->
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <?php 
          		include"page_control.php";
        	?>  
        </div><!--/.container-fluid-->
    </div><!--/.page-wrapper-->
    
</div><!--/.wrapper-->