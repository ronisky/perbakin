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
        $this->MultiCell(0,5,ucwords('Permohonan Izin Angkut Senpi/amunisi Olahraga untuk Berburu Hama Babi'),0,'C',0);
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

function NoSurat($letter)
{
    $user = Auth::user()->group_id;
    if ($user == 2 || $user == 1) {
        $this->Cell(8);
        $this->Cell(20, 5, 'Nomor Surat', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->Cell(96, 5, ucwords($letter->letter_no), 0, 0, 'L');
        $this->Cell(30, 5, ucwords($letter->letter_place) .', '. DateFormatHelper::dateIn($letter->letter_date), 0, 0, 'L');

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
        $this->MultiCell(70,5,ucwords($letter->letter_category_name),0,'L',0);
    }else{
        $this->Ln(5);
        $this->Cell(8);
        $this->Cell(20, 5, 'Lampiran', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->Cell(96, 5, ucwords('1(Satu) Bundel'), 0, 0, 'L');
        $this->Cell(30, 5, ucwords($letter->letter_place) .', '. DateFormatHelper::dateIn($letter->letter_date), 0, 0, 'L');

        // Perihal
        $this->Ln(5);
        $this->cell(8);
        $this->Cell(20, 5, 'Perihal', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->MultiCell(70,5,ucwords($letter->letter_category_name),0,'L',0);
    }

}

function TujuanSurat($letter)
{
    $this->Cell(125);
    $this->Cell(20, 5,'Kepada', 0, 0);
    $this->Ln(5);
    $this->Cell(119);
    $this->Cell(30, 5,'Yth. '.ucwords($letter->letter_purpose_name), 0, 0);
    $this->Ln(5);
    $this->Cell(125);
    $this->MultiCell(15, 5,'Di '.ucwords($letter->letter_purpose_place), 0,'L',0);
}

function BodySatu($letter)
{
    $this->Cell(10);
    $this->Cell(15, 5, 'Dengan Hormat', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(10);
    $this->Cell(15, 5, '1. Yang bertanda tangan dibawah ini:', 0, 0, 'L');
    // isi body 1
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Nama', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->name), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Alamat KTP', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->MultiCell(120,5,ucwords($letter->address),0,'L',0);

    $this->Cell(15);
    $this->Cell(32, 5, 'Pekerjaan', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->occupation), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'No Anggota Perbakin', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->no_kta), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Cabang', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->membership), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Perkumpulan', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->club), 0, 0, 'L');
}

function BodyDua($letter)
{
    $this->Cell(10);
    $this->Cell(3, 5, '2. ', 0, 0, 'J');
    $this->MultiCell(155,5,"Sebagai Ketua rombongan,  dengan ini mengajukan ".$letter->letter_category_name." dalam rangka ". $letter->dalam_event,0,'J',0);

    $this->Cell(15);
    $this->Cell(32, 5, 'Di Daerah', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->lokasi1), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Dari tanggal s/d tanggal', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter->waktu_mulai.' s.d. '.$letter->waktu_selesai), 0, 0, 'L');
}

function BodyTiga($letter)
{
    $this->Cell(10);
    $this->Cell(15, 5, '3. Adapun anggota rombongan kami berjumlah  ( '.$letter->jumlah_anggota.' ) orang terlampir', 0, 0, 'L');

}

function BodyEmpat()
{
    $this->Cell(10);
    $this->Cell(15, 5, '4. Sebagai kelengkapan atas permohonan ini maka kami lampirkan:', 0, 0, 'L');

    // isi body 3
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'a.', 0, 0, 'C');
    $this->Cell(32, 5, 'Rekomendasi dari Pengcab Perbakin Kab.Bandung', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'b.', 0, 0, 'C');
    $this->Cell(32, 5, 'Nama Anggota rombongan dan Senjata Api yang digunakan', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'c.', 0, 0, 'C');
    $this->Cell(32, 5, 'Foto kopi  KTP/KTA Perbakin bidang Berburu', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'd.', 0, 0, 'C');
    $this->Cell(32, 5, 'Foto kopi Buku Pas Senjata Api', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'e.', 0, 0, 'C');
    $this->Cell(32, 5, 'Undangan Berburu , dari Kepala Desa / Camat lokasi Berburu', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'f.', 0, 0, 'C');
    $this->Cell(32, 5, 'Surat Keterangan Sehat dari Dokter', 0, 0, 'L');
}

function BodyLima()
{
    $this->Cell(10);
    $this->MultiCell(155, 5, '5. Demikian permohonan ini kami ajukan,atas perhatian dan kerjasamanya kami ucapkan terimakasih.', 0,'L', 0);
}

function TandaTangan($letter)
{
    $this->Cell(138);
    $this->Cell(32, 5, 'Hormat Kami ', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(135);
    $this->Cell(32, 5, 'Ketua Rombongan ', 0, 0, 'L');
    $this->Ln(15);
    $this->Cell(138);
    $this->MultiCell(25, 5,ucwords($letter->pemohon), 0, 0);
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetTitle(ucwords($letter->letter_category_name));
$pdf->SetFont('Arial','',8);

// Nomor surat
$pdf->NoSurat($letter);
// Tujuan surat kepada
$pdf->TujuanSurat($letter);

// body surat 1
$pdf->Ln(5);
$pdf->BodySatu($letter);

$pdf->Ln(7);
$pdf->BodyDua($letter);

// body surat 3
$pdf->Ln(7);
$pdf->BodyTiga($letter);

// body surat 4
$pdf->Ln(7);
$pdf->BodyEmpat();

$pdf->Ln(7);
$pdf->BodyLima();

//Tanda tangan
$pdf->Ln(7);
$pdf->TandaTangan($letter);

$pdf->Output();
exit;

?>
