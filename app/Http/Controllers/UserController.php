<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function log_in(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return back()->withErrors([
                'email' => 'El correo electrónico no está registrado.'
            ]);
        }
        if(!Hash::check($request->password, $user->password)){
            return back()->withErrors([
                'password' => 'La contraseña es incorrecta.'
            ]);
        }
        Auth::login($user);
        return redirect('/post');
    }
    public function sign_up(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'repeated_password' => 'required|same:password',
            ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/post');
    }
    public function log_out(){
        Auth::logout();
        return redirect('/');
    }
}
