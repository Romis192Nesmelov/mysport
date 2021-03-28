<?php

use Illuminate\Database\Seeder;
use App\Trainer;
use App\KindOfSport;

class TrainersTableSeeder extends Seeder
{
    public function run()
    {
        $sports = KindOfSport::where('active',1)->pluck('id')->toArray();
        for ($t=1;$t<=8;$t++) {
            $data = [
                'about_ru' => '<p>С сентября 2010 года - тренер подмосковного профессионального бадминтонного клуба «Фаворит-Раменское».</p><p>С 2019 года - главный тренер молодежной сборной России по бадминтону.</p><p>В апреле 2019 года получила титул «Тренер года» от Европейской конфедерации бадминтона.<p>',
                'education_ru' => 'Первое высшее образование, РГАФК, Физическая культура и спорт',
                'add_education_ru' => 'Профессиональная переподготовка, АНО «Школа бадминтона Санкт-Петербурга»',
                'achievements_ru' => 'Заслуженный тренер России, Высшая тренерская категория',
                'best' => 1,
                'since' => rand(1999,2008),
                'active' => 1,
                'kind_of_sport_id' => $sports[array_rand($sports)],
                'user_id' => $t
            ];
            Trainer::create($data);
        }
    }
}