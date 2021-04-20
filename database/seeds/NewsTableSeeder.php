<?php

use Illuminate\Database\Seeder;
use App\News;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'image' => 'images/news/news3.jpg',
                'head_ru' => 'Фигурное катание: первый этап Кубка Петра Великого пройдёт 20 ноября на «Ледовой Арене»',
                'head_en' => 'Figure skating: the first stage of the Peter the Great Cup will be held on November 20 at the Ice Arena',
                'content_ru' => '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus odio lorem, dictum eget vulputate a, pulvinar eu magna. Aenean suscipit neque elementum tortor mattis, id rutrum turpis dapibus. Praesent sed ultricies enim. Quisque imperdiet sollicitudin tortor, ut dignissim lacus sodales sit amet.</p><p>Pellentesque hendrerit dignissim urna. Donec pellentesque elementum nibh eu accumsan. Aliquam quis nisl viverra, imperdiet magna at, luctus tellus. Proin laoreet tellus quis molestie facilisis. Suspendisse sodales mauris sapien, id condimentum urna condimentum eget. Fusce sollicitudin vitae dui eu condimentum. Pellentesque sed dui non mi pharetra finibus.</p><p>Maecenas sed accumsan lectus. Integer imperdiet mi justo, quis ultricies enim pharetra id. In elementum, est dictum eleifend pretium, odio est pretium dolor, sit amet rhoncus ante nulla ut purus. Integer aliquet libero eros, id mollis metus dignissim nec. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>',
                'content_en' => '',
                'active' => 1
            ],
            [
                'image' => 'images/news/news2.jpg',
                'head_ru' => 'В декабре в Петербурге пройдут всероссийские спортивные соревнования',
                'head_en' => 'All-Russian sports competitions will be held in St. Petersburg in December',
                'content_ru' => '<p>Pellentesque hendrerit dignissim urna. Donec pellentesque elementum nibh eu accumsan. Aliquam quis nisl viverra, imperdiet magna at, luctus tellus. Proin laoreet tellus quis molestie facilisis. Suspendisse sodales mauris sapien, id condimentum urna condimentum eget. Fusce sollicitudin vitae dui eu condimentum. Pellentesque sed dui non mi pharetra finibus.</p><p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus odio lorem, dictum eget vulputate a, pulvinar eu magna. Aenean suscipit neque elementum tortor mattis, id rutrum turpis dapibus. Praesent sed ultricies enim. Quisque imperdiet sollicitudin tortor, ut dignissim lacus sodales sit amet.</p><p>Pellentesque hendrerit dignissim urna. Donec pellentesque elementum nibh eu accumsan. Aliquam quis nisl viverra, imperdiet magna at, luctus tellus. Proin laoreet tellus quis molestie facilisis. Suspendisse sodales mauris sapien, id condimentum urna condimentum eget. Fusce sollicitudin vitae dui eu condimentum. Pellentesque sed dui non mi pharetra finibus.</p><p>Maecenas sed accumsan lectus. Integer imperdiet mi justo, quis ultricies enim pharetra id. In elementum, est dictum eleifend pretium, odio est pretium dolor, sit amet rhoncus ante nulla ut purus. Integer aliquet libero eros, id mollis metus dignissim nec. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>',
                'content_en' => '',
                'active' => 1
            ],
            [
                'image' => 'images/news/news1.jpg',
                'head_ru' => 'В Петербурге состоялось открытие многофункциональной площадки на стадионе «Шторм»',
                'head_en' => 'The opening of a multifunctional site at the Storm stadium took place in St. Petersburg',
                'content_ru' => '<p>В мероприятии принял участие губернатор Петербурга Александр Беглов. Градоначальник отметил, что еще в марте на этом месте ничего не было, а уже сегодня здесь ест многофункциональное поле для занятия спортом.</p><p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus odio lorem, dictum eget vulputate a, pulvinar eu magna. Aenean suscipit neque elementum tortor mattis, id rutrum turpis dapibus. Praesent sed ultricies enim. Quisque imperdiet sollicitudin tortor, ut dignissim lacus sodales sit amet.</p><p>Pellentesque hendrerit dignissim urna. Donec pellentesque elementum nibh eu accumsan. Aliquam quis nisl viverra, imperdiet magna at, luctus tellus. Proin laoreet tellus quis molestie facilisis. Suspendisse sodales mauris sapien, id condimentum urna condimentum eget. Fusce sollicitudin vitae dui eu condimentum. Pellentesque sed dui non mi pharetra finibus.</p><p>Maecenas sed accumsan lectus. Integer imperdiet mi justo, quis ultricies enim pharetra id. In elementum, est dictum eleifend pretium, odio est pretium dolor, sit amet rhoncus ante nulla ut purus. Integer aliquet libero eros, id mollis metus dignissim nec. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>',
                'content_en' => '',
                'active' => 1
            ],
        ];

        for ($n=0;$n<10;$n++) {
            foreach ($data as $news) {
                $news['date'] = time() - ($n * 60 * 60 * 24 * 2);
                News::create($news);
            }
        }
    }
}