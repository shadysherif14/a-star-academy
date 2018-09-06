let mix = require('laravel-mix');


mix.sass('resources/assets/sass/Admin/app.scss', 'public/css/admin')
    .sass('resources/assets/sass/Admin/shared/cru.scss', 'public/css/admin/shared')
    .sass('resources/assets/sass/Admin/courses/index.scss', 'public/css/admin/courses')
    .sass('resources/assets/sass/Admin/levels/index.scss', 'public/css/admin/levels')
    .sass('resources/assets/sass/Admin/instructors/index.scss', 'public/css/admin/instructors')
    .sass('resources/assets/sass/Admin/quizzes/index.scss', 'public/css/admin/quizzes')
    .sass('resources/assets/sass/Admin/videos/index.scss', 'public/css/admin/videos')
    .sass('resources/assets/sass/Admin/videos/create.scss', 'public/css/admin/videos');

mix
    .sass('resources/assets/sass/Auth/register.scss', 'public/css/auth')
    .sass('resources/assets/sass/Auth/login.scss', 'public/css/auth')
    .sass('resources/assets/sass/Auth/index.scss', 'public/css/auth');

mix.sass('resources/assets/sass/User/courses/index.scss', 'public/css/user/courses');