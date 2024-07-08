<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // todos los endpoints que empiezen con el prefijo api/ van a soportar CORS (v313)
    // el cookie de sanctum nos va a permitir identificar el recurso que esta realizando una peticion, entonces enviamos un cookie, almacena ese cookie, y entonces ya podemos comenzar a utilizar la autenticacion de laravel (v313)
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // aca se setean los metodos que estan permitidos ("*" = todos) (v313)
    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // 'supports_credentials' => false,
    'supports_credentials' => true,

];
