		<header id="top" class="navbar navbar-static-top bs-docs-nav" role="banner">
			<div class="container  main-navbar">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{!! route( 'home' ) !!}">
						<img src="{!! asset( 'img/brand.png' ) !!}" class="image-brand">
					</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-navbar">
					<ul class="nav navbar-nav main-menu navbar-right">
						@if(Auth::check() == false or (Auth::check() and Auth::user()->roles->first()->level =='1'))
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Pasien
							</a>
							<ul class="dropdown-menu">
								<li><a href="{!! route( 'patient.register' ) !!}">Daftar</a></li>
								<li><a href="{!! route( 'patient.login' ) !!}">Masuk</a></li>
							</ul>
						</li> -->
						<li class="">
							<a href="{!! route('home.blog') !!}">
								Blog
							</a>
						</li>
						<li class="">
							<a href="{!! route('patient.login') !!}">
								Masuk
							</a>
						</li>
						<li class="login">
							<a href="{!! route( 'patient.register' ) !!}">Daftar Disini</a>
						</li>
						@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Akun Anda <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{!! route('patient.dashboard') !!}"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Dashboard</a></li>
								<li><a href="{!! route('patient.logout') !!}"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Keluar</a></li>
							</ul>
						</li>
						@endif
					</ul>

				</div>
			</div>
		</header>
