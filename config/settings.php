<?php
return [
    'medicine_img' => [
        'main' => ['width' => 270, 'height' => 270],
    ],
    'adv_img' => [
        'main' => ['width' => 1100, 'height' => 270],
    ],
    'articles_img' => [
        'main' => ['width' => 1170, 'height' => 657],
        'middle' => ['width' => 370, 'height' => 240],
        'small' => ['width' => 110, 'height' => 73],
    ],

    'paginate_tags' => 12,
    'slider' => ['width' => 1170, 'height' => 496],
    'poll' => ['width' => 340, 'height' => 240],
//    Captcha
    'captcha_secret' => env('GL_SECRET_CAPTCHA', '6LffgkYUAAAAALjFTsDfhPi9CJmjzotTEV42Q9Jw'),
    'captcha_site_key' => env('GL_CAPTCHA', '6LffgkYUAAAAAJ6ubssIzd6snneSgU8JuHcmzWxY'),
];