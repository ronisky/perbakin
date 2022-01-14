<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_tasks')->insert([
            [
                'task_id'            => '1',
                'module_id'         => '1', //Dashboard
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '2',
                'module_id'         => '2', //SysModule
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '3',
                'module_id'         => '2', //SysModule
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '4',
                'module_id'         => '2', //SysModule
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '5',
                'module_id'         => '2', //SysModule
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [

                'task_id'            => '6',
                'module_id'         => '3', //SysTask
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '7',
                'module_id'         => '3', //SysTask
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '8',
                'module_id'         => '3', //SysTask
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '9',
                'module_id'         => '3', //SysTask
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [

                'task_id'            => '10',
                'module_id'         => '4', //SysRole
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '11',
                'module_id'         => '4', //SysRole
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '12',
                'module_id'         => '4', //SysRole
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '13',
                'module_id'         => '4', //SysRole
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [

                'task_id'            => '14',
                'module_id'         => '5', //SysMenu
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '15',
                'module_id'         => '5', //SysMenu
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '16',
                'module_id'         => '5', //SysMenu
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '17',
                'module_id'         => '5', //SysMenu
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [

                'task_id'            => '18',
                'module_id'         => '6', //Users
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '19',
                'module_id'         => '6', //Users
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '20',
                'module_id'         => '6', //Users
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '21',
                'module_id'         => '6', //Users
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '22',
                'module_id'         => '6', //Users
                'task_name'            => 'view',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [

                'task_id'            => '23',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '24',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '25',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '26',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '27',
                'module_id'         => '8', //ApprovalStatus
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '28',
                'module_id'         => '8', //ApprovalStatus
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '29',
                'module_id'         => '8', //ApprovalStatus
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '30',
                'module_id'         => '8', //ApprovalStatus
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '31',
                'module_id'         => '9', //ArticleCategory
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '32',
                'module_id'         => '9', //ArticleCategory
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '33',
                'module_id'         => '9', //ArticleCategory
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '34',
                'module_id'         => '9', //ArticleCategory
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '35',
                'module_id'         => '10', //SponsorshipCategory
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '36',
                'module_id'         => '10', //SponsorshipCategory
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '37',
                'module_id'         => '10', //SponsorshipCategory
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '38',
                'module_id'         => '10', //SponsorshipCategory
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '39',
                'module_id'         => '11', //Club
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '40',
                'module_id'         => '11', //Club
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '41',
                'module_id'         => '11', //Club
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '42',
                'module_id'         => '11', //Club
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '43',
                'module_id'         => '11', //Club
                'task_name'            => 'view',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '44',
                'module_id'         => '12', //Banner
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '45',
                'module_id'         => '12', //Banner
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '46',
                'module_id'         => '12', //Banner
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '47',
                'module_id'         => '12', //Banner
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '48',
                'module_id'         => '13', //Gallery
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '49',
                'module_id'         => '13', //Gallery
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '50',
                'module_id'         => '13', //Gallery
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '51',
                'module_id'         => '13', //Gallery
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '52',
                'module_id'         => '14', //FAQ
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '53',
                'module_id'         => '14', //FAQ
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '54',
                'module_id'         => '14', //FAQ
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '55',
                'module_id'         => '14', //FAQ
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '56',
                'module_id'         => '14', //FAQ
                'task_name'            => 'view',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '57',
                'module_id'         => '15', //Visi Misi
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '58',
                'module_id'         => '15', //Visi Misi
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '59',
                'module_id'         => '15', //Visi Misi
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '60',
                'module_id'         => '15', //Visi Misi
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '61',
                'module_id'         => '16', //Histpry
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '62',
                'module_id'         => '16', //Histpry
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '63',
                'module_id'         => '16', //Histpry
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '64',
                'module_id'         => '16', //Histpry
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
