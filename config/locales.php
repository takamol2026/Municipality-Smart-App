<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported interface languages
    |--------------------------------------------------------------------------
    |
    | Dari and Pashto stay right-to-left. English uses the left-to-right
    | stylesheets. Labels stay in each language's own script so the header
    | switcher is recognizable no matter which locale is active.
    |
    */

    'supported' => [
        'fa' => [
            'label' => 'دری',
            'dir' => 'rtl',
        ],
        'ps' => [
            'label' => 'پښتو',
            'dir' => 'rtl',
        ],
        'en' => [
            'label' => 'English',
            'dir' => 'ltr',
        ],
    ],

];
