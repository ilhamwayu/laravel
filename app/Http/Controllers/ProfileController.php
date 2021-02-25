<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function index()
    {
        $idakun = session('iwa');

        $data = DB::table('admin')
                    ->join('users', 'users.akun', '=', 'admin.idakun')
                    ->join('jabatan', 'jabatan.id', '=', 'admin.idjabatan')
                    ->select('admin.*', 'users.name', 'users.username', 'users.type', 'users.alias', 'jabatan.nama_jabatan')
                    ->where('admin.idakun', $idakun)
                    ->get();

        return view('pages/profile', ['data' => $data]);
    }
}
