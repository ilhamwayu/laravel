<?php

namespace App\Http\Controllers\otentikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $data = DB::table('users')->where('username', $username)->first();

        if ($data) {
            if (Hash::check($pass, $data->password)) {
                session(['iwa' => $data->akun, 'nama' =>$data->username, 'type' =>$data->type]);
                return '1';
            }
            else{
                return '0';
            }
        }
        else{
            return '0.1';
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/');
    }
}
