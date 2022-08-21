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
        $this->MultiCell(0,5,ucwords('Permohonan pengesahan Klub Menembak'),0,'C',0);
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
        $this->Cell(96, 5, ucwords($letter[0]->letter_no), 0, 0, 'L');
        $this->Cell(30, 5, ucwords($letter[0]->letter_place) .', '. DateFormatHelper::dateIn('2022-12-20 17:28:34'), 0, 0, 'L');

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
        $this->MultiCell(70,5,$letter[0]->letter_category_name,0,'L',0);
    }else{
        $this->Ln(5);
        $this->Cell(8);
        $this->Cell(20, 5, 'Lampiran', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->Cell(96, 5, ucwords('1(Satu) Bundel'), 0, 0, 'L');
        $this->Cell(30, 5, ucwords($letter[0]->letter_place) .', '. DateFormatHelper::dateIn('2022-12-20 17:28:34'), 0, 0, 'L');

        // Perihal
        $this->Ln(5);
        $this->cell(8);
        $this->Cell(20, 5, 'Perihal', 0, 0, 'L');
        $this->Cell(1, 5, ':', 0, 0, 'C');
        $this->MultiCell(70,5,ucwords($letter[0]->letter_category_name),0,'L',0);
    }

}

function TujuanSurat($letter)
{
    $this->Cell(125);
    $this->Cell(20, 5,'Kepada', 0, 0);
    $this->Ln(5);
    $this->Cell(119);
    $this->Cell(30, 5,'Yth. '.ucwords($letter[0]->letter_purpose_name), 0, 0);
    $this->Ln(5);
    $this->Cell(125);
    $this->MultiCell(15, 5,'Di '.ucwords($letter[0]->letter_purpose_place), 0,'L',0);
}

function BodySatu($letter)
{
    $this->Cell(10);
    $this->Cell(15, 5, 'Salam Olahraga', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(10);
    $this->Cell(3, 5, '1. ', 0, 0, 'J');
    $this->MultiCell(155,5,"Dasar. ".$letter[0]->dasar_adart,0,'J',0);
}

function bodyDua()
{
    $this->Cell(10);
    $this->Cell(3, 5, '2. ', 0, 0, 'J');
    $this->MultiCell(155,5,"Sehubungan dasar tersebut diatas, diajukan permohonan pengesahan/pendirian Klub Menembak di wilayah Kabupaten Bandung.",0,'J',0);
}

function BodyTiga()
{
    $this->Cell(10);
    $this->Cell(15, 5, '3. Sebagai bahan pertimbangan kami lampirkan:', 0, 0, 'L');

    // isi body 3
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'a.', 0, 0, 'C');
    $this->Cell(32, 5, 'FC 4(empat) orang anggota yang sudah memiliki KTA Perbakin dari PB', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'b.', 0, 0, 'C');
    $this->Cell(32, 5, 'FC KTP', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'c.', 0, 0, 'C');
    $this->Cell(32, 5, 'AD/ART Klub/Perkumpulan Menembak yang berisi Nama lambang Klub, Logo Klub/Arti, Visi Misi Klub', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'd.', 0, 0, 'C');
    $this->Cell(32, 5, 'Struktur Organisasi Pengurus Klub', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'e.', 0, 0, 'C');
    $this->Cell(32, 5, 'Daftar Nama para Pengurus Klub', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'f.', 0, 0, 'C');
    $this->Cell(32, 5, 'Pas Poto Pengurus Klub ukuran 3X4, 4X6 latar merah masing masing 5 lembar', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'g.', 0, 0, 'C');
    $this->Cell(32, 5, 'Data anggota Klub minimal 20 Orang', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'h.', 0, 0, 'C');
    $this->Cell(32, 5, 'Surat Keterangan Domisili Sekretariat Klub dari Desa/Kecamatan/akte pendirian dari Notaris', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'i.', 0, 0, 'C');
    $this->Cell(32, 5, 'SKCK Ketua Klub dari Polsek/Polres', 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(2, 5, 'j.', 0, 0, 'C');
    $this->Cell(32, 5, 'Biaya Administrasi sebesar Rp. 15.000.000 ', 0, 0, 'L');
}

function BodyEmpat()
{
    $this->Cell(10);
    $this->Cell(3, 5, '4. ', 0, 0, 'J');
    $this->MultiCell(155,5,"Demikian disampaikan mohon menjadi periksa, besar harapan untuk dikabulkan dan  atas bantuan dan kerjasamanya diucapkan terimakasih.",0,'J',0);
}

function TandaTangan($letter)
{
    $this->Cell(138);
    $this->Cell(32, 5, 'Hormat Kami ', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(130);
    $this->Cell(32, 5, 'Ketua Klub/ Perkumpulan ', 0, 0, 'L');
    $this->Ln(15);
    $this->Cell(138);
    $this->MultiCell(25, 5,ucwords($letter[0]->pemohon), 0, 0);
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetTitle(ucwords($letter[0]->letter_category_name));
$pdf->SetFont('Arial','',8);

// Nomor surat
$pdf->NoSurat($letter);
// Tujuan surat kepada
$pdf->TujuanSurat($letter);

// body surat 1
$pdf->Ln(5);
$pdf->BodySatu($letter);

// body surat 2
$pdf->Ln(2);
$pdf->BodyDua();

// body surat 3
$pdf->Ln(2);
$pdf->BodyTiga();

// body surat 4
$pdf->Ln(7);
$pdf->BodyEmpat();

//Tanda tangan
$pdf->Ln(7);
$pdf->TandaTangan($letter);

$pdf->Output();
exit;

?>
