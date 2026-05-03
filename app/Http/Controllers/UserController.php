<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
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
    public function profile(){
        return view('profile' , ['user' => auth()->user()->with('rol'), 'posts' => auth()->user()->posts]);
    }

    public function admin()
    {
        $users = User::with('rol', 'posts')->get();
        $user = auth()->user();

        return view('admin', compact('users', 'user'));
    }

    // CREAR
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'rol_id' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id
        ]);

        return back();
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only('name', 'email', 'rol_id');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back();
    }

    // ELIMINAR
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }
}
