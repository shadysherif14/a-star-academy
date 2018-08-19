<?php

namespace App\Http\Controllers\Auth;

use App\Course;
use App\Http\Controllers\Controller;
use App\Level;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {

        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $rules = [
            'name' => 'required|string|max:255',
            /* 'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', */
            'avatar' => 'image',
            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],
            'school' => [
                'required',
                Rule::in(['American Diploma', 'IGCSE']),
            ],
            'level' => [
                'required_if:school,IGSCE',
                Rule::in(['8th Grade', '9th Grade', 'IG']),
            ],
            'courses' => 'required_if:level,IG',
            'courses.*.subsystem' => 'required_if:level,IG',
            'courses.*.system' => 'required_if:level,IG',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $data = (object) $data;

        $user = new User;

        $user->name = $data->name;

        $user->username = $data->username;

        $user->email = $data->email;

        $user->gender = $data->gender;

        $user->password = Hash::make($data->password);

        if (isset($data->avatar)) {

            $avatar = $data->avatar->store('public/images/avatars');
        }

        $user->save();

        $this->assignCourses($data, $user);
        
        return $user;
    }

    protected function assignCourses($data, $user)
    {

        if ($data->school === 'American Diploma') {

            $level = Level::select('id')->where('name', 'SAT')->with('courses')->first();

            $courses = $level->courses;

        } else if ($data->school === 'IGCSE' && $data->level !== 'IG') {

            $level = Level::select('id')->where('name', $data->level)->with('courses')->first();

            $courses = $level->courses;

        } else {

            foreach ($data->courses as $course) {

                $course = (object) $course;

                $courses[] = Course::where([
                    'name' => $course->name,
                    'system' => $course->system,
                    'sub_system' => $course->subsystem,

                ])
                    ->first();

            }
        }
        $user->courses()->saveMany($courses);
    }

}
