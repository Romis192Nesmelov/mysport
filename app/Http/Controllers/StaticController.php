<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\News;
use App\KindOfSport;
use App\Trainer;
use App\Area;
use App\Organization;
use App\Section;
use App\Place;
use App\Event;
use Illuminate\Support\Facades\App;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

class StaticController extends Controller
{
    use HelperTrait;

    protected $data = [];
//    protected $breadcrumbs = [];

    public function redirect(Request $request)
    {
        if ($request->path() == 'login') return redirect('/?auth=login');
        elseif ($request->path() == 'register') return redirect('/?auth=register');
        else return redirect('/');
    }

    public function index($token=null)
    {
        $this->data['news'] = News::where('active',1)->orderBy('id','desc')->limit(3)->get();
        $this->data['trainers'] = Trainer::where('active',1)->where('best',1)->get();
        $this->data['points'] = $this->findSport();
        $this->getEventOnTheYear();
        $this->data['events'] = Event::where('active',1)->orderBy('start_time','desc')->limit(5)->get();
        return $this->showView('home', $token);
    }
    
    public function setBlind()
    {
        if (!isset($_COOKIE['blind'])) setcookie('blind', 1, time()+(60*60*24*365*5), '/');
        else setcookie('blind', null, -1, '/');
        return redirect()->back();
    }
    
    public function news($slug=null)
    {
        if ($slug) {
            $this->data['news'] = News::where('slug',$slug)->first();
            if (!$this->data['news']) abort(404);
            return $this->showView('current_news');
        } else {
            $this->data['news'] = News::where('active',1)->orderBy('id','desc')->paginate(6);
            return $this->showView('news');
        }
    }

    public function area(Request $request,$slug=null)
    {
        $this->getItem($request, new Area(), $slug);
        $this->data['area_id'] = $this->data['item']->id;
        $this->data['points'] = $this->findSport($this->data['item']->id);
        return $this->showView('area');
    }

    public function events(Request $request,$slug=null)
    {
        if ($slug && $slug == 'all') {
            $this->getEventOnTheYear();
            $this->data['events'] = Event::where('active',1)->orderBy('start_time','desc')->paginate(9);
            return $this->showView('events');
        } else {
            $this->getItem($request, new Event(), $slug);
            $this->data['area_id'] = $this->data['item']->area->id;
            $this->data['points'] =
                [
                    'events' => [$this->data['item']],
                    'organizations' => null,
                    'sections' => null,
                    'places' => null
                ];
            return $this->showView('event');
        }
    }
    
    public function organization(Request $request,$slug=null)
    {
        return $this->getObject($request, new Organization(), $slug);
    }

    public function section(Request $request,$slug=null)
    {
        return $this->getObject($request, new Section(), $slug);
    }

    public function place(Request $request,$slug=null)
    {
        return $this->getObject($request, new Place(), $slug);
    }
    
    public function trainers(Request $request,$slug=null)
    {
        if ($request->has('id')) {
            $this->data['trainer'] = Trainer::find($request->input('id'));
            if (!$this->data['trainer'] || !$this->data['trainer']->active) abort(404);
            return $this->showView('trainer');
        } else {
            $sports = KindOfSport::where('active',1)->orderBy('name_'.App::getLocale())->get();
            $this->data['glossary'] = [];
            $firstLetter = null;
            foreach ($sports as $sport) {
                $letter = mb_substr($sport['name_'.App::getLocale()], 0, 1);
                if ($firstLetter != $letter) {
                    $this->data['glossary'][$letter] = [];
                    $firstLetter = $letter;
                }
                $this->data['glossary'][$letter][] = $sport;
            }
            
            $trainers = Trainer::where('active',1);
            if ($slug) {
                $this->data['slug'] = $slug;
                $sportId = KindOfSport::where('slug',$slug)->pluck('id')->first();
                $this->data['trainers'] = $trainers->where('kind_of_sport_id',$sportId)->paginate(16);
            } else {
                $this->data['trainers'] = $trainers->paginate(16);
            }
            return $this->showView('trainers');
        }
    }
    
    public function kindsOfSport(Request $request)
    {
        if ($request->has('id')) {
            $this->data['sport'] = KindOfSport::find($request->input('id'));
            if (!$this->data['sport'] || !$this->data['sport']->active) abort(404);

            $this->getForeignGallery($this->data['sport']->sections);
            $this->getForeignGallery($this->data['sport']->places, 'place');

            $this->data['counters'] = [];
            $this->data['counters']['events'] = 0;
            foreach ($this->data['sport']->trainers as $trainer) {
                $this->data['counters']['events'] += count($trainer->user->events);
            }
//            $this->data['counters']['places'] = count($this->data['sport']->places);

            return $this->showView('kind_of_sport');
        } else {
            $this->data['kinds_of_sport'] = KindOfSport::where('active',1)->orderBy('name_'.App::getLocale())->get();
            return $this->showView('kinds_of_sport');
        }
    }
    
    private function getForeignGallery($items, $pivotModel=null)
    {
        if (!isset($this->data['gallery'])) $this->data['gallery'] = [];
        foreach ($items as $item) {
            $galleries = $pivotModel ? $item[$pivotModel]->gallery : $item->gallery;
            foreach ($galleries as $gallery) {
                if (count($this->data['gallery']) >= 10) break;
                else $this->data['gallery'][] = $gallery;
            }
            if (count($this->data['gallery']) >= 10) break;
        }
    }

    private function getObject(Request $request, Model $model, $slug)
    {
        $this->getItem($request, $model, $slug);
        $this->data['area_id'] = $this->data['item']->area->id;
        $this->data['points'] = ['events' => null, 'places' => null];

        if ($model instanceof Organization) {
            $this->data['points']['organizations'] = [$this->data['item']];
            $this->data['points']['sections'] = null;
        } else {
            $this->data['points']['organizations'] = null;
            $this->data['points']['sections'] = [$this->data['item']];
        }
        return $this->showView('object');
    }
    
    public function changeLang(Request $request)
    {
        $this->validate($request, ['lang' => 'required|in:en,ru']);
        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
        return redirect()->back();
    }
    
    public function findPoints(Request $request)
    {
        return response()->json([
            'success' => true,
            'points' => $this->findSport(
                $request->input('area_id'),
                $request->input('kind_of_sport'),
                $request->input('events'),
                $request->input('organizations'),
                $request->input('sections')
//                $request->input('places')
            )
        ]);
    }

    protected function showView($view, $token=null)
    {
        $this->data['seo'] = Settings::getSeoTags();
        $mainMenu = [
            ['data_scroll' => 'news', 'name' => trans('menu.news')],
            ['data_scroll' => 'events', 'name' => trans('menu.events')],
            ['data_scroll' => 'map', 'name' => trans('menu.map')],
            ['data_scroll' => 'trainers', 'name' => trans('menu.trainers')]
        ];
        
        $areas = $this->getActiveAreas();
        $sports = KindOfSport::where('active',1)->get();
        $socnets = [
            ['icon' => 'yt', 'href' => '#'],
            ['icon' => 'fb', 'href' => '#'],
            ['icon' => 'inst', 'href' => '#'],
            ['icon' => 'ok', 'href' => '#'],
            ['icon' => 'vk', 'href' => '#']
        ]; 

        return view($view, [
//            'breadcrumbs' => $this->breadcrumbs,
            'blindVer' => isset($_COOKIE['blind']),
            'mainMenu' => $mainMenu,
            'areas' => $areas,
            'sports' => $sports,
            'socnets' => $socnets,
            'data' => $this->data,
            'metas' => $this->metas,
            'token' => $token
        ]);
    }
}
