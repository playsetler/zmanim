const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.copyDirectory('resources/css/fonts', 'public/css/fonts');
 mix.copyDirectory('resources/img', 'public/img');
 mix.js('resources/js/app.js', 'public/js')
     .js('resources/js/uuid.js', 'public/js')
     .vue()
     .css('resources/css/app.css', 'public/css')
     .sass('resources/sass/app.scss', 'public/css').sourceMaps();
 
