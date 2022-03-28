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
        $this->MultiCell(0,5,"Surat Pernyataan Hibah Senjata Api/Amunisi",0,'C',0);
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

function bodySatu()
{
    $this->Cell(10);
    $this->Cell(15, 5, '1. Yang bertanda tangan dibawah ini saya:', 0, 0, 'L');
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
    $this->Cell(120, 5, ucwords('Bandung'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Pekerjaan /Jabatan', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Quality Asurance'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Alamat KTP', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->MultiCell(120,5,"Permohonan rekomendasi Pindah/Mutasi Senpi/amunisi anggota Perbakin Kab. Bandung ",0,'L',0);
}

function BodySatuDesc()
{
    $this->SetFont('Arial','I',8);
    $this->Cell(15);
    $this->MultiCell(160,5,"( Disebut Pihak I  yang menghibahkan Senjata Api )",0,'J',0);
    $this->SetFont('Arial','',8);
}

function bodyDua()
{
    $this->Cell(10);
    $this->Cell(15, 5, '2. Dengan ini menyatakan telah menghibahkan 1 (satu) Pucuk Senjata Api/amunisi  Kepada:', 0, 0, 'L');
    // isi body 1
    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Nama', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('ronI setiawan'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Pekerjaan /Jabatan', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Quality Asurance'), 0, 0, 'L');

    $this->Ln(5);
    $this->Cell(15);
    $this->Cell(32, 5, 'Alamat KTP', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->MultiCell(120,5,"Permohonan rekomendasi Pindah/Mutasi Senpi/amunisi anggota Perbakin Kab. Bandung ",0,'L',0);

    $this->Cell(15);
    $this->Cell(32, 5, 'No. KTP', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->Cell(120, 5, ucwords('Bandung'), 0, 0, 'L');
}

function BodyDuaDesc()
{
    $this->SetFont('Arial','I',8);
    $this->Cell(15);
    $this->MultiCell(160,5,"( Disebut Pihak II yang menerima Hibah Senjata Api )",0,'J',0);
    $this->SetFont('Arial','',8);
}

function BodyTiga()
{
    $this->Cell(10);
    $this->Cell(2, 5, '3.', 0, 0, 'C');
    $this->MultiCell(155,5,"Dengan ini Pihak kesatu telah menghibahkan Senjata Api kepada Pihak ke II Adapun Identitas Senjata Api yang dihibahkan sebagai berikut:",0,'L',0);

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
    $this->Cell(2, 5, 'd.', 0, 0, 'C');
    $this->Cell(32, 5, 'Nomor Pabrik', 0, 0, 'L');
    $this->Cell(1, 5, ':', 0, 0, 'C');
    $this->MultiCell(120,5,"Permohonan rekomendasi Pindah/Mutasi Senpi/amunisi anggota Perbakin Kab. Bandung ",0,'L',0);

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
}

function BodyTigaDesc()
{
    $this->Cell(15);
    $this->MultiCell(160,5,"Senjata Api/amunsi tersebut dihibahkan kepada (penerima Hibah/Pihak II)  dan selanjutnya akan dipergunakan oleh Penerima hibah untuk keperluan olahraga Menembak/Berburu.",0,'J',0);
}

function BodyEmpat()
{
    $this->Cell(10);
    $this->Cell(2, 5, '4.', 0, 0, 'C');
    $this->MultiCell(155,5,"Demikian surat pernyataan ini saya buat dengan Sadar, Sehat Jasmani dan Rohani tanpa adanya paksaan dari Pihak manapun dan dipergunakan dengan sebaik-baiknya , sesuai dengan peruntukannya.",0,'L',0);
}

function DateAndTandaTangan()
{
    $this->Cell(120);
    $this->Cell(20, 5, ucwords('Bandung') .', '. DateFormatHelper::dateIn('2022-12-20 17:28:34'), 0, 0, 'L');
    $this->Ln(7);
    $this->Cell(125);
    $this->Cell(20, 5, 'Yang menyatakan', 0, 0, 'L');
    $this->Ln(5);
    $this->Cell(30);
    $this->Cell(85, 5, 'Yang menerima Hibah', 0, 0, 'L');
    $this->Cell(20, 5, 'Yang menghibahkan/Pemberi Hibah', 0, 0, 'L');
    $this->Ln(20);
    $this->Cell(30);
    $this->Cell(85, 5,'Roni Setiawan', 0, 0,'L');
    $this->Cell(25, 5,'Roni Setiawan', 0, 0,'L');
}
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetTitle('Surat Rekomendasi');
$pdf->SetFont('Arial','',8);

// body surat 1
$pdf->Ln(5);
$pdf->BodySatu();
$pdf->BodySatuDesc();

// body surat 2
$pdf->Ln(2);
$pdf->BodyDua();
$pdf->Ln(5);
$pdf->BodyDuaDesc();

// body surat 3
$pdf->Ln(3);
$pdf->BodyTiga();
$pdf->Ln(5);
$pdf->BodyTigaDesc();

// body surat 4
$pdf->Ln(3);
$pdf->BodyEmpat();

//Tanda tangan
$pdf->Ln(7);
$pdf->DateAndTandaTangan();

$pdf->Output();
exit;

?>
