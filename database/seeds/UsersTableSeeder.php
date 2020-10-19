<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'avatar' => 'images/avatars/avatar1.jpg',
                'email' => 'romis.nesmelov@gmail.com',
                'phone' => '+79262477725',

                'name' => 'ИП Несмелов Р.С.',
                'director' => 'Несмелов Р.С.',
                'bank' => 'АО «АЛЬФА-БАНК»',
                'bank_id' => '044525593',
                'user_id' => '772630830047',
                'checking_account' => '40802810002640000266',
                'correspondent_account' => '30101810200000000593',
                
                'password' => bcrypt('apg192'),
                'active' => 1,
                'type' => 1,
                'send_mail' => 1
            ],
            
            [
                'email' => 'romis@nesmelov.com',
                'phone' => '+79262477725',

                'password' => bcrypt('apg192'),
                'active' => 1,
                'type' => 2,
                'send_mail' => 1
            ],
            
            [
                'avatar' => 'images/avatars/avatar3.gif',
                'email' => 'trofff@gmail.com',
                'phone' => '+79165630562',
                
                'password' => '$2y$10$E8aG6ECvpI391DNY5O.z9Ol9o7ZGhrIvtXLgthn/AskifS.0kuy0S',
                'active' => 1,
                'type' => 1,
                'send_mail' => 0
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}