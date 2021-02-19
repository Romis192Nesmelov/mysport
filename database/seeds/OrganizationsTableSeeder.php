<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Organization;
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
            $areaId = $areas[rand(0,count($areas)-1)];
            list($latitude,$longitude) = $this->getRandomCoordinates($areaId);

            Organization::create(
                [
                    'name_ru' => $contentName.($i+1),
                    'description_ru' => $contentDescription,
                    'address_ru' => '',
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'phone' => '',
                    'email' => '',
                    'schedule_ru' => '',
                    'active' => 1,
                    'area_id' => $areaId
                ]
            );
        }
    }
}