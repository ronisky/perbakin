<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_modules')->insert([
            [
                'module_id'            => '1',
                'module_name'         => 'Dashboard',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '2',
                'module_name'         => 'SysModule',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '3',
                'module_name'         => 'SysTask',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '4',
                'module_name'         => 'SysRole',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '5',
                'module_name'         => 'SysMenu',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '6',
                'module_name'         => 'Users',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '7',
                'module_name'         => 'UserGroup',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '8',
                'module_name'         => 'ApprovalStatus',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '9',
                'module_name'         => 'ArticleCategory',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '10',
                'module_name'         => 'SponsorshipCategory',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '11',
                'module_name'         => 'Club',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '12',
                'module_name'         => 'Banner',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '13',
                'module_name'         => 'Gallery',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'module_id'            => '14',
                'module_name'         => 'FAQ',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
