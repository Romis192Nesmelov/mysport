<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Organization;
use App\Trainer;
use App\KindOfSport;
use App\Section;
use App\Http\Controllers\HelperTrait;

class SectionsTableSeeder extends Seeder
{
    use HelperTrait;

    public function run()
    {
        $areas = Area::pluck('id')->toArray();
        $organizations = Organization::pluck('id')->toArray();
        $sports = KindOfSport::pluck('id')->toArray();
        $trainers = Trainer::pluck('id')->toArray();

        for ($i=0;$i<50;$i++) {
            $areaId = $areas[rand(0,count($areas)-1)];
            $organizationId = $organizations[rand(0,count($organizations)-1)];
            $sportId = $sports[rand(0,count($sports)-1)];
            $trainerId = $trainers[rand(0,count($trainers)-1)];
            list($latitude,$longitude) = $this->getRandomCoordinates($areaId);

            Section::create(
                [
                    'name_ru' => 'Секция №'.($i+1),
                    'description_ru' => '',
                    'address_ru' => '',
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'phone' => '',
                    'email' => '',
                    'schedule_ru' => '',
                    'active' => 1,

                    'area_id' => $areaId,
                    'organization_id' => $organizationId,
                    'kind_of_sport_id' => $sportId,
                    'trainer_id' => $trainerId,
                ]
            );
        }
    }
}