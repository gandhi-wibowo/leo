    <?php  
    error_reporting(0);
    /**
     * @author Achmad Solichin
     * @website http://achmatim.net
     * @email achmatim@gmail.com
     */
    require_once ("../library/koneksi.php");
    require_once ("../library/library.php");
    require_once ("fpdf17/fpdf.php");
     
    class FPDF_AutoWrapTable extends FPDF {
        private $data = array();
        private $options = array(
            'filename' => '',
            'destinationfile' => '',
            'paper_size'=>'A4',
            'orientation'=>'L'
        );
     
        function __construct($data = array(), $options = array()) {
            parent::__construct();
            $this->data = $data;
            $this->options = $options;
        }
     
        public function rptDetailData () {
            //
            $border = 0;
            $this->AddPage();
            $this->SetAutoPageBreak(true,60);
            $this->AliasNbPages();
            $left = 25;
     
            //header
            $this->Ln(40);//enter baris
            $this->SetFont("Arial", "B", 18);
            $this->SetX($left); $this->Cell(0, 25, 'SISTEM E - KONSELING', 0, 1,'C');
            $this->SetFont("Arial", "B", 12);
            $this->SetX($left); $this->Cell(0, 15, 'LAPORAN DATA PESERTA BINLAT SISWA', 0, 1,'C');
            $this->Cell(730, 15, 'Periode :', 0,0,'C');
            $this->SetX($left +=30); $this->Cell(800, 15, ($tgl1=$_GET['tgl1']), 0,0,'C');
            $this->SetX($left +=30); $this->Cell(815, 15, '-', 0,0,'C');
            $this->SetX($left +=30); $this->Cell(830, 15, ($tgl2=$_GET['tgl2']), 0,1,'C');
            $this->Cell(1530, 15, 'Tgl Cetak :', 0,0,'C');
            $this->SetX($left +=30); $this->Cell(1430, 15, (date('d-m-Y')), 0,1,'C');
            $this->Ln(5);
            $this->Cell(0, 1, " ", "B");//garis
            $this->Ln(5);

            $this->SetFont("Arial", "B", 11);//font header table
            $this->Ln(10);
            $h = 20;
            $left = 40;
            $top = 80;  
            #tableheader
            $this->SetFillColor(110,180,230);   
            $left = $this->GetX();
            $this->Cell(30,$h,'NO',1,0,'C',true);
            $this->SetX($left += 30); $this->Cell(170, $h, 'Nama', 1, 0, 'C',true);
            $this->SetX($left += 170); $this->Cell(80, $h, 'No HP', 1, 0, 'C',true);
            $this->SetX($left += 80); $this->Cell(110, $h, 'Tanggal Konseling', 1, 0, 'C',true);
            $this->SetX($left += 110); $this->Cell(100, $h, 'Pemkab', 1, 0, 'C',true);
            $this->SetX($left += 100); $this->Cell(180, $h, 'Pendidikan', 1, 0, 'C',true);
            $this->SetX($left += 180); $this->Cell(80, $h, 'Pre test', 1, 0, 'C',true);
            $this->SetX($left += 80); $this->Cell(80, $h, 'Post Test', 1, 0, 'C',true);
            $this->SetX($left += 80); $this->Cell(30, $h, 'Nilai', 1, 1, 'C',true);
            //$this->Ln(20);
     
            $this->SetFont('Arial','',10);
            $this->SetWidths(array(30,170,80,110,100,180,80,80,30));
            $this->SetAligns(array('C','C','C','C','C','C','C','C'));
            $no = 1; $this->SetFillColor(255);
            foreach ($this->data as $baris) {
                $this->Row(
                    array($no++, 
                    $baris['nama'], 
                    $baris['no_hp'], 
                    indonesiaTgl($baris['tgl']),
                    $baris['pemkab'], 
                    $baris['pendidikan'],
                    $baris['pretest'],
                    $baris['posttest'], 
                    $baris['nilai'], 
                    
                    ));
            }
     
        }
     
        public function printPDF () {
     
            if ($this->options['paper_size'] == "A4") {
                $a = 8.3 * 72; //1 inch = 72 pt
                $b = 12.8 * 72;
                $this->FPDF($this->options['orientation'], "pt", array($a,$b));
            } else {
                $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
            }
     
            $this->SetAutoPageBreak(false);
            $this->AliasNbPages();
            $this->SetFont("helvetica", "B", 10);
            //$this->AddPage();
     
            $this->rptDetailData();
     
            $this->Output($this->options['filename'],$this->options['destinationfile']);
        }
     
        private $widths;
        private $aligns;
     
        function SetWidths($w)
        {
            //Set the array of column widths
            $this->widths=$w;
        }
     
        function SetAligns($a)
        {
            //Set the array of column alignments
            $this->aligns=$a;
        }
     
        function Row($data)
        {
            //Calculate the height of the row
            $nb=0;
            for($i=0;$i<count($data);$i++)
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            $h=17*$nb;
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++)
            {
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                //Draw the border
                $this->Rect($x,$y,$w,$h);
                //Print the text
                $this->MultiCell($w,17,$data[$i],0,$a);
                //Put the position to the right of the cell
                $this->SetXY($x+$w,$y);
            }
            //Go to the next line
            $this->Ln($h);
        }
     
        function CheckPageBreak($h)
        {
            //If the height h would cause an overflow, add a new page immediately
            if($this->GetY()+$h>$this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }
     
        function NbLines($w,$txt)
        {
            //Computes the number of lines a MultiCell of width w will take
            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb)
            {
                $c=$s[$i];
                if($c=="\n")
                {
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax)
                {
                    if($sep==-1)
                    {
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }
    } //end of class
    //if($_GET){
    $tgl1=$_GET['tgl1'];
    $tgl2=$_GET['tgl2'];
    $pemkab=$_GET['pemkab']; 

    $data = array();
    $query = "SELECT * FROM tblpeserta_binlat WHERE pemkab='$pemkab' AND ( tgl BETWEEN '".ubah_tgl2($tgl1)."' AND '".ubah_tgl2($tgl2)."')";
    $sql = mysqli_query ($db_link, $query);
    while ($row = mysqli_fetch_assoc($sql)) {
        array_push($data, $row);
    }
     
    //pilihan
    $options = array(
        'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
        'destinationfile' => '', //I=inline browser (default), F=local file, D=download
        'paper_size'=>'A4', //paper size: F4, A3, A4, A5, Letter, Legal
        'orientation'=>'L' //orientation: P=portrait, L=landscape
    );
     
    $tabel = new FPDF_AutoWrapTable($data, $options);
    $tabel->printPDF();
    ?>

