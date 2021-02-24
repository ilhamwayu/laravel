<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/master/jabatan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request = $_POST['f'];

        $data = Jabatan::create($request);

        if ($data) {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jabatan::find($id);
        return json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $id = $_POST['id'];
        $request = $_POST['f'];

        $data = Jabatan::updateOrCreate(
            ['id' => $id],
            $request
        );

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = $_POST['id'];
        $data = Jabatan::find($id)->delete();

        if ($data) {
            return '1';
        } else {
            return '0';
        }
    }

    public function select()
    {
        $data = DB::table('jabatan')
            ->select('id', 'nama_jabatan as name')
            ->get();
        return json_encode($data);
    }

    public function dataTable()
    {
        $data = Jabatan::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<center>
                            <button type="button" onclick="edit(`' . $data->id . '`)" data-toggle="modal" data-target="#md-fedit" class="btn btn-icon btn-sm bg-primary">
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
}
