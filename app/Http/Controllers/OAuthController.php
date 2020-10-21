<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Google_Client;
use Google_Service_Oauth2;

class OAuthController extends Controller
{
    use HelperTrait;

//    const APP_FB_ID = ;
//    const APP_FB_SECRET = '';
//    const URL_FB_CALLBACK = 'fb-callback';
//    const URL_FB_OAUTH = 'https://www.facebook.com/v8.0/dialog/oauth';
//    const URL_ACCESS_FB_TOKEN = 'https://graph.facebook.com/v8.0/oauth/access_token';
//    const URL_GET_FB_ME = 'https://graph.facebook.com/me';

    const URL_VK_CALLBACK = 'vk-callback';
    const URL_VK_OAUTH = 'https://oauth.vk.com/authorize';
    const URL_VK_ACCESS_TOKEN = 'https://oauth.vk.com/access_token';
    const URL_GOOGLE_CALLBACK = 'google-callback';

    public $googleClient;

    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId(env('APP_GOOGLE_ID'));
        $this->googleClient->setClientSecret(env('APP_GOOGLE_SECRET'));
        $this->googleClient->setRedirectUri(url(self::URL_GOOGLE_CALLBACK));
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");
    }
    
    public function oAuthFb()
    {
        return redirect(self::URL_FB_OAUTH.
            '?client_id='.sprintf('%.0f', self::APP_FB_ID).
            '&display=popup'.
            '&response_type=token'.
            '&redirect_uri='.urlencode(url(self::URL_FB_CALLBACK)), 301);
    }

    public function oAuthVk()
    {
        return redirect(self::URL_VK_OAUTH.
            '?client_id='.env('APP_VK_ID').
            '&display=page&redirect_uri='.urlencode(url(self::URL_VK_CALLBACK))
            .'&scope=email&response_type=code&v=5.21', 301);
    }
    
    public function fbCallback(Request $request)
    {
        // Пришёл ответ с ошибкой.
        if ($request->has('error'))
            return redirect('/')->with('message',$request->input('error'));

        // Ответ от facebook пришёл удачный:
        // Проверка state
        if (!$request->has('state')) return redirect('/')->with('message',trans('auth.fb_oauth_err1'));

        // Запрос токена
        $url = self::URL_ACCESS_FB_TOKEN.
            '?client_id='.sprintf('%.0f', self::APP_FB_ID).
            '&redirect_uri='.urlencode(url(self::URL_FB_CALLBACK)).
            '&client_secret='.self::APP_FB_SECRET.
            '&code='.$request->input('code');

        $response = json_decode(file_get_contents($url));
        if (!isset($response->access_token) || !$response->access_token) return redirect('/')->with('message',trans('auth.fb_oauth_err2'));

        // Запрос пользователя
        $url = self::URL_GET_FB_ME.
            '?access_token='.$response->access_token;
        $response = json_decode(file_get_contents($url));
        if (!$response) return redirect('/')->with('message',trans('auth.auth_err'));

        return $this->getUser(
            'fb_id',
            $response->id,
            (isset($response->email) ? $response->email : null),
            null,
            (isset($response->name) ? $response->name : null)
        );
    }

    public function vkCallback(Request $request)
    {
        if ($request->has('error'))
            return redirect('/')->with('message',$request->input('error_description'));

        $response = json_decode(file_get_contents(self::URL_VK_ACCESS_TOKEN.
            '?client_id='.env('APP_VK_ID').
            '&client_secret='.env('APP_VK_SECRET').
            '&redirect_uri='.urlencode(url(self::URL_VK_CALLBACK)).
            '&code='.$request->input('code')));

        return $this->getUser(
            'vk_id',
            $response->user_id,
            (isset($response->email) && $response->email ? $response->email : null),
            null,
            (isset($response->first_name) ? $response->first_name : null)
        );
    }
    
    public function googleCallback(Request $request)
    {
        if ($request->has('code')) {
            $token = $this->googleClient->fetchAccessTokenWithAuthCode($request->input('code'));
            $this->googleClient->setAccessToken($token['access_token']);

            // get profile info
            $googleOauth = new Google_Service_Oauth2($this->googleClient);
            $googleAccountInfo = $googleOauth->userinfo->get();
            $email = $googleAccountInfo->email;
            $name = $googleAccountInfo->name;

            return $this->getUser(
                null,
                null,
                $email,
                null,
                $name
            );

        } else {
            return redirect('/')->with('message',trans('auth.auth_err'));
        }
    }

    private function getUser($fieldName, $userId, $email, $phone, $name)
    {
        if ($fieldName && $userId) {
            $userModel = User::where($fieldName,$userId);
            if ($email) $userModel = $userModel->orWhere('email',$email);
            if ($phone) $userModel = $userModel->orWhere('phone',$phone);
            $user = $userModel->first();
        } else {
            $user = User::where('email',$email)->first();
        }

        if (!$user) {
            $user = User::create([
                $fieldName => $userId,
                'email' => $email ? $email : '',
                'name' => $name,
                'phone' => '',
                'password' => '',
                'active' => 1,
                'type' => 1,
                'send_mail' => $email ? 1 : 0
            ]);
        }

        if (!$user->active) return redirect('/profile')->with('message',trans('auth.your_account_is_blocked'));
        Auth::login($user, true);

        if (!$user->email) return redirect('/profile')->with('message',trans('auth.finish_auth'));
        return redirect('/');
    }
}
