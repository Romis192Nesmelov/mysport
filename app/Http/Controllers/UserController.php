<?php

namespace App\Http\Controllers;

use App\EventSport;
use App\Section;
use App\User;
use App\Trainer;
use App\Kid;
use App\Event;
use App\EventsRecord;
use App\SectionsRecord;
use App\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Helper;
use Illuminate\Support\Facades\Settings;

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
        if (Gate::allows('trainer') || Gate::allows('organizer')) $this->data['events'] = Event::where('user_id',Auth::id())->orderBy('start_time','desc')->paginate(12);
        $this->data['free_sections'] = Section::where('trainer_id',null)->get();
        return $this->showView('profile');
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

        $ignoringFieldsForAll = ['avatar', 'password', 'password_confirmation','new_section_id','trainer_request'];
        $ignoringFieldsForUser = ['license', 'add_doc', 'about_ru', 'education_ru', 'add_education_ru', 'achievements', 'since'];
        $ignoringFieldsForTrainer = ['email', 'phone', 'name', 'surname', 'family', 'born', 'gender'];
        $trainerRequest = $request->has('trainer_request') && (int)$request->input('trainer_request');
        $masterMail = (string)Settings::getSettings()->email;

        if (Auth::user()->trainer || $trainerRequest) {
            $validationArr['license'] = ($trainerRequest && !Auth::user()->trainer->license ? 'required|' : '').$this->validationImage;
            $validationArr['add_doc'] = $this->validationImage;
            $validationArr['about_ru'] = 'max:1000';
            $validationArr['education_ru'] = 'required|min:5|max:255';
            $validationArr['add_education_ru'] = 'max:255';
            $validationArr['achievements'] = 'max:255';
            $validationArr['since'] = 'required|integer|min:1970|max:'.(int)date('Y');

            foreach ($this->trainerSocNets as $net) {
                if ($request->input($net)) $validationArr[$net] = $this->validationSocNets[$net];
            }
        }

        $fieldsUser = $this->processingFields($request, null, array_merge($ignoringFieldsForAll, $ignoringFieldsForUser));
        $fieldsUser['gender'] = $this->setGender($fieldsUser['gender']);
        $newSection = $trainerRequest && $request->has('new_section_id') ? $request->input('new_section_id') : false;
        if ($newSection) $validationArr['new_section_id'] = $this->validationSection;

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
            $fieldAvatar = $this->processingImage($request, $user, 'avatar', 'user_avatar'.$user->id, 'images/avatars');
            $user->update($fieldAvatar);
        }

        if (Auth::user()->trainer && Gate::denies('trainer') && !$trainerRequest) {
            $message = Message::where('trainer_id',Auth::user()->trainer->id)->first();
            $message->delete();

            $this->sendMessage(
                $masterMail,
                'auth.emails.trainer_request',
                ['head' => trans('mail.trainer_request_withdrawn'), 'user' => Auth::user()],
                Auth::user()->email && Auth::user()->send_mail ? Auth::user()->email : null
            );

            Auth::user()->trainer->delete();

        } elseif (Auth::user()->trainer || $trainerRequest) {
            $fieldsTrainer = $this->processingFields($request, null, array_merge($ignoringFieldsForAll, $ignoringFieldsForTrainer));

            if (Auth::user()->trainer) {
                $user->trainer->update($fieldsTrainer);
                $trainer = $user->trainer;
            } else {
                $fieldsTrainer['active'] = 0;
                $fieldsTrainer['user_id'] = Auth::id();
                $trainer = Trainer::create($fieldsTrainer);

                Message::create([
                    'for_admin' => true,
                    'trainer_id' => $trainer->id
                ]);

                $this->sendMessage(
                    $masterMail,
                    'auth.emails.trainer_request',
                    ['head' => trans('mail.new_trainer_request'), 'user' => $trainer->user],
                    $trainer->user->email && $trainer->user->send_mail ? $trainer->user->email : null
                );
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

            if ($request->hasFile('add_doc')) {
                $fieldAddDoc = $this->processingImage($request, $trainer, 'add_doc', 'add_doc'.$trainer->id, 'images/docs');
                $trainer->update($fieldAddDoc);
            }
        }
        return redirect('/profile')->with('message', trans('content.save_complete'));
    }

    public function events(Request $request, $slug = null)
    {
        if (!$slug || $slug != 'add') {
            $this->getItem($request, new Event(), $slug);
            if (Gate::denies('owner', $this->data['item'])) abort(403);
            $this->data['points'] = [[$this->data['item']]];
        } elseif (Gate::denies('trainer') && Gate::denies('organizer')) abort(403);
        $this->getEventOnTheYear(true,false);
        return $this->showView('edit_event');
    }

    public function editEvent(Request $request)
    {
        return $this->processingEvent($request);
    }
    
    protected function processingEvent(Request $request, $adminMode=false)
    {
        if (Gate::denies('trainer') && Gate::denies('organizer') && !$adminMode) abort(403);
        $validationArr = [
            'name_ru' => $this->validationCharField,
            'description_ru' => $this->validationTextField,
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
        if ($adminMode) $validationArr['user_id'] = $this->validationUser;
        
        list($ignoreFields,$sportsFields,$sportSelectedFlag) = $this->setSportsAndIgnoreFields($request, ['date','start_time','end_time'], $adminMode);

        $this->validate($request, $validationArr);
        $fields = $this->processingFields($request, ($adminMode ? 'active' : null), $ignoreFields);
        
        $date = $this->convertDate($request->input('date'));
        $startTime = $this->convertTime($request->input('start_time'));
        $endTime = $this->convertTime($request->input('end_time'));
        $fields['start_time'] = $this->getMoscowTimeZone($date + $startTime);
        $fields['end_time'] = $this->getMoscowTimeZone($date + $endTime);

        $errors = [];
        if (!$sportSelectedFlag) $errors['kind_of_sports'] = trans('validation.one_of_kind_of_sport_must_be_selected');
        if ($startTime > $endTime) $errors['start_time'] = trans('validation.invalid_time');
        if ((int)$fields['latitude'] < 59 || (int)$fields['latitude'] > 60) $errors['latitude'] = trans('validation.invalid_coordinates');
        if ((int)$fields['longitude'] < 29 || (int)$fields['longitude'] > 31) $errors['latitude'] = trans('validation.invalid_coordinates');

        if (count($errors)) return redirect()->back()->withInput()->withErrors($errors);

        if ($request->has('id')) {
            $event = Event::find($request->input('id'));
            if (Gate::denies('owner',$event) && !$adminMode) abort(403);
            $event->update($fields);
        } else {
            if (!$adminMode) $fields['user_id'] = Auth::id();
            $event = Event::create($fields);
        }
        $this->linkKindOfSports($request, $event, new EventSport(), $sportsFields, 'event_id');
        
        return redirect($adminMode ? '/admin/events' : '/profile')->with('message', trans('content.save_complete'));
    }
    
    protected function setSportsAndIgnoreFields(Request $request, $ignoreFields, $checkboxMode=false)
    {
        $sportsFields = [];
        $sportSelectedFlag = false;
        $sports = $this->getActiveKindOfSport();
        foreach ($sports as $sport) {
            $fieldName = 'sport'.$sport->id;
            $fieldValue = $checkboxMode ? $request->input($fieldName) == 'on' : (bool)$request->input($fieldName);
            $ignoreFields[] = $fieldName;
            $sportsFields[] = ['id' => (int)$sport->id, 'value' => $fieldValue];
            if ($fieldValue) $sportSelectedFlag = true;
        }
        return [$ignoreFields,$sportsFields,$sportSelectedFlag];
    }
    
    protected function linkKindOfSports(Request $request, Model $baseModel, Model $foreignModel, $sportsFields, $foreignKey)
    {
        if ($request->has('id')) {
            foreach ($sportsFields as $field) {
                $matchFlag = false;
                foreach ($baseModel->sports as $eventSport) {
                    if ($field['id'] == $eventSport->kind_of_sport_id) {
                        $matchFlag = true;
                        if (!$field['value']) {
                            $eventSport->delete();
                        }
                    }
                }
                if (!$matchFlag && $field['value']) {
                    $foreignModel->create([
                        $foreignKey => $baseModel->id,
                        'kind_of_sport_id' => $field['id']
                    ]);
                }
            }
        } else {
            foreach ($sportsFields as $field) {
                if ($field['value']) {
                    $foreignModel->create([
                        $foreignKey => $baseModel->id,
                        'kind_of_sport_id' => $field['id']
                    ]);
                }
            }
        }
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
        return $this->showView('child');
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
        return $this->userRecord($request, new EventsRecord(), new Event(), 'event_id');
    }

    public function eventKidsRecord(Request $request)
    {
        return $this->kidRecord($request, new EventsRecord(), ['id' => $this->validationEvent], 'event_id');
    }

    public function sectionUserRecord(Request $request)
    {
        return $this->userRecord($request, new SectionsRecord(), new Section(), 'section_id');
    }

    public function sectionKidsRecord(Request $request)
    {
        return $this->kidRecord($request, new SectionsRecord(), ['id' => $this->validationEvent], 'section_id');
    }

    private function userRecord(Request $request, Model $model, Model $foreignModel, $foreignKey)
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$foreignModel->getTable().',id']);
        
        $recordId = $request->input('id');
        $record = $model->where($foreignKey,$recordId)->where('user_id',Auth::id())->first();

        list($isEvent, $owner, $mailModel) = $this->getVarsForCreateOrDeleteRecord($record);
        
        if ($record) {
            $record->delete();
            $isNew = false;
            $message = trans('content.record_canceled');
        } else {
            $foreignTable = $foreignModel->find($request->input('id'));
            if (
                ($foreignTable instanceof Event && Gate::allows('owner', $foreignTable)) ||
                ($foreignTable instanceof Section && Gate::allows('owner', $foreignTable->leader))
            ) abort(403);
            
            $isNew = true;
            $model->create([
                'user_id' => Auth::id(),
                $foreignKey => $recordId
            ]);
            $message = trans('content.you_are_record');
        }

        $this->sendRecordsEmails(Auth::user(), $owner, $mailModel, $isNew, $isEvent, false);
        return redirect()->back()->with('message',$message);
    }
    
    private function kidRecord(Request $request, Model $model, array $validationArr, $foreignKey)
    {
        $this->validate($request, $validationArr);
        $cancelRecords = 0;
        $createRecords = 0;
        $kidsCount = count(Auth::user()->kids);
        $fields = $this->processingFields($request);
        $recordId = $request->input('id');

        foreach (Auth::user()->kids as $kid) {
            $record = $model->where($foreignKey,$recordId)->where('kid_id',$kid->id)->first();
            $mailFlag = false;
            $isNew = false;

            list($isEvent, $owner, $mailModel) = $this->getVarsForCreateOrDeleteRecord($record);

            if ($record && !$fields['kid'.$kid->id]) {
                $cancelRecords++;
                $mailFlag = true;
                $record->delete();
            } elseif (!$record && $fields['kid'.$kid->id]) {
                $createRecords++;
                $isNew = true;
                $mailFlag = true;
                $model->create([
                    'kid_id' => $kid->id,
                    $foreignKey => $recordId
                ]);
            }
            if ($mailFlag) $this->sendRecordsEmails(Auth::user(), $owner, $mailModel, $isNew, $isEvent, true);
        }
        if ($cancelRecords == $kidsCount) $message = $cancelRecords == 1 ? trans('content.record_canceled') : trans('content.records_canceled');
        elseif ($createRecords == $kidsCount) $message = $cancelRecords == 1 ? trans('content.your_kid_is_record') : trans('content.your_kids_are_record');
        else $message = $kidsCount == 1 ? trans('content.record_updated') : trans('content.records_updated');

        return redirect()->back()->with('message',$message);
    }

    public function deleteRecordEvent(Request $request)
    {
        return $this->deleteRecord($request, new EventsRecord());
    }

    public function deleteRecordSection(Request $request)
    {
        return $this->deleteRecord($request, new SectionsRecord());
    }

    private function deleteRecord(Request $request, Model $model)
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
        $record = $model->find($request->input('id'));

        if (
            Gate::denies('trainer')     &&
            Gate::denies('organizer')   &&
            Gate::denies('admin')       &&
            (
                ($record instanceof EventsRecord && Gate::denies('owner', $record->event)) ||
                ($record instanceof SectionsRecord && Gate::denies('owner', $record->section->leader))
            )
        ) abort(403);
        
        list($isEvent, $owner, $mailModel) = $this->getVarsForCreateOrDeleteRecord($record);
        $this->sendRecordsEmails($record->kid_id ? $record->kid->parent : $record->user, $owner, $mailModel, false, $isEvent, $record->kid_id);
