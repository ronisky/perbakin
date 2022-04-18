<?php

namespace Modules\Users\Repositories;

use App\Implementations\QueryBuilderImplementation;
use Exception;
use Illuminate\Support\Facades\DB;

class UsersRepository extends QueryBuilderImplementation
{

    public $fillable = ['user_username', 'user_name', 'user_kta', 'user_email',  'user_phone', 'user_address', 'club_id', 'user_club_gen', 'user_password', 'user_image', 'user_active_date', 'user_status', 'group_id', 'created_at', 'updated_at'];

    public function __construct()
    {
        $this->table = 'sys_users';
        $this->pk = 'user_id';
    }

    public function getAll()
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
                ->select('sys_users.*', 'sys_user_groups.group_name')
                // ->where('sys_users.group_id', '!=', '1')
                ->get();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getById($id)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
                ->join('clubs', 'clubs.club_id', '=', 'sys_users.club_id')
                ->select('sys_users.*', 'sys_user_groups.group_name', 'clubs.club_name')
                ->where($this->pk, '=', $id)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getByUsername($username)
    {
        try {
            return DB::connection($this->db)
                ->table($this->table)
                ->join('sys_user_groups', 'sys_user_groups.group_id', '=', 'sys_users.group_id')
                ->where('user_username', '=', $username)
                ->first();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
