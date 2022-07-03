<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sys_users')->insert([
            [
                'user_id'           => '1',
                'user_username'     => '012312B',
                'user_name'         => 'Super Admin',
                'user_kta'          => '0123/12/B/2025',
                'user_email'        => 'febogaqah@boximail.com',
                'user_phone'        => '085123456789',
                'place_of_birth'    => 'Bandung',
                'date_of_birth'     => date('Y-m-d'),
                'occupation'        => 'Wiraswasta',
                'user_address'      => 'Jl. Soreang',
                'club_id'           => 1,
                'user_club_gen'     => 10,
                'user_club_cab'     => 'Kab. Bandung',
                'user_password'     => Hash::make('qwerty'),
                'user_image'        => null,
                'user_active_date'  => '2023-08-01',
                'user_status'       => '1',
                'group_id'          => '1',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '2',
                'user_username'     => '012412B',
                'user_name'         => 'Admin',
                'user_kta'          => '0124/12/B/2025',
                'user_email'        => 'weqov@vomoto.com',
                'user_phone'        => '085123456788',
                'place_of_birth'    => 'Bandung',
                'date_of_birth'     => date('Y-m-d'),
                'occupation'        => 'Wiraswasta',
                'user_address'      => 'Jl. Soreang',
                'club_id'           => 1,
                'user_club_gen'     => 10,
                'user_club_cab'     => 'Kab. Bandung',
                'user_password'     => Hash::make('qwerty'),
                'user_image'        => null,
                'user_active_date'  => '2023-08-01',
                'user_status'       => '1',
                'group_id'          => '1',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '3',
                'user_username'     => '012512B',
                'user_name'         => 'Sekum',
                'user_kta'          => '0125/12/B/2025',
                'user_email'        => 'hasoko@tafmail.com',
                'user_phone'        => '085123456787',
                'place_of_birth'    => 'Bandung',
                'date_of_birth'     => date('Y-m-d'),
                'occupation'        => 'Wiraswasta',
                'user_address'      => 'Jl. Soreang',
                'club_id'           => 1,
                'user_club_gen'     => 10,
                'user_club_cab'     => 'Kab. Bandung',
                'user_password'     => Hash::make('qwerty'),
                'user_image'        => null,
                'user_active_date'  => '2023-08-01',
                'user_status'       => '1',
                'group_id'          => '1',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '4',
                'user_username'     => '012612B',
                'user_name'         => 'Ketua Harian',
                'user_kta'          => '0126/12/B/2025',
                'user_email'        => 'gofesaki@givmail.com',
                'user_phone'        => '085123456786',
                'place_of_birth'    => 'Bandung',
                'date_of_birth'     => date('Y-m-d'),
                'occupation'        => 'Wiraswasta',
                'user_address'      => 'Jl. Soreang',
                'club_id'           => 1,
                'user_club_gen'     => 10,
                'user_club_cab'     => 'Kab. Bandung',
                'user_password'     => Hash::make('qwerty'),
                'user_image'        => null,
                'user_active_date'  => '2023-08-01',
                'user_status'       => '1',
                'group_id'          => '1',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '5',
                'user_username'     => 'guest',
                'user_name'         => 'guest',
                'user_kta'          => 'guest',
                'user_email'        => 'guest@guest.com',
                'user_phone'        => '0',
                'place_of_birth'    => null,
                'date_of_birth'     => null,
                'occupation'        => null,
                'user_address'      => null,
                'club_id'           => null,
                'user_club_gen'     => null,
                'user_club_cab'     => null,
                'user_password'     => null,
                'user_image'        => null,
                'user_active_date'  => '2023-08-01',
                'user_status'       => '1',
                'group_id'          => '6',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
