<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\News;
use App\KindOfSport;
use App\Trainer;
use App\Area;
use App\Event;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

class StaticController extends Controller
{
    use HelperTrait;

    protected $data = [];
//    protected $breadcrumbs = [];

    public function index()
    {
        $this->data['news'] = News::where('active',1)->orderBy('id','desc')->limit(3)->get();
        $this->data['sports'] = KindOfSport::where('active',1)->get();
        $this->data['trainers'] = Trainer::where('active',1)->where('best',1)->get();
        $this->data['events'] = Event::where('active',1)->get();
        $this->data['points'] = $this->findSport();
        return $this->showView('home');
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
                $request->input('sections'),
                $request->input('places')
            )
        ]);
    }

    protected function showView($view)
    {
        $this->data['seo'] = Settings::getSeoTags();

        $topMenu = [
            ['href' => '#', 'name' => trans('menu.blind_version')],
            ['href' => '#', 'name' => trans('menu.login_register'), 'addClass' => 'green'],
        ];

        $mainMenu = [
            ['data_scroll' => 'news', 'name' => trans('menu.news')],
            ['data_scroll' => 'events', 'name' => trans('menu.events')],
            ['data_scroll' => 'map', 'name' => trans('menu.map')],
            ['data_scroll' => 'trainers', 'name' => trans('menu.trainers')]
        ];
        
        $areas = Area::where('active',1)->get();
        $socnets = [
            ['icon' => 'yt', 'href' => '#'],
            ['icon' => 'fb', 'href' => '#'],
            ['icon' => 'inst', 'href' => '#'],
            ['icon' => 'ok', 'href' => '#'],
            ['icon' => 'vk', 'href' => '#']
        ]; 

        return view($view, [
//            'breadcrumbs' => $this->breadcrumbs,
            'topMenu' => $topMenu,
            'mainMenu' => $mainMenu,
            'areas' => $areas,
            'socnets' => $socnets,
            'data' => $this->data,
            'metas' => $this->metas
        ]);
    }
}
