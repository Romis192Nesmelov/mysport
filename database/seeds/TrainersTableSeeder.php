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
                'avatar' => 'images/trainers/trainer1.jpg',
                'name' => 'Константин',
                'surname' => 'Константинович',
                'family' => 'Константинопольский',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer2.jpg',
                'name' => 'Вильгельмина',
                'surname' => 'Имануиловна',
                'family' => 'Константинович',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer3.jpg',
                'name' => 'Николай',
                'surname' => 'Петрович',
                'family' => 'Денисенков',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer4.jpg',
                'name' => 'Екатерина',
                'surname' => 'Константиновна',
                'family' => 'Иваненкова',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer5.jpg',
                'name' => 'Эвелина',
                'surname' => 'Геннадьевна',
                'family' => 'Десяцкова',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer6.jpg',
                'name' => 'Иван',
                'surname' => 'Сергеевич',
                'family' => 'Николяшин',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer7.jpg',
                'name' => 'Елена',
                'surname' => 'Викторовна',
                'family' => 'Петрова',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
            [
                'avatar' => 'images/trainers/trainer8.jpg',
                'name' => 'Денис',
                'surname' => 'Александрович',
                'family' => 'Серебряков',
                'active' => 1,
                'best' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)]
            ],
        ];

        foreach ($data as $trainer) {
            $trainer['about_ru'] = '<p>С сентября 2010 года - тренер подмосковного профессионального бадминтонного клуба «Фаворит-Раменское».</p> <p>С 2019 года - главный тренер молодежной сборной России по бадминтону.</p><p>В апреле 2019 года получила титул «Тренер года» от Европейской конфедерации бадминтона.</p>';
            $trainer['education_ru'] = 'Первое высшее образование, РГАФК, Физическая культура и спорт';
            $trainer['add_education_ru'] = 'Профессиональная переподготовка, АНО «Школа бадминтона Санкт-Петербурга»';
            $trainer['achievements_ru'] = 'Заслуженный тренер России, Высшая тренерская категория';
            $trainer['since'] = 2008;
            Trainer::create($trainer);
        }
    }
}