<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>DokterNet</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<!-- stylesheets -->
		{!! HTML::style('css/bootstrap.min.css') !!}
		{!! HTML::style('css/font-awesome.min.css') !!}
		<style type="text/css">
			.credit {
				margin: 0 0;
				padding: 8px 0 4px 0;
			}
			.caret-up {
			    /* Safari */
			    -webkit-transform: rotate(-180deg);
			    /* Firefox */
			    -moz-transform: rotate(-180deg);
			    /* IE */
			    -ms-transform: rotate(-180deg);
			    /* Opera */
			    -o-transform: rotate(-180deg);
			    /* Internet Explorer */
			    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=6);
			}
			.drop-up {
			    top: auto;
			    bottom: 100% !important;
			}
		</style>
	</head>
	<body style="padding-bottom: 100px">
		<header id="top" class="navbar navbar-static-top bs-docs-nav" role="banner" style="background-color: #ddd; margin: 0; padding: 0">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{!! route( 'home' ) !!}" class="navbar-brand">DokterNet</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-navbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Pasien <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{!! route( 'patient.login' ) !!}">Daftar</a></li>
								<li><a href="#">Masuk</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Dokter <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Daftar</a></li>
								<li><a href="#">Masuk</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Klinik <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Daftar</a></li>
								<li><a href="#">Masuk</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</header>
		<section>
			<div class="container">
				<div class="row" style="margin-top: 30px">
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px" align="center">
							DokterNet - Halaman Login Pasien
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px" align="center">
							<h2>Login Pasien</h2>
							<hr>
							{!! BootForm::open(['route' => 'patient.login.post']) !!}
							{!! BootForm::text('Email:', '')->placeholder('Email') !!}
							{!! BootForm::password('Password:', '')->placeholder('Password') !!}
							<div class="form-group">
							  <div class="col-xs-8">
							    <div class="checkbox icheck">
							      <label>
							        <input type="checkbox"> Remember Me
							      </label>
							    </div>
							  </div><!-- /.col -->
							  <div class="col-xs-4">
							    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
							  </div><!-- /.col -->
							</div>
							{!! BootForm::close() !!}
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--
		<section style="background-color: #a5d7df; margin: 0; padding: 0 0 20px">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h2>Cari Dokter</h2>
						<br>
					</div>
				</div>
				{!! BootForm::open() !!}
					<div class="row">
						<div class="col-xs-4 col-xs-offset-1">
							{!! BootForm::text( null, '' )
										->hideLabel()
										->placeholder( 'Masukkan kota' ) !!}
						</div>
						<div class="col-xs-5">
							{!! BootForm::text( null, '' )
										->hideLabel()
										->placeholder( 'Cari berdasar spesialisasi dokter' ) !!}
						</div>
						<div class="col-xs-1">
							{!! BootForm::submit( 'Cari' )->addClass( 'btn btn-success btn-block' ) !!}
						</div>
					</div>
				{!! BootForm::close() !!}
				<div align="center">
					<label class="radio-inline">
						{!! BootForm::radio( 'Cari berdasarkan dokter', 'flag_search' )
									->value( '0' )
									->defaultToChecked() !!}
					</label>
					<label class="radio-inline">
					{!! BootForm::radio( 'Cari berdasarkan klinik', 'flag_search' )->value( '1' ) !!}
					</label>
					<label class="radio-inline">
						<a href="#">Cari berdasar opsi lain</a>
					</label>
				</div>
			</div>
		</section>
		-->
		<footer class="footer navbar-fixed-bottom" style="background-color: #ddd">
			<div class="container">
				<div class="col-xs-9">
					<p class="text-muted credit" style="padding-top: 15px">
						@foreach( $data['article'] as $row )
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									{!! $row->name !!} <span class="caret caret-up"></span>
								</button>
								<ul class="dropdown-menu drop-up" role="menu">
									@foreach( $row->articles as $subrow )
										<li><a href="#">{!! $subrow->title !!}</a></li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</p>
					<p style="padding-bottom: 10px">Copyright © 2015</p>
				</div>
				<div class="col-xs-3 pull-right">
					<div style="display: flex; justify-content: center; flex-direction: column; height: 100px; font-size: 25px" align="right">
						<ul class="list-inline">
							<li>
								<a href="#"><i class="fa fa-facebook-square"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-google-plus-square"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-twitter-square"></i></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-linkedin-square"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>

		<!-- scripts -->
		{!! HTML::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		{!! HTML::script('js/bootstrap.min.js') !!}
	</body>
</html>