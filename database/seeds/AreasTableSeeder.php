<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name_ru' => 'Адмиралтейский', 'name_en' => 'Admiraltejskij', 'active' => 1],
            ['name_ru' => 'Василеостровский', 'name_en' => 'Vasileostrovskij', 'active' => 1],
            ['name_ru' => 'Выборгский', 'name_en' => 'Vyborgskij', 'active' => 1],
            ['name_ru' => 'Калининский', 'name_en' => 'Kalininskij', 'active' => 1],
            ['name_ru' => 'Кировский', 'name_en' => 'Kirovskij', 'active' => 1],
            ['name_ru' => 'Колпинский', 'name_en' => 'Kolpinskij', 'active' => 1],
            ['name_ru' => 'Красногвардейский', 'name_en' => 'Krasnogvardejskij', 'active' => 1],
            ['name_ru' => 'Красносельский', 'name_en' => 'Krasnosel\'skij', 'active' => 1],
            ['name_ru' => 'Кронштадтский', 'name_en' => 'Kronshtadtskij', 'active' => 1],
            ['name_ru' => 'Курортный', 'name_en' => 'Kurortnyj', 'active' => 1],
            ['name_ru' => 'Московский', 'name_en' => 'Moskovskij', 'active' => 1],
            ['name_ru' => 'Невский', 'name_en' => 'Nevskij', 'active' => 1],
            ['name_ru' => 'Петроградский', 'name_en' => 'Petrogradskij', 'active' => 1],
            ['name_ru' => 'Петродворцовый', 'name_en' => 'Petrodvorcovyj', 'active' => 1],
            ['name_ru' => 'Приморский', 'name_en' => 'Primorskij', 'active' => 1],
            ['name_ru' => 'Пушкинский', 'name_en' => 'Pushkinskij', 'active' => 1],
            ['name_ru' => 'Фрунзенский', 'name_en' => 'Frunzenskij', 'active' => 1],
            ['name_ru' => 'Центральный', 'name_en' => 'Central\'nyj', 'active' => 1]
        ];

        foreach ($data as $item) {
            Area::create($item);
        }
    }
}