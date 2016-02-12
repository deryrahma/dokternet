@extends( 'frontend.pages.clinic.app' )

@section( 'sub-content' )
<h3>
	Tambahkan Riwayat Pendidikan
</h3>
<div class="col-md-12">
@include('errors.session')
</div>
<div class="col-md-12 dashboard-profile">
	{!! BootForm::open()->action(route('clinic.doctor.education.store',[$doctor->id])) !!}
	{!! BootstrapForm::text('year','Tahun Lulus') !!}
    {!! BootstrapForm::text('name','Nama Pendidikan') !!}
	{!! BootstrapForm::submit('Tambah') !!}
	{!! BootstrapForm::close() !!}
</div>
@endsection