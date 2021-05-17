<?php

namespace App\Http\Controllers;

use App\Area;
use App\Event;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kid;
use App\Trainer;
use App\News;
use App\Section;
use App\KindOfSport;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class HalfAdminController extends UserController
{
    use HelperTrait;

    protected $breadcrumbs = [];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth.admin:half');
    }

    // Gets methods
    public function index($token=null)
    {
        return redirect('/admin/users');
    }

    public function seo()
    {
        $this->breadcrumbs = ['seo' => 'SEO'];
        $this->data['metas'] = $this->metas;
        $this->data['seo'] = Settings::getSeoTags();
        return $this->showView('seo');
    }

    public function settings()
    {
        $this->breadcrumbs = ['settings' => trans('admin.settings')];
        return $this->showView('settings');
    }

    public function users(Request $request, $slug=null)
    {
        return $this->getUsers($request, new User(), $slug, 'user', new KindOfSport(), true);
    }

    public function kids(Request $request, $slug=null)
    {
        return $this->getUsers($request, new Kid(), $slug, 'kid', new User());
    }

    private function getUsers(Request $request, Model $model, $slug, $objectName, $addCollection=false, $userMode=false)
    {
        $this->breadcrumbs = [$objectName.'s' => trans('admin.'.$objectName.'s')];
        if ($request->has('id')) {
            $this->data[$objectName] = $model->find($request->input('id'));
            if (!$this->data[$objectName]) abort(404);
            if (isset($this->data[$objectName]->user_id)) $this->breadcrumbs = [
                'users' => trans('admin.users'),
                'users?id='.$this->data[$objectName]->user_id => Helper::userCreds($this->data[$objectName]->user, true)
            ];
            $this->breadcrumbs[$objectName.'s?id='.$this->data[$objectName]->id] = Helper::userCreds($this->data[$objectName], true);
            if ($addCollection) $this->data['collection'] = $addCollection->all();
            if ($userMode) {
                $this->data['free_sections'] = Section::where('trainer_id',null)->get();
                if ($this->data[$objectName]->trainer) {
                    Message::where('for_admin',1)->where('read',null)->where('trainer_id',$this->data[$objectName]->trainer->id)->update(['read' => 1]);
                }
            }
            return $this->showView($objectName);
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs[$objectName.'s/add'] = trans('admin.adding_'.$objectName);
            if ($addCollection) $this->data['collection'] = $addCollection->all();
            return $this->showView($objectName);
        } else {
            $this->data[$objectName.'s'] = $model->orderBy('id','desc')->get();
            return $this->showView($objectName.'s');
        }
    }

    public function news(Request $request, $slug=null)
    {
        $this->breadcrumbs = ['news' => trans('admin.news')];
        if ($request->has('id')) {
            $this->data['news'] = News::find($request->input('id'));
            if (!$this->data['news']) abort(404);
            $this->breadcrumbs['news?id='.$this->data['news']->id] = $this->data['news']['head_'.App::getLocale()];
            return $this->showView('news');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs['news/add'] = trans('admin.adding_news');
            return $this->showView('news');
        } else {
            $this->data['all_news'] = News::orderBy('id','desc')->get();
            return $this->showView('all_news');
        }
    }

    public function events(Request $request, $slug=null)
    {
        return $this->getObjects($request, new Event(), $slug, 'name', [new Area(), new User(), new Kid(), new KindOfSport()]);
    }
    
    public function banners()
    {
        $this->breadcrumbs = ['banners' => trans('admin.advertising_banners')];
        return $this->showView('banners');
    }

    protected function getObjects(Request $request, Model $model, $slug, $headName, $addCollection=false, $descField=false)
    {
        $objectName = substr($model->getTable(),0,-1);
        $this->breadcrumbs = [$objectName.'s' => trans('admin.'.$objectName.'s')];
        if ($request->has('id') || ($slug && $slug != 'add')) {
            $this->data['item'] = $request->has('id') ? $model->find($request->input('id')) : $model->where('slug',$slug)->first();
            if (!$this->data['item']) abort(404);

            if (isset($this->data['item']->slug)) $this->breadcrumbs[$objectName.'s/'.$this->data['item']->slug] = $this->data['item'][$headName.'_'.App::getLocale()];
            else $this->breadcrumbs[$objectName.'s?id='.$this->data['item']->id] = $this->data['item'][$headName.'_'.App::getLocale()];

            if ($addCollection) $this->getAddCollections($addCollection);
            return $this->showView($objectName);
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs[$objectName.'s/add'] = trans('admin.adding_'.$objectName);
            if ($addCollection) $this->getAddCollections($addCollection);
            return $this->showView($objectName);
        } else {
            $this->data['items'] = $descField ? $model->orderBy($descField,'desc')->get() : $model->all();
            return $this->showView($objectName.'s');
        }
    }

    protected function getAddCollections($addCollection)
    {
        if (is_array($addCollection)) {
            $this->data['collections'] = [];
            foreach ($addCollection as $collection) {
                $this->data['collections'][$collection->getTable()] = $collection->where('active',1)->get();
            }
        } else {
            $this->data['collection'] = $addCollection->where('active',1)->get();
        }
    }

    // Post methods
    public function editUser(Request $request)
    {
        $userFields = [
            'name' => $this->validationCharField,
            'surname' => $this->validationCharField,
            'family' => $this->validationCharField,
            'email' => $this->validationEmail,
            'phone' => $this->validationPhone,
            'type' => 'required|integer|'.(Gate::allows('admin') ? 'min:1' : 'min:2').'|max:4',
            'avatar' => $this->validationImage,
        ];
        $userBoolFields = ['active','send_mail'];
        $userTimeFields = ['born' => $this->validationDate];

        $trainerFields = [
            'license' => $this->validationImage,
            'about_ru' => 'max:500',
            'education_ru' => $this->validationCharField,
            'add_education_ru' => 'max:255',
            'achievements_ru' => 'max:255',
            'since' => 'required|integer|min:1900|max:'.(string)date('Y'),
            'kind_of_sport_id' => $this->validationKindOfSport
        ];

        foreach ($this->trainerSocNets as $net) {
            if ($request->input($net)) $trainerFields[$net] = $this->validationSocNets[$net];
        }
        
        $trainerBoolFields = ['best'];
        $ignoreFields = ['avatar','password','password_confirmation','trainer_active','is_trainer','new_section_id'];
        $isTrainer = $request->has('is_trainer') && $request->input('is_trainer') == 'on';
        $newSection = $request->has('new_section_id') ? $request->input('new_section_id') : false;
        
        $ignoreFieldsForUser = array_merge($ignoreFields, array_keys($trainerFields), $trainerBoolFields);
        $ignoreFieldsForTrainer = array_merge($ignoreFields, array_keys($userFields), $userBoolFields, array_keys($userTimeFields));
        
        $validationArr = $isTrainer ? array_merge($userFields, $userTimeFields, $trainerFields) : array_merge($userFields, $userTimeFields);

        $userFields = $this->processingFields($request, $userBoolFields, $ignoreFieldsForUser, array_keys($userTimeFields));
        if ($request->has('password') && $request->input('password')) $userFields['password'] = bcrypt($request->input('password'));
        if ($newSection) $trainerFields['new_section_id'] = $this->validationSection;

        // Processing user
        if ($request->has('id')) {
            $validationArr['id'] = $this->validationUser;
            $validationArr['email'] .= ','.$request->input('id');

            if ($request->input('password')) {
                $validationArr['old_password'] = 'required|min:8|max:50';
                $validationArr['password'] = $this->validationPassword;
            } else unset($userFields['password']);

            $this->validate($request, $validationArr);
            $user = User::find($request->input('id'));
            $user->update($userFields);
        } else {
            $validationArr['password'] = $this->validationPassword;
            $this->validate($request, $validationArr);
            $user = User::create($userFields);
        }

        if ($request->hasFile('avatar')) {
            $fieldAvatar = $this->processingImage($request, $user, 'avatar', 'user_avatar'.$user->id, 'images/avatars');
            $user->update($fieldAvatar);
        }

        // Processing trainer
        if ($isTrainer) {
            $trainerFields = $this->processingFields($request, $trainerBoolFields, $ignoreFieldsForTrainer);
            $trainerFields['active'] = $request->has('trainer_active') && $request->input('trainer_active') == 'on' ? 1 : 0;
            
            if ($user->trainer) {
                if (!$user->trainer->active && $trainerFields['active'] && $user->email && $user->send_mail) {
                    $this->sendMessage($user->email, 'auth.emails.trainer_request_agree', []);
                }
                $user->trainer->update($trainerFields);
                $trainer = $user->trainer;
            } else {
                $trainerFields['user_id'] = $user->id;
                $trainer = Trainer::create($trainerFields);
            }

            if ($newSection) {
                $section = Section::find($newSection);
                $section->trainer_id = $trainer->id;
                $section->save();
            }

            if ($request->hasFile('license')) {
                $fieldLicense = $this->processingImage($request, $trainer, 'license', 'license'.$trainer->id, 'images/docs');
                $trainer->update($fieldLicense);
            }

        } elseif ($user->trainer) {
            $this->unlinkFile($user->trainer, 'license');
            $user->trainer->delete();
            if ($user->email && $user->send_mail) {
                $this->sendMessage($user->email, 'auth.emails.trainer_request_rejected', []);
            }
        }

        return redirect('/admin/users')->with('message',trans('content.save_complete'));
    }

    public function editKid(Request $request)
    {
        $validationArr = [
            'name' => $this->validationCharField,
            'surname' => $this->validationCharField,
            'family' => $this->validationCharField,
            'avatar' => $this->validationImage,
            'born' => $this->validationDate,
            'user_id' => $this->validationUser
        ];

        $fields = $this->processingFields($request, 'active', 'avatar', 'born');
        // Processing user
        if ($request->has('id')) {
            $validationArr['id'] = 'required|integer|exists:kids,id';

            $this->validate($request, $validationArr);
            $kid = Kid::find($request->input('id'));
            $kid->update($fields);
        } else {
            $this->validate($request, $validationArr);
            $kid = Kid::create($fields);
        }

        if ($request->hasFile('avatar')) {
            $fields = $this->processingImage($request, $kid, 'avatar', 'kid_avatar'.$kid->id, 'images/avatars');
            $kid->update($fields);
        }
        return redirect('/admin/users?id='.$kid->user_id)->with('message',trans('content.save_complete'));
    }

    public function editNews(Request $request)
    {
        $validationArr = [
            'image' => $this->validationImage,
            'head_ru' => $this->validationCharField,
            'content_ru' => 'required|min:10|max:5000',
            'date' => $this->validationDate
        ];
        return $this->editObject($request, new News(), $validationArr, ['active'], ['image'], ['date'], 'news', 'news');
    }

    public function editEvent(Request $request)
    {
        return $this->processingEvent($request,true);
    }

    protected function editObject(Request $request, Model $model, array $validationArr, array $checkboxFields, array $ignoreFields, array $timeFields, $backUri, $imageFolder=null)
    {
        $fields = $this->processingFields($request, $checkboxFields, $ignoreFields, $timeFields);
        if ((isset($validationArr['image']) || isset($validationArr['icon'])) && $imageFolder) $imageField = isset($validationArr['image']) ? 'image' : 'icon';
        else $imageField = null;

        if ($request->has('id')) {
            $validationArr['id'] = 'required|integer|exists:'.$model->getTable().',id';
            $this->validate($request, $validationArr);
            $item = $model->find($request->input('id'));
            $item->update($fields);
        } else {
            if ($imageField) $validationArr[$imageField] = 'required|'.$validationArr[$imageField];
            $this->validate($request, $validationArr);
            $item = $model->create($fields);
        }

        if ($imageField && $request->hasFile($imageField)) {
            $userFields = $this->processingImage($request, $item, $imageField, $model->getTable().$item->id, 'images/'.$imageFolder);
            $item->update($userFields);
        }
        return redirect('/admin/'.$backUri)->with('message',trans('content.save_complete'));
    }

    public function editBanners(Request $request)
    {
        $validationArr = [];
        for ($b=1;$b<=3;$b++) {
            $field = 'banner'.$b;
            if ($request->hasFile($field)) {
                $validationArr['banner'.$b] = 'required|mimes:jpg';
            }
        }
        $this->validate($request, $validationArr);
        for ($b=1;$b<=3;$b++) {
            $field = 'banner'.$b;
            if ($request->hasFile($field)) {
                $request->file($field)->move(base_path('public/images'),$field.'.jpg');
            }
        }
        return redirect('/admin/banners')->with('message',trans('content.save_complete'));
    }

    public function deleteUser(Request $request)
    {
        return $this->deleteSomething($request, new User(), 'avatar');
    }

    public function deleteKid(Request $request)
    {
        return $this->deleteSomething($request, new Kid(), 'avatar');
    }

    public function deleteNews(Request $request)
    {
        return $this->deleteSomething($request, new News(), 'image');
    }
    
    public function showView($view, $token=null)
    {
        $menus = [
            ['href' => 'seo', 'name' => 'SEO', 'icon' => 'icon-price-tags'],
            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
            ['href' => 'users', 'name' => trans('admin.users'), 'icon' => 'icon-users', 'submenu' => [['href' => 'kids', 'name' => trans('content.children_accounts')]]],
            ['href' => 'news', 'name' => trans('admin.news'), 'icon' => 'icon-newspaper'],
            ['href' => 'events', 'name' => trans('admin.events'), 'icon' => 'icon-calendar3'],
            ['href' => 'banners', 'name' => trans('admin.advertising_banners'), 'icon' => 'icon-image3']
        ];

        if (Gate::allows('admin')) {
            $menus[] = ['href' => 'areas', 'name' => trans('admin.areas'), 'icon' => 'icon-city'];
            $menus[] = ['href' => 'organizations', 'name' => trans('admin.organizations'), 'icon' => 'icon-stamp'];
            $menus[] = ['href' => 'sections', 'name' => trans('admin.sections'), 'icon' => 'icon-pie-chart2'];
            $menus[] = ['href' => 'places', 'name' => trans('admin.places'), 'icon' => 'icon-pin-alt'];
            $menus[] = ['href' => 'kind_of_sports', 'name' => trans('admin.kind_of_sports'), 'icon' => 'icon-medal2'];
            $menus[] = ['href' => 'messages', 'name' => trans('admin.messages'), 'icon' => 'icon-bubbles4'];
        }

        return view('admin.'.$view, [
            'breadcrumbs' => $this->breadcrumbs,
            'data' => $this->data,
            'menus' => $menus,
            'messages' => Message::where('for_admin',1)->where('read',null)->get()
        ]);
    }
}