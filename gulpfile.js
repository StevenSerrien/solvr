const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('laravel-elixir-ng-annotate');
require('laravel-elixir-imagemin');

elixir.config.images = {
    folder: 'img',
    outputFolder: 'img'
};


var appScripts = [
    'angular/configuration/module.js',
    'angular/configuration/config.js',
    'angular/app/directives/*.js',
    'angular/app/services/*.js',
    'angular/app/controllers/*.js'
];
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

 elixir(function(mix) {
   mix.annotate(appScripts).scripts('annotated.js','public/js/angular.js', 'public/js/');
 });

 elixir(function(mix) {
   mix.copy(
     'resources/views/states', 'public/assets/templates'
   );
 });

elixir((mix) => {
    mix.sass('app.scss')
      //  .annotate(appScripts).webpack('annotated.js','public/assets/js/angular.js', 'public/js/')
       .webpack('app.js')
       .imagemin("./resources/assets/img", "public/img")
       .scripts(
        [
            'libs/ease.js',
            'libs/segment.js',
            'libs/typed.js',
            'libs/classie.js',
            'libs/snap.svg-min.js',


            // Angular libs
            // 'plugins/angular.min.js',
            // 'plugins/angular-sanitize.js',
            // 'plugins/angular-route.js',
            // 'plugins/angular-animate.js',
        ],
        'public/js/libs.js')
        .scripts(
         [
             'libs/initial.min.js',

         ],
         'public/js/backend-libs.js')
        // .scripts(
        //   [
        //   // Angular Plugins (not via NPM, but manually)
        //   'plugins/ngMask.min.js',
        // ],
        // 'public/js/angular-plugins.js')

       .version(['css/app.css', 'js/app.js']);
});

elixir((mix) => {
    mix.sass('admin-app.scss')
        .webpack('d-app.js');
      //  .version(['css/admin-app.css', 'js/d-app.js']);
});
