@extends( 'frontend.app' )

@section( 'custom-head' )
	
@endsection

@section( 'custom-footer' )
	
@endsection

@section( 'content' )
	<div class="container">
				<div class="row" style="margin-top: 30px">
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px" align="center">
							<h2>Cari Dokter</h2>
							<hr>
							{!! BootForm::open() !!}
								{!! BootForm::text( 'Lokasi:', '' )->placeholder( 'Pilih lokasi (kota/provinsi)' )->attribute( 'style', 'text-align: center' ) !!}
								{!! BootForm::text( 'Keahlian:', '' )->placeholder( 'Pilih keahlian/spesialisasi dokter' )->attribute( 'style', 'text-align: center' ) !!}
								{!! BootForm::text( 'Layanan:', '' )->placeholder( 'Pilih jenis layanan' )->attribute( 'style', 'text-align: center' ) !!}<br>
								{!! BootForm::submit( 'Cari' )->addClass( 'btn btn-primary btn-block' ) !!}
							{!! BootForm::close() !!}
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="panel panel-info" style="padding: 20px 30px 30px" align="center">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#location" data-toggle="tab">Lokasi</a></li>
								<li><a href="#specialty" data-toggle="tab">Keahlian</a></li>
								<li><a href="#facility" data-toggle="tab">Layanan</a></li>
							</ul>
							<div class="tab-content" style="margin-top: 20px">
								<div id="location" class="tab-pane fade in active">
									Daftar lokasi
								</div>
								<div id="specialty" class="tab-pane fade">
									Daftar keahlian
								</div>
								<div id="facility" class="tab-pane fade">
									Daftar layanan kesehatan
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection