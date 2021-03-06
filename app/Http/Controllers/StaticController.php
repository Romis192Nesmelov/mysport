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
use App\Event;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

class StaticController extends Controller
{
    use HelperTrait;

    protected $data = [];
//    protected $breadcrumbs = [];

    public function index(Request $request)
    {
        $this->data['news'] = News::where('active',1)->orderBy('id','desc')->limit(3)->get();
        $this->data['trainers'] = Trainer::where('active',1)->where('best',1)->get();
        $this->data['points'] = $this->findSport();
        $this->data['year'] = date('Y');
        $limitInPast = strtotime('1/1/'.$this->data['year']);
        $limitInFuture = date('n') <= 10 ? strtotime('12/31/'.$this->data['year']) : strtotime((date('n')+4-12).'1/'.($this->data['year']+1));
        $this->data['events_on_year'] = Event::where('active',1)->where('start_time','>=',$limitInPast)->where('start_time','<=',$limitInFuture)->get();
        $this->data['events'] = Event::where('active',1)->orderBy('id','desc')->limit(5)->get();
        return $this->showView($request,'home');
    }

    public function area(Request $request,$slug=null)
    {
        $this->getItem($request, new Area(), $slug);
        $this->data['area_id'] = $this->data['item']->id;
        $this->data['points'] = $this->findSport($this->data['item']->id);
        return $this->showView($request,'area');
    }

    public function events(Request $request,$slug=null)
    {
        $this->getItem($request, new Event(), $slug);
        $this->data['area_id'] = $this->data['item']->area->id;
        $this->data['points'] =
            [
                'events' => [$this->data['item']],
                'organizations' => null,
                'sections' => null,
                'places' => null
            ];
        return $this->showView($request,'event');
    }
    
    public function organization(Request $request,$slug=null)
    {
        return $this->getObject($request, new Organization(), $slug);
    }

    public function section(Request $request,$slug=null)
    {
        return $this->getObject($request, new Section(), $slug);
    }

    public function place(Request $request)
    {

    }
    
    public function trainers(Request $request)
    {
        
    }
    
    public function kindOfSport(Request $request)
    {
        
    }

    private function getItem(Request $request, Model $model, $slug)
    {
        if ($slug) {
            $this->data['item'] = $model->where('slug',$slug)->first();
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
            $this->data['item'] = $model->find($request->input('id'));
        }
        if (!$this->data['item']) abort(404);
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

        return $this->showView($request,'object');
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

    protected function showView(Request $request, $view)
    {
        $this->data['seo'] = Settings::getSeoTags();
        $blindVer = $request->has('blind') && $request->input('blind');

        $topMenu = [
            ['href' => '?blind='.($blindVer ? '0' : '1'), 'name' => $blindVer ? trans('menu.normal_version') : trans('menu.blind_version')],
            ['href' => '#', 'name' => trans('menu.login_register'), 'addClass' => 'green'],
        ];

        $mainMenu = [
            ['data_scroll' => 'news', 'name' => trans('menu.news')],
            ['data_scroll' => 'events', 'name' => trans('menu.events')],
            ['data_scroll' => 'map', 'name' => trans('menu.map')],
            ['data_scroll' => 'trainers', 'name' => trans('menu.trainers')]
        ];
        
        $areas = Area::where('active',1)->get();
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
            'blindVer' => $blindVer,
            'topMenu' => $topMenu,
            'mainMenu' => $mainMenu,
            'areas' => $areas,
            'sports' => $sports,
            'socnets' => $socnets,
            'data' => $this->data,
            'metas' => $this->metas
        ]);
    }
}
