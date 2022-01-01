<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprovalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('approval_statuses')->insert([
            [
                'approval_status_id'    => '1',
                'approval_status_name'  => 'Diajukan',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'approval_status_id'    => '2',
                'approval_status_name'  => 'Diproses',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'approval_status_id'    => '3',
                'approval_status_name'  => 'Diterima',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'approval_status_id'    => '4',
                'approval_status_name'  => 'Ditolak',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
            [
                'approval_status_id'    => '5',
                'approval_status_name'  => 'Diajukan ulang',
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'       => '1'
            ],
        ]);
    }
}
