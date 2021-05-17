<?php

namespace App\Http\Controllers;

use App\EventsRecord;
use App\SectionsRecord;
use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kid;
use App\Trainer;
use App\Area;
use App\Organization;
use App\Section;
use App\KindOfSport;
use App\Event;
use App\Place;
use App\Gallery;
use App\Message;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\App;

class AdminController extends HalfAdminController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth.admin:admin');
    }

    // Gets methods
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

    public function messages()
    {
        $this->breadcrumbs = ['banners' => trans('admin.messages')];
        $this->data['messages'] = Message::orderBy('created_at','desc')->get();
        return $this->showView('messages');
    }

    // Posts methods
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
}