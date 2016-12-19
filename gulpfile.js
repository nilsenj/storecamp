// const elixir = require('laravel-elixir');
//
// require('laravel-elixir-vue-2');
//
// /*
//  |--------------------------------------------------------------------------
//  | Elixir Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Elixir provides a clean, fluent API for defining some basic Gulp tasks
//  | for your Laravel application. By default, we are compiling the Sass
//  | file for your application as well as publishing vendor resources.
//  |
//  */
//
var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    php = require('gulp-connect-php');
require('laravel-elixir-js-uglify');

elixir((mix) => {
    mix.less('app.less');
    mix.less('admin-lte/AdminLTE.less');
    mix.less('bootstrap/bootstrap.less');
    mix.coffee('../coffee/adminLte.coffee', 'public/js/admin.js');
    mix.uglify('admin.js', 'public/js', 'resources/assets/js/admin.js');
    mix.coffee('../coffee/main.coffee', 'public/js/app.js');
    mix.sass('../sass/app.scss', 'public/css/main/app.css');
    mix.copy('bower_components/summernote/dist/', 'public/plugins/summernote/');
    mix.browserSync({
        proxy: 'storecamp.io',
        port: 3344
    });

});
// create a task to serve the app
gulp.task('serve', function() {

    // start the php server
    // make sure we use the public directory since this is Laravel
    php.server({
        base: './public'
    });

});
// create a task to serve the app
gulp.task('test', function() {
    elixir((mix) => {
        mix.phpUnit();
        mix.phpSpec();
    });
});
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


//elixir(function(mix) {
//    mix.copy('fonts/', 'public/fonts/');
//});