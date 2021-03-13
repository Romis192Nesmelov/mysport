<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Http\Controllers\HelperTrait;

class UsersTableSeeder extends Seeder
{
    use HelperTrait;
    
    public function run()
    {
        $data = [
            [
                'avatar' => 'images/avatars/user_avatar1.jpg',
                'name' => 'Роман',
                'surname' => 'Сергеевич',
                'family' => 'Несмелов',
                'gender' => 1,
                'email' => 'romis.nesmelov@gmail.com',
                'phone' => '+7(926)247-77-25',
                'password' => bcrypt('apg192'),
                'born' => 206150400,
                'active' => 1,
                'type' => 1,
                'send_mail' => 1
            ],
            [
                'email' => 'vnn@12.ru',
                'phone' => '+7(926)221-47-19',
                'password' => bcrypt('vnn12ru'),
                'active' => 1,
                'type' => 1,
                'send_mail' => 1
            ],
            [
                'email' => 'jazzzfank@gmail.com',
                'phone' => '+7(999)853-89-82',
                'password' => bcrypt('jazzzfank'),
                'active' => 1,
                'type' => 1,
                'send_mail' => 1
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
        
        for ($u=0;$u<rand(20,50);$u++) {
            User::create([
                'email' => $this->getRandomEmail(),
                'phone' => $this->getRandomPhone(),
                'password' => bcrypt(str_random(10)),
                'active' => 1,
                'type' => 2,
                'send_mail' => 0
            ]);
        }
    }
}