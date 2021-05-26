<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Organization;
use App\Gallery;
use App\Http\Controllers\HelperTrait;

class OrganizationsTableSeeder extends Seeder
{
    use HelperTrait;

    public function run()
    {

        $data = [
            [
                'name_ru' => 'Центр современных молодежных видов спорта «Жесть»',
                'address_ru' => 'пр.Космонавтов д.38 к.3 лит.А',
                'latitude' => 59.855886,
                'longitude' => 30.355735,
                'phone' => '+7(812)635-08-16',
                'active' => 1,
                'area_id' => 11
            ],
            [
                'name_ru' => 'СК «Крытый каток с искусственным льдом на Ириновском проспекте»',
                'address_ru' => 'Ириновский пр. д.40 стр.1',
                'latitude' => 59.961629,
                'longitude' => 30.484742,
                'phone' => '+7(931)291-17-81',
                'active' => 1,
                'area_id' => 7
            ],
            [
                'name_ru' => 'Спортивный объект «Луч»',
                'address_ru' => 'пос.Серово, ул. Лесная д.9',
                'latitude' => 60.204311,
                'longitude' => 29.569925,
                'phone' => '+7(812)425-42-29',
                'active' => 1,
                'area_id' => 10
            ],
            [
                'name_ru' => 'Спортивный комплекс «Ледовая арена»',
                'address_ru' => 'ул.Передовиков д.14 к.2',
                'latitude' => 59.944539,
                'longitude' => 30.459078,
                'phone' => '+7(812)416-44-94',
                'active' => 1,
                'area_id' => 7
            ],
            [
                'name_ru' => 'СК «Легкоатлетический манеж»',
                'address_ru' => 'Теннисная ал. д.3а',
                'latitude' => 59.971163,
                'longitude' => 30.230142,
                'phone' => '+7(812)384-20-35',
                'active' => 1,
                'area_id' => 13
            ],
            [
                'name_ru' => 'Центр водных видов спорта для взрослых и детей «Невская волна»',
                'address_ru' => 'ул.Джона Рида д.8 лит.А к.2',
                'latitude' => 59.921619,
                'longitude' => 30.450274,
                'phone' => '+7(812)665-21-42',
                'active' => 1,
                'area_id' => 12
            ],
            [
                'name_ru' => 'Стадион Петровский',
                'address_ru' => 'Петровский остров д.2',
                'latitude' => 59.952281,
                'longitude' => 30.285514,
                'phone' => '+7(812)665-21-72',
                'active' => 1,
                'area_id' => 13
            ],
            [
                'name_ru' => 'Спортивный комплекс Приморец',
                'address_ru' => 'Приморский пр. д.56 к. 2 лит.А',
                'latitude' => 59.982932,
                'longitude' => 30.234750,
                'phone' => '+7(812)383-10-37',
                'active' => 1,
                'area_id' => 15
            ],
            [
                'name_ru' => 'Спортивный комплекс Центр Плавания',
                'address_ru' => 'ул.Хлопина д.10',
                'latitude' => 60.000011,
                'longitude' => 30.376801,
                'phone' => '+7(812)748-56-01',
                'active' => 1,
                'area_id' => 4
            ],
            [
                'name_ru' => 'Открытый конькобежный стадион имени Б.А.Шилкова ',
                'address_ru' => 'ул.Демьяна Бедного д.19 к. 2 лит.А',
                'latitude' => 60.044433,
                'longitude' => 30.390177,
                'phone' => '+7(812)665-21-52',
                'active' => 1,
                'area_id' => 4
            ],
            [
                'name_ru' => 'ФОК Антонова-Овсиенко',
                'address_ru' => 'ул.Антонова-Овсеенко д.2 лит.А',
                'latitude' => 59.906075,
                'longitude' => 30.455933,
                'phone' => '+7(812)640-25-14',
                'active' => 1,
                'area_id' => 12
            ],
            [
                'name_ru' => 'ФОК Асафьева',
                'address_ru' => 'ул.Асафьева д.10, к.2',
                'latitude' => 60.050484,
                'longitude' => 30.327474,
                'phone' => '+7(812)335-02-71',
                'active' => 1,
                'area_id' => 3
            ],
            [
                'name_ru' => 'ФОК Ветеранов',
                'address_ru' => 'пр.Ветеранов д.58 лит.А',
                'latitude' => 59.837291,
                'longitude' => 30.234553,
                'phone' => '+7(812)454-15-11',
                'active' => 1,
                'area_id' => 5
            ],
            [
                'name_ru' => 'СК Гаванская',
                'address_ru' => 'ул.Гаванская д.53 лит.А',
                'latitude' => 59.940389,
                'longitude' => 30.238191,
                'phone' => '+7(812)635-08-01',
                'active' => 1,
                'area_id' => 2
            ],
            [
                'name_ru' => 'ФОК Главная',
                'address_ru' => 'ул.Главная д.24 лит.А',
                'latitude' => 60.022009,
                'longitude' => 30.295288,
                'phone' => '+7(812)640-25-05',
                'active' => 1,
                'area_id' => 15
            ],
            [
                'name_ru' => 'ФОК Доблести',
                'address_ru' => 'ул.Доблести д.15',
                'latitude' => 59.859583,
                'longitude' => 30.176566,
                'phone' => '+7(812)454-67-46',
                'active' => 1,
                'area_id' => 8
            ],
            [
                'name_ru' => 'ФОК Дунайский',
                'address_ru' => 'Дунайский пр. д.58 к.3, лит.А',
                'latitude' => 59.844488,
                'longitude' => 30.414476,
                'phone' => '+7(812)635-08-71',
                'active' => 1,
                'area_id' => 17
            ],
            [
                'name_ru' => 'ФОК Испытателей',
                'address_ru' => 'пр.Испытателей д.2 к.3, лит.А',
                'latitude' => 60.001401,
                'longitude' => 30.312535,
                'phone' => '+7(812)640-25-00',
                'active' => 1,
                'area_id' => 15
            ],
            [
                'name_ru' => 'ФОК Комунны',
                'address_ru' => 'ул.Коммуны д.47',
                'latitude' => 59.958651,
                'longitude' => 30.493726,
                'phone' => '+7(812)635-07-41',
                'active' => 1,
                'area_id' => 7
            ],
            [
                'name_ru' => 'ФОК Московский',
                'address_ru' => 'Московское ш. д.3 к.3',
                'latitude' => 59.833769,
                'longitude' => 30.334625,
                'phone' => '+7(812)640-25-10',
                'active' => 1,
                'area_id' => 11
            ],
            [
                'name_ru' => 'ФОК Ломоносов',
                'address_ru' => 'г.Ломоносов, Ораниенбаумский пр. д.40, лит.А',
                'latitude' => 59.895971,
                'longitude' => 29.777732,
                'phone' => '+7(812)454-67-59',
                'active' => 1,
                'area_id' => 14
            ],
            [
                'name_ru' => 'ФОК Руставели',
                'address_ru' => 'ул.Руставели д.51',
                'latitude' => 60.023479,
                'longitude' => 30.435155,
                'phone' => '+7(812)319-39-13',
                'active' => 1,
                'area_id' => 4
            ],
            [
                'name_ru' => 'ФОК Красное село',
                'address_ru' => 'Красное село, ул.Спирина д.10 лит.А',
                'latitude' => 59.742710,
                'longitude' => 30.086340,
                'phone' => '+7(812)635-07-91',
                'active' => 1,
                'area_id' => 8
            ],
            [
                'name_ru' => 'ФОК Стрельна',
                'address_ru' => 'Стрельна, Заводская дор. д.8',
                'latitude' => 59.853085,
                'longitude' => 30.006578,
                'phone' => '+7(812)635-09-81',
                'active' => 1,
                'area_id' => 14
            ],
            [
                'name_ru' => 'ФОК Кронштадт',
                'address_ru' => 'Кронштадт, Цитадельское ш. д.28 лит.А',
                'latitude' => 60.001806,
                'longitude' => 29.735790,
                'phone' => '+7(812)458-88-49',
                'active' => 1,
                'area_id' => 9
            ],
        ];

        foreach ($data as $item) {
            $item['name_en'] = $this->transliteration($item['name_ru']);
            $item['address_en'] = $this->transliteration($item['address_ru']);
            Organization::create($item);
        }

//        $contentName = 'Многофункциональный спортивный центр №';
//        $contentDescription = '<p>Многофункциональная спортивная площадка для игры в футбол, волейбол, баскетбол, а так же для проведения разного рода мероприятий (спортивных и не только).</p><p>Четыре волейбольных поля. Два мини-футбольных поля. Два баскетбольных поля. Раздевалки, душевые и трибуны. Высокие потолки и комфортная температура 365 дней в году.</p>';
//        $areas = Area::pluck('id')->toArray();
//
//        for ($i=0;$i<20;$i++) {
//            $name = $contentName.($i+1);
//            $address = $this->getRandomAddress();
//            $schedule = 'Круглосуточно 24/7';
//            $leader = 'Крашненков Анатолий Борисович';
//            $areaId = $areas[rand(0,count($areas)-1)];
//            list($latitude,$longitude) = $this->getRandomCoordinates($areaId);
//
//            $organization = Organization::create(
//                [
//                    'image' => 'images/objects/temp.jpg',
//                    'name_ru' => $name,
//                    'name_en' => $this->transliteration($name),
//                    'description_ru' => $contentDescription,
//                    'leader_ru' => $leader,
//                    'leader_en' => $this->transliteration($leader),
//                    'address_ru' => $address,
//                    'address_en' => $this->transliteration($address),
//                    'latitude' => $latitude,
//                    'longitude' => $longitude,
//                    'phone' => $this->getRandomPhone(),
//                    'email' => $this->getRandomEmail(),
//                    'site' => $this->getRandomSite(),
//                    'schedule_ru' => $schedule,
//                    'schedule_en' => $this->transliteration($schedule),
//                    'active' => 1,
//                    'area_id' => $areaId
//                ]
//            );
//
//            for($g=6;$g<=9;$g++) {
//                Gallery::create([
//                    'photo' => 'images/galleries/gallery_temp'.$g.'.jpg',
//                    'organization_id' => $organization->id
//                ]);
//            }
//        }
    }
}