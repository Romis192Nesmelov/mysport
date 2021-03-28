<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Gallery;
use App\Http\Controllers\HelperTrait;

class AreasTableSeeder extends Seeder
{
    use HelperTrait;
    
    public function run()
    {
        $data = [
            ['name_ru' => 'Адмиралтейский'],
            ['name_ru' => 'Василеостровский'],
            ['name_ru' => 'Выборгский'],
            ['name_ru' => 'Калининский'],
            ['name_ru' => 'Кировский'],
            ['name_ru' => 'Колпинский'],
            ['name_ru' => 'Красногвардейский'],
            ['name_ru' => 'Красносельский'],
            ['name_ru' => 'Кронштадтский'],
            ['name_ru' => 'Курортный'],
            ['name_ru' => 'Московский'],
            ['name_ru' => 'Невский'],
            ['name_ru' => 'Петроградский'],
            ['name_ru' => 'Петродворцовый'],
            ['name_ru' => 'Приморский'],
            ['name_ru' => 'Пушкинский', 'image' => 'images/arms/pushkinskij.jpg'],
            ['name_ru' => 'Фрунзенский'],
            ['name_ru' => 'Центральный']
        ];

        foreach ($data as $item) {
            if ($item['name_ru'] == 'Курортный' || $item['name_ru'] == 'Центральный') {
                $prefix = str_replace('ный','ном',$item['name_ru']);
            } elseif ($item['name_ru'] == 'Петродворцовый') {
                $prefix = 'Петродворцовом';
            } else {
                $prefix = str_replace('кий','ком',$item['name_ru']);
            }

            $item['name_en'] = $this->transliteration($item['name_ru']);
            $item['description_ru'] = '
                <p>В '.$prefix.' районе отремонтирована спортивная волейбольная площадка около дома 25А.</p>
                <p>На спортивной площадке выровняли основание и столбы ограждения, постелили новое покрытие из искусственной травы 20мм, установили новые секции ограждения и оборудование для игры в волейбол.</p> 
                <p>В этом году в '.$prefix.' районе предусмотрен ремонт и оснащение оборудованием пяти площадок, а также проведение проектных работ для двух подобных спортивных объекта.</p> 
            ';
            $item['leader_ru'] = 'Волынкина Эвелина Георгиевна';
            $item['leader_en'] = $this->transliteration($item['leader_ru']);
            $item['phone'] = $this->getRandomPhone();
            $item['email'] = $this->getRandomEmail();
            $item['active'] = 1;
            
            $area = Area::create($item);
            
            for($g=1;$g<=5;$g++) {
                Gallery::create([
                    'photo' => 'images/galleries/gallery_temp'.$g.'.jpg',
                    'area_id' => $area->id
                ]);
            }
        }
    }
}