<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    <link href="{{ asset('assets/plugins/pnotify/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css" />


    <title>Login</title>
</head>

<body>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('assets/login/images/undraw_remotely_2j6y.svg') }}" alt="Image"
                        class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Silahkan Masukan Username Dan Password Dengan Benar</p>
                            </div>
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username">

                                </div>
                                <br>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password">

                                </div>

                                {{-- <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember
                                            me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div> --}}

                                <button type="submit" onclick="login()" id="btn-login" class="btn btn-block btn-primary">Sig In</button>

                                {{-- <span
                                    class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>

                                <div class="social-login">
                                    <a href="#" class="facebook">
                                        <span class="icon-facebook mr-3"></span>
                                    </a>
                                    <a href="#" class="twitter">
                                        <span class="icon-twitter mr-3"></span>
                                    </a>
                                    <a href="#" class="google">
                                        <span class="icon-google mr-3"></span>
                                    </a>
                                </div> --}}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/main.js') }}"></script>
    <script src="{{ asset('assets/plugins/pnotify/pnotify.custom.min.js') }}"></script>

<script>

$(document).ready(function(){

$("#password").keypress(function(e) {
      if(e.which == 13) {
           login();
      }
  });

  $("#username").keypress(function(e) {
      if(e.which == 13) {
           login();
      }
  });

});


function login(){
var username = $("#username").val();
var password = $("#password").val();

if(username && password !==""){
    $.ajax({
        type:"POST",
        url:"{{ route('prosses') }}",
        dataType:"json",
        data:{username, password, _token: "{{ csrf_token() }}"},
        cache:false,
        beforeSend:function(){
            $("#btn-login").html("<i class='fa fa-spinner fa-pulse'></i> Loading...");
            $("#btn-login").attr("disabled", "disabled");
        },
        success:function(data){
            switch(String(data)){
                case"1":
                    notif("Success", "Berhasil Login.", "success");
                    setTimeout(function(){location.assign("{{ url('dashboard') }}")}, 1000);
                break;
                case"0":
                    notif("Error", "Username atau Password salah.", "error");
                break;
                case"0.1":
                    notif("Error", "Username Tidak Terdaftar.", "error");
                break;
                default:
                    notif("Error", "Gagal Login.", "error");
                break;
            }
        },
        complete:function(){
            $("#btn-login").html("LOGIN");
            $("#btn-login").removeAttr("disabled");
        }
    });
}
else{
    notif("Error", "Tidak boleh kosong.", "error");
}

}


function notif(caption, msg, type){
PNotify.prototype.options.styling = 'fontawesome';
new PNotify({
    title: caption,
    text: msg,
    type: type
});
}

</script>


</body>

</html>
