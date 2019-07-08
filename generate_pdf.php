<?php

require('fpdf.php');

class PDF extends FPDF {

    function Header () {
        $this->SetFont('Arial','',10);
        $this->Cell(80);
        $this->Cell(30,10,'PT. PEMBANGKITAN JAWA-BALI',0,0,'C');
        $this->Ln(8);

        $this->SetFont('Arial','B',10);
        $this->Cell(80);
        $this->Cell(30,10,'PETIKAN',0,0,'C');
        $this->Ln(8);

        $this->SetFont('Arial','',10);
        $this->Cell(80);
        $this->Cell(30,10,'KEPUTUSAN DIREKSI PT. PEMBANGKITAN JAWA-BAlI',0,0,'C');
        $this->Ln(8);

        $this->Cell(80);
        $this->Cell(30,10,'Nomor : P.045/010/PJB/2018',0,0,'C');
        $this->Ln(8);

        $this->Cell(80);
        $this->Cell(30,10,'TENTANG :',0,0,'C');
        $this->Ln(8);

        $this->Cell(80);
        $this->Cell(30,10,'PENETAPAN KRITERIA TALENTA KARYAWAN PT. PJB',0,0,'C');
        $this->Ln(8);

        $this->SetFont('Arial','B',10);
        $this->Cell(80);
        $this->Cell(30,10,'DIREKSI PT. PEMBANGKITAN JAWA-BALI',0,0,'C');
        $this->Ln(15);
    }

    function Tubuh(){
        $this->SetFont('Arial','',10);
        $this->Cell(5);
        $this->Cell(30,10,'Menimbang    :',0,0,'L');
        $this->Cell(45);
        $this->Cell(30,10,'dan sebagainya.',0,0,'C');
        $this->Ln(8);

        $this->Cell(5);
        $this->Cell(30,10,'Mengingat      :',0,0,'L');
        $this->Cell(45);
        $this->Cell(30,10,'dan sebagainya.',0,0,'C');
        $this->Ln(13);

        $this->Cell(80);
        $this->Cell(30,10,'MEMUTUSKAN',0,0,'C');
        $this->Ln(8);

        $this->Cell(5);
        $this->Cell(30,10,'Menetapkan   :',0,0,'L');
        $this->Ln(8);

        $this->Cell(5);
        $this->Cell(30,10,'PERTAMA      :',0,0,'L');
    
          $this->Ln(8);
    }

    function Footer () {

        $this->SetFont('Arial','',10);
        $this->SetY(-65);
        $this->Cell(20);
        $this->Cell(30,10,'DIREKTUR SDM DAN ADMINISTRASI', 0,0,'C');

        $this->SetFont('Arial','',10);
        $this->SetY(-35);
        $this->SetX(8);
        $this->Cell(30,10,'SUHARTO', 0,0,'C');

        $this->SetY(-70);
        $this->SetX(31.5);
        $this->SetFont('Arial','',10);
        $this->Cell(85);
        $this->Cell(30,10,'Untuk Petikan,', 0,0,'C');

        $this->SetY(-65);
        $this->SetX(60);
        $this->SetFont('Arial','',10);
        $this->Cell(85);
        $this->Cell(30,10,'KEPALA DIVISI PERFORMANCE MANAGEMENT', 0,0,'C');

        $this->SetY(-59);
        $this->SetX(56.5);
        $this->SetFont('Arial','',10);
        $this->Cell(85);
        $this->Cell(30,10,'DAN SISTEM INFORMASI HUMAN CAPITAL,', 0,0,'C');

        $this->SetY(-35);
        $this->SetX(34);
        $this->SetFont('Arial','',10);
        $this->Cell(85);
        $this->Cell(30,10,'FATCHUR ROZI', 0,0,'C');

        $this->Image('img/stamp.png',110,215,40);
        
    }

}

$pdf = new PDF();
$pdf->AddPage();


$pdf->Tubuh();

$pdf->SetFont('Arial','B',8);

//TABLE
//HEADER TABLE
$pdf->Cell(8,20,'No', 'LTB',0,'C');
$pdf->Cell(27,20,'NAMA', 1,0,'C');
$pdf->Cell(17,20,'NID','TB',0,'C');
$pdf->Cell(38,20,'JABATAN', 1,0,'C');
$pdf->Cell(11,20,'UNIT', 'TB',0,'C');
$pdf->Cell(24,20,'GRADE', 1,0,'C');

$textHeader1 = 'TANGGAL KENAIKAN GRADE TERAKHIR';
$textHeader2 = 'PK/KRITERIA TALENTA SEMESTER I 2018';

$errMargin = 5;
$errMargin = 5;
$startChar=0;		
$maxChar=0;			
$textArray=array();	
$tmpString="";

$cellWidthHead1 = 17;
$cellWidthHead2 = 17;
$cellHeightH = 20;

