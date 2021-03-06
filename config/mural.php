<?php

return [
    // semantic-ui or bootstrap
    'skin'                => 'semantic-ui',

    // comment per page
    'per_page'            => 5,

    // whether user enable to vote comment or not
    // if set true, you must install laravolt/votee package (https://github.com/laravolt/votee)
    'vote'                => false,

    // default model for user commentator
    'default_commentator' => config('auth.providers.users.model'),

    // where to put script
    // if null, all script will placed inline with widget
    'script_stack' => false,

    'middleware'   => ['web'],

    'default_commentable' => \App\Post::class,
];
