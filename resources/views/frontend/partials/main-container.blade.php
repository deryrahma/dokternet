		<header id="top" class="navbar navbar-static-top bs-docs-nav" role="banner" style="background-color: #ddd; margin: 0; padding: 0">
			<div class="container">
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
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Pasien <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{!! route( 'patient.register' ) !!}">Daftar</a></li>
								<li><a href="{!! route( 'patient.login' ) !!}">Masuk</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Dokter <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Daftar</a></li>
								<li><a href="#"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Masuk</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Klinik <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Daftar</a></li>
								<li><a href="#"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Masuk</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</header>