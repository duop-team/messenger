const mix = require('laravel-mix');
require('laravel-mix-svg-vue');

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


mix.js('resources/js/app.js', 'public/js')
    .vue()
    .svgVue({
        svgPath: 'resources/img/icons',
        extract: false,
        svgoSettings: [
            {removeTitle: true},
            {removeViewBox: false},
            {removeDimensions: true}
        ]
    })
    .sass('resources/sass/app.scss', 'public/css');
