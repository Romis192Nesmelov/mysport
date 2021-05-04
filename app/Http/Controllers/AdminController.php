<?php

namespace App\Http\Controllers;

use App\EventsRecord;
use App\Message;
use App\SectionsRecord;
use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kid;
use App\Trainer;
use App\News;
use App\Area;
use App\Organization;
use App\Section;
use App\KindOfSport;
use App\Event;
use App\Place;
use App\Gallery;
use App\Messa;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\App;

class AdminController extends UserController
{
    use HelperTrait;

    private $breadcrumbs = [];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth.admin');
    }

    // Get block
    public function index($token=null)
    {
        return redirect('/admin/users');
    }

    public function seo(Request $request)
    {
        $this->breadcrumbs = ['seo' => 'SEO'];
        $this->data['metas'] = $this->metas;
        $this->data['seo'] = Settings::getSeoTags();
        return $this->showView('seo');
    }

    public function settings(Request $request)
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
    
    public function areas(Request $request, $slug=null)
    {
        return $this->getObjects($request, new Area(), $slug, 'name');
    }

    public function organizations(Request $request, $slug=null)
    {
        return $this->getObjects($request, new Organization(), $slug, 'name', new Area());
    }

    public function sections(Request $request, $slug=null)
    {
        return $this->getObjects($request, new Section(), $slug, 'name', [new User(), new Kid(), new Trainer()]);
    }

    public function places(Request $request, $slug=null)
    {
        return $this->getObjects($request, new Place(), $slug, 'name', [new KindOfSport(), new Area()]);
    }

    public function kindOfSports(Request $request)
    {
        return $this->getObjects($request, new KindOfSport(), null, 'name');
    }
    
    public function banners()
    {
        $this->breadcrumbs = ['banners' => trans('admin.advertising_banners')];
        return $this->showView('banners');
    }

    public function messages()
    {
        $this->breadcrumbs = ['banners' => trans('admin.messages')];
        $this->data['messages'] = Message::orderBy('created_at','desc')->get();
        return $this->showView('messages');
    }

    private function getObjects(Request $request, Model $model, $slug, $headName, $addCollection=false, $descField=false)
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
    
    private function getAddCollections($addCollection)
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

    // Post block
    public function editSeo(Request $request)
    {
        $this->validate($request, [
            'title_ru' => $this->validationCharField,
            'meta_description' => 'max:4000',
            'meta_keywords' => 'max:4000',
            'meta_twitter_card' => 'max:255',
            'meta_twitter_size' => 'max:255',
            'meta_twitter_creator' => 'max:255',
            'meta_og_url' => 'max:255',
            'meta_og_type' => 'max:255',
            'meta_og_title' => 'max:255',
            'meta_og_description' => 'max:4000',
            'meta_og_image' => 'max:255',
            'meta_robots' => 'max:255',
            'meta_googlebot' => 'max:255',
            'meta_google_site_verification' => 'max:255',
        ]);
        Settings::saveSeoTags($request);
        return redirect('/admin/seo')->with('message',trans('content.save_complete'));
    }

    public function editSettings(Request $request)
    {
        $this->validate($request, [
            'email' => $this->validationNoUniqueEmail
        ]);
        Settings::saveSettings($this->processingFields($request));
        return redirect()->back()->with('message',trans('content.save_complete'));
    }
    
    public function editUser(Request $request)
    {
        $userFields = [
            'name' => $this->validationCharField,
            'surname' => $this->validationCharField,
            'family' => $this->validationCharField,
            'email' => $this->validationEmail,
            'phone' => $this->validationPhone,
            'type' => 'required|integer|min:1|max:3',
            'avatar' => $this->validationImage,
        ];
        $userBoolFields = ['active','send_mail'];
        $userTimeFields = ['born' => $this->validationDate];

        $trainerFields = [
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
            $userFields = $this->processingImage($request, $user, 'avatar', 'user_avatar'.$user->id, 'images/avatars');
            $user->update($userFields);
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

        } elseif ($user->trainer) {
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

    public function editArea(Request $request)
    {
        $validationArr = [
            'image' => $this->validationImage,
            'name_ru' => $this->validationCharField,
            'description_ru' => 'max:1500',
            'leader_ru' => 'max:255',
        ];

        if ($request->has('phone')) $validationArr['phone'] = $this->validationPhone;
        if ($request->has('email')) $validationArr['email'] = $this->validationNoUniqueEmail;

        return $this->editObject($request, new Area(), $validationArr, ['active'], ['image'], [], 'areas', 'arms');
    }

    public function editOrganization(Request $request)
    {
        $validationArr = [
            'image' => $this->validationImage,
            'name_ru' => $this->validationCharField,
            'description_ru' => $this->validationTextField,
            'leader_ru' => $this->validationCharField,
            'address_ru' => $this->validationTextField,
            'latitude' => $this->validationCoordinates,
            'longitude' => $this->validationCoordinates,
            'phone' => $this->validationPhone,
            'email' => $this->validationNoUniqueEmail,
            'schedule' => 'max:255',
            'area_id' => $this->validationArea
        ];

        if ($request->has('site')) $validationArr['site'] = $this->validationSite;
        return $this->editObject($request, new Organization(), $validationArr, ['active'], ['image'], [], 'organizations', 'objects');
    }

    public function editSection(Request $request)
    {
        $validationArr = [
            'image' => $this->validationImage,
            'name_ru' => $this->validationCharField,
            'description_ru' => $this->validationTextField,
            'address_ru' => $this->validationTextField,
            'latitude' => $this->validationCoordinates,
            'longitude' => $this->validationCoordinates,
            'phone' => $this->validationPhone,
            'email' => $this->validationNoUniqueEmail,
            'schedule' => 'max:255'
        ];

        if ($request->has('trainer_id') && $request->input('trainer_id')) $validationArr['trainer_id'] = $this->validationTrainer;
        if ($request->has('site') && $request->input('site')) $validationArr['site'] = $this->validationSite;
        return $this->editObject($request, new Section(), $validationArr, ['active'], ['image'], [], 'sections', 'objects');
    }

    public function editPlace(Request $request)
    {
        $validationArr = [
            'image' => $this->validationImage,
            'name_ru' => $this->validationCharField,
            'description_ru' => $this->validationTextField,
            'address_ru' => $this->validationCharField,
            'latitude' => $this->validationCoordinates,
            'longitude' => $this->validationCoordinates,
            'area_id' => $this->validationArea
        ];

        list($ignoreFields,$sportsFields,$sportSelectedFlag) = $this->setSportsAndIgnoreFields($request, ['image'], true);
        $fields = $this->processingFields($request, 'active', $ignoreFields);

        $errors = [];
        if (!$sportSelectedFlag) $errors['kind_of_sports'] = trans('validation.one_of_kind_of_sport_must_be_selected');
        if ((int)$fields['latitude'] < 59 || (int)$fields['latitude'] > 60) $errors['latitude'] = trans('validation.invalid_coordinates');
        if ((int)$fields['longitude'] < 29 || (int)$fields['longitude'] > 31) $errors['latitude'] = trans('validation.invalid_coordinates');

        if (count($errors)) return redirect()->back()->withInput()->withErrors($errors);

        if ($request->has('id')) {
            $validationArr['id'] = $this->validationPlace;
            $this->validate($request, $validationArr);
            $place = Place::find($request->input('id'));
            $place->update($fields);
        } else {
            $this->validate($request, $validationArr);
            $place = Place::create($fields);
        }

        if ($request->hasFile('image')) {
            $fields = $this->processingImage($request, $place, 'image', 'place'.$place->id, 'images/objects');
            $place->update($fields);
        }
        $this->linkKindOfSports($request, $place, new Sport(), $sportsFields, 'place_id');

        return redirect('/admin/places')->with('message', trans('content.save_complete'));
    }

    public function editKindOfSports(Request $request)
    {
        $validationArr = [
            'icon' => $this->validationImage,
            'name_ru' => $this->validationCharField,
            'description_ru' => $this->validationTextField,
            'recommendation_ru' => $this->validationTextField,
            'needed_ru' => $this->validationTextField,
        ];
        return $this->editObject($request, new KindOfSport(), $validationArr, ['active'], ['icon'], [], 'kind_of_sports', 'sports_icons');
    }

    public function editEvent(Request $request)
    {
        return $this->processingEvent($request,true);
    }

    private function editObject(Request $request, Model $model, array $validationArr, array $checkboxFields, array $ignoreFields, array $timeFields, $backUri, $imageFolder=null)
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

    public function editGallery(Request $request)
    {
        $this->validate($request, [
            'model' => 'required|in:area,organization,section,place',
            'id' => 'required|integer|exists:'.$request->input('model').'s,id'
        ]);
        $foreignKey = $request->input('model').'_id';
        $modelId = $request->input('id');
        $galleryFolder = 'images/galleries';

        $gallery = Gallery::where($foreignKey, $modelId)->get();
        foreach ($gallery as $item) {
            $photoFieldName = 'photo'.$item->id;
            if ($request->hasFile($photoFieldName)) {
                $field = $this->processingImage($request, $item, $photoFieldName, 'gallery'.$item->id, $galleryFolder);
                $item->update($field);
            }
        }

        if ($request->hasFile('add_photo')) {
            $item = Gallery::create([
                'photo' => '',
                $foreignKey => $modelId
            ]);
            $field = $this->processingImage($request, $item, 'add_photo', 'gallery'.$item->id, $galleryFolder);
            $item->update(['photo' => $field['add_photo']]);
        }
        return redirect()->back()->with('message',trans('content.save_complete'));
    }
    
    public function recordEventUser(Request $request)
    {
        return $this->recordUser($request, new EventsRecord(), new User(), 'user_id', 'event_id');
    }

    public function recordEventKid(Request $request)
    {
        return $this->recordUser($request, new EventsRecord(), new User(), 'kid_id', 'event_id');
    }

    public function recordSectionUser(Request $request)
    {
        return $this->recordUser($request, new SectionsRecord(), new User(), 'user_id', 'section_id');
    }
    
    public function recordSectionKid(Request $request)
    {
        return $this->recordUser($request, new SectionsRecord(), new User(), 'kid_id', 'section_id');
    }
    
    private function recordUser(Request $request, Model $modelRecord, Model $modelUser, $userField, $itemField)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:'.$modelRecord->getTable().',id',
            'user_id' => 'required|integer|exists:'.$modelUser->getTable().',id',
        ]);
        $itemId = $request->input('id');
        $userId = $request->input('user_id');
        $user = User::find($userId);
        
        $record = $modelRecord->where($userField,$userId)->where($itemField,$itemId)->first();
        if ($record) return redirect()->back()->with('message',trans('admin.account_already_recorded'));
        else {
            $modelRecord->create([
                $userField => $userId,
                $itemField => $itemId
            ]);

            if ($modelRecord instanceof EventsRecord) {
                $isEvent = true;
                $owner = $modelRecord->event->user;
                $mailModel = $modelRecord->event;
            } else {
                $isEvent = false;
                $owner = $modelRecord->section->leader->user;
                $mailModel = $modelRecord->section;
            }

            $this->sendRecordsEmails($user, $owner, $mailModel, true, $isEvent, $userField == 'kid_id');
            return redirect()->back()->with('message',trans('admin.record_complete'));
        }
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

    public function deleteArea(Request $request)
    {
        $this->validate($request, ['id' => $this->validationArea]);
        $area = Area::find($request->input('id'));
        if (!count($area->events) && !count($area->organizations) && !count($area->sections) && !count($area->places))
            return $this->deleteSomething($request, $area, 'image', null, true);
        else return response()->json(['success' => false]);
    }
    
    public function deleteOrganizations(Request $request)
    {
        $this->validate($request, ['id' => $this->validationOrganization]);
        $organization = Organization::find($request->input('id'));
        if (!count($organization->sections))
            return $this->deleteSomething($request, $organization, 'image', null, true);
        else return response()->json(['success' => false]);
    }

    public function deleteSection(Request $request)
    {
        return $this->deleteSomething($request, new Section(), 'image');
    }

    public function deletePlace(Request $request)
    {
        return $this->deleteSomething($request, new Place());
    }

    public function deleteKindOfSports(Request $request)
    {
        $this->validate($request, ['id' => $this->validationKindOfSport]);
        $sport = KindOfSport::find($request->input('id'));
        if (!count($sport->allTrainers) && !count($sport->allSections) && !count($sport->events) && !count($sport->places))
            return $this->deleteSomething($request, $sport, 'icon', null, true);
        else return response()->json(['success' => false]);
    }

    public function deleteEvent(Request $request)
    {
        return $this->deleteSomething($request, new Event());
    }

    public function deleteMessage(Request $request)
    {
        return $this->deleteSomething($request, new Message());
    }
    
