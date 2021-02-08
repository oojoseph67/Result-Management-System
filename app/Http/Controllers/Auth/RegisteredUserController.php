<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Models\User as AppUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'entry_class' => ['required'],
            'role' => ['required'],
            'passport' => ['required', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        // $passport = $request->file['passport'];
        // $passport_new_name = date('YmdHis') . "." . $passport->getClientOriginalExtension();
        // $passport->move(public_path("img/passport"), $passport_new_name);

        // return $passport_new_name;


        Auth::login($user = AppUser::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'dob' => $request['dob'],
            'entry_class' => $request['entry_class'],
            'current_class' => $request['entry_class'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
            'passport_path' => $request['passport']
        ]));

        event(new Registered($user));

        return redirect()->route('choose');
    }
}
