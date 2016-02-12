@extends( 'frontend.pages.clinic.app' )

@section( 'sub-content' )
<h3>
	Tambahkan Riwayat Pengalaman Bekerja
</h3>
<div class="col-md-12">
@include('errors.session')
</div>
<div class="col-md-12 dashboard-profile">
	{!! BootForm::open()->action(route('clinic.doctor.experience.store',[$doctor->id])) !!}
    {!! BootstrapForm::text('name') !!}
    {!! BootstrapForm::submit('Tambah') !!}
    {!! BootForm::close() !!}
</div>
@endsection