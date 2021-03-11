<?php

use Illuminate\Database\Seeder;
use App\KindOfSport;

class KindOfSportTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['icon' => 'images/sports_icons/icons8-nordic_walking.svg', 'name_ru' => 'Скандинавская ходьба', 'name_en' => 'Nordic walking', 'active' => 1],
            ['icon' => 'images/sports_icons/icons8-pullups.svg', 'name_ru' => 'Воркаут', 'name_en' => 'Workout', 'active' => 1],
            ['icon' => 'images/sports_icons/icon-yoga.svg', 'name_ru' => 'Йога', 'name_en' => 'Yoga', 'active' => 1],
            ['icon' => 'images/sports_icons/icons8-handball.svg', 'name_ru' => 'Волейбол', 'name_en' => 'Handball', 'active' => 1],

            ['icon' => 'images/sports_icons/icons8-american_football.svg', 'name_ru' => 'Американский футбол', 'name_en' => 'American football', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-basketball_player.svg', 'name_ru' => 'Баскетбол', 'name_en' => 'Basketball', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-canyoning.svg', 'name_ru' => 'Альпинизм', 'name_en' => 'Canyoning', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-cycling.svg', 'name_ru' => 'Велоспорт', 'name_en' => 'Cycling', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-exercise.svg', 'name_ru' => 'Бег', 'name_en' => 'Exercise', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-hockey.svg', 'name_ru' => 'Хоккей', 'name_en' => 'Hockey', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-lap_pool.svg', 'name_ru' => 'Бассейн', 'name_en' => 'Lap pool', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-roller_skating.svg', 'name_ru' => 'Роликовые коньки', 'name_en' => 'Roller skating', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-row_boat.svg', 'name_ru' => 'Спортивная гребля', 'name_en' => 'Row boat', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-skateboarding.svg', 'name_ru' => 'Скейтбординг', 'name_en' => 'Skateboarding', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-skiing.svg', 'name_ru' => 'Горные лыжи', 'name_en' => 'Skiing', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-snowboarding.svg', 'name_ru' => 'Сноубординг', 'name_en' => 'Snowboarding', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-soccer.svg', 'name_ru' => 'Футбол', 'name_en' => 'Soccer', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-swimming.svg', 'name_ru' => 'Плавание', 'name_en' => 'Swimming', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-tennis_player.svg', 'name_ru' => 'Тенис', 'name_en' => 'Tennis', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-track_and_field.svg', 'name_ru' => 'Бег с препядствиями', 'name_en' => 'Track and field', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-ultimate_frisbee.svg', 'name_ru' => 'Метание диска', 'name_en' => 'Ultimate frisbee', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-volleyball_player.svg', 'name_ru' => 'Волейбол', 'name_en' => 'Volleyball', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-waterskiing.svg', 'name_ru' => 'Водные лыжи', 'name_en' => 'Waterskiing', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-weightlifting.svg', 'name_ru' => 'Тяжелая атлетика', 'name_en' => 'Weightlifting', 'active' => 0],
            ['icon' => 'images/sports_icons/icons8-zipline.svg', 'name_ru' => 'Зиплайн', 'name_en' => 'Zipline', 'active' => 0],
        ];

        foreach ($data as $user) {
            KindOfSport::create($user);
        }
    }
}