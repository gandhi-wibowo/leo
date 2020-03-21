<?php
require('./fpdf182/fpdf.php');
require_once ("../library/koneksi.php");
require_once ("../library/library.php");

class PDF extends FPDF{

	function initData($db,$id = ''){
		$ret = array();
		$sql = "
			SELECT
			knds_klinis AS 'kondisi klinis',
			depresi,
			rs_bersalah AS 'rasa bersalah',
			bnh_diri AS 'bunuh diri',
			insomnia,
			apatis,
			kelambanan,
			kegelisahan,
			kcms_psikis AS 'kecemasan psikis',
			kcms_somatik AS 'kecemasan somatik',
			ggn_pencernaan AS 'gangguan pencernaan',
			smtk_umum AS 'somatik umum',
			ggn_prlk_seksual AS 'gangguan prilaku seksual',
			hpkndriaris AS 'hipokondriaris',
			khl_dy_tubuh AS 'kehilangan daya tubuh',
			khl_brt_badan AS 'kehilangan berat badan',
			tgkt_kejenuhan AS 'tingkat kejenuhan',
			klhn_emosi AS 'kelelahan emosi',
			pncp_diri AS 'pencapaian diri',
			depersonalisasi,
			tgkt_stress AS 'tingkat stress',
			rekomendasi
			FROM hasil_pkp HPKP
			LEFT JOIN tblpeserta_pkp PPKP ON HPKP.id_pkp = PPKP.id_pkp
			WHERE PPKP.id_pkp='{$id}';
		";
		$query = mysqli_query($db, $sql);
		while ($data = mysqli_fetch_assoc($query)) {
			$ret = $data;
		}
		return $ret;
	}

	function FancyTable($header, $data){
	    // Colors, line width and bold font
	    $this->SetFillColor(166,166,166);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(0,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    // Header
	    $w = array(10, 90, 90);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $this->Ln();
	    // Color and font restoration
	    // Data
	    $fill = false;
	    $no = 1;
	    foreach($data as $key => $value){
		    if ($key == "kondisi klinis" || $key == "tingkat kejenuhan" || $key == "tingkat stress") {
		      if ($key == "kondisi klinis") {
		        $key = "A. ".$key;
		      }
		      if ($key == "tingkat kejenuhan") {
		        $key = "B. ".$key;
		      }
		      if ($key == "tingkat stress") {
		        $key = "C. ".$key;
		      }
			    $this->SetFillColor(255,255,0);
			    $this->SetTextColor(0);
			    $this->SetFont('');
		        $this->Cell(($w[0]+$w[1]),8,$key,'LR',0,'L',true);
		        $this->Cell($w[2],8,$value,'LR',0,'L',true);
		        $this->Ln();		      
		    }
		    else{
			    $this->SetFillColor(224,235,255);
			    $this->SetTextColor(0);
			    $this->SetFont('');		    	
		        $this->Cell($w[0],6,$no++,'LR',0,'L',$fill);
		        $this->Cell($w[1],6,$key,'LR',0,'L',$fill);
		        $this->Cell($w[2],6,$value,'LR',0,'L',$fill);
		        $this->Ln();		    	
		    }

	        $fill = !$fill;
	    }
	    $this->Cell(array_sum($w),0,'','T');
	}
	function Header(){
//	    $this->Image('logo.png',10,6,30);
	    $this->SetFont('Arial','B',14);
	    $this->Cell(190,7,'SISTEM E - KONSELING',0,1,'C');
	    $this->SetFont('Arial','B',12);
	    $this->Cell(190,4,'LAPORAN HASIL KONSELING ANGGOTA BERMASALAH',0,1,'C');
	    $this->SetFillColor(0,0,0);
	    $this->Ln();
		$this->Cell(0,1,"",0,1,'L',true);
	    $this->Ln(5);
	}
	function subHeader($nama = "",$nrp ="",$jabatan=""){
	    $this->SetFont('Arial','',11);
	    $this->Cell(30,4,'Nama personil',0,0,'L'); $this->Cell(1,4,':',0,0,'L'); $this->Cell(1,4," ".$nama,0,0,'L');
	    $this->Ln(5);
	    $this->Cell(30,4,'Nrp',0,0,'L'); $this->Cell(1,4,':',0,0,'L'); $this->Cell(1,4," ".$nrp,0,0,'L');
	    $this->Ln(5);
	    $this->Cell(30,4,'Jabatan',0,0,'L'); $this->Cell(1,4,':',0,0,'L'); $this->Cell(1,4," ".$jabatan,0,0,'L');
	    $this->Ln(10);
	}
	function setSubHeader($db,$id_pkp){
		$sql = "SELECT P.* FROM tblpeserta_pkp PPKP LEFT JOIN tblpersonil P ON PPKP.nrp = P.nrp WHERE PPKP.id_pkp = '{$id_pkp}'";
		$query = mysqli_query($db, $sql);
		while ($data = mysqli_fetch_assoc($query)) {
			$this->subHeader($data['nama'],$data['nrp'],$data['jabatan']);
		}
	}
}
$id_pkp = @$_GET['id_pkp'];
if ($id_pkp != "") {
	$pdf = new PDF();
	$header = array('No', 'Skala Psikologi', 'Indikasi / Kategori');
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	$pdf->setSubHeader($db_link,$id_pkp);
	$data = $pdf->initData($db_link,$id_pkp);
	$pdf->FancyTable($header,$data);
	$pdf->Output();
}

?>