<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (User::where('aadhar',$request->aadhar)->first()) {
            $credentials['aadhar'] = $request->aadhar;
            $credentials['password'] = $request->password;

            if (Auth::attempt($credentials))
            {
                Session::put('academicyear',$request->academicyear);
                Session::put('registerfor',$request->registerfor);
                return redirect()->route('home');
            }
            else
            {
                return redirect()->route('login')->with('error','Invalid details');
            }
        }
        else
        {
            return redirect()->route('login')->with('error','User does not exists');
        }
    }
}
