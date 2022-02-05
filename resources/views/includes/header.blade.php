<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{config('app.name')}} - @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- Favicon -->
	<link rel="icon" href="{{asset ('img/favicon.png')}}" type="image/png">

	<!-- Fonts and icons -->
	<script src="{{ asset ('assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('assets/css/fonts.min.css')}}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- JS Files -->
	<script src="{{ asset ('assets/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{ asset ('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>


	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset ('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset ('assets/css/atlantis.min.css')}}">
	<link rel="stylesheet" href="{{ asset ('css/animate.css')}}">
	<link href="{{ asset ('assets/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{ asset ('css/dropify.min.css')}}">
	<script src="{{asset('assets/js/countries.js')}}"></script>