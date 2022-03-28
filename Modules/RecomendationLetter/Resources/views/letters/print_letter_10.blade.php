<?php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Helpers\DateFormatHelper;

class PDF extends FPDF
{
// Page header
function Header()
{    
    $user = Auth::user()->group_id;
    if ($user == 2 || $user == 1) {
        // kop surat
        $this->Image('assets/img/letters/kop_surat.png',35,10,-500);
        // Line break
        $this->Ln(25);
    }else{
        $this->SetFont('Arial','B',12);
        $this->MultiCell(0,5,"Permohonan Rekomendasi Uji Balistik Senjata Api Untuk Olahraga Menembak",0,'C',0);
        $this->Ln(10);
    }
}

// Page footer
function Footer()
{
    $user = Auth::user()->group_id;
    if ($user == 2 || $user == 1) {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->Cell(0, 5, Auth::user()->user_kta, 0, 0, 'L');
        
    }
}

function NoSurat()
{
    $user = Auth::user()->group_id;
    if ($user == 2 || $user == 1) {
        $this->Cell(8);
        $this->Cell(20, 5, 'Nomor Surat', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->Cell(96, 5, ucwords('1/23P/2025'), 0, 0, 'L');
        $this->Cell(30, 5, ucwords('Bandung') .', '. DateFormatHelper::dateIn('2022-12-20 17:28:34'), 0, 0, 'L');
        
        $this->Ln(5);
        $this->Cell(8);
        $this->Cell(20, 5, 'Lampiran', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->Cell(96, 5, ucwords('1(Satu) Bundel'), 0, 0, 'L');
        
        // Perihal
        $this->Ln(5);
        $this->cell(8);
        $this->Cell(20, 5, 'Perihal', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->MultiCell(70,5,"Permohonan Rekomendasi Uji Balistik Senjata Api Untuk Olahraga Menembak",0,'L',0);
    }else{
        $this->Ln(5);
        $this->Cell(8);
        $this->Cell(20, 5, 'Lampiran', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->Cell(96, 5, ucwords('1(Satu) Bundel'), 0, 0, 'L');
        $this->Cell(30, 5, ucwords('Bandung') .', '. DateFormatHelper::dateIn('2022-12-20 17:28:34'), 0, 0, 'L');
        
        // Perihal
        $this->Ln(5);
        $this->cell(8);
        $this->Cell(20, 5, 'Perihal', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->MultiCell(70,5,"Permohonan Rekomendasi Uji Balistik Senjata Api Untuk Olahraga Menembak",0,'L',0);
    }

}

function TujuanSurat()
{
    $this->Cell(125);
    $this->Cell(20, 5,'Kepada', 0, 0);
    $this->Ln(5);
    $this->Cell(119);
    $this->Cell(6, 5,'Yth.', 0, 0);
    $this->MultiCell(40, 5,'Ketum Perbakin Kab.Bandung', 0,'L', 0);
    $this->Cell(125);
    $this->MultiCell(15, 5,'Di Soreang', 0,'L',0);
}

function bodySatu()
{
    $this->Cell(10);
    $this->Cell(15, 5, 'Salam Olahraga', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(10);
    $this->Cell(15, 5, '1. Yang bertanda tangan dibawah ini:', 0, 0, 'L');
    // isi body 1
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Nama', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('ronI setiawan'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Tempat/Tgl lahir', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('ronI setiawan'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Alamat KTP', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->MultiCell(120,5,"Permohonan rekomendasi Pindah/Mutasi Senpi/amunisi anggota Perbakin Kab. Bandung ",0,'L',0);

    $this->Cell(15);
    $this->Cell(32, 5, 'Perkumpulan/ klub', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Kab. Bandung'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'No. KTA PB', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Jingga Club'), 0, 0, 'L');   
}

function bodyDua()
{
    $this->Cell(10);
    $this->Cell(3, 5, '2. ', 0, 0, 'J');
    $this->MultiCell(155,5,"Dengan ini mengajukan permohonan Rekomendasi Izin Angkut Senjata Api / Amunisi dalamrangka Uji Balistik dengan identitas senjata Api sebagai berikut:",0,'J',0);

    // isi body 3
    $this->Cell(15);
    $this->Cell(2, 5, 'a.', 0, 0, 'C');
    $this->Cell(32, 5, 'Jenis', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('ronI setiawan'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'b.', 0, 0, 'C');
    $this->Cell(32, 5, 'Merek', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Bandung'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'c.', 0, 0, 'C');
    $this->Cell(32, 5, 'Kaliber', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Quality Asurance'), 0, 0, 'L');
    
    
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'e.', 0, 0, 'C');
    $this->Cell(32, 5, 'No Buku Pas Senpi', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Jingga Club'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'f.', 0, 0, 'C');
    $this->Cell(32, 5, 'Tanggal Dikeluarkan', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('0123/12/3B/20025'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'g.', 0, 0, 'C');
    $this->Cell(32, 5, 'Jumlah', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Kab. Bandung'), 0, 0, 'L');
    
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'g.', 0, 0, 'C');
    $this->Cell(32, 5, 'Nama Buku Pas', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Kab. Bandung'), 0, 0, 'L');
}

function BodyTiga()
{
    $this->Cell(10);
    $this->Cell(15, 5, '3. Sebagai bahan pertimbangan kami lampirkan:', 0, 0, 'L');

    // isi body 3
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'a.', 0, 0, 'C');
    $this->Cell(32, 5, 'FC KTA Perbakin', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'b.', 0, 0, 'C');
    $this->Cell(32, 5, 'FC KTP', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'c.', 0, 0, 'C');
    $this->Cell(32, 5, 'FC Buku Pas Senjata Api', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'd.', 0, 0, 'C');
    $this->Cell(32, 5, 'Pas Poto (4X6)', 0, 0, 'L');
}

function BodyEmpat()
{
    $this->Cell(10);
    $this->Cell(3, 5, '4. ', 0, 0, 'J');
    $this->MultiCell(155,5,"4.	Demikian surat ini disampaikan atas perhatian dan kerjasamanya kami ucapkan terima kasih.",0,'J',0);
}

function TandaTangan()
{
    $this->Cell(130);
    $this->MultiCell(25, 5,'Hormat Kami Pemohon', 0,'C', 0);
    $this->Ln(15);
    $this->Cell(133);
    $this->MultiCell(25, 5,'Roni Setiawan', 0, 0);
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetTitle('Surat Rekomendasi');
$pdf->SetFont('Arial','',8);

// Nomor surat
$pdf->NoSurat();
// Tujuan surat kepada
$pdf->TujuanSurat();

// body surat 1
$pdf->Ln(5);
$pdf->BodySatu();

// body surat 2
$pdf->Ln(7);
$pdf->BodyDua();

// body surat 3
$pdf->Ln(7);
$pdf->BodyTiga();

// body surat 4
$pdf->Ln(7);
$pdf->BodyEmpat();

//Tanda tangan
$pdf->Ln(7);
$pdf->TandaTangan();

$pdf->Output();
exit;

?>
