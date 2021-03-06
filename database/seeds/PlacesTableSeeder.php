<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Place;
use App\Sport;
use App\Gallery;
use App\KindOfSport;
use App\Http\Controllers\HelperTrait;

class PlacesTableSeeder extends Seeder
{
    use HelperTrait;

    public function run()
    {
        $areas = Area::pluck('id')->toArray();
        $sports = KindOfSport::where('active',1)->pluck('id')->toArray();
        
        $names = [
            'Баскетбольная площадка',
            'Тенисный корт',
            'Хоккейная коробка',
            'Мини-футбольная площадка',
            'Скейтпарк','Воркаут-площадка',
            'Площадка ГТО',
            'Всесезонная площадка'
        ];
        
        $locations = [
            'севернее',
            'южнее',
            'восточнее',
            'западнее',
            'северо-восточнее',
            'северо-западнее',
            'юго-восточнее',
            'юго-западнее'
        ];

        for ($i=0;$i<100;$i++) {
            $areaId = $areas[rand(0,count($areas)-1)];
            list($latitude,$longitude) = $this->getRandomCoordinates($areaId);
            
            $name = $names[rand(0,count($names)-1)];
            $address = $this->getRandomAddress(true).', '.$locations[rand(0,count($locations)-1)].' дома '.rand(1,50).(rand(0,1) ? ' стр.'.rand(1,10) : '');

            $place = Place::create(
                [
                    'name_ru' => $name,
                    'name_en' => $this->transliteration($name),
                    'address_ru' => $address,
                    'address_en' => $this->transliteration($address),
                    'description_ru' => 'Всесезонный корт в Купчино на Бухарестской улице. Летом подходит для игр в футбол и баскетбол. Летом для хоккея и катания на коньках.',
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'area_id' => $areaId,
                    'active' => 1
                ]
            );
            
            
            // Cross table by kind of sport
            $sportsCount = rand(1,count($sports)-1);
            for ($s=0;$s<$sportsCount;$s++) {
                Sport::create([
                    'place_id' => $place->id,
                    'kind_of_sport_id' => $sports[$s]
                ]);
            }

            for($g=6;$g<=9;$g++) {
                Gallery::create([
                    'photo' => 'images/galleries/gallery_temp'.$g.'.jpg',
                    'place_id' => $place->id
                ]);
            }
        }
    }
}