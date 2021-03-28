<?php

namespace App\Http\Controllers;

use App\User;
use App\Kid;
use App\Event;
use App\EventsRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Helper;

class UserController extends StaticController
{
    use HelperTrait;

    protected $directionsFields = [];
    protected $ignoreFields = [];
    protected $executorsIds = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.creds');
    }

    public function profile(Request $request)
    {
        if (Gate::allows('trainer')) $this->data['events'] = Event::where('trainer_id',Auth::user()->trainer->id)->orderBy('start_time','desc')->paginate(6);
        return $this->showView($request, 'profile');
    }

    public function editProfile(Request $request)
    {
        $validationArr = [
            'email' => $this->validationEmail . ',' . Auth::id(),
            'phone' => $this->validationPhone,
            'name' => $this->validationCharField,
            'surname' => $this->validationCharField,
            'family' => $this->validationCharField,
            'born' => $this->validationDate,
            'gender' => $this->validationGender,
            'avatar' => $this->validationImage
        ];

        $ignoringFieldsForAll = ['avatar', 'password', 'password_confirmation'];
        $ignoringFieldsForUser = ['about_me', 'education_ru', 'add_education_ru', 'achievements', 'since'];
        $ignoringFieldsForTrainer = ['email', 'phone', 'name', 'surname', 'family', 'born', 'gender'];

        if (Gate::allows('trainer')) {
            $validationArr['about_me'] = 'max:1000';
            $validationArr['education_ru'] = 'required|min:5|max:255';
            $validationArr['add_education_ru'] = 'max:255';
            $validationArr['achievements'] = 'max:255';
            $validationArr['since'] = 'required|integer|min:1970|max:' . (int)date('Y');
        }

        $fieldsUser = $this->processingFields($request, 'send_mail', array_merge($ignoringFieldsForAll, $ignoringFieldsForUser));
        $fieldsUser['gender'] = $this->setGender($fieldsUser['gender']);

        if (!$fieldsUser['born'] = $this->setBornDate($fieldsUser['born']))
            return redirect()->back()->withInput()->withErrors(['born' => trans('validation.invalid_date')]);

        if ($request->has('password') && $request->input('password')) {
            $fieldsUser['password'] = bcrypt($request->input('password'));
            $validationArr['old_password'] = 'required|min:4|max:50';
            $validationArr['password'] = $this->validationPassword;
        }

        $this->validate($request, $validationArr);
        $user = User::find(Auth::id());
        $user->update($fieldsUser);

        if ($request->hasFile('avatar')) {
            $fieldsUser = $this->processingImage($request, $user, 'avatar', 'user_avatar' . $user->id, 'images/avatars');
            $user->update($fieldsUser);
        }

        if (Gate::allows('trainer')) {
            $fieldsTrainer = $this->processingFields($request, null, array_merge($ignoringFieldsForAll, $ignoringFieldsForTrainer));
            $user->trainer->update($fieldsTrainer);
        }
        return redirect('/profile')->with('message', trans('content.save_complete'));
    }

    public function events(Request $request, $slug = null)
    {
        if (!$slug || $slug != 'add') {
            $this->getItem($request, new Event(), $slug);
            if (Gate::denies('owner', $this->data['item'])) abort(403);
            $this->data['points'] = [[$this->data['item']]];
        } elseif (Gate::denies('trainer')) abort(403);
        $this->getEventOnTheYear(true,false);
        return $this->showView($request, 'edit_event');
    }

    public function editEvent(Request $request)
    {
        $validationArr = [
            'name_ru' => $this->validationCharField,
            'description_ru' => 'required|min:3|max:700',
            'date' => $this->validationDate,
            'start_time' => $this->validationTime,
            'end_time' => $this->validationTime,
            'address_ru' => $this->validationCharField,
            'latitude' => $this->validationCoordinates,
            'longitude' => $this->validationCoordinates,
            'area_id' => $this->validationArea,
            'age_group' => 'required|integer|min:1|max:'.count(Helper::ageGroups())
        ];

        if ($request->has('id')) $validationArr['id'] = $this->validationEvent;
        $this->validate($request, $validationArr);

        $fields = $this->processingFields($request, null, ['date','start_time','end_time']);
        $date = $this->convertDate($request->input('date'));
        $startTime = $this->convertTime($request->input('start_time'));
        $endTime = $this->convertTime($request->input('end_time'));
        $fields['start_time'] = $this->getMoscowTimeZone($date + $startTime);
        $fields['end_time'] = $this->getMoscowTimeZone($date + $endTime);

        $errors = [];
        if ($startTime > $endTime) $errors['start_time'] = trans('validation.invalid_time');
        if ((int)$fields['latitude'] < 59 || (int)$fields['latitude'] > 60) $errors['latitude'] = trans('validation.invalid_coordinates');
        if ((int)$fields['longitude'] < 29 || (int)$fields['longitude'] > 31) $errors['latitude'] = trans('validation.invalid_coordinates');

        if (count($errors)) return redirect()->back()->withInput()->withErrors($errors);

        if ($request->has('id')) {
            $event = Event::find($request->input('id'));
            $event->update($fields);
        } else {
            $fields['trainer_id'] = Auth::user()->trainer->id;
            Event::create($fields);
        }
        return redirect('/profile')->with('message', trans('content.save_complete'));
    }

