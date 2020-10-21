<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Gate;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

class StaticController extends Controller
{
    use HelperTrait;

    protected $data = [];
    protected $breadcrumbs = [];

    public function index()
    {
        return $this->showView('home');
    }

    public function changeLang(Request $request)
    {
        $this->validate($request, ['lang' => 'required|in:en,ru']);
        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
        return redirect()->back();
    }

    protected function showView($view)
    {
        $this->data['seo'] = Settings::getSeoTags();

        $mainMenu = [
            ['href' => 'area', 'name' => trans('menu.area'), 'icon' => 'icon-office'],
            ['href' => 'kind', 'name' => trans('menu.kind_of_sport'), 'icon' => 'icon-accessibility'],
            ['href' => 'centers', 'name' => trans('menu.sports_centers'), 'icon' => 'icon-city'],
            ['href' => 'sections', 'name' => trans('menu.sport_sections'), 'icon' => 'icon-power2'],
            ['href' => 'workouts', 'name' => trans('menu.workouts'), 'icon' => 'icon-location4'],
            ['href' => 'trainers', 'name' => trans('menu.trainers'), 'icon' => 'icon-trophy3'],
            ['href' => 'groups', 'name' => trans('menu.age_groups'), 'icon' => 'icon-users4'],
        ];

        $adminMenu = [];
        if (Helper::isAdmin()) {
            $adminMenu[] = ['href' => 'users', 'name' => trans('menu.admin_users'), 'icon' => 'icon-users2'];
        }

        return view($view, [
            'breadcrumbs' => $this->breadcrumbs,
            'mainMenu' => $mainMenu,
            'adminMenu' => $adminMenu,
            'data' => $this->data,
            'metas' => $this->metas
        ]);
    }
}
