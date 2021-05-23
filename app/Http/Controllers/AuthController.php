<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            $active_user = User::where('email', '=', $request->email)->first();

            // Store the connected user data to the session
            session()->put(json_encode($active_user));

            return response($active_user->createToken($request->email)->plainTextToken);
        }

        return response(403, 403);
    }

    public function logout()
    {
        return Auth::logout();
    }
}
