<?php

require 'fpdf.php';

//DATABASE
include 'koneksi.php';
$karyawan = mysqli_query($connect, "select * from karyawan");
$SK = mysqli_fetch_array(mysqli_query($connect, "select * from surat_keputusan"));

class PDF extends FPDF
{

    // Header
    public function Header()
    {
        global $SK;
        $this->Ln(7);
        $this->SetFont('Arial', '', 10);
        $this->Cell(80);
        $this->Cell(30, 10, 'PT. PEMBANGKITAN JAWA-BALI', 0, 0, 'C');
        $this->Ln(8);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80);
        $this->Cell(30, 10, 'PETIKAN', 0, 0, 'C');
        $this->Ln(8);

        $this->SetFont('Arial', '', 10);
        $this->Cell(80);
        $this->Cell(30, 10, 'KEPUTUSAN DIREKSI PT. PEMBANGKITAN JAWA-BAlI', 0, 0, 'C');
        $this->Ln(8);

        $this->Cell(80);
        $this->Cell(30, 10, 'Nomor : ' . $SK['nomor'], 0, 0, 'C');
        $this->Ln(8);

        $this->Cell(80);
        $this->Cell(30, 10, 'TENTANG :', 0, 0, 'C');
        $this->Ln(8);

        $this->Cell(80);
        $this->Cell(30, 10, $SK['judul'], 0, 0, 'C');
        $this->Ln(8);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(80);
        $this->Cell(30, 10, 'DIREKSI PT. PEMBANGKITAN JAWA-BALI', 0, 0, 'C');
        $this->Ln(15);
    }

    // Tubuh
    public function Tubuh($arr)
    {
        $this->SetFont('Arial', '', 11);
        $this->Cell(22, 10, 'Menimbang', 0, 0, 'L');
        $this->Cell(10, 10, ' :');
        $this->Cell(43);
        $this->Cell(40, 10, 'dan sebagainya.', 0, 0, 'C');
        $this->Ln(8);

        $this->Cell(22, 10, 'Mengingat', 0, 0, 'L');
        $this->Cell(10, 10, ' :');
        $this->Cell(43);
        $this->Cell(40, 10, 'dan sebagainya.', 0, 0, 'C');
        $this->Ln(13);

        $this->Cell(80);
        $this->Cell(30, 10, 'MEMUTUSKAN', 0, 0, 'C');
        $this->Ln(8);

        $this->Cell(22, 10, 'Menetapkan', 0, 0, 'L');
        $this->Cell(10, 10, ' :');
        $this->Ln(8);
        $this->Cell(22, 10, 'PERTAMA', 0, 0, 'L');
        $this->Cell(10, 10, ' :');

        $this->SetY(119.5);
        $this->SetX(38);
        $teks = "Memberikan Kriteria Talenta Semester " . $arr['semester'] . " Tahun " . $arr['tahun'] . " kepada Karyawan PT Pembangkitan Jawa Bali, yang namanya tercantum pada lajur 2 daftar lampiran keputusan ini sebagaimana tercantum pada lajur 10 daftar lampiran yang sama.";
        $this->MultiCell(160, 5, $teks, 0, 'J');

        $this->SetY(133.4);
        $this->Cell(22, 10, 'KEDUA', 0, 0, 'L');
        $this->Cell(10, 10, ' :');

        $this->SetY(136);
        $this->SetX(38);
        $teks = "Keputusan ini berlaku terhitung mulai tanggal " . $arr['tgl_berlaku'] . " sampai dengan " . $arr['tgl_berakhir'] . ", dengan ketentuan apabila dikemudian hari ternyata terdapat kekeliruan dalam keputusan ini, akan ditinjau dan diperbaiki sebagaimana mestinya.";
        $this->MultiCell(160.5, 5, $teks, 0, 'J');

        $this->Ln(5);
        $this->Cell(30);
        $this->Cell(30, 5, 'Ditetapkan di   : ' . $arr['tempat']);

        $this->Ln(6);
        $this->Cell(30);
        $this->Cell(30, 5, 'Pada Tanggal  : ' . $arr['tgl_penetapan']);

        $this->SetFont('Arial', '', 10);
        $this->Ln(10);
        $this->Cell(30);
        $this->Cell(30, 5, 'DIREKTUR SDM DAN ADMINISTRASI,');

        $this->Ln(8);
        $this->Cell(35);
        $this->Cell(30, 5, 'ttd');

        $this->Ln(10);
        $this->Cell(30);
        $this->Cell(30, 5, $arr['kadiv_pmc']);

        $this->SetFont('Arial', '', 8);
        $this->Ln();
        $this->Cell(30, 10, 'KANTOR PUSAT', 0, 0, 'L');

        $this->Ln(8);

    }

    // Header Tabel
    public function TableHeader()
    {
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(8, 20, 'No', 'LTB', 0, 'C');
        $this->Cell(27, 20, 'NAMA', 1, 0, 'C');
        $this->Cell(17, 20, 'NID', 'TB', 0, 'C');
        $this->Cell(38, 20, 'JABATAN', 1, 0, 'C');
        $this->Cell(11, 20, 'UNIT', 'TB', 0, 'C');
        $this->Cell(24, 20, 'GRADE', 1, 0, 'C');

        $textHeader1 = 'TANGGAL KENAIKAN GRADE TERAKHIR';
        $textHeader2 = 'PK/KRITERIA TALENTA SEMESTER I 2018';

        $errMargin = 5;
        $errMargin = 5;
        $startChar = 0;
        $maxChar = 0;
        $textArray = array();
        $tmpString = "";

        $cellWidthHead1 = 17;
        $cellWidthHead2 = 17;
        $cellHeightH = 20;

        $textLength = strlen($textHeader1);

        while ($startChar < $textLength) {
            while ($this->GetStringWidth($tmpString) < ($cellWidthHead1 - $errMargin) && ($startChar + $maxChar) < $textLength) {
                $maxChar++;
                $tmpString = substr($textHeader1, $startChar, $maxChar);
            }
            $startChar = $startChar + $maxChar;
            array_push($textArray, $tmpString);
            $maxChar = 0;
            $tmpString = '';
        }
        $line = count($textArray);

        $xPos = $this->GetX();
        $yPos = $this->GetY();
        $this->SetFont('Arial', 'B', 6);
        $this->MultiCell($cellWidthHead1, 5, $textHeader1, 'TB', 'C');
        $this->SetXY($xPos + $cellWidthHead1, $yPos);

        $this->Cell(33, 10, 'KOMPETENSI', 1, 0, 'C');
        $this->Ln();

        $this->SetXY($xPos + $cellWidthHead1, $yPos + 10);
        $this->MultiCell(16.5, 5, 'SASARAN KINERJA', 'RLB', 'C');

        $this->SetXY($xPos + $cellWidthHead1 + 16.5, $yPos + 10);
        $this->MultiCell(16.5, 10, 'INDIVIDU', 'R', 'C');

        $textLength = strlen($textHeader2);

        while ($startChar < $textLength) {
            while ($this->GetStringWidth($tmpString) < ($cellWidthHead2 - $errMargin) && ($startChar + $maxChar) < $textLength) {
                $maxChar++;
                $tmpString = substr($textHeader2, $startChar, $maxChar);
            }

            $startChar = $startChar + $maxChar;
            array_push($textArray, $tmpString);
            $maxChar = 0;
            $tmpString = '';
        }
        $line = count($textArray);
        $this->SetXY($xPos + $cellWidthHead2 + 33, $yPos);
        $this->MultiCell($cellWidthHead2, 5, $textHeader2, 'TBR', 'C');

        $this->Cell(8, 5, '1', 'RL', 0, 'C');
        $this->Cell(27, 5, '2', 0, 0, 'C');
        $this->Cell(17, 5, '3', 'L', 0, 'C');
        $this->Cell(38, 5, '4', 'RL', 0, 'C');
        $this->Cell(11, 5, '5', 'R', 0, 'C');
        $this->Cell(24, 5, '6', 'R', 0, 'C');
        $this->Cell(17, 5, '7', 'R', 0, 'C');
        $this->Cell(16.5, 5, '8', 'R', 0, 'C');
        $this->Cell(16.5, 5, '9', 'TR', 0, 'C');
        $this->Cell(17, 5, '10', 'R', 0, 'C');

        $this->Ln();

    }

    // Footer
    public function Footer()
    {
        global $SK;

        $this->SetFont('Arial', '', 10);
        $this->SetY(-50);
        $this->Cell(20);
        $this->Cell(30, 10, 'DIREKTUR SDM DAN ADMINISTRASI,', 0, 0, 'C');

        $this->SetY(-35);
        $this->Cell(30, 10, 'ttd', 0, 0, 'C');

        $this->SetY(-20);
        $this->SetX(8);
        $this->Cell(30, 10, $SK['dir_sdm'], 0, 0, 'C');

        $this->SetY(-55);
        $this->SetX(31.5);
        $this->Cell(85);
        $this->Cell(30, 10, 'Untuk Petikan,', 0, 0, 'C');

        $this->SetY(-50);
        $this->SetX(60);
        $this->Cell(85);
        $this->Cell(30, 10, 'KEPALA DIVISI PERFORMANCE MANAGEMENT', 0, 0, 'C');

        $this->SetY(-45);
        $this->SetX(56.5);
        $this->Cell(85);
        $this->Cell(30, 10, 'DAN SISTEM INFORMASI HUMAN CAPITAL,', 0, 0, 'C');

        $this->SetY(-20);
        $this->SetX(34);
        $this->Cell(85);
        $this->Cell(30, 10, $SK['kadiv_pmc'], 0, 0, 'C');

        $this->Image('img/stamp.png', 110, 245, 40);
    }
}

