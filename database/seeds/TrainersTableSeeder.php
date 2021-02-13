<?php

use Illuminate\Database\Seeder;
use App\Trainer;
use App\KindOfSport;

class TrainersTableSeeder extends Seeder
{
    public function run()
    {
        $sports = KindOfSport::where('active',1)->pluck('id')->toArray();
        $data = [
            [
                'image' => 'images/trainers/trainer1.jpg',
                'name_ru' => 'Константинопольский Константин Константинович',
                'name_en' => 'Konstantinopol\'skij Konstantin',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer2.jpg',
                'name_ru' => 'Христорождественская Вильгельмина Имануиловна',
                'name_en' => 'Hristorozhdestvenskaya Vil\'gel\'mina',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer3.jpg',
                'name_ru' => 'Денисенков Николай Петрович',
                'name_en' => 'Denisenkov Nikolaj',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer4.jpg',
                'name_ru' => 'Иваненкова Екатерина Константиновна',
                'name_en' => 'Ivanenkova Ekaterina',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer5.jpg',
                'name_ru' => 'Десяцкова Эвелина Геннадьевна',
                'name_en' => 'Desyackova Evelina',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer6.jpg',
                'name_ru' => 'Николяшин Иван Сергеевич',
                'name_en' => 'Nikolyashin Ivan',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer7.jpg',
                'name_ru' => 'Петрова Елена Викторовна',
                'name_en' => 'Petrova Elena',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'image' => 'images/trainers/trainer8.jpg',
                'name_ru' => 'Серебряков Денис Александрович',
                'name_en' => 'Serebryakov Denis',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
        ];

        foreach ($data as $user) {
            Trainer::create($user);
        }
    }
}