<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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
            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
        ];
//        if (Auth::guest()) {
//            $mainMenu[] = ['name' => trans('auth.login'), 'modal-data' => 'login'];
//            $mainMenu[] = ['name' => trans('auth.register'), 'modal-data' => 'register'];
//            $mainMenu[] = ['name' => trans('menu.terms_of_use'), 'href' => 'terms-of-use'];
//        } else {
//            if (count(Auth::user()->contractsCollections) || count(Auth::user()->resumesCollections))
//                $mainMenu[] = ['name' => trans('content.my_collection'), 'href' => 'collection'];
//            $mainMenu[] = ['name' => Auth::user()->type == 1 || Auth::user()->type == 3 ? trans('content.my_contracts') : trans('content.contracts'), 'href' => 'contracts'];
//            $mainMenu[] = ['name' => Auth::user()->type == 2 ? trans('content.my_resumes') : trans('content.resumes'), 'href' => 'resumes'];
//            if (Auth::user()->type == 2 && count(Auth::user()->exeContracts)) $mainMenu[] = ['name' => trans('content.my_contracts'), 'href' => 'my-contracts'];
//        }
//
//        if (!Auth::guest() && Gate::allows('contracts')) $mainMenu[] = ['name' => trans('menu.payment_details'), 'modal' => 'payment_details'];
//        if (!Auth::guest() && Auth::user()->type == 1) $mainMenu[] = ['name' => trans('menu.admin_page'), 'href' => 'admin'];

        return view($view, [
            'breadcrumbs' => $this->breadcrumbs,
            'mainMenu' => $mainMenu,
            'data' => $this->data,
            'metas' => $this->metas
        ]);
    }
}
