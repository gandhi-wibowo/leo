<?php
require('./fpdf182/fpdf.php');
require_once ("../library/koneksi.php");
require_once ("../library/library.php");

class PDF extends FPDF{

    function initData($db,$sql){
        $ret = array();
        $query = mysqli_query($db, $sql);
        while ($data = mysqli_fetch_assoc($query)) {
            array_push($ret, $data);
        }
        return $ret;
    }

    function FancyTable($header, $data){
        // Colors, line width and bold font
        $this->SetFillColor(166,166,166);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B',12);
        // Header
        $w = array(8, 40, 25, 30, 35, 25, 50, 50, 10);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        // Data
        $fill = false;
        $no = 1;
        foreach($data as $key => $value){
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('','',8);             
            $this->Cell($w[0],6,$no++,'LR',0,'C',$fill);
            $this->Cell($w[1],6,$value['nama'],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$value['no_hp'],'LR',0,'L',$fill);
            $this->Cell($w[3],6,indonesiaTgl($value['tgl']),'LR',0,'L',$fill);
            $this->Cell($w[4],6,$value['pemkab'],'LR',0,'L',$fill);
            $this->Cell($w[5],6,$value['pendidikan'],'LR',0,'L',$fill);
            $this->Cell($w[6],6,$value['pretest'],'LR',0,'L',$fill);
            $this->Cell($w[7],6,$value['posttest'],'LR',0,'L',$fill);
            $this->Cell($w[8],6,$value['nilai'],'LR',0,'C',$fill);
            $this->Ln();  
            $fill = !$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }
    function Header(){
        $this->SetFont('Arial','B',14);
        $this->Cell(260,7,'SISTEM E - KONSELING',0,1,'C');
        $this->SetFont('Arial','B',12);
        $this->Cell(260,4,'LAPORAN DATA PESERTA BINLAT SISWA',0,1,'C');
        $this->SetFillColor(0,0,0);
        $this->Ln();
        $this->Cell(0,1,"",0,1,'L',true);
        $this->Ln(5);
    }

}
$tAwal = @$_GET['awal'];
$tAkhir = @$_GET['akhir'];
$cari   = @$_GET['cari'];
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$limit = 10;
$limit_start = ($page - 1) * $limit;
$no = $limit_start + 1;

$withDate = false;
$optQuery = "";
if ($tAwal != "" && $tAkhir != "") {
    $withDate = true;
    $optQuery.= "WHERE DATE(tgl) >= DATE('{$tAwal}') AND DATE(tgl) <= DATE('{$tAkhir}') ";
}
if ($withDate) {
    if ($cari != "") {
        $optQuery.= " AND nama LIKE '%{$cari}%' OR no_hp LIKE '%{$cari}%' OR pemkab LIKE '%{$cari}%' OR pendidikan LIKE '%{$cari}%' OR pretest LIKE '%{$cari}%' OR posttest LIKE '%{$cari}%' OR nilai LIKE '%{$cari}%' ";
    }
}
else{
    if($cari != ""){
        $optQuery.= " WHERE nama LIKE '%{$cari}%' OR no_hp LIKE '%{$cari}%' OR pemkab LIKE '%{$cari}%' OR pendidikan LIKE '%{$cari}%' OR pretest LIKE '%{$cari}%' OR posttest LIKE '%{$cari}%' OR nilai LIKE '%{$cari}%' ";
    }
}
$fullQuery = "SELECT nama,no_hp,tgl,pemkab,pendidikan,pretest,posttest,nilai FROM tblpeserta_binlat {$optQuery} ";
$pdf = new PDF('L','mm','A4');
$header = array('No', 'Nama', 'Hp', 'Tgl Konseling', 'Pemkab', 'Pendidikan', 'Pre test', 'Post Test', 'Nilai');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$data = $pdf->initData($db_link,$fullQuery);
$pdf->FancyTable($header,$data);
$pdf->Output();

?>