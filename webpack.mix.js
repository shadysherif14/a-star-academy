let mix = require('laravel-mix');


mix
    .sass('resources/assets/sass/Auth/index.scss', 'public/css/auth')
    .sass('resources/assets/sass/errors/index.scss', 'public/css/errors');

mix.sass('resources/assets/sass/User/main.scss', 'public/css/user')
    .sass('resources/assets/sass/User/home.scss', 'public/css/user')    
    .sass('resources/assets/sass/User/courses/index.scss', 'public/css/user/courses')
    .sass('resources/assets/sass/User/courses/show.scss', 'public/css/user/courses')
    .sass('resources/assets/sass/User/instructors/index.scss', 'public/css/user/instructors')
    .sass('resources/assets/sass/User/instructors/show.scss', 'public/css/user/instructors')
    .sass('resources/assets/sass/User/videos/show.scss', 'public/css/user/videos')
    .sass('resources/assets/sass/User/profiles/show.scss', 'public/css/user/profiles');



mix.sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js');