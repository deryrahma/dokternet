
@extends( 'frontend.app' )

@section( 'custom-head' )
@endsection

@section( 'custom-footer' )
@endsection

@section( 'content' )
	<div class="row">
		<div class="col-md-12 patient-page">
			<div class="row">
				<div class="col-md-4 sidebar-container">
					@include('frontend.pages.patient.sidebar')
				</div>
				<div class="col-md-8">
					<div class="row">
						<h3>
							Riwayat Perjanjian
						</h3>
						<div class="col-md-12">
						@include('errors.session')
						</div>
						<div class="col-md-12 dashboard-profile">
							<table class="table">
								<thead>
									<tr>
										<th>Klinik</th>
										<th>Dokter</th>
										<th>Tanggal</th>
										<th>Catatan</th>
										<th>Status</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data['content'] as $row)
									<tr>
										<td>{!! $row->schedule->clinic->name !!}</td>
										<td>{!! $row->schedule->doctor->name !!}</td>
										<td>{!! $row->schedule->date !!}</td>
										<td>{!! $row->note !!}</td>
										<td>
											@if($row->status == '1')
											<span class="label label-success">Selesai</span>
											@elseif($row->status == '2')
											<span class="label label-danger">Batal</span>
											@elseif($row->status == '0')
											<span class="label label-default">Belum</span>
											@endif
										</td>
										<td>
										@if($row->status == '1')
											@if($row->reviews()->count() == 1)
											@else
											<a href="{!! route('doctor.review.create', [$row->id]) !!}" class="btn btn-default btn-sm">Review</a>
											@endif
										@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection