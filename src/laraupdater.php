<?php
return [
    'app_version'               => env('APP_VERSION', 'v2.0'),
    'github' => [
        'vendor'                    => env('GITHUB_VENDOR','vendor'),
        'repository'                => env('GITHUB_REPOSITORY','repository'),
        'personal_access_token'     => env('GITHUB_PERSONAL_ACCESS_TOKEN','access_token'),
    ],
];
?>
