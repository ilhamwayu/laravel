@extends('main')
@section('title', 'Profile')
@section('conten')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        @foreach ($data as $v)

            <div class="section-body">
                <h2 class="section-title">Hi, {{ $v->nama }}!</h2>
                <p class="section-lead">
                    Ubah informasi data diri Anda di halaman ini.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                                        {{-- <div class="profile-widget-items">
                                            <div class="profile-widget-item">
                                                <div class="profile-widget-item-label">Posts</div>
                                                <div class="profile-widget-item-value">187</div>
                                            </div>
                                            <div class="profile-widget-item">
                                                <div class="profile-widget-item-label">Followers</div>
                                                <div class="profile-widget-item-value">6,8K</div>
                                            </div>
                                            <div class="profile-widget-item">
                                                <div class="profile-widget-item-label">Following</div>
                                                <div class="profile-widget-item-value">2,1K</div>
                                            </div>
                                          </div>
                                        --}}

                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ $v->nama }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div>{{ $v->nama_jabatan }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Username</label>
                                            <input type="text" class="form-control" value="{{ $v->username }}" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12 text-right">
                                            <button class="btn btn-primary">Ubah Username</button>
                                        </div>        
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Password Lama</label>
                                            <input type="text" class="form-control" value="Maman" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the last name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Password Baru</label>
                                            <input type="text" class="form-control" value="Maman" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the last name
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12 text-right">
                                            <button class="btn btn-primary">Ubah Password</button>
                                        </div>        

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-footer text-center">
                                    <div class="font-weight-bold mb-2">Follow Ujang On</div>
                                    <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                    <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                    <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon btn-github mr-1">
                                    <i class="fab fa-github"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon btn-instagram">
                                    <i class="fab fa-instagram"></i>
                                    </a>
                                </div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="POST" id="fedit" action="javascript:submitForm('fedit', 'reset', 'dt', 'adminUp');">
                                @csrf
                                <input type="text" name="" id="">
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama</label>
                                            <input type="text" class="form-control inp-fedit" name="f[nama]" value="{{ $v->nama }}" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label class="control-label">Jenis Kelamin</label><br>
                                            <select class="form-control inp-fedit" name="f[jk]" >
                                                <option value="LAKI-LAKI"
                                                    @if ($v->jk=="LAKI-LAKI")
                                                        {{ "selected" }}
                                                    @endif>Laki - laki
                                                </option>
                                                <option value="PEREMPUAN" 
                                                    @if ($v->jk=="PEREMPUAN")
                                                        {{ "selected" }}
                                                    @endif>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tempat Lahir</label>
                                            <input type="email" class="form-control inp-fedit" name="f[tmp_lahir]" value="{{ $v->tmp_lahir }}" required="">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control inp-fedit" name="f[tgl_lahir]" value="{{ $v->tgl_lahir }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Email</label>
                                            <input type="email" class="form-control inp-fedit" name="f[email]" value="{{ $v->email }}" required="">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>No Telpon</label>
                                            <input type="number" class="form-control inp-fedit" name="f[no_hp]" value="{{ $v->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Alamat</label>
                                            <textarea style="resize: none;height: 150px;" name="f[alamat]" class="form-control inp-fedit summernote-simple">{{ $v->alamat }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="form-group mb-0 col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                    id="newsletter">
                                                <label class="custom-control-label" for="newsletter">Subscribe to
                                                    newsletter</label>
                                                <div class="text-muted form-text">
                                                    You will get new information about products, offers and promotions
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit" id="btn-fedit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection

@push('scripts')

<script>
    
</script>

@endpush