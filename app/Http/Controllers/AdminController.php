<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('pages/master/admin');
    }

    public function edit()
    {   
        $id = $_POST['id'];

        $data = Admin::find($id);
        return json_encode($data);
    }

    public function add()
    {

        $request   = $_POST['f'];
        $tgl_lahir = date("Y/m/d", strtotime($_POST['tgl_lahir']));
        $pass      = Hash::make($_POST['password']);
        $akun      = Str::random(40);

        $dt = DB::table('users')
                  ->where('username', $_POST['username'])
                  ->first();

        $validatedData = $request->validate([
            'nama'      => 'required',
            'username'  => 'required|unique:user',
            'password'  => 'required|min:6',
            'jk'        => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'type'      => 'required',
            'no_hp'     => 'required',
        ]);

        if ($dt->username =="") {
            $data2 = array(
                "username"       => $_POST['username'],
                "alias"          => $_POST['password'],
                "type"           => $_POST['type'],
                "remember_token" => $akun,
                "password"       => $pass,
                "akun"           => $akun,
            );
    
            $user  = DB::table('users')->insert($data2);
    
            // $admin = Admin::create(["nama" => $request->nama,
            // "jk"   => $request->jk,
            // "tmp_lahir" => $request->tmp_lahir,
            // "tgl_lahir" => $tgl_lahir,
            // "no_hp" => $request->no_hp,
            // "email" => $request->email,
            // "alamat" => $request->alamat,
            // "idakun" => $request->akun]);
            
            $admin = Admin::create($request);
    
            if ($admin || $user) {
                $arr = array(
                    "type"      => "success",
                    "msg"       => "Data Berhasil Disimpan",
                    "caption"   => "Success"
                );
    
                return "[" . json_encode($arr) . "]";
            } else {
                $arr = array(
                    "type"      => "error",
                    "msg"       => "Data Gagal Disimpan !",
                    "caption"   => "Error"
                );
    
                return "[" . json_encode($arr) . "]";
            }
        }
        else{
            $arr = array(
                "type"      => "warning",
                "msg"       => "Username Sudah Terdaftar",
                "caption"   => "Warning"
            );

            return "[" . json_encode($arr) . "]";

        }


    }

    public function dataTable()
    {
        $data = Admin::latest()->get();
        return Datatables::of($data)
            ->editColumn("tgl_lahir", function ($data) {
                return date("d/m/Y", strtotime($data->tgl_lahir));
            })
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<center>
                            <button type="button" onclick="getId(`' . $data->id . '`)" data-toggle="modal" data-target="#md-fedit" class="btn btn-icon btn-sm bg-primary">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" onclick="getId(`' . $data->id . '`)" data-toggle="modal" data-target="#md-delete" class="btn btn-icon btn-sm btn-danger">
									<i class="fa fa-trash"></i>
							</button>
                        </center>
                        ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function del()
    {
        $id = $_POST['id'];

        $admin = Admin::find($id)->delete();
        
        if ($admin) {
            $data = "1";
        }
        else{
            $data = "0";
        }

        return $data;
    }

}
