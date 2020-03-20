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
            <a class="navbar-brand"><i class="fa fa-building"></i> Sistem E - Counseling</a>
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
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"></a>
                    <ul id="demo" class="collapse">
                            
                    </ul>
                </li>
                <li>
                    <a href="?open=kunjungan_data"><i class="fa fa-sign-in"></i> &nbsp;Daftar Konseling</a>
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