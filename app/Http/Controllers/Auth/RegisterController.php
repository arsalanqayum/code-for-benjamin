<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

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
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }

        return response()->json($user);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		$dt = new Carbon();
		$before = $dt->subYears(13)->format('Y-m-d');

        return Validator::make($data, [
            'name' => 'required|max:255',
            'nickname' => 'required|max:155|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'date_of_birth' => 'required|date|before:'.$before,
			'password' => 'required|min:6|confirmed',
			'tos_accepted' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		return User::create([
			'name' => $data['name'],
			'nickname' => $data['nickname'],
			'email' => $data['email'],
			'date_of_birth' => $data['date_of_birth'],
			'password' => bcrypt($data['password']),
			'tos_accepted' => $data['tos_accepted'],
			'receive_email_updates' => $data['receive_email_updates'],
		]);
    }
}
