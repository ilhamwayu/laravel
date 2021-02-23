@extends('main')
@section('title', 'Jabatan')
@section('conten')

    <section class="section">
        <div class="section-header">
            <h1>Jabatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Jabatan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Jabatan</h4>
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
                                                    <th>Nama Jabatan</th>
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

    <div class="modal fade bd-example" id="md-fadd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left">Tambah Jabatan</h4>
                </div>
                <form method="POST" id="fadd" action="javascript:submitForm('fadd', 'reset', 'dt');" url="{{ url('jabatanAdd') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Jabatan</label>
                                    <input type="text" class="form-control inp-fadd" autocomplete="off" required="" name="f[nama_jabatan]" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-fadd" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bd-example" id="md-fedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left">Edit Jabatan</h4>
                </div>
                <form method="POST" id="fedit" action="javascript:submitForm('fedit', 'reset', 'dt');" url="{{ url('adminAdd') }}">
                    @csrf
                    <input type="hidden" id="getId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Jabatan</label>
                                    <input type="text" class="form-control inp-fedit" autocomplete="off" required="" name="f[nama_jabatan]" id="enama" autocomplete="off">
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

    <div class="modal fade" id="md-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus Jabatan</h5>
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
            table = $('#data').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('jabatanData') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'nama_jabatan'
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
			url:"/jabatanedit/" + id,
			type:"GET",
			dataType:"json",
			cache:false,
			beforeSend:function(){
				$(".inp").attr("disabled", "disabled");
			},
			success:function(data){
				$("#enama").val(data.nama_jabatan);
			},
			complete:function(){
				$(".inp").removeAttr("disabled");
			}
		 });
	}

        function del() {
            var id = $("#get_id").val();
            $.ajax({
                url: "{{ route('jabatanDel') }}",
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
            $("#getId").val(id);
        }

    </script>
@endpush
