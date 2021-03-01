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
        $contentName = 'Многофункциональный спортивный центр №';
        $contentDescription = '<p>Многофункциональная спортивная площадка для игры в футбол, волейбол, баскетбол, а так же для проведения разного рода мероприятий (спортивных и не только).</p><p>Четыре волейбольных поля. Два мини-футбольных поля. Два баскетбольных поля. Раздевалки, душевые и трибуны. Высокие потолки и комфортная температура 365 дней в году.</p>';
        $areas = Area::pluck('id')->toArray();

        for ($i=0;$i<20;$i++) {
            $name = $contentName.($i+1);
            $address = $this->getRandomAddress();
            $schedule = 'Круглосуточно 24/7';
            $leader = 'Крашненков Анатолий Борисович';
            $areaId = $areas[rand(0,count($areas)-1)];
            list($latitude,$longitude) = $this->getRandomCoordinates($areaId);

            $organization = Organization::create(
                [
                    'slug' => str_slug($name),
                    'image' => 'images/objects/temp.jpg',
                    'name_ru' => $name,
                    'name_en' => $this->transliteration($name),
                    'description_ru' => $contentDescription,
                    'leader_ru' => $leader,
                    'leader_en' => $this->transliteration($leader),
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
                    'area_id' => $areaId
                ]
            );

            for($g=6;$g<=9;$g++) {
                Gallery::create([
                    'photo' => 'images/galleries/gallery_temp'.$g.'.jpg',
                    'organization_id' => $organization->id
                ]);
            }
        }
    }
}