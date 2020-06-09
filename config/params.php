<?php
$whitelist = array(
    '127.0.0.1',
    '::1',
);

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    return [
        'adminEmail' => 'hr@job-jaras.com',
        'siteUrl' => '',
        'adminEmail' => 'hr@job-jaras.com',
        'senderEmail' => 'noreply@example.com',
        'senderName' => 'Example.com mailer',
        'supportEmail'=>'hr@job-jaras.com',
        'languages'=>[
            'ar'=>'Arabic',
            'en'=>'English'
        ]
    ];
} else {
    return [
        'adminEmail' => 'hr@job-jaras.com',
        'siteUrl' => 'http://job-jaras.com/web',
        'adminEmail' => 'admin@example.com',
        'senderEmail' => 'noreply@example.com',
        'senderName' => 'Example.com mailer',
        'supportEmail'=>'hr@job-jaras.com',
        'languages'=>[
            'ar'=>'Arabic',
            'en'=>'English'
        ]
    ];
}