$textLength = strlen($textHeader1);

while($startChar < $textLength){
    while ($pdf->GetStringWidth( $tmpString ) < ($cellWidthHead1-$errMargin) && ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($textHeader1,$startChar,$maxChar);
    }
    
    $startChar=$startChar+$maxChar;
    array_push($textArray,$tmpString);
    $maxChar=0;
    $tmpString='';
}
$line=count($textArray);

$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->SetFont('Arial','B',6);
$pdf->MultiCell($cellWidthHead1,5,$textHeader1,'TB','C');
$pdf->SetXY($xPos + $cellWidthHead1 , $yPos);

$pdf->Cell(33,10,'KOMPETENSI',1,0,'C');
$pdf->Ln();

$pdf->SetXY($xPos + $cellWidthHead1 , $yPos+10);
$pdf->MultiCell(16.5,5,'SASARAN KINERJA','RLB','C');

$pdf->SetXY($xPos + $cellWidthHead1+16.5 , $yPos+10);
$pdf->MultiCell(16.5,10,'INDIVIDU','R','C');


$textLength = strlen($textHeader2);
while($startChar < $textLength){
    while ($pdf->GetStringWidth( $tmpString ) < ($cellWidthHead2-$errMargin) && ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($textHeader2,$startChar,$maxChar);
    }
    
    $startChar=$startChar+$maxChar;
    array_push($textArray,$tmpString);
    $maxChar=0;
    $tmpString='';
}
$line=count($textArray);
$pdf->SetXY($xPos + $cellWidthHead2+33 , $yPos);
$pdf->MultiCell($cellWidthHead2,5,$textHeader2,'TBR','C');

$pdf->Cell(8,5,'1','RL',0,'C');
$pdf->Cell(27,5,'2',0,0,'C');
$pdf->Cell(17,5,'3','L',0,'C');
$pdf->Cell(38,5,'4','RL',0,'C');
$pdf->Cell(11,5,'5','R',0,'C');
$pdf->Cell(24,5,'6','R',0,'C');
$pdf->Cell(17,5,'7','R',0,'C');
$pdf->Cell(16.5,5,'8','R',0,'C');
$pdf->Cell(16.5,5,'9','TR',0,'C');
$pdf->Cell(17,5,'8','R',0,'C');

$pdf->Ln();

//END OF HEADER TABLE

//DATABASE
$pdf->SetFont('Arial','',7);
include ('koneksi.php');
$karyawan = mysqli_query($connect, "select * from karyawan where nomor = 7");

