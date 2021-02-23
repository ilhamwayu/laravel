@extends('main')
@section('title', 'admin')
@section('conten')

    <section class="section">
        <div class="section-header">
            <h1>Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Admin</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Admin</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="float:right">
                                        <button class="btn btn-success" onclick="reload()">
                                            <i class="fa fa-refresh fa-lg"></i> Refresh
                                        </button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#md-fadd">
                                            <i class="fa fa-plus fa-lg"></i> Tambah
                                        </button>
                                    </div>
        
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Username</th>
                                                    <th>No Hp</th>
                                                    <th>Alamat</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>   
    </section>

    <div class="modal fade bd-example-modal-lg" id="md-fadd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Tambah USer</h4>
                </div>
                <form method="POST" id="fadd" action="javascript:submitForm('fadd', 'reset', 'dt');" url="{{ url('adminAdd') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required="" name="f[nama]" autocomplete="off">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control inp-fadd select" required="" name="f[jk]">
                                        <option value=""> - Pilih -</option>
                                        <option value="PEREMPUAN"> - PEREMPUAN -</option>
                                        <option value="LAKI-LAKI"> - LAKI-LAKI -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required="" name="f[tmp_lahir]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control inp-fadd" autocomplete="off" required="" name="f[tgl_lahir]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input type="number" maxlength="12" class="form-control inp-fadd" autocomplete="off" required="" name="f[no_hp]" autocomplete="off">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Tipe User</label>
                                    <select class="form-control inp-fadd select" required="" name="type">
                                        <option value=""> - Pilih -</option>
                                        <option value="ADMIN"> - ADMIN -</option>
                                        <option value="PEGAWAI"> - PEGAWAI -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required="" name="f[email]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="form-control inp-fadd select" id="jabatan">
                                        <option selected="selected">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required="" name="username" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required="" name="password" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control inp-fadd" autocomplete="off" required="" name="f[alamat]" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-fadd" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- <div class="modal fade bd-example-modal-lg" id="md-fedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Tambah USer</h4>
                </div>
                <form method="POST" id="fadd" action="javascript:submitForm('fadd', 'reset', 'dt');" url="{{ url('adminAdd') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="f[nama]" autocomplete="off">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control inp-fadd select" required="" id="ekgnd" name="f[jk]">
                                        <option value=""> - Pilih -</option>
                                        <option value="PEREMPUAN"> - PEREMPUAN -</option>
                                        <option value="LAKI-LAKI"> - LAKI-LAKI -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="f[tmp_lahir]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="tgl_lahir" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="f[no_hp]" autocomplete="off">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Tipe User</label>
                                    <select class="form-control inp-fadd select" required="" name="type">
                                        <option value=""> - Pilih -</option>
                                        <option value="ADMIN"> - ADMIN -</option>
                                        <option value="PEGAWAI"> - PEGAWAI -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="f[email]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="username" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required=""
                                        name="password" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Minimal</label>
                                    <select class="form-control select select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control inp-fadd" style="height: 50px" autocomplete="off" required=""
                                        name="f[alamat]" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-fadd" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}

    <div class="modal fade" id="md-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus Admin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p style="text-align: center">
                    <i class="fa fa-exclamation-triangle" style="font-size: 35px;color:#C23F44"></i>&nbsp
                    <label style="font-size: 35px;"> Apa anda yakin ? </label>
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="btn-del" onclick="del()" class="btn btn-primary">Prosses</button>
            </div>
          </div>
        </div>
    </div>
    <input type="hidden" id="get_id">
@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table;
        $(document).ready(function() {
            select("selectJabatan", "jabatan");


            table = $('#data').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('adminData') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jk',
                        name: 'jk'
                    },
                    {
                        data: 'tmp_lahir',
                        name: 'tmp_lahir'
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'tgl_lahir'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        function reload() {
            table.draw();
        }

        function del() {
            var id = $("#get_id").val();
            $.ajax({
                url: "{{ url('delete') }}",
                type: "POST",
                data: {
                    id,
                    _token: "{{ csrf_token() }}"
                },
                daraType: "json",
                cache: false,
                beforeSend: function() {
                    $("#btn-del").attr("disabled", "disabled");
                    $("#btn-del").html(loading_event());
                },
                success: function(data) {
                    switch (parseFloat(data)) {
                        case 1:
                            table.ajax.reload(null, false);
                            notif("Success", "Data berhasil dihapus.", "success");
                            $('#md-delete').modal('toggle');
                            break;
                        case 0:
                            notif("Error", "Data gagal dihapus.", "error");
                            break;
                    }
                },
                complete: function() {
                    $("#btn-del").removeAttr("disabled");
                    $("#btn-del").html("Simpan");
                }
            });
        }

        function getId(id) {
            $("#get_id").val(id);
        }

    </script>
@endpush
