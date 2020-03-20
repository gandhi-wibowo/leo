<?php
if(session_status()!==2)session_start();//>=php 5.4
if(!isset($_SESSION['SES_LOGIN'])){
    header('location:../home');
 }   
?>
<div class="container-fluid">
<div class="row">
            <h2><i class="fa fa-comments"></i> Chat</h2><hr>
            <div class="tabel-responsive"></div>
                <table id="lookup" class="table table-bordered">
                    <thead>
                            <tr>
                                <th style="background-color: #ffffff">No</th>
                                <th style="background-color: #ffffff">Nama Lengkap</th>
                                <th style="background-color: #ffffff">Username</th>
                                <th style="background-color: #ffffff">No HP</th>
                                <th style="background-color: #ffffff">Pilihan</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = 'SELECT * FROM tbluser order by kd_user ASC';
                                $query = mysqli_query($db_link, $sql);
                                $nomor = 0;
                                while ($data = mysqli_fetch_array($query)) {
                                    $nomor++;
                                    if($data['aktif']=="Y"){
                                        $klsBaris="";
                                        $stat="<span class='label label-info'>Active</span>";
                                    }else{
                                        $klsBaris="danger";
                                        $stat="<span class='label label-danger'>Non Active</span>";
                                    }
                            ?>  
                                <tr>
                                    <td style="background-color: #ffffff"><center><?php echo $nomor; ?></center></td>
                                    <td style="background-color: #ffffff"><?php echo $data['nm_lengkap'];?></a></td>
                                    <td style="background-color: #ffffff"><?php echo $data['nm_user']; ?></td>
                                    <td style="background-color: #ffffff"><?php echo $data['no_hp']; ?></td>
                                    <td style="background-color: #ffffff" align="center">
                                        <a href="?open=chat2&kd_user=<?php echo $data['kd_user'];?>" title="Chat" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>
                                        <a href="?open=sms&kd_user=<?php echo $data['kd_user'];?>" title="SMS" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>                        
                </table>
</div><!-- /row -->
</div>