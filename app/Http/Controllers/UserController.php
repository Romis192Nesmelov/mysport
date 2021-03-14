<?php

namespace App\Http\Controllers;

use App\User;
use App\Kid;
use Illuminate\Http\Request;
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
        return $this->showView($request,'profile');
    }

    public function editProfile(Request $request)
    {
        $validationArr = [
            'email' => $this->validationEmail.','.Auth::id(),
            'phone' => $this->validationPhone,
            'name' => $this->validationCharField,
            'surname' => $this->validationCharField,
            'family' => $this->validationCharField,
            'born' => $this->validationDate,
            'gender' => $this->validationGender,
            'avatar' => $this->validationImage
        ];

        $fields = $this->processingFields($request, 'send_mail', ['avatar','password','password_confirmation']);
        $fields['gender'] = $this->setGender($fields['gender']);
        if (!$fields['born'] = $this->setBornDate($fields['born']))
            return redirect()->back()->withInput()->withErrors(['born' => trans('validation.invalid_date')]);

        if ($request->has('password') && $request->input('password')) {
            $fields['password'] = bcrypt($request->input('password'));
            $validationArr['old_password'] = 'required|min:4|max:50';
            $validationArr['password'] = $this->validationPassword;
        }

        $this->validate($request, $validationArr);
        $user = User::find(Auth::id());
        $user->update($fields);

        if ($request->hasFile('avatar')) {
            $fields = $this->processingImage($request, $user, 'avatar', 'user_avatar'.$user->id, 'images/avatars');
            $user->update($fields);
        }
        
        return redirect('/profile')->with('message',trans('content.save_complete'));
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
        $maxDaysInMonth = Helper::getNumberDaysInMonth($month <= 12 && $month > 0 ? $month : 1,$year);
        $checkKid = $checkKid ? $year < (int)date('Y') - 19 : false;

        if (
            $checkKid
            || $year < (int)date('Y') - 150
            || $month < 1
            || $month > 12
            || $day < 1
            || $day > $maxDaysInMonth
        ) return false;
        else return strtotime($month.'/'.$day.'/'.$year);
    }
}
