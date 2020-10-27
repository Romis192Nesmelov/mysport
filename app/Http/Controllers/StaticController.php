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
            ['href' => 'news', 'name' => trans('menu.news'), 'icon' => 'icon-newspaper'],
            ['href' => 'map', 'name' => trans('menu.map'), 'icon' => 'icon-location4'],
            ['href' => 'events', 'name' => trans('menu.events'), 'icon' => ' icon-calendar'],
            ['href' => 'trainers', 'name' => trans('menu.trainers'), 'icon' => 'icon-trophy3']
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
