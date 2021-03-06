const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel bootraplications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/mine.js', 'public/js')
    .sourceMaps();
mix.css('resources/css/app.css', 'public/css/app.css');
mix.js('resources/js/chart.js', 'public/js').sourceMaps();
