<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function save(Request $request){
        $validateFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create($validateFields);

        if ($user){
            Auth::loginUsingId($user->id);
            return redirect()->to(route('account'));
        }

        return redirect(route('registration'))->withErrors([
            'formError' => 'Произошла ошибка'
        ]);
    }

    public function login(Request $request){
        $formField = $request->only(['email', 'password']);

        if (Auth::attempt($formField)){
            return redirect()->to(route('account'));
        }
    }
}
