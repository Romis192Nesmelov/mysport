<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'romis.nesmelov@gmail.com',
                'phone' => '+79262477725',
                'password' => bcrypt('apg192'),
                'active' => 1,
                'type' => 1,
                'send_mail' => 1
            ]
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}