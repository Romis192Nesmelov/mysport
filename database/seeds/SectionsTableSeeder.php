<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Organization;
use App\Trainer;
use App\KindOfSport;
use App\Section;
use App\Gallery;
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

            $name = 'Секция №'.($i+1);
            $description = '<p>'.$name.' - мультифункциональная площадка для игры в футбол, волейбол и баскетбол, а так же для проведения разного рода мероприятий (спортивных и не только).</p><p>Четыре волейбольных поля. Два мини-футбольных поля. Два баскетбольных поля. Раздевалки, душевые и трибуны. Высокие потолки и комфортная температура 365 дней в году.</p>';
            $address = $this->getRandomAddress();
            $schedule = 'Ежедневно: 13:00, 15:00, 17:00';
            
            $section = Section::create(
                [
                    'slug' => str_slug($name),
                    'image' => 'images/objects/temp.jpg',
                    'name_ru' => $name,
                    'name_en' => $this->transliteration($name),
                    'description_ru' => $description,
                    'description_en' => $this->transliteration($description),
                    'address_ru' => $address,
                    'address_en' => $this->transliteration($address),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'phone' => $this->getRandomPhone(),
                    'email' => $this->getRandomEmail(),
                    'site' => $this->getRandomSite(),
                    'schedule_ru' => $schedule,
                    'schedule_en' => $this->transliteration($schedule),
                    'active' => 1,

                    'area_id' => $areaId,
                    'organization_id' => $organizationId,
                    'kind_of_sport_id' => $sportId,
                    'trainer_id' => $trainerId,
                ]
            );

            for($g=6;$g<=9;$g++) {
                Gallery::create([
                    'photo' => 'images/galleries/gallery_temp'.$g.'.jpg',
                    'section_id' => $section->id
                ]);
            }
        }
    }
}