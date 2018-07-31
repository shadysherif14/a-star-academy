let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/forms.scss', 'public/css')
    .sass('resources/assets/sass/sidebar.scss', 'public/css');

/** Courses */
mix.sass('resources/assets/sass/courses/show.scss', 'public/css/courses')
    .sass('resources/assets/sass/courses/index.scss', 'public/css/courses')
    .sass('resources/assets/sass/courses/create.scss', 'public/css/courses');


/** Levels */
mix.sass('resources/assets/sass/levels/show.scss', 'public/css/levels')
    .sass('resources/assets/sass/levels/index.scss', 'public/css/levels')
    .sass('resources/assets/sass/levels/create.scss', 'public/css/levels');

/** Instructors */
mix.sass('resources/assets/sass/instructors/show.scss', 'public/css/instructors')
    .sass('resources/assets/sass/instructors/index.scss', 'public/css/instructors')
    .sass('resources/assets/sass/instructors/create.scss', 'public/css/instructors');

/** Videos */
mix.sass('resources/assets/sass/videos/show.scss', 'public/css/videos')
    .sass('resources/assets/sass/videos/index.scss', 'public/css/videos')
    .sass('resources/assets/sass/videos/create.scss', 'public/css/videos');

/** Quizzes */
mix.sass('resources/assets/sass/quizzes/show.scss', 'public/css/quizzes')
    .sass('resources/assets/sass/quizzes/index.scss', 'public/css/quizzes')
    .sass('resources/assets/sass/quizzes/create.scss', 'public/css/quizzes');