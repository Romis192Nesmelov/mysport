<?php

use Illuminate\Database\Seeder;
use App\Chapter;

class ChaptersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'head_en' => 'About company',
                'head_ru' => 'О компании',
                'content_en' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In metus vulputate eu scelerisque felis imperdiet proin fermentum leo. Ullamcorper a lacus vestibulum sed arcu non odio. Sed arcu non odio euismod lacinia. Urna condimentum mattis pellentesque id nibh. Diam phasellus vestibulum lorem sed risus ultricies tristique nulla aliquet. Mi in nulla posuere sollicitudin aliquam. Suspendisse faucibus interdum posuere lorem ipsum dolor. Molestie ac feugiat sed lectus vestibulum. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis.</p>',
                'content_ru' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In metus vulputate eu scelerisque felis imperdiet proin fermentum leo. Ullamcorper a lacus vestibulum sed arcu non odio. Sed arcu non odio euismod lacinia. Urna condimentum mattis pellentesque id nibh. Diam phasellus vestibulum lorem sed risus ultricies tristique nulla aliquet. Mi in nulla posuere sollicitudin aliquam. Suspendisse faucibus interdum posuere lorem ipsum dolor. Molestie ac feugiat sed lectus vestibulum. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis.</p>',
            ]
        ];
        
        foreach ($data as $item) {
            Chapter::create($item);
        }
    }
}