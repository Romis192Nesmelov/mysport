<?php

use Illuminate\Database\Seeder;
use App\Direction;

class DirectionsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['uri' => 'web', 'name_en' => 'Web and backend development','name_ru' => 'Веб и бекенд разработка','icon' => 'fa fa-git','active' => 1],
            ['uri' => 'frontend', 'name_en' => 'Frontend and layout development','name_ru' => 'Фронтенд и верстка','icon' => 'fa fa-css3','active' => 1],
            ['uri' => 'mobile', 'name_en' => 'Mobile-programming development','name_ru' => 'Мобильные приложения','icon' => 'fa fa-mobile','active' => 1],
            ['uri' => 'sysadmin', 'name_en' => 'System administration and support','name_ru' => 'Системное администрирование','icon' => 'fa fa-linux','active' => 1],
            ['uri' => 'design', 'name_en' => 'Design, creative and polygraphy','name_ru' => 'Дизайн, креатив и полиграфия','icon' => 'fa fa-paint-brush','active' => 1],
            ['uri' => 'copyright', 'name_en' => 'Writing and copyrighting','name_ru' => 'Копирайтинг и сочинительство','icon' => 'fa fa-file-word-o','active' => 1],
        ];

        foreach ($data as $item) {
            Direction::create($item);
        }
    }
}