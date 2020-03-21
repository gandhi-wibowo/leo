<?php
#tanggal komputer
date_default_timezone_set("Asia/Jakarta");
function createTr($data){
  $ret = "";
  $no = 0;
  foreach ($data as $key => $value) {
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

      $ret.= "
      <tr>
      <td style='background-color: #ffffaa' colspan='2'>{$key}</td>
      <td style='background-color: #ffffaa' align='center'>{$value}</td>
      </tr>
      ";
    }
    else{
      $ret.= "
      <tr>
      <td style='background-color: #ffffff' align='center'>".$no++."</td>
      <td style='background-color: #ffffff' align='center'>{$key}</td>
      <td style='background-color: #ffffff' align='center'>{$value}</td>
      </tr>
      ";      
    }
  }
  echo $ret;
}
function hiddenFormSearch($get){
  $ret = "";
  foreach($get AS $key => $value){
    if($key != "cari") $ret.= "<input type='hidden' name='{$key}' value='{$value}'>";
  }
  echo $ret;
}
function createUrl($get,$kecuali){
  $url = "?";
  foreach ($get as $key => $value) {
    if ($kecuali != "") {// kalau ada ketentuan
      if ($key != $kecuali) {
        $url.= $key."=".$value."&";
      }
    }
    else{
      $url.= $key."=".$value."&";
    }
  }
  echo $url;
}
//Fungsi anti injection dan XSS
function secure($inp){
	$xss = stripslashes(strip_tags(htmlspecialchars($inp,ENT_QUOTES)));
	$sql = mysqli_real_escape_string(opendb(), $xss);
	return $sql;
}
//----------------------------------------------------------------------

    function autonumber($tabel, $kolom, $lebar=0, $awalan=''){
        $query="select $kolom from $tabel order by $kolom desc limit 1";
        $hasil=mysqli_query(opendb(), $query);
        $jumlahrecord = mysqli_num_rows($hasil);
        if($jumlahrecord == 0)
            $nomor=1;
        else{
            $row=mysqli_fetch_array($hasil);
            $nomor=intval(substr($row[0],strlen($awalan)))+1;
        }
        if($lebar>0)
            $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        else
            $angka = $awalan.$nomor;
        return $angka;
    }

// fungsi untuk mengubah susunan format tanggal
function tgl_indo2($tgl){
  $tanggal = substr($tgl,8,2);
  $bulan   = ambilbulan(substr($tgl,5,2)); // konversi menjadi nama bulan bahasa indonesia
  $tahun   = substr($tgl,0,4);
  return $tanggal.' '.$bulan.' '.$tahun;     
}

function ambilbulan($bln){
  if ($bln=="01") return "Januari";
  elseif ($bln=="02") return "Februari";
  elseif ($bln=="03") return "Maret";
  elseif ($bln=="04") return "April";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Juni";
  elseif ($bln=="07") return "Juli";
  elseif ($bln=="08") return "Agustus";
  elseif ($bln=="09") return "September";
  elseif ($bln=="10") return "Oktober";
  elseif ($bln=="11") return "November";
  elseif ($bln=="12") return "Desember";
} 

function ubah_tgl($tanggal) { 
   $pisah   = explode('/',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

function ubah_tgl2($tanggal) { 
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('/',$larik);
   return $satukan;
}

//format ubah tgl indo ke tgl inggris
function InggrisTgl($tanggal){
	$tgl = substr($tanggal,0,2);
	$bln = substr($tanggal,3,2);
	$thn = substr($tanggal,6,4);
	$tanggal = "$thn-$bln-$tgl";
	return $tanggal;
}

function IndonesiaTgl($tanggal){
	$tgl = substr($tanggal,8,2);
	$bln = substr($tanggal,5,2);
	$thn = substr($tanggal,0,4);
	return $tgl.'-'.$bln.'-'.$thn;
}

// Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
  $hasil =  number_format($angka,0, ",",".");
  return $hasil;
}
function base_url($port = ""){
  return sprintf(
    "%s://%s:%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],$_SERVER['SERVER_PORT'],
    $_SERVER['REQUEST_URI']
  );
}
?>