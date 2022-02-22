<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class usersController extends Controller
{
    public function index()
    {
        return view('users/login');
    }

    public function login(Request $request)
    {

        $user = DB::table('users')
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->get();

        //dd($user[0]->id);

        if ($user->count() == 1) {
            return redirect()->route('products')->with('idUser',$user[0]->id );
        } else {
            return redirect()->route('index')->with('error','Usuario No Encontrado');
        }
    }

    public function viewRegister()
    {
        return view('users/register');
    }

    public function register(Request $request)
    {
        $createUser = new User();

        $createUser->name = $request->name;
        $createUser->email = $request->email;
        $createUser->password = $request->password;
        $createUser->created_at = date('Y-m-d H:i:s');
        $createUser->updated_at = date('Y-m-d H:i:s');

        $createUser->save();

        return redirect()->route('index')->with('registerUsu','Usuario Registrado');
    }
}
