<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_menus')->insert([
            [
                'menu_id'            => '1',
                'menu_name'         => 'Dashboard',
                'module_id'         => '1',
                'menu_url'             => 'dashboard',
                'menu_icon'         => 'home',
                'menu_is_sub'         => '0',
                'menu_parent_id'     => NULL,
                'menu_position'     => '1',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '2',
                'menu_name'         => 'Hak Akses',
                'module_id'         => NULL,
                'menu_url'             => 'javascript:void(0)',
                'menu_icon'         => 'settings',
                'menu_is_sub'         => '0',
                'menu_parent_id'     => NULL,
                'menu_position'     => '2',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '3',
                'menu_name'         => 'Module',
                'module_id'         => '2',
                'menu_url'             => 'sysmodule',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '2',
                'menu_position'     => '1',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '4',
                'menu_name'         => 'Task',
                'module_id'         => '3',
                'menu_url'             => 'systask',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '2',
                'menu_position'     => '2',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '5',
                'menu_name'         => 'Role',
                'module_id'         => '4',
                'menu_url'             => 'sysrole',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '2',
                'menu_position'     => '3',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '6',
                'menu_name'         => 'Menu',
                'module_id'         => '5',
                'menu_url'             => 'sysmenu',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '2',
                'menu_position'     => '4',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '7',
                'menu_name'         => 'Pengguna',
                'module_id'         => NULL,
                'menu_url'             => 'javascript:void(0)',
                'menu_icon'         => 'users',
                'menu_is_sub'         => '0',
                'menu_parent_id'     => NULL,
                'menu_position'     => '3',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '8',
                'menu_name'         => 'Daftar Pengguna',
                'module_id'         => '7',
                'menu_url'             => 'users',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '7',
                'menu_position'     => '1',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '9',
                'menu_name'         => 'Group Pengguna',
                'module_id'         => '6',
                'menu_url'             => 'usergroup',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '7',
                'menu_position'     => '2',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '10',
                'menu_name'         => 'Data Master',
                'module_id'         => null,
                'menu_url'          => 'javascript:void(0)',
                'menu_icon'         => 'database',
                'menu_is_sub'       => '0',
                'menu_parent_id'    => NULL,
                'menu_position'     => '4',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '11',
                'menu_name'         => 'Status Persetujuan',
                'module_id'         => '8',
                'menu_url'             => 'approvalstatus',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '10',
                'menu_position'     => '1',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '12',
                'menu_name'         => 'Artikel',
                'module_id'         => null,
                'menu_url'          => 'javascript:void(0)',
                'menu_icon'         => 'file-text',
                'menu_is_sub'       => '0',
                'menu_parent_id'    => NULL,
                'menu_position'     => '5',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '13',
                'menu_name'         => 'Kategori Artikel',
                'module_id'         => '9',
                'menu_url'             => 'articlecategory',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '12',
                'menu_position'     => '1',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '14',
                'menu_name'         => 'Sponsorship',
                'module_id'         => null,
                'menu_url'          => 'javascript:void(0)',
                'menu_icon'         => 'dollar-sign',
                'menu_is_sub'       => '0',
                'menu_parent_id'    => NULL,
                'menu_position'     => '6',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '15',
                'menu_name'         => 'Kategori Artikel',
                'module_id'         => '10',
                'menu_url'             => 'sponsorshipcategory',
                'menu_icon'         => '',
                'menu_is_sub'         => '1',
                'menu_parent_id'     => '14',
                'menu_position'     => '1',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '16',
                'menu_name'         => 'Data Klub',
                'module_id'         => null,
                'menu_url'          => 'club',
                'menu_icon'         => 'slack',
                'menu_is_sub'       => '0',
                'menu_parent_id'    => NULL,
                'menu_position'     => '7',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'menu_id'            => '17',
                'menu_name'         => 'Banner',
                'module_id'         => null,
                'menu_url'          => 'banner',
                'menu_icon'         => 'copy',
                'menu_is_sub'       => '0',
                'menu_parent_id'    => NULL,
                'menu_position'     => '8',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
