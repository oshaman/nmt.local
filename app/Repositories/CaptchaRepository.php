<?php

namespace Fresh\Nashemisto\Repositories;

class CaptchaRepository
{
    public static function run($captcha)
    {
        try {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = ['secret' => config('settings.captcha_secret'),
                'response' => $captcha,
                'remoteip' => $_SERVER['REMOTE_ADDR']];
            $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                ]
            ];
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            return json_decode($result)->success;
        } catch (\Exception $e) {
            return false;
        }
    }
}