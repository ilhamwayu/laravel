@extends('main')
@section('title', 'admin')
@section('conten')

    <section class="section">
        <div class="section-header">
            <h1>User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">User</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data User</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="float:right">
                                        <button class="btn btn-success" onclick="reload()">
                                            <i class="fa fa-sync-alt fa-lg"></i> Refresh
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
                                                    <th>Email</th>
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
                    <h4 class="modal-title" style="float:left">Tambah User</h4>
                </div>
                <form method="POST" id="fadd" action="javascript:submitForm('fadd', 'reset', 'dt', 'adminAdd');" >
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
                                    <select class="form-control inp-fadd select" required="" name="tipe">
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
                                    <select class="form-control inp-fadd select" name="f[idjabatan]" id="jabatan">
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
                                    <input type="password" class="form-control inp-fadd" autocomplete="off" required="" name="password" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control inp-fadd" style="resize: none;height: 200px;" autocomplete="off" required="" name="f[alamat]" autocomplete="off"></textarea>
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

    <div class="modal fade bd-example-modal-lg" id="md-fedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left">Edit User</h4>
                </div>
                <form method="POST" id="fedit" action="javascript:submitForm('fedit', 'reset', 'dt', 'adminUp');">
                    @csrf
                    <input type="hidden" name="getId" id="idGet">
                    <input type="hidden" name="f[idakun]" id="idakun">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control inp-fedit" id="enama" autocomplete="off" required=""
                                        name="f[nama]" autocomplete="off">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control inp-fedit select" id="ejk" required="" name="f[jk]">
                                        <option value=""> - Pilih -</option>
                                        <option value="PEREMPUAN"> - PEREMPUAN -</option>
                                        <option value="LAKI-LAKI"> - LAKI-LAKI -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control inp-fedit" id="etmp_lahir" autocomplete="off" required=""
                                        name="f[tmp_lahir]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control inp-fedit" id="etgl" autocomplete="off" required=""
                                        name="f[tgl_lahir]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input type="text" class="form-control inp-fedit" id="ehp" autocomplete="off" required=""
                                        name="f[no_hp]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control inp-fedit" id="eemail" autocomplete="off" required=""
                                        name="f[email]" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="form-control inp-fedit select" name="f[idjabatan]" id="ejbt" >
                                        <option selected="selected">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control inp-fedit" id="ealamat" style="resize: none;height: 200px;" autocomplete="off" required=""
                                        name="f[alamat]" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-fedit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bd-example" id="md-akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left">Akun</h4>
                </div>
                    <input type="hidden" name="getId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control inp-fedit" id="username" autocomplete="off" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control inp-fedit" id="password" autocomplete="off" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Batal</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="md-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
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
        
        var table;
        $(document).ready(function() {
            select("selectJabatan", "jabatan");
            select("selectJabatan", "ejbt");

            table = $('#data').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('adminData') }}',
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
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

        function edit(id){
            getId(id);
            $.ajax({
                url:"/adminedit/" + id,
                type:"GET",
                dataType:"json",
                cache:false,
                beforeSend:function(){
                    $(".inp").attr("disabled", "disabled");
                },
                success:function(data){
                    $("#enama").val(data.nama);
                    $("#etgl").val(data.tgl_lahir);
                    $("#etmp_lahir").val(data.tmp_lahir);
                    $("#ejbt").val(data.idjabatan);
                    $("#ejbt").trigger("change");
                    $("#ejk").val(data.jk);
                    $("#ejk").trigger("change");
                    $("#eemail").val(data.email);
                    $("#ehp").val(data.no_hp);
                    $("#ealamat").val(data.alamat);
                    $("#idakun").val(data.idakun);

                },
                complete:function(){
                    $(".inp").removeAttr("disabled");
                }
            });
	    }

        function akun(id){
            $.ajax({
                url:"/adminakun/" + id,
                type:"GET",
                dataType:"json",
                cache:false,
                beforeSend:function(){
                    $(".inp").attr("disabled", "disabled");
                },
                success:function(data){
                    $("#username").val(data[0].username);
                    $("#password").val(data[0].alias);
                },
                complete:function(){
                    $(".inp").removeAttr("disabled");
                }
            });
	    }

        function del() {
            var id = $("#get_id").val();
            $.ajax({
                url: "{{ route('adminDel') }}",
                type: "POST",
                data: {
                    id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
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
            $("#idGet").val(id);
        }

    </script>
@endpush
