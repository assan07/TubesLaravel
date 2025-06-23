<?php // config/flasher.php

return [
    'plugins' => [
        'sweetalert' => [
            'scripts' => [
                '/vendor/flasher/sweetalert2.min.js',
                '/vendor/flasher/flasher-sweetalert.min.js',
            ],
            'styles' => [
                '/vendor/flasher/sweetalert2.min.css',
            ],
            'options' => [
                'toast' => true,
                'position' => 'top-end',
                'timer' => 2000,
                'showConfirmButton' => false,
            ],
        ],
    ],
];
