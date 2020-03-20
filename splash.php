<?php
@session_start();
 if(!isset($_SESSION['SES_LOGIN'])){
	header('location:home');
 }
?>	
	<div class="container-fluid">
		<h2>Selamat Datang di SISTEM E - Konseling</h2>
    </div>
                <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-md fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class="huge">
                                        <?php 
                                            require_once ("library/koneksi.php");
                                            $result = mysqli_query($db_link, "SELECT * FROM tblpersonil");
                                            echo "".mysqli_num_rows($result)."";
                                        ?>
                                        </div>
                                            <div>Total Personil POLRI</div>
                                    </div>
                                </div>
                            </div>
                            <a href="?open=personil_data">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
    

                <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-md fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class="huge">
                                        <?php 
                                            require_once ("library/koneksi.php");
                                            $result = mysqli_query($db_link, "SELECT * FROM tblpeserta_pkp");
                                            echo "".mysqli_num_rows($result)."";
                                        ?>
                                        </div>
                                        <div>Total Peserta Konseling Berkala</div>
                                    </div>
                                </div>
                            </div>
                            <a href="?open=pkp_data">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                     <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-md fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class="huge">
                                        <?php 
                                            require_once ("library/koneksi.php");
                                            $result1 = mysqli_query($db_link, "SELECT * FROM tblpeserta_binlat");
                                            echo "".mysqli_num_rows($result1)."";
                                        ?>
                                        </div>
                                        <div>Total Peserta BINLAT</div>
                                    </div>
                                </div>
                            </div>
                            <a href="?open=binlat_data">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-md fa-5x"></i>
                                    </div>
                                    <div class="col-xs-7 text-right">
                                        <div class="huge">
                                        <?php 
                                            require_once ("library/koneksi.php");
                                            $result2 = mysqli_query($db_link, "SELECT * FROM tblpeserta_amasalah");
                                            echo "".mysqli_num_rows($result2)."";
                                        ?>
                                        </div>
                                        <div>Total Peserta Konseling Anggota Bermasalah</div>
                                    </div>
                                </div>
                            </div>
                            <a href="?open=amasalah_data">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
    </div>
