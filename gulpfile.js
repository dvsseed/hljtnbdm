var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.assetsPath = 'resources/';
elixir(function(mix) {

    mix.styles([
        "bootstrap.min.css",
        "main.css"
        ]).styles([
            "bdata.css"
    ], 'public/css/bdata.css');

    mix.scripts([
        "jquery.min.js",
        "bootstrap.min.js",
        "jquery.tablesorter.min.js",
        "main.js"
    ]).scripts([
        "bdata.js"
    ], 'public/js/bdata.js');
});
