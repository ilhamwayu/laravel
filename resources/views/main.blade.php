<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Aplikasi || @yield('title', 'Admin')</title>


  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  {{-- PLUGIN --}}
  <link href="{{ asset('assets/plugins/pnotify/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.css') }}"/>
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
    
      {{-- START HEADER --}}
      @include('layouts.header')
      {{-- END HEADER --}}

      {{-- START SIDEBAR --}}
      @include('layouts.sidebar')
      {{-- END SIDEBAR --}}

      {{-- START PAGES --}}
      <div class="main-content">
        @yield('conten')
      </div>
      {{-- END PAGES --}}

      {{-- START FOOTER --}}
      @include('layouts.footer')
      {{-- END FOOTER --}}
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  {{-- PLUGINS --}}
  <script src="{{ asset('assets/plugins/pnotify/pnotify.custom.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  @stack('scripts')
  <script>
    $(document).ready(function () {});

    function submitForm(id, reset, datatables, link) {
      var form = $("#" + id);
      // var link = $(form).attr("url");
      var form_data = new FormData($("#" + id)[0]);
      //data: $(form).serialize(),

      $.ajax({
        url:"/" +link,
        data: form_data,
        method: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: function() {
          floading_on(id);
        },
        success: function(data) {

          if (data[0].type == "success") {

            if (reset == "reset") {
              $(".inp-" + id).val("");
              $(".inp-" + id).trigger("change");
              $("#md-" + id).modal('toggle');
            }
          }

          notif(data[0].caption, data[0].msg, data[0].type);

          if (datatables == "dt") {
            table.ajax.reload(null, false);
          }
        },
        complete: function() {
          floading_off(id);
        }
      });

    }

    function floading_on(f){
      $("#btn-"+f).attr("disabled", "disabled");
      $("#btn-"+f).html("<i class='fa fa-spinner fa-pulse'></i> Loading...");

      $(".inp-"+f).attr("disabled", "disabled");
    }
    function floading_off(f){
      $("#btn-"+f).removeAttr("disabled");
      $("#btn-"+f).html("Simpan");

      $(".inp-"+f).removeAttr("disabled");
    }

    function loading_event(){
		var l = "<i class='fa fa-spinner fa-pulse fa-lg'></i> Loading...";

		return l;
	}

    function select(url, id) {
			$.ajax({
				url: "/" + url,
				type: "GET",
				dataType: "json",
				cache: false,
				beforeSend: function() {
					$("#" + id).attr("disabled", "disabled");
				},
				success: function(data) {

					var op = "<option value='' selected>- Pilih -</option>";
					for (var i = 0; i < data.length; i++) {
							op += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
					}

					$("#" + id).html(op);
				},
				complete: function() {
					$("#" + id).removeAttr("disabled");
				}
			});
    }

    function notif(caption, msg, type) {
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
