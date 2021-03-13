<?php

namespace App\Http\Controllers;

use App\User;
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
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'phone' => $this->validationPhone,
            'name' => 'required|min:3|max:255',
            'surname' => 'required|min:3|max:255',
            'family' => 'required|min:3|max:255',
            'born' => $this->validationDate,
            'gender' => 'required|in:M,W,М,Ж',
            'avatar' => $this->validationImage,
            'document' => $this->validationImage
        ];

        $fields = $this->processingFields($request, 'send_mail', ['avatar','password','password_confirmation']);
        $fields['gender'] = $fields['gender'] == 'M' || $fields['gender'] == 'М' ? 1 : 0;

        if ($request->has('password') && $request->input('password')) {
            $fields['password'] = bcrypt($request->input('password'));
            $validationArr['old_password'] = 'required|min:4|max:50';
            $validationArr['password'] = $this->validationPassword;
        }

        $this->validate($request, $validationArr);

        $bornDate = explode('.',$fields['born']);
        $day = (int)$bornDate[0];
        $month = (int)$bornDate[1];
        $year = (int)$bornDate[2];
        $maxDaysInMonth = Helper::getNumberDaysInMonth($month <= 12 && $month > 0 ? $month : 1,$year);
        
        if (
            $year > (int)date('Y') - 18
            || $year < (int)date('Y') - 150
            || $month < 1
            || $month > 12
            || $day < 1
            || $day > $maxDaysInMonth
        ) return redirect()->back()->withInput()->withErrors(['born' => trans('validation.invalid_date')]);

        $fields['born'] = strtotime($month.'/'.$day.'/'.$year);

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
}
