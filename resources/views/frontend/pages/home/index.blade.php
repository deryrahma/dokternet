@extends( 'frontend.app' )

@section( 'custom-head' )
{!! HTML::style('plugins/select2/css/select2.min.css') !!}
<style type="text/css">
	.footer{
		position: absolute;
	}
</style>
@endsection

@section( 'custom-footer' )
{!! HTML::script('plugins/select2/js/select2.full.min.js') !!}
<script type="text/javascript">
	$("#city").select2({
		allowClear: true,
		language: "id"
	});
	$("#specialization").select2({
		allowClear: true,
		language: "id"
	});

</script>
@endsection

@section( 'content' )
<div class="row">
	<div class="col-md-12 home-page">
		<div class="row home-content">
			<div class="col-xs-12 col-md-6 ">
				<div class="panel home-panel-search" align="center">
					<h2>Cari Dokter</h2>
					<hr>
					{!! Form::open(['method' => 'GET', 'url' => route('search.doctor')]) !!}
					<div class="form-group">
						<label class="control-label" for="">Lokasi:</label>
						<div class="input-group">
							<div class="input-group-addon dokternet-bg-yellow"><i class="fa fa-map-marker"></i></div>
							<select name="city" class="form-control" id="city">
								@foreach($data['city'] as $row)
								<option value="{!! urlencode($row->name) !!}">
									{!! $row->name !!}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="">Keahlian / Spesialisasi:</label>
						<div class="input-group">
							<div class="input-group-addon dokternet-bg-yellow"><i class="fa fa-tasks"></i></div>
							<select name="specialization" class="form-control" id="specialization">
								@foreach($data['specialization'] as $row)
								<option value="{!! urlencode($row->name) !!}">
									{!! $row->name !!}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					{!! BootstrapForm::text('keyword','Kata Kunci',null, array('placeholder' => 'Nama Dokter, Nama Rumah Sakit, dll')) !!}
					<button class="btn btn-dokternet btn-block" type="submit">
						CARI DOKTER
						<i class="fa fa-arrow-circle-right"></i>
					</button>

					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="panel home-panel" style="padding: 20px 30px 30px" align="center">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#location" data-toggle="tab">Lokasi</a></li>
						<li><a href="#specialty" data-toggle="tab">Keahlian</a></li>
						<li><a href="#facility" data-toggle="tab">Layanan</a></li>
					</ul>
					<div class="tab-content">
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
</div>
@endsection