while ($row = mysqli_fetch_array($karyawan)) {

    $cellWidth1 = 27;
    $cellWidth2 = 38;
    $cellWidth3 = 17;

    $cellHeight =5;

    $errMargin = 5;
    $startChar=0;		
    $maxChar=0;			
    $textArray=array();	
    $tmpString="";

    $line=1;

    if($pdf->GetStringWidth($row['nama']) > $cellWidth1 ) {
        
        $textLength = strlen($row['nama']);
        
        while($startChar < $textLength){
            while ($pdf->GetStringWidth( $tmpString ) < ($cellWidth1-$errMargin) && ($startChar+$maxChar) < $textLength ) {
                $maxChar++;
                $tmpString=substr($row['nama'],$startChar,$maxChar);
            }
            
            $startChar=$startChar+$maxChar;
            array_push($textArray,$tmpString);
            $maxChar=0;
            $tmpString='';
        }
        
        $line=count($textArray);

        $pdf->Cell(8,($line * $cellHeight),$row['nomor'],1,0,'C');

        $xPos=$pdf->GetX();
        $yPos=$pdf->GetY();
        $pdf->MultiCell($cellWidth1,$cellHeight,$row['nama'],'TB','L');
        $pdf->SetXY($xPos + $cellWidth1 , $yPos);
    
        $pdf->Cell(17,($line * $cellHeight),$row['nid'],1,0,'C');

        if ($pdf->GetStringWidth($row['jabatan']) > $cellWidth2) {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth2,$cellHeight,$row['jabatan'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth2 , $yPos);
        }
        else {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth2,($line * $cellHeight),$row['jabatan'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth2 , $yPos);
        }
    
        $pdf->Cell(11,($line * $cellHeight),$row['unit'],1,0,'C');
        $pdf->Cell(24,($line * $cellHeight),$row['grade'],'TB');
        $pdf->Cell(17,($line * $cellHeight),$row['tgl_upgrade'],1,0,'C');
        $pdf->Cell(16.5,($line * $cellHeight),$row['sasaran'],'TB',0,'C');
        $pdf->Cell(16.5,($line * $cellHeight),$row['individu'],1,0,'C');

        if ($pdf->GetStringWidth($row['kriteria']) > $cellWidth3) {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth3,$cellHeight,$row['kriteria'],1,'C');
            $pdf->SetXY($xPos + $cellWidth3 , $yPos);
            $pdf->Ln(20);
        }
        else {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth3,($line * $cellHeight),$row['kriteria'],1,'C');
            $pdf->SetXY($xPos + $cellWidth3 , $yPos);
            $pdf->Ln(20);
        }
    }
    
    elseif ($pdf->GetStringWidth($row['jabatan']) > $cellWidth2) {

        $textLength = strlen($row['jabatan']);
        
        while($startChar < $textLength) {
            while ($pdf->GetStringWidth( $tmpString ) < ($cellWidth2-$errMargin) && ($startChar+$maxChar) < $textLength ) {
                $maxChar++;
                $tmpString=substr($row['jabatan'],$startChar,$maxChar);
            }
            
            $startChar=$startChar+$maxChar;
            array_push($textArray,$tmpString);
            $maxChar=0;
            $tmpString='';
        }
        
        $line=count($textArray);

        $pdf->Cell(8,($line * $cellHeight),$row['nomor'],1,0,'C');

        if($pdf->GetStringWidth($row['nama']) > $cellWidth1) {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth1,$cellHeight,$row['nama'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth1 , $yPos);
        }
        else{
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth1,($line * $cellHeight),$row['nama'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth1 , $yPos);
        }


        $pdf->Cell(17,($line * $cellHeight),$row['nid'],1,0,'C');

        $xPos=$pdf->GetX();
        $yPos=$pdf->GetY();
        $pdf->MultiCell($cellWidth2,$cellHeight,$row['jabatan'],'TB','L');
        $pdf->SetXY($xPos + $cellWidth2 , $yPos);

        $pdf->Cell(11,($line * $cellHeight),$row['unit'],1,0,'C');
        $pdf->Cell(24,($line * $cellHeight),$row['grade'],'TB');
        $pdf->Cell(17,($line * $cellHeight),$row['tgl_upgrade'],1,0,'C');
        $pdf->Cell(16.5,($line * $cellHeight),$row['sasaran'],'TB',0,'C');
        $pdf->Cell(16.5,($line * $cellHeight),$row['individu'],1,0,'C');

        if($pdf->GetStringWidth($row['kriteria']) > $cellWidth3) {
            
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth3,$cellHeight,$row['kriteria'],1,'C');
            $pdf->SetXY($xPos + $cellWidth3 , $yPos);
        }
        else {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth3,($line * $cellHeight),$row['kriteria'],1,'C');
            $pdf->SetXY($xPos + $cellWidth3 , $yPos);
        }

        $pdf->Ln(20);
    }
    
    elseif($pdf->GetStringWidth($row['kriteria']) > $cellWidth3) {
        $textLength = strlen($row['kriteria']);
        while($startChar < $textLength){
            while ($pdf->GetStringWidth( $tmpString ) < ($cellWidth3-$errMargin) && ($startChar+$maxChar) < $textLength ) {
                $maxChar++;
                $tmpString=substr($row['kriteria'],$startChar,$maxChar);
            }
            $startChar=$startChar+$maxChar;
            array_push($textArray,$tmpString);
            $maxChar=0;
            $tmpString='';
        }
        $line=count($textArray);

        $pdf->Cell(8,($line * $cellHeight),$row['nomor'],1,0,'C');

        if($pdf->GetStringWidth($row['nama']) > $cellWidth1) {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth1,$cellHeight,$row['nama'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth1 , $yPos);
        }
        else {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth1,($line * $cellHeight),$row['nama'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth1 , $yPos);
        }       

        $pdf->Cell(17,($line * $cellHeight),$row['nid'],1,0,'C');

        if($pdf->GetStringWidth($row['jabatan']) > $cellWidth2) {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth2,$cellHeight,$row['jabatan'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth2 , $yPos);
        }
        else {
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth2,($line * $cellHeight),$row['jabatan'],'TB','L');
            $pdf->SetXY($xPos + $cellWidth2 , $yPos);
        }

        $pdf->Cell(11,($line * $cellHeight),$row['unit'],1,0,'C');
        $pdf->Cell(24,($line * $cellHeight),$row['grade'],'TB');
        $pdf->Cell(17,($line * $cellHeight),$row['tgl_upgrade'],1,0,'C');
        $pdf->Cell(16.5,($line * $cellHeight),$row['sasaran'],'TB',0,'C');
        $pdf->Cell(16.5,($line * $cellHeight),$row['individu'],1,0,'C');

        $xPos=$pdf->GetX();
        $yPos=$pdf->GetY();
        $pdf->MultiCell($cellWidth3,$cellHeight,$row['kriteria'],1,'C');
        $pdf->SetXY($xPos + $cellWidth3 , $yPos);

        $pdf->Ln(20);
    }
    
    else {
        $line=1;
    }
}
$pdf->Output();
?>