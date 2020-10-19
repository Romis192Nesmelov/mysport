<?php

namespace App\Http\Controllers\Auth;

trait GoogleCapchaTrait
{
    public function reCapchaRequest($response)
    {
        $data = array(
            'secret' => "6LfIM9IUAAAAAExd24de_OJTBsGyN1OYssXKyxwF",
            'response' => $response
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($verify));

        return $response->success;
    }
}