//    public function deleteRecordEvent(Request $request)
//    {
//        return $this->deleteSomething($request, new EventsRecord());
//    }
//
//    public function deleteRecordSection(Request $request)
//    {
//        return $this->deleteSomething($request, new SectionsRecord());
//    }

    public function deleteGallery(Request $request)
    {
        return $this->deleteSomething($request, new Gallery(), 'photo');
    }
    
    public function showView($view, $token=null)
    {
        $menus = [
            ['href' => 'seo', 'name' => 'SEO', 'icon' => 'icon-price-tags'],
            ['href' => 'settings', 'name' => trans('admin.settings'), 'icon' => 'icon-gear'],
            ['href' => 'users', 'name' => trans('admin.users'), 'icon' => 'icon-users', 'submenu' => [['href' => 'kids', 'name' => trans('content.children_accounts')]]],
            ['href' => 'news', 'name' => trans('admin.news'), 'icon' => 'icon-newspaper'],
            ['href' => 'areas', 'name' => trans('admin.areas'), 'icon' => 'icon-city'],
            ['href' => 'organizations', 'name' => trans('admin.organizations'), 'icon' => 'icon-stamp'],
            ['href' => 'sections', 'name' => trans('admin.sections'), 'icon' => 'icon-pie-chart2'],
            ['href' => 'places', 'name' => trans('admin.places'), 'icon' => 'icon-pin-alt'],
            ['href' => 'kind_of_sports', 'name' => trans('admin.kind_of_sports'), 'icon' => 'icon-medal2'],
            ['href' => 'events', 'name' => trans('admin.events'), 'icon' => 'icon-calendar3'],
            ['href' => 'messages', 'name' => trans('admin.messages'), 'icon' => 'icon-bubbles4'],
            ['href' => 'banners', 'name' => trans('admin.advertising_banners'), 'icon' => 'icon-image3'],
        ];

        return view('admin.'.$view, [
            'breadcrumbs' => $this->breadcrumbs,
            'data' => $this->data,
            'menus' => $menus,
            'messages' => Message::where('for_admin',1)->where('read',null)->get()
        ]);
    }
}