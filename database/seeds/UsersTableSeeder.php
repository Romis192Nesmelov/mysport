<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Kid;
use App\Http\Controllers\HelperTrait;

class UsersTableSeeder extends Seeder
{
    use HelperTrait;
    
    public function run()
    {
        $userData = [
            [
                'name' => 'Роман',
                'surname' => 'Сергеевич',
                'family' => 'Несмелов',
                'gender' => 1,
                'email' => 'romis.nesmelov@gmail.com',
                'phone' => '+7(926)247-77-25',
                'password' => bcrypt('apg192'),
                'born' => 206150400,
                'type' => 1,
            ],
            [
                'name' => 'Константин',
                'surname' => 'Константинович',
                'family' => 'Константинопольский',
                'gender' => 1,
            ],
            [
                'name' => 'Вильгельмина',
                'surname' => 'Имануиловна',
                'family' => 'Константинович',
                'gender' => 4,
            ],
            [
                'name' => 'Николай',
                'surname' => 'Петрович',
                'family' => 'Денисенков',
                'gender' => 4,
            ],
            [
                'name' => 'Екатерина',
                'surname' => 'Константиновна',
                'family' => 'Иваненкова',
                'gender' => 4,
            ],
            [
                'name' => 'Эвелина',
                'surname' => 'Геннадьевна',
                'family' => 'Десяцкова',
                'gender' => 4,
            ],
            [
                'name' => 'Иван',
                'surname' => 'Сергеевич',
                'family' => 'Николяшин',
                'gender' => 4,
            ],
            [
                'name' => 'Елена',
                'surname' => 'Викторовна',
                'family' => 'Петрова',
                'gender' => 4,
            ],
            [
                'name' => 'Денис',
                'surname' => 'Александрович',
                'family' => 'Серебряков',
                'gender' => 4,
            ],
            
            [
                'avatar' => '',
                'email' => 'vnn@12.ru',
                'name' => 'Владимир',
                'surname' => 'Батькович',
                'family' => 'Николашин',
                'phone' => '+7(926)221-47-19',
                'password' => bcrypt('vnn12ru'),
                'gender' => 1,
                'type' => 1
            ],
            [
                'avatar' => '',
                'name' => 'Евгения',
                'surname' => 'Владимировна',
                'family' => 'Цаплева',
                'email' => 'jazzzfank@gmail.com',
                'phone' => '+7(999)853-89-82',
                'password' => bcrypt('jazzzfank'),
                'gender' => 2,
                'type' => 1
            ],
            [
                'avatar' => '',
                'name' => 'Роман',
                'surname' => 'Сергеевич',
                'family' => 'Несмелов',
                'gender' => 1,
                'email' => 'romis@nesmelov.com',
                'phone' => '+7(926)247-77-25',
                'password' => bcrypt('apg192'),
                'born' => 206150400,
                'type' => 2,
            ],
            [
                'avatar' => '',
                'name' => 'Леонид',
                'surname' => '',
                'family' => 'Глушков',
                'gender' => 1,
                'email' => 'it-glushkov@directory.spb.ru',
                'phone' => '',
                'password' => bcrypt('glushkov'),
                'born' => 1,
                'type' => 2,
            ],
        ];

        $kidData = [
            [
                'name' => 'Савва',
                'surname' => 'Романович',
                'family' => 'Несмелов',
                'gender' => 1,
                'born' => 1213966800
            ],
        ];

        foreach ($userData as $k => $user) {
            if (!isset($user['email'])) $user['email'] = $this->getRandomEmail();
            if (!isset($user['phone'])) $user['phone'] = $this->getRandomPhone();
            if (!isset($user['password'])) $user['password'] = bcrypt(str_random(5));
            if (!isset($user['born'])) $user['born'] = rand(1,473414255);
            if (!isset($user['type'])) $user['type'] = 1;

            if (!isset($user['avatar'])) $user['avatar'] = 'images/avatars/user_avatar'.($k+1).'.jpg';
            $user['active'] = 1;
            $user['send_mail'] = 1;

            User::create($user);
        }

        foreach ($kidData as $kid) {
            $kid['active'] = 1;
            $kid['user_id'] = 1;
            Kid::create($kid);
        }
        
        for ($u=0;$u<rand(20,50);$u++) {
            User::create([
                'name' => str_random(10),
                'surname' => str_random(10),
                'family' => str_random(10),
                'gender' => rand(1,2),
                'email' => $this->getRandomEmail(),
                'phone' => $this->getRandomPhone(),
                'password' => bcrypt(str_random(10)),
                'active' => 1,
                'type' => 4,
                'send_mail' => 0
            ]);
        }
    }
}