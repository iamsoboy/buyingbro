<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- Alpine Js -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
<head>

@include('includes.header')

</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="{{route ('index')}}" class="logo">
					<img src="{{ asset('assets/img/logo-w.png')}}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">

					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-envelope"></i>
								<span class="notification">2</span>
							</a>

						</li>

						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="{{route('cart.index')}}" id="notifDropdown" role="button">
								<i class="fa fa-shopping-cart"></i>
								<span class="notification">{{Cart::instance('default')->count()}}</span>
							</a>
						</li>
						@if ( Request::is('user/dashboard'))
						<li class="nav-item dropdown hidden-caret">
							<a id="currency" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<b> {{ currency()->getUserCurrency() }}</b><span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="currency">
                                @foreach(currency()->getCurrencies() as $currency)
                                <a class="dropdown-item" href="{{url('currency?currency='.$currency['code'])}}"> {{ $currency['name'] }} </a>
                                @endforeach
							</div>
						</li>
						@endif
						<li class="nav-item dropdown hidden-caret">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								<b> {{ $user->name }} </b><span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>

					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		@include('includes.sidebar')

		<div class="main-panel">
			@yield('content')

			@include('includes.footer')
		</div>




	</div>
	<!--   Core JS Files   -->
	<!--<script src="{{ asset ('assets/js/core/jquery.3.2.1.min.js')}}"></script>-->
	<script src="{{ asset ('assets/js/core/popper.min.js')}}"></script>
	<script src="{{ asset ('assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset ('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{ asset ('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset ('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{ asset ('assets/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset ('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset ('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{ asset ('assets/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset ('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset ('assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{ asset ('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset ('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset ('assets/js/atlantis.min.js')}}"></script>

	<!-- DatePicker -->
	<script src="{{ asset ('js/bootstrap-datepicker.js')}}"></script>

	<!-- Notify -->
	<script src="{{ asset ('js/bootstrap-notify.min.js')}}"></script>

	<!-- FileUpload -->
	<script src="{{ asset ('assets/plugins/dist/js/dropify.min.js')}}"></script>
    <!--<script src="{{ asset ('assets/plugins/dist/js/jquery.min.js')}}"></script>-->

</body>
</html>
