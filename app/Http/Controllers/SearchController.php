<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\News;
use App\KindOfSport;
use App\Area;
use App\Organization;
use App\Section;
use App\Place;
use App\Event;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SearchController extends StaticController
{
    use HelperTrait;

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $this->data['search'] = trim($request->input('search'));
            Session::put('search',$this->data['search']);
        } elseif (Session::has('search')) {
            $this->data['search'] = Session::get('search');
        } else return redirect()->back();

        $locale = App::getLocale();
        $this->data['words'] = preg_split('/[\s,\.;]+/', $this->data['search']);
        $this->data['found'] = collect();

        $this->searching(News::where('active',1)->get(), ['head_'.$locale,'content_'.$locale], 'news');
        $this->searching(Event::where('active',1)->get(), ['name_'.$locale,'address_'.$locale,'description_'.$locale], 'events');
        $this->searching(Area::where('active',1)->get(), ['name_'.$locale,'description_'.$locale], 'area');
        $this->searching(Organization::where('active',1)->get(), ['name_'.$locale,'address_'.$locale,'description_'.$locale], 'organizations');
        $this->searching(Section::where('active',1)->get(), ['name_'.$locale,'address_'.$locale,'description_'.$locale], 'sections');
        $this->searching(Place::where('active',1)->get(), ['name_'.$locale,'address_'.$locale,'description_'.$locale], 'sections');
        $this->searching(KindOfSport::where('active',1)->get(), ['name_'.$locale,'description_'.$locale], 'kinds-of-sport');

        $this->data['found'] = $this->data['found']->paginate(10);

        return $this->showView('search');
    }

    private function searching($items, $fields, $href)
    {
        foreach ($items as $item) {
            $collectionItem = [
                'href' => $href.(isset($item->slug) ? '/'.$item->slug : '?id='.$item->id),
                'item' => $item,
                'fields' => [],
            ];

            $match = false;
            foreach ($fields as $field) {
                foreach ($this->data['words'] as $word) {
                    $content = $item[$field];
                    if (preg_match('/'.$word.'/ui', $content)) {
                        $maxLength = 100;
                        $strPos = mb_strpos($content,$word,0,'UTF-8');
                        $forStart = $strPos < $maxLength;
                        $match = true;
                        $locale = App::getLocale();
                        if ($field != 'name_'.$locale && $field != 'head_'.$locale)
                            $collectionItem['fields'][$field] = (!$forStart ? '…' : '').mb_substr($content,($forStart ? 0 : $forStart),$maxLength).(mb_strlen($content,'UTF-8') > $maxLength ? '…' : '') ;
                    }
                }
            }
            if ($match) $this->data['found']->push($collectionItem);
        }
    }
}
