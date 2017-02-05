<?php

return [
    /*
   |--------------------------------------------------------------------------
   | Generator Config
   |--------------------------------------------------------------------------
   |
   */
    'generator'=>[
        'basePath'=> app_path().'/Core',
        'rootNamespace'=>'App\\Core\\',
        'controllerBasePath'=> app_path().'/Http/',
        'customControllerNamespace'=>'App\\Http\\Controllers\\',
        'paths'=>[
            'models'=>'Models',
            'repositories'=>'Repositories',
            'controllers'=> 'Controllers',
            'interfaces'=>'Repositories',
            'transformers'=>'Transformers',
            'presenters'=>'Presenters'
        ]
    ]
];