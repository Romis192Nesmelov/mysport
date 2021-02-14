<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        $day = 0;
        $hour = 7;
        $contentCounter = 0;

        $content = [
                [
                    'name_ru' => 'Соревнования по черлидингу «Северная Пальмира» 2021',
                    'description_ru' => 'В соревнованиях примут участие более 1200 спортсменов черлидеров. Сильнейшие команды Санкт-Петербурга и Лен.области, Челябинска, Москвы, Карелии, Валдая и Твери, а также команды из Республики Беларусь и Эстонии.',
                    'name_en' => 'Cheerleading competition «Northern Palmyra» 2021',
                    'description_en' => 'More than 1200 athletes of cheerleaders will take part in the competition. The strongest teams of St. Petersburg and Leningrad region, Chelyabinsk, Moscow, Karelia, Valday and Tver, as well as teams from the Republic of Belarus and Estonia.',
                ],
                [
                    'name_ru' => 'Открытие катка в Охта Парке',
                    'description_ru' => 'Лесной каток на курорте «Охта Парк» по праву считается самым ярким катком Санкт-Петербурга и Ленинградской области. Он расположен в живописном сосновом лесу, и полтора километра ледовых дорожек вписаны прямо в природный ландшафт, что придает катку особое очарование.',
                    'name_en' => 'Opening of a skating rink in Okhta Park',
                    'description_en' => 'The forest skating rink at the Okhta Park resort is rightfully considered the brightest skating rink in St. Petersburg and the Leningrad Region. It is located in a picturesque pine forest, and one and a half kilometers of ice paths are inscribed directly into the natural landscape, which gives the skating rink a special charm.',
                ],
                [
                    'name_ru' => 'Континентальная хоккейная лига',
                    'description_ru' => 'Череда побед СКА прервалась после визита «Металлурга» (2:4). «Северсталь» находится на ходу, в последних матчах переиграв «Торпедо» (4:3 ОТ) и «Трактор» (1:0).',
                    'name_en' => 'Continental Hockey League',
                    'description_en' => 'SKA\'s winning streak was interrupted after Metallurg\'s visit (2: 4). Severstal is on the move, having beaten Torpedo (4: 3 OT) and Traktor (1: 0) in recent matches.',
                ],
                [
                    'name_ru' => '4 этап Кубка России по фигурному катанию на коньках',
                    'description_ru' => '4 этап Кубка России по фигурному катанию на коньках 14 ноября начало соревнований в 16:30 Торжественное открытие  соревнований начнётся в 16:00.',
                    'name_en' => '4th stage of the Russian Figure Skating Cup',
                    'description_en' => 'Stage 4 of the Russian Figure Skating Cup on November 14, the beginning of the competition at 16:30. The ceremonial opening of the competition will begin at 16:00.',
                ],
                [
                    'name_ru' => 'Тинькофф Российская Премьер Лига',
                    'description_ru' => 'Москвичи и питерцы сражаются за первую строчку — соперники зафиксировали по 20 очков, но подопечные Сергея Семака впереди благодаря дополнительным показателям.',
                    'name_en' => 'Tinkoff Russian Premier Liga',
                    'description_en' => 'Muscovites and residents of St. Petersburg are fighting for the first line - the rivals recorded 20 points each, but Sergei Semak\'s charges are ahead due to additional indicators.',
                ]
            ];

        for ($i=0;$i<rand(10,30);$i++) {
            $month = date('n')+($i < 5 ? $i : ceil($i/3));
            $day = $day > cal_days_in_month(CAL_GREGORIAN,$month,2021) ? 1 : $day+1;
            $hour = $hour > 22 ? 8 : $hour+1;
            $halfHour = rand(1,50) > 25 ? '30' : '00';
            $contentCounter++;
            $contentCounter = $contentCounter > count($content)-1 ? 0 : $contentCounter;
            $latitude = 55 + (rand(570000,900000) / 1000000);
            $longitude = 37 + (rand(390000,830000) / 1000000);

            Event::create(
                [
                    'time' => strtotime($month.'/'.$day.'/2021 '.$hour.':'.$halfHour.':00'),
                    'name_ru' => $content[$contentCounter]['name_ru'],
                    'description_ru' => $content[$contentCounter]['description_ru'],
                    'name_en' => $content[$contentCounter]['name_en'],
                    'description_en' => $content[$contentCounter]['description_en'],
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'active' => 1
                ]
            );
        }
    }
}