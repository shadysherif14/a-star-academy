<?php

namespace App\Http\Controllers\Auth\User;

use App\User;
use App\Level;
use App\Classes\CroppedImage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UserBasicInformationRequest;

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
        return url('/');
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

    public function validateBasicInformation(UserBasicInformationRequest $request)
    {}

    public function showRegistrationForm()
    {
        $levels = Level::whereIn('school', ['IGCSE', 'SAT'])->get();

        return view('auth.user.register', compact('levels'));
    }

    protected function validator(array $data)
    {

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|image',
            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],
            'school' => [
                'required',
                Rule::in(['SAT', 'IGCSE']),
            ],
            'level' => 'required|exists:levels,id',
            'accounts.*' => 'nullable|url',
            'phone' => 'nullable|numeric',
        ];

        $messages = [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
        ];

        return Validator::make($data, $rules, $messages);
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

        $user->first_name = $data->first_name;

        $user->last_name = $data->last_name;

        $user->username = $data->username;

        $user->email = $data->email;

        $user->password = bcrypt($data->password);

        $user->level_id = $data->level;

        $user->gender = $data->gender;

        $user->phone = $data->phone;

        $accounts = collect($data->accounts)->filter();

        $user->accounts = $accounts;

        if (isset($data->avatar)) {

            $avatar = $data->avatar;

            $name = $data->username;

            $user->avatar = $avatar->storeAs('images/avatars/original', "$name.jpg", 'public');

            $path = 'images/avatars/cropped';

            $user->cropped_avatar = CroppedImage::create($avatar, $path, $name);

        }
        
        $user->serial = str_random(20);
        
        $user->save();

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {

        if ($request->ajax()) {

            $status = true;

            $redirect = $this->redirectPath();

            return response()->json(compact('status', 'redirect'));

        }
    }

}
