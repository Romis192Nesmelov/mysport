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
                'phone' => '+7(926)247-77-25',
                'password' => bcrypt('apg192'),
                'active' => 1,
                'type' => 4,
                'send_mail' => 1
            ],
            [
                'email' => 'vnn@12.ru',
                'phone' => '+7(926)221-47-19',
                'password' => bcrypt('vnn12ru'),
                'active' => 1,
                'type' => 4,
                'send_mail' => 1
            ],
            [
                'email' => 'jazzzfank@gmail.com',
                'phone' => '+7(999)853-89-82',
                'password' => bcrypt('jazzzfank'),
                'active' => 1,
                'type' => 4,
                'send_mail' => 1
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}