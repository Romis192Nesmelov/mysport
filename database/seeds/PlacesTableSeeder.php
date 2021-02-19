<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Place;
use App\Sport;
use App\KindOfSport;
use App\Http\Controllers\HelperTrait;

class PlacesTableSeeder extends Seeder
{
    use HelperTrait;

    public function run()
    {
        $areas = Area::pluck('id')->toArray();
        $sports = KindOfSport::pluck('id')->toArray();

        for ($i=0;$i<100;$i++) {
            $areaId = $areas[rand(0,count($areas)-1)];
            list($latitude,$longitude) = $this->getRandomCoordinates($areaId);

            $place = Place::create(
                [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'area_id' => $areaId,
                    'active' => 1
                ]
            );
            
            $sportsCount = rand(1,count($sports)-1);
            for ($s=0;$s<$sportsCount;$s++) {
                Sport::create([
                    'place_id' => $place->id,
                    'kind_of_sport_id' => $sports[$s]
                ]);
            }
        }
    }
}