<?php


return [
    'class'            => 'yii\swiftmailer\Mailer',
    'useFileTransport' => true,
    'transport'        => [
        'class'    => 'Swift_SmtpTransport',
        'host'     => 'smtp.timeweb.ru',
        'port'     => '25',
        'username' => 'no-reply@admin.ru',
        'password' => 'no-reply1',
    ]
];
