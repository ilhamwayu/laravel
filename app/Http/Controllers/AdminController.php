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

    public function edit($id)
    {
        $data = Admin::find($id);
        return json_encode($data);
    }

    public function akun($id)
    {
        $data = DB::table('users')->where('akun', $id)->get();
        return json_encode($data);
    }

    public function update()
    {
        $id      = $_POST['getId'];
        $request = $_POST['f'];

        $data = Admin::where('id', $id)
                       ->update([                
                       "nama"      => $request['nama'],
                       "jk"        => $request['jk'],
                       "tmp_lahir" => $request['tmp_lahir'],
                       "tgl_lahir" => $request['tgl_lahir'],
                       "no_hp"     => $request['no_hp'],
                       "idjabatan" => $request['idjabatan'],
                       "email"     => $request['email'],
                       "alamat"    => $request['alamat'],
                       "idakun"    => $request['idakun'],
                       ]);

        if ($data) {
            $arr = array(
                "type"      => "success",
                "msg"       => "Data Berhasil Update",
                "caption"   => "Success"
            );

            return "[" . json_encode($arr) . "]";
        } else {
            $arr = array(
                "type"      => "error",
                "msg"       => "Data Gagal Update !",
                "caption"   => "Error"
            );

            return "[" . json_encode($arr) . "]";
        }
    }

    public function add(Request $request)
    {

        $request   = $_POST['f'];
        $pass      = Hash::make($_POST['password']);
        $name      = $_POST['username'];
        $akun      = Str::random(10);

        $dt = DB::table('users')->where('username', $name)->count();

        if ($dt == 0) {
            $data2 = array(
                "username"       => $name,  
                "name"           => $request['nama'],
                "alias"          => $_POST['password'],
                "type"           => $_POST['tipe'],
                "remember_token" => Str::random(40),
                "password"       => $pass,
                "akun"           => $akun,
            );

            $user  = DB::table('users')->insert($data2);

            $admin = Admin::create([
                "nama"      => $request['nama'],
                "jk"        => $request['jk'],
                "tmp_lahir" => $request['tmp_lahir'],
                "tgl_lahir" => $request['tgl_lahir'],
                "no_hp"     => $request['no_hp'],
                "idjabatan" => $request['idjabatan'],
                "email"     => $request['email'],
                "alamat"    => $request['alamat'],
                "idakun"    => $akun
            ]);

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
        } else {
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
            // ->editColumn("tgl_lahir", function ($data) {
            //     return date("d/m/Y", strtotime($data->tgl_lahir));
            // })
            ->addIndexColumn()
            ->addColumn('action', function ($data) {

                if ($data->nama="Ilham Wahyu Alam") {
                    $btnAkun = '<a class="dropdown-item" href="#" onclick="akun(`' . $data->idakun . '`)" data-toggle="modal" data-target="#md-akun"><i class="fa fa-key"></i> Akun</a>';
                }
                else{
                    $btnAkun= '';
                }

                $btn = '<center>
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="edit(`' . $data->id . '`)" data-toggle="modal" data-target="#md-fedit"><i class="fa fa-edit"></i>Edit</a>
                                '.$btnAkun.'
                                <a class="dropdown-item" href="#" onclick="getId(`' . $data->idakun . '`)" data-toggle="modal" data-target="#md-delete"><i class="fa fa-trash"></i> Hapus</a>
                            </div>
                        </center>
                        ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function del()
    {
        $idakun = $_POST['id'];

        $admin = DB::table('admin')->where('idakun', $idakun)->delete();
        $user  = DB::table('users')->where('akun', $idakun)->delete();
        if ( $admin || $user) {
            $data = "1";
        } else {
            $data = "0";
        }

        return $data;
    }
}
