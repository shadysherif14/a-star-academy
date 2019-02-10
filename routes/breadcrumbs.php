<?php

use App\User;
use App\Level;
use App\Course;
use App\Instructor;

/** Home */
Breadcrumbs::for('admin.home', function ($trail) {
    
    $trail->push(config('app.name'), url('/') , ['icon' => 'zmdi zmdi-home']);
});


/** Profile */
Breadcrumbs::for('admin.profile', function ($trail) {

    $trail->parent('admin.home');

    $trail->push('Profile', url('profile'));
});

/** Notifications */
Breadcrumbs::for('admin.subscriptions', function ($trail) {

    $trail->parent('admin.home');

    $trail->push('Subscriptions', url('subscriptions'));
});

/** Courses */
Breadcrumbs::for('admin.courses', function ($trail) {

    $trail->parent('admin.home');

    $trail->push('Courses', Course::adminRoutes()->index);
});

Breadcrumbs::for('admin.course', function ($trail, $course) {

    $trail->parent('admin.courses');

    $trail->push($course->name, $course->adminRoutes->show);
});

Breadcrumbs::for('admin.courses.add', function ($trail) {

    $trail->parent('admin.courses');

    $trail->push('Add', Course::adminRoutes()->create);
});



/** Instructors */
Breadcrumbs::for('admin.instructors', function ($trail) {

    $trail->parent('admin.home');

    $trail->push('Instructors', Instructor::adminRoutes()->index);
});

Breadcrumbs::for('admin.instructor', function ($trail, $instructor) {

    $trail->parent('admin.instructors');

    $trail->push($instructor->name, $instructor->adminRoutes->show);
});

Breadcrumbs::for('admin.instructors.add', function ($trail) {

    $trail->parent('admin.instructors');

    $trail->push('Add', Instructor::adminRoutes()->create);
});




/** Levels */
Breadcrumbs::for('admin.levels', function ($trail) {

    $trail->parent('admin.home');

    $trail->push('Levels', action('Admin\LevelController@index'));
});

Breadcrumbs::for('admin.level', function ($trail, $level) {

    $trail->parent('admin.levels');

    $trail->push($level->name, action('Admin\LevelController@show', $level));
});

Breadcrumbs::for('admin.levels.add', function ($trail) {

    $trail->parent('admin.levels');

    $trail->push('Add', action('Admin\LevelController@create'));
});

/** Users */
Breadcrumbs::for('admin.users', function ($trail) {

    $trail->parent('admin.home');

    $trail->push('Users', User::adminRoutes()->index);
});

Breadcrumbs::for('admin.user', function ($trail, $user) {

    $trail->parent('admin.user');

    $trail->push($user->name, $user->adminRoutes->show);
});



/** Sessions */

Breadcrumbs::for('admin.sessions', function ($trail, $course) {

    $trail->parent('admin.course', $course);

    $trail->push('Sessions', action('Admin\VideoController@index', $course));
});

Breadcrumbs::for('admin.sessions.add', function ($trail, $course) {

    $trail->parent('admin.sessions', $course);

    $trail->push('Add', $course->videoRoutes);
});

Breadcrumbs::for('admin.sessions.edit', function ($trail, $course) {

    $trail->parent('admin.sessions', $course);

    $trail->push('Edit', action('Admin\VideoController@index', $course));

});



/** Quiz */
Breadcrumbs::for('admin.quiz', function ($trail, $video) {

    $trail->parent('admin.course', $video->course);

    $trail->push($video->title, action('Admin\VideoController@index', $video->course));

    $trail->push('Quiz', action('Admin\QuestionController@index', $video));

});