//        $record->delete();
        return response()->json(['success' => true]);
    }

    public function deleteTrainerSection(Request $request)
    {
        $this->validate($request, ['id' => $this->validationSection]);
        $section = Section::find($request->input('id'));
        if (Gate::denies('admin') && (Gate::denies('trainer') || Auth::user()->trainer->id != $section->trainer_id)) abort(403);
        $section->trainer_id = null;
        $section->save();
        return response()->json(['success' => true]);
    }

    private function getVarsForCreateOrDeleteRecord(Model $record)
    {
        if ($record instanceof EventsRecord) {
            if ($record->event->start_time < time()) abort(403);
            $isEvent = true;
            $owner = $record->event->user;
            $mailModel = $record->event;
        } else {
            if (Gate::allows('owner',$record->section->leader)) abort(403);
            $isEvent = false;
            $owner = $record->section->leader->user;
            $mailModel = $record->section;
        }
        return [$isEvent, $owner, $mailModel];
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

    protected function sendRecordsEmails($user, $owner, Model $model, $isNew, $isEvent, $isKid)
    {
        $userName = Helper::userCreds($user, true);
        $template = 'auth.emails.'.($isEvent ? 'event' : 'section').'_record';

        $fields = [
            'head' => trans('mail.'.($isNew ? 'new' : 'cancel').'_record_to_'.($isEvent ? 'event' : 'section'), ['name' => $model['name_'.App::getLocale()]]),
            'user' => $isKid ? trans('mail.child',['child_name' => $userName]) : trans('mail.user',['user_name' => $userName]),
            'model' => $model
        ];

        if ($user->email && $user->send_mail) $this->sendMessage($user->email, $template, $fields);
        if ($owner->email && $owner->send_mail) $this->sendMessage($owner->email, $template, $fields);
    }
}
