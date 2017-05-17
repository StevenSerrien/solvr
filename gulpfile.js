const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('laravel-elixir-ng-annotate');


// var appScripts = [
//     'angular/configuration/module.js',
//     'angular/configuration/config.js',
//     'angular/app/directives/*.js',
//     'angular/app/services/*.js',
//     'angular/app/controllers/*.js'
// ];
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
      //  .annotate(appScripts).webpack('annotated.js','public/assets/js/angular.js', 'public/js/')
       .webpack('app.js')
       .version(['css/app.css', 'js/app.js']);
});
