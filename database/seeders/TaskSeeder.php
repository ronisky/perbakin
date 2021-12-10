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
                'module_id'         => '7', //UserGroup
                'task_name'            => 'index',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '23',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'create',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '24',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'edit',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'task_id'            => '25',
                'module_id'         => '7', //UserGroup
                'task_name'            => 'delete',
                'created_by'        => '1',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