$cellWidth1 = 27;
$cellWidth2 = 38;
$cellWidth3 = 17;

$cellHeight = 5;
$lineName = 1;
$lineJabatan = 1;
$lineKriteria = 1;

$errMargin = 5;
$startChar = 0;
$maxChar = 0;

$tmpString = "";

$line = 1;
$count;
$row = array();
$i = 0;

$zip = new ZipArchive;
$filename = $SK['judul'] . $SK['tahun'] . '.zip';
if ($zip->open($filename, ZipArchive::OVERWRITE)) {
    while ($row = mysqli_fetch_assoc($karyawan)) {
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->Tubuh($SK);
        $pdf->TableHeader();
        $pdf->SetFont('Arial', '', 7);

        if (ceil($pdf->GetStringWidth($row['nama'])) >= $cellWidth1) {

            $textArray = array();
            $textLength = strlen($row['nama']);

            while ($startChar < $textLength) {
                while ($pdf->GetStringWidth($tmpString) < ($cellWidth1 - $errMargin) && ($startChar + $maxChar) < $textLength) {
                    $maxChar++;
                    $tmpString = substr($row['nama'], $startChar, $maxChar);
                }

                $startChar = $startChar + $maxChar;
                array_push($textArray, $tmpString);
                $maxChar = 0;
                $tmpString = '';
            }

            $lineName = count($textArray);
            if ($cellHeight < ($lineName * 5)) {
                $cellHeight = 5 * $lineName;
            }
            $startChar = 0;
        }

        if ($pdf->GetStringWidth($row['jabatan']) > $cellWidth2) {

            $textArray = array();
            $textLength = strlen($row['jabatan']);

            while ($startChar < $textLength) {
                while ($pdf->GetStringWidth($tmpString) < ($cellWidth2 - $errMargin) && ($startChar + $maxChar) < $textLength) {
                    $maxChar++;
                    $tmpString = substr($row['jabatan'], $startChar, $maxChar);
                }

                $startChar = $startChar + $maxChar;
                array_push($textArray, $tmpString);
                $maxChar = 0;
                $tmpString = '';
            }

            $lineJabatan = count($textArray);

            if ($cellHeight < ($lineJabatan * 5)) {
                $cellHeight = 5 * $lineJabatan;
            }
            $startChar = 0;
        }

        if ($pdf->GetStringWidth($row['kriteria']) > $cellWidth3) {

            $textArray = array();
            $textLength = strlen($row['kriteria']);

            while ($startChar < $textLength) {
                while ($pdf->GetStringWidth($tmpString) < ($cellWidth3 - $errMargin) && ($startChar + $maxChar) < $textLength) {
                    $maxChar++;
                    $tmpString = substr($row['kriteria'], $startChar, $maxChar);
                }
                $startChar = $startChar + $maxChar;
                array_push($textArray, $tmpString);
                $maxChar = 0;
                $tmpString = '';
            }
            $lineKriteria = count($textArray);

            if ($cellHeight < ($lineKriteria * 5)) {
                $cellHeight = 5 * $lineKriteria;
            }
            $startChar = 0;
        }

        $pdf->Cell(8, $cellHeight, $row['nomor'], 1, 0, 'C');

        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();

        if ($lineName >= 3) {
            $pdf->SetFont('Arial', '', 6);
        }

        $pdf->MultiCell($cellWidth1, ($cellHeight / $lineName), $row['nama'], 'TB', 'L');
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($xPos + $cellWidth1, $yPos);

        $pdf->Cell(17, $cellHeight, $row['nid'], 1, 0, 'C');

        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();
        $pdf->MultiCell($cellWidth2, ($cellHeight / $lineJabatan), $row['jabatan'], 'TB', 'L');
        $pdf->SetXY($xPos + $cellWidth2, $yPos);

        $pdf->Cell(11, $cellHeight, $row['unit'], 1, 0, 'C');
        $pdf->Cell(24, $cellHeight, $row['grade'], 'TB', 0, 'C');
        $pdf->Cell(17, $cellHeight, $row['tgl_upgrade'], 1, 0, 'C');
        $pdf->Cell(16.5, $cellHeight, $row['sasaran'], 'TB', 0, 'C');
        $pdf->Cell(16.5, $cellHeight, $row['individu'], 1, 0, 'C');

        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();
        $pdf->MultiCell($cellWidth3, ($cellHeight / $lineKriteria), $row['kriteria'], 1, 'C');
        $pdf->SetXY($xPos + $cellWidth3, $yPos);
        $pdf->Ln(20);

        $lineName = 1;
        $lineJabatan = 1;
        $lineKriteria = 1;
        $cellHeight = 5;
        $dir = $SK['tahun'] . '_' . $row['nid'] . '_' . $SK['semester'] . '.pdf';
        $pdf->Output('F', $dir);
        $zip->addFile($dir);
        unlink($dir);
        $i++;
    }
}
// while (ob_get_level() > 0) {
//     ob_end_clean();
// }
// if (file_exists($filename)) {
//     unlink($filename);
// }
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Description: File Transfer");
header("Content-type: application/zip");
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($filename));
ob_end_flush();
@readfile($filename);
