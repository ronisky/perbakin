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
        $this->MultiCell(0,5,ucwords('Permohonan Pengunduran diri dari Kepengurusan'),0,'C',0);
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

function TujuanSurat($letter)
{
    $this->Cell(125);
    $this->Cell(20, 5,'Kepada', 0, 0);
    $this->Ln(5);
    $this->Cell(119);
    $this->Cell(6, 5,'Yth.', 0, 0);
    $this->MultiCell(40, 5,ucwords($letter[0]->letter_purpose_name), 0,'L', 0);
    $this->Cell(125);
    $this->MultiCell(15, 5,'Di '.$letter[0]->letter_purpose_place, 0,'L',0);
}

function bodySatu($letter)
{

    $this->Cell(10);
    $this->Cell(15, 5, 'Salam Olahraga', 0, 0, 'L');
    $this->Ln(5);
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
    $this->Cell(120, 5, ucwords($letter[0]->name), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Alamat KTP', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->MultiCell(120,5,ucwords($letter[0]->address),0,'L',0);

    $this->Cell(15);
    $this->Cell(32, 5, 'Pekerjaan', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter[0]->occupation), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Club', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter[0]->club), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'No. KTA Perbakin', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords($letter[0]->no_kta), 0, 0, 'L');
}

function BodyDua($letter)
{
    $this->Cell(10);
    $this->Cell(3, 5, '2. ', 0, 0, 'J');
    $this->MultiCell(155,5,"Bermaksud mengajukan permohonan mengundurkan diri dari kepengurusan Pengcab Perbakin Kab. Bandung Masa Bakti Tahun ".$letter[0]->l7_masa_bakti." dikarenakan " .$letter[0]->l7_alasan_pengunduran.".",0,'J',0);


    $this->Cell(10);
    $this->Cell(3, 5, '', 0, 0, 'J');
    $this->MultiCell(155,5,"     Semoga Perbakin Kab.Bandung Semakin jaya dan melahirkan atlet-atlet tembak yang profesional. Terimakasih atas ilmu,pengalaman dan bimbingan yang diberikan mengenai organisasi menembak, dan apabila kami selama menjadi anggota dan pengurus terdapat tingkah laku yang kurang berkenan,kami mohon maaf yang sebesar-besarnya.",0,'J',0);
}

function BodyTiga()
{
    $this->Cell(10);
    $this->Cell(15, 5, '3. Demikian, atas perhatian dan kerjasamanya saya ucapkan terimakasih.', 0, 0, 'L');
}

function TandaTangan($letter)
{
    $this->Cell(125);
    $this->Cell(20, 5, ucwords($letter[0]->letter_place) .', '. DateFormatHelper::dateIn($letter[0]->letter_date), 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(130);
    $this->MultiCell(25, 5,'Hormat Kami Pemohon', 0,'C', 0);
    $this->Ln(15);
    $this->Cell(133);
    $this->MultiCell(25, 5,ucwords($letter[0]->pemohon), 0, 0);
}

function Tembusan($letter)
{
    $this->Cell(10);
    $this->Cell(20, 5, 'Tembusan :', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(3, 5,'1. ' , 0, 0, 'L');
    $this->Cell(20, 5,ucwords($letter[0]->tembusan1) , 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(3, 5,'2. ' , 0, 0, 'L');
    $this->Cell(20, 5,ucwords($letter[0]->tembusan2) , 0, 0, 'L');
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetTitle(ucwords($letter[0]->letter_category_name));
$pdf->SetFont('Arial','',8);

// Tujuan surat kepada
$pdf->TujuanSurat($letter);

// body surat 1
$pdf->Ln(5);
$pdf->BodySatu($letter);

$pdf->Ln(8);
$pdf->BodyDua($letter);

// body surat 4
$pdf->Ln(7);
$pdf->BodyTiga();

//Tanda tangan
$pdf->Ln(7);
$pdf->TandaTangan($letter);
$pdf->Tembusan($letter);

$pdf->Output();
exit;

?>