//    public function deleteProfile()
//    {
//        $user = Auth::user();
//        $user->active = 0;
//        $user->save();
//        Auth::logout();
//        return redirect('/')->with('message', trans('auth.account_has_been_deleted'));
//    }

    public function child(Request $request)
    {
        if ($request->has('id')) {
            $this->data['kid'] = Kid::find($request->input('id'));
            if (!$this->data['kid']) abort(404);
        }
        return $this->showView($request,'child');
    }
    
    public function editChild(Request $request)
    {
        $validationArr = [
            'name' => $this->validationCharField,
            'surname' => $this->validationCharField,
            'family' => $this->validationCharField,
            'born' => $this->validationDate,
            'gender' => $this->validationGender,
            'avatar' => $this->validationImage
        ];

        $fields = $this->processingFields($request, 'active', 'avatar');
        $fields['gender'] = $this->setGender($fields['gender']);
        if (!$fields['born'] = $this->setBornDate($fields['born'], true))
            return redirect()->back()->withInput()->withErrors(['born' => trans('validation.invalid_date')]);
        $fields['user_id'] = Auth::id();

        if ($request->has('id')) {
            $validationArr['id'] = $this->validationUser;
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
        return redirect('/profile')->with('message',trans('content.save_complete'));
    }
    
    public function deleteChild(Request $request)
    {
        return $this->deleteSomething($request, new Kid(), 'avatar');
    }
    
    public function eventUserRecord(Request $request)
    {
        $this->validate($request, ['id' => $this->validationEvent]);
        $recordId = $request->input('id');
        $record = EventsRecord::where('event_id',$recordId)->where('user_id',Auth::id())->first();
        if ($record) {
            $record->delete();
            $message = trans('content.record_canceled');
        } else {
            EventsRecord::create([
                'user_id' => Auth::id(),
                'event_id' => $recordId
            ]);
            $message = trans('content.you_are_record');
        }
        return redirect()->back()->with('message',$message);
    }

    public function eventKidsRecord(Request $request)
    {
        $this->validate($request, ['id' => $this->validationEvent]);
        $cancelRecords = 0;
        $createRecords = 0;
        $kidsCount = count(Auth::user()->kids);
        $fields = $this->processingFields($request);
        $recordId = $request->input('id');

        foreach (Auth::user()->kids as $kid) {
            $record = EventsRecord::where('event_id',$recordId)->where('kid_id',$kid->id)->first();
            if ($record && !$fields['kid'.$kid->id]) {
                $cancelRecords++;
                $record->delete();
            } elseif (!$record && $fields['kid'.$kid->id]) {
                $createRecords++;
                EventsRecord::create([
                    'kid_id' => $kid->id,
                    'event_id' => $recordId
                ]);
            }
        }
        if ($cancelRecords == $kidsCount) $message = $cancelRecords == 1 ? trans('content.record_canceled') : trans('content.records_canceled');
        elseif ($createRecords == $kidsCount) $message = $cancelRecords == 1 ? trans('content.your_kid_is_record') : trans('content.your_kids_are_record');
        else $message = $kidsCount == 1 ? trans('content.record_updated') : trans('content.records_updated');

        return redirect()->back()->with('message',$message);
    }
    
    private function setGender($gender)
    {
        return $gender == 'M' || $gender == 'М' ? 1 : 0;
    }
    
    private function setBornDate($born, $checkKid=false)
    {
        $bornDate = explode('.',$born);
        $day = (int)$bornDate[0];
        $month = (int)$bornDate[1];
        $year = (int)$bornDate[2];
        $maxDaysInMonth = Helper::getNumberDaysInMonth($month, $year);
        $checkKid = $checkKid ? $year < (int)date('Y') - 19 : false;

        if ($checkKid || $day > $maxDaysInMonth) return false;
        else return strtotime($month.'/'.$day.'/'.$year);
    }
}
