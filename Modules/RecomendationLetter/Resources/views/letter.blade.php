<!DOCTYPE html>

<html>

<head>
    <title>{{ $letters->letter_category_name }}</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'arial';
            font-size: 10;
        }

        #judul {
            text-align: center;
        }

        #halaman {
            width: auto;
            height: auto;
            position: absolute;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

        .parent-div {
            display: flex;
            float: right;
        }

        .child-div {
            text-align: center;
            /* background-color: powderblue; */
            margin: auto 400px;
            height: 120px;
            width: 400px;
        }

    </style>

</head>

<body>
    <div id=halaman>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <tr>
                        <td style="width: 12%;">Lampiran </td>
                        <td style="width: 1%;">:</td>
                        <td style="width: 53%;">1(Satu) Bundel </td>
                        <td style="width: 35%;">{{ $letters->letter_place }}, {{ $letters->letter_date }}<br></td>
                    </tr>
                    <tr>
                        <td style="width: 12%;">Perihal</td>
                        <td style="width: 1%;">:</td>
                        <td style="width: 53%;">{{ $letters->letter_category_name }}</td>
                        <td colspan="2"></td>
                    </tr>
                </table>
            </div>

            <div class="parent-div">
                <div class="child-div">
                    <table>
                        <tr>
                            <td style="width: 60%;"></td>
                            <td></td>
                            <td style="width: 40%;"> Kepada :</td>
                        </tr>
                        <tr>
                            <td style="width: 60%;"></td>
                            <td>Yth. </td>
                            <td collapse="2" style="width: 40%;">{{ $letters->letter_purpose_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 60%;"></td>
                            <td></td>
                            <td style="width: 40%;"> Kab.Bandung</td>
                        </tr>
                        <tr>
                            <td style="width: 60%;"></td>
                            <td></td>
                            <td style="width: 40%;">Di</td>
                        </tr>
                        <tr>
                            <td style="width: 60%;"></td>
                            <td></td>
                            <td style="width: 40%;">{{ $letters->letter_purpose_place }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>1. Yang bertanda tangan dibawah ini saya:</p>

            <table>
                <tr>
                    <td style="width: 30%;">a. Nama</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $letters->name }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;">b. Tempat, tanggal lahir</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $letters->place_of_birth }}, {{ $letters->date_of_birth }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;">c. Pekerjaan /Jabatan</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $letters->occupation }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">d. Alamat</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->address}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">e. Club/Perkumpulan</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->club}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">f. No KTA PB-Perbakin</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->no_kta}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">g. Keanggotaan Cabang</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->membership}}</td>
                </tr>
            </table>

            @php
            if ($letters->letter_category_id == 1) {
            $description =
            "Dengan ini mengajukan Permohonan Rekomendasi Pindah/mutasi Gudang penyimpanan
            Senpi/amuniusi dari
            Gudang
            Senpi Polrestabes Bandung(Gudang Senpi Perbakin Kota Bandung) pindah ke Gudang penyimpanan Senpi di
            Wasendak Sat Intelkam Polresta Bandung(Gudang Senpi Perbakin Kab. Bandung) dengan maksut agar lebih
            dekat dengan tempat tinggal, memudahkan dalam mengkoordinir Izin angkut Senjata dan mengikuti Program
            Kerja Perbakin Kab. Bandung Th.2021 -2022.";
            }else if($letters->letter_category_id == 3) {
            $description = "Dengan ini mengajukan Permohonan Rekomendasi Hibah Senpi/amuniusi untuk Kepentingan Olahraga
            Menembak Berburu.";
            }
            @endphp

            <p style="width:55%; text-align: justify; margin:15px 10px 15px 10px; ">
                {{ $description }}
            </p>

            <p>2. Adapun Senpi / Amunisi yang dimohonkan adalah sebagai berikut:</p>
            <table>
                <tr>
                    <td style="width: 30%;">a. Jenis</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $letters->firearm_category_name }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;">b. Merek</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $letters->merek }}</td>
                </tr>
                <tr>
                    <td style="width: 30%;">c. Kaliber</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $letters->kaliber }}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">d. Nomor Pabrik</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->no_pabrik}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">e. No Buku Pas Senpi</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->no_buku_pas_senpi}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">f. Nama pemilik</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->nama_pemilik}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">g. Jumlah</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->jumlah}}</td>
                </tr>
                <tr>
                    <td style="width: 30%; vertical-align: top;">h. Penyimpanan/Gudang</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 65%;">{{$letters->penyimpanan}}</td>
                </tr>
            </table>

            <p>3. Sebagai kelengkapan atas permohonan ini maka kami lampirkan:</p>

            <?php
if ($letters->letter_category_id == 1) {
    $data = array(
    "a"=>"a. Fc Surat Pernyataan Hibah Senpi", 
    "b"=>"b. Fc Buku Pas Senpi", 
    "c"=>"c. Foto Senjata",
    "d"=>"d. Fc Kta Perbakin",
    "e"=>"e. Fc KTP",
    "f"=>"f. Fc Sertifikat Lulus Penataran Menembak Perbakin Bid Berburu/Reaksi",
    "g"=>"g. Fc Skck",
    "h"=>"h. Surat Keterangan Sehat dari Dokter Polda",
    "i"=>"i. Hasil lulus Tes Psikotes dari Kepolisian/Polda",
    "j"=>"j. Fc Kartu Keluarga",
    "k"=>"k. Pas foto 2x3 ,3x4, 4x6 ( latar merah) masing-masing 5 lembar"
);
}else{
    $data = array(
    "a"=>"a. Fc Buku Pas Senpi", 
    "b"=>"b. Fc Kta Perbakin", 
    "c"=>"c. Fc KTP",
    "d"=>"d. Pas foto 4x6 ( latar merah) 5 lembar"
);
}

foreach($data as $x => $val) {
  echo "$val<br>";
}
?>

            <div class="parent-div" style="width:60%; text-align: justify; float: right;">
                <div class="">
                    <a class="text">
                        Hormat kami<br>
                        Pemohon<br><br><br><br><br>

                        {{ $letters->pemohon }}
                    </a>

                </div>
            </div>

        </div>
</body>

</html>
