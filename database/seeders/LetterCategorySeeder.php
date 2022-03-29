<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LetterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('letter_categories')->insert([
            [
                'letter_category_id'            => 1,
                'letter_category_name'          => 'Permohonan Remomendasi Pindah/Mutasi Senpi Amunisi',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 2,
                'letter_category_name'          => 'Permohonan Rekomendasi Hibah Senpi/amunisi untuk kepentingan Olahraga Menembak',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 3,
                'letter_category_name'          => 'Surat Pernyataan Hibah Senpi/amunisi',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 4,
                'letter_category_name'          => 'Permohonan Rekomendasi Izin Kepemilikan Senpi/amunisi untuk kepentingan Olahraga Menembak',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 5,
                'letter_category_name'          => 'Permohonan Rekomendasi Izin Angkut Senjata Api/Amunisi Olahraga untuk Latihan Rutin',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 6,
                'letter_category_name'          => 'Permohonan Izin Angkut Senpi/amunisi Olahraga untuk Berburu Hama Babi',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 7,
                'letter_category_name'          => 'Permohonan Pengunduran diri dari Kepengurusan',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 8,
                'letter_category_name'          => 'Permohonan pengesahan Klub Menembak',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 9,
                'letter_category_name'          => 'Permohonan Rekomendasi Pindah / Mutasi Keanggotaan / Atlet',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 10,
                'letter_category_name'          => 'Permohonan Rekomendasi Uji Balistik Senjata Api',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 11,
                'letter_category_name'          => 'Data Anggota Dan Senjata Api Yang Digunakan Dalam Rangka Berburu Babi Hutan',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
            [
                'letter_category_id'            => 12,
                'letter_category_name'          => 'Formulir Pengajuan anggota baru dan perpanjangan KTA Perbakin',
                'created_at'                    => date('Y-m-d H:i:s'),
                'created_by'                    => 1,
            ],
        ]);
    